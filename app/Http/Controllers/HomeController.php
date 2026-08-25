<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Enums\PackageType;
use App\Models\Contact;
use App\Models\CustomMenu;
use App\Models\FrontDetail;
use App\Models\FrontFaq;
use App\Models\FrontFeature;
use App\Models\FrontReviewSetting;
use App\Models\LanguageSetting;
use App\Models\Restaurant;
use Froiden\Envato\Traits\AppBoot;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Module;
use App\Http\Middleware\CountrySelector;
use Nwidart\Modules\Facades\Module as  ModuleFacade;

class HomeController extends Controller
{

    use AppBoot;

    protected $language;

    public function __construct()
    {
        parent::__construct();

        $locale = session('customer_locale') ?? (global_setting()->locale ?? 'en');
        $languageSetting = LanguageSetting::where('language_code', $locale)->first();

        if (!$languageSetting) {
            $locale = 'en';
            $languageSetting = LanguageSetting::where('language_code', 'en')->first();
        }

        if (!session()->has('customer_is_rtl')) {
            session(['customer_is_rtl' => $languageSetting->is_rtl == 1]);
        }

        app()->setLocale($locale);
        $this->language = $locale;
    }

    public function changeLocale($locale)
    {
        // Validate if the locale exists in language settings
        $languageSetting = LanguageSetting::where('language_code', $locale)->first();

        // Set the customer locale in session
        session(['customer_locale' => $locale]);
        session(['customer_is_rtl' => $languageSetting->is_rtl == 1]);
        app()->setLocale($locale);
        $this->language = $locale;
        return redirect()->back()->with('success', 'Language changed successfully');
    }

    /**
     * Shared data for the marketing site: resolved country + currency + selector list.
     */
    protected function landingShared(): array
    {
        $code = (string) session('selected_country_code', 'RW');
        $country = CountrySelector::resolve($code) ?? CountrySelector::$map['RW'];

        return [
            'countryCode' => $code,
            'countryName' => $country['name'],
            'currencyCode' => $country['currency_code'],
            'currencySymbol' => $country['currency_symbol'],
            'countries' => CountrySelector::$map,
            'lh' => landing_home_setting(),
        ];
    }

    /**
     * Build the three marketing tiers with localized prices + feature bullets.
     */
    protected function pricingTiers(string $currencyCode): array
    {
        $extraLabels = [
            'Reservation' => 'Table reservations',
            'Delivery Executive' => 'Delivery & online ordering',
            'Waiter Request' => 'Waiter request system',
            'Expense' => 'Expense tracking',
            'Payment' => 'Payment integrations',
            'Customer' => 'Customer database',
            'Report' => 'Advanced reports',
        ];

        $limitLabel = fn($n, $singular) => $n == -1 ? "Unlimited $singular" : "Up to " . $n . " $singular";

        $tiers = [];

        foreach (['Starter', 'Growth', 'Enterprise'] as $name) {
            $pkg = Package::where('package_name', $name)->first();

            if (!$pkg) {
                continue;
            }

            $price = $pkg->localizedPrice($currencyCode);
            $monthly = $price && $price->monthly_price !== null ? $price->monthly_price : $pkg->monthly_price;
            $annual = $price && $price->annual_price !== null ? $price->annual_price : $pkg->annual_price;

            $features = [
                $limitLabel($pkg->branch_limit, 'branches'),
                $limitLabel($pkg->staff_limit, 'staff accounts'),
                $limitLabel($pkg->menu_items_limit, 'menu items'),
                'POS & kitchen display',
                'Reports & analytics',
            ];

            foreach ($pkg->modules()->pluck('name')->toArray() as $module) {
                if (isset($extraLabels[$module])) {
                    $features[] = $extraLabels[$module];
                }
            }

            $features = array_values(array_unique($features));

            $tiers[] = [
                'name' => $pkg->package_name,
                'description' => $pkg->description,
                'monthly' => (float) $monthly,
                'annual' => (float) $annual,
                'featured' => (bool) $pkg->is_recommended,
                'features' => $features,
            ];
        }

        return $tiers;
    }

