# Laravel Portfolio CMS

A personal portfolio website with a complete built-in admin panel, built with **Laravel 10**, **Blade** and **MySQL**. Every visible section of the public site — hero, about, projects, skills, services, testimonials, hire banner and contact form — is managed from a single-page admin dashboard with live SEO controls, per-section visibility toggles and theme customization. No code edits are needed to run or restyle the site.

**Author & Maintainer:** [Sultan Bayezid](https://github.com/SultanBayezid) — Senior Full Stack Software Engineer, Bangladesh.

---

## Table of Contents

- [Features](#features)
- [Technology Stack](#technology-stack)
- [Requirements](#requirements)
- [Installation](#installation)
- [Default Admin Credentials](#default-admin-credentials)
- [Configuration](#configuration)
- [Project Structure](#project-structure)
- [How It Works](#how-it-works)
- [Security Notes](#security-notes)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)

---

## Features

### Public Site
- **Hero section** — display name, status badge, avatar initials with gradient, animated typing words, social links (Facebook, LinkedIn, YouTube, GitHub, website) and a customizable "Hire Me" call-to-action button.
- **About section** — bio paragraphs plus a personal info grid (name, nationality, profession, experience, contact, email, location); each row hides itself when left empty.
- **Projects grid** — portfolio items with name, live URL, GitHub URL, technologies, year, status, gradient colors and category filter chips (filter categories are editable in the admin panel).
- **Skills** — proficiency bars grouped by backend / frontend type.
- **Services** — "what I offer" cards with Bootstrap Icons.
- **Testimonials** — client reviews with name, initials and star rating.
- **Hire banner** — full-width call-to-action strip between sections.
- **Contact form** — visitors send messages straight to the admin inbox; supports configurable notification email.
- **SEO engine** — page title, meta description, keywords, canonical URL, robots, Open Graph tags, Twitter card and custom JSON-LD, all editable with a live search-preview in the admin panel.
- **Visibility control** — every section and every navbar item can be shown or hidden from the admin panel.

### Admin Panel (`/admin`)
- **Single-page dashboard** with tabbed editors for every content model.
- **Singleton editors** for Hero, About, Hire Banner, Contact and SEO records.
- **Full CRUD** for Projects and **bulk editors** for Skills, Services and Testimonials.
- **Message inbox** — list, read, mark read / mark all read, clear read and delete messages received from the contact form.
- **Settings** — site title, logo text, footer copyright, language, timezone, dark mode toggle and default, primary / secondary accent colors, heading color, background, body and heading fonts (Montserrat and other Google Fonts), and editable project filter categories.
- **Maintenance tools** — one-click cache clear, JSON export of all content, database backup and reset-to-defaults.
- **Password change** for the admin account.

### Authentication
- Laravel UI (Bootstrap) authentication scaffolding: login, registration, password reset with a custom branded reset email, and email verification views.
- Single-guard architecture with an `is_admin` flag: `AdminMiddleware` protects every `/admin` route, and non-admin users who attempt to log in are immediately logged out and redirected.

## Technology Stack

| Layer | Technology |
| --- | --- |
| Back-end | PHP 8.1+, Laravel 10 |
| Front-end | Blade templates, Bootstrap 5, Bootstrap Icons, custom CSS |
| Build tool | Vite 4 (with Laravel Vite plugin), Sass |
| Database | MySQL (configurable — Laravel supports SQLite / PostgreSQL / SQL Server) |
| Auth | Laravel UI, custom `is_admin` flag + middleware |
| Mail | Laravel Mailer (configurable in `.env`) |

## Requirements

- PHP >= 8.1 with the usual Laravel extensions (`mbstring`, `openssl`, `pdo`, `tokenizer`, `xml`, `ctype`, `json`, `bcmath`)
- Composer
- Node.js + npm (only for rebuilding front-end assets)
- MySQL (or another supported database)

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/SultanBayezid/Laravel-Portfolio-CMS.git
cd Laravel-Portfolio-CMS

# 2. Install PHP dependencies
composer install

# 3. Install front-end dependencies and build assets
npm install
npm run build

# 4. Prepare the environment file
cp .env.example .env
php artisan key:generate

# 5. Create the database and configure .env
#    (set DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 6. Run migrations and seed default content
php artisan migrate
php artisan db:seed --class=PortfolioSeeder

# 7. Start the development server
php artisan serve
```

Then open `http://127.0.0.1:8000` for the public site and `http://127.0.0.1:8000/admin` for the admin panel.

## Default Admin Credentials

The `PortfolioSeeder` creates one administrator account:

| Field | Value |
| --- | --- |
| Email | `admin@example.com` |
| Password | `password` |

> **Change these immediately after installation** — see [Security Notes](#security-notes).

The seeder also creates default Hero, About, Hire Banner, Contact, SEO, Settings and Visibility records so the site renders a complete demo page out of the box. Projects, Skills, Services and Testimonials are intentionally left empty and are managed from the admin panel.

## Configuration

| What | Where |
| --- | --- |
| Database, mail and app environment | `.env` (see `.env.example` for every option) |
| Site identity, branding and content | Admin panel → Settings / Hero / About / SEO |
| Section and navbar visibility | Admin panel → Visibility tab |
| Theme colors, fonts, dark mode | Admin panel → Theme settings |
| SEO tags, Open Graph, JSON-LD | Admin panel → SEO tab |
| Content backup / export | Admin panel → Settings → Backup / Export JSON |

## Project Structure

```
app/
├── Http/Controllers/
│   ├── HomeController.php              # Public portfolio page
│   ├── admin/                          # Admin panel controllers
│   │   ├── DashboardController.php     # Dashboard data
│   │   ├── HeroController.php          # Singleton editor
│   │   ├── AboutController.php         # Singleton editor
│   │   ├── ProjectController.php       # Full CRUD
│   │   ├── SkillController.php         # Bulk editor
│   │   ├── ServiceController.php       # Bulk editor
│   │   ├── TestimonialController.php   # Bulk editor
│   │   ├── HireBannerController.php    # Singleton editor
│   │   ├── ContactController.php       # Contact settings + public form post
│   │   ├── MessageController.php       # Contact-form inbox
│   │   ├── SeoController.php           # SEO singleton editor
│   │   ├── VisibilityController.php    # Section / nav visibility
│   │   └── SettingsController.php      # Settings, theme, backup, export
│   └── Auth/                           # Laravel UI auth controllers
├── Http/Middleware/AdminMiddleware.php # is_admin gate for /admin
├── Models/                             # Hero, About, Project, Skill, Service,
│                                       # Testimonial, Contact, Message, Seo,
│                                       # Settings, Visibility, User
└── Notifications/Auth/                 # Branded password-reset notification

database/
├── migrations/                         # 16 tables (content + auth + jobs)
└── seeders/PortfolioSeeder.php         # Default admin + demo content

resources/views/
├── portfolio/index.blade.php           # Public one-page site
├── partials/portfolio/                 # Hero, about, projects, skills, services,
│                                       # testimonials, hire banner, contact
├── admin/dashboard.blade.php           # Single-page admin dashboard
├── partials/admin/                     # Sidebar + topbar
├── layouts/                            # App / admin / auth layouts
└── emails/auth/                        # Branded password-reset email

routes/web.php                          # Public + auth + /admin route groups
```

## How It Works

1. **Public page** — `HomeController@index` loads each content model only if its `Visibility` record is enabled, then renders `portfolio/index` with section and navbar visibility maps.
2. **Admin panel** — all admin routes live under `/admin` behind the `auth` + `admin` middleware group. Singleton models (Hero, About, Hire Banner, Contact, SEO) are updated with `PUT` requests; Projects use full resource CRUD; Skills, Services and Testimonials are replaced in bulk on each save.
3. **Contact messages** — the public form posts to `ContactController@post`, which stores a `Message` row; the admin inbox lists, filters and manages them.
4. **Theme** — accent colors, fonts and dark mode are stored in the `settings` table and rendered as CSS variables, so the whole site restyles without touching code.
5. **Backups** — `SettingsController@createBackup` dumps the database into storage; `exportJson` produces a portable JSON snapshot of every content model.

## Security Notes

- Change the admin email and password from the admin panel (Settings → Password) immediately after installation.
- Set `APP_DEBUG=false` and a real `APP_URL` in production.
- Restrict your database credentials to this application only.
- Keep `vendor/`, `.env` and `storage/` out of version control (already covered by `.gitignore`).
- The contact form is public; consider rate limiting (`throttle` middleware) if you deploy it on a high-traffic domain.

## Contributing

Contributions are welcome — please read [CONTRIBUTING.md](CONTRIBUTING.md) for the workflow, code style and pull-request process.

## License

This project is open-sourced software licensed under the **MIT License** — see the [LICENSE](LICENSE) file for details. Copyright (c) 2026 Sultan Bayezid.

## Author

**Sultan Bayezid** — Senior Full Stack Software Engineer, Bangladesh

- Email: [sultanbayezidai@gmail.com](mailto:sultanbayezidai@gmail.com)
- Website: [https://lastlineweb.com](https://lastlineweb.com)
- GitHub: [https://github.com/SultanBayezid](https://github.com/SultanBayezid)
