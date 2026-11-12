<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'SB Admin — Portfolio Manager')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
@stack('styles')
<style>
:root{
  --sw:260px;--th:64px;
  --base:#f0f2f8;--card:#ffffff;--card2:#f5f7ff;--hover:#eef0ff;
  --accent:#4f63f0;--accent2:#10b98a;--glow:rgba(79,99,240,.1);
  --bd:rgba(0,0,0,.08);--bd2:rgba(0,0,0,.14);
  --txt:#1a1d2e;--muted:#6b7280;
  --red:#e53e3e;--warn:#d97706;--green:#059669;
  --font:'Montserrat',sans-serif;--mono:'JetBrains Mono',monospace;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{font-family:var(--font);background:var(--base);color:var(--txt);overflow-x:hidden}

/* SIDEBAR */
#sidebar{position:fixed;top:0;left:0;width:var(--sw);height:100vh;background:var(--card);border-right:1px solid var(--bd);display:flex;flex-direction:column;z-index:1000;transition:transform .25s ease}
.s-logo{display:flex;align-items:center;gap:10px;padding:20px 20px 16px;border-bottom:1px solid var(--bd)}
.s-badge{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;color:#fff;font-family:var(--mono);flex-shrink:0}
.s-name{font-size:15px;font-weight:800;letter-spacing:-.02em;color:var(--txt)}
.s-sub{font-size:10px;color:var(--muted);font-family:var(--mono);margin-top:1px}
.s-nav{flex:1;overflow-y:auto;padding:12px 10px}
.s-nav::-webkit-scrollbar{width:0}
.s-lbl{font-size:9px;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--muted);padding:10px 10px 5px}
.ni{display:flex;align-items:center;gap:9px;padding:9px 12px;border-radius:9px;cursor:pointer;transition:all .15s;font-size:13px;font-weight:600;color:var(--muted);margin-bottom:1px;border:1px solid transparent;text-decoration:none}
.ni:hover{background:var(--hover);color:var(--txt);border-color:var(--bd)}
.ni.active{background:var(--glow);color:var(--accent);border-color:rgba(79,99,240,.2)}
.ni .ico{font-size:16px;width:18px;text-align:center;flex-shrink:0}
.nbadge{margin-left:auto;font-size:10px;font-weight:700;padding:1px 7px;border-radius:20px;font-family:var(--mono);color:#fff}
.nbadge.b-blue{background:var(--accent)}
.nbadge.b-warn{background:var(--warn)}
.nbadge.b-green{background:var(--green)}
.s-foot{padding:12px 10px;border-top:1px solid var(--bd)}
.u-card{display:flex;align-items:center;gap:10px;padding:9px 10px;border-radius:9px;cursor:pointer;transition:background .15s}
.u-card:hover{background:var(--hover)}
.u-ava{width:34px;height:34px;border-radius:9px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;color:#fff;font-family:var(--mono);flex-shrink:0}
.u-name{font-size:13px;font-weight:700}
.u-role{font-size:11px;color:var(--muted)}

/* TOPBAR */
#topbar{position:fixed;top:0;left:var(--sw);right:0;height:var(--th);background:rgba(255,255,255,.93);backdrop-filter:blur(14px);border-bottom:1px solid var(--bd);display:flex;align-items:center;padding:0 22px;gap:12px;z-index:900;box-shadow:0 1px 0 var(--bd)}
.tb-title{font-size:16px;font-weight:800;flex:1;letter-spacing:-.02em}
.tb-title span{color:var(--muted);font-weight:500;font-size:12.5px;margin-left:8px;letter-spacing:0}
.tb-btn{width:36px;height:36px;border-radius:9px;background:var(--card2);border:1px solid var(--bd);display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .15s;color:var(--muted);font-size:15px;text-decoration:none}
.tb-btn:hover{border-color:var(--bd2);color:var(--txt);background:var(--hover)}
.live-tag{display:flex;align-items:center;gap:6px;font-size:11px;font-weight:700;color:var(--green);background:rgba(5,150,105,.08);border:1px solid rgba(5,150,105,.2);padding:4px 11px;border-radius:20px;font-family:var(--mono);white-space:nowrap}
.live-dot{width:6px;height:6px;background:var(--green);border-radius:50%;animation:pulse 1.6s infinite}
@keyframes pulse{0%,100%{opacity:1}50%{opacity:.3}}
@keyframes spin{from{transform:rotate(0deg)}to{transform:rotate(360deg)}}
.spin{animation:spin 1s linear infinite;display:inline-block}
.nd{width:7px;height:7px;background:var(--accent);border-radius:50%;position:absolute;top:7px;right:7px}

/* MAIN */
#main{margin-left:var(--sw);padding-top:var(--th);min-height:100vh}
.pg{display:none;padding:26px 26px 50px;animation:fadeUp .2s ease}
.pg.active{display:block}
@keyframes fadeUp{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}

/* STAT GRID */
.s-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(170px,1fr));gap:14px;margin-bottom:22px}
.sc{background:var(--card);border:1px solid var(--bd);border-radius:14px;padding:18px 20px;position:relative;overflow:hidden;transition:box-shadow .2s,border-color .2s}
.sc:hover{box-shadow:0 4px 20px rgba(79,99,240,.1);border-color:var(--bd2)}
.sc::before{content:'';position:absolute;top:-24px;right:-16px;width:72px;height:72px;border-radius:50%;opacity:.1}
.sc.bl::before{background:var(--accent)}.sc.gr::before{background:var(--green)}.sc.wa::before{background:var(--warn)}.sc.re::before{background:var(--red)}
.s-ico{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:17px;margin-bottom:14px}
.s-ico.bl{background:rgba(79,99,240,.1);color:var(--accent)}
.s-ico.gr{background:rgba(5,150,105,.1);color:var(--green)}
.s-ico.wa{background:rgba(217,119,6,.1);color:var(--warn)}
.s-ico.re{background:rgba(229,62,62,.1);color:var(--red)}
.s-val{font-size:28px;font-weight:800;font-family:var(--mono);line-height:1;margin-bottom:5px}
.s-lbl2{font-size:12px;color:var(--muted);font-weight:600}

/* CARD PANEL */
.cp{background:var(--card);border:1px solid var(--bd);border-radius:14px;margin-bottom:20px;overflow:hidden}
.cp-hd{display:flex;align-items:center;justify-content:space-between;padding:15px 20px;border-bottom:1px solid var(--bd)}
.cp-tt{font-size:14px;font-weight:700;display:flex;align-items:center;gap:8px}
.cp-tt i{color:var(--accent)}
.cp-bd{padding:20px}

/* FORM */
.fl{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em;margin-bottom:6px;display:block}
.fc,.fs,textarea.fc{background:#f8faff !important;border:1.5px solid var(--bd) !important;color:var(--txt) !important;border-radius:9px !important;font-family:var(--font) !important;font-size:13px !important;font-weight:500 !important;transition:border-color .15s,box-shadow .15s !important}
.fc:focus,.fs:focus,textarea.fc:focus{border-color:var(--accent) !important;box-shadow:0 0 0 3px rgba(79,99,240,.12) !important;outline:none !important}
textarea.fc{resize:vertical;min-height:88px}
.form-control,.form-select{background:#f8faff !important;border:1.5px solid var(--bd) !important;color:var(--txt) !important;border-radius:9px !important;font-family:var(--font) !important;font-size:13px !important;font-weight:500 !important}
.form-control:focus,.form-select:focus{border-color:var(--accent) !important;box-shadow:0 0 0 3px rgba(79,99,240,.12) !important}
.form-check-input{background-color:#fff !important;border-color:var(--bd2) !important;cursor:pointer}
.form-check-input:checked{background-color:var(--accent) !important;border-color:var(--accent) !important}
.input-group-text{background:#eef0ff !important;border:1.5px solid var(--bd) !important;color:var(--muted) !important;font-family:var(--font) !important}

/* SKILL ROW */
.sk-row{display:flex;align-items:center;gap:9px;padding:10px 14px;border-radius:9px;background:#f8faff;border:1.5px solid var(--bd);margin-bottom:8px;transition:border-color .15s}
.sk-row:hover{border-color:var(--bd2)}
.sk-in{flex:1;background:transparent !important;border:none !important;color:var(--txt) !important;font-size:13px;font-weight:600}
.sk-in:focus{box-shadow:none !important}
.sk-pct{width:52px;text-align:center;background:#eef0ff !important;border:1.5px solid rgba(79,99,240,.2) !important;border-radius:7px;font-family:var(--mono);font-size:12px;color:var(--accent) !important;padding:3px 6px;font-weight:700}
.sk-bar{flex:1;height:5px;background:#e8ecff;border-radius:10px;overflow:hidden;min-width:70px}
.sk-fill{height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:10px;transition:width .3s}

/* PROJECT ROW */
.pr-row{display:flex;align-items:center;gap:13px;padding:12px 14px;border-radius:10px;border:1.5px solid var(--bd);margin-bottom:8px;background:#f8faff;transition:all .15s}
.pr-row:hover{border-color:var(--bd2);background:#fff;box-shadow:0 2px 12px rgba(79,99,240,.07)}
.pr-thumb{width:44px;height:44px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;font-family:var(--mono);flex-shrink:0}
.pr-info{flex:1;min-width:0}
.pr-title{font-size:13.5px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.pr-url{font-size:11px;color:var(--muted);font-family:var(--mono)}

/* TAGS */
.tpill{font-size:10px;font-weight:700;padding:3px 9px;border-radius:20px;background:rgba(79,99,240,.1);color:var(--accent);border:1px solid rgba(79,99,240,.2);white-space:nowrap}
.tpill.gr{background:rgba(5,150,105,.1);color:var(--green);border-color:rgba(5,150,105,.2)}
.tpill.wa{background:rgba(217,119,6,.1);color:var(--warn);border-color:rgba(217,119,6,.2)}
.tpill.re{background:rgba(229,62,62,.1);color:var(--red);border-color:rgba(229,62,62,.2)}

/* SERVICE CARD */
.sv-card{background:#f8faff;border:1.5px solid var(--bd);border-radius:10px;padding:14px 16px;margin-bottom:10px;transition:border-color .15s}
.sv-card:hover{border-color:var(--bd2)}
.sv-ico{width:40px;height:40px;border-radius:10px;background:rgba(79,99,240,.1);color:var(--accent);display:flex;align-items:center;justify-content:center;font-size:19px;flex-shrink:0}

/* TESTIMONIALS */
.ts-card{background:#f8faff;border:1.5px solid var(--bd);border-radius:10px;padding:16px;margin-bottom:10px;transition:border-color .15s}
.ts-card:hover{border-color:var(--bd2)}
.ts-ava{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:800;font-family:var(--mono);flex-shrink:0;color:#fff}

/* MESSAGE */
.msg-row{display:flex;align-items:flex-start;gap:11px;padding:13px 14px;border-radius:10px;background:#f8faff;border:1.5px solid var(--bd);margin-bottom:7px;cursor:pointer;transition:all .15s}
.msg-row:hover{border-color:var(--bd2);background:#fff}
.msg-row.unread{border-left:3px solid var(--accent);background:#fff}
.msg-row.active-msg{border-color:var(--accent);background:var(--hover)}
.msg-ava{width:38px;height:38px;border-radius:10px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:800;font-family:var(--mono);flex-shrink:0;color:#fff}
.msg-ava.read{background:linear-gradient(135deg,#c4cbf0,#a8d5c4)}
.unread-badge{font-size:9px;font-weight:700;padding:1px 7px;border-radius:20px;background:var(--accent);color:#fff;font-family:var(--mono)}

/* BUTTONS */
.btn-p{background:var(--accent);color:#fff;border:none;border-radius:9px;font-size:13px;font-weight:700;padding:9px 20px;cursor:pointer;transition:opacity .15s,transform .1s;font-family:var(--font);display:inline-flex;align-items:center;gap:6px}
.btn-p:hover{opacity:.88}.btn-p:active{transform:scale(.97)}
.btn-p.green{background:var(--green)}
.btn-p.red{background:var(--red)}
.btn-g{background:transparent;color:var(--muted);border:1.5px solid var(--bd);border-radius:9px;font-size:13px;font-weight:600;padding:7px 15px;cursor:pointer;transition:all .15s;font-family:var(--font);display:inline-flex;align-items:center;gap:5px}
.btn-g:hover{background:var(--hover);color:var(--txt);border-color:var(--bd2)}
.btn-e{background:rgba(79,99,240,.1);color:var(--accent);border:1px solid rgba(79,99,240,.2);border-radius:7px;font-size:12px;padding:4px 10px;cursor:pointer;transition:all .15s;font-family:var(--font);display:inline-flex;align-items:center;gap:4px;font-weight:600}
.btn-e:hover{background:rgba(79,99,240,.18)}
.btn-d{background:rgba(229,62,62,.08);color:var(--red);border:1px solid rgba(229,62,62,.18);border-radius:7px;font-size:12px;padding:4px 10px;cursor:pointer;transition:all .15s;font-family:var(--font);display:inline-flex;align-items:center;gap:4px;font-weight:600}
.btn-d:hover{background:rgba(229,62,62,.15)}

/* INFO BANNER */
.ib{background:rgba(79,99,240,.06);border:1px solid rgba(79,99,240,.16);border-radius:9px;padding:10px 14px;font-size:12.5px;color:var(--muted);display:flex;align-items:center;gap:8px;margin-bottom:16px;font-weight:500}
.ib i{color:var(--accent);font-size:15px;flex-shrink:0}
.ib.green{background:rgba(5,150,105,.06);border-color:rgba(5,150,105,.18)}
.ib.green i{color:var(--green)}
.ib.warn{background:rgba(217,119,6,.06);border-color:rgba(217,119,6,.18)}
.ib.warn i{color:var(--warn)}

/* DIVIDER ROW */
.info-tr{display:grid;grid-template-columns:130px 1fr;align-items:center;gap:10px;padding:10px 0;border-bottom:1px solid var(--bd)}
.info-tr:last-child{border-bottom:none}
.info-k{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.07em}

/* SECTION TOGGLE */
.sec-tog{display:flex;align-items:center;justify-content:space-between;padding:12px 0;border-bottom:1px solid var(--bd)}
.sec-tog:last-child{border-bottom:none}
.sec-tog-info h6{font-size:13.5px;font-weight:700;margin:0 0 2px}
.sec-tog-info p{font-size:11.5px;color:var(--muted);margin:0}

/* ACTIVITY */
.act-item{display:flex;align-items:flex-start;gap:12px;padding:12px 18px;border-bottom:1px solid var(--bd)}
.act-item:last-child{border-bottom:none}
.act-dot{width:8px;height:8px;border-radius:50%;flex-shrink:0;margin-top:4px}

/* MODAL */
.modal-content{border-radius:14px !important;border:1.5px solid var(--bd) !important;box-shadow:0 20px 60px rgba(79,99,240,.15) !important;font-family:var(--font)}
.modal-header{border-bottom:1px solid var(--bd) !important;padding:18px 22px !important}
.modal-body{padding:20px 22px !important}
.modal-footer{border-top:1px solid var(--bd) !important;padding:14px 22px !important}
.modal-title{font-weight:800 !important;font-size:15px !important;color:var(--txt)}

/* PROGRESS HEALTH */
.health-bar{height:7px;background:#e8ecff;border-radius:10px;overflow:hidden;margin-top:7px}
.health-fill{height:100%;background:linear-gradient(90deg,var(--accent),var(--accent2));border-radius:10px}

/* TOAST */
#toast-area{position:fixed;bottom:24px;right:24px;z-index:9999;display:flex;flex-direction:column;gap:8px}
.t-item{background:var(--card);border:1.5px solid var(--bd);border-radius:11px;padding:12px 16px;min-width:250px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:10px;animation:tIn .25s ease;box-shadow:0 8px 30px rgba(0,0,0,.1)}
.t-item.s{border-color:rgba(5,150,105,.25)}.t-item.s i{color:var(--green)}
.t-item.e{border-color:rgba(229,62,62,.25)}.t-item.e i{color:var(--red)}
@keyframes tIn{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}

/* HIRE BANNER PREVIEW */
.hire-preview{background:linear-gradient(135deg,var(--accent) 0%,var(--accent2) 100%);border-radius:14px;padding:28px 30px;color:#fff;position:relative;overflow:hidden}
.hire-preview::before{content:'';position:absolute;top:-30px;right:-30px;width:150px;height:150px;background:rgba(255,255,255,.08);border-radius:50%}
.hire-preview h3{font-size:20px;font-weight:800;margin-bottom:8px}
.hire-preview p{font-size:13px;opacity:.88;margin-bottom:16px}
.hire-preview .hire-btn{background:rgba(255,255,255,.2);border:2px solid rgba(255,255,255,.4);color:#fff;border-radius:9px;font-size:13px;font-weight:700;padding:9px 22px;display:inline-flex;align-items:center;gap:7px;font-family:var(--font);cursor:pointer}

/* CONTACT PREVIEW */
.contact-preview{background:#f8faff;border:1.5px solid var(--bd);border-radius:12px;padding:22px;margin-bottom:16px}

/* SEO CARD */
.seo-preview{background:var(--card2);border:1.5px solid var(--bd);border-radius:10px;padding:14px 18px}
.seo-url{font-size:13px;color:var(--green);font-family:var(--mono);margin-bottom:4px}
.seo-title{font-size:18px;color:#1a0dab;font-weight:600;margin-bottom:3px}
.seo-desc{font-size:13px;color:#545454;line-height:1.5}

/* MOBILE */
#overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.3);z-index:999}
@media(max-width:900px){
  #sidebar{transform:translateX(-100%)}
  #sidebar.open{transform:translateX(0)}
  #topbar{left:0}
  #main{margin-left:0}
  #overlay.show{display:block}
  .pg{padding:16px 14px 40px}
}
</style>
</head>
<body>

@include('partials.admin.sidebar')

<!-- OVERLAY -->
<div id="overlay" onclick="closeSB()"></div>

@include('partials.admin.topbar')

<!-- ═══════════════════════════ MAIN ═══════════════════════════ -->
<main id="main">
    @yield('content')
</main><!-- /main -->

@yield('modals')

<!-- TOAST AREA -->
<div id="toast-area"></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
<script>
const T={dashboard:['Dashboard','Overview'],hero:['Hero Section','Edit landing content'],about:['About Me','Bio & personal info'],projects:['Projects','Portfolio management'],skills:['Skills','Proficiency editor'],services:['Services','What you offer'],hirebanner:['Hire Banner','CTA section'],testimonials:['Testimonials','Client reviews'],contact:['Contact Section','Form & settings'],messages:['Messages','Inbox'],seo:['SEO & Meta','Search optimization'],visibility:['Visibility','Show/hide sections'],settings:['Settings','Site configuration']};

function goto(id,el){
  document.querySelectorAll('.pg').forEach(p=>p.classList.remove('active'));
  document.querySelectorAll('.ni').forEach(n=>n.classList.remove('active'));
  document.getElementById('p-'+id).classList.add('active');
  if(el)el.classList.add('active');
  const t=T[id]||[id,''];
  document.getElementById('topTitle').innerHTML=t[0]+' <span>'+t[1]+'</span>';
  closeSB();
}
function qsel(id){return document.querySelector('[onclick*="\''+id+'\'"]')}
function toggleSB(){document.getElementById('sidebar').classList.toggle('open');document.getElementById('overlay').classList.toggle('show')}
function closeSB(){document.getElementById('sidebar').classList.remove('open');document.getElementById('overlay').classList.remove('show')}

function toast(msg,type='s'){
  const a=document.getElementById('toast-area');
  const el=document.createElement('div');
  el.className='t-item '+type;
  el.innerHTML=`<i class="bi bi-${type==='s'?'check-circle-fill':'x-circle-fill'}"></i>${msg}`;
  a.appendChild(el);
  setTimeout(()=>{el.style.transition='opacity .3s';el.style.opacity='0';setTimeout(()=>el.remove(),300)},2800);
}

function saveAll(){toast('All changes saved successfully!','s')}

function rmRow(btn){
  const row=btn.closest('.sk-row,.pr-row,.ts-card,.sv-card,.msg-row,.col-auto')||btn.parentElement;
  if(row){row.style.transition='all .2s';row.style.opacity='0';row.style.transform='translateX(8px)';setTimeout(()=>row.remove(),200);toast('Removed','s')}
}

function updBar(inp){
  const row=inp.closest('.sk-row');
  const bar=row.querySelector('.sk-fill');
  const v=Math.min(100,Math.max(0,parseInt(inp.value)||0));
  bar.style.width=v+'%';
  inp.value=v;
}

function addSkill(cid){
  const c=document.getElementById(cid);
  const d=document.createElement('div');
  d.className='sk-row';
  var prefix=cid==='skL'?'backend_skills':'frontend_skills';
  d.innerHTML=`<input type="text" name="`+prefix+`[name][]" class="form-control sk-in" placeholder="Skill name"><div class="sk-bar"><div class="sk-fill" style="width:70%"></div></div><input type="number" name="`+prefix+`[pct][]" class="sk-pct form-control" value="70" min="0" max="100" onchange="updBar(this)"><span style="font-size:11px;color:var(--muted);font-weight:600">%</span><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button>`;
  c.appendChild(d);
  d.querySelector('input').focus();
}

function addTypingWord(){
  const c=document.getElementById('typingWords');
  const d=document.createElement('div');d.className='sk-row';
  d.innerHTML=`<input type="text" name="typing_words[]" class="form-control sk-in" placeholder="e.g. UI Designer"><button type="button" class="btn-d" onclick="rmRow(this)"><i class="bi bi-x"></i></button>`;
  c.appendChild(d);d.querySelector('input').focus();
}

function addFilter(){
  var fl=document.getElementById('filterList');
  var btn=fl.querySelector('.btn-g');
  var name=prompt('Filter button label:');
  if(!name||!name.trim())return;
  name=name.trim();
  var d=document.createElement('div');d.className='col-auto filter-item';
  d.innerHTML='<div class="d-flex align-items-center gap-2 bg-light border rounded-pill px-3 py-1"><input type="hidden" name="filters[]" value="'+name.replace(/"/g,'&quot;')+'"><span style="font-size:13px;font-weight:600">'+name+'</span><button type="button" class="btn-d p-1 border-0 bg-transparent" style="font-size:12px" onclick="removeFilter(this)"><i class="bi bi-x"></i></button></div>';
  fl.insertBefore(d,btn);
  toast('Filter "'+name+'" added — click Save Filters to persist','s');
}

function removeFilter(btn){
  var col=btn.closest('.col-auto');
  if(col){
    col.style.transition='all .2s';
    col.style.opacity='0';
    col.style.transform='translateX(8px)';
    setTimeout(function(){col.remove();},200);
  }
}

function addService(){
  const c=document.getElementById('servicesList');
  var idx=c.querySelectorAll('.sv-card').length;
  const d=document.createElement('div');d.className='sv-card';
  d.innerHTML=`<div class="d-flex align-items-start gap-3"><div class="sv-ico"><i class="bi bi-star"></i></div><div class="flex-grow-1"><div class="row g-2"><div class="col-md-3"><label class="fl">Title</label><input type="text" name="services[`+idx+`][title]" class="form-control form-control-sm" placeholder="Service name"></div><div class="col-md-3"><label class="fl">Icon Class</label><input type="text" name="services[`+idx+`][icon]" class="form-control form-control-sm" placeholder="bi-star" onchange="updSvIcon(this)"></div><div class="col-md-5"><label class="fl">Short Description</label><input type="text" name="services[`+idx+`][description]" class="form-control form-control-sm" placeholder="Describe this service..."></div><div class="col-md-1 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.sv-card'))"><i class="bi bi-trash"></i></button></div></div></div></div>`;
  c.appendChild(d);
  d.scrollIntoView({behavior:'smooth'});
}

function updSvIcon(inp){
  const ico=inp.closest('.sv-card').querySelector('.sv-ico i');
  ico.className='bi '+inp.value;
}

function addTestimonial(){
  const c=document.getElementById('tsContainer');
  var idx=c.querySelectorAll('.ts-card').length;
  const d=document.createElement('div');d.className='ts-card';
  d.innerHTML=`<div class="d-flex align-items-center gap-3 mb-3"><div class="ts-ava" style="background:linear-gradient(135deg,var(--accent),var(--accent2))">??</div><div class="flex-grow-1"><div class="row g-2"><div class="col-md-4"><label class="fl">Client Name</label><input type="text" name="testimonials[`+idx+`][name]" class="form-control form-control-sm" placeholder="Client name"></div><div class="col-md-2"><label class="fl">Initials</label><input type="text" name="testimonials[`+idx+`][initials]" class="form-control form-control-sm" placeholder="AB" maxlength="2"></div><div class="col-md-3"><label class="fl">Rating</label><select name="testimonials[`+idx+`][rating]" class="form-select form-select-sm"><option value="5">5</option><option value="4">4</option><option value="3">3</option></select></div><div class="col-md-3 d-flex align-items-end"><button type="button" class="btn-d w-100 justify-content-center" onclick="rmRow(this.closest('.ts-card'))"><i class="bi bi-trash"></i>Remove</button></div></div></div></div><div><label class="fl">Review Text</label><textarea name="testimonials[`+idx+`][review]" class="form-control" rows="2" placeholder="Write the client's review..."></textarea></div>`;
  c.appendChild(d);d.scrollIntoView({behavior:'smooth'});
}

function addProject(){
  var name=document.getElementById('npName').value.trim();
  var init=document.getElementById('npInit').value.trim()||'P';
  var url=document.getElementById('npUrl').value.trim()||'#';
  var color=document.getElementById('npColor').value;
  var cat=document.getElementById('npCat').value;
  var cat2=document.getElementById('npCat2').value;
  var desc=document.getElementById('npDesc').value.trim();
  var git=document.getElementById('npGit').value.trim();
  var tech=document.getElementById('npTech').value.trim();
  var year=document.getElementById('npYear').value.trim();
  var status=document.getElementById('npStatus').value;
  if(!name){toast('Please enter a project name','e');return;}

  // Send AJAX request
  var fd=new FormData();
  fd.append('name',name);
  fd.append('initials',init);
  fd.append('url',url);
  fd.append('color_start','#f0f0ff');
  fd.append('color_end',color);
  fd.append('categories',cat+(cat2?' '+cat2:''));
  fd.append('description',desc);
  fd.append('github_url',git);
  fd.append('technologies',tech);
  fd.append('year',year);
  fd.append('status',status);
  fd.append('_token',document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||document.querySelector('input[name="_token"]')?.value);

  fetch('{{ route("admin.projects.store") }}',{method:'POST',headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},body:fd})
  .then(function(r){return r.json()})
  .then(function(data){
    if(data.success){
      var newId=(data.data&&data.data.id)?data.data.id:'';
      var domain=url.replace(/https?:\/\//,'').split('/')[0]||url;
      var list=document.getElementById('projectList');
      var catStr=cat+(cat2?' '+cat2:'');
      var catLabel=cat.charAt(0).toUpperCase()+cat.slice(1).replace(/([A-Z])/g,' $1');
      var cat2Label=cat2?(cat2.charAt(0).toUpperCase()+cat2.slice(1).replace(/([A-Z])/g,' $1')):'';
      var d=document.createElement('div');d.className='pr-row';
      d.setAttribute('data-id',newId);
      d.setAttribute('data-cat',catStr);
      d.setAttribute('data-url',url);
      d.setAttribute('data-initials',init);
      d.setAttribute('data-color-start','#f0f0ff');
      d.setAttribute('data-color-end',color);
      d.setAttribute('data-description',desc);
      d.setAttribute('data-github',git);
      d.setAttribute('data-technologies',tech);
      d.setAttribute('data-year',year);
      d.setAttribute('data-status',status);
      var tagsHtml='<span class="tpill">'+catLabel.trim()+'</span>'+(cat2?'<span class="tpill">'+cat2Label.trim()+'</span>':'')+(status!=='Live'?'<span class="tpill wa">'+status+'</span>':'');
      var delRoute='{{ route("admin.projects.destroy", 0) }}'.replace('/0','/'+newId);
      var csrfToken=document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||'';
      d.innerHTML='<div class="pr-thumb" style="background:linear-gradient(135deg,#f0f0ff,'+color+');color:#fff">'+init+'</div><div class="pr-info"><div class="pr-title">'+name+'</div><div class="pr-url">'+domain+'</div></div><div class="d-flex gap-1 flex-wrap">'+tagsHtml+'</div><div class="d-flex gap-1 ms-2"><button class="btn-e" onclick="editProject(this)"><i class="bi bi-pencil"></i>Edit</button><button class="btn-d" onclick="deleteProject(this,'+newId+')"><i class="bi bi-trash"></i></button></div>';
      list.appendChild(d);
      document.getElementById('npName').value='';
      document.getElementById('npInit').value='';
      document.getElementById('npUrl').value='';
      document.getElementById('npGit').value='';
      document.getElementById('npDesc').value='';
      document.getElementById('npTech').value='';
      document.getElementById('npYear').value='';
      bootstrap.Modal.getInstance(document.getElementById('addProjectModal')).hide();
      toast('Project "'+name+'" added!','s');
      updatePrCount();
    } else { toast('Failed to add project','e'); }
  })
  .catch(function(){ toast('Error adding project','e'); });
}

function markAllReadAjax(){
  fetch('{{ route("admin.messages.markAllRead") }}',{method:'POST',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.success){
      toast(d.message||'All messages marked as read','s');
      document.querySelectorAll('.msg-row.unread').forEach(function(r){
        r.classList.remove('unread');
        var ava=r.querySelector('.msg-ava');if(ava)ava.classList.add('read');
        var badge=r.querySelector('.unread-badge');if(badge)badge.remove();
      });
      updateUnreadCount();
    }else{toast('Error','e');}
  })
  .catch(function(){toast('Error','e');});
}

function clearReadAjax(){
  fetch('{{ route("admin.messages.clearRead") }}',{method:'DELETE',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.success){
      toast(d.message||'Read messages cleared','s');
      document.querySelectorAll('.msg-row:not(.unread)').forEach(function(r){r.remove();});
      // If message panel was showing a deleted message, reset it
      var panel=document.getElementById('msgPanelBody');
      if(panel&&panel.querySelector('.msg-detail')){resetMsgPanel();}
    }else{toast('Error','e');}
  })
  .catch(function(){toast('Error','e');});
}

function updateUnreadCount(){
  var count=document.querySelectorAll('.msg-row.unread').length;
  var el=document.getElementById('unreadCount');
  if(el)el.textContent=count+' new';
  // Also update sidebar badge
  var sidebarBadge=document.querySelector('#sidebar .ni:nth-child(15) .nbadge');
  if(sidebarBadge)sidebarBadge.textContent=count;
}

function resetMsgPanel(){
  var hd=document.getElementById('msgPanelHd');
  var body=document.getElementById('msgPanelBody');
  if(hd)hd.innerHTML='<div class="cp-tt"><i class="bi bi-envelope-open"></i>Select a message</div>';
  if(body)body.innerHTML='<div style="text-align:center;color:var(--muted)"><i class="bi bi-envelope-open" style="font-size:44px;display:block;margin-bottom:12px;opacity:.25"></i><div style="font-size:14px;font-weight:600">Click a message to read it</div></div>';
}

var msgCurrentPage=1;
var msgLoading=false;
var msgSearchTimer=null;

function openMsg(id){
  // Highlight active row
  document.querySelectorAll('.msg-row').forEach(function(r){r.classList.remove('active-msg');});
  var row=document.querySelector('.msg-row[data-id="'+id+'"]');
  if(row)row.classList.add('active-msg');

  fetch('/admin/messages/'+id,{headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.success){
      var m=d.data;
      var hd=document.getElementById('msgPanelHd');
      var body=document.getElementById('msgPanelBody');
      if(hd)hd.innerHTML='<div class="cp-tt"><i class="bi bi-envelope-fill" style="color:var(--accent)"></i>'+escHtml(m.subject)+'</div><div class="d-flex gap-2"><button class="btn-d btn-sm" onclick="deleteMessage('+m.id+')"><i class="bi bi-trash"></i> Delete</button></div>';
      if(body)body.innerHTML='<div class="msg-detail" style="padding:4px"><div class="d-flex align-items-center gap-3 mb-4"><div class="msg-ava" style="width:46px;height:46px;font-size:14px">'+escHtml(m.initials)+'</div><div><div style="font-size:15px;font-weight:700">'+escHtml(m.name)+'</div><div style="font-size:12px;color:var(--muted)">'+escHtml(m.email)+'</div></div><div style="margin-left:auto;font-size:11px;color:var(--muted);font-family:var(--mono)">'+escHtml(m.time_full)+'</div></div><div style="font-size:14px;line-height:1.75;color:var(--txt);white-space:pre-wrap">'+escHtml(m.body)+'</div></div>';
      // Mark the inbox row as read
      if(row){
        row.classList.remove('unread');
        var ava=row.querySelector('.msg-ava');if(ava)ava.classList.add('read');
        var badge=row.querySelector('.unread-badge');if(badge)badge.remove();
        row.setAttribute('data-read','1');
        updateUnreadCount();
      }
    }else{toast('Failed to load message','e');}
  })
  .catch(function(){toast('Error loading message','e');});
}

function deleteMessage(id){
  if(!confirm('Delete this message?'))return;
  fetch('/admin/messages/'+id,{method:'DELETE',headers:{'X-CSRF-TOKEN':document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.success){
      var row=document.querySelector('.msg-row[data-id="'+id+'"]');
      if(row){row.style.transition='all .2s';row.style.opacity='0';setTimeout(function(){row.remove();},200);}
      resetMsgPanel();
      updateUnreadCount();
      toast('Message deleted','s');
    }else{toast(d.message||'Delete failed','e');}
  })
  .catch(function(){toast('Error deleting message','e');});
}

function loadMoreMessages(){
  if(msgLoading)return;
  msgLoading=true;
  msgCurrentPage++;
  var btn=document.getElementById('loadMoreBtn');
  if(btn){btn.innerHTML='<i class="bi bi-arrow-repeat spin"></i> Loading...';btn.disabled=true;}
  var searchVal=document.getElementById('msgSearch')?document.getElementById('msgSearch').value.trim():'';
  var url='/admin/messages?page='+msgCurrentPage;
  if(searchVal)url+='&search='+encodeURIComponent(searchVal);
  fetch(url,{headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
  .then(function(r){return r.json()})
  .then(function(d){
    if(d.success&&d.data.length>0){
      var list=document.getElementById('inboxList');
      d.data.forEach(function(m){
        // Skip if already rendered
        if(document.querySelector('.msg-row[data-id="'+m.id+'"]'))return;
        var div=document.createElement('div');
        div.className='msg-row'+(m.is_read?'':' unread');
        div.setAttribute('data-id',m.id);
        div.setAttribute('onclick','openMsg('+m.id+')');
        div.innerHTML='<div class="msg-ava'+(m.is_read?' read':'')+'">'+escHtml(m.initials)+'</div><div style="flex:1;min-width:0"><div class="d-flex align-items-center gap-2 mb-1"><div style="font-size:13px;font-weight:700">'+escHtml(m.name)+'</div>'+(m.is_read?'':'<span class="unread-badge">New</span>')+'</div><div style="font-size:11.5px;color:var(--muted);font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'+escHtml(m.subject)+'</div></div><div style="font-size:10.5px;color:var(--muted);font-family:var(--mono);white-space:nowrap;padding-left:6px">'+escHtml(m.time_short)+'</div>';
        list.appendChild(div);
      });
      // Update load more button
      var wrap=document.getElementById('loadMoreWrap');
      if(wrap){
        if(d.has_more_pages){
          wrap.innerHTML='<button type="button" class="btn-g btn-sm" onclick="loadMoreMessages()" id="loadMoreBtn"><i class="bi bi-arrow-down-circle"></i> Load More</button>';
        }else{
          wrap.innerHTML='<span style="color:var(--muted);font-size:12px;font-weight:600">All messages loaded</span>';
        }
      }
    }else{
      var wrap2=document.getElementById('loadMoreWrap');
      if(wrap2)wrap2.innerHTML='<span style="color:var(--muted);font-size:12px;font-weight:600">All messages loaded</span>';
    }
  })
  .catch(function(){toast('Error loading messages','e');})
  .finally(function(){msgLoading=false;});
}

function searchMessages(){
  clearTimeout(msgSearchTimer);
  msgSearchTimer=setTimeout(function(){
    var search=document.getElementById('msgSearch')?document.getElementById('msgSearch').value.trim():'';
    msgCurrentPage=1;
    var url='/admin/messages?page=1';
    if(search)url+='&search='+encodeURIComponent(search);
    fetch(url,{headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'}})
    .then(function(r){return r.json()})
    .then(function(d){
      if(d.success){
        var list=document.getElementById('inboxList');
        list.innerHTML='';
        if(d.data.length===0){
          list.innerHTML='<div style="text-align:center;color:var(--muted);padding:30px 10px"><i class="bi bi-search" style="font-size:28px;display:block;margin-bottom:8px;opacity:.25"></i><div style="font-size:14px;font-weight:600">No messages found</div></div>';
        }else{
          d.data.forEach(function(m){
            var div=document.createElement('div');
            div.className='msg-row'+(m.is_read?'':' unread');
            div.setAttribute('data-id',m.id);
            div.setAttribute('onclick','openMsg('+m.id+')');
            div.innerHTML='<div class="msg-ava'+(m.is_read?' read':'')+'">'+escHtml(m.initials)+'</div><div style="flex:1;min-width:0"><div class="d-flex align-items-center gap-2 mb-1"><div style="font-size:13px;font-weight:700">'+escHtml(m.name)+'</div>'+(m.is_read?'':'<span class="unread-badge">New</span>')+'</div><div style="font-size:11.5px;color:var(--muted);font-weight:500;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">'+escHtml(m.subject)+'</div></div><div style="font-size:10.5px;color:var(--muted);font-family:var(--mono);white-space:nowrap;padding-left:6px">'+escHtml(m.time_short)+'</div>';
            list.appendChild(div);
          });
        }
        // Update load more
        var wrap=document.getElementById('loadMoreWrap');
        if(wrap){
          if(d.has_more_pages){
            wrap.innerHTML='<button type="button" class="btn-g btn-sm" onclick="loadMoreMessages()" id="loadMoreBtn"><i class="bi bi-arrow-down-circle"></i> Load More</button>';
          }else if(d.total>0){
            wrap.innerHTML='<span style="color:var(--muted);font-size:12px;font-weight:600">All messages loaded</span>';
          }else{
            wrap.innerHTML='';
          }
        }
      }
    })
    .catch(function(){toast('Error searching messages','e');});
  },350);
}

function escHtml(str){
  if(!str)return '';
  var d=document.createElement('div');
  d.textContent=str;
  return d.innerHTML;
}

function editProject(btn){
  var row=btn.closest('.pr-row');
  if(!row){toast('Row not found','e');return;}
  document.getElementById('epId').value=row.getAttribute('data-id')||'';
  document.getElementById('epName').value=row.querySelector('.pr-title')?.textContent||'';
  document.getElementById('epUrl').value=row.getAttribute('data-url')||'';
  document.getElementById('epInit').value=row.getAttribute('data-initials')||'';
  document.getElementById('epYear').value=row.getAttribute('data-year')||'';
  document.getElementById('epDesc').value=row.getAttribute('data-description')||'';
  document.getElementById('epGithub').value=row.getAttribute('data-github')||'';
  document.getElementById('epTech').value=row.getAttribute('data-technologies')||'';

  // Parse categories from space-separated string into dropdowns
  var cats=(row.getAttribute('data-cat')||'').split(' ').filter(function(c){return c;});
  var catSel=document.getElementById('epCat');
  var cat2Sel=document.getElementById('epCat2');
  // Try to match first category to dropdown
  if(cats.length>0){
    var matched=false;
    for(var i=0;i<catSel.options.length;i++){
      if(catSel.options[i].value===cats[0]){catSel.selectedIndex=i;matched=true;break;}
    }
    if(!matched){catSel.selectedIndex=0;}
  }else{catSel.selectedIndex=0;}
  // Try to match second category
  if(cats.length>1){
    var matched2=false;
    for(var j=0;j<cat2Sel.options.length;j++){
      if(cat2Sel.options[j].value===cats[1]){cat2Sel.selectedIndex=j;matched2=true;break;}
    }
    if(!matched2){cat2Sel.selectedIndex=0;}
  }else{cat2Sel.selectedIndex=0;}

  // Set status dropdown
  var statusVal=row.getAttribute('data-status')||'Live';
  var statusSel=document.getElementById('epStatus');
  var statusMatched=false;
  for(var k=0;k<statusSel.options.length;k++){
    if(statusSel.options[k].value===statusVal||statusSel.options[k].textContent===statusVal){statusSel.selectedIndex=k;statusMatched=true;break;}
  }
  if(!statusMatched){statusSel.selectedIndex=0;}

  // Set accent color (use color_end as the primary accent)
  var colorEnd=row.getAttribute('data-color-end')||'#4f63f0';
  document.getElementById('epColor').value=colorEnd;

  new bootstrap.Modal(document.getElementById('editProjectModal')).show();
}

function saveEditProject(){
  var id=document.getElementById('epId').value;
  if(!id){toast('Project ID not found','e');return;}
  var name=document.getElementById('epName').value.trim();
  if(!name){toast('Please enter a project name','e');return;}

  var cat=document.getElementById('epCat').value;
  var cat2=document.getElementById('epCat2').value;
  var color=document.getElementById('epColor').value;

  var fd=new FormData();
  fd.append('name',name);
  fd.append('url',document.getElementById('epUrl').value.trim()||'#');
  fd.append('initials',document.getElementById('epInit').value.trim()||'P');
  fd.append('year',document.getElementById('epYear').value.trim());
  fd.append('categories',cat+(cat2?' '+cat2:''));
  fd.append('description',document.getElementById('epDesc').value.trim());
  fd.append('github_url',document.getElementById('epGithub').value.trim());
  fd.append('technologies',document.getElementById('epTech').value.trim());
  fd.append('status',document.getElementById('epStatus').value);
  fd.append('color_start','#f0f0ff');
  fd.append('color_end',color);
  fd.append('_token',document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||document.querySelector('input[name="_token"]')?.value);
  fd.append('_method','PUT');

  fetch('/admin/projects/'+id,{method:'POST',headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},body:fd})
  .then(function(r){return r.json();})
  .then(function(data){
    if(data.success){
      var row=document.querySelector('.pr-row[data-id="'+id+'"]');
      if(row){
        var catStr=cat+(cat2?' '+cat2:'');
        row.setAttribute('data-cat',catStr);
        row.setAttribute('data-url',document.getElementById('epUrl').value.trim()||'#');
        row.setAttribute('data-initials',document.getElementById('epInit').value.trim()||'P');
        row.setAttribute('data-color-start','#f0f0ff');
        row.setAttribute('data-color-end',color);
        row.setAttribute('data-description',document.getElementById('epDesc').value.trim());
        row.setAttribute('data-github',document.getElementById('epGithub').value.trim());
        row.setAttribute('data-technologies',document.getElementById('epTech').value.trim());
        row.setAttribute('data-year',document.getElementById('epYear').value.trim());
        row.setAttribute('data-status',document.getElementById('epStatus').value);
        row.querySelector('.pr-title').textContent=name;
        var urlVal=document.getElementById('epUrl').value.trim();
        row.querySelector('.pr-url').textContent=urlVal.replace(/https?:\/\//,'').split('/')[0]||urlVal;
        row.querySelector('.pr-thumb').style.background='linear-gradient(135deg,#f0f0ff,'+color+')';
        row.querySelector('.pr-thumb').textContent=document.getElementById('epInit').value.trim()||'P';
        // Update tags
        var tagsHtml='';
        var catLabel=cat.charAt(0).toUpperCase()+cat.slice(1).replace(/([A-Z])/g,' $1');
        tagsHtml+='<span class="tpill">'+catLabel.trim()+'</span>';
        if(cat2){
          var cat2Label=cat2.charAt(0).toUpperCase()+cat2.slice(1).replace(/([A-Z])/g,' $1');
          tagsHtml+='<span class="tpill">'+cat2Label.trim()+'</span>';
        }
        if(document.getElementById('epStatus').value!=='Live'){
          tagsHtml+='<span class="tpill wa">'+document.getElementById('epStatus').value+'</span>';
        }
        var tagsWrap=row.querySelector('.d-flex.gap-1.flex-wrap');
        if(tagsWrap){tagsWrap.innerHTML=tagsHtml;}
      }
      bootstrap.Modal.getInstance(document.getElementById('editProjectModal')).hide();
      toast('Project updated!','s');
    }else{
      if(data.errors){var firstErr=Object.values(data.errors)[0];toast(firstErr?firstErr[0]:'Validation error','e');}
      else{toast(data.message||'Update failed','e');}
    }
  })
  .catch(function(err){toast('Error updating project','e');});
}

function updatePrCount(){
  const c=document.getElementById('projectList')?.children.length||0;
  const el=document.getElementById('prCount');
  if(el)el.textContent='('+c+' total)';
}

function deleteProject(btn,id){
  if(!confirm('Delete this project?'))return;
  var row=btn.closest('.pr-row');
  var fd=new FormData();
  fd.append('_token',document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')||'');
  fd.append('_method','DELETE');
  fetch('/admin/projects/'+id,{method:'POST',headers:{'Accept':'application/json','X-Requested-With':'XMLHttpRequest'},body:fd})
  .then(function(r){return r.json();})
  .then(function(data){
    if(data.success){
      if(row){row.style.transition='all .2s';row.style.opacity='0';setTimeout(function(){row.remove();updatePrCount();},200);}
      toast('Project deleted!','s');
    }else{toast(data.message||'Delete failed','e');}
  })
  .catch(function(){toast('Error deleting project','e');});
}

function updHirePreview(){
  document.getElementById('hirePreviewH').textContent=document.getElementById('hireH')?.value||'';
  document.getElementById('hirePreviewP').textContent=document.getElementById('hireP')?.value||'';
  document.getElementById('hirePreviewBL').textContent=document.getElementById('hireBL')?.value||'';
}

function updSEO(){
  const t=document.getElementById('seoTitle')?.value||'';
  const d=document.getElementById('seoDesc')?.value||'';
  const pt=document.getElementById('seoPreviewTitle');
  const pd=document.getElementById('seoPreviewDesc');
  if(pt)pt.textContent=t.length>60?t.substring(0,60)+'...':t;
  if(pd)pd.textContent=d.length>155?d.substring(0,155)+'...':d;
}

@if(session('success'))
document.addEventListener('DOMContentLoaded', function(){ toast({!! json_encode(session('success')) !!},'s'); });
@endif
@if(session('error'))
document.addEventListener('DOMContentLoaded', function(){ toast({!! json_encode(session('error')) !!},'e'); });
@endif

// Generic AJAX form submission helper
function ajaxSubmit(form, options) {
  options = options || {};
  var btn = form.querySelector('button[type="submit"], .btn-p');
  var origHTML = btn ? btn.innerHTML : '';
  if (btn) btn.innerHTML = '<i class="bi bi-arrow-repeat spin"></i> Saving...';
  if (btn) btn.disabled = true;

  // Remove any leftover hidden checkbox-fix inputs from previous submissions
  form.querySelectorAll('input[data-cb-fix]').forEach(function(el) { el.remove(); });

  var formData = new FormData(form);

  // Fix checkboxes in FormData (not DOM):
  // - Unchecked checkboxes are missing from FormData → append "0"
  // - Checked checkboxes send "on" (or value if set) → replace with "1"
  form.querySelectorAll('input[type="checkbox"]').forEach(function(cb) {
    if (!cb.checked) {
      formData.append(cb.name, '0');
    } else if (cb.value === 'on' || !cb.hasAttribute('value')) {
      // Default checkbox sends "on" — replace with "1" for Laravel boolean
      formData.delete(cb.name);
      formData.append(cb.name, '1');
    }
    // If checkbox has explicit value="1" and is checked, FormData already has "1"
  });

  var fetchOptions = {
    method: form.method.toUpperCase(),
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || document.querySelector('input[name="_token"]')?.value,
      'Accept': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
    },
    body: formData,
  };

  // For PUT/PATCH/DELETE, add method override
  if (['PUT','PATCH','DELETE'].includes(fetchOptions.method)) {
    formData.append('_method', fetchOptions.method);
    fetchOptions.method = 'POST';
  }

  return fetch(form.action, fetchOptions)
    .then(function(res) {
      if (!res.ok) {
        return res.text().then(function(text) {
          try {
            var errData = JSON.parse(text);
            if (res.status === 422 && errData.errors) {
              var firstErr = Object.values(errData.errors)[0];
              throw { validationError: true, message: firstErr ? firstErr[0] : 'Validation error' };
            }
            throw { validationError: false, message: errData.message || 'Server error' };
          } catch(e) {
            if (e.validationError !== undefined) throw e;
            throw { validationError: false, message: 'Server error (' + res.status + ')' };
          }
        });
      }
      return res.json();
    })
    .then(function(data) {
      if (btn) { btn.innerHTML = origHTML; btn.disabled = false; }
      if (data.success) {
        toast(data.message || 'Saved successfully!', 's');
        if (options.onSuccess) options.onSuccess(data);
      } else {
        toast(data.message || 'Something went wrong', 'e');
        if (options.onError) options.onError(data);
      }
    })
    .catch(function(err) {
      if (btn) { btn.innerHTML = origHTML; btn.disabled = false; }
      if (err && err.validationError) {
        toast(err.message, 'e');
      } else if (err && err.message) {
        toast(err.message, 'e');
      } else {
        toast('An error occurred', 'e');
      }
      if (options.onError) options.onError(err);
    });
}
</script>
</body>
</html>
