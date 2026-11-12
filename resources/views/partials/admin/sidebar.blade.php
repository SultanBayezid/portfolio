<!-- ═══════════════════════════ SIDEBAR ═══════════════════════════ -->
<aside id="sidebar">
  <div class="s-logo">
    <div class="s-badge">{{ $siteInitials ?? 'SB' }}</div>
    <div><div class="s-name">{{ $siteName ?? 'SB Admin' }}</div><div class="s-sub">{{ $siteSub ?? 'Portfolio Manager' }}</div></div>
  </div>
  <nav class="s-nav">
    <div class="s-lbl">Overview</div>
    <a class="ni active" onclick="goto('dashboard',this)"><i class="bi bi-grid-1x2 ico"></i>Dashboard</a>

    <div class="s-lbl" style="margin-top:10px">Sections</div>
    <a class="ni" onclick="goto('hero',this)"><i class="bi bi-house-door ico"></i>Hero Section</a>
    <a class="ni" onclick="goto('about',this)"><i class="bi bi-person-lines-fill ico"></i>About Me</a>
    <a class="ni" onclick="goto('projects',this)"><i class="bi bi-grid-3x3-gap ico"></i>Projects <span class="nbadge b-blue ms-auto">{{ $projectCount ?? 0 }}</span></a>
    <a class="ni" onclick="goto('skills',this)"><i class="bi bi-bar-chart-steps ico"></i>Skills</a>
    <a class="ni" onclick="goto('services',this)"><i class="bi bi-layers ico"></i>Services</a>
    <a class="ni" onclick="goto('hirebanner',this)"><i class="bi bi-megaphone ico"></i>Hire Banner</a>
    <a class="ni" onclick="goto('testimonials',this)"><i class="bi bi-chat-quote ico"></i>Testimonials</a>
    <a class="ni" onclick="goto('contact',this)"><i class="bi bi-envelope-paper ico"></i>Contact Section</a>

    <div class="s-lbl" style="margin-top:10px">Inbox</div>
    <a class="ni" onclick="goto('messages',this)"><i class="bi bi-envelope ico"></i>Messages <span class="nbadge b-warn ms-auto">{{ $unreadMessages ?? 0 }}</span></a>

    <div class="s-lbl" style="margin-top:10px">Config</div>
    <a class="ni" onclick="goto('seo',this)"><i class="bi bi-search ico"></i>SEO & Meta</a>
    <a class="ni" onclick="goto('visibility',this)"><i class="bi bi-eye ico"></i>Visibility</a>
    <a class="ni" onclick="goto('settings',this)"><i class="bi bi-sliders ico"></i>Settings</a>
  </nav>
  <div class="s-foot">
    <div class="u-card">
      <div class="u-ava">{{ $userInitials ?? 'SB' }}</div>
      <div><div class="u-name">{{ Auth::user()->name ?? 'Sultan Bayezid' }}</div><div class="u-role">{{ $userRole ?? 'Administrator' }}</div></div>
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="margin-left:auto;color:var(--muted);font-size:15px">
        <i class="bi bi-box-arrow-right"></i>
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </div>
</aside>
