<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:255',
            'destination_country' => 'nullable|string|max:255',
            'service_type' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        // Inquiry model-e save hocche (Filament panel theke dekhte paben)
        Inquiry::create($validated);

        // AJAX / Fetch request-e page reload na kore instant JSON pathabe
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Your application has been received successfully! Our consultant will contact you within 24 hours.'
            ]);
        }

        return back()->with('success', 'Application submitted successfully!');
    }
}