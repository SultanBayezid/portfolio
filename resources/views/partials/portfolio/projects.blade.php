<!-- ═══════════════════ PROJECTS SECTION ═══════════════════ -->
<section id="projects">
  <div class="container">
    <div class="row mb-3">
      <div class="col-12 fade-up">
        <span class="section-label">Portfolio</span>
        <h2 class="section-title">Selected Projects</h2>
      </div>
    </div>

    @if($projects->count() > 0)
    <!-- Filter Bar -->
    <div class="fade-up" style="transition-delay:.08s">
      <div class="filter-bar">
        @php
          // Use filter categories from Settings (managed in admin)
          // Each filter has a slug (for matching project categories) and a label (for display)
          $filterCats = $filterCategories ?? ['All Works'];
          $firstCat = true;
          // Build slug-to-label map from the saved filter categories
          $slugMap = [];
          foreach($filterCats as $label) {
            $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $label));
            $slugMap[$slug] = $label;
          }
        @endphp
        @foreach($slugMap as $slug => $label)
          <button class="filter-btn {{ $firstCat ? 'active' : '' }}" data-filter="{{ $firstCat ? 'all' : $slug }}">{{ $label }}</button>
          @php
            $firstCat = false;
          @endphp
        @endforeach
      </div>
    </div>

    <!-- Project Grid -->
    <div class="row g-4" id="projectGrid">
      @foreach($projects as $project)
      <div class="col-lg-4 col-md-6 project-item fade-up" data-cat="{{ $project->categories ?? '' }}">
        <div class="project-card">
          <div class="project-img" style="background:linear-gradient(135deg,{{ $project->color_start ?? '#eff4ff' }},{{ $project->color_end ?? '#e0e7ff' }})">
            <span class="project-img-placeholder">{{ $project->initials ?? 'P' }}</span>
            @php
              $overlayUrl = $project->url ?? $project->github_url ?? '#';
            @endphp
            <div class="project-overlay"><a href="{{ $overlayUrl }}" target="_blank"><i class="bi bi-arrow-up-right"></i></a></div>
          </div>
          <div class="project-body">
            <div class="project-tags">
              @foreach($project->tagList as $tag)
                <span class="tag {{ $tag['class'] ?? '' }}">{{ $tag['label'] }}</span>
              @endforeach
            </div>
            <p class="project-name">{{ $project->name }}</p>
            <p class="project-desc">{{ $project->description }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-5 fade-up" style="color:var(--muted)">
      <i class="bi bi-folder2-open" style="font-size:48px;display:block;margin-bottom:12px;opacity:.3"></i>
      <p style="font-size:16px;font-weight:600">No projects to show yet.</p>
    </div>
    @endif
  </div>
</section>

@push('scripts')
<script>
(function(){
  var filterBtns = document.querySelectorAll('#projects .filter-btn');
  var projectItems = document.querySelectorAll('#projectGrid .project-item');

  filterBtns.forEach(function(btn){
    btn.addEventListener('click', function(){
      filterBtns.forEach(function(b){ b.classList.remove('active'); });
      btn.classList.add('active');

      var filter = btn.getAttribute('data-filter');

      projectItems.forEach(function(item){
        var cats = item.getAttribute('data-cat') || '';
        if(filter === 'all' || cats.split(' ').indexOf(filter) !== -1){
          item.style.display = '';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
})();
</script>
@endpush
