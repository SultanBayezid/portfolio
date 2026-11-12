<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HireBanner;
use Illuminate\Http\Request;

class HireBannerController extends Controller
{
    /**
     * Update the hire banner section (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'heading'       => ['nullable', 'string', 'max:255'],
            'subtext'       => ['nullable', 'string'],
            'button_label'  => ['nullable', 'string', 'max:255'],
            'button_url'    => ['nullable', 'string', 'max:500'],
            'button_icon'   => ['nullable', 'string', 'max:100'],
            'visible'       => ['nullable', 'in:0,1,true,false'],
            'gradient_start' => ['nullable', 'string', 'max:50'],
            'gradient_end'  => ['nullable', 'string', 'max:50'],
        ]);

        // Convert visible to boolean
        if (isset($validated['visible'])) {
            $validated['visible'] = filter_var($validated['visible'], FILTER_VALIDATE_BOOLEAN);
        }

        $hireBanner = HireBanner::firstOrFail();
        $hireBanner->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Hire banner updated successfully.',
                'data' => $hireBanner->fresh(),
            ]);
        }

        return back()->with('success', 'Hire banner updated successfully.');
    }
}
