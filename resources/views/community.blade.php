@extends('layouts.app')

@section('title', 'Community - Erijane')

@section('content')
{{-- Decision C: CTA hero + forums-looking cards (UI shell, no backend) --}}
@include('partials.community-cta')
@include('partials.community-forums-shell')
@endsection
