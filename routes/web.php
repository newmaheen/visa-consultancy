<?php

use App\Models\Service;
use App\Models\Inquiry;
use App\Models\SuccessStory; 
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    $services = Service::where('is_active', true)
        ->orderBy('order_priority', 'asc')
        ->get();

    // Success stories active & priority wise fetch kora hocche
    $successStories = SuccessStory::where('is_active', true)
        ->orderBy('priority', 'asc')
        ->latest()
        ->get();

    return view('welcome', compact('services', 'successStories'));
});

Route::post('/inquiry/submit', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'destination_country' => 'nullable|string|max:100',
        'service_type' => 'nullable|string|max:100',
        'message' => 'nullable|string',
    ]);

    Inquiry::create($validated);

    if ($request->ajax() || $request->wantsJson()) {
        return response()->json([
            'status' => 'success',
            'message' => 'Your inquiry has been submitted successfully! Our counselor will contact you soon.'
        ]);
    }

    return back()->with('success', 'Your inquiry has been submitted successfully! Our counselor will contact you soon.');
})->name('inquiry.submit');