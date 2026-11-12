<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visibility;
use App\Models\Settings;
use Illuminate\Http\Request;

class VisibilityController extends Controller
{
    /**
     * Update visibility settings — accepts sections[key], nav[key] checkboxes,
     * plus dark_mode_toggle and dark_mode_default for Settings.
     *
     * Nav keys are stored with "nav_" prefix to avoid duplicate section_key
     * collisions (the visibilities table has a unique constraint on section_key).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'sections'           => ['nullable', 'array'],
            'sections.*'         => ['nullable', 'in:0,1'],
            'nav'                => ['nullable', 'array'],
            'nav.*'              => ['nullable', 'in:0,1'],
            'dark_mode_toggle'   => ['nullable', 'in:0,1,true,false'],
            'dark_mode_default'  => ['nullable', 'in:0,1,true,false'],
        ]);

        // Update section visibility records
        if (isset($validated['sections'])) {
            foreach ($validated['sections'] as $key => $value) {
                Visibility::updateOrCreate(
                    ['section_key' => $key],
                    [
                        'visible'      => (bool) $value,
                        'section_name' => ucfirst(str_replace('_', ' ', $key)),
                        'type'         => 'section',
                        'description'  => ucfirst(str_replace('_', ' ', $key)) . ' section',
                    ]
                );
            }
        }

        // Update nav visibility records — prefix with "nav_" to keep section_key unique
        if (isset($validated['nav'])) {
            foreach ($validated['nav'] as $key => $value) {
                Visibility::updateOrCreate(
                    ['section_key' => 'nav_' . $key],
                    [
                        'visible'      => (bool) $value,
                        'section_name' => ucfirst(str_replace('_', ' ', $key)) . ' Nav',
                        'type'         => 'nav',
                        'description'  => 'Link to #' . $key,
                    ]
                );
            }
        }

        // Update dark mode settings
        if (isset($validated['dark_mode_toggle']) || isset($validated['dark_mode_default'])) {
            $settings = Settings::firstOrFail();
            $updateData = [];
            if (array_key_exists('dark_mode_toggle', $validated)) {
                $updateData['dark_mode_toggle'] = filter_var($validated['dark_mode_toggle'] ?? false, FILTER_VALIDATE_BOOLEAN);
            }
            if (array_key_exists('dark_mode_default', $validated)) {
                $updateData['dark_mode_default'] = filter_var($validated['dark_mode_default'] ?? false, FILTER_VALIDATE_BOOLEAN);
            }
            if (!empty($updateData)) {
                $settings->update($updateData);
            }
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Visibility settings updated successfully.',
                'data'    => Visibility::all(),
            ]);
        }

        return back()->with('success', 'Visibility settings updated successfully.');
    }
}
