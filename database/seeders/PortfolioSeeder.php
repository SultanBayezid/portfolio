<?php

namespace Database\Seeders;

use App\Models\Hero;
use App\Models\About;
use App\Models\HireBanner;
use App\Models\Contact;
use App\Models\Seo;
use App\Models\Settings;
use App\Models\Visibility;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PortfolioSeeder extends Seeder
{
    /**
     * Seed the database with default portfolio data.
     */
    public function run(): void
    {
        // Create admin user
        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Sultan Bayezid',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        // Create Hero record
        Hero::firstOrCreate(
            ['id' => 1],
            [
                'display_name' => 'Sultan Bayezid',
                'status_badge' => 'Available for projects',
                'avatar_initials' => 'SB',
                'sub_line' => 'Sultan',
                'hire_btn_label' => 'Hire Me',
                'hire_btn_url' => 'https://lastlineweb.com',
                'view_work_label' => 'View Work',
                'view_work_target' => '#projects',
                'facebook_url' => null,
                'linkedin_url' => null,
                'youtube_url' => null,
                'github_url' => 'https://github.com/SultanBayezid',
                'website_url' => 'https://lastlineweb.com',
                'typing_words' => ['Full Stack Developer', 'Laravel Developer', 'Vue.js Developer', 'Software Engineer', 'API Developer'],
                'section_label' => 'Available for projects',
                'blob_color_1' => '#dbeafe',
                'blob_color_2' => '#ede9fe',
                'avatar_gradient' => '#4f63f0',
            ]
        );

        // Create About record
        About::firstOrCreate(
            ['id' => 1],
            [
                'section_label' => 'About Me',
                'section_title' => 'Senior Full Stack Software Engineer',
                'paragraph_1' => 'Hi, my name is Sultan Bayezid and I am a Senior Full Stack Software Engineer from Bangladesh. I design and build complete web applications — from clean, responsive front-ends to robust, well-structured back-ends and APIs — using modern technologies such as Laravel, Vue.js, MySQL and PostgreSQL.',
                'paragraph_2' => 'I focus on delivering maintainable, high-quality solutions with clear communication and reliable delivery. Every section of this site is managed through the built-in admin panel — no code edits needed. Feel free to get in touch any time.',
                'name' => 'Sultan Bayezid',
                'place_of_birth' => null,
                'nationality' => 'Bangladeshi',
                'marital_status' => null,
                'profession' => 'Senior Full Stack Software Engineer',
                'contact_no' => '+880 1XXX-XXXXXX',
                'email' => 'sultanbayezidai@gmail.com',
                'location' => 'Bangladesh',
                'experience' => '5+ Years',
            ]
        );

        // Create Hire Banner record
        HireBanner::firstOrCreate(
            ['id' => 1],
            [
                'heading' => "I'm available for projects",
                'subtext' => "Looking for a full-stack developer for your next big idea? Let's build something great together.",
                'button_label' => 'Hire Me',
                'button_url' => 'https://lastlineweb.com',
                'button_icon' => 'bi-send',
                'visible' => true,
                'gradient_start' => '#4f63f0',
                'gradient_end' => '#10b98a',
            ]
        );

        // Create Contact record
        Contact::firstOrCreate(
            ['id' => 1],
            [
                'section_label' => 'Contact',
                'section_heading' => 'Get In Touch',
                'subtext' => "Have a project in mind? I'd love to hear from you. Send a message and I'll get back to you shortly.",
                'button_label' => 'Send Message',
                'show_name' => true,
                'show_email' => true,
                'show_subject' => true,
                'show_message' => true,
            ]
        );

        // Create SEO record
        Seo::firstOrCreate(
            ['id' => 1],
            [
                'page_title' => 'Sultan Bayezid — Senior Full Stack Software Engineer',
                'meta_description' => 'Senior Full Stack Software Engineer specializing in Laravel, Vue.js and modern web application development. Available for projects.',
                'keywords' => 'sultan bayezid, full stack developer, laravel, vue js, software engineer, bangladesh',
                'canonical_url' => 'https://lastlineweb.com',
                'robots' => 'index, follow',
                'og_title' => 'Sultan Bayezid — Senior Full Stack Software Engineer',
                'og_description' => 'Hire a senior full stack software engineer for your next project. Specializing in Laravel, Vue.js and modern web stacks.',
                'twitter_card' => 'summary_large_image',
                'schema_type' => 'Person',
            ]
        );

        // Create Settings record
        Settings::firstOrCreate(
            ['id' => 1],
            [
                'site_title' => 'Sultan Bayezid — Portfolio',
                'site_logo' => 'Sultan Bayezid',
                'copyright' => '© 2026 Sultan Bayezid. All rights reserved.',
                'language' => 'English',
                'timezone' => 'Asia/Dhaka',
                'dark_mode_toggle' => false,
                'dark_mode_default' => false,
                'primary_accent' => '#4f63f0',
                'secondary_accent' => '#10b98a',
                'heading_color' => '#1a1d2e',
                'background' => '#ffffff',
                'body_font' => 'Montserrat',
                'heading_font' => 'Montserrat',
                'filter_categories' => ['All Works', 'Web Design', 'Landing Page', 'E-commerce', 'Blog Page'],
            ]
        );

        // Create Visibility records for sections
        $sections = [
            ['section_key' => 'hero', 'section_name' => 'Hero Section', 'description' => 'Main landing / intro block', 'type' => 'section'],
            ['section_key' => 'about', 'section_name' => 'About Me Section', 'description' => 'Bio and personal info', 'type' => 'section'],
            ['section_key' => 'projects', 'section_name' => 'Projects Section', 'description' => 'Portfolio showcase grid', 'type' => 'section'],
            ['section_key' => 'hirebanner', 'section_name' => 'Hire Me Banner', 'description' => 'Full-width CTA between sections', 'type' => 'section'],
            ['section_key' => 'skills', 'section_name' => 'Skills Section', 'description' => 'Proficiency progress bars', 'type' => 'section'],
            ['section_key' => 'services', 'section_name' => 'Services Section', 'description' => 'What I offer cards', 'type' => 'section'],
            ['section_key' => 'testimonials', 'section_name' => 'Testimonials Section', 'description' => 'Client reviews', 'type' => 'section'],
            ['section_key' => 'contact', 'section_name' => 'Contact Section', 'description' => 'Get in touch form', 'type' => 'section'],
        ];

        foreach ($sections as $section) {
            Visibility::firstOrCreate(
                ['section_key' => $section['section_key']],
                $section
            );
        }

        // Create Visibility records for nav items
        $navItems = [
            ['section_key' => 'nav_home', 'section_name' => 'Home', 'description' => 'Links to #home', 'type' => 'nav'],
            ['section_key' => 'nav_about', 'section_name' => 'About', 'description' => 'Links to #about', 'type' => 'nav'],
            ['section_key' => 'nav_projects', 'section_name' => 'Projects', 'description' => 'Links to #projects', 'type' => 'nav'],
            ['section_key' => 'nav_skills', 'section_name' => 'Skills', 'description' => 'Links to #skills', 'type' => 'nav'],
            ['section_key' => 'nav_services', 'section_name' => 'Services', 'description' => 'Links to #services', 'type' => 'nav'],
            ['section_key' => 'nav_testimonials', 'section_name' => 'Testimonials', 'description' => 'Links to #testimonials', 'type' => 'nav'],
            ['section_key' => 'nav_contact', 'section_name' => 'Contact', 'description' => 'Links to #contact', 'type' => 'nav'],
        ];

        foreach ($navItems as $nav) {
            Visibility::firstOrCreate(
                ['section_key' => $nav['section_key']],
                $nav
            );
        }
    }
}
