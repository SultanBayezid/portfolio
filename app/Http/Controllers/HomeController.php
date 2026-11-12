<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\About;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Service;
use App\Models\HireBanner;
use App\Models\Testimonial;
use App\Models\Contact;
use App\Models\Seo;
use App\Models\Settings;
use App\Models\Visibility;

class HomeController extends Controller
{
    /**
     * Display the public portfolio homepage.
     */
    public function index()
    {
        // Build visibility lookups
        $sectionVisibility = Visibility::sections()->get()->keyBy('section_key');
        $navVisibilityRaw = Visibility::nav()->get()->keyBy('section_key');

        // Only load sections that are visible
        $hero         = ($sectionVisibility['hero']->visible ?? true) ? Hero::first() : null;
        $about        = ($sectionVisibility['about']->visible ?? true) ? About::first() : null;
        $projects     = ($sectionVisibility['projects']->visible ?? true) ? Project::all() : collect();
        $skills       = ($sectionVisibility['skills']->visible ?? true) ? Skill::all() : collect();
        $services     = ($sectionVisibility['services']->visible ?? true) ? Service::all() : collect();
        $hireBanner   = ($sectionVisibility['hirebanner']->visible ?? true) ? HireBanner::first() : null;
        $testimonials = ($sectionVisibility['testimonials']->visible ?? true) ? Testimonial::all() : collect();
        $contact      = ($sectionVisibility['contact']->visible ?? true) ? Contact::first() : null;

        // Always load SEO and Settings
        $seo      = Seo::first();
        $settings = Settings::first();

        // Build filter categories from settings
        $filterCategories = $settings?->filter_categories ?? ['All Works', 'Web Design', 'Landing Page', 'E-commerce', 'Blog Page'];

        // Prepare nav visibility as simple array
        // Nav keys are stored with "nav_" prefix in the database
        $navVisibility = [];
        foreach (['home','about','projects','skills','services','testimonials','contact'] as $key) {
            $navVisibility[$key] = [
                'visible' => ($navVisibilityRaw['nav_' . $key]->visible ?? true),
            ];
        }

        return view('portfolio.index', compact(
            'hero', 'about', 'projects', 'skills', 'services',
            'hireBanner', 'testimonials', 'contact', 'seo', 'settings',
            'navVisibility', 'sectionVisibility', 'filterCategories'
        ));
    }
}
