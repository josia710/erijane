@extends('layouts.app')

@section('title', 'Log In - Erijane')

@section('content')
<div class="auth-shell">
    <div class="auth-shell__form">
        <span class="auth-shell__badge">Login</span>
        <div class="mt-4 flex flex-wrap items-end justify-between gap-3">
            <h1 class="font-display text-[2.2rem] font-semibold leading-tight text-ink">Welcome Back!</h1>
            <a href="{{ route('signup') }}" class="text-sm font-medium text-ink underline underline-offset-2">New User? Sign Up Here.</a>
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

        <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-4">
            @csrf
            <div>
                <label class="sr-only" for="email">E-mail</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus
                    class="auth-input" placeholder="E-mail">
            </div>
            <div>
                <label class="sr-only" for="password">Password</label>
                <input id="password" name="password" type="password" required
                    class="auth-input" placeholder="Password">
            </div>
            <div class="flex flex-wrap items-center justify-between gap-3 text-sm">
                <label class="flex items-center gap-2 text-muted">
                    <input type="checkbox" name="remember" value="1" class="rounded border-gray-300 text-brand focus:ring-brand">
                    Keep me signed in
                </label>
                <span class="text-muted">Forgot your password?</span>
            </div>
            <button type="submit" class="btn-pill w-full">Log In</button>
        </form>

        <div class="my-6 flex items-center gap-3 text-xs text-muted">
            <span class="h-px flex-1 bg-border"></span>
            or
            <span class="h-px flex-1 bg-border"></span>
        </div>

        <button type="button" class="auth-oauth" disabled aria-disabled="true">
            <img src="{{ asset('images/chloe/ui/google.png') }}" alt="" class="h-5 w-5" width="20" height="20">
            Log in with Google
        </button>

        <p class="mt-6 text-center text-xs text-muted">
            By signing up, you agree to the Terms &amp; Conditions and Privacy Policy
        </p>
    </div>

    @include('partials.auth-features')
</div>
@endsection
