<!-- ═══════════════════ HIRE BANNER SECTION ═══════════════════ -->
<section style="padding:2.5rem 0">
  <div class="container">
    @if($hireBanner)
    <div class="hire-banner fade-up" @if($hireBanner->gradient_start || $hireBanner->gradient_end) style="background:linear-gradient(135deg,{{ $hireBanner->gradient_start ?? 'var(--clr-accent)' }},{{ $hireBanner->gradient_end ?? 'var(--clr-accent2)' }})" @endif>
      <h2>{{ $hireBanner->heading }}</h2>
      <p>{{ $hireBanner->subtext }}</p>
      <a href="{{ $hireBanner->button_url }}" target="_blank" class="btn-hire"><i class="bi {{ $hireBanner->button_icon ?? 'bi-send' }}"></i> {{ $hireBanner->button_label }}</a>
    </div>
    @else
    <div class="hire-banner fade-up">
      <h2>I'm available for projects</h2>
      <p>Looking for a full-stack developer for your next big idea? Let's build something great together.</p>
      <a href="#" target="_blank" class="btn-hire"><i class="bi bi-send"></i> Hire Me</a>
    </div>
    @endif
  </div>
</section>
