@extends('layouts.auth')

@section('title', 'SB Admin — Login')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Welcome Back</div>
<div class="auth-subtitle">Sign in to manage your portfolio</div>

<!-- Session Status -->
@if(session('status'))
  <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>{{ session('status') }}</div>
@endif

<!-- Error Messages -->
@if(session('error'))
  <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
@endif

<!-- Success Messages -->
@if(session('success'))
  <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('login') }}">
  @csrf

  <!-- Email -->
  <div class="form-floating">
    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email') }}" placeholder="Email Address" required autofocus>
    <label for="email"><i class="bi bi-envelope me-1"></i> Email Address</label>
    @error('email')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Password -->
  <div class="form-floating">
    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
           placeholder="Password" required>
    <label for="password"><i class="bi bi-lock me-1"></i> Password</label>
    @error('password')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Remember Me & Forgot Password -->
  <div class="d-flex align-items-center justify-content-between mb-2">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" name="remember" id="remember"
             {{ old('remember') ? 'checked' : '' }}>
      <label class="form-check-label" for="remember">Remember me</label>
    </div>
    @if(Route::has('password.request'))
      <a href="{{ route('password.request') }}" style="font-size:12.5px;font-weight:700;color:var(--accent);text-decoration:none">
        Forgot password?
      </a>
    @endif
  </div>

  <!-- Submit -->
  <button type="submit" class="btn-auth">
    <i class="bi bi-box-arrow-in-right"></i> Sign In
  </button>
</form>

@if(Route::has('register'))
  <div class="auth-link">
    Don't have an account? <a href="{{ route('register') }}">Create one</a>
  </div>
@endif

@endsection
