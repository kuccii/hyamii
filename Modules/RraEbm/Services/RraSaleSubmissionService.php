<?php

namespace Modules\RraEbm\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\RraEbm\Entities\RraEbmInvoiceSequence;
use Modules\RraEbm\Entities\RraEbmReceiptSignature;
use Modules\RraEbm\Entities\RraEbmSetting;

class RraSaleSubmissionService
{
    public function __construct(
        protected RraEbmService $ebmService,
        protected RraProductSyncService $productSyncService
    ) {}

    public function submitOrder(Order $order): bool
    {
        $setting = RraEbmSetting::where('branch_id', $order->branch_id)->first();

        if (!$setting || !$setting->enabled || !$setting->isInitialized()) {
            Log::info('RRA EBM not configured for branch', ['branch_id' => $order->branch_id]);
            return false;
        }

        if (!$setting->shouldSubmitFor($order->order_type)) {
            return false;
        }

        if ($order->rra_ebm_submitted) {
            Log::info('Order already submitted to RRA', ['order_id' => $order->id]);
            return true;
        }

        $order->update([
            'rra_ebm_queued' => true,
            'rra_ebm_attempts' => DB::raw('rra_ebm_attempts + 1'),
        ]);

        try {
            return $this->doSubmit($order, $setting);
        } catch (\Exception $e) {
            Log::error('RRA EBM submission failed', [
                'order_id' => $order->id,
                'error' => $e->getMessage(),
            ]);

            $order->update([
                'rra_ebm_queued' => false,
                'rra_ebm_error' => $e->getMessage(),
            ]);

            throw $e;
        }
    }

    protected function doSubmit(Order $order, RraEbmSetting $setting): bool
    {
        $invoiceNumber = RraEbmInvoiceSequence::nextInvoiceNumber($order->branch_id);
        $branch = $order->branch;
        $restaurant = $branch->restaurant;

        $itemData = $this->buildItemList($order);
        $paymentTypeCode = $this->resolvePaymentTypeCode($order);

        $payload = [
            'tin' => $setting->tin_number,
            'bhfId' => $setting->branch_id_rra,
            'invcNo' => $invoiceNumber,
            'custNm' => $order->customer?->name ?? 'Walk-in Customer',
            'custTin' => '',
            'salesTyCd' => 'N',
            'rcptTyCd' => 'S',
            'pmtTyCd' => $paymentTypeCode,
            'salesSttsCd' => '02',
            'cfmDt' => $order->date_time ? $order->date_time->format('YmdHis') : now()->format('YmdHis'),
            'salesDt' => $order->date_time ? $order->date_time->format('Ymd') : now()->format('Ymd'),
            'totItemCnt' => count($itemData),
            'taxblAmtA' => 0,
            'taxblAmtB' => 0,
            'taxblAmtC' => 0,
            'taxblAmtD' => 0,
            'taxRtA' => 0,
            'taxRtB' => 18,
            'taxRtC' => 0,
            'taxRtD' => 0,
            'taxAmtA' => 0,
            'taxAmtB' => 0,
            'taxAmtC' => 0,
            'taxAmtD' => 0,
            'totTaxblAmt' => 0,
            'totTaxAmt' => 0,
            'totAmt' => 0,
            'prchrAcptcYn' => 'N',
            'regrId' => 'Hyamii',
            'regrNm' => 'Hyamii',
            'modrId' => 'Hyamii',
            'modrNm' => 'Hyamii',
            'remark' => "Order #{$order->formatted_order_number}",
            'receipt' => [
                'rptNo' => $invoiceNumber,
                'prchrAcptcYn' => 'N',
                'trdeNm' => $restaurant->name,
                'adrs' => $branch->address ?? '',
                'topMsg' => $restaurant->name . "\n" . ($branch->address ?? '') . "\nTIN: " . $setting->tin_number,
                'btmMsg' => 'Hyamii Restaurant Management',
            ],
            'itemList' => [],
        ];

        foreach ($itemData as $item) {
            $taxCode = $item['tax_code'];

            switch ($taxCode) {
                case 'A':
                    $payload['taxblAmtA'] += $item['taxable_amount'];
                    break;
                case 'B':
                    $payload['taxblAmtB'] += $item['taxable_amount'];
                    $payload['taxAmtB'] += $item['tax_amount'];
                    break;
                case 'C':
                    $payload['taxblAmtC'] += $item['taxable_amount'];
                    break;
                case 'D':
                    $payload['taxblAmtD'] += $item['taxable_amount'];
                    break;
            }

            $payload['totAmt'] += $item['taxable_amount'];

            $payload['itemList'][] = [
                'itemSeq' => $item['sequence'],
                'itemCd' => $item['item_cd'],
                'itemClsCd' => 'S',
                'itemNm' => $item['name'],
                'bcd' => '',
                'pkgUnitCd' => 'EA',
                'pkg' => 1,
                'qtyUnitCd' => 'EA',
                'qty' => $item['quantity'],
                'itemExprDt' => null,
                'prc' => round($item['unit_price'], 2),
                'dcAmt' => round($item['discount_amount'], 2),
                'dcRt' => round($item['discount_rate'], 2),
                'splyAmt' => round($item['total_price'], 2),
                'totDcAmt' => round($item['discount_amount'], 2),
                'taxblAmt' => round($item['taxable_amount'], 2),
                'taxTyCd' => $taxCode,
                'taxAmt' => round($item['tax_amount'], 2),
                'totAmt' => round($item['taxable_amount'], 2),
            ];
        }

        $payload['totTaxblAmt'] = round($payload['totAmt'], 2);
        $payload['totTaxAmt'] = round($payload['taxAmtB'], 2);
        $payload['totAmt'] = round($payload['totAmt'], 2);

        $payload['taxblAmtA'] = round($payload['taxblAmtA'], 2);
        $payload['taxblAmtB'] = round($payload['taxblAmtB'], 2);
        $payload['taxblAmtC'] = round($payload['taxblAmtC'], 2);
        $payload['taxblAmtD'] = round($payload['taxblAmtD'], 2);
        $payload['taxAmtA'] = round($payload['taxAmtA'], 2);
        $payload['taxAmtB'] = round($payload['taxAmtB'], 2);
        $payload['taxAmtC'] = round($payload['taxAmtC'], 2);
        $payload['taxAmtD'] = round($payload['taxAmtD'], 2);

        $endpoint = config('rraebm.endpoints.sale_transaction', '/trnsSales/saveSales');
        $response = $this->ebmService->post($setting, $endpoint, $payload);

        if (!$this->ebmService->isSuccessful($response)) {
            $error = $this->ebmService->getErrorMessage($response);
            throw new \RuntimeException("RRA sale submission failed: {$error}");
        }

        $responseData = $response->json()['data'];

        DB::transaction(function () use ($order, $responseData, $invoiceNumber) {
            RraEbmReceiptSignature::create([
                'order_id' => $order->id,
                'receipt_number' => $responseData['rcptNo'],
                'internal_data' => $responseData['intrlData'] ?? null,
                'receipt_signature' => $responseData['rcptSign'],
                'total_receipt_number' => $responseData['totRcptNo'] ?? null,
                'vsdc_receipt_publish_date' => $responseData['vsdcRcptPbctDate'] ?? null,
                'sdc_id' => $responseData['sdcId'] ?? null,
                'mrc_number' => $responseData['mrcNo'] ?? null,
                'invoice_number' => $invoiceNumber,
            ]);

            $order->update([
                'rra_ebm_submitted' => true,
                'rra_ebm_submitted_at' => now(),
                'rra_ebm_queued' => false,
                'rra_ebm_error' => null,
            ]);
        });

        Log::info('Order submitted to RRA EBM successfully', [
            'order_id' => $order->id,
            'receipt_number' => $responseData['rcptNo'],
        ]);

        return true;
    }

