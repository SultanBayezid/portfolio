@extends('layouts.auth')

@section('title', 'SB Admin — Reset Password')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Set New Password</div>
<div class="auth-subtitle">Choose a strong password for your account</div>

<!-- Session Status -->
@if(session('status'))
  <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.update') }}">
  @csrf

  <!-- Token -->
  <input type="hidden" name="token" value="{{ $token }}">

  <!-- Email -->
  <div class="form-floating">
    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ $email ?? old('email') }}" placeholder="Email Address" required autofocus>
    <label for="email"><i class="bi bi-envelope me-1"></i> Email Address</label>
    @error('email')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Password -->
  <div class="form-floating">
    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
           placeholder="New Password" required>
    <label for="password"><i class="bi bi-lock me-1"></i> New Password</label>
    @error('password')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Confirm Password -->
  <div class="form-floating">
    <input id="password_confirmation" type="password" name="password_confirmation"
           class="form-control" placeholder="Confirm Password" required>
    <label for="password_confirmation"><i class="bi bi-lock-fill me-1"></i> Confirm Password</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn-auth">
    <i class="bi bi-check-lg"></i> Reset Password
  </button>
</form>

<a href="{{ route('login') }}" class="back-link">
  <i class="bi bi-arrow-left"></i> Back to Sign In
</a>

@endsection
