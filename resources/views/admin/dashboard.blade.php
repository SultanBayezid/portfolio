@extends('layouts.admin')

@section('title', $pageTitle ?? 'SB Admin — Portfolio Manager')

@section('content')

<!-- ─── DASHBOARD ─── -->
<section id="p-dashboard" class="pg active">
  <div class="s-grid">
    <div class="sc bl"><div class="s-ico bl"><i class="bi bi-folder2-open"></i></div><div class="s-val">{{ $projectCount ?? 0 }}</div><div class="s-lbl2">Projects</div></div>
    <div class="sc gr"><div class="s-ico gr"><i class="bi bi-bar-chart"></i></div><div class="s-val">{{ $skillCount ?? 0 }}</div><div class="s-lbl2">Skills</div></div>
    <div class="sc wa"><div class="s-ico wa"><i class="bi bi-envelope-open"></i></div><div class="s-val">{{ $unreadMessages ?? 0 }}</div><div class="s-lbl2">New Messages</div></div>
    <div class="sc re"><div class="s-ico re"><i class="bi bi-layers"></i></div><div class="s-val">{{ $serviceCount ?? 0 }}</div><div class="s-lbl2">Services</div></div>
    <div class="sc bl"><div class="s-ico bl"><i class="bi bi-star"></i></div><div class="s-val">{{ $testimonialCount ?? 0 }}</div><div class="s-lbl2">Testimonials</div></div>
    <div class="sc gr"><div class="s-ico gr"><i class="bi bi-link-45deg"></i></div><div class="s-val">{{ $socialLinkCount ?? 0 }}</div><div class="s-lbl2">Social Links</div></div>
  </div>
  <div class="row g-3">
    <div class="col-lg-7">
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-clock-history"></i>Recent Activity</div><span style="font-size:11px;color:var(--muted);font-weight:600">Today</span></div>
        @forelse($recentActivities ?? [] as $activity)
          <div class="act-item"><div class="act-dot" style="background:var(--{{ $activity['color'] ?? 'muted' }})"></div><div><div style="font-size:13px;font-weight:700">{{ $activity['title'] }}</div><div style="font-size:11.5px;color:var(--muted)">{{ $activity['detail'] }}</div></div></div>
        @empty
          <div class="act-item"><div class="act-dot" style="background:var(--muted)"></div><div><div style="font-size:13px;font-weight:700">No recent activity</div><div style="font-size:11.5px;color:var(--muted)">Start editing your portfolio to see activity here</div></div></div>
        @endforelse
      </div>
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-speedometer2"></i>Quick Actions</div></div>
        <div class="cp-bd">
          <div class="row g-2">
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('projects',qsel('projects'))"><i class="bi bi-plus-lg"></i>Add Project</button></div>
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('skills',qsel('skills'))"><i class="bi bi-plus-lg"></i>Add Skill</button></div>
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('testimonials',qsel('testimonials'))"><i class="bi bi-plus-lg"></i>Add Review</button></div>
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('messages',qsel('messages'))"><i class="bi bi-envelope"></i>View Inbox</button></div>
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('seo',qsel('seo'))"><i class="bi bi-search"></i>Edit SEO</button></div>
            <div class="col-6"><button class="btn-g w-100 justify-content-center" onclick="goto('visibility',qsel('visibility'))"><i class="bi bi-eye"></i>Visibility</button></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-5">
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-activity"></i>Site Health</div></div>
        <div class="cp-bd">
          <div style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;margin-bottom:5px"><span style="font-size:12.5px;font-weight:600">Content Completeness</span><span style="font-size:12px;font-family:var(--mono);color:var(--green);font-weight:700">{{ $contentCompleteness ?? 92 }}%</span></div>
            <div class="health-bar"><div class="health-fill" style="width:{{ $contentCompleteness ?? 92 }}%"></div></div>
          </div>
          <div style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;margin-bottom:5px"><span style="font-size:12.5px;font-weight:600">SEO Score</span><span style="font-size:12px;font-family:var(--mono);color:var(--warn);font-weight:700">{{ $seoScore ?? 74 }}%</span></div>
            <div class="health-bar"><div class="health-fill" style="width:{{ $seoScore ?? 74 }}%;background:linear-gradient(90deg,var(--warn),#f59e0b)"></div></div>
          </div>
          <div style="margin-bottom:14px">
            <div style="display:flex;justify-content:space-between;margin-bottom:5px"><span style="font-size:12.5px;font-weight:600">Social Links</span><span style="font-size:12px;font-family:var(--mono);color:var(--accent);font-weight:700">{{ $socialScore ?? 100 }}%</span></div>
            <div class="health-bar"><div class="health-fill" style="width:{{ $socialScore ?? 100 }}%"></div></div>
          </div>
          <div>
            <div style="display:flex;justify-content:space-between;margin-bottom:5px"><span style="font-size:12.5px;font-weight:600">Projects With Live URLs</span><span style="font-size:12px;font-family:var(--mono);color:var(--muted);font-weight:700">{{ $liveUrlScore ?? 83 }}%</span></div>
            <div class="health-bar"><div class="health-fill" style="width:{{ $liveUrlScore ?? 83 }}%;background:linear-gradient(90deg,#7c3aed,var(--accent))"></div></div>
          </div>
        </div>
      </div>
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-info-circle"></i>Site Info</div></div>
        <div class="cp-bd p-0">
          <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 20px;border-bottom:1px solid var(--bd)"><span style="font-size:12.5px;color:var(--muted);font-weight:600">Domain</span><span style="font-size:12.5px;font-weight:700;font-family:var(--mono)">{{ $siteDomain ?? 'lastlineweb.com' }}</span></div>
          <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 20px;border-bottom:1px solid var(--bd)"><span style="font-size:12.5px;color:var(--muted);font-weight:600">Framework</span><span style="font-size:12.5px;font-weight:700">{{ $framework ?? 'Laravel + Bootstrap' }}</span></div>
          <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 20px;border-bottom:1px solid var(--bd)"><span style="font-size:12.5px;color:var(--muted);font-weight:600">Status</span><span class="tpill gr">{{ $siteStatus ?? 'Live' }}</span></div>
          <div style="display:flex;justify-content:space-between;align-items:center;padding:10px 20px"><span style="font-size:12.5px;color:var(--muted);font-weight:600">Last Updated</span><span style="font-size:12.5px;font-weight:700;font-family:var(--mono)">{{ $lastUpdated ?? 'Today' }}</span></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── HERO ─── -->
