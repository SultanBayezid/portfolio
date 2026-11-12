<!-- ═══════════════════ TESTIMONIALS SECTION ═══════════════════ -->
<section id="testimonial">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12 fade-up">
        <span class="section-label">Reviews</span>
        <h2 class="section-title">Testimonials</h2>
      </div>
    </div>

    @if($testimonials->count() > 0)
    <div class="row g-4">
      @foreach($testimonials as $testimonial)
      <div class="col-lg-6 fade-up" style="transition-delay:{{ $loop->iteration * 0.1 }}s">
        <div class="testi-card">
          <div class="testi-quote">"</div>
          <p>{{ $testimonial->review }}</p>
          <div class="testi-author">
            <div class="testi-avatar" @if($loop->iteration % 2 === 0) style="background:linear-gradient(135deg,var(--clr-accent),var(--clr-accent2))" @else style="background:linear-gradient(135deg,var(--clr-accent2),#ec4899)" @endif>{{ $testimonial->initials }}</div>
            <span class="testi-name">{{ $testimonial->name }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="text-center py-5 fade-up" style="color:var(--clr-muted)">
      <i class="bi bi-chat-quote" style="font-size:48px;display:block;margin-bottom:12px;opacity:.3"></i>
      <p style="font-size:16px;font-weight:600">No testimonials yet.</p>
    </div>
    @endif
  </div>
</section>
