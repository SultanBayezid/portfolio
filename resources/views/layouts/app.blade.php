<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', $settings->language ?? 'en') }}" data-bs-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- ── Dynamic SEO Meta Tags ── --}}
<meta name="description" content="{{ $seo->meta_description ?? '' }}">
<meta name="keywords" content="{{ $seo->keywords ?? '' }}">
<meta name="robots" content="{{ $seo->robots ?? 'index, follow' }}">
@if($seo->canonical_url ?? '')<link rel="canonical" href="{{ $seo->canonical_url }}">@endif
<meta property="og:title" content="{{ $seo->og_title ?? $seo->page_title ?? '' }}">
<meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">
@if($seo->og_image ?? '')<meta property="og:image" content="{{ $seo->og_image }}">@endif
<meta property="og:type" content="website">
<meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
@if($seo->twitter_handle ?? '')<meta name="twitter:site" content="{{ $seo->twitter_handle }}">@endif
<title>{{ $seo->page_title ?? ($settings->site_title ?? 'Portfolio') }}</title>

{{-- ── Google Fonts ── --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family={{ urlencode($settings->body_font ?? 'Inter') }}:wght@300;400;500;600;700;800&family={{ urlencode($settings->heading_font ?? 'Inter') }}:wght@400;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">

{{-- ── Bootstrap 5 + Icons ── --}}
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

@stack('head-styles')

<style>
/* ══════════════════════════════════════════════════════════════
   CSS CUSTOM PROPERTIES — Original Design System (--clr-*)
   ══════════════════════════════════════════════════════════════ */
:root {
  --clr-bg: #f7f8fc;
  --clr-surface: #eef0f7;
  --clr-card: #ffffff;
  --clr-border: rgba(30,40,100,0.09);
  --clr-border-hover: rgba(30,40,100,0.22);
  --clr-accent: {{ $settings->primary_accent ?? '#2563eb' }};
  --clr-accent-light: #eff4ff;
  --clr-accent2: {{ $settings->secondary_accent ?? '#7c3aed' }};
  --clr-accent2-light: #f3eeff;
  --clr-text: {{ $settings->heading_color ?? '#111827' }};
  --clr-muted: #6b7280;
  --clr-faint: rgba(37,99,235,0.07);
  --nav-h: 68px;
  --radius: 16px;
  --radius-sm: 10px;
  --shadow: 0 2px 20px rgba(30,40,100,0.07);
  --shadow-md: 0 6px 32px rgba(30,40,100,0.11);

  /* Legacy aliases for partials backward-compat */
  --accent: var(--clr-accent);
  --accent2: var(--clr-accent2);
  --accent-light: var(--clr-accent-light);
  --accent2-light: var(--clr-accent2-light);
  --bg: var(--clr-card);
  --bg2: var(--clr-surface);
  --bg3: var(--clr-surface);
  --txt: var(--clr-text);
  --muted: var(--clr-muted);
  --bd: var(--clr-border);
  --bd2: var(--clr-border-hover);
  --faint: var(--clr-faint);
  --heading-color: var(--clr-text);
  --font: '{{ $settings->body_font ?? 'Inter' }}', sans-serif;
  --hfont: '{{ $settings->heading_font ?? 'Inter' }}', sans-serif;
  --mono: 'JetBrains Mono', monospace;
}

/* Dark mode overrides */
[data-bs-theme="dark"] {
  --clr-bg: #0f1117;
  --clr-surface: #181b25;
  --clr-card: #1e2130;
  --clr-border: rgba(255,255,255,0.08);
  --clr-border-hover: rgba(255,255,255,0.18);
  --clr-accent-light: rgba(37,99,235,0.15);
  --clr-accent2-light: rgba(124,58,237,0.15);
  --clr-text: #e4e6f0;
  --clr-muted: #9ca3af;
  --clr-faint: rgba(37,99,235,0.12);
  /* Legacy aliases dark */
  --bg: var(--clr-card);
  --bg2: var(--clr-surface);
  --bg3: var(--clr-surface);
  --txt: var(--clr-text);
  --muted: var(--clr-muted);
  --bd: var(--clr-border);
  --bd2: var(--clr-border-hover);
  --heading-color: var(--clr-text);
}

/* ══════════════════════════════════════════════════════════════
   BASE RESET & GLOBAL
   ══════════════════════════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; scroll-padding-top: calc(var(--nav-h) + 20px); }
body {
  font-family: var(--font);
  background: var(--clr-bg);
  color: var(--clr-text);
  overflow-x: hidden;
  line-height: 1.7;
  transition: background 0.35s ease, color 0.35s ease;
}

/* ── Custom Scrollbar ── */
::-webkit-scrollbar { width: 8px; }
::-webkit-scrollbar-track { background: var(--clr-surface); }
::-webkit-scrollbar-thumb { background: var(--clr-border-hover); border-radius: 10px; }
::-webkit-scrollbar-thumb:hover { background: var(--clr-accent); }

/* ══════════════════════════════════════════════════════════════
   NAVBAR
   ══════════════════════════════════════════════════════════════ */
.portfolio-nav {
  position: fixed;
  top: 0; left: 0; right: 0;
  z-index: 1050;
  height: var(--nav-h);
  background: rgba(247,248,252,0.92);
  backdrop-filter: blur(14px);
  -webkit-backdrop-filter: blur(14px);
  border-bottom: 1px solid var(--clr-border);
  transition: box-shadow 0.3s ease, background 0.3s ease;
}
[data-bs-theme="dark"] .portfolio-nav {
  background: rgba(15,17,23,0.92);
}
.portfolio-nav.scrolled {
  box-shadow: var(--shadow-md);
}
.portfolio-nav .container {
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

/* Brand */
.nav-brand {
  font-family: var(--hfont);
  font-weight: 800;
  font-size: 22px;
  color: var(--clr-text);
  text-decoration: none;
  letter-spacing: -0.03em;
  display: flex;
  align-items: center;
  gap: 2px;
}
.nav-brand .brand-underscore {
  color: var(--clr-accent);
  font-weight: 800;
}
.nav-brand .brand-at {
  color: var(--clr-accent2);
  font-weight: 800;
}
.nav-brand:hover { color: var(--clr-text); }

/* Desktop nav links with icon+text */
.nav-links-desktop {
  display: flex;
  align-items: center;
  gap: 4px;
}
.nav-link-f {
  font-size: 13.5px;
  font-weight: 600;
  color: var(--clr-muted);
  text-decoration: none;
  padding: 8px 14px;
  border-radius: var(--radius-sm);
  transition: all 0.15s ease;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  white-space: nowrap;
  position: relative;
}
.nav-link-f i { font-size: 15px; }
.nav-link-f:hover,
.nav-link-f.active {
  color: var(--clr-accent);
  background: var(--clr-faint);
}
.nav-link-f.active::after {
  content: '';
  position: absolute;
  bottom: 2px;
  left: 50%;
  transform: translateX(-50%);
  width: 18px;
  height: 3px;
  border-radius: 3px;
  background: var(--clr-accent);
}

/* Dark-mode toggle button */
.dark-toggle {
  width: 38px;
  height: 38px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--clr-border);
  background: var(--clr-surface);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--clr-muted);
  font-size: 16px;
  transition: all 0.15s ease;
  margin-left: 8px;
}
.dark-toggle:hover {
  border-color: var(--clr-border-hover);
  color: var(--clr-text);
  background: var(--clr-card);
}

/* Hamburger */
.hamburger-btn {
  width: 38px;
  height: 38px;
  border-radius: var(--radius-sm);
  border: 1px solid var(--clr-border);
  background: var(--clr-surface);
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  color: var(--clr-muted);
  font-size: 22px;
  transition: all 0.15s ease;
}
.hamburger-btn:hover {
  border-color: var(--clr-accent);
  color: var(--clr-accent);
}
.hamburger-btn .bi-x { display: none; }
.hamburger-btn.open .bi-list { display: none; }
.hamburger-btn.open .bi-x { display: inline; }

/* Mobile dropdown nav */
.mobile-nav-dropdown {
  display: none;
  padding: 12px 16px 16px;
  border-top: 1px solid var(--clr-border);
  background: inherit;
}
.mobile-nav-dropdown.open { display: block; }
.mobile-nav-dropdown .nav-link-f {
  padding: 10px 14px;
  border-radius: var(--radius-sm);
  width: 100%;
}
.mobile-nav-dropdown .nav-link-f i { width: 20px; text-align: center; }

/* ══════════════════════════════════════════════════════════════
   SECTIONS — BASE
   ══════════════════════════════════════════════════════════════ */
section { padding: 80px 0; position: relative; }

.section-label {
  font-size: 12px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.12em;
  color: var(--clr-accent);
  margin-bottom: 8px;
  display: inline-block;
}
.section-title {
  font-family: var(--hfont);
  font-size: clamp(26px, 4vw, 38px);
  font-weight: 800;
  color: var(--heading-color);
  margin-bottom: 16px;
  letter-spacing: -0.02em;
}
[data-bs-theme="dark"] .section-title { color: var(--clr-text); }

/* ══════════════════════════════════════════════════════════════
   HERO SECTION
   ══════════════════════════════════════════════════════════════ */
#hero {
  min-height: 100vh;
  display: flex;
  align-items: center;
  padding-top: var(--nav-h);
  position: relative;
  overflow: hidden;
}