<section id="p-hero" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Edit the Hero (landing) section — the first thing visitors see on your website.</div>
  <form action="{{ route('admin.hero.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-person-badge"></i>Identity & Buttons</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Full Display Name</label><input type="text" name="display_name" class="form-control" value="{{ old('display_name', $hero->display_name ?? 'Sultan Bayezid') }}"></div>
            <div class="mb-3"><label class="fl">Status Badge Text</label><input type="text" name="status_badge" class="form-control" value="{{ old('status_badge', $hero->status_badge ?? 'Available for projects') }}"></div>
            <div class="mb-3"><label class="fl">Hero Avatar Initials</label><input type="text" name="avatar_initials" class="form-control" value="{{ old('avatar_initials', $hero->avatar_initials ?? 'SB') }}" maxlength="4" placeholder="e.g. SB"></div>
            <div class="mb-3"><label class="fl">Sub-line (line 2 of name)</label><input type="text" name="sub_line" class="form-control" value="{{ old('sub_line', $hero->sub_line ?? 'Sultan') }}"></div>
            <div class="row g-2">
              <div class="col-md-6 mb-2"><label class="fl">Hire Me Button Label</label><input type="text" name="hire_btn_label" class="form-control" value="{{ old('hire_btn_label', $hero->hire_btn_label ?? 'Hire Me') }}"></div>
              <div class="col-md-6 mb-2"><label class="fl">Hire Me Button URL</label><input type="url" name="hire_btn_url" class="form-control" value="{{ old('hire_btn_url', $hero->hire_btn_url ?? 'https://lastlineweb.com') }}"></div>
            </div>
            <div class="row g-2">
              <div class="col-md-6 mb-0"><label class="fl">View Work Button Label</label><input type="text" name="view_work_label" class="form-control" value="{{ old('view_work_label', $hero->view_work_label ?? 'View Work') }}"></div>
              <div class="col-md-6 mb-0"><label class="fl">View Work Button Target</label><input type="text" name="view_work_target" class="form-control" value="{{ old('view_work_target', $hero->view_work_target ?? '#projects') }}"></div>
            </div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-share"></i>Social Links</div></div>
          <div class="cp-bd">
            <div class="mb-2"><label class="fl">Facebook URL</label>
              <div class="input-group"><span class="input-group-text"><i class="bi bi-facebook"></i></span><input type="url" name="facebook_url" class="form-control" value="{{ old('facebook_url', $hero->facebook_url ?? '') }}"></div></div>
            <div class="mb-2"><label class="fl">LinkedIn URL</label>
              <div class="input-group"><span class="input-group-text"><i class="bi bi-linkedin"></i></span><input type="url" name="linkedin_url" class="form-control" value="{{ old('linkedin_url', $hero->linkedin_url ?? '') }}"></div></div>
            <div class="mb-2"><label class="fl">YouTube URL</label>
              <div class="input-group"><span class="input-group-text"><i class="bi bi-youtube"></i></span><input type="url" name="youtube_url" class="form-control" value="{{ old('youtube_url', $hero->youtube_url ?? '') }}"></div></div>
            <div class="mb-2"><label class="fl">GitHub URL</label>
              <div class="input-group"><span class="input-group-text"><i class="bi bi-github"></i></span><input type="url" name="github_url" class="form-control" value="{{ old('github_url', $hero->github_url ?? 'https://github.com/SultanBayezid') }}"></div></div>
            <div class="mb-0"><label class="fl">Website / Globe URL</label>
              <div class="input-group"><span class="input-group-text"><i class="bi bi-globe2"></i></span><input type="url" name="website_url" class="form-control" value="{{ old('website_url', $hero->website_url ?? 'https://lastlineweb.com') }}"></div></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-cursor-text"></i>Typing Animation Words</div><button type="button" class="btn-p btn-sm" onclick="addTypingWord()"><i class="bi bi-plus-lg"></i>Add</button></div>
          <div class="cp-bd">
            <div class="ib" style="margin-bottom:14px"><i class="bi bi-info-circle-fill"></i>These words cycle in the animated typewriter effect under your name.</div>
            <div id="typingWords">
              @forelse($typingWords ?? [] as $word)
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="{{ $word }}"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              @empty
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="Web Developer"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="Full-Stack Developer"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="Laravel Expert"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="WordPress Developer"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
                <div class="sk-row"><input type="text" name="typing_words[]" class="form-control sk-in" value="UI/UX Designer"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              @endforelse
            </div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-palette"></i>Hero Visual Style</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Section Label (small badge above name)</label><input type="text" name="section_label" class="form-control" value="{{ old('section_label', $hero->section_label ?? 'Available for projects') }}"></div>
            <div class="row g-2">
              <div class="col-6 mb-2"><label class="fl">Blob Color 1</label><input type="color" name="blob_color_1" class="form-control form-control-color w-100" value="{{ old('blob_color_1', $hero->blob_color_1 ?? '#dbeafe') }}"></div>
              <div class="col-6 mb-2"><label class="fl">Blob Color 2</label><input type="color" name="blob_color_2" class="form-control form-control-color w-100" value="{{ old('blob_color_2', $hero->blob_color_2 ?? '#ede9fe') }}"></div>
            </div>
            <div><label class="fl">Avatar Background Gradient Start</label><input type="color" name="avatar_gradient" class="form-control form-control-color w-100" value="{{ old('avatar_gradient', $hero->avatar_gradient ?? '#4f63f0') }}"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Hero</button></div>
  </form>
</section>

<!-- ─── ABOUT ─── -->
<section id="p-about" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Manage your bio text and personal information shown in the About Me section.</div>
  <form action="{{ route('admin.about.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-7">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-file-earmark-text"></i>Bio Content</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Section Label (small tag)</label><input type="text" name="section_label" class="form-control" value="{{ old('section_label', $about->section_label ?? 'About Me') }}"></div>
            <div class="mb-3"><label class="fl">Section Subtitle / Title</label><input type="text" name="section_title" class="form-control" value="{{ old('section_title', $about->section_title ?? 'Senior Full Stack Software Engineer') }}"></div>
            <div class="mb-3"><label class="fl">Paragraph 1</label><textarea name="paragraph_1" class="form-control" rows="4">{{ old('paragraph_1', $about->paragraph_1 ?? 'Hi, my name is Sultan Bayezid and I am a Senior Full Stack Software Engineer from Bangladesh. I design and build complete web applications — from clean, responsive front-ends to robust, well-structured back-ends and APIs — using modern technologies such as Laravel, Vue.js, MySQL and PostgreSQL.') }}</textarea></div>
            <div><label class="fl">Paragraph 2</label><textarea name="paragraph_2" class="form-control" rows="3">{{ old('paragraph_2', $about->paragraph_2 ?? 'I focus on delivering maintainable, high-quality solutions with clear communication and reliable delivery. Every section of this site is managed through the built-in admin panel — no code edits needed. Feel free to get in touch any time.') }}</textarea></div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-person-vcard"></i>Personal Information</div></div>
          <div class="cp-bd">
            <div class="info-tr"><div class="info-k">Name</div><input type="text" name="name" class="form-control form-control-sm" value="{{ old('name', $about->name ?? 'Sultan Bayezid') }}"></div>
            <div class="info-tr"><div class="info-k">Place of Birth</div><input type="text" name="place_of_birth" class="form-control form-control-sm" value="{{ old('place_of_birth', $about->place_of_birth ?? '') }}"></div>
            <div class="info-tr"><div class="info-k">Nationality</div><input type="text" name="nationality" class="form-control form-control-sm" value="{{ old('nationality', $about->nationality ?? 'Bangladeshi') }}"></div>
            <div class="info-tr"><div class="info-k">Marital Status</div>
              <select name="marital_status" class="form-select form-select-sm"><option {{ ($about->marital_status ?? 'Single') === 'Single' ? 'selected' : '' }}>Single</option><option {{ ($about->marital_status ?? '') === 'Married' ? 'selected' : '' }}>Married</option></select></div>
            <div class="info-tr"><div class="info-k">Profession</div><input type="text" name="profession" class="form-control form-control-sm" value="{{ old('profession', $about->profession ?? 'Senior Full Stack Software Engineer') }}"></div>
            <div class="info-tr"><div class="info-k">Contact No.</div><input type="text" name="contact_no" class="form-control form-control-sm" value="{{ old('contact_no', $about->contact_no ?? '+880 1XXX-XXXXXX') }}"></div>
            <div class="info-tr"><div class="info-k">Email</div><input type="email" name="email" class="form-control form-control-sm" value="{{ old('email', $about->email ?? 'sultanbayezidai@gmail.com') }}"></div>
            <div class="info-tr"><div class="info-k">Location</div><input type="text" name="location" class="form-control form-control-sm" value="{{ old('location', $about->location ?? 'Bangladesh') }}"></div>
            <div class="info-tr"><div class="info-k">Experience</div><input type="text" name="experience" class="form-control form-control-sm" value="{{ old('experience', $about->experience ?? '5+ Years') }}"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save About</button></div>
  </form>
