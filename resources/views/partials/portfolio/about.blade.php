<section id="about">
  <div class="container">
    <div class="row g-5">
      <div class="col-lg-6 fade-up">
        <span class="section-label">{{ $about->section_label ?? 'About Me' }}</span>
        <h2 class="section-title">{{ $about->section_title ?? 'Senior Full Stack<br>Software Engineer' }}</h2>
        @if($about->paragraph_1 ?? '')
        <p style="color:var(--clr-muted);margin-bottom:1rem;font-size:.92rem;">{{ $about->paragraph_1 }}</p>
        @endif
        @if($about->paragraph_2 ?? '')
        <p style="color:var(--clr-muted);font-size:.92rem;">{{ $about->paragraph_2 }}</p>
        @endif
      </div>
      <div class="col-lg-6 fade-up" style="transition-delay:.1s">
        <span class="section-label">Personal Info</span>
        <div class="about-card">
          @if($about->name ?? '')
          <div class="info-row"><span class="info-label">Name</span><span class="info-value">{{ $about->name }}</span></div>
          @endif
          @if($about->place_of_birth ?? '')
          <div class="info-row"><span class="info-label">Place of Birth</span><span class="info-value">{{ $about->place_of_birth }}</span></div>
          @endif
          @if($about->nationality ?? '')
          <div class="info-row"><span class="info-label">Nationality</span><span class="info-value">{{ $about->nationality }}</span></div>
          @endif
          @if($about->marital_status ?? '')
          <div class="info-row"><span class="info-label">Marital Status</span><span class="info-value">{{ $about->marital_status }}</span></div>
          @endif
          @if($about->profession ?? '')
          <div class="info-row"><span class="info-label">Profession</span><span class="info-value">{{ $about->profession }}</span></div>
          @endif
          @if($about->experience ?? '')
          <div class="info-row"><span class="info-label">Experience</span><span class="info-value">{{ $about->experience }}</span></div>
          @endif
          @if($about->contact_no ?? '')
          <div class="info-row"><span class="info-label">Contact</span><span class="info-value">{{ $about->contact_no }}</span></div>
          @endif
          @if($about->email ?? '')
          <div class="info-row"><span class="info-label">Email</span><span class="info-value"><a href="mailto:{{ $about->email }}" style="color:var(--clr-accent)">{{ $about->email }}</a></span></div>
          @endif
          @if($about->location ?? '')
          <div class="info-row"><span class="info-label">Location</span><span class="info-value">{{ $about->location }}</span></div>
          @endif
        </div>
      </div>
    </div>
  </div>
</section>