/* Blobs */
.hero-blob {
  position: absolute;
  border-radius: 50%;
  filter: blur(80px);
  opacity: 0.30;
  animation: blobFloat 8s ease-in-out infinite;
  pointer-events: none;
}
.hero-blob-1 { width: 500px; height: 500px; top: -100px; right: -100px; }
.hero-blob-2 { width: 400px; height: 400px; bottom: -80px; left: -80px; animation-delay: 4s; }
@keyframes blobFloat {
  0%, 100% { transform: translate(0, 0) scale(1); }
  50% { transform: translate(30px, -30px) scale(1.05); }
}

/* Decorative dots */
.hero-dots {
  position: absolute;
  inset: 0;
  background-image: radial-gradient(circle, var(--clr-border) 1px, transparent 1px);
  background-size: 40px 40px;
  opacity: 0.45;
  pointer-events: none;
}

/* Status badge */
.hero-badge {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 13px;
  font-weight: 700;
  color: var(--clr-accent);
  background: var(--clr-accent-light);
  border: 1px solid rgba(37,99,235,0.2);
  padding: 6px 16px;
  border-radius: 20px;
  margin-bottom: 20px;
}
.hero-badge .dot {
  width: 8px;
  height: 8px;
  background: var(--clr-accent2);
  border-radius: 50%;
  animation: pulse 1.6s infinite;
}
@keyframes pulse {
  0%, 100% { opacity: 1; }
  50% { opacity: 0.3; }
}

/* Name & typing */
.hero-name {
  font-family: var(--hfont);
  font-size: clamp(36px, 6vw, 64px);
  font-weight: 800;
  line-height: 1.08;
  letter-spacing: -0.03em;
  color: var(--heading-color);
  margin-bottom: 4px;
}
[data-bs-theme="dark"] .hero-name { color: var(--clr-text); }

.hero-sub {
  font-size: clamp(16px, 2.5vw, 22px);
  font-weight: 600;
  color: var(--clr-muted);
  margin-bottom: 4px;
  min-height: 1.6em;
}

/* Typing cursor */
.typing-cursor {
  display: inline-block;
  width: 3px;
  height: 1em;
  background: var(--clr-accent);
  margin-left: 2px;
  animation: blink 0.8s step-end infinite;
  vertical-align: text-bottom;
}
@keyframes blink {
  0%, 100% { opacity: 1; }
  50% { opacity: 0; }
}

/* Avatar */
.hero-avatar {
  width: 180px;
  height: 180px;
  border-radius: 24px;
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 56px;
  font-weight: 800;
  font-family: var(--mono);
  color: #fff;
  box-shadow: 0 12px 40px rgba(37,99,235,0.20);
  animation: avatarFloat 4s ease-in-out infinite;
  position: relative;
}
.hero-avatar::after {
  content: '';
  position: absolute;
  inset: -4px;
  border-radius: 28px;
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  z-index: -1;
  opacity: 0.25;
  filter: blur(12px);
  animation: avatarFloat 4s ease-in-out infinite reverse;
}
@keyframes avatarFloat {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}

