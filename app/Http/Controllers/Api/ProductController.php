<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::where('is_available', true)
            ->orderBy('order', 'asc')
            ->get()
            ->map(function ($p) {
                return [
                    'id' => $p->id,
                    'title' => $p->getTranslations('title'),
                    'description' => $p->getTranslations('description'),
                    'price' => $p->price,
                    'currency' => $p->currency,
                    'specs' => $p->specs,
                    'badge' => $p->badge,
                    'icon' => $p->icon,
                    'image' => $p->image,
                ];
            });

        return response()->json($products);
    }
}