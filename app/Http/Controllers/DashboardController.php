<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard with all section data.
     */
    public function index()
    {
        $hero = \App\Models\Hero::first();
        $settings = \App\Models\Settings::first();

        // Build typing words array from Hero model
        $typingWords = [];
        if ($hero && $hero->typing_words) {
            $typingWords = $hero->typing_words;
        }
        // If empty, provide defaults
        if (empty($typingWords)) {
            $typingWords = ['Full Stack Developer', 'Laravel Developer', 'Vue.js Developer', 'Software Engineer', 'API Developer'];
        }

        // Build backend/frontend skill arrays for the form
        $backendSkills = [];
        $frontendSkills = [];
        foreach (\App\Models\Skill::all() as $skill) {
            $arr = ['name' => $skill->name, 'pct' => $skill->percentage];
            if ($skill->type === 'backend') {
                $backendSkills[] = $arr;
            } else {
                $frontendSkills[] = $arr;
            }
        }
        // Defaults if empty
        if (empty($backendSkills)) {
            $backendSkills = [
                ['name' => 'PHP / Laravel', 'pct' => 90],
                ['name' => 'PHP / CodeIgniter', 'pct' => 88],
                ['name' => 'VueJS', 'pct' => 82],
                ['name' => 'WordPress Expert', 'pct' => 95],
                ['name' => 'MySQL / Database', 'pct' => 85],
            ];
        }
        if (empty($frontendSkills)) {
            $frontendSkills = [
                ['name' => 'JavaScript', 'pct' => 85],
                ['name' => 'HTML5 / CSS3', 'pct' => 95],
                ['name' => 'Python', 'pct' => 65],
                ['name' => 'Graphics Design', 'pct' => 80],
                ['name' => 'Video Editing', 'pct' => 78],
            ];
        }

        // Build filter categories — stored in settings as JSON or default
        $filterCategories = ['All Works', 'Web Design', 'Landing Page', 'E-commerce', 'Blog Page'];
        if ($settings && $settings->filter_categories) {
            $filterCategories = $settings->filter_categories;
        }

        return view('admin.dashboard', [
            // Dashboard stats
            'projectCount'      => \App\Models\Project::count(),
            'skillCount'        => \App\Models\Skill::count(),
            'unreadMessages'    => \App\Models\Message::where('is_read', false)->count(),
            'serviceCount'      => \App\Models\Service::count(),
            'testimonialCount'  => \App\Models\Testimonial::count(),
            'socialLinkCount'   => 4,

            // Recent activities
            'recentActivities'  => [
                ['title' => 'Hero section updated', 'detail' => 'Typing words list changed — 2 mins ago', 'color' => 'green'],
                ['title' => 'New message received', 'detail' => 'From: Rahim Ahmed — 1 hr ago', 'color' => 'accent'],
                ['title' => 'Project card added', 'detail' => 'Kabir Project published — 3 hrs ago', 'color' => 'warn'],
            ],

            // Site health
            'contentCompleteness' => 92,
            'seoScore'            => 74,
            'socialScore'         => 100,
            'liveUrlScore'        => 83,

            // Site info
            'siteDomain'  => 'lastlineweb.com',
            'framework'   => 'Laravel + Bootstrap',
            'siteStatus'  => 'Live',
            'lastUpdated' => 'Today',

            // Section models
            'hero'         => $hero,
            'about'        => \App\Models\About::first(),
            'projects'     => \App\Models\Project::orderBy('created_at', 'desc')->get(),
            'services'     => \App\Models\Service::all(),
            'hireBanner'   => \App\Models\HireBanner::first(),
            'testimonials' => \App\Models\Testimonial::all(),
            'contact'      => \App\Models\Contact::first(),
            'messages'     => \App\Models\Message::orderBy('created_at', 'desc')->paginate(10),
            'seo'          => \App\Models\Seo::first(),
            'settings'     => $settings,

            // Skill arrays for the form
            'backendSkills'   => $backendSkills,
            'frontendSkills'  => $frontendSkills,
            'typingWords'     => $typingWords,
            'filterCategories' => $filterCategories,

            // Sidebar info
            'siteInitials'    => 'SB',
            'siteName'        => 'SB Admin',
            'siteSub'         => 'Portfolio Manager',
            'userInitials'    => 'SB',
            'userRole'        => 'Administrator',
            'siteUrl'         => 'https://lastlineweb.com',
            'unreadNotifications' => 1,

            // Visibility data
            'sectionVisibility' => [
                'hero'          => ['name' => 'Hero Section', 'description' => 'Main landing / intro block', 'visible' => true],
                'about'         => ['name' => 'About Me Section', 'description' => 'Bio and personal info', 'visible' => true],
                'projects'      => ['name' => 'Projects Section', 'description' => 'Portfolio showcase grid', 'visible' => true],
                'hirebanner'    => ['name' => 'Hire Me Banner', 'description' => 'Full-width CTA between sections', 'visible' => true],
                'skills'        => ['name' => 'Skills Section', 'description' => 'Proficiency progress bars', 'visible' => true],
                'services'      => ['name' => 'Services Section', 'description' => 'What I offer cards', 'visible' => true],
                'testimonials'  => ['name' => 'Testimonials Section', 'description' => 'Client reviews', 'visible' => true],
                'contact'       => ['name' => 'Contact Section', 'description' => 'Get in touch form', 'visible' => true],
            ],
            'navVisibility' => [
                'home'         => ['name' => 'Home', 'visible' => true],
                'about'        => ['name' => 'About', 'visible' => true],
                'projects'     => ['name' => 'Projects', 'visible' => true],
                'skills'       => ['name' => 'Skills', 'visible' => true],
                'services'     => ['name' => 'Services', 'visible' => true],
                'testimonials' => ['name' => 'Testimonials', 'visible' => true],
                'contact'      => ['name' => 'Contact', 'visible' => true],
            ],
        ]);
    }
}
