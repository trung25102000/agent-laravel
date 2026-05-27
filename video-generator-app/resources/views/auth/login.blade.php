@extends('layouts.app')

@section('title', 'Log in to AI Video Generator')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-[minmax(0,1fr)_28rem] lg:items-stretch">
        <section class="rounded-lg border border-teal-100 bg-white p-6 shadow-sm md:p-8">
            <p class="inline-flex rounded-full bg-teal-50 px-3 py-1 text-sm font-semibold text-teal-800 ring-1 ring-inset ring-teal-200">Creator login</p>
            <h1 class="mt-5 text-3xl font-semibold leading-tight text-zinc-950">Log in to your AI video workspace</h1>
            <p class="mt-3 text-sm leading-6 text-zinc-600">Continue building scripts, scenes, voice, subtitles, and vertical video renders for your short-form channels.</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-3 lg:grid-cols-1">
                <div class="rounded-lg bg-amber-50 p-4 ring-1 ring-amber-100">
                    <p class="text-sm font-semibold text-amber-900">Draft faster</p>
                    <p class="mt-1 text-xs leading-5 text-amber-800">Turn topic notes into structured scripts and scenes.</p>
                </div>
                <div class="rounded-lg bg-sky-50 p-4 ring-1 ring-sky-100">
                    <p class="text-sm font-semibold text-sky-900">Track progress</p>
                    <p class="mt-1 text-xs leading-5 text-sky-800">See script, media, voice, subtitle, and render states.</p>
                </div>
                <div class="rounded-lg bg-teal-50 p-4 ring-1 ring-teal-100">
                    <p class="text-sm font-semibold text-teal-900">Export MP4</p>
                    <p class="mt-1 text-xs leading-5 text-teal-800">Download 9:16 video output for social review.</p>
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm md:p-8">
            <div>
                <h2 class="text-2xl font-semibold text-zinc-950">Welcome back</h2>
                <p class="mt-2 text-sm text-zinc-500">Use your creator account to open the video workspace.</p>
            </div>

            <form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="email">Email</label>
                    <input id="email" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="password">Password</label>
                    <input id="password" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-teal-700 focus:ring-2 focus:ring-teal-700/10" name="password" type="password" autocomplete="current-password" required>
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-zinc-600">
                    <input class="size-4 rounded border-zinc-300 text-teal-700 focus:ring-teal-700" name="remember" type="checkbox" value="1">
                    Remember this device
                </label>

                <button class="inline-flex w-full items-center justify-center rounded-md bg-teal-700 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-800" type="submit">
                    Log in to create videos
                </button>
            </form>

            <div class="mt-6 space-y-3 text-center text-sm">
                <p class="text-zinc-600">
                    New to the workspace?
                    <a class="font-semibold text-teal-800 underline-offset-4 hover:underline" href="{{ route('register') }}">Create an account</a>
                </p>
                <a class="font-semibold text-zinc-500 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ url('/') }}">Back to product overview</a>
            </div>
        </section>
    </div>
@endsection
