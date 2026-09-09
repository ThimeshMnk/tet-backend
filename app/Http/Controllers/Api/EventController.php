<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\JsonResponse;

class EventController extends Controller
{
    public function index(): JsonResponse
    {
        $events = Event::where('is_published', true)
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($ev) {
                return [
                    'id' => $ev->id,
                    'title' => $ev->getTranslations('title'),
                    'cat' => $ev->getTranslations('cat'),
                    'date' => $ev->date,
                    'location' => $ev->getTranslations('location'),
                    'excerpt' => $ev->getTranslations('excerpt'),
                    'fullStory' => $ev->getTranslations('full_story'),
                    'img' => $ev->cover_image,
                    'gallery' => $ev->gallery_images ?? [],
                ];
            });

        return response()->json($events);
    }
}