/* Hero buttons */
.btn-hero {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 12px 28px;
  border-radius: var(--radius-sm);
  font-weight: 700;
  font-size: 14px;
  font-family: var(--font);
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
}
.btn-hero-primary {
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  color: #fff;
  border: none;
  box-shadow: 0 4px 16px rgba(37,99,235,0.25);
}
.btn-hero-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(37,99,235,0.35);
  color: #fff;
}
.btn-hero-outline {
  background: transparent;
  color: var(--clr-accent);
  border: 2px solid var(--clr-accent);
}
.btn-hero-outline:hover {
  background: var(--clr-faint);
  color: var(--clr-accent);
}

/* Social links */
.social-link {
  width: 42px;
  height: 42px;
  border-radius: var(--radius-sm);
  display: flex;
  align-items: center;
  justify-content: center;
  border: 1px solid var(--clr-border);
  color: var(--clr-muted);
  font-size: 18px;
  text-decoration: none;
  transition: all 0.15s ease;
  background: var(--clr-card);
}
.social-link:hover {
  border-color: var(--clr-accent);
  color: var(--clr-accent);
  background: var(--clr-faint);
  transform: translateY(-2px);
}

/* ══════════════════════════════════════════════════════════════
   ABOUT SECTION
   ══════════════════════════════════════════════════════════════ */
.about-info-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 0;
}
.about-info-item {
  display: flex;
  gap: 10px;
  padding: 12px 0;
  border-bottom: 1px solid var(--clr-border);
}
.about-info-item .label {
  font-size: 13px;
  font-weight: 700;
  color: var(--clr-muted);
  min-width: 120px;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.about-info-item .value {
  font-size: 14px;
  font-weight: 600;
}

/* ══════════════════════════════════════════════════════════════
   PROJECTS SECTION
   ══════════════════════════════════════════════════════════════ */
.filter-btn {
  font-size: 13px;
  font-weight: 700;
  padding: 8px 20px;
  border-radius: 20px;
  border: 1.5px solid var(--clr-border);
  background: var(--clr-card);
  color: var(--clr-muted);
  cursor: pointer;
  transition: all 0.15s ease;
  font-family: var(--font);
}
.filter-btn:hover,
.filter-btn.active {
  border-color: var(--clr-accent);
  color: var(--clr-accent);
  background: var(--clr-faint);
}

.project-card {
  background: var(--clr-card);
  border: 1px solid var(--clr-border);
  border-radius: var(--radius);
  overflow: hidden;
  transition: all 0.25s ease;
  position: relative;
}
.project-card:hover {
  border-color: var(--clr-border-hover);
  box-shadow: var(--shadow-md);
  transform: translateY(-4px);
}

/* Project thumb with hover overlay */
.project-thumb {
  height: 200px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 48px;
  font-weight: 800;
  font-family: var(--mono);
  color: #fff;
  position: relative;
  overflow: hidden;
}
.project-thumb .project-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.55);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  opacity: 0;
  transition: opacity 0.3s ease;
}
.project-card:hover .project-overlay { opacity: 1; }
.project-overlay a {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background: rgba(255,255,255,0.2);
  backdrop-filter: blur(6px);
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-size: 16px;
  text-decoration: none;
  transition: background 0.15s;
}
.project-overlay a:hover { background: var(--clr-accent); }

.project-body { padding: 20px; }
.project-title { font-size: 16px; font-weight: 800; margin-bottom: 6px; }
.project-desc { font-size: 13px; color: var(--clr-muted); line-height: 1.6; margin-bottom: 12px; }

.tag {
  font-size: 11px;
  font-weight: 700;
  padding: 3px 10px;
  border-radius: 20px;
  background: var(--clr-accent-light);
  color: var(--clr-accent);
  border: 1px solid rgba(37,99,235,0.15);
  white-space: nowrap;
}
.tag-warn {
  background: rgba(217,119,6,0.08);
  color: #d97706;
  border-color: rgba(217,119,6,0.15);
}

/* ══════════════════════════════════════════════════════════════
   HIRE BANNER
   ══════════════════════════════════════════════════════════════ */
.hire-section {
  padding: 60px 0;
  position: relative;
  overflow: hidden;
}
.hire-banner {
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  border-radius: 20px;
  padding: 50px 40px;
  color: #fff;
  position: relative;
  overflow: hidden;
}
.hire-banner::before {
  content: '';
  position: absolute;
  top: -60px; right: -60px;
  width: 250px; height: 250px;
  background: rgba(255,255,255,0.08);
  border-radius: 50%;
}
.hire-banner::after {
  content: '';
  position: absolute;
  bottom: -40px; left: -40px;
  width: 180px; height: 180px;
  background: rgba(255,255,255,0.05);
  border-radius: 50%;
}
.hire-heading {
  font-size: clamp(24px, 3.5vw, 36px);
  font-weight: 800;
  margin-bottom: 12px;
  position: relative;
  z-index: 1;
}
.hire-subtext {
  font-size: 16px;
  opacity: 0.88;
  margin-bottom: 24px;
  position: relative;
  z-index: 1;
  line-height: 1.7;
}
.btn-hire {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  padding: 14px 32px;
  border-radius: 12px;
  font-weight: 700;
  font-size: 15px;
  font-family: var(--font);
  cursor: pointer;
  transition: all 0.2s ease;
  text-decoration: none;
  background: rgba(255,255,255,0.2);
  border: 2px solid rgba(255,255,255,0.4);
  color: #fff;
  position: relative;
  z-index: 1;
}
.btn-hire:hover {
  background: rgba(255,255,255,0.3);
  color: #fff;
  transform: translateY(-2px);
}

/* ══════════════════════════════════════════════════════════════
   SKILLS SECTION
   ══════════════════════════════════════════════════════════════ */
.skill-bar-wrap { margin-bottom: 16px; }
.skill-name {
  font-size: 14px;
  font-weight: 700;
  margin-bottom: 6px;
  display: flex;
  justify-content: space-between;
}
.skill-name span {
  font-family: var(--mono);
  font-size: 13px;
  color: var(--clr-accent);
  font-weight: 700;
}
.skill-bar {
  height: 8px;
  background: var(--clr-surface);
  border-radius: 10px;
  overflow: hidden;
}
.skill-fill {
  height: 100%;
  background: linear-gradient(90deg, var(--clr-accent), var(--clr-accent2));
  border-radius: 10px;
  width: 0;
  transition: width 1.2s cubic-bezier(0.22, 0.61, 0.36, 1);
}
.skill-fill.animated { /* width set inline */ }

