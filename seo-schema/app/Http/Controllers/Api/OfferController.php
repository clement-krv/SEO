<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function getProperties()
    {
        // Définition des propriétés pour Offer
        $properties = [
            'name' => 'string',
            'price' => 'string',
            'currency' => 'string',
            'itemOffered' => 'Product',
        ];

        return response()->json([
            'type' => 'Offer',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        // Récupération des données soumises par le formulaire
        $properties = $request->input('properties', []);

        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Offer',
        ];

        // Vérification et construction du JSON-LD
        foreach ($properties as $key => $value) {
            if ($key === 'itemOffered' && is_array($value)) {
                $jsonLD[$key] = [
                    '@type' => 'Product',
                    'name' => $value['name'] ?? 'Produit inconnu',
                ];
            } else {
                $jsonLD[$key] = $value;
            }
        }

        return response()->json($jsonLD);
    }
}
