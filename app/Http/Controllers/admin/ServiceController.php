<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Update (replace) all services — accepts an array of services.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'services'            => ['required', 'array'],
            'services.*.title'    => ['required', 'string', 'max:255'],
            'services.*.icon'     => ['nullable', 'string', 'max:100'],
            'services.*.description' => ['nullable', 'string'],
        ]);

        // Delete all existing services and re-create
        Service::query()->delete();

        foreach ($validated['services'] as $serviceData) {
            Service::create($serviceData);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Services updated successfully.',
                'data' => Service::all(),
            ]);
        }

        return back()->with('success', 'Services updated successfully.');
    }
}
