<?php

Route::post('/contact', function (Illuminate\Http\Request $request) {
    $validated = $request->validate([
       'name' => 'required|string|max:255',
       'email' => 'required|email',
       'phone' => 'nullable|string|max:50',
       'service' => 'required|string|max:255',
       'message' => 'required|string',
    ]);

    return response()->json([
        'message' => 'Appointment message received!',
        'data' => $validated
    ]);
});