    public function landing()
    {

        $this->showInstall();

        $global = global_setting();

        if ($global->disable_landing_site && !request()->ajax()) {
            return redirect(route('login'));
        }

        if ($global->landing_site_type == 'custom') {
            return response(file_get_contents($global->landing_site_url));
        }

        $this->modules = Module::where('is_superadmin', 0)->pluck('name')->toArray();
        $this->PackageFeatures = Package::ADDITIONAL_FEATURES;

        $AllModulesWithFeature = array_merge(
            $this->modules,
            $this->PackageFeatures
        );

        $packages = Package::with('modules')
            ->where('package_type', '!=', PackageType::DEFAULT)
            ->where('package_type', '!=', PackageType::TRIAL)
            ->where('is_private', false)
            ->orderBy('sort_order', 'asc')
            ->get();

        $trialPackage = Package::where('package_type', PackageType::TRIAL)->first();
        $customMenu = CustomMenu::all();

        $monthlyPackages = Package::where('package_type', PackageType::STANDARD)->where('monthly_status', true)->where('is_private', false)->get();
        $annualPackages = Package::where('package_type', PackageType::STANDARD)->where('annual_status', true)->where('is_private', false)->get();
        $lifetimePackages = Package::where('package_type', PackageType::LIFETIME)->where('is_private', false)->get();
        $language = $this->language;

        $languageSetting = LanguageSetting::where('language_code', $language)->first();
        $languageId = $languageSetting ? $languageSetting->id : null;
        $frontDetails = FrontDetail::where('language_setting_id', $languageId)->first();
        $frontFeatures = FrontFeature::where('language_setting_id', $languageId)->get();
        $frontReviews = FrontReviewSetting::where('language_setting_id', $languageId)->get();
        $frontFaqs = FrontFaq::where('language_setting_id', $languageId)->get();
        $frontContact = Contact::where('language_setting_id', $languageId)->first();

        $shared = $this->landingShared();
        $tiers = $this->pricingTiers($shared['currencyCode']);

        if ($global->landing_type == 'static') {
            return view('landing.index', array_merge(
                compact('packages', 'AllModulesWithFeature', 'trialPackage', 'monthlyPackages', 'annualPackages', 'lifetimePackages'),
                $shared
            ));
        }

        if ($global->landing_type == 'dynamic') {
            return view('landing.dynamic-index', array_merge(
                compact('packages', 'AllModulesWithFeature', 'trialPackage', 'monthlyPackages', 'annualPackages', 'lifetimePackages', 'customMenu', 'frontDetails', 'frontFeatures', 'frontReviews', 'frontFaqs', 'frontContact'),
                $shared
            ));
        }

        if ($global->landing_type == 'custom_home') {
            return view('landing.custom-home', array_merge($shared, ['tiers' => $tiers]));
        }

        return view('landing.custom-home', array_merge($shared, ['tiers' => $tiers]));
    }

    public function features()
    {
        $this->showInstall();

        $global = global_setting();

        if ($global->disable_landing_site && !request()->ajax()) {
            return redirect(route('login'));
        }

        return view('landing.features', $this->landingShared());
    }

    public function pricing()
    {
        $this->showInstall();

        $global = global_setting();

        if ($global->disable_landing_site && !request()->ajax()) {
            return redirect(route('login'));
        }

        $shared = $this->landingShared();
        $tiers = $this->pricingTiers($shared['currencyCode']);

        return view('landing.pricing', array_merge($shared, ['tiers' => $tiers]));
    }

    public function about()
    {
        $this->showInstall();

        $global = global_setting();

        if ($global->disable_landing_site && !request()->ajax()) {
            return redirect(route('login'));
        }

        return view('landing.about', $this->landingShared());
    }

