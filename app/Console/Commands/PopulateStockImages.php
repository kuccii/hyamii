<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use App\Models\Restaurant;
use App\Models\FrontDetail;
use App\Models\GlobalSetting;
use Illuminate\Console\Command;

class PopulateStockImages extends Command
{
    protected $signature = 'hyamii:populate-images';
    protected $description = 'Download stock images for menu items, restaurants, and landing page';

    private string $itemDir;
    private string $restaurantDir;
    private string $landingDir;

    private array $imageMap = [
        'ugali-isombe.webp' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=600&h=400&fit=crop',
        'ibihaza.webp' => 'https://images.unsplash.com/photo-1574323347407-f5e1ad6d020b?w=600&h=400&fit=crop',
        'agatogo.webp' => 'https://images.unsplash.com/photo-1604909052743-94e838986d24?w=600&h=400&fit=crop',
        'ibijumba.webp' => 'https://images.unsplash.com/photo-1596075780750-81249df16d19?w=600&h=400&fit=crop',
        'brochettes-mixed.webp' => 'https://images.unsplash.com/photo-1559847844-5315695dadae?w=600&h=400&fit=crop',
        'akabenz.webp' => 'https://images.unsplash.com/photo-1602470520998-f4a52199a3d6?w=600&h=400&fit=crop',
        'sambaza.webp' => 'https://images.unsplash.com/photo-1559737558-2f5a35f4523b?w=600&h=400&fit=crop',
        'grilled-tilapia.webp' => 'https://images.unsplash.com/photo-1580476262798-bddd9f4b7369?w=600&h=400&fit=crop',
        'ugali.webp' => 'https://images.unsplash.com/photo-1551754655-cd27e38d2076?w=600&h=400&fit=crop',
        'ikinyiga.webp' => 'https://images.unsplash.com/photo-1547592166-23ac45744acd?w=600&h=400&fit=crop',
        'rwandan-coffee.webp' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=600&h=400&fit=crop',
        'fanta-orange.webp' => 'https://images.unsplash.com/photo-1624517452488-0482c457f04c?w=600&h=400&fit=crop',
        'sambusa.webp' => 'https://images.unsplash.com/photo-1601050690597-df0568f7095c?w=600&h=400&fit=crop',
        'mizuzu.webp' => 'https://images.unsplash.com/photo-1604909052743-94e838986d24?w=600&h=400&fit=crop',
        'ikivuguto.webp' => 'https://images.unsplash.com/photo-1550583724-b2692b85b150?w=600&h=400&fit=crop',
        'urwagwa.webp' => 'https://images.unsplash.com/photo-1558642452-9d2a7deb7f62?w=600&h=400&fit=crop',
        'mandazi.webp' => 'https://images.unsplash.com/photo-1558961363-fa8fdf82db35?w=600&h=400&fit=crop',
        'default-food.webp' => 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&h=400&fit=crop',
    ];

    public function __construct()
    {
        parent::__construct();
        $this->itemDir = public_path('user-uploads/item');
        $this->restaurantDir = public_path('user-uploads/restaurant');
        $this->landingDir = public_path('user-uploads/landing');
    }

    public function handle(): int
    {
        $this->info('Creating directories...');
        foreach ([$this->itemDir, $this->restaurantDir, $this->landingDir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        $this->info('Downloading menu item images...');
        $downloaded = [];
        foreach ($this->imageMap as $filename => $url) {
            $dest = $this->itemDir . '/' . $filename;
            if (file_exists($dest)) {
                $this->line("  - {$filename} (already exists)");
                $downloaded[] = $filename;
                continue;
            }
            if ($this->download($url, $dest, $filename)) {
                $downloaded[] = $filename;
            }
        }

        $this->info('Updating menu items with NULL images...');
        foreach (\App\Models\MenuItem::whereNull('image')->get() as $item) {
            // Try to match by name prefix
            $name = strtolower($item->item_name);
            $matched = null;
            foreach ($downloaded as $f) {
                $base = pathinfo($f, PATHINFO_FILENAME);
                if (str_contains($name, $base)) {
                    $matched = $f;
                    break;
                }
            }
            if ($matched) {
                $item->image = $matched;
                $item->saveQuietly();
                $this->line("  ✓ {$item->item_name} -> {$matched}");
            } else {
                $item->image = 'default-food.webp';
                $item->saveQuietly();
                $this->line("  ~ {$item->item_name} -> default-food.webp");
            }
        }

        $this->info('Downloading restaurant images...');
        $restaurantImages = [
            'restaurant-1.webp' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&h=400&fit=crop',
            'restaurant-2.webp' => 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=600&h=400&fit=crop',
            'restaurant-3.webp' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=600&h=400&fit=crop',
        ];
        $i = 0;
        foreach (Restaurant::all() as $restaurant) {
            $filename = array_keys($restaurantImages)[$i % 3];
            $url = $restaurantImages[$filename];
            $dest = $this->restaurantDir . '/' . $filename;
            if (!file_exists($dest)) {
                $this->download($url, $dest, $filename);
            }
            $restaurant->logo = $filename;
            $restaurant->saveQuietly();
            $i++;
        }

        $this->info('Downloading landing page images...');
        $heroUrl = 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&h=600&fit=crop';
        $heroDest = $this->landingDir . '/hero.webp';
        if (!file_exists($heroDest)) {
            $this->download($heroUrl, $heroDest, 'hero.webp');
        }
        FrontDetail::query()->update(['image' => 'hero.webp']);

        $globalLogo = 'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=100&h=100&fit=crop';
        $globalDest = $this->restaurantDir . '/global-logo.webp';
        if (!file_exists($globalDest)) {
            $this->download($globalLogo, $globalDest, 'global-logo.webp');
        }
        GlobalSetting::query()->update([
            'logo' => 'global-logo.webp',
            'favicon' => 'global-logo.webp',
        ]);

        $this->info('Done! All stock images populated.');
        return self::SUCCESS;
    }

    private function download(string $url, string $dest, string $label): bool
    {
        $ctx = stream_context_create(['http' => ['timeout' => 30, 'user_agent' => 'Hyamii/1.0']]);
        $data = @file_get_contents($url, false, $ctx);
        if ($data === false) {
            $this->warn("  ! Failed: {$label}");
            return false;
        }
        file_put_contents($dest, $data);
        $this->line("  ✓ {$label}");
        return true;
    }
}