/* ══════════════════════════════════════════════════════════════
   SERVICES SECTION
   ══════════════════════════════════════════════════════════════ */
.service-card {
  background: var(--clr-card);
  border: 1px solid var(--clr-border);
  border-radius: var(--radius);
  padding: 28px 24px;
  text-align: center;
  transition: all 0.25s ease;
}
.service-card:hover {
  border-color: var(--clr-accent);
  box-shadow: var(--shadow-md);
  transform: translateY(-4px);
}
.service-icon {
  width: 60px;
  height: 60px;
  border-radius: 14px;
  background: var(--clr-accent-light);
  color: var(--clr-accent);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 26px;
  margin: 0 auto 18px;
}
.service-title { font-size: 16px; font-weight: 800; margin-bottom: 8px; }
.service-desc { font-size: 13px; color: var(--clr-muted); line-height: 1.7; }

/* ══════════════════════════════════════════════════════════════
   TESTIMONIALS SECTION
   ══════════════════════════════════════════════════════════════ */
.testimonial-card {
  background: var(--clr-card);
  border: 1px solid var(--clr-border);
  border-radius: var(--radius);
  padding: 28px;
  transition: all 0.25s ease;
}
.testimonial-card:hover {
  border-color: var(--clr-border-hover);
  box-shadow: 0 6px 24px rgba(0,0,0,0.06);
}
.testimonial-text {
  font-size: 14px;
  line-height: 1.8;
  color: var(--clr-text);
  margin-bottom: 18px;
  font-style: italic;
}
.testimonial-avatar {
  width: 44px;
  height: 44px;
  border-radius: var(--radius-sm);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 13px;
  font-weight: 800;
  font-family: var(--mono);
  color: #fff;
  flex-shrink: 0;
}
.testimonial-name { font-size: 14px; font-weight: 800; }
.testimonial-stars { color: #f59e0b; font-size: 14px; margin-bottom: 6px; }

/* ══════════════════════════════════════════════════════════════
   CONTACT SECTION
   ══════════════════════════════════════════════════════════════ */
.contact-form .form-control,
.contact-form .form-select {
  background: var(--clr-surface) !important;
  border: 1.5px solid var(--clr-border) !important;
  border-radius: var(--radius-sm) !important;
  padding: 12px 16px !important;
  font-size: 14px !important;
  font-weight: 500 !important;
  color: var(--clr-text) !important;
  transition: border-color 0.15s, box-shadow 0.15s !important;
}
.contact-form .form-control:focus {
  border-color: var(--clr-accent) !important;
  box-shadow: 0 0 0 3px rgba(37,99,235,0.12) !important;
}
.contact-form textarea { min-height: 120px; resize: vertical; }

.btn-contact {
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  color: #fff;
  border: none;
  border-radius: var(--radius-sm);
  padding: 14px 36px;
  font-size: 15px;
  font-weight: 700;
  font-family: var(--font);
  cursor: pointer;
  transition: all 0.2s ease;
  display: inline-flex;
  align-items: center;
  gap: 8px;
}
.btn-contact:hover {
  opacity: 0.88;
  color: #fff;
  transform: translateY(-2px);
}
.btn-contact:disabled {
  opacity: 0.6;
  cursor: not-allowed;
  transform: none;
}

/* ══════════════════════════════════════════════════════════════
   FOOTER
   ══════════════════════════════════════════════════════════════ */
footer {
  background: var(--clr-surface);
  border-top: 1px solid var(--clr-border);
  padding: 30px 0;
  text-align: center;
}
footer p { font-size: 13px; color: var(--clr-muted); font-weight: 500; margin: 0; }
footer a { color: var(--clr-accent); text-decoration: none; font-weight: 600; }
footer a:hover { text-decoration: underline; }

/* ══════════════════════════════════════════════════════════════
   BACK TO TOP
   ══════════════════════════════════════════════════════════════ */
.back-to-top {
  position: fixed;
  bottom: 30px;
  right: 30px;
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: var(--clr-accent);
  color: #fff;
  border: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 18px;
  cursor: pointer;
  box-shadow: 0 4px 16px rgba(37,99,235,0.30);
  opacity: 0;
  transform: translateY(20px);
  transition: all 0.3s ease;
  z-index: 900;
}
.back-to-top.show {
  opacity: 1;
  transform: translateY(0);
}
.back-to-top:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(37,99,235,0.40);
}

/* ══════════════════════════════════════════════════════════════
   TOAST NOTIFICATIONS
   ══════════════════════════════════════════════════════════════ */
.toast-notification {
  position: fixed;
  bottom: 24px;
  left: 50%;
  transform: translateX(-50%) translateY(20px);
  padding: 14px 24px;
  border-radius: var(--radius-sm);
  font-size: 14px;
  font-weight: 600;
  font-family: var(--font);
  display: flex;
  align-items: center;
  gap: 8px;
  z-index: 9999;
  opacity: 0;
  transition: all 0.35s cubic-bezier(0.22, 0.61, 0.36, 1);
  box-shadow: var(--shadow-md);
  max-width: 90vw;
}
.toast-notification.show {
  opacity: 1;
  transform: translateX(-50%) translateY(0);
}
.toast-success {
  background: var(--clr-card);
  border: 1px solid rgba(5,150,105,0.20);
  color: #059669;
}
.toast-error {
  background: var(--clr-card);
  border: 1px solid rgba(220,38,38,0.20);
  color: #dc2626;
}

/* ══════════════════════════════════════════════════════════════
   FADE-UP / SCROLL REVEAL ANIMATION
   ══════════════════════════════════════════════════════════════ */
