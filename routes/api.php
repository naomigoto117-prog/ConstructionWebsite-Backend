<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    return response()->json([
        'message' => 'Laravel API is working!'
    ]);
});

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'subject' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    return response()->json([
        'message' => 'Contact message received!',
        'data' => $validated
    ]);
});