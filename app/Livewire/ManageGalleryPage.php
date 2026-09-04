<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageGalleryPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $gallery_images = []; 
    public $existing = [];

    protected $textKeys = [
        'gl_hero_label', 'gl_hero_title', 'gl_hero_desc',
        'gl_event_title', 'gl_event_label',
        'gl_gallery_title',
        'gl_footer_title', 'gl_footer_desc', 'gl_footer_btn1', 'gl_footer_btn2',
        // Event 1
        'gl_ev1_day', 'gl_ev1_month', 'gl_ev1_title', 'gl_ev1_loc', 'gl_ev1_desc',
        // Event 2
        'gl_ev2_day', 'gl_ev2_month', 'gl_ev2_title', 'gl_ev2_loc', 'gl_ev2_desc'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }

        for ($i = 1; $i <= 6; $i++) {
            $this->loadKey("gl_img{$i}_alt");
            $this->existing["gl_img{$i}_src"] = Setting::where('key', "gl_img{$i}_src")->first()?->value;
        }
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
        for ($i = 1; $i <= 6; $i++) {
            if (isset($this->gallery_images[$i])) {
                $previewData["gl_img{$i}_src"] = $this->gallery_images[$i]->temporaryUrl();
            }
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

        foreach ($this->gallery_images as $index => $file) {
            if ($file) {
                $path = $file->store('gallery', 'public');
                Setting::updateOrCreate(['key' => "gl_img{$index}_src"], ['value' => $path]);
            }
        }

        session()->flash('message', 'Gallery chronicles published!');
    }

    public function render() {
        return view('livewire.manage-gallery-page')->layout('components.layouts.admin');
    }
}