<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class SettingsController extends Controller
{
    /**
     * Update the filter categories for the project section.
     */
    public function updateFilters(Request $request)
    {
        $validated = $request->validate([
            'filters'   => ['required', 'array'],
            'filters.*' => ['nullable', 'string', 'max:100'],
        ]);

        $filters = array_values(array_filter($validated['filters'], function ($f) {
            return !empty(trim($f));
        }));

        $settings = Settings::firstOrFail();
        $settings->update(['filter_categories' => $filters]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Filter categories updated successfully.',
                'data'    => $filters,
            ]);
        }

        return back()->with('success', 'Filter categories updated successfully.');
    }

    /**
     * Update the general site settings (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title'       => ['nullable', 'string', 'max:255'],
            'site_logo'        => ['nullable', 'string', 'max:500'],
            'copyright'        => ['nullable', 'string', 'max:255'],
            'language'         => ['nullable', 'string', 'max:10'],
            'timezone'         => ['nullable', 'string', 'max:100'],
            'dark_mode_toggle' => ['nullable', 'in:0,1,true,false'],
            'dark_mode_default' => ['nullable', 'in:0,1,true,false'],
            'primary_accent'   => ['nullable', 'string', 'max:50'],
            'secondary_accent' => ['nullable', 'string', 'max:50'],
            'heading_color'    => ['nullable', 'string', 'max:50'],
            'background'       => ['nullable', 'string', 'max:50'],
            'body_font'        => ['nullable', 'string', 'max:255'],
            'heading_font'     => ['nullable', 'string', 'max:255'],
            'filter_categories' => ['nullable', 'array'],
            'filter_categories.*' => ['nullable', 'string', 'max:100'],
        ]);

        // Convert boolean fields
        foreach (['dark_mode_toggle', 'dark_mode_default'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = filter_var($validated[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $settings = Settings::firstOrFail();
        $settings->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Settings updated successfully.',
                'data' => $settings->fresh(),
            ]);
        }

        return back()->with('success', 'Settings updated successfully.');
    }

    /**
     * Update the theme-specific settings.
     */
    public function updateTheme(Request $request)
    {
        $validated = $request->validate([
            'primary_accent'   => ['nullable', 'string', 'max:50'],
            'secondary_accent' => ['nullable', 'string', 'max:50'],
            'heading_color'    => ['nullable', 'string', 'max:50'],
            'background'       => ['nullable', 'string', 'max:50'],
            'body_font'        => ['nullable', 'string', 'max:255'],
            'heading_font'     => ['nullable', 'string', 'max:255'],
            'dark_mode_toggle' => ['nullable', 'in:0,1,true,false'],
            'dark_mode_default' => ['nullable', 'in:0,1,true,false'],
        ]);

        // Convert boolean fields
        foreach (['dark_mode_toggle', 'dark_mode_default'] as $field) {
            if (isset($validated[$field])) {
                $validated[$field] = filter_var($validated[$field], FILTER_VALIDATE_BOOLEAN);
            }
        }

        $settings = Settings::firstOrFail();
        $settings->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Theme updated successfully.',
                'data' => $settings->fresh(),
            ]);
        }

        return back()->with('success', 'Theme updated successfully.');
    }

    /**
     * Update the authenticated user's password.
     */
    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password'      => ['required', 'string'],
            'password'              => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (! Hash::check($validated['current_password'], $user->password)) {
            if ($request->expectsJson()) {
                throw ValidationException::withMessages([
                    'current_password' => ['The current password is incorrect.'],
                ]);
            }
            throw ValidationException::withMessages([
                'current_password' => ['The current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($validated['password']),
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Password updated successfully.',
            ]);
        }

        return back()->with('success', 'Password updated successfully.');
    }

    /**
     * Export all site data as a JSON file.
     */
    public function exportJson()
    {
        $data = [
            'hero'         => \App\Models\Hero::first(),
            'about'        => \App\Models\About::first(),
            'projects'     => \App\Models\Project::all(),
            'skills'       => \App\Models\Skill::all(),
            'services'     => \App\Models\Service::all(),
            'hireBanner'   => \App\Models\HireBanner::first(),
            'testimonials' => \App\Models\Testimonial::all(),
            'contact'      => \App\Models\Contact::first(),
            'seo'          => \App\Models\Seo::first(),
            'settings'     => \App\Models\Settings::first(),
            'visibility'   => \App\Models\Visibility::all(),
            'exported_at'  => now()->toIso8601String(),
        ];

        $filename = 'portfolio-export-' . now()->format('Y-m-d-His') . '.json';

        return response()->json($data, 200, [
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Create a backup snapshot of the current site data.
     */
    public function createBackup()
    {
        $data = [
            'hero'         => \App\Models\Hero::first(),
            'about'        => \App\Models\About::first(),
            'projects'     => \App\Models\Project::all(),
            'skills'       => \App\Models\Skill::all(),
            'services'     => \App\Models\Service::all(),
            'hireBanner'   => \App\Models\HireBanner::first(),
            'testimonials' => \App\Models\Testimonial::all(),
            'contact'      => \App\Models\Contact::first(),
            'seo'          => \App\Models\Seo::first(),
            'settings'     => \App\Models\Settings::first(),
            'visibility'   => \App\Models\Visibility::all(),
            'backup_at'    => now()->toIso8601String(),
        ];

        $filename = 'backup-' . now()->format('Y-m-d-His') . '.json';
        \Illuminate\Support\Facades\Storage::put('backups/' . $filename, json_encode($data, JSON_PRETTY_PRINT));

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Backup created successfully: ' . $filename,
            ]);
        }

        return back()->with('success', 'Backup created successfully: ' . $filename);
    }

    /**
     * Clear all application cache.
     */
    public function clearCache()
    {
        \Illuminate\Support\Facades\Artisan::call('cache:clear');
        \Illuminate\Support\Facades\Artisan::call('config:clear');
        \Illuminate\Support\Facades\Artisan::call('view:clear');

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cache cleared successfully.',
            ]);
        }

        return back()->with('success', 'Cache cleared successfully.');
    }

    /**
     * Reset all settings to their default values.
     */
    public function resetDefaults()
    {
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'PortfolioSeeder']);

        if (request()->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Settings reset to defaults successfully.',
            ]);
        }

        return back()->with('success', 'Settings reset to defaults successfully.');
    }
}