</section>

<!-- ─── PROJECTS ─── -->
<section id="p-projects" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Manage all portfolio projects. Use the filter buttons on your site for category display.</div>
  <div class="cp">
    <div class="cp-hd">
      <div class="cp-tt"><i class="bi bi-collection"></i>Projects <span style="color:var(--muted);font-weight:500;font-size:12px;margin-left:4px" id="prCount">({{ $projectCount ?? 0 }} total)</span></div>
      <button class="btn-p" data-bs-toggle="modal" data-bs-target="#addProjectModal"><i class="bi bi-plus-lg"></i>Add Project</button>
    </div>
    <div class="cp-bd" id="projectList">
      @forelse($projects ?? [] as $project)
        <div class="pr-row" data-id="{{ $project->id }}" data-cat="{{ $project->categories ?? '' }}" data-url="{{ $project->url ?? '' }}" data-initials="{{ $project->initials ?? '' }}" data-color-start="{{ $project->color_start ?? '#dbeafe' }}" data-color-end="{{ $project->color_end ?? '#4f63f0' }}" data-description="{{ $project->description ?? '' }}" data-github="{{ $project->github_url ?? '' }}" data-technologies="{{ $project->technologies ?? '' }}" data-year="{{ $project->year ?? '' }}" data-status="{{ $project->status ?? '' }}">
          <div class="pr-thumb" style="background:linear-gradient(135deg,{{ $project->color_start ?? '#dbeafe' }},{{ $project->color_end ?? '#4f63f0' }});color:#fff">{{ $project->initials ?? 'P' }}</div>
          <div class="pr-info"><div class="pr-title">{{ $project->name }}</div><div class="pr-url">{{ $project->url }}</div></div>
          <div class="d-flex gap-1 flex-wrap">
            @foreach($project->tagList ?? [] as $tag)
              <span class="tpill {{ $tag['class'] ?? '' }}">{{ $tag['label'] }}</span>
            @endforeach
          </div>
          <div class="d-flex gap-1 ms-2">
            <button class="btn-e" onclick="editProject(this)"><i class="bi bi-pencil"></i>Edit</button>
            <form action="{{ route('admin.projects.destroy', $project->id ?? 0) }}" method="POST" style="display:inline" onsubmit="event.preventDefault(); var row=this.closest('.pr-row'); if(confirm('Delete this project?')){ ajaxSubmit(this, { onSuccess: function(){ if(row){row.remove();} updatePrCount(); } }); }">
              @csrf @method('DELETE')
              <button type="submit" class="btn-d"><i class="bi bi-trash"></i></button>
            </form>
          </div>
        </div>
      @empty
        <div class="text-center py-4" style="color:var(--muted)">
          <i class="bi bi-folder2-open" style="font-size:32px;display:block;margin-bottom:8px;opacity:.3"></i>
          <div style="font-size:14px;font-weight:600">No projects yet. Click "Add Project" to get started.</div>
        </div>
      @endforelse
    </div>
  </div>
  <div class="cp">
    <div class="cp-hd"><div class="cp-tt"><i class="bi bi-funnel"></i>Filter Categories Shown on Site</div></div>
    <form action="{{ route('admin.filters.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
      @csrf
      @method('PUT')
      <div class="cp-bd">
        <div class="ib" style="margin-bottom:14px"><i class="bi bi-info-circle-fill"></i>These are the filter button labels that appear above the project grid on your site. Add or remove filters, then click Save.</div>
        <div class="row g-2" id="filterList">
          @forelse($filterCategories ?? [] as $filter)
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="{{ $filter }}"><span style="font-size:13px;font-weight:600">{{ $filter }}</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
          @empty
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="All Works"><span style="font-size:13px;font-weight:600">All Works</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="Web Design"><span style="font-size:13px;font-weight:600">Web Design</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="Landing Page"><span style="font-size:13px;font-weight:600">Landing Page</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="E-commerce"><span style="font-size:13px;font-weight:600">E-commerce</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
            <div class="col-auto filter-item"><div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="Blog Page"><span style="font-size:13px;font-weight:600">Blog Page</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div></div>
          @endforelse
          <div class="col-auto"><button type="button" class="btn-g rounded-pill" onclick="addFilter()"><i class="bi bi-plus"></i>Add Filter</button></div>
        </div>
      </div>
      <div class="text-end" style="padding:0 20px 16px"><button type="submit" class="btn-p btn-sm"><i class="bi bi-floppy"></i>Save Filters</button></div>
    </form>
  </div>
</section>

<!-- ─── SKILLS ─── -->
<section id="p-skills" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Edit skill names and proficiency percentages. Progress bars update in real time.</div>
  <form action="{{ route('admin.skills.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-code-slash"></i>Backend & Frameworks</div><button type="button" class="btn-p btn-sm" onclick="addSkill('skL')"><i class="bi bi-plus-lg"></i>Add</button></div>
          <div class="cp-bd" id="skL">
            @forelse($backendSkills ?? [] as $skill)
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="{{ $skill['name'] ?? '' }}"><div class="sk-bar"><div class="sk-fill" style="width:{{ $skill['pct'] ?? 70 }}%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="{{ $skill['pct'] ?? 70 }}" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
            @empty
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="PHP / Laravel"><div class="sk-bar"><div class="sk-fill" style="width:90%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="90" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="PHP / CodeIgniter"><div class="sk-bar"><div class="sk-fill" style="width:88%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="88" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="VueJS"><div class="sk-bar"><div class="sk-fill" style="width:82%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="82" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="WordPress Expert"><div class="sk-bar"><div class="sk-fill" style="width:95%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="95" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="backend_skills[name][]" class="form-control sk-in" value="MySQL / Database"><div class="sk-bar"><div class="sk-fill" style="width:85%"></div></div><input type="number" name="backend_skills[pct][]" class="sk-pct form-control" value="85" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
            @endforelse
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-palette"></i>Frontend & Creative</div><button type="button" class="btn-p btn-sm" onclick="addSkill('skR')"><i class="bi bi-plus-lg"></i>Add</button></div>
          <div class="cp-bd" id="skR">
            @forelse($frontendSkills ?? [] as $skill)
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="{{ $skill['name'] ?? '' }}"><div class="sk-bar"><div class="sk-fill" style="width:{{ $skill['pct'] ?? 70 }}%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="{{ $skill['pct'] ?? 70 }}" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
            @empty
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="JavaScript"><div class="sk-bar"><div class="sk-fill" style="width:85%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="85" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="HTML5 / CSS3"><div class="sk-bar"><div class="sk-fill" style="width:95%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="95" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="Python"><div class="sk-bar"><div class="sk-fill" style="width:65%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="65" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="Graphics Design"><div class="sk-bar"><div class="sk-fill" style="width:80%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="80" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
              <div class="sk-row"><input type="text" name="frontend_skills[name][]" class="form-control sk-in" value="Video Editing"><div class="sk-bar"><div class="sk-fill" style="width:78%"></div></div><input type="number" name="frontend_skills[pct][]" class="sk-pct form-control" value="78" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button></div>
            @endforelse
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Skills</button></div>
  </form>
