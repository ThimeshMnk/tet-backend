<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;

class SettingController extends Controller
{
    public function index(): JsonResponse
    {
        $settings = Setting::all()->mapWithKeys(function ($item) {
            $rawData = $item->getRawOriginal('value');
            $decoded = json_decode($rawData, true);

            // If the field is a JSON object with translations
            if (is_array($decoded)) {
                return [$item->key => $decoded];
            }

            // If it's a simple string (like an image path or plain URL)
            return [$item->key => $item->value];
        });

        return response()->json($settings);
    }
}