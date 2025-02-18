<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function getProperties()
    {
        // Liste des propriétés pour "Person"
        $properties = [
            'name' => 'string',
            'jobTitle' => 'string',
            'email' => 'email',
            'telephone' => 'string',
            'streetAddress' => 'string',
            'addressLocality' => 'string',
            'addressCountry' => 'string',
        ];

        return response()->json([
            'type' => 'Person',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        // Récupération des données envoyées depuis le formulaire
        $properties = $request->input('properties');
        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Person',
        ];

        // Construction du JSON-LD
        foreach ($properties as $key => $value) {
            $jsonLD[$key] = $value;
        }

        return response()->json($jsonLD);
    }
}
