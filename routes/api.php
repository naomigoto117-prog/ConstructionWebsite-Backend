<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

Route::post('/contact', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'nullable|string|max:50',
        'service' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    Mail::raw(
        "New appointment message:\n\n" .
        "Name: {$validated['name']}\n" .
        "Email: {$validated['email']}\n" .
        "Phone: " . ($validated['phone'] ?? 'N/A') . "\n" .
        "Service: {$validated['service']}\n\n" .
        "Message:\n{$validated['message']}",
        function ($message) use ($validated) {
            $message->to('naomi.goto117@example.com')
                ->subject('New Appointment Inquiry')
                ->replyTo($validated['email']);
        }
    );

    return response()->json([
        'message' => 'Appointment message sent successfully!',
    ]);
});