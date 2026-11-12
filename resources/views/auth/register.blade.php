@extends('layouts.auth')

@section('title', 'SB Admin — Register')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Create Account</div>
<div class="auth-subtitle">Register a new admin account</div>

<!-- Error Messages -->
@if(session('error'))
  <div class="alert alert-danger"><i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}</div>
@endif

@if(session('success'))
  <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
@endif

<form method="POST" action="{{ route('register') }}">
  @csrf

  <!-- Name -->
  <div class="form-floating">
    <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name') }}" placeholder="Full Name" required autofocus>
    <label for="name"><i class="bi bi-person me-1"></i> Full Name</label>
    @error('name')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Email -->
  <div class="form-floating">
    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email') }}" placeholder="Email Address" required>
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

  <!-- Confirm Password -->
  <div class="form-floating">
    <input id="password_confirmation" type="password" name="password_confirmation"
           class="form-control" placeholder="Confirm Password" required>
    <label for="password_confirmation"><i class="bi bi-lock-fill me-1"></i> Confirm Password</label>
  </div>

  <!-- Submit -->
  <button type="submit" class="btn-auth">
    <i class="bi bi-person-plus"></i> Create Account
  </button>
</form>

<div class="auth-link">
  Already have an account? <a href="{{ route('login') }}">Sign in</a>
</div>

@endsection
