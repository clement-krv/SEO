<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Récupérer les propriétés pour Product
    public function getProperties()
    {
        $properties = [
            'name' => 'string',
            'price' => 'number',
            'currency' => 'string',
            'brand' => 'string',
            'sku' => 'string',
        ];

        return response()->json([
            'type' => 'Product',
            'properties' => $properties
        ]);
    }

    // Générer le JSON-LD pour Product
    public function generateJsonLD(Request $request)
    {
        $properties = $request->input('properties');
        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Product',
        ];

        foreach ($properties as $key => $value) {
            $jsonLD[$key] = $value;
        }

        return response()->json($jsonLD);
    }
}
