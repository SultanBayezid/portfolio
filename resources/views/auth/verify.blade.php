@extends('layouts.auth')

@section('title', 'SB Admin — Verify Email')

@section('auth-content')

<div class="auth-logo">
  <div class="auth-badge">SAS</div>
  <div class="auth-brand">SB Admin<small>Portfolio Manager</small></div>
</div>

<div class="auth-title">Verify Your Email</div>
<div class="auth-subtitle">Before proceeding, please check your email for a verification link.</div>

@if(session('resent'))
  <div class="alert alert-success"><i class="bi bi-check-circle me-2"></i>A fresh verification link has been sent to your email address.</div>
@endif

<form method="POST" action="{{ route('verification.resend') }}">
  @csrf
  <button type="submit" class="btn-auth">
    <i class="bi bi-envelope"></i> Resend Verification Email
  </button>
</form>

<form method="POST" action="{{ route('logout') }}" id="logout-form" class="d-none">
  @csrf
</form>

<a href="{{ route('login') }}" class="back-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  <i class="bi bi-arrow-left"></i> Sign out and try again
</a>

@endsection
