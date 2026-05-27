@extends('layouts.app')

@section('title', 'Create AI Video Generator account')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-[minmax(0,1fr)_28rem] lg:items-stretch">
        <section class="rounded-lg border border-teal-100 bg-white p-6 shadow-sm md:p-8">
            <p class="inline-flex rounded-full bg-amber-50 px-3 py-1 text-sm font-semibold text-amber-900 ring-1 ring-inset ring-amber-200">Creator setup</p>
            <h1 class="mt-5 text-3xl font-semibold leading-tight text-zinc-950">Create your AI video workspace</h1>
            <p class="mt-3 text-sm leading-6 text-zinc-600">Save video ideas, generate scripts, review scenes, and keep every render tied to your account.</p>

            <div class="mt-8 rounded-lg border border-zinc-200 bg-zinc-50 p-5">
                <h2 class="text-base font-semibold text-zinc-950">What you can do next</h2>
                <ul class="mt-4 space-y-3 text-sm text-zinc-600">
                    <li>Start a video project from a topic.</li>
                    <li>Choose platform, tone, language, and duration.</li>
                    <li>Preview progress from script to MP4 output.</li>
                </ul>
            </div>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm md:p-8">
            <div>
                <h2 class="text-2xl font-semibold text-zinc-950">New creator account</h2>
                <p class="mt-2 text-sm text-zinc-500">Set up your login details to begin creating AI videos.</p>
            </div>

            <form class="mt-6 space-y-5" method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="name">Name</label>
                    <input id="name" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="name" value="{{ old('name') }}" autocomplete="name" required autofocus>
                    @error('name')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="email">Email</label>
                    <input id="email" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required>
                    @error('email')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="password">Password</label>
                    <input id="password" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="password" type="password" autocomplete="new-password" required>
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="password_confirmation">Confirm password</label>
                    <input id="password_confirmation" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="password_confirmation" type="password" autocomplete="new-password" required>
                </div>

                <button class="inline-flex w-full items-center justify-center rounded-md bg-teal-700 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-800" type="submit">
                    Create video workspace
                </button>
            </form>

            <div class="mt-6 space-y-3 text-center text-sm">
                <p class="text-zinc-600">
                    Already have an account?
                    <a class="font-semibold text-teal-800 underline-offset-4 hover:underline" href="{{ route('login') }}">Log in</a>
                </p>
                <a class="font-semibold text-zinc-500 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ url('/') }}">Back to product overview</a>
            </div>
        </section>
    </div>
@endsection