.fade-up {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.fade-up.visible {
  opacity: 1;
  transform: translateY(0);
}

/* Also support .reveal class used in partials */
.reveal {
  opacity: 0;
  transform: translateY(30px);
  transition: opacity 0.6s ease, transform 0.6s ease;
}
.reveal.visible {
  opacity: 1;
  transform: translateY(0);
}

/* ══════════════════════════════════════════════════════════════
   RESPONSIVE
   ══════════════════════════════════════════════════════════════ */
@media (max-width: 991.98px) {
  .nav-links-desktop { display: none !important; }
  .nav-mobile-controls { display: flex !important; }
}
@media (min-width: 992px) {
  .nav-mobile-controls { display: none !important; }
  .mobile-nav-dropdown { display: none !important; }
}
@media (max-width: 768px) {
  section { padding: 50px 0; }
  .about-info-grid { grid-template-columns: 1fr; }
  .hero-avatar {
    width: 120px;
    height: 120px;
    font-size: 36px;
    border-radius: 18px;
  }
  .hero-avatar::after { border-radius: 22px; }
  .hire-banner { padding: 32px 24px; }
  .btn-hero { padding: 10px 22px; font-size: 13px; }
  .nav-link-f i { font-size: 14px; }
}
@media (max-width: 480px) {
  .hero-name { font-size: 32px; }
  .section-title { font-size: 24px; }
}

/* ══════════════════════════════════════════════════════════════
   ORIGINAL INDEX_1.HTML CSS CLASSES (for partial compatibility)
   ══════════════════════════════════════════════════════════════ */

/* Hero tag (status badge) - original style */
.hero-tag {
  display: inline-flex; align-items: center; gap: .5rem;
  background: var(--clr-accent-light); border: 1px solid #bfdbfe;
  color: var(--clr-accent); border-radius: 999px;
  padding: .3rem 1rem; font-size: .75rem; font-weight: 700;
  margin-bottom: 1.5rem; letter-spacing: .06em; text-transform: uppercase;
}

/* Hero name line2 (accent color) */
.hero-name .line2 { color: var(--clr-accent2); }

/* Hero typing row */
.hero-typerow {
  font-size: 1.05rem; color: var(--clr-muted);
  margin-bottom: 2rem; font-weight: 400;
}
.hero-typerow .typed-word {
  color: var(--clr-accent2); font-weight: 700;
  border-right: 2.5px solid var(--clr-accent2);
  padding-right: 3px;
  animation: blink .75s step-end infinite;
}

/* Hero socials */
.hero-socials { display: flex; gap: .7rem; flex-wrap: wrap; margin-bottom: 2.5rem; }
.hero-socials a {
  width: 42px; height: 42px;
  display: flex; align-items: center; justify-content: center;
  border: 1.5px solid var(--clr-border); border-radius: var(--radius-sm);
  color: var(--clr-muted); text-decoration: none; font-size: 1rem;
  transition: border-color .2s, color .2s, background .2s, transform .2s;
  background: var(--clr-card);
  box-shadow: var(--shadow);
}
.hero-socials a:hover {
  border-color: var(--clr-accent); color: var(--clr-accent);
  background: var(--clr-accent-light); transform: translateY(-2px);
}

/* Hero CTA buttons */
.hero-cta { display: flex; gap: 1rem; flex-wrap: wrap; }
.btn-primary-custom {
  display: inline-flex; align-items: center; gap: .5rem;
  background: var(--clr-accent); color: #fff;
  border: none; border-radius: var(--radius-sm);
  padding: .78rem 1.75rem; font-family: var(--font);
  font-weight: 700; font-size: .85rem; text-decoration: none;
  letter-spacing: .03em;
  box-shadow: 0 4px 14px rgba(37,99,235,.28);
  transition: opacity .2s, transform .2s, box-shadow .2s;
  cursor: pointer;
}
.btn-primary-custom:hover {
  opacity: .9; transform: translateY(-2px); color: #fff;
  box-shadow: 0 6px 20px rgba(37,99,235,.38);
}
.btn-ghost-custom {
  display: inline-flex; align-items: center; gap: .5rem;
  background: var(--clr-card); color: var(--clr-text);
  border: 1.5px solid var(--clr-border-hover); border-radius: var(--radius-sm);
  padding: .78rem 1.75rem; font-family: var(--font);
  font-weight: 700; font-size: .85rem; text-decoration: none;
  letter-spacing: .03em;
  box-shadow: var(--shadow);
  transition: border-color .2s, background .2s, transform .2s;
}
.btn-ghost-custom:hover {
  border-color: var(--clr-accent2); background: var(--clr-accent2-light);
  color: var(--clr-text); transform: translateY(-2px);
}

/* Hero avatar - original morphing blob style */
.hero-avatar {
  width: 300px; height: 300px; margin: 0 auto;
  border-radius: 40% 60% 55% 45% / 48% 42% 58% 52%;
  background: linear-gradient(135deg, #bfdbfe 0%, #ddd6fe 60%, #fce7f3 100%);
  border: 3px solid #e0e7ff;
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font);
  font-weight: 800; font-size: 4.5rem; color: var(--clr-accent);
  letter-spacing: -4px;
  box-shadow: var(--shadow-md);
  animation: morph 8s ease-in-out infinite;
}
@keyframes morph {
  0%,100% { border-radius: 40% 60% 55% 45% / 48% 42% 58% 52%; }
  33%      { border-radius: 58% 42% 38% 62% / 52% 60% 40% 48%; }
  66%      { border-radius: 46% 54% 64% 36% / 40% 54% 46% 60%; }
}

/* About card & info rows - original style */
.about-card {
  background: var(--clr-card);
  border: 1.5px solid var(--clr-border);
  border-radius: var(--radius);
  padding: 2rem 2.25rem;
  box-shadow: var(--shadow);
}
.info-row {
  display: flex; gap: 1rem; padding: .7rem 0;
  border-bottom: 1px solid var(--clr-border); align-items: flex-start;
}
.info-row:last-child { border-bottom: none; }
.info-label {
  color: var(--clr-muted); font-size: .72rem; min-width: 115px;
  padding-top: 3px; text-transform: uppercase; letter-spacing: .06em; font-weight: 700;
}
.info-value { color: var(--clr-text); font-size: .9rem; font-weight: 500; }

/* Filter bar - original */
.filter-bar { display: flex; gap: .5rem; flex-wrap: wrap; margin-bottom: 2rem; }

/* Project item */
.project-item { transition: opacity .3s, transform .3s; }

/* Project image area - original style */
.project-img {
  position: relative; overflow: hidden;
  height: 200px; background: var(--clr-surface);
  display: flex; align-items: center; justify-content: center;
}
.project-img-placeholder {
  font-size: 3.5rem; color: #c7d2fe;
  font-family: var(--font); font-weight: 800;
}
.project-img .project-overlay {
  position: absolute; inset: 0;
  background: rgba(37,99,235,.82);
  display: flex; align-items: center; justify-content: center;
  gap: .7rem; opacity: 0; transition: opacity .25s;
}
.project-card:hover .project-img .project-overlay { opacity: 1; }
.project-img .project-overlay a {
  width: 46px; height: 46px;
  background: #fff; border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  color: var(--clr-accent); font-size: 1.15rem; text-decoration: none;
  box-shadow: 0 4px 12px rgba(0,0,0,.2);
  transition: transform .2s;
}
.project-img .project-overlay a:hover { transform: scale(1.1); }

/* Project body/tags */
.project-tags { display: flex; gap: .4rem; flex-wrap: wrap; margin-bottom: .65rem; }
.project-name { font-size: .98rem; font-weight: 700; color: var(--clr-text); margin-bottom: .3rem; }
.project-desc { font-size: .82rem; color: var(--clr-muted); font-weight: 400; }

/* Skill items - original style */
.skill-item { margin-bottom: 1.4rem; }
.skill-header { display: flex; justify-content: space-between; margin-bottom: .5rem; }
.skill-pct { font-size: .8rem; font-weight: 700; color: var(--clr-accent); }
.skill-track {
  height: 6px; background: var(--clr-surface);
  border-radius: 999px; overflow: hidden;
}
.skill-fill {
  height: 100%; border-radius: 999px;
  background: linear-gradient(90deg, var(--clr-accent), var(--clr-accent2));
  transform-origin: left;
  animation: fillBar 1.4s cubic-bezier(.4,0,.2,1) forwards;
  transform: scaleX(0);
}
@keyframes fillBar { to { transform: scaleX(1); } }

/* Service card - original with bottom accent */
.service-card {
  background: var(--clr-card);
  border: 1.5px solid var(--clr-border);
  border-radius: var(--radius); padding: 2rem 1.75rem;
  height: 100%;
  box-shadow: var(--shadow);
  transition: border-color .25s, transform .25s, box-shadow .25s;
  position: relative; overflow: hidden;
  text-align: left;
}
.service-card::after {
  content: ''; position: absolute;
  bottom: 0; left: 0; right: 0; height: 3px;
  background: linear-gradient(90deg, var(--clr-accent), var(--clr-accent2));
  opacity: 0; transition: opacity .25s;
}
.service-card:hover {
  border-color: rgba(37,99,235,.25); transform: translateY(-4px);
  box-shadow: var(--shadow-md);
}
.service-card:hover::after { opacity: 1; }
.service-icon {
  width: 52px; height: 52px;
  background: var(--clr-accent-light); border-radius: var(--radius-sm);
  display: flex; align-items: center; justify-content: center;
  color: var(--clr-accent); font-size: 1.5rem;
  margin-bottom: 1.1rem;
}
.service-card h4 { font-size: 1rem; font-weight: 700; margin-bottom: .6rem; color: var(--clr-text); letter-spacing: -.3px; }
.service-card p { font-size: .84rem; color: var(--clr-muted); line-height: 1.65; font-weight: 400; }

/* Testimonial card - original style */
.testi-card {
  background: var(--clr-card);
  border: 1.5px solid var(--clr-border);
  border-radius: var(--radius); padding: 2rem;
  box-shadow: var(--shadow);
}
.testi-quote {
  font-size: 3rem; color: var(--clr-accent); font-family: var(--font);
  line-height: .9; margin-bottom: .75rem; font-weight: 800;
}
.testi-card p {
  font-size: .9rem; color: var(--clr-muted); margin-bottom: 1.5rem;
  font-style: italic; font-weight: 400;
}
.testi-author { display: flex; align-items: center; gap: .85rem; }
.testi-avatar {
  width: 44px; height: 44px; border-radius: 50%;
  background: linear-gradient(135deg, var(--clr-accent), var(--clr-accent2));
  display: flex; align-items: center; justify-content: center;
  font-family: var(--font); font-weight: 800; font-size: .82rem; color: #fff;
  box-shadow: 0 3px 10px rgba(37,99,235,.3);
}
.testi-name { font-size: .9rem; font-weight: 700; color: var(--clr-text); }

/* Contact form - original style */
.contact-wrap {
  background: var(--clr-card); border: 1.5px solid var(--clr-border);
  border-radius: var(--radius); padding: 2.75rem;
  box-shadow: var(--shadow-md);
}
.form-control-custom {
  width: 100%; padding: .8rem 1.1rem;
  background: var(--clr-bg); border: 1.5px solid var(--clr-border);
  border-radius: var(--radius-sm); color: var(--clr-text);
  font-family: var(--font); font-size: .875rem; font-weight: 500;
  outline: none; transition: border-color .2s, box-shadow .2s;
  margin-bottom: 1.1rem;
}
.form-control-custom::placeholder { color: var(--clr-muted); font-weight: 400; }
.form-control-custom:focus {
  border-color: var(--clr-accent);
  box-shadow: 0 0 0 4px rgba(37,99,235,.08); background: #fff;
}
textarea.form-control-custom { resize: vertical; min-height: 130px; }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }
@media (max-width: 576px) { .form-row { grid-template-columns: 1fr; } }