    public function contact()
    {
        $this->showInstall();

        $global = global_setting();

        if ($global->disable_landing_site && !request()->ajax()) {
            return redirect(route('login'));
        }

        return view('landing.contact', $this->landingShared());
    }

    public function signup()
    {
        if (global_setting()->disable_landing_site) {
            return view('auth.restaurant_register');
        }

        return view('auth.restaurant_signup');
    }

    public function customerLogout()
    {
        session()->flush();
        return redirect(module_enabled('Subdomain') ? url('/') : route('shop_restaurant', [request()->restaurant]));
    }

    public function manifest()
    {
        $hash = request()->query('hash', '');

        if (!empty($hash)) {
            $slug = 'restaurant/' . $hash . '/';
        } else {
            $slug = 'super-admin/';
        }

        $relativeUrl = urldecode(request()->query('url', ''));

        $superadminUrl1 = File::exists(public_path('user-uploads/favicons/super-admin/android-chrome-192x192.png')) ? asset('user-uploads/favicons/super-admin/android-chrome-192x192.png') : asset('img/192x192.png');
        $superadminUrl2 = File::exists(public_path('user-uploads/favicons/super-admin/android-chrome-512x512.png')) ? asset('user-uploads/favicons/super-admin/android-chrome-512x512.png') : asset('img/512x512.png');


        $firstimagePath = public_path('user-uploads/favicons/' . $slug . 'android-chrome-192x192.png');
        $secondimagePath = public_path('user-uploads/favicons/' . $slug . 'android-chrome-512x512.png');
        $firsticonUrl = File::exists($firstimagePath) ? asset('user-uploads/favicons/' . $slug . 'android-chrome-192x192.png') : $superadminUrl1;
        $secondiconUrl = File::exists($secondimagePath) ? asset('user-uploads/favicons/' . $slug . 'android-chrome-512x512.png') : $superadminUrl2;
        $globalSetting = global_setting();

        $restaurant = Restaurant::where('hash', $hash)->first();

        return response()->json([
            'name' => $restaurant ? $restaurant->name : $globalSetting->name,
            'short_name' => $restaurant ? $restaurant->name : $globalSetting->name,
            'description' => $restaurant ? $restaurant->name : $globalSetting->name,
            'start_url' => url($relativeUrl),
            'display' => 'standalone',
            'background_color' => '#ffffff',
            'theme_color' => '#000000',
            'icons' => [
                [
                    'src' => $firsticonUrl,
                    'sizes' => '192x192',
                    'type' => 'image/png'
                ],
                [
                    'src' => $secondiconUrl,
                    'sizes' => '512x512',
                    'type' => 'image/png'
                ]
            ]
        ]);
    }



    public function validatePartnerDomain(Request $request)
    {
        $restApiInstalled = ModuleFacade::has('RestApi');

        if (!$restApiInstalled) {
            return response()->json([
                'status' => false,
                'code' => 'REST_API_MODULE_NOT_INSTALLED',
                'message' => __('messages.restApiModuleNotInstalledForDelivery'),
            ], 422);
        }

        if (!module_enabled('RestApi')) {
            return response()->json([
                'status' => false,
                'code' => 'REST_API_MODULE_NOT_ENABLED',
                'message' => __('messages.restApiModuleNotEnabledForDelivery'),
            ], 422);
        }

        $googleMapApiKey = global_setting()->google_map_api_key;

        if (blank($googleMapApiKey)) {
            return response()->json([
                'status' => false,
                'code' => 'GOOGLE_MAP_API_KEY_NOT_CONFIGURED',
                'message' => __('messages.googleMapApiKeyMissingForDelivery'),
            ], 422);
        }

        return response()->json([
            'status' => true,
            'code' => 'VALIDATION_SUCCESSFUL',
            'message' => __('messages.partnerValidationSuccessful'),
            'restaurant' => [
                'name' => global_setting()->name,
                'theme_hex' => global_setting()->theme_hex,
                'logo' => global_setting()->logoUrl,
            ],
        ], 200);
    }
}