</section>

<!-- ─── SERVICES ─── -->
<section id="p-services" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Edit the service cards shown in the "What I Offer" section. Use Bootstrap icon names for the icon field.</div>
  <form action="{{ route('admin.services.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="cp">
      <div class="cp-hd"><div class="cp-tt"><i class="bi bi-layers"></i>Services</div><button type="button" class="btn-p" onclick="addService()"><i class="bi bi-plus-lg"></i>Add Service</button></div>
      <div class="cp-bd" id="servicesList">
        @forelse($services ?? [] as $index => $service)
          <div class="sv-card"><div class="d-flex align-items-start gap-3">
            <div class="sv-ico"><i class="bi {{ $service->icon ?? 'bi-display' }}"></i></div>
            <div class="flex-grow-1"><div class="row g-2">
              <div class="col-md-3"><label class="fl">Title</label><input type="text" name="services[{{ $index }}][title]" class="form-control form-control-sm" value="{{ $service->title ?? '' }}"></div>
              <div class="col-md-3"><label class="fl">Icon Class</label><input type="text" name="services[{{ $index }}][icon]" class="form-control form-control-sm" value="{{ $service->icon ?? '' }}" onchange="updSvIcon(this)"></div>
              <div class="col-md-5"><label class="fl">Short Description</label><input type="text" name="services[{{ $index }}][description]" class="form-control form-control-sm" value="{{ $service->description ?? '' }}"></div>
              <div class="col-md-1 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.sv-card'))"><i class="bi bi-trash"></i></button></div>
            </div></div>
          </div></div>
        @empty
          <div class="sv-card"><div class="d-flex align-items-start gap-3">
            <div class="sv-ico"><i class="bi bi-display"></i></div>
            <div class="flex-grow-1"><div class="row g-2">
              <div class="col-md-3"><label class="fl">Title</label><input type="text" name="services[0][title]" class="form-control form-control-sm" value="Web Design"></div>
              <div class="col-md-3"><label class="fl">Icon Class</label><input type="text" name="services[0][icon]" class="form-control form-control-sm" value="bi-display" onchange="updSvIcon(this)"></div>
              <div class="col-md-5"><label class="fl">Short Description</label><input type="text" name="services[0][description]" class="form-control form-control-sm" value="Responsive websites from PSD, XD, Sketch, Figma, or PDF mockups."></div>
              <div class="col-md-1 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.sv-card'))"><i class="bi bi-trash"></i></button></div>
            </div></div>
          </div></div>
        @endforelse
      </div>
    </div>
    <div class="text-end"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Services</button></div>
  </form>
</section>

<!-- ─── HIRE BANNER ─── -->
<section id="p-hirebanner" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>This is the full-width Call-to-Action banner that appears between Projects and Skills sections.</div>
  <form action="{{ route('admin.hirebanner.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-megaphone"></i>Banner Content</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Heading</label><input type="text" name="heading" id="hireH" class="form-control" value="{{ old('heading', $hireBanner->heading ?? "I'm available for projects") }}" oninput="updHirePreview()"></div>
            <div class="mb-3"><label class="fl">Subtext</label><textarea name="subtext" id="hireP" class="form-control" rows="2" oninput="updHirePreview()">{{ old('subtext', $hireBanner->subtext ?? "Looking for a full-stack developer for your next big idea? Let's build something great together.") }}</textarea></div>
            <div class="mb-3"><label class="fl">Button Label</label><input type="text" name="button_label" id="hireBL" class="form-control" value="{{ old('button_label', $hireBanner->button_label ?? 'Hire Me') }}" oninput="updHirePreview()"></div>
            <div class="mb-3"><label class="fl">Button URL</label><input type="url" name="button_url" class="form-control" value="{{ old('button_url', $hireBanner->button_url ?? 'https://lastlineweb.com') }}"></div>
            <div><label class="fl">Button Icon (Bootstrap icon class)</label><input type="text" name="button_icon" class="form-control" value="{{ old('button_icon', $hireBanner->button_icon ?? 'bi-send') }}"></div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-palette2"></i>Banner Appearance</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Section Visibility</label>
              <div class="d-flex align-items-center gap-3 mt-1"><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="visible" id="hireVis" value="1" {{ ($hireBanner->visible ?? true) ? 'checked' : '' }}></div><label for="hireVis" style="font-size:13px;font-weight:600;cursor:pointer">Banner Visible on Site</label></div></div>
            <div class="row g-2">
              <div class="col-6"><label class="fl">Gradient Start</label><input type="color" name="gradient_start" class="form-control form-control-color w-100" value="{{ old('gradient_start', $hireBanner->gradient_start ?? '#4f63f0') }}"></div>
              <div class="col-6"><label class="fl">Gradient End</label><input type="color" name="gradient_end" class="form-control form-control-color w-100" value="{{ old('gradient_end', $hireBanner->gradient_end ?? '#10b98a') }}"></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-eye"></i>Live Preview</div></div>
          <div class="cp-bd">
            <div class="hire-preview">
              <h3 id="hirePreviewH">{{ $hireBanner->heading ?? "I'm available for projects" }}</h3>
              <p id="hirePreviewP">{{ $hireBanner->subtext ?? "Looking for a full-stack developer for your next big idea? Let's build something great together." }}</p>
              <button type="button" class="hire-btn"><i class="bi {{ $hireBanner->button_icon ?? 'bi-send' }}"></i> <span id="hirePreviewBL">{{ $hireBanner->button_label ?? 'Hire Me' }}</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Banner</button></div>
  </form>
</section>

<!-- ─── TESTIMONIALS ─── -->
<section id="p-testimonials" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Add, edit, or remove client testimonials shown in the Reviews section.</div>
  <form action="{{ route('admin.testimonials.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="cp">
      <div class="cp-hd"><div class="cp-tt"><i class="bi bi-chat-quote"></i>Testimonials</div><button type="button" class="btn-p" onclick="addTestimonial()"><i class="bi bi-plus-lg"></i>Add Review</button></div>
      <div class="cp-bd" id="tsContainer">
        @forelse($testimonials ?? [] as $index => $testimonial)
          <div class="ts-card">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="ts-ava" style="background:linear-gradient(135deg,var(--accent),var(--accent2))">{{ $testimonial->initials ?? '??' }}</div>
              <div class="flex-grow-1">
                <div class="row g-2">
                  <div class="col-md-4"><label class="fl">Client Name</label><input type="text" name="testimonials[{{ $index }}][name]" class="form-control form-control-sm" value="{{ $testimonial->name ?? '' }}"></div>
                  <div class="col-md-2"><label class="fl">Initials</label><input type="text" name="testimonials[{{ $index }}][initials]" class="form-control form-control-sm" value="{{ $testimonial->initials ?? '' }}" maxlength="2"></div>
                  <div class="col-md-3"><label class="fl">Rating</label>
                    <select name="testimonials[{{ $index }}][rating]" class="form-select form-select-sm">
                      <option {{ ($testimonial->rating ?? 5) == 5 ? 'selected' : '' }}>5</option>
                      <option {{ ($testimonial->rating ?? 5) == 4 ? 'selected' : '' }}>4</option>
                      <option {{ ($testimonial->rating ?? 5) == 3 ? 'selected' : '' }}>3</option>
                    </select></div>
                  <div class="col-md-3 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.ts-card'))"><i class="bi bi-trash"></i>Remove</button></div>
                </div>
              </div>
            </div>
            <div><label class="fl">Review Text</label><textarea name="testimonials[{{ $index }}][review]" class="form-control" rows="2">{{ $testimonial->review ?? '' }}</textarea></div>
          </div>
        @empty
          <div class="ts-card">
            <div class="d-flex align-items-center gap-3 mb-3">
              <div class="ts-ava" style="background:linear-gradient(135deg,var(--accent),var(--accent2))">SB</div>
              <div class="flex-grow-1">
                <div class="row g-2">
                  <div class="col-md-4"><label class="fl">Client Name</label><input type="text" name="testimonials[0][name]" class="form-control form-control-sm" value="Sajida Begum"></div>
                  <div class="col-md-2"><label class="fl">Initials</label><input type="text" name="testimonials[0][initials]" class="form-control form-control-sm" value="SB" maxlength="2"></div>
                  <div class="col-md-3"><label class="fl">Rating</label><select name="testimonials[0][rating]" class="form-select form-select-sm"><option selected>5</option><option>4</option><option>3</option></select></div>
                  <div class="col-md-3 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.ts-card'))"><i class="bi bi-trash"></i>Remove</button></div>
                </div>
              </div>
            </div>
            <div><label class="fl">Review Text</label><textarea name="testimonials[0][review]" class="form-control" rows="2">Thanks again for the work! I'm glad I have really enjoyed working with you. Best of luck with your future.</textarea></div>
          </div>
        @endforelse
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Reviews</button></div>
  </form>
