<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class ManageDonatePage extends Component
{
    public $state = [];

protected $textKeys = [
        'dn_hero_label', 'dn_hero_title', 'dn_hero_desc',
        'dn_desk_title', 'dn_desk_desc', 'dn_desk_amt_label', 'dn_desk_btn',
        'dn_id_title', 'dn_id_anon', 'dn_pay_title', 'dn_pay_opt1', 'dn_pay_opt2',
        'dn_badge1', 'dn_badge2', 'dn_badge3',
        'dn_imp_title', 'dn_imp_label',
        'dn_i1_val', 'dn_i1_title', 'dn_i1_desc',
        'dn_i2_val', 'dn_i2_title', 'dn_i2_desc',
        'dn_i3_val', 'dn_i3_title', 'dn_i3_desc',
    ];

    public function mount() {
        foreach ($this->textKeys as $key) { $this->loadKey($key); }
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
        // Instant Live Preview
        $this->dispatch('content-updated', state: $this->state);
    }

    public function save() {
        foreach ($this->state as $key => $translations) {
            $setting = Setting::updateOrCreate(['key' => $key]);
            foreach ($translations as $lang => $val) {
                $setting->setTranslation('value', $lang, $val);
            }
            $setting->save();
        }
        session()->flash('message', 'Donation portal updated successfully!');
    }

    public function render() {
        return view('livewire.manage-donate-page')->layout('components.layouts.admin');
    }
}