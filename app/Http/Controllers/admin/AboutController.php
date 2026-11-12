<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Update the about section (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'section_label'   => ['nullable', 'string', 'max:255'],
            'section_title'   => ['nullable', 'string', 'max:255'],
            'paragraph_1'     => ['nullable', 'string'],
            'paragraph_2'     => ['nullable', 'string'],
            'name'            => ['nullable', 'string', 'max:255'],
            'place_of_birth'  => ['nullable', 'string', 'max:255'],
            'nationality'     => ['nullable', 'string', 'max:255'],
            'marital_status'  => ['nullable', 'string', 'max:255'],
            'profession'      => ['nullable', 'string', 'max:255'],
            'contact_no'      => ['nullable', 'string', 'max:50'],
            'email'           => ['nullable', 'string', 'email', 'max:255'],
            'location'        => ['nullable', 'string', 'max:255'],
            'experience'      => ['nullable', 'string', 'max:255'],
        ]);

        $about = About::firstOrFail();
        $about->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'About section updated successfully.',
                'data' => $about->fresh(),
            ]);
        }

        return back()->with('success', 'About section updated successfully.');
    }
}
