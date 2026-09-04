<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Setting extends Model {
    use HasTranslations;

    protected $fillable = ['key', 'value'];
    
    // We tell Laravel that 'value' contains our 3 languages
    public $translatable = ['value'];
}