<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageAboutPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $about_hero_image, $about_leader_image;
    public $existing = [];

    protected $textKeys = [
        'about_hero_label', 'about_hero_title', 'about_hero_description',
        'about_vision_title', 'about_vision_text', 'about_mission_title', 'about_mission_text',
        'about_values_main_title',
        'about_value_1_title', 'about_value_1_text',
        'about_value_2_title', 'about_value_2_text',
        'about_value_3_title', 'about_value_3_text',
        'about_value_4_title', 'about_value_4_text',
        'about_leader_label', 'about_leader_name', 'about_leader_role', 'about_leader_bio',
        'about_leader_stat1_val', 'about_leader_stat1_label',
        'about_leader_stat2_val', 'about_leader_stat2_label',
        'about_partner_quote', 'about_partner_label',
        'about_partner_1_name', 'about_partner_2_name'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) {
            $setting = Setting::where('key', $key)->first();
            $this->state[$key] = [
                'en' => $setting ? $setting->getTranslation('value', 'en') : '',
                'si' => $setting ? $setting->getTranslation('value', 'si') : '',
                'ta' => $setting ? $setting->getTranslation('value', 'ta') : '',
            ];
        }
        $this->existing['about_hero_image'] = Setting::where('key', 'about_hero_image')->first()?->value;
        $this->existing['about_leader_image'] = Setting::where('key', 'about_leader_image')->first()?->value;
    }

    public function updated($propertyName) {
        $previewData = $this->state;
        if ($this->about_hero_image) $previewData['about_hero_image'] = $this->about_hero_image->temporaryUrl();
        if ($this->about_leader_image) $previewData['about_leader_image'] = $this->about_leader_image->temporaryUrl();
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
        $this->uploadImage('about_hero_image');
        $this->uploadImage('about_leader_image');
        session()->flash('message', 'About Page published successfully!');
    }

    private function uploadImage($field) {
        if ($this->$field) {
            $path = $this->$field->store('about', 'public');
            Setting::updateOrCreate(['key' => $field], ['value' => $path]);
        }
    }

    public function render() {
        return view('livewire.manage-about-page')->layout('components.layouts.admin');
    }
}