@extends('layouts.app')

@section('content')

@if($sectionVisibility['hero']->visible ?? true)
@include('partials.portfolio.hero')
@endif

@if($sectionVisibility['about']->visible ?? true)
@include('partials.portfolio.about')
@endif

@if($sectionVisibility['projects']->visible ?? true)
@include('partials.portfolio.projects')
@endif

@if(($hireBanner && $hireBanner->visible) || (!$hireBanner && ($sectionVisibility['hirebanner']->visible ?? true)))
@include('partials.portfolio.hire-banner')
@endif

@if($sectionVisibility['skills']->visible ?? true)
@include('partials.portfolio.skills')
@endif

@if($sectionVisibility['services']->visible ?? true)
@include('partials.portfolio.services')
@endif

@if($sectionVisibility['testimonials']->visible ?? true)
@include('partials.portfolio.testimonials')
@endif

@if($sectionVisibility['contact']->visible ?? true)
@include('partials.portfolio.contact')
@endif

@endsection