</section>

<!-- ─── CONTACT SECTION ─── -->
<section id="p-contact" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Edit the Contact section heading, description, and form settings shown at the bottom of your website.</div>
  <form action="{{ route('admin.contact.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-envelope-paper"></i>Contact Section Text</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Section Label (small tag)</label><input type="text" name="section_label" class="form-control" value="{{ old('section_label', $contact->section_label ?? 'Contact') }}"></div>
            <div class="mb-3"><label class="fl">Section Heading</label><input type="text" name="section_heading" class="form-control" value="{{ old('section_heading', $contact->section_heading ?? 'Get In Touch') }}"></div>
            <div class="mb-3"><label class="fl">Subtext / Description</label><textarea name="subtext" class="form-control" rows="2">{{ old('subtext', $contact->subtext ?? "Have a project in mind? I'd love to hear from you. Send a message and I'll get back to you shortly.") }}</textarea></div>
            <div class="mb-3"><label class="fl">Form POST Action URL</label><input type="text" name="form_action" class="form-control" value="{{ old('form_action', $contact->form_action ?? route('contact.post')) }}"></div>
            <div><label class="fl">Send Button Label</label><input type="text" name="button_label" class="form-control" value="{{ old('button_label', $contact->button_label ?? 'Send Message') }}"></div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-ui-checks"></i>Form Fields Visibility</div></div>
          <div class="cp-bd">
            <div class="sec-tog"><div class="sec-tog-info"><h6>Name Field</h6><p>Your Name *</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="show_name" value="1" {{ ($contact->show_name ?? true) ? 'checked' : '' }}></div></div>
            <div class="sec-tog"><div class="sec-tog-info"><h6>Email Field</h6><p>Your Email *</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="show_email" value="1" {{ ($contact->show_email ?? true) ? 'checked' : '' }}></div></div>
            <div class="sec-tog"><div class="sec-tog-info"><h6>Subject Field</h6><p>Subject</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="show_subject" value="1" {{ ($contact->show_subject ?? true) ? 'checked' : '' }}></div></div>
            <div class="sec-tog"><div class="sec-tog-info"><h6>Message Field</h6><p>Your Message *</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="show_message" value="1" {{ ($contact->show_message ?? true) ? 'checked' : '' }}></div></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-eye"></i>Contact Form Preview</div></div>
          <div class="cp-bd">
            <div class="contact-preview">
              <div style="text-align:center;margin-bottom:18px"><span style="font-size:11px;font-weight:700;color:var(--accent);text-transform:uppercase;letter-spacing:.1em">{{ $contact->section_label ?? 'Contact' }}</span><h4 style="font-weight:800;margin:6px 0 8px;font-size:18px">{{ $contact->section_heading ?? 'Get In Touch' }}</h4><p style="font-size:12.5px;color:var(--muted)">Have a project in mind? I'd love to hear from you.</p></div>
              @if($contact->show_name ?? true)
              <div class="{{ ($contact->show_email ?? true) ? 'col-6' : '' }} mb-2"><input class="form-control form-control-sm" placeholder="Your Name *" disabled></div>@endif
              @if($contact->show_email ?? true)
              <div class="mb-2"><input class="form-control form-control-sm" placeholder="Your Email *" disabled></div>@endif
              @if($contact->show_subject ?? true)
              <div class="mb-2"><input class="form-control form-control-sm" placeholder="Subject" disabled></div>@endif
              @if($contact->show_message ?? true)
              <div class="mb-3"><textarea class="form-control form-control-sm" rows="3" placeholder="Your Message *" disabled></textarea></div>@endif
              <div class="text-center"><button type="button" class="btn-p btn-sm" disabled><i class="bi bi-send"></i> {{ $contact->button_label ?? 'Send Message' }}</button></div>
            </div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-shield-check"></i>Spam Protection</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">reCAPTCHA Site Key</label><input type="text" name="recaptcha_key" class="form-control" value="{{ old('recaptcha_key', $contact->recaptcha_key ?? '') }}" placeholder="Paste your Google reCAPTCHA v3 site key"></div>
            <div class="mb-3"><label class="fl">Email Notification To</label><input type="email" name="notification_email" class="form-control" value="{{ old('notification_email', $contact->notification_email ?? '') }}" placeholder="sultanbayezidai@gmail.com"></div>
            <div><label class="fl">Auto-Reply Message</label><textarea name="auto_reply" class="form-control" rows="2" placeholder="Thank you for contacting me! I'll get back to you within 24 hours.">{{ old('auto_reply', $contact->auto_reply ?? '') }}</textarea></div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Contact</button></div>
  </form>
</section>

