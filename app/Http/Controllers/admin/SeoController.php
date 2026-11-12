<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Update the SEO settings (single-record model).
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'page_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string'],
            'keywords'         => ['nullable', 'string', 'max:500'],
            'canonical_url'    => ['nullable', 'string', 'url', 'max:500'],
            'robots'           => ['nullable', 'string', 'max:255'],
            'og_title'         => ['nullable', 'string', 'max:255'],
            'og_description'   => ['nullable', 'string'],
            'og_image'         => ['nullable', 'string', 'max:500'],
            'twitter_card'     => ['nullable', 'string', 'max:50'],
            'twitter_handle'   => ['nullable', 'string', 'max:100'],
            'ga4_id'           => ['nullable', 'string', 'max:50'],
            'gsc_verify'       => ['nullable', 'string', 'max:255'],
            'fb_pixel'         => ['nullable', 'string', 'max:50'],
            'hotjar_id'        => ['nullable', 'string', 'max:50'],
            'schema_type'      => ['nullable', 'string', 'max:100'],
            'json_ld'          => ['nullable', 'string'],
        ]);

        $seo = Seo::firstOrFail();
        $seo->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'SEO settings updated successfully.',
                'data' => $seo->fresh(),
            ]);
        }

        return back()->with('success', 'SEO settings updated successfully.');
    }
}
