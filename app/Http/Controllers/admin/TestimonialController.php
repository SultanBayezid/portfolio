<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Update (replace) all testimonials — accepts an array of testimonials.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'testimonials'          => ['required', 'array'],
            'testimonials.*.name'   => ['required', 'string', 'max:255'],
            'testimonials.*.initials' => ['nullable', 'string', 'max:10'],
            'testimonials.*.rating' => ['required', 'integer', 'min:1', 'max:5'],
            'testimonials.*.review' => ['nullable', 'string'],
        ]);

        // Delete all existing testimonials and re-create
        Testimonial::query()->delete();

        foreach ($validated['testimonials'] as $testimonialData) {
            Testimonial::create($testimonialData);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Testimonials updated successfully.',
                'data' => Testimonial::all(),
            ]);
        }

        return back()->with('success', 'Testimonials updated successfully.');
    }
}
