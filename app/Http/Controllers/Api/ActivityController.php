<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\JsonResponse;

class ActivityController extends Controller
{
    public function index(): JsonResponse
    {
        $activities = Activity::where('is_published', true)
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($act) {
                return [
                    'id' => $act->id,
                    'title' => $act->getTranslations('title'),
                    'date' => $act->date,
                    'location' => $act->getTranslations('location'),
                    'excerpt' => $act->getTranslations('excerpt'),
                    'fullStory' => $act->getTranslations('full_story'),
                    'img' => $act->image,
                ];
            });

        return response()->json($activities);
    }
}