<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getProperties()
    {
        // Définition des propriétés pour un événement
        $properties = [
            'name' => 'string',
            'startDate' => 'dateTime',
            'endDate' => 'dateTime',
            'location' => 'Place',
            'description' => 'string',
            'organizer' => 'Organization or Person', // Peut être une organisation ou une personne
        ];

        return response()->json([
            'type' => 'Event',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        // Récupération des données du formulaire
        $properties = $request->input('properties', []);

        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
        ];

        // Vérification et construction du JSON-LD
        foreach ($properties as $key => $value) {
            if ($key === 'location' && is_array($value)) {
                $jsonLD[$key] = [
                    '@type' => 'Place',
                    'name' => $value['name'] ?? '',
                    'address' => $value['address'] ?? '',
                ];
            } elseif ($key === 'organizer' && is_array($value)) {
                // Vérifier si c'est une organisation ou une personne
                $organizerType = $request->input('properties.organizerType', 'Organization'); // Par défaut : Organisation
                if ($organizerType === 'Person') {
                    $jsonLD[$key] = [
                        '@type' => 'Person',
                        'name' => $value['name'] ?? '',
                    ];
                } else {
                    $jsonLD[$key] = [
                        '@type' => 'Organization',
                        'name' => $value['name'] ?? '',
                    ];
                }
            } else {
                $jsonLD[$key] = $value;
            }
        }

        return response()->json($jsonLD);
    }
}
