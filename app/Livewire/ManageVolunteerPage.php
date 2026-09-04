<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageVolunteerPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $images = []; 
    public $existing = [];

    protected $textKeys = [
        // 1. Hero
        'v_hero_label', 'v_hero_title1', 'v_hero_title2', 'v_hero_desc', 'v_hero_btn1', 'v_hero_btn2',
        // 2. Areas of Expertise
        'v_exp_title', 'v_exp_label',
        'v_exp_1_title', 'v_exp_1_desc', 'v_exp_1_icon',
        'v_exp_2_title', 'v_exp_2_desc', 'v_exp_2_icon',
        'v_exp_3_title', 'v_exp_3_desc', 'v_exp_3_icon',
        'v_exp_4_title', 'v_exp_4_desc', 'v_exp_4_icon',
        // 3. Registry Form
        'v_form_title', 'v_form_btn',
        // 4. Footer
        'v_footer_quote', 'v_footer_cite'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }
        
        $imgKeys = ['v_hero_img', 'v_form_img'];
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
                $path = $file->store('volunteer', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            }
        }

        session()->flash('message', 'Volunteer registration content published!');
    }

    public function render() {
        return view('livewire.manage-volunteer-page')->layout('components.layouts.admin');
    }
}