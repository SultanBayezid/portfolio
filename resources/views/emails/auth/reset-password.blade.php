<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body style="font-family:'Montserrat',Arial,sans-serif;background:#f0f2f8;margin:0;padding:40px 20px">
<div style="max-width:560px;margin:0 auto;background:#fff;border-radius:14px;overflow:hidden;border:1px solid rgba(0,0,0,.08);box-shadow:0 4px 20px rgba(79,99,240,.08)">
  <div style="background:linear-gradient(135deg,#4f63f0,#10b98a);padding:28px 30px">
    <h1 style="margin:0;color:#fff;font-size:20px;font-weight:800">SB Admin</h1>
    <p style="margin:4px 0 0;color:rgba(255,255,255,.85);font-size:13px">Portfolio Manager</p>
  </div>
  <div style="padding:30px">
    <h2 style="margin:0 0 12px;font-size:17px;font-weight:700;color:#1a1d2e">Reset Your Password</h2>
    <p style="margin:0 0 20px;font-size:14px;color:#6b7280;line-height:1.6">
      You are receiving this email because we received a password reset request for your account.
    </p>
    <div style="text-align:center;margin:24px 0">
      <a href="{{ $actionUrl }}" style="display:inline-block;background:linear-gradient(135deg,#4f63f0,#10b98a);color:#fff;text-decoration:none;border-radius:10px;padding:13px 32px;font-size:14px;font-weight:700">
        Reset Password
      </a>
    </div>
    <p style="margin:16px 0 0;font-size:13px;color:#6b7280;line-height:1.6">
      If you did not request a password reset, no further action is required. This link will expire in {{ config('auth.passwords.users.expire') }} minutes.
    </p>
    <div style="margin-top:20px;padding:14px 16px;background:#f8faff;border-radius:8px;border:1px solid rgba(0,0,0,.06)">
      <p style="margin:0;font-size:12px;color:#6b7280">If the button above doesn't work, copy and paste this URL into your browser:</p>
      <p style="margin:6px 0 0;font-size:12px;color:#4f63f0;word-break:break-all;font-family:'JetBrains Mono',monospace">{{ $actionUrl }}</p>
    </div>
  </div>
  <div style="padding:16px 30px;border-top:1px solid rgba(0,0,0,.06);background:#f8faff;text-align:center">
    <p style="margin:0;font-size:11px;color:#6b7280">&copy; {{ date('Y') }} SB Admin. All rights reserved.</p>
  </div>
</div>
</body>
</html>
