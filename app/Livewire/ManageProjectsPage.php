<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageProjectsPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $images = []; 
    public $existing = [];

    protected $textKeys = [
        'pj_hero_label', 'pj_hero_title', 'pj_hero_desc',
        // Project 1
        'pj1_cat', 'pj1_title1', 'pj1_title2', 'pj1_p1', 'pj1_p2', 'pj1_status_label', 'pj1_status_val', 'pj1_progress',
        // Project 2
        'pj2_cat', 'pj2_title1', 'pj2_title2', 'pj2_desc', 'pj2_stat1_val', 'pj2_stat1_label', 'pj2_stat2_val', 'pj2_stat2_label',
        // Footer
        'pj_footer_title', 'pj_footer_desc'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }
        
        $imgKeys = ['pj1_img', 'pj2_img'];
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
                $path = $file->store('projects', 'public');
                Setting::updateOrCreate(['key' => $key], ['value' => $path]);
            }
        }

        session()->flash('message', 'Project portfolio updated successfully!');
    }

    public function render() {
        return view('livewire.manage-projects-page')->layout('components.layouts.admin');
    }
}