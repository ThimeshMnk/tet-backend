<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageBookingPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $images = []; // Temporary storage for uploads
    public $existing = [];

    protected $textKeys = [
        'bk_hero_label', 'bk_hero_title1', 'bk_hero_title2', 'bk_hero_sub', 'bk_hero_desc', 'bk_btn_discover', 'bk_btn_impact',
        'bk_phi_title1', 'bk_phi_title2', 'bk_phi_p1', 'bk_phi_p2', 'bk_phi_quote',
        'bk_obj1_title', 'bk_obj1_text', 'bk_obj2_title', 'bk_obj2_text',
        'bk_spaces_quote',
        'bk_cta_title', 'bk_cta_desc', 'bk_cta_btn1', 'bk_cta_btn2'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }

        // Load 4 Spaces
        for ($i = 1; $i <= 4; $i++) {
            $this->loadKey("bk_space_{$i}_title");
            $this->loadKey("bk_space_{$i}_cat");
            $this->existing["bk_space_{$i}_img"] = Setting::where('key', "bk_space_{$i}_img")->first()?->value;
        }

        // Load Section Images
        $imgKeys = ['bk_hero_main', 'bk_hero_sub', 'bk_phi_img', 'bk_cta_img'];
        foreach($imgKeys as $k) { $this->existing[$k] = Setting::where('key', $k)->first()?->value; }
    }

    private function loadKey($key) {
        $setting = Setting::where('key', $key)->first();
        $this->state[$key] = [
            'en' => $setting ? $setting->getTranslation('value', 'en') : '',
            'si' => $setting ? $setting->getTranslation('value', 'si') : '',
            'ta' => $setting ? $setting->getTranslation('value', 'ta') : '',
        ];
    }

    public function updated($propertyName) {
        $previewData = $this->state;
        // Generate Temp URLs for all pending uploads for the Live Preview
        foreach($this->images as $key => $file) {
            if ($file) $previewData[$key] = $file->temporaryUrl();
        }
        $this->dispatch('content-updated', state: $previewData);
    }

    public function save() {
        foreach ($this->state as $key => $translations) {
            $setting = Setting::updateOrCreate(['key' => $key]);
            foreach ($translations as $lang => $val) {
                $setting->setTranslation('value', $lang, $val);
            }
            $setting->save();
        }

        foreach ($this->images as $key => $file) {
            if ($file) {
                $path = $file->store('booking', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            }
        }

        session()->flash('message', 'TET Spaces content published!');
    }

    public function render() {
        return view('livewire.manage-booking-page')->layout('components.layouts.admin');
    }
}