/* Hire banner button - original */
.btn-hire {
  display: inline-flex; align-items: center; gap: .5rem;
  background: #fff; color: var(--clr-accent);
  border: none; border-radius: var(--radius-sm);
  padding: .8rem 2rem; font-family: var(--font);
  font-weight: 800; font-size: .9rem; text-decoration: none;
  box-shadow: 0 4px 14px rgba(0,0,0,.18);
  transition: transform .2s, box-shadow .2s;
}
.btn-hire:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(0,0,0,.22); color: var(--clr-accent);
}
</style>
</head>

<body>

<!-- ══════════════════════════════════════════════════════════════
     NAVBAR
     ══════════════════════════════════════════════════════════════ -->
<nav class="portfolio-nav" id="mainNav">
  <div class="container">

    <!-- Brand -->
    <a class="nav-brand" href="#hero">
      <span class="brand-underscore">_</span>{{ $settings->site_logo ?? 'Portfolio' }}<span class="brand-underscore">_</span>
    </a>

    <!-- Desktop nav links (icon + text) -->
    <div class="nav-links-desktop">
      @if(($navVisibility['home']['visible'] ?? true))
      <a href="#hero" class="nav-link-f active"><i class="bi bi-house-door"></i><span>Home</span></a>
      @endif
      @if(($navVisibility['about']['visible'] ?? true))
      <a href="#about" class="nav-link-f"><i class="bi bi-person"></i><span>About</span></a>
      @endif
      @if(($navVisibility['projects']['visible'] ?? true))
      <a href="#projects" class="nav-link-f"><i class="bi bi-grid"></i><span>Projects</span></a>
      @endif
      @if(($navVisibility['skills']['visible'] ?? true))
      <a href="#skills" class="nav-link-f"><i class="bi bi-bar-chart-line"></i><span>Skills</span></a>
      @endif
      @if(($navVisibility['services']['visible'] ?? true))
      <a href="#services" class="nav-link-f"><i class="bi bi-gear"></i><span>Services</span></a>
      @endif
      @if(($navVisibility['testimonials']['visible'] ?? true))
      <a href="#testimonial" class="nav-link-f"><i class="bi bi-chat-quote"></i><span>Testimonials</span></a>
      @endif
      @if(($navVisibility['contact']['visible'] ?? true))
      <a href="#contact" class="nav-link-f"><i class="bi bi-telephone"></i><span>Contact</span></a>
      @endif
      @if($settings->dark_mode_toggle ?? false)
      <button class="dark-toggle" onclick="toggleDarkMode()" title="Toggle Dark Mode" aria-label="Toggle dark mode">
        <i class="bi bi-moon-stars"></i>
      </button>
      @endif
    </div>

    <!-- Mobile controls -->
    <div class="nav-mobile-controls d-flex align-items-center gap-2">
      @if($settings->dark_mode_toggle ?? false)
      <button class="dark-toggle" onclick="toggleDarkMode()" aria-label="Toggle dark mode">
        <i class="bi bi-moon-stars"></i>
      </button>
      @endif
      <button class="hamburger-btn" id="hamburgerBtn" onclick="toggleMobileNav()" aria-label="Toggle navigation">
        <i class="bi bi-list"></i>
        <i class="bi bi-x"></i>
      </button>
    </div>

  </div>

  <!-- Mobile dropdown -->
  <div class="mobile-nav-dropdown" id="mobileNav">
    <div class="container">
      <div class="d-flex flex-column gap-1">
        @if(($navVisibility['home']['visible'] ?? true))
        <a href="#hero" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-house-door"></i><span>Home</span></a>
        @endif
        @if(($navVisibility['about']['visible'] ?? true))
        <a href="#about" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-person"></i><span>About</span></a>
        @endif
        @if(($navVisibility['projects']['visible'] ?? true))
        <a href="#projects" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-grid"></i><span>Projects</span></a>
        @endif
        @if(($navVisibility['skills']['visible'] ?? true))
        <a href="#skills" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-bar-chart-line"></i><span>Skills</span></a>
        @endif
        @if(($navVisibility['services']['visible'] ?? true))
        <a href="#services" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-gear"></i><span>Services</span></a>
        @endif
        @if(($navVisibility['testimonials']['visible'] ?? true))
        <a href="#testimonial" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-chat-quote"></i><span>Testimonials</span></a>
        @endif
        @if(($navVisibility['contact']['visible'] ?? true))
        <a href="#contact" class="nav-link-f" onclick="closeMobileNav()"><i class="bi bi-telephone"></i><span>Contact</span></a>
        @endif
      </div>
    </div>
  </div>
