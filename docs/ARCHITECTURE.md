# Architecture Documentation

This document describes the internal architecture of Laravel Portfolio CMS. It is written for developers who want to understand, extend or debug the application.

## 1. Overview

Laravel Portfolio CMS is a monolithic Laravel 10 application with two faces:

- a **public one-page portfolio** rendered by `HomeController` from database-managed content, and
- a **single-page admin dashboard** at `/admin` that edits every piece of that content.

There is no public REST API; all content management happens through authenticated web routes.

**Technology:** PHP 8.1+ / Laravel 10, Blade, MySQL, Bootstrap 5, Vite.

## 2. Database Schema

Sixteen tables are created by the migrations in `database/migrations/`.

### Content tables

| Table | Purpose | Notes |
| --- | --- | --- |
| `heroes` | Hero section content | Singleton (id 1). Display name, badge, avatar initials/gradient, social URLs, typing words (array cast), button labels, blob colors |
| `abouts` | About section content | Singleton. Bio paragraphs + personal info grid; nullable rows render conditionally |
| `projects` | Portfolio items | Full CRUD. `categories` and `technologies` are string lists; visuals are gradient colors + initials (no file uploads) |
| `skills` | Proficiency bars | `name`, `percentage`, `type` enum (`backend`/`frontend`) |
| `services` | Service cards | `title`, `icon` (Bootstrap Icon class), `description` |
| `testimonials` | Client reviews | `name`, `initials`, `rating`, `review` |
| `hire_banners` | CTA banner strip | Singleton. Heading, subtext, button label/url/icon, gradient colors, visibility |
| `contacts` | Contact section config | Singleton. Labels, subtext, field toggles, notification email |
| `messages` | Contact form submissions | Sender name/email/subject/message, read flag, timestamps |
| `seos` | SEO settings | Singleton. Title, meta description, keywords, canonical, robots, Open Graph, Twitter card, JSON-LD |
| `settings` | Global site settings | Singleton. Site title/logo, copyright, language, timezone, dark mode, accent colors, fonts, filter categories (array cast) |
| `visibilities` | Section / nav toggles | `section_key`, `section_name`, `type` (`section`/`nav`), `visible` flag |

### Framework tables

`users` (with `is_admin` boolean), `password_reset_tokens`, `failed_jobs`, `personal_access_tokens`.

### Data model patterns

- **Singletons** (Hero, About, HireBanner, Contact, Seo, Settings) always operate on row id 1 through `first()` / `firstOrCreate()`.
- **List models** (Project, Skill, Service, Testimonial, Message) use standard Eloquent collections.
- **Array casts**: `heroes.typing_words` and `settings.filter_categories` are cast to PHP arrays so Blade can iterate them directly.

## 3. Routing Architecture

All routes live in `routes/web.php` and are organized in four groups:

1. **Public** — `GET /` (`HomeController@index`, name `home`) and `POST /contact/post` (`ContactController@post`), the only unauthenticated write endpoint.
2. **Guest auth** — login, register, password reset (middleware `guest`).
3. **Authenticated auth** — logout, password confirm, email verification (middleware `auth`).
4. **Admin** — everything under the `/admin` prefix with middleware `['auth', 'admin']` and route name prefix `admin.`:
   - `PUT` endpoints for the singletons (hero, about, hirebanner, contact, seo, visibility)
   - resource routes for `projects` (store/update/destroy) and bulk updates for skills/services/testimonials
   - the messages inbox (index, show, markRead, markAllRead, clearRead, destroy)
   - settings operations (update, updateTheme, updatePassword, updateFilters, exportJson, createBackup, clearCache, resetDefaults)

## 4. Controller Architecture

| Controller | Pattern |
| --- | --- |
| `HomeController` | Loads only visible sections (via `Visibility` lookups) and renders the public page |
| `Admin\DashboardController` | Assembles dashboard summary data (counts, site info, user info) |
| `Admin\HeroController`, `AboutController`, `HireBannerController`, `ContactController`, `SeoController` | Singleton updaters: validate → `first()->update()` |
| `Admin\ProjectController` | Full resource CRUD with JSON support for AJAX submissions |
| `Admin\SkillController`, `ServiceController`, `TestimonialController` | Bulk replacement: the dashboard posts the entire list and the controller re-creates the rows |
| `Admin\MessageController` | Inbox management (read flags, bulk actions) |
| `Admin\SettingsController` | Multi-operation: general settings, theme, password, filters, JSON export, backup, cache clear, reset |
| `Admin\VisibilityController` | Persists per-section and per-navbar-item visibility |

## 5. Authentication & Authorization

- Laravel UI provides the Bootstrap auth scaffolding (login, register, reset, verify).
- A single guard is used for everyone; `users.is_admin` (boolean cast) distinguishes the administrator.
- `AdminMiddleware` checks `auth()->user()->isAdmin()` and aborts non-admins from all `/admin` routes.
- `LoginController` adds a second line of defense: after a successful login attempt, a non-admin user is logged out immediately and redirected back with an error, so the admin panel stays unreachable even if a regular account somehow authenticates.
- `User::sendPasswordResetNotification()` is overridden to send a custom branded reset mail (`Notifications\Auth\ResetPasswordNotification`, view `emails/auth/reset-password`).

## 6. Visibility System

`HomeController` builds two maps from the `visibilities` table:

- `sectionVisibility` — keyed by section (`hero`, `about`, `projects`, `skills`, `services`, `hirebanner`, `testimonials`, `contact`)
- `navVisibility` — keyed by navbar item (`home`, `about`, `projects`, …; stored with a `nav_` prefix)

A disabled section is simply not queried; a disabled navbar link is not rendered. Toggling happens in the admin dashboard and takes effect on the next page load.

## 7. Theme System

The `settings` row stores accent colors (`primary_accent`, `secondary_accent`, `heading_color`, `background`), fonts (`body_font`, `heading_font`), dark mode flags and filter categories. The layout templates render these as CSS custom properties on the page root, so the entire public site restyles instantly without rebuilding assets.

## 8. Seeding & Maintenance

- `PortfolioSeeder` creates the admin user (`admin@example.com` / `password` — change after install), all six singletons with demo content and every visibility record. Content list models are intentionally not seeded.
- `SettingsController@createBackup` writes a database dump to storage; `exportJson` serializes all content models to a downloadable JSON snapshot; `clearCache` flushes framework caches; `resetDefaults` wipes content back to a clean state.

## 9. Front-End Build

Vite compiles `resources/css/app.css` and `resources/js/app.js` (Bootstrap 5 + Sass). The public portfolio additionally ships a hand-written stylesheet at `public/frontend/css/styles.css` with the theme's CSS variables, and the admin dashboard uses Bootstrap Icons. No front-end framework is required.
