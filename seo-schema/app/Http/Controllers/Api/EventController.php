<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getProperties()
    {
        // Définition des propriétés attendues pour un événement
        $properties = [
            'name' => 'string',
            'startDate' => 'dateTime',
            'endDate' => 'dateTime',
            'location' => 'Place',
            'description' => 'string',
            'organizer' => 'Organization|Person', // Peut être soit une Organisation, soit une Personne
        ];

        return response()->json([
            'type' => 'Event',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        $properties = $request->input('properties', []);

        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
        ];

        foreach ($properties as $key => $value) {
            if ($key == 'location' && is_array($value)) {
                $jsonLD[$key] = [
                    '@type' => 'Place',
                    'name' => $value['name'] ?? '',
                    'address' => $value['address'] ?? '',
                ];
            } elseif ($key == 'organizer' && is_array($value)) {
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