</nav>

<!-- ══════════════════════════════════════════════════════════════
     PAGE CONTENT
     ══════════════════════════════════════════════════════════════ -->
@yield('content')

<!-- ══════════════════════════════════════════════════════════════
     FOOTER
     ══════════════════════════════════════════════════════════════ -->
<footer>
  <div class="container">
    <p>
      {!! $settings->copyright ?? '&copy; ' . date('Y') . ' All rights reserved.' !!}
      &nbsp;&middot;&nbsp;
      Powered by <a href="https://lastlineweb.com/" target="_blank" rel="noopener">Lastline Web</a>
    </p>
  </div>
</footer>

<!-- ══════════════════════════════════════════════════════════════
     BACK TO TOP
     ══════════════════════════════════════════════════════════════ -->
<button class="back-to-top" id="backToTop" onclick="window.scrollTo({top:0,behavior:'smooth'})" aria-label="Back to top">
  <i class="bi bi-arrow-up"></i>
</button>

<!-- ══════════════════════════════════════════════════════════════
     SEO STRUCTURED DATA
     ══════════════════════════════════════════════════════════════ -->
@if($seo->json_ld ?? '')
<script type="application/ld+json">{!! $seo->json_ld !!}</script>
@endif

<!-- ══════════════════════════════════════════════════════════════
     ANALYTICS
     ══════════════════════════════════════════════════════════════ -->
@if($seo->ga4_id ?? '')
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $seo->ga4_id }}"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  gtag('js', new Date());
  gtag('config', '{{ $seo->ga4_id }}');
</script>
@endif

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<script>
/* ══════════════════════════════════════════════════════════════
   NAVBAR SCROLL EFFECT + ACTIVE LINK + BACK-TO-TOP
   ══════════════════════════════════════════════════════════════ */
(function() {
  const nav = document.getElementById('mainNav');
  const btt = document.getElementById('backToTop');

  window.addEventListener('scroll', function() {
    // Navbar shadow on scroll
    nav.classList.toggle('scrolled', window.scrollY > 50);

    // Back-to-top visibility
    btt.classList.toggle('show', window.scrollY > 400);

    // Active nav link based on scroll position
    document.querySelectorAll('section[id]').forEach(function(s) {
      var top = s.offsetTop - 120;
      var bottom = top + s.offsetHeight;
      var id = s.getAttribute('id');
      var link = document.querySelector('.nav-link-f[href="#' + id + '"]');
      if (link) {
        if (window.scrollY >= top && window.scrollY < bottom) {
          link.classList.add('active');
        } else {
          link.classList.remove('active');
        }
      }
    });
  });
})();

/* ══════════════════════════════════════════════════════════════
   HAMBURGER / MOBILE NAV
   ══════════════════════════════════════════════════════════════ */
function toggleMobileNav() {
  var menu = document.getElementById('mobileNav');
  var btn  = document.getElementById('hamburgerBtn');
  menu.classList.toggle('open');
  btn.classList.toggle('open');
}
function closeMobileNav() {
  var menu = document.getElementById('mobileNav');
  var btn  = document.getElementById('hamburgerBtn');
  menu.classList.remove('open');
  btn.classList.remove('open');
}

