@extends('layouts.auth')

@section('title', 'SB Admin — Forgot Password')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Reset Password</div>
<div class="auth-subtitle">Enter your email and we'll send you a reset link</div>

<!-- Session Status -->
@if(session('status'))
  <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('status') }}</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
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

  <!-- Submit -->
  <button type="submit" class="btn-auth">
    <i class="bi bi-send"></i> Send Reset Link
  </button>
</form>

<a href="{{ route('login') }}" class="back-link">
  <i class="bi bi-arrow-left"></i> Back to Sign In
</a>

@endsection
