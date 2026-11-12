<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Store a newly created project.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'url'         => ['nullable', 'string', 'max:500'],
            'initials'    => ['nullable', 'string', 'max:10'],
            'color_start' => ['nullable', 'string', 'max:50'],
            'color_end'   => ['nullable', 'string', 'max:50'],
            'categories'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'github_url'  => ['nullable', 'string', 'max:500'],
            'technologies' => ['nullable', 'string', 'max:500'],
            'year'        => ['nullable', 'string', 'max:10'],
            'status'      => ['nullable', 'string', 'max:50'],
        ]);

        $project = Project::create($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project created successfully.',
                'data'    => $project,
            ]);
        }

        return back()->with('success', 'Project created successfully.');
    }

    /**
     * Update the specified project.
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'name'        => ['nullable', 'string', 'max:255'],
            'url'         => ['nullable', 'string', 'max:500'],
            'initials'    => ['nullable', 'string', 'max:10'],
            'color_start' => ['nullable', 'string', 'max:50'],
            'color_end'   => ['nullable', 'string', 'max:50'],
            'categories'  => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'github_url'  => ['nullable', 'string', 'max:500'],
            'technologies' => ['nullable', 'string', 'max:500'],
            'year'        => ['nullable', 'string', 'max:10'],
            'status'      => ['nullable', 'string', 'max:50'],
        ]);

        $project->update($validated);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project updated successfully.',
                'data'    => $project->fresh(),
            ]);
        }

        return back()->with('success', 'Project updated successfully.');
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Request $request, Project $project)
    {
        $project->delete();

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully.',
            ]);
        }

        return back()->with('success', 'Project deleted successfully.');
    }
}
