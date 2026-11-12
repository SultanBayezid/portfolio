@extends('layouts.auth')

@section('title', 'SB Admin — Confirm Password')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Confirm Password</div>
<div class="auth-subtitle">Please confirm your password before continuing</div>

<form method="POST" action="{{ route('password.confirm') }}">
  @csrf

  <!-- Password -->
  <div class="form-floating">
    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror"
           placeholder="Password" required autofocus>
    <label for="password"><i class="bi bi-lock me-1"></i> Password</label>
    @error('password')
      <div class="invalid-feedback d-block" style="font-size:12px;font-weight:600;margin-top:4px">{{ $message }}</div>
    @enderror
  </div>

  <!-- Submit -->
  <button type="submit" class="btn-auth">
    <i class="bi bi-shield-check"></i> Confirm Password
  </button>
</form>

@if(Route::has('password.request'))
  <a href="{{ route('password.request') }}" class="back-link">
    <i class="bi bi-arrow-left"></i> Forgot your password?
  </a>
@endif

@endsection
