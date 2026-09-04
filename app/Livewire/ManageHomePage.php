<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageHomePage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $hero_image_main, $hero_image_sub, $story_image;
    public $existing = [];

    protected $textKeys = [
        'hero_top_label', 'hero_title_1', 'hero_title_2', 'hero_description', 'btn_support', 'btn_mission',
        'impact_title', 'impact_label', 'view_journal',
        'stat_1_val', 'stat_1_label', 'stat_1_desc',
        'stat_2_val', 'stat_2_label', 'stat_2_desc',
        'stat_3_val', 'stat_3_label', 'stat_3_desc',
        'story_label', 'story_title', 'story_description', 'story_stat_val', 'story_stat_label', 'story_video_url', 'explore_services'
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
        $this->existing['hero_image_main'] = Setting::where('key', 'hero_image_main')->first()?->value;
        $this->existing['hero_image_sub'] = Setting::where('key', 'hero_image_sub')->first()?->value;
        $this->existing['story_image'] = Setting::where('key', 'story_image')->first()?->value;
    }

    // THIS IS THE MAGIC: Runs every time a property changes
    public function updated($propertyName) {
        $previewData = $this->state;

        // Handle Image Previews (Temporary URLs)
        if ($this->hero_image_main) $previewData['hero_image_main'] = $this->hero_image_main->temporaryUrl();
        if ($this->hero_image_sub) $previewData['hero_image_sub'] = $this->hero_image_sub->temporaryUrl();
        if ($this->story_image) $previewData['story_image'] = $this->story_image->temporaryUrl();

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
        $this->uploadImage('hero_image_main');
        $this->uploadImage('hero_image_sub');
        $this->uploadImage('story_image');
        session()->flash('message', 'Homepage published successfully!');
    }

    private function uploadImage($field) {
        if ($this->$field) {
            $path = $this->$field->store('homepage', 'public');
            Setting::updateOrCreate(['key' => $field], ['value' => $path]);
        }
    }

    public function render() {
        return view('livewire.manage-home-page')->layout('components.layouts.admin');
    }
}