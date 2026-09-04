<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        // This converts your DB rows into a clean JSON object for Next.js
        $settings = Setting::all()->mapWithKeys(function ($item) {
            $rawData = $item->getRawOriginal('value');
            $decoded = json_decode($rawData, true);

            // If the value is a translation (JSON object), return translations
            if (is_array($decoded) && isset($decoded['en'])) {
                return [$item->key => $item->getTranslations('value')];
            }

            // If it's a simple string (like an image path), return the string
            return [$item->key => $item->value];
        });

        return response()->json($settings);
    }
}