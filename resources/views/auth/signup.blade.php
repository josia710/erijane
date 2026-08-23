@extends('layouts.app')

@section('title', 'Sign Up - Erijane')

@section('content')
<div class="auth-shell">
    <div class="auth-shell__form">
        <span class="auth-shell__badge auth-shell__badge--signup">Sign up</span>
        <h1 class="mt-4 font-display text-[2.2rem] font-semibold leading-tight text-ink">Track Your Progress &amp; More!</h1>
        <div class="mt-2 flex flex-wrap items-center justify-between gap-3 text-sm">
            <p class="text-muted">Start your fitness journey today</p>
            <a href="{{ route('login') }}" class="font-medium text-ink underline underline-offset-2">Existing user?</a>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm text-rose-700">
                <ul class="list-disc space-y-1 pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('signup.store') }}" class="mt-8 space-y-4">
            @csrf
            <div>
                <label class="sr-only" for="name">Name</label>
                <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
                    class="auth-input" placeholder="Name">
            </div>
            <div>
                <label class="sr-only" for="email">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                    class="auth-input" placeholder="Email">
            </div>
            <div>
                <label class="sr-only" for="password">Password</label>
                <input id="password" name="password" type="password" required
                    class="auth-input" placeholder="Password">
            </div>
            <div>
                <label class="sr-only" for="password_confirmation">Re-enter Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="auth-input" placeholder="Re-enter Password">
            </div>
            <label class="flex items-start gap-2 text-sm text-muted">
                <input type="checkbox" name="notify" value="1" class="mt-0.5 rounded border-gray-300 text-brand focus:ring-brand">
                <span>Send me email notifications for new program launches, website or store updates (optional).</span>
            </label>
            <button type="submit" class="btn-pill w-full">Create Account</button>
        </form>

        <div class="my-6 flex items-center gap-3 text-xs text-muted">
            <span class="h-px flex-1 bg-border"></span>
            or
            <span class="h-px flex-1 bg-border"></span>
        </div>

        <button type="button" class="auth-oauth" disabled aria-disabled="true">
            <img src="{{ \App\Support\Media::url('images/chloe/ui/google.png') }}" alt="" class="h-5 w-5" width="20" height="20">
            Sign up with Google
        </button>

        <p class="mt-6 text-center text-xs text-muted">
            By signing up, you agree to the Terms &amp; Conditions and Privacy Policy
        </p>
    </div>

    @include('partials.auth-features')
</div>
@endsection
