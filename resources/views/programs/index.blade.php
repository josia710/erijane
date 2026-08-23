@extends('layouts.app')

@section('title', 'Workout Programs - Erijane')

@section('content')
<x-app-promo-hero />
<div class="bg-surface">
    <livewire:programs.index />
</div>
@endsection
