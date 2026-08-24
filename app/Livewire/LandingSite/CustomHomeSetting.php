<?php

namespace App\Livewire\LandingSite;

use App\Helper\Files;
use App\Models\LandingHomeSetting;
use Illuminate\Support\Arr;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class CustomHomeSetting extends Component
{
    use WithFileUploads, LivewireAlert;

    public array $data = [];

    public $heroImage;
    public $aboutImage;
    public $faqImage;
    public $footerLogo;
    public array $brandLogos = [];
    public array $serviceIcons = [];

    public function mount()
    {
        $existing = optional(LandingHomeSetting::first())->data ?? [];
        $this->data = Arr::wrap(array_replace_recursive(LandingHomeSetting::defaults(), $existing));

        $this->brandLogos = array_pad([], 6, null);
        $this->serviceIcons = array_pad([], count($this->data['services']['items']), null);
    }

    public function addService()
    {
        $this->data['services']['items'][] = ['title' => '', 'text' => '', 'icon' => null];
        $this->serviceIcons[] = null;
    }

    public function removeService($index)
    {
        if (count($this->data['services']['items']) > 1) {
            unset($this->data['services']['items'][$index]);
            $this->data['services']['items'] = array_values($this->data['services']['items']);
            unset($this->serviceIcons[$index]);
            $this->serviceIcons = array_values($this->serviceIcons);
        }
    }

    public function addFaq()
    {
        $this->data['faq']['items'][] = ['question' => '', 'answer' => ''];
    }

    public function removeFaq($index)
    {
        if (count($this->data['faq']['items']) > 1) {
            unset($this->data['faq']['items'][$index]);
            $this->data['faq']['items'] = array_values($this->data['faq']['items']);
        }
    }

    public function removeImage($key)
    {
        Arr::set($this->data, $key, null);
    }

    public function save()
    {
        $disk = 'landing_home';

        if ($this->heroImage) {
            $this->data['hero']['image'] = Files::uploadLocalOrS3($this->heroImage, $disk);
            $this->heroImage = null;
        }

        if ($this->aboutImage) {
            $this->data['about']['image'] = Files::uploadLocalOrS3($this->aboutImage, $disk);
            $this->aboutImage = null;
        }

        if ($this->faqImage) {
            $this->data['faq']['image'] = Files::uploadLocalOrS3($this->faqImage, $disk);
            $this->faqImage = null;
        }

        if ($this->footerLogo) {
            $this->data['footer']['logo'] = Files::uploadLocalOrS3($this->footerLogo, $disk);
            $this->footerLogo = null;
        }

        foreach ($this->brandLogos as $index => $file) {
            if ($file) {
                $this->data['brand']['logos'][$index] = Files::uploadLocalOrS3($file, $disk);
            }
        }

        foreach ($this->serviceIcons as $index => $file) {
            if ($file && isset($this->data['services']['items'][$index])) {
                $this->data['services']['items'][$index]['icon'] = Files::uploadLocalOrS3($file, $disk);
            }
        }

        $setting = LandingHomeSetting::first() ?? new LandingHomeSetting();
        $setting->data = $this->data;
        $setting->save();

        cache()->forget('landing_home_setting');

        $this->alert('success', __('messages.settingsUpdated'), [
            'toast' => true,
            'position' => 'top-end',
            'showCancelButton' => false,
            'cancelButtonText' => __('app.close'),
        ]);
    }

    public function render()
    {
        return view('livewire.landing-site.custom-home-setting');
    }
}
