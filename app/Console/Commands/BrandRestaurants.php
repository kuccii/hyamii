<?php

namespace App\Console\Commands;

use App\Helper\Files;
use App\Models\CartHeaderImage;
use App\Models\CartHeaderSetting;
use App\Models\Restaurant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File as FileFacade;

class BrandRestaurants extends Command
{
    protected $signature = 'hyamii:brand-restaurants';
    protected $description = 'Give each restaurant its own identity: monogram logo + branded hero banner on the customer site.';

    /**
     * restaurant name => [logo file, hero file]
     * Source SVGs ship in public/restaurant-assets/ (tracked in git) and are
     * copied into the served uploads folders on the host.
     */
    private array $branding = [
        'DELICATO' => ['logo-delicato.svg', 'hero-delicato.svg'],
        'VIEWS'    => ['logo-views.svg', 'hero-views.svg'],
        'TANIA'    => ['logo-tania.svg', 'hero-tania.svg'],
    ];

    public function handle(): int
    {
        // Ensure the served uploads folders exist
        FileFacade::ensureDirectoryExists(public_path(Files::UPLOAD_FOLDER . '/logo'));
        FileFacade::ensureDirectoryExists(public_path(Files::UPLOAD_FOLDER . '/cart_header_images'));
        $rows = [];

        foreach ($this->branding as $name => [$logoFile, $heroFile]) {
            $restaurant = Restaurant::where('name', $name)->first();
            if (!$restaurant) {
                $this->warn("Restaurant {$name} not found — skipped.");
                continue;
            }

            // 1. Logo (only when the restaurant has none of its own)
            $logoSet = false;
            if (empty($restaurant->logo)) {
                $this->deployAsset('logo', $logoFile);
                $restaurant->logo = $logoFile;
                $restaurant->saveQuietly();
                $logoSet = true;
            }

            // 2. Hero: cart header setting of type "image" drives $heroImageUrl on shop pages
            $setting = CartHeaderSetting::firstOrCreate(
                ['restaurant_id' => $restaurant->id],
                [
                    'header_type' => 'image',
                    'header_text' => $name,
                    'is_header_disabled' => false,
                ]
            );

            // Normalise existing rows too (e.g. left as text/disabled from testing)
            if ($setting->header_type !== 'image' || $setting->is_header_disabled) {
                $setting->update([
                    'header_type' => 'image',
                    'is_header_disabled' => false,
                ]);
            }

            // 3. Hero image row (idempotent — don't duplicate on re-runs)
            $heroSet = false;
            if ($setting->images()->count() === 0) {
                $this->deployAsset('cart_header_images', $heroFile);
                CartHeaderImage::create([
                    'cart_header_setting_id' => $setting->id,
                    'image_path' => $heroFile,
                    'alt_text' => $name,
                    'sort_order' => 0,
                ]);
                $heroSet = true;
            }

            $rows[] = [
                $name,
                $logoSet ? 'set ' . $logoFile : 'already had logo',
                $heroSet ? 'set ' . $heroFile : 'already had hero',
                $setting->fresh()->images->first()->image_url ?? '-',
            ];
        }

        $this->table(['Restaurant', 'Logo', 'Hero', 'Hero URL'], $rows);

        return self::SUCCESS;
    }

    /**
     * Copy a shipped asset from public/restaurant-assets/<folder>/ to the
     * served uploads folder (public/user-uploads/<folder>/).
     */
    private function deployAsset(string $folder, string $fileName): void
    {
        $source = public_path('restaurant-assets/' . $folder . '/' . $fileName);
        $target = public_path(Files::UPLOAD_FOLDER . '/' . $folder . '/' . $fileName);

        if (!FileFacade::exists($source)) {
            $this->warn("  missing asset: {$source}");
            return;
        }

        if (!FileFacade::exists($target)) {
            FileFacade::copy($source, $target);
        }
    }
}
