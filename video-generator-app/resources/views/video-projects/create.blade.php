@extends('layouts.app')

@section('title', 'Create video project')

@section('content')
    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="mb-6">
                <p class="text-sm font-medium text-zinc-500">New project</p>
                <h1 class="mt-2 text-3xl font-semibold text-zinc-950">Create video project</h1>
                <p class="mt-3 text-sm leading-6 text-zinc-600">Describe the idea once. The pipeline will turn it into a script, scenes, voice, subtitles, and a vertical render.</p>
            </div>

            <form class="space-y-6" method="POST" action="{{ route('video-projects.store') }}">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="keyword">Keyword</label>
                    <input id="keyword" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="keyword" value="{{ old('keyword') }}" placeholder="Example: daily marketing tips" required>
                    <p class="mt-2 text-xs text-zinc-500">Use one clear topic. Keep it short enough to become the video title.</p>
                    @error('keyword')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="content_brief">Desired content</label>
                    <textarea id="content_brief" class="mt-2 block min-h-36 w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="content_brief" rows="6" placeholder="Audience, angle, facts to include, CTA, words to avoid...">{{ old('content_brief') }}</textarea>
                    <p class="mt-2 text-xs text-zinc-500">Optional, but useful for brand voice and exact points.</p>
                    @error('content_brief')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid gap-5 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-semibold text-zinc-900" for="tone">Tone</label>
                        <select id="tone" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="tone" required>
                            @foreach ($tones as $value => $label)
                                <option value="{{ $value }}" @selected(old('tone', 'neutral') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('tone')
                            <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-900" for="duration_seconds">Duration</label>
                        <select id="duration_seconds" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="duration_seconds" required>
                            @foreach ($durations as $value => $label)
                                <option value="{{ $value }}" @selected((int) old('duration_seconds', 30) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('duration_seconds')
                            <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-900" for="platform">Platform</label>
                        <select id="platform" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="platform" required>
                            @foreach ($platforms as $value => $label)
                                <option value="{{ $value }}" @selected(old('platform', 'tiktok') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('platform')
                            <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-zinc-900" for="language">Language</label>
                        <select id="language" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm shadow-sm outline-none focus:border-zinc-950 focus:ring-2 focus:ring-zinc-950/10" name="language" required>
                            @foreach ($languages as $value => $label)
                                <option value="{{ $value }}" @selected(old('language', 'vi') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('language')
                            <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col gap-3 border-t border-zinc-200 pt-6 sm:flex-row sm:items-center sm:justify-between">
                    <a class="text-sm font-semibold text-zinc-600 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ route('dashboard') }}">Back to dashboard</a>
                    <button class="inline-flex items-center justify-center rounded-md bg-zinc-950 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-800" type="submit">Save draft</button>
                </div>
            </form>
        </section>

        <aside class="space-y-4">
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-zinc-950">MVP template</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div class="flex justify-between gap-4">
                        <dt class="text-zinc-500">Aspect ratio</dt>
                        <dd class="font-medium text-zinc-950">9:16</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-zinc-500">Output</dt>
                        <dd class="font-medium text-zinc-950">MP4 ready</dd>
                    </div>
                    <div class="flex justify-between gap-4">
                        <dt class="text-zinc-500">Default flow</dt>
                        <dd class="font-medium text-zinc-950">Script to render</dd>
                    </div>
                </dl>
            </div>

            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="text-base font-semibold text-zinc-950">Pipeline preview</h2>
                <ol class="mt-4 space-y-3 text-sm text-zinc-600">
                    <li>1. Generate script</li>
                    <li>2. Split scenes</li>
                    <li>3. Prepare media and voice</li>
                    <li>4. Burn subtitles and render</li>
                </ol>
            </div>
        </aside>
    </div>
@endsection
