<!-- ═══════════════════ HERO SECTION ═══════════════════ -->
<section id="home">
  <div class="hero-blob hero-blob-1" @if($hero->blob_color_1 ?? '') style="background:{{ $hero->blob_color_1 }}" @endif></div>
  <div class="hero-blob hero-blob-2" @if($hero->blob_color_2 ?? '') style="background:{{ $hero->blob_color_2 }}" @endif></div>
  <div class="hero-dots"></div>
  <div class="container position-relative">
    <div class="row align-items-center g-5">
      <div class="col-lg-7 fade-up">
        @if($hero->status_badge ?? '')
        <div class="hero-tag"><i class="bi bi-circle-fill" style="font-size:.45rem"></i> {{ $hero->status_badge }}</div>
        @endif
        <h1 class="hero-name">{{ $hero->display_name ?? 'Your Name' }}<br><span class="line2">{{ $hero->sub_line ?? '' }}</span></h1>
        <p class="hero-typerow">I am a <span class="typed-word" id="typedWord">{{ collect($hero->typing_words ?? [])->first() ?? 'Web Developer' }}</span></p>
        <div class="hero-socials">
          @if($hero->facebook_url ?? '')<a href="{{ $hero->facebook_url }}" target="_blank" title="Facebook"><i class="bi bi-facebook"></i></a>@endif
          @if($hero->linkedin_url ?? '')<a href="{{ $hero->linkedin_url }}" target="_blank" title="LinkedIn"><i class="bi bi-linkedin"></i></a>@endif
          @if($hero->youtube_url ?? '')<a href="{{ $hero->youtube_url }}" target="_blank" title="YouTube"><i class="bi bi-youtube"></i></a>@endif
          @if($hero->github_url ?? '')<a href="{{ $hero->github_url }}" target="_blank" title="GitHub"><i class="bi bi-github"></i></a>@endif
          @if($hero->website_url ?? '')<a href="{{ $hero->website_url }}" title="Website"><i class="bi bi-globe2"></i></a>@endif
        </div>
        <div class="hero-cta">
          @if($hero->hire_btn_label ?? '')
          <a href="{{ $hero->hire_btn_url ?? '#' }}" target="_blank" class="btn-primary-custom"><i class="bi bi-send"></i> {{ $hero->hire_btn_label }}</a>
          @endif
          @if($hero->view_work_label ?? '')
          <a href="{{ $hero->view_work_target ?? '#projects' }}" class="btn-ghost-custom"><i class="bi bi-grid-3x3-gap"></i> {{ $hero->view_work_label }}</a>
          @endif
        </div>
      </div>
      <div class="col-lg-5 text-center fade-up" style="transition-delay:.15s">
        <div class="hero-avatar" @if($hero->avatar_gradient ?? '') style="background:linear-gradient(135deg,{{ $hero->avatar_gradient }},var(--accent2))" @endif>{{ $hero->avatar_initials ?? 'YO' }}</div>
      </div>
    </div>
  </div>
</section>
