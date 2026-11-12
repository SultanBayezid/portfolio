<!-- ═══════════════════ SERVICES SECTION ═══════════════════ -->
<section id="services">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12 fade-up">
        <span class="section-label">What I Offer</span>
        <h2 class="section-title">Services</h2>
      </div>
    </div>

    @if($services->count() > 0)
    <div class="row g-4">
      @foreach($services as $index => $service)
      <div class="col-lg-4 col-md-6 fade-up" style="transition-delay:{{ $loop->iteration * 0.05 }}s">
        <div class="service-card">
          <div class="service-icon" @if($loop->iteration % 2 === 0) style="background:var(--clr-accent-light);color:var(--clr-accent)" @else style="background:var(--clr-accent2-light);color:var(--clr-accent2)" @endif>
            <i class="bi {{ $service->icon }}"></i>
          </div>
          <h4>{{ $service->title }}</h4>
          <p>{{ $service->description }}</p>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <div class="text-center py-5 fade-up" style="color:var(--clr-muted)">
      <i class="bi bi-layers" style="font-size:48px;display:block;margin-bottom:12px;opacity:.3"></i>
      <p style="font-size:16px;font-weight:600">No services listed yet.</p>
    </div>
    @endif
  </div>
</section>
