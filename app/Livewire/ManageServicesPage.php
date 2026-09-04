<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;

class ManageServicesPage extends Component
{
    use WithFileUploads;

    public $state = [];
    public $hero_bg;
    public $service_images = []; // Temporary storage for 6 service images
    public $existing = [];

    protected $textKeys = [
        's_hero_label', 's_hero_title', 's_hero_desc',
        's_process_label', 's_process_title', 's_process_desc',
        's_emergency_badge', 's_emergency_title', 's_emergency_desc', 's_emergency_phone',
        // Dynamic keys for 6 services and 3 process steps will be handled in loops
    ];

    public function mount() {
        // Load base keys
        foreach ($this->textKeys as $key) { $this->loadKey($key); }

        // Load 6 Services
        for ($i = 1; $i <= 6; $i++) {
            $this->loadKey("service_{$i}_title");
            $this->loadKey("service_{$i}_desc");
            $this->loadKey("service_{$i}_tag");
            $this->existing["service_{$i}_img"] = Setting::where('key', "service_{$i}_img")->first()?->value;
        }

        // Load 3 Process Steps
        for ($i = 1; $i <= 3; $i++) {
            $this->loadKey("s_proc_{$i}_title");
            $this->loadKey("s_proc_{$i}_text");
        }

        $this->existing['hero_bg'] = Setting::where('key', 'service_hero_bg')->first()?->value;
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
        
        // Handle image previews for the iframe
        if ($this->hero_bg) $previewData['service_hero_bg'] = $this->hero_bg->temporaryUrl();
        for ($i = 1; $i <= 6; $i++) {
            if (isset($this->service_images[$i])) {
                $previewData["service_{$i}_img"] = $this->service_images[$i]->temporaryUrl();
            }
        }

        $this->dispatch('content-updated', state: $previewData);
    }

    public function save() {
        // Save all text fields
        foreach ($this->state as $key => $translations) {
            $setting = Setting::updateOrCreate(['key' => $key]);
            foreach ($translations as $lang => $val) {
                $setting->setTranslation('value', $lang, $val);
            }
            $setting->save();
        }

        // Save Images
        if ($this->hero_bg) {
            $path = $this->hero_bg->store('services', 'public');
            Setting::updateOrCreate(['key' => 'service_hero_bg'], ['value' => $path]);
        }

        foreach ($this->service_images as $index => $file) {
            $path = $file->store('services', 'public');
            Setting::updateOrCreate(['key' => "service_{$index}_img"], ['value' => $path]);
        }

        session()->flash('message', 'Services protocol published successfully!');
    }

    public function render() {
        return view('livewire.manage-services-page')->layout('components.layouts.admin');
    }
}