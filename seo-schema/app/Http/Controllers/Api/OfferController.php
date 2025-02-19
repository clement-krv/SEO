<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function getProperties()
    {
        // Définition des propriétés pour une offre
        $properties = [
            'name' => 'string',
            'price' => 'string',
            'priceCurrency' => 'string',
            'itemOffered' => 'Product',
            'seller' => 'Organization|Person', // Peut être soit une Organisation, soit une Personne
        ];

        return response()->json([
            'type' => 'Offer',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        $properties = $request->input('properties', []);

        // Construction du JSON-LD
        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Offer',
        ];

        foreach ($properties as $key => $value) {
            if ($key === 'itemOffered' && is_array($value)) {
                $jsonLD[$key] = [
                    '@type' => 'Product',
                    'name' => $value['name'] ?? '',
                ];
            } elseif ($key === 'seller' && is_array($value)) {
                $jsonLD[$key] = [
                    '@type' => $value['@type'] ?? 'Organization',
                    'name' => $value['name'] ?? '',
                ];
            } else {
                $jsonLD[$key] = $value;
            }
        }

        return response()->json($jsonLD);
    }
}