    protected function buildItemList(Order $order): array
    {
        $items = [];
        $sequence = 0;

        $order->loadMissing(['items.menuItem', 'items.modifierOptions']);

        foreach ($order->items as $orderItem) {
            $sequence++;

            $unitPrice = $orderItem->price;
            $quantity = $orderItem->quantity;
            $totalPrice = $unitPrice * $quantity;

            $discountRate = 0;
            $discountAmount = 0;

            if ($order->discount_amount > 0 && $order->sub_total > 0) {
                $itemSubtotal = $totalPrice;
                $itemWeight = $itemSubtotal / $order->sub_total;
                $discountAmount = round($order->discount_amount * $itemWeight, 2);
                $discountRate = $order->discount_value > 0
                    ? round(($discountAmount / $itemSubtotal) * 100, 2)
                    : 0;
            }

            $taxPercent = $orderItem->tax_percentage ?? 0;
            $taxAmount = $orderItem->tax_amount ?? 0;
            $taxableAmount = $totalPrice - $discountAmount;

            $taxCode = $this->productSyncService->resolveTaxCode((float) $taxPercent);

            $itemCd = $this->productSyncService->generateItemCode(
                RraEbmSetting::where('branch_id', $order->branch_id)->first(),
                [
                    'id' => $orderItem->menu_item_id,
                    'name' => $orderItem->menuItem?->item_name ?? "Item #{$orderItem->menu_item_id}",
                    'price' => $unitPrice,
                ]
            );

            $items[] = [
                'sequence' => $sequence,
                'item_cd' => $itemCd,
                'name' => $orderItem->menuItem?->item_name ?? "Item #{$orderItem->menu_item_id}",
                'unit_price' => $unitPrice,
                'quantity' => $quantity,
                'total_price' => $totalPrice,
                'discount_rate' => $discountRate,
                'discount_amount' => $discountAmount,
                'taxable_amount' => $taxableAmount,
                'tax_code' => $taxCode,
                'tax_amount' => $taxAmount,
                'tax_percent' => $taxPercent,
            ];
        }

        return $items;
    }

    protected function resolvePaymentTypeCode(Order $order): string
    {
        $paymentMethod = $order->payments()->first()?->payment_method;

        return match ($paymentMethod) {
            'cash' => '01',
            'card' => '02',
            'stripe', 'flutterwave', 'paypal', 'razorpay' => '03',
            'due' => '04',
            'mobile_money', 'mtn_momo', 'airtel_money' => '05',
            default => '01',
        };
    }
}
