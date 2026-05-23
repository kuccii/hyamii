<?php

namespace App\Exports;

use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CustomerReportExport implements WithMapping, FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    protected array $data;
    protected string $startDate;
    protected string $endDate;
    protected string $startTime;
    protected string $endTime;
    protected string $timezone;
    protected $currencyId;

    public function __construct(array $data, string $startDate, string $endDate, string $startTime, string $endTime, string $timezone)
    {
        $this->data = $data;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->timezone = $timezone;
        $this->currencyId = restaurant()->currency_id;
    }

    public function headings(): array
    {
        $headingTitle = $this->startDate === $this->endDate
            ? __('modules.report.salesDataFor') . " {$this->startDate}, " . __('modules.report.timePeriod') . " {$this->startTime} - {$this->endTime}"
            : __('modules.report.salesDataFrom') . " {$this->startDate} " . __('app.to') . " {$this->endDate}, " . __('modules.report.timePeriodEachDay') . " {$this->startTime} - {$this->endTime}";

        return [
            ['Customer Report ' . $headingTitle],
            [
                'Customer Name',
                'Email',
                'Phone',
                'Total Orders',
                'Total Items',
                'Total Revenue',
                'Average Order Value',
                'First Order Date',
                'Last Order Date',
                'Preferred Order Type',
                'Total Discount',
                'Loyalty Points',
                'Top Item',
                'Top Item Qty',
            ]
        ];
    }

    public function map($item): array
    {
        $customer = $item['customer'];
        $dateFormat = restaurant()->date_format ?? 'd-m-Y';
        $timeFormat = restaurant()->time_format ?? 'h:i A';
        $dateTimeFormat = $dateFormat . ' ' . $timeFormat;

        return [
            $customer->name ?? 'N/A',
            $customer->email ?? 'N/A',
            $customer->phone ?? 'N/A',
            $item['orders_count'],
            $item['items_count'] ?? 0,
            currency_format($item['total_revenue'], $this->currencyId),
            currency_format($item['avg_order_value'], $this->currencyId),
            $item['first_order_date'] ? Carbon::parse($item['first_order_date'])->setTimezone($this->timezone)->format($dateTimeFormat) : 'N/A',
            $item['last_order_date'] ? Carbon::parse($item['last_order_date'])->setTimezone($this->timezone)->format($dateTimeFormat) : 'N/A',
            $item['preferred_type'] ? ucfirst(str_replace('_', ' ', $item['preferred_type'])) : 'N/A',
            currency_format($item['total_discount'], $this->currencyId),
            $item['loyalty_points'] ?? 0,
            $item['top_item_name'] ?? 'N/A',
            $item['top_item_qty'] ?? 0,
        ];
    }

    public function defaultStyles(Style $defaultStyle)
    {
        return $defaultStyle
            ->getFont()
            ->setName('Arial');
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'name' => 'Arial'], 'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'f5f5f5'],
            ]],
            2 => ['font' => ['bold' => true, 'name' => 'Arial'], 'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'f5f5f5'],
            ]],
        ];
    }

    public function collection()
    {
        return collect($this->data);
    }
}
