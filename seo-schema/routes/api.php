<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonController;
use App\Http\Controllers\Api\OrganizationController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\OfferController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Person
Route::get('/person/properties', [PersonController::class, 'getProperties']);
Route::post('/person/generate-json-ld', [PersonController::class, 'generateJsonLD']);

// Organization
Route::get('/organization/properties', [OrganizationController::class, 'getProperties']);
Route::post('/organization/generate-json-ld', [OrganizationController::class, 'generateJsonLD']);

// Event
Route::get('/event/properties', [EventController::class, 'getProperties']);
Route::post('/event/generate-json-ld', [EventController::class, 'generateJsonLD']);

// Product
Route::get('/product/properties', [ProductController::class, 'getProperties']);
Route::post('/product/generate-json-ld', [ProductController::class, 'generateJsonLD']);

// Offer
Route::get('/offer/properties', [OfferController::class, 'getProperties']);
Route::post('/offer/generate-json-ld', [OfferController::class, 'generateJsonLD']);