/* ══════════════════════════════════════════════════════════════
   DARK MODE
   ══════════════════════════════════════════════════════════════ */
function toggleDarkMode() {
  var html = document.documentElement;
  var dark = html.getAttribute('data-bs-theme') === 'dark';
  html.setAttribute('data-bs-theme', dark ? 'light' : 'dark');
  localStorage.setItem('theme', dark ? 'light' : 'dark');
  document.querySelectorAll('.dark-toggle i').forEach(function(i) {
    i.className = dark ? 'bi bi-moon-stars' : 'bi bi-sun';
  });
}

// Restore dark mode preference on load
(function() {
  var saved = localStorage.getItem('theme');
  var defaultDark = {{ ($settings->dark_mode_default ?? false) ? 'true' : 'false' }};
  if (saved === 'dark' || (!saved && defaultDark)) {
    document.documentElement.setAttribute('data-bs-theme', 'dark');
    document.querySelectorAll('.dark-toggle i').forEach(function(i) {
      i.className = 'bi bi-sun';
    });
  }
})();

/* ══════════════════════════════════════════════════════════════
   SCROLL REVEAL / FADE-UP (IntersectionObserver)
   ══════════════════════════════════════════════════════════════ */
(function() {
  var observer = new IntersectionObserver(function(entries) {
    entries.forEach(function(e) {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
        // Animate skill bars when visible
        e.target.querySelectorAll('.skill-fill').forEach(function(bar) {
          var w = bar.style.width || bar.getAttribute('data-width');
          if (w) {
            bar.style.width = w;
            bar.classList.add('animated');
          }
        });
        observer.unobserve(e.target);
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.fade-up, .reveal').forEach(function(el) {
    observer.observe(el);
  });
})();

/* ══════════════════════════════════════════════════════════════
   TYPING ANIMATION
   ══════════════════════════════════════════════════════════════ */
class TypingEffect {
  constructor(el, words, speed, pause) {
    this.el = el;
    this.words = words;
    this.speed = speed || 80;
    this.pause = pause || 2000;
    this.wordIndex = 0;
    this.charIndex = 0;
    this.isDeleting = false;
    this.tick();
  }
  tick() {
    var word = this.words[this.wordIndex];
    if (this.isDeleting) { this.charIndex--; } else { this.charIndex++; }
    this.el.textContent = word.substring(0, this.charIndex);
    var delay = this.isDeleting ? this.speed / 2 : this.speed;
    if (!this.isDeleting && this.charIndex === word.length) {
      delay = this.pause;
      this.isDeleting = true;
    } else if (this.isDeleting && this.charIndex === 0) {
      this.isDeleting = false;
      this.wordIndex = (this.wordIndex + 1) % this.words.length;
      delay = 400;
    }
    var self = this;
    setTimeout(function() { self.tick(); }, delay);
  }
}

@if($hero ?? null)
(function() {
  var typingEl = document.getElementById('typedWord');
  if (typingEl) {
    var words = {{ Js::from($hero->typing_words ?? ['Web Developer']) }};
    new TypingEffect(typingEl, words);
  }
})();
@endif

/* ══════════════════════════════════════════════════════════════
   PROJECT FILTER
   ══════════════════════════════════════════════════════════════ */
function filterProjects(cat, btn) {
  document.querySelectorAll('.filter-btn').forEach(function(b) { b.classList.remove('active'); });
  if (btn) btn.classList.add('active');
  document.querySelectorAll('.project-item').forEach(function(item) {
    var itemCat = item.dataset.cat || item.dataset.category || '';
    if (cat === 'all' || itemCat.includes(cat)) {
      item.style.display = '';
    } else {
      item.style.display = 'none';
    }
  });
}

/* ══════════════════════════════════════════════════════════════
   TOAST NOTIFICATION HELPER
   ══════════════════════════════════════════════════════════════ */
function showToast(message, type) {
  type = type || 'success';
  var toast = document.createElement('div');
  toast.className = 'toast-notification toast-' + type;
  var icon = type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill';
  toast.innerHTML = '<i class="bi ' + icon + '"></i><span>' + message + '</span>';
  document.body.appendChild(toast);

  // Trigger animation
  requestAnimationFrame(function() {
    requestAnimationFrame(function() {
      toast.classList.add('show');
    });
  });

  // Auto-dismiss
  setTimeout(function() {
    toast.classList.remove('show');
    setTimeout(function() { toast.remove(); }, 350);
  }, 4000);
}

/* ══════════════════════════════════════════════════════════════
   SESSION FLASH MESSAGES → TOAST
   ══════════════════════════════════════════════════════════════ */
@if(session('success'))
document.addEventListener('DOMContentLoaded', function() {
  showToast('{{ addslashes(session('success')) }}', 'success');
});
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function() {
  showToast('{{ addslashes(session('error')) }}', 'error');
});
@endif

/* ══════════════════════════════════════════════════════════════
   AJAX CONTACT FORM (no page reload)
   ══════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
  var form = document.querySelector('.contact-form');
  if (!form) return;

  form.addEventListener('submit', function(e) {
    e.preventDefault();
    var btn = form.querySelector('.btn-primary-custom, .btn-contact');
    if (!btn) btn = form.querySelector('button[type="submit"]');
    var originalHTML = btn.innerHTML;
    btn.disabled = true;
    btn.innerHTML = '<i class="bi bi-arrow-repeat bi-spin"></i>Sending...';

    var data = new FormData(form);

    fetch(form.action, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest'
      },
      body: data
    })
    .then(function(response) {
      return response.json().then(function(json) {
        if (!response.ok) throw json;
        return json;
      });
    })
    .then(function(json) {
      showToast(json.message || 'Message sent successfully!', 'success');
      form.reset();
    })
    .catch(function(err) {
      var msg = 'Something went wrong. Please try again.';
      if (err && err.message) {
        msg = err.message;
      } else if (err && err.errors) {
        // Laravel validation errors
        var first = Object.values(err.errors)[0];
        msg = Array.isArray(first) ? first[0] : first;
      }
      showToast(msg, 'error');
    })
    .finally(function() {
      btn.disabled = false;
      btn.innerHTML = originalHTML;
    });
  });
});
</script>

</body>
</html>
