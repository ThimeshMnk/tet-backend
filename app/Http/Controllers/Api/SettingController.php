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

            // If it's a JSON array or object (translations or impact_cards)
           if ($decoded !== null) {
                return [$item->key => $decoded];
            }

            // If it's a simple string (image path or URL), return the raw string directly
             return [$item->key => trim($rawData, '"\'')];
        });

        return response()->json($settings);
    }
}