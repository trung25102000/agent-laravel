@extends('layouts.app')

@section('title', 'AI Video Generator')

@section('content')
    <div class="space-y-10">
        <section class="grid gap-8 rounded-lg border border-teal-100 bg-white p-6 shadow-sm md:p-8 lg:grid-cols-[minmax(0,1fr)_24rem] lg:items-center">
            <div>
                <p class="inline-flex rounded-full bg-teal-50 px-3 py-1 text-sm font-semibold text-teal-800 ring-1 ring-inset ring-teal-200">AI video workspace</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-tight text-zinc-950 sm:text-5xl">
                    Turn one topic into a vertical video for TikTok, Reels, and Shorts.
                </h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">
                    Draft scripts, split scenes, prepare voice and subtitles, then render a 9:16 MP4 from one creator workspace.
                </p>

                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    @auth
                        <a class="inline-flex items-center justify-center rounded-md bg-teal-700 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-800" href="{{ route('dashboard') }}">
                            Open video workspace
                        </a>
                    @else
                        <a class="inline-flex items-center justify-center rounded-md bg-teal-700 px-5 py-3 text-sm font-semibold text-white shadow-sm hover:bg-teal-800" href="{{ route('login') }}">
                            Log in to create videos
                        </a>
                        <a class="inline-flex items-center justify-center rounded-md border border-zinc-300 bg-white px-5 py-3 text-sm font-semibold text-zinc-800 hover:bg-zinc-50" href="{{ route('register') }}">
                            Create creator account
                        </a>
                    @endauth
                </div>
            </div>

            <div class="rounded-lg border border-zinc-200 bg-zinc-950 p-5 text-white shadow-sm">
                <div class="mx-auto flex aspect-[9/16] max-h-[32rem] max-w-64 flex-col justify-between rounded-lg bg-teal-600 p-5">
                    <div class="space-y-2">
                        <div class="h-2 w-16 rounded-full bg-white/80"></div>
                        <div class="h-2 w-28 rounded-full bg-white/60"></div>
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-normal text-teal-100">Scene 03</p>
                        <p class="mt-2 text-2xl font-semibold leading-snug">Hook, voice, subtitles, render.</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <span class="h-2 rounded-full bg-white"></span>
                        <span class="h-2 rounded-full bg-white/60"></span>
                        <span class="h-2 rounded-full bg-white/30"></span>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-zinc-950">Script first</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Start from a topic and content brief, then shape narration for short-form attention.</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-zinc-950">Scene pipeline</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Track script, media, voice, subtitles, and render status without guessing what happened.</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-zinc-950">MP4 output</h2>
                <p class="mt-2 text-sm leading-6 text-zinc-600">Download vertical video files ready for social review and publishing workflows.</p>
            </div>
        </section>
    </div>
@endsection
