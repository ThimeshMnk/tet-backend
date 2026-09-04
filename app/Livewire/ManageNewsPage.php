<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageNewsPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $images = []; 
    public $existing = [];

    protected $textKeys = [
        // 1. Header
        'nw_hero_label', 'nw_hero_title', 'nw_hero_desc',
        // 2. Featured Post
        'nw_feat_badge', 'nw_feat_cat', 'nw_feat_date', 'nw_feat_title', 'nw_feat_excerpt', 'nw_feat_btn',
        // 3. Press Section
        'nw_press_title', 'nw_press_desc', 'nw_press_email', 'nw_press_btn1', 'nw_press_btn2'
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }
        $this->existing['nw_feat_img'] = Setting::where('key', 'nw_feat_img')->first()?->value;
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
        if (isset($this->images['nw_feat_img'])) {
            $previewData['nw_feat_img'] = $this->images['nw_feat_img']->temporaryUrl();
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

        if (isset($this->images['nw_feat_img'])) {
            $path = $this->images['nw_feat_img']->store('news', 'public');
            Setting::updateOrCreate(['key' => 'nw_feat_img'], ['value' => $path]);
        }

        session()->flash('message', 'Journal editorial published!');
    }

    public function render() {
        return view('livewire.manage-news-page')->layout('components.layouts.admin');
    }
}