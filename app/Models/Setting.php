<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model
{
    use HasTranslations;

    protected $fillable = ['key', 'value'];

    public $translatable = ['value'];

    /**
     * Only translate multi-language text fields. 
     * Plain JSON arrays, URLs, and image paths should remain raw.
     */
    public function isTranslatableAttribute(string $key): bool
    {
        if ($key !== 'value') {
            return false;
        }

        // Use getAttribute('key') safely instead of $this->key
        $settingKey = $this->getAttribute('key');

        if ($settingKey && in_array($settingKey, [
            'impact_cards', 
            'hero_image_main', 
            'hero_image_sub', 
            'story_image',
            'btn_support_url',
            'btn_mission_url',
            'view_journal_url',
            'story_video_url',
            'explore_services_url'
        ], true)) {
            return false;
        }

        return true;
    }
}