<!-- ─── MESSAGES ─── -->
<section id="p-messages" class="pg">
  <div class="row g-3">
    <div class="col-lg-5">
      <div class="cp" style="height:calc(100vh - 130px);display:flex;flex-direction:column">
        <div class="cp-hd">
          <div class="cp-tt"><i class="bi bi-envelope"></i>Inbox <span class="nbadge b-warn ms-2" id="unreadCount">{{ $unreadMessages ?? 0 }} new</span></div>
          <div class="d-flex gap-2">
            <button type="button" class="btn-g btn-sm" onclick="markAllReadAjax()" title="Mark all as read"><i class="bi bi-check2-all"></i></button>
            <button type="button" class="btn-d btn-sm" onclick="clearReadAjax()" title="Clear read messages"><i class="bi bi-trash"></i></button>
          </div>
        </div>
        <div style="padding:8px;border-bottom:1px solid var(--bd)">
          <input class="form-control form-control-sm" id="msgSearch" placeholder="Search messages..." oninput="searchMessages()">
        </div>
        <div style="flex:1;overflow-y:auto;padding:12px" id="inboxList">
          @forelse($messages ?? [] as $message)
            <div class="msg-row {{ $message->is_read ? '' : 'unread' }}" data-id="{{ $message->id }}" onclick="openMsg({{ $message->id }})">
              <div class="msg-ava {{ $message->is_read ? 'read' : '' }}">{{ $message->initials }}</div>
              <div style="flex:1;min-width:0">
                <div class="d-flex align-items-center gap-2 mb-1">
                  <div style="font-size:13px;font-weight:700">{{ $message->name }}</div>
                  @if(!$message->is_read)<span class="unread-badge">New</span>@endif
                </div>
                <div style="font-size:11.5px;color:var(--muted);font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">{{ $message->subject }}</div>
              </div>
              <div style="font-size:10.5px;color:var(--muted);font-family:var(--mono);white-space:nowrap;padding-left:6px">{{ $message->time_short }}</div>
            </div>
          @empty
            <div style="text-align:center;color:var(--muted);padding:30px 10px">
              <i class="bi bi-envelope" style="font-size:32px;display:block;margin-bottom:8px;opacity:.25"></i>
              <div style="font-size:14px;font-weight:600">No messages yet</div>
            </div>
          @endforelse
        </div>
        @if(($messages ?? null) && $messages->hasMorePages())
        <div style="padding:10px;border-top:1px solid var(--bd);text-align:center" id="loadMoreWrap">
          <button type="button" class="btn-g btn-sm" onclick="loadMoreMessages()" id="loadMoreBtn">
            <i class="bi bi-arrow-down-circle"></i> Load More
          </button>
        </div>
        @elseif(($messages ?? null) && $messages->total() > 0)
        <div style="padding:10px;border-top:1px solid var(--bd);text-align:center;color:var(--muted);font-size:12px;font-weight:600" id="loadMoreWrap">
          All messages loaded
        </div>
        @endif
      </div>
    </div>
    <div class="col-lg-7">
      <div class="cp" id="msgPanel" style="height:calc(100vh - 130px);display:flex;flex-direction:column">
        <div class="cp-hd" id="msgPanelHd">
          <div class="cp-tt"><i class="bi bi-envelope-open"></i>Select a message</div>
        </div>
        <div style="flex:1;display:flex;align-items:center;justify-content:center;padding:20px" id="msgPanelBody">
          <div style="text-align:center;color:var(--muted)"><i class="bi bi-envelope-open" style="font-size:44px;display:block;margin-bottom:12px;opacity:.25"></i><div style="font-size:14px;font-weight:600">Click a message to read it</div></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ─── SEO ─── -->
<section id="p-seo" class="pg">
  <div class="ib"><i class="bi bi-info-circle-fill"></i>Manage SEO metadata, Open Graph tags, and analytics integrations.</div>
  <form action="{{ route('admin.seo.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-7">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-search"></i>Basic SEO</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Page Title (Browser Tab)</label><input type="text" name="page_title" id="seoTitle" class="form-control" value="{{ old('page_title', $seo->page_title ?? 'Sultan Bayezid — Senior Full Stack Software Engineer') }}" oninput="updSEO()"></div>
            <div class="mb-3"><label class="fl">Meta Description</label><textarea name="meta_description" id="seoDesc" class="form-control" rows="2" oninput="updSEO()">{{ old('meta_description', $seo->meta_description ?? 'Senior Full Stack Software Engineer specializing in Laravel, Vue.js and modern web application development. Available for projects.') }}</textarea></div>
            <div class="mb-3"><label class="fl">Keywords (comma-separated)</label><input type="text" name="keywords" class="form-control" value="{{ old('keywords', $seo->keywords ?? 'sultan bayezid, full stack developer, laravel, vue js, software engineer, bangladesh') }}"></div>
            <div class="mb-3"><label class="fl">Canonical URL</label><input type="url" name="canonical_url" class="form-control" value="{{ old('canonical_url', $seo->canonical_url ?? 'https://lastlineweb.com') }}"></div>
            <div><label class="fl">Robots</label>
              <select name="robots" class="form-select"><option {{ ($seo->robots ?? 'index, follow') === 'index, follow' ? 'selected' : '' }}>index, follow</option><option {{ ($seo->robots ?? '') === 'noindex, nofollow' ? 'selected' : '' }}>noindex, nofollow</option><option {{ ($seo->robots ?? '') === 'index, nofollow' ? 'selected' : '' }}>index, nofollow</option></select></div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-share"></i>Open Graph / Social Preview</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">OG Title</label><input type="text" name="og_title" class="form-control" value="{{ old('og_title', $seo->og_title ?? 'Sultan Bayezid — Senior Full Stack Software Engineer') }}"></div>
            <div class="mb-3"><label class="fl">OG Description</label><textarea name="og_description" class="form-control" rows="2">{{ old('og_description', $seo->og_description ?? 'Hire a senior full stack software engineer for your next project. Specializing in Laravel, Vue.js and modern web stacks.') }}</textarea></div>
            <div class="mb-3"><label class="fl">OG Image URL</label><input type="url" name="og_image" class="form-control" value="{{ old('og_image', $seo->og_image ?? '') }}" placeholder="https://your-site.com/og-image.jpg"></div>
            <div class="mb-3"><label class="fl">Twitter Card Type</label>
              <select name="twitter_card" class="form-select"><option {{ ($seo->twitter_card ?? 'summary_large_image') === 'summary_large_image' ? 'selected' : '' }}>summary_large_image</option><option {{ ($seo->twitter_card ?? '') === 'summary' ? 'selected' : '' }}>summary</option></select></div>
            <div><label class="fl">Twitter Handle</label><input type="text" name="twitter_handle" class="form-control" value="{{ old('twitter_handle', $seo->twitter_handle ?? '') }}" placeholder="@username"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-eye"></i>Google Preview</div></div>
          <div class="cp-bd">
            <div class="seo-preview">
              <div class="seo-url">{{ $siteDomain ?? 'lastlineweb.com' }}</div>
              <div class="seo-title" id="seoPreviewTitle">{{ $seo->page_title ?? 'Sultan Bayezid — Senior Full Stack Software Engineer' }}</div>
              <div class="seo-desc" id="seoPreviewDesc">{{ $seo->meta_description ?? 'Senior Full Stack Software Engineer specializing in Laravel, Vue.js and modern web application development. Available for projects.' }}</div>
            </div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-bar-chart-line"></i>Analytics & Tracking</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Google Analytics (GA4) ID</label><input type="text" name="ga4_id" class="form-control" value="{{ old('ga4_id', $seo->ga4_id ?? '') }}" placeholder="G-XXXXXXXXXX"></div>
            <div class="mb-3"><label class="fl">Google Search Console Verify</label><input type="text" name="gsc_verify" class="form-control" value="{{ old('gsc_verify', $seo->gsc_verify ?? '') }}" placeholder="<meta name=google-site-verification ...>"></div>
            <div class="mb-3"><label class="fl">Facebook Pixel ID</label><input type="text" name="fb_pixel" class="form-control" value="{{ old('fb_pixel', $seo->fb_pixel ?? '') }}" placeholder="Paste your pixel ID here"></div>
            <div><label class="fl">Hotjar Site ID</label><input type="text" name="hotjar_id" class="form-control" value="{{ old('hotjar_id', $seo->hotjar_id ?? '') }}" placeholder="Paste your Hotjar ID"></div>
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-link-45deg"></i>Schema / Structured Data</div></div>
          <div class="cp-bd">
            <div class="mb-3"><label class="fl">Schema Type</label>
              <select name="schema_type" class="form-select"><option {{ ($seo->schema_type ?? 'Person') === 'Person' ? 'selected' : '' }}>Person</option><option {{ ($seo->schema_type ?? '') === 'ProfilePage' ? 'selected' : '' }}>ProfilePage</option><option {{ ($seo->schema_type ?? '') === 'WebSite' ? 'selected' : '' }}>WebSite</option></select></div>
            <div class="mb-0"><label class="fl">JSON-LD (Advanced)</label><textarea name="json_ld" class="form-control" rows="4" style="font-family:var(--mono);font-size:11.5px" placeholder='{"@context":"https://schema.org","@type":"Person","name":"Sultan Bayezid"}'>{{ old('json_ld', $seo->json_ld ?? '') }}</textarea></div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save SEO</button></div>
  </form>
