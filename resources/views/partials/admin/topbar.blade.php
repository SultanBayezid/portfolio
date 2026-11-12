<!-- ═══════════════════════════ TOPBAR ═══════════════════════════ -->
<header id="topbar">
  <button class="tb-btn d-flex d-lg-none me-1" onclick="toggleSB()"><i class="bi bi-list"></i></button>
  <div class="tb-title" id="topTitle">Dashboard <span>Overview</span></div>
  <div class="live-tag"><div class="live-dot"></div>Site Live</div>
  <a href="{{ $siteUrl ?? 'https://lastlineweb.com' }}" target="_blank" class="tb-btn" title="Visit Site"><i class="bi bi-box-arrow-up-right"></i></a>
  <div class="tb-btn position-relative" title="Notifications"><i class="bi bi-bell"></i>@if(($unreadNotifications ?? 0) > 0)<div class="nd"></div>@endif</div>
  <div class="tb-btn" title="Save All" onclick="saveAll()"><i class="bi bi-floppy"></i></div>
</header>
