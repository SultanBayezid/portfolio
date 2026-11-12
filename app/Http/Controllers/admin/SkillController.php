<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Update (replace) all skills — accepts backend_skills and frontend_skills arrays.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'backend_skills'                => ['nullable', 'array'],
            'backend_skills.name'           => ['nullable', 'array'],
            'backend_skills.name.*'         => ['nullable', 'string', 'max:255'],
            'backend_skills.pct'            => ['nullable', 'array'],
            'backend_skills.pct.*'          => ['nullable', 'integer', 'min:0', 'max:100'],
            'frontend_skills'               => ['nullable', 'array'],
            'frontend_skills.name'          => ['nullable', 'array'],
            'frontend_skills.name.*'        => ['nullable', 'string', 'max:255'],
            'frontend_skills.pct'           => ['nullable', 'array'],
            'frontend_skills.pct.*'         => ['nullable', 'integer', 'min:0', 'max:100'],
        ]);

        // Delete all existing skills and re-create
        Skill::query()->delete();

        // Process backend skills
        $backendNames = $validated['backend_skills']['name'] ?? [];
        $backendPcts  = $validated['backend_skills']['pct'] ?? [];
        foreach ($backendNames as $i => $name) {
            if (empty(trim($name))) continue;
            Skill::create([
                'name'       => $name,
                'percentage' => intval($backendPcts[$i] ?? 70),
                'type'       => 'backend',
            ]);
        }

        // Process frontend skills
        $frontendNames = $validated['frontend_skills']['name'] ?? [];
        $frontendPcts  = $validated['frontend_skills']['pct'] ?? [];
        foreach ($frontendNames as $i => $name) {
            if (empty(trim($name))) continue;
            Skill::create([
                'name'       => $name,
                'percentage' => intval($frontendPcts[$i] ?? 70),
                'type'       => 'frontend',
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Skills updated successfully.',
                'data'    => Skill::all(),
            ]);
        }

        return back()->with('success', 'Skills updated successfully.');
    }
}
