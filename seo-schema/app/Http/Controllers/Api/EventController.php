<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getProperties()
    {
        // Propriétés pour l'événement
        $properties = [
            'name' => 'string',
            'startDate' => 'dateTime',
            'endDate' => 'dateTime',
            'location' => 'Place',
            'description' => 'string',
            'organizer' => 'Organization',
        ];

        return response()->json([
            'type' => 'Event',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        // Récupération des données soumises par le formulaire
        $properties = $request->input('properties');
        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
        ];

        // Construction du JSON-LD
        foreach ($properties as $key => $value) {
            if ($key == 'location' && $value) {
                $jsonLD[$key] = [
                    '@type' => 'Place',
                    'name' => $value['name'],
                    'address' => $value['address'],
                ];
            } elseif ($key == 'organizer' && $value) {
                $jsonLD[$key] = [
                    '@type' => 'Organization',
                    'name' => $value['name'],
                ];
            } else {
                $jsonLD[$key] = $value;
            }
        }

        // Retourne la réponse JSON
        return response()->json($jsonLD);
    }
}
