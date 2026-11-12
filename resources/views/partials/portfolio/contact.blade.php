<!-- ═══════════════════ CONTACT SECTION ═══════════════════ -->
<section id="contact">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 fade-up">
        <div class="text-center mb-4">
          <span class="section-label" style="justify-content:center">{{ $contact->section_label ?? 'Contact' }}</span>
          <h2 class="section-title">{{ $contact->section_heading ?? 'Get In Touch' }}</h2>
          @if($contact->subtext ?? '')
          <p style="color:var(--clr-muted);font-size:.92rem">{{ $contact->subtext }}</p>
          @endif
        </div>
        <div class="contact-wrap">
          <form method="post" action="{{ route('contact.post') }}" class="contact-form">
            @csrf

            <div class="form-row">
              @if($contact->show_name ?? true)
              <input class="form-control-custom" type="text" name="name" placeholder="Your Name *">
              @endif
              @if($contact->show_email ?? true)
              <input class="form-control-custom" type="email" name="email" placeholder="Your Email *">
              @endif
            </div>

            @if($contact->show_subject ?? true)
            <input class="form-control-custom" type="text" name="subject" placeholder="Subject">
            @endif

            @if($contact->show_message ?? true)
            <textarea class="form-control-custom" name="message" placeholder="Your Message *"></textarea>
            @endif

            <div class="text-center">
              <button type="submit" class="btn-primary-custom" style="font-size:.95rem;padding:.85rem 2.5rem"><i class="bi bi-send"></i> {{ $contact->button_label ?? 'Send Message' }}</button>
            </div>
          </form>

          <div id="contactMsg" style="display:none"></div>
        </div>
      </div>
    </div>
  </div>
</section>
