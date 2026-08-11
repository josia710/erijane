@extends('layouts.app')

@section('title', 'Store - Erijane')

@section('content')
<div class="site-container py-12">
    <h1 class="listing-title">Merch</h1>
    <div class="mt-8">
        <livewire:store.index />
    </div>
</div>
@endsection
