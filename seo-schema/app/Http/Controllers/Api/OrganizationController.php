<?php

// app/Http/Controllers/Api/OrganizationController.php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function getProperties()
    {
        // Liste des propriétés pour "Organization"
        $properties = [
            'name' => 'string',
            'url' => 'url',
            'streetAddress' => 'string',
            'addressLocality' => 'string',
            'addressCountry' => 'string',
            'contactPoint' => 'string',
        ];

        return response()->json([
            'type' => 'Organization',
            'properties' => $properties
        ]);
    }

    public function generateJsonLD(Request $request)
    {
        // Récupération des données envoyées depuis le formulaire
        $properties = $request->input('properties');
        $jsonLD = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
        ];

        // Construction du JSON-LD
        foreach ($properties as $key => $value) {
            $jsonLD[$key] = $value;
        }

        return response()->json($jsonLD);
    }
}
