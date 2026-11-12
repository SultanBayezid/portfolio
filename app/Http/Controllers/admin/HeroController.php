<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Update the hero section (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'display_name'    => ['nullable', 'string', 'max:255'],
            'status_badge'    => ['nullable', 'string', 'max:255'],
            'avatar_initials' => ['nullable', 'string', 'max:10'],
            'sub_line'        => ['nullable', 'string', 'max:255'],
            'hire_btn_label'  => ['nullable', 'string', 'max:255'],
            'hire_btn_url'    => ['nullable', 'string', 'max:500'],
            'view_work_label' => ['nullable', 'string', 'max:255'],
            'view_work_target' => ['nullable', 'string', 'max:500'],
            'facebook_url'    => ['nullable', 'string', 'max:500'],
            'linkedin_url'    => ['nullable', 'string', 'max:500'],
            'youtube_url'     => ['nullable', 'string', 'max:500'],
            'github_url'      => ['nullable', 'string', 'max:500'],
            'website_url'     => ['nullable', 'string', 'max:500'],
            'typing_words'    => ['nullable', 'array'],
            'typing_words.*'  => ['nullable', 'string', 'max:255'],
            'section_label'   => ['nullable', 'string', 'max:255'],
            'blob_color_1'    => ['nullable', 'string', 'max:50'],
            'blob_color_2'    => ['nullable', 'string', 'max:50'],
            'avatar_gradient' => ['nullable', 'string', 'max:255'],
        ]);

        $hero = Hero::firstOrFail();
        $hero->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hero section updated successfully.',
                'data' => $hero->fresh(),
            ]);
        }

        return back()->with('success', 'Hero section updated successfully.');
    }
}
