<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@yield('title', 'SB Admin — Login')</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&family=JetBrains+Mono:wght@400;600&display=swap" rel="stylesheet">
<style>
:root{
  --accent:#4f63f0;--accent2:#10b98a;
  --txt:#1a1d2e;--muted:#6b7280;
  --bd:rgba(0,0,0,.08);--bd2:rgba(0,0,0,.14);
  --font:'Montserrat',sans-serif;--mono:'JetBrains Mono',monospace;
}
*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html,body{height:100%}
body{font-family:var(--font);background:linear-gradient(135deg,#f0f2f8 0%,#e8ecff 50%,#f0faf6 100%);color:var(--txt);display:flex;align-items:center;justify-content:center;min-height:100vh}

.auth-wrap{width:100%;max-width:440px;padding:20px}
.auth-card{background:#fff;border:1.5px solid var(--bd);border-radius:18px;padding:40px 36px;box-shadow:0 8px 40px rgba(79,99,240,.08)}
.auth-logo{display:flex;align-items:center;justify-content:center;gap:12px;margin-bottom:28px}
.auth-badge{width:46px;height:46px;border-radius:12px;background:linear-gradient(135deg,var(--accent),var(--accent2));display:flex;align-items:center;justify-content:center;font-weight:800;font-size:14px;color:#fff;font-family:var(--mono)}
.auth-brand{font-size:20px;font-weight:800;color:var(--txt);letter-spacing:-.02em}
.auth-brand small{display:block;font-size:10px;color:var(--muted);font-weight:500;letter-spacing:.06em;font-family:var(--mono);margin-top:1px}
.auth-title{font-size:18px;font-weight:800;text-align:center;margin-bottom:4px}
.auth-subtitle{font-size:13px;color:var(--muted);text-align:center;margin-bottom:28px;font-weight:500}

.form-floating{margin-bottom:16px}
.form-floating>.form-control,.form-floating>.form-select{background:#f8faff !important;border:1.5px solid var(--bd) !important;color:var(--txt) !important;border-radius:10px !important;font-family:var(--font) !important;font-size:14px !important;font-weight:500 !important;height:52px !important;padding-top:1.5rem !important}
.form-floating>.form-control:focus{border-color:var(--accent) !important;box-shadow:0 0 0 3px rgba(79,99,240,.12) !important}
.form-floating>label{color:var(--muted) !important;font-size:13px !important;font-weight:600 !important}

.form-check-input{border-color:var(--bd2) !important;cursor:pointer}
.form-check-input:checked{background-color:var(--accent) !important;border-color:var(--accent) !important}
.form-check-label{font-size:13px;font-weight:600;color:var(--muted);cursor:pointer}

.btn-auth{width:100%;background:linear-gradient(135deg,var(--accent),var(--accent2));color:#fff;border:none;border-radius:10px;font-size:14px;font-weight:700;padding:13px 20px;cursor:pointer;transition:opacity .15s,transform .1s;font-family:var(--font);display:flex;align-items:center;justify-content:center;gap:8px;margin-top:8px}
.btn-auth:hover{opacity:.88;color:#fff}
.btn-auth:active{transform:scale(.98)}

.auth-link{text-align:center;margin-top:20px;font-size:13px;color:var(--muted);font-weight:500}
.auth-link a{color:var(--accent);text-decoration:none;font-weight:700}
.auth-link a:hover{text-decoration:underline}

.alert{border-radius:10px !important;font-size:13px !important;font-weight:600 !important;border:1.5px solid !important;padding:12px 16px !important;margin-bottom:20px !important}
.alert-danger{background:rgba(229,62,62,.06) !important;border-color:rgba(229,62,62,.2) !important;color:#e53e3e !important}
.alert-success{background:rgba(5,150,105,.06) !important;border-color:rgba(5,150,105,.2) !important;color:#059669 !important}
.alert-info{background:rgba(79,99,240,.06) !important;border-color:rgba(79,99,240,.2) !important;color:var(--accent) !important}

.invalid-feedback{font-size:12px;font-weight:600}

.divider{display:flex;align-items:center;gap:12px;margin:20px 0}
.divider-line{flex:1;height:1px;background:var(--bd)}
.divider-text{font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.1em}

.back-link{display:flex;align-items:center;justify-content:center;gap:6px;margin-top:16px;font-size:13px;color:var(--muted);font-weight:600;text-decoration:none}
.back-link:hover{color:var(--accent)}

@keyframes fadeUp{from{opacity:0;transform:translateY(8px)}to{opacity:1;transform:translateY(0)}}
.auth-card{animation:fadeUp .3s ease}
</style>
</head>
<body>

<div class="auth-wrap">
  <div class="auth-card">
    @yield('auth-content')
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