</section>

<!-- ─── VISIBILITY ─── -->
<section id="p-visibility" class="pg">
  <div class="ib warn"><i class="bi bi-exclamation-triangle-fill"></i>Hiding a section will remove it from your live website immediately after saving.</div>
  <form action="{{ route('admin.visibility.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
    @csrf
    @method('PUT')
    <div class="row g-3">
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-eye"></i>Section Visibility</div></div>
          <div class="cp-bd">
            @foreach($sectionVisibility ?? [] as $key => $section)
              <div class="sec-tog"><div class="sec-tog-info"><h6>{{ $section['name'] }}</h6><p>{{ $section['description'] }}</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="sections[{{ $key }}]" value="1" {{ ($section['visible'] ?? true) ? 'checked' : '' }}></div></div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-sliders"></i>Navigation Bar Items</div></div>
          <div class="cp-bd">
            <div class="ib" style="margin-bottom:14px"><i class="bi bi-info-circle-fill"></i>Toggle which items appear in the site's top navigation.</div>
            @foreach($navVisibility ?? [] as $key => $nav)
              <div class="sec-tog"><div class="sec-tog-info"><h6>{{ $nav['name'] }}</h6><p>Links to #{{ $key }}</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="nav[{{ $key }}]" value="1" {{ ($nav['visible'] ?? true) ? 'checked' : '' }}></div></div>
            @endforeach
          </div>
        </div>
        <div class="cp">
          <div class="cp-hd"><div class="cp-tt"><i class="bi bi-moon-stars"></i>Dark Mode Support</div></div>
          <div class="cp-bd">
            <div class="sec-tog"><div class="sec-tog-info"><h6>Enable Dark Mode Toggle</h6><p>Show dark/light switch in navbar</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="dark_mode_toggle" value="1" {{ ($settings->dark_mode_toggle ?? false) ? 'checked' : '' }}></div></div>
            <div class="sec-tog"><div class="sec-tog-info"><h6>Default to Dark Mode</h6><p>Site loads in dark theme by default</p></div><div class="form-check form-switch mb-0"><input class="form-check-input" type="checkbox" name="dark_mode_default" value="1" {{ ($settings->dark_mode_default ?? false) ? 'checked' : '' }}></div></div>
          </div>
        </div>
      </div>
    </div>
    <div class="text-end mt-2"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Visibility</button></div>
  </form>
</section>

<!-- ─── SETTINGS ─── -->
<section id="p-settings" class="pg">
  <div class="row g-3">
    <div class="col-lg-6">
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-gear"></i>General Settings</div></div>
        <div class="cp-bd">
          <form action="{{ route('admin.settings.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
            @csrf @method('PUT')
            <div class="mb-3"><label class="fl">Site Title</label><input type="text" name="site_title" class="form-control" value="{{ old('site_title', $settings->site_title ?? 'Sultan Bayezid — Portfolio') }}"></div>
            <div class="mb-3"><label class="fl">Site Logo Text / Brand</label><input type="text" name="site_logo" class="form-control" value="{{ old('site_logo', $settings->site_logo ?? 'Sultan Bayezid') }}"></div>
            <div class="mb-3"><label class="fl">Footer Copyright Text</label><input type="text" name="copyright" class="form-control" value="{{ old('copyright', $settings->copyright ?? '© 2026 Sultan Bayezid. All rights reserved.') }}"></div>
            <div class="mb-3"><label class="fl">Primary Language</label>
              <select name="language" class="form-select"><option {{ ($settings->language ?? 'English') === 'English' ? 'selected' : '' }}>English</option><option {{ ($settings->language ?? '') === 'Bengali' ? 'selected' : '' }}>Bengali</option><option {{ ($settings->language ?? '') === 'Arabic' ? 'selected' : '' }}>Arabic</option></select></div>
            <div class="mb-3"><label class="fl">Timezone</label>
              <select name="timezone" class="form-select"><option {{ ($settings->timezone ?? 'Asia/Dhaka') === 'Asia/Dhaka' ? 'selected' : '' }}>Asia/Dhaka (UTC+6)</option><option {{ ($settings->timezone ?? '') === 'UTC+0' ? 'selected' : '' }}>UTC+0</option><option {{ ($settings->timezone ?? '') === 'America/New_York' ? 'selected' : '' }}>America/New_York</option></select></div>
            <div class="text-end"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Settings</button></div>
          </form>
        </div>
      </div>
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-palette2"></i>Theme / Colors</div></div>
        <div class="cp-bd">
          <form action="{{ route('admin.theme.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
            @csrf @method('PUT')
            <div class="row g-2">
              <div class="col-6 mb-2"><label class="fl">Primary Accent</label><input type="color" name="primary_accent" class="form-control form-control-color w-100" value="{{ old('primary_accent', $settings->primary_accent ?? '#4f63f0') }}"></div>
              <div class="col-6 mb-2"><label class="fl">Secondary Accent</label><input type="color" name="secondary_accent" class="form-control form-control-color w-100" value="{{ old('secondary_accent', $settings->secondary_accent ?? '#10b98a') }}"></div>
              <div class="col-6 mb-2"><label class="fl">Heading Color</label><input type="color" name="heading_color" class="form-control form-control-color w-100" value="{{ old('heading_color', $settings->heading_color ?? '#1a1d2e') }}"></div>
              <div class="col-6 mb-2"><label class="fl">Background</label><input type="color" name="background" class="form-control form-control-color w-100" value="{{ old('background', $settings->background ?? '#ffffff') }}"></div>
            </div>
            <div class="mb-3"><label class="fl">Body Font</label>
              <select name="body_font" class="form-select"><option {{ ($settings->body_font ?? 'Montserrat') === 'Montserrat' ? 'selected' : '' }}>Montserrat</option><option {{ ($settings->body_font ?? '') === 'Inter' ? 'selected' : '' }}>Inter</option><option {{ ($settings->body_font ?? '') === 'Poppins' ? 'selected' : '' }}>Poppins</option><option {{ ($settings->body_font ?? '') === 'Raleway' ? 'selected' : '' }}>Raleway</option><option {{ ($settings->body_font ?? '') === 'Open Sans' ? 'selected' : '' }}>Open Sans</option></select></div>
            <div class="mb-3"><label class="fl">Heading Font</label>
              <select name="heading_font" class="form-select"><option {{ ($settings->heading_font ?? 'Montserrat') === 'Montserrat' ? 'selected' : '' }}>Montserrat</option><option {{ ($settings->heading_font ?? '') === 'Playfair Display' ? 'selected' : '' }}>Playfair Display</option><option {{ ($settings->heading_font ?? '') === 'DM Serif Display' ? 'selected' : '' }}>DM Serif Display</option></select></div>
            <div class="text-end"><button type="submit" class="btn-p"><i class="bi bi-floppy"></i>Save Theme</button></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-shield-lock"></i>Admin Access</div></div>
        <div class="cp-bd">
          <form action="{{ route('admin.password.update') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">
            @csrf
            <div class="mb-3"><label class="fl">Admin Username</label><input type="text" class="form-control" value="{{ Auth::user()->name ?? 'admin' }}" disabled></div>
            <div class="mb-3"><label class="fl">Admin Email</label><input type="email" class="form-control" value="{{ Auth::user()->email ?? 'admin@example.com' }}" disabled></div>
            <div class="mb-3"><label class="fl">Current Password</label><input type="password" name="current_password" class="form-control" placeholder="Enter current password"></div>
            <div class="mb-3"><label class="fl">New Password</label><input type="password" name="password" class="form-control" placeholder="Enter new password"></div>
            <div class="mb-3"><label class="fl">Confirm New Password</label><input type="password" name="password_confirmation" class="form-control" placeholder="Repeat new password"></div>
            <button type="submit" class="btn-p"><i class="bi bi-key"></i>Update Password</button>
          </form>
        </div>
      </div>
      <div class="cp">
        <div class="cp-hd"><div class="cp-tt"><i class="bi bi-cloud-upload"></i>Backup & Export</div></div>
        <div class="cp-bd">
          <div class="ib" style="margin-bottom:14px"><i class="bi bi-info-circle-fill"></i>Export your portfolio content as JSON to back up or migrate.</div>
          <div class="d-grid gap-2">
            <form action="{{ route('admin.export.json') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">@csrf <button type="submit" class="btn-g justify-content-center w-100"><i class="bi bi-download"></i>Export All Content (JSON)</button></form>
            <form action="{{ route('admin.backup.create') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">@csrf <button type="submit" class="btn-g justify-content-center w-100"><i class="bi bi-cloud-check"></i>Create Site Backup</button></form>
            <form action="{{ route('admin.cache.clear') }}" method="POST" onsubmit="event.preventDefault(); ajaxSubmit(this)">@csrf <button type="submit" class="btn-g justify-content-center w-100"><i class="bi bi-arrow-clockwise"></i>Clear Cache</button></form>
            <form action="{{ route('admin.settings.reset') }}" method="POST" onsubmit="event.preventDefault(); if(confirm('Are you sure you want to reset to defaults? This cannot be undone.')){ajaxSubmit(this);}else{event.stopPropagation();}">@csrf @method('DELETE') <button type="submit" class="btn-d justify-content-center w-100"><i class="bi bi-exclamation-triangle"></i>Reset to Defaults</button></form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

