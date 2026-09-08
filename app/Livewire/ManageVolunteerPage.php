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
        // 1. Hero Section
        'v_hero_label', 
        'v_hero_title1', 
        'v_hero_title2', 
        'v_hero_desc', 
        'v_hero_btn1', 
        'v_hero_btn2',

        // 2. Youth Services Showcase
        'v_youth_label',
        'v_youth_title', 
        'v_youth_desc',
        'v_youth_1_icon', 'v_youth_1_tag', 'v_youth_1_title', 'v_youth_1_desc',
        'v_youth_2_icon', 'v_youth_2_tag', 'v_youth_2_title', 'v_youth_2_desc',
        'v_youth_3_icon', 'v_youth_3_tag', 'v_youth_3_title', 'v_youth_3_desc',
        'v_youth_4_icon', 'v_youth_4_tag', 'v_youth_4_title', 'v_youth_4_desc',

        // 3. Volunteer Application Form & Consent
        'v_form_tag',
        'v_form_title',
        'v_form_desc',
        'v_form_consent_text',
        'v_form_btn',

        // 4. Institutional Quote
        'v_footer_quote', 
        'v_footer_cite'
    ];

    public function mount()
    {
        foreach ($this->textKeys as $key) { 
            $this->loadKey($key); 
        }
        
        $imgKeys = ['v_hero_img'];
        foreach ($imgKeys as $k) { 
            $this->existing[$k] = Setting::where('key', $k)->first()?->value; 
        }
    }

    private function loadKey($key)
    {
        $setting = Setting::where('key', $key)->first();
        $this->state[$key] = [
            'en' => $setting ? $setting->getTranslation('value', 'en') : '',
            'si' => $setting ? $setting->getTranslation('value', 'si') : '',
            'ta' => $setting ? $setting->getTranslation('value', 'ta') : '',
        ];
    }

    public function updated($propertyName)
    {
        $previewData = $this->state;
        foreach ($this->images as $key => $file) {
            if ($file) {
                $previewData[$key] = $file->temporaryUrl();
            }
        }
        $this->dispatch('content-updated', state: $previewData);
    }

    public function save()
    {
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

        session()->flash('message', 'Volunteer page content successfully published!');
    }

    public function render()
    {
        return view('livewire.manage-volunteer-page')->layout('components.layouts.admin');
    }
}