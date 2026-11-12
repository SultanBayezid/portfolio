<!-- ═══════════════════ SKILLS SECTION ═══════════════════ -->
<section id="skills">
  <div class="container">
    <div class="row mb-5">
      <div class="col-12 fade-up">
        <span class="section-label">Expertise</span>
        <h2 class="section-title">Skills &amp; Proficiency</h2>
      </div>
    </div>

    @if($skills->count() > 0)
    @php
      $backendSkills = $skills->where('type', 'backend');
      $frontendSkills = $skills->where('type', 'frontend');
    @endphp
    <div class="row g-4">
      @if($backendSkills->count() > 0)
      <div class="col-lg-6 fade-up">
        <div style="background:var(--clr-card);border:1px solid var(--bd);border-radius:var(--radius);padding:28px">
          <h4 style="font-size:18px;font-weight:800;margin-bottom:20px"><i class="bi bi-code-slash me-2" style="color:var(--accent)"></i>Backend &amp; Frameworks</h4>
          @foreach($backendSkills as $skill)
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">{{ $skill->name }}</span>
              <span class="skill-pct">{{ $skill->percentage }}%</span>
            </div>
            <div class="skill-track">
              <div class="skill-fill" style="width:{{ $skill->percentage }}%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif

      @if($frontendSkills->count() > 0)
      <div class="col-lg-6 fade-up" style="transition-delay:.1s">
        <div style="background:var(--clr-card);border:1px solid var(--bd);border-radius:var(--radius);padding:28px">
          <h4 style="font-size:18px;font-weight:800;margin-bottom:20px"><i class="bi bi-palette me-2" style="color:var(--accent2)"></i>Frontend &amp; Creative</h4>
          @foreach($frontendSkills as $skill)
          <div class="skill-item">
            <div class="skill-header">
              <span class="skill-name">{{ $skill->name }}</span>
              <span class="skill-pct">{{ $skill->percentage }}%</span>
            </div>
            <div class="skill-track">
              <div class="skill-fill" style="width:{{ $skill->percentage }}%"></div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      @endif
    </div>
    @else
    <div class="text-center py-5 fade-up" style="color:var(--muted)">
      <i class="bi bi-bar-chart" style="font-size:48px;display:block;margin-bottom:12px;opacity:.3"></i>
      <p style="font-size:16px;font-weight:600">No skills listed yet.</p>
    </div>
    @endif
  </div>
</section>