@section('modals')
@php
  // Build category options from saved filter categories (skip "All Works" / first item)
  $catOptions = [];
  $filterCatsForDropdown = $filterCategories ?? [];
  foreach($filterCatsForDropdown as $fc) {
    $slug = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $fc));
    if($slug !== 'allworks') {
      $catOptions[$slug] = $fc;
    }
  }
  // Always include common extras not in filters
  if(!isset($catOptions['app'])) $catOptions['app'] = 'Web App';
@endphp
<!-- ═══ ADD PROJECT MODAL ═══ -->
<div class="modal fade" id="addProjectModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form action="{{ route('admin.projects.store') }}" method="POST" onsubmit="event.preventDefault(); addProject()">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2" style="color:var(--accent)"></i>Add New Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6"><label class="fl">Project Name *</label><input type="text" name="name" id="npName" class="form-control" placeholder="e.g. My Awesome App"></div>
            <div class="col-md-3"><label class="fl">Avatar Initials</label><input type="text" name="initials" id="npInit" class="form-control" placeholder="MA" maxlength="3"></div>
            <div class="col-md-3"><label class="fl">Accent Color</label><input type="color" name="color" id="npColor" class="form-control form-control-color w-100" value="#4f63f0"></div>
            <div class="col-md-8"><label class="fl">Live URL</label><input type="url" name="url" id="npUrl" class="form-control" placeholder="https://..."></div>
            <div class="col-md-4"><label class="fl">GitHub URL (optional)</label><input type="url" name="github_url" id="npGit" class="form-control" placeholder="https://github.com/..."></div>
            <div class="col-md-4"><label class="fl">Primary Category</label>
              <select name="category" id="npCat" class="form-select">
                @foreach($catOptions as $slug => $label)
                  <option value="{{ $slug }}">{{ $label }}</option>
                @endforeach
              </select></div>
            <div class="col-md-4"><label class="fl">Secondary Category</label>
              <select name="category2" id="npCat2" class="form-select"><option value="">None</option>
                @foreach($catOptions as $slug => $label)
                  <option value="{{ $slug }}">{{ $label }}</option>
                @endforeach
              </select></div>
            <div class="col-md-4"><label class="fl">Status</label>
              <select name="status" id="npStatus" class="form-select"><option>Live</option><option>Coming Soon</option><option>In Progress</option></select></div>
            <div class="col-12"><label class="fl">Description</label><textarea name="description" id="npDesc" class="form-control" rows="2" placeholder="Short project description shown on the card..."></textarea></div>
            <div class="col-md-6"><label class="fl">Technologies Used</label><input type="text" name="technologies" id="npTech" class="form-control" placeholder="Laravel, VueJS, MySQL"></div>
            <div class="col-md-6"><label class="fl">Year Completed</label><input type="text" name="year" id="npYear" class="form-control" placeholder="2024"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-g" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-p"><i class="bi bi-plus-lg"></i>Add Project</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit Project Modal -->
<div class="modal fade" id="editProjectModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form id="editProjectForm" onsubmit="event.preventDefault(); saveEditProject()">
        <div class="modal-header">
          <h5 class="modal-title"><i class="bi bi-pencil me-2" style="color:var(--accent)"></i>Edit Project</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="epId">
          <div class="row g-3">
            <div class="col-md-6"><label class="fl">Project Name *</label><input type="text" id="epName" class="form-control" placeholder="e.g. My Awesome App"></div>
            <div class="col-md-3"><label class="fl">Avatar Initials</label><input type="text" id="epInit" class="form-control" placeholder="MA" maxlength="3"></div>
            <div class="col-md-3"><label class="fl">Accent Color</label><input type="color" id="epColor" class="form-control form-control-color w-100" value="#4f63f0"></div>
            <div class="col-md-8"><label class="fl">Live URL</label><input type="url" id="epUrl" class="form-control" placeholder="https://..."></div>
            <div class="col-md-4"><label class="fl">GitHub URL (optional)</label><input type="url" id="epGithub" class="form-control" placeholder="https://github.com/..."></div>
            <div class="col-md-4"><label class="fl">Primary Category</label>
              <select id="epCat" class="form-select">
                @foreach($catOptions as $slug => $label)
                  <option value="{{ $slug }}">{{ $label }}</option>
                @endforeach
              </select></div>
            <div class="col-md-4"><label class="fl">Secondary Category</label>
              <select id="epCat2" class="form-select"><option value="">None</option>
                @foreach($catOptions as $slug => $label)
                  <option value="{{ $slug }}">{{ $label }}</option>
                @endforeach
              </select></div>
            <div class="col-md-4"><label class="fl">Status</label>
              <select id="epStatus" class="form-select"><option>Live</option><option>Coming Soon</option><option>In Progress</option></select></div>
            <div class="col-12"><label class="fl">Description</label><textarea id="epDesc" class="form-control" rows="2" placeholder="Short project description shown on the card..."></textarea></div>
            <div class="col-md-6"><label class="fl">Technologies Used</label><input type="text" id="epTech" class="form-control" placeholder="Laravel, VueJS, MySQL"></div>
            <div class="col-md-6"><label class="fl">Year Completed</label><input type="text" id="epYear" class="form-control" placeholder="2024"></div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-g" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn-p"><i class="bi bi-floppy"></i> Save Changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
