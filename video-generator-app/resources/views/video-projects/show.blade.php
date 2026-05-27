@extends('layouts.app')

@section('title', $videoProject->keyword)

@section('content')
    <div class="space-y-6">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <a class="text-sm font-semibold text-zinc-500 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ route('dashboard') }}">Dashboard</a>
                    <h1 class="mt-3 text-3xl font-semibold text-zinc-950">{{ $videoProject->keyword }}</h1>
                    <p class="mt-3 max-w-3xl text-sm leading-6 text-zinc-600">{{ $videoProject->content_brief ?: 'No content brief has been added for this project.' }}</p>
                </div>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $videoProject->status->badgeClasses() }}">
                        {{ $videoProject->status->label() }}
                    </span>
                    <a class="inline-flex items-center justify-center rounded-md border border-zinc-300 px-3 py-2 text-sm font-semibold text-zinc-800 hover:bg-zinc-100" href="{{ route('video-projects.preview', $videoProject) }}">Preview</a>
                </div>
            </div>

            <dl class="mt-6 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="rounded-lg bg-zinc-50 p-4">
                    <dt class="text-xs font-medium uppercase tracking-normal text-zinc-500">Platform</dt>
                    <dd class="mt-2 text-sm font-semibold text-zinc-950">{{ $videoProject->platform_label }}</dd>
                </div>
                <div class="rounded-lg bg-zinc-50 p-4">
                    <dt class="text-xs font-medium uppercase tracking-normal text-zinc-500">Language</dt>
                    <dd class="mt-2 text-sm font-semibold text-zinc-950">{{ $videoProject->language_label }}</dd>
                </div>
                <div class="rounded-lg bg-zinc-50 p-4">
                    <dt class="text-xs font-medium uppercase tracking-normal text-zinc-500">Tone</dt>
                    <dd class="mt-2 text-sm font-semibold text-zinc-950">{{ ucfirst($videoProject->tone) }}</dd>
                </div>
                <div class="rounded-lg bg-zinc-50 p-4">
                    <dt class="text-xs font-medium uppercase tracking-normal text-zinc-500">Duration</dt>
                    <dd class="mt-2 text-sm font-semibold text-zinc-950">{{ $videoProject->duration_label }}</dd>
                </div>
            </dl>
        </section>

        <section class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
            <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-950">Generation progress</h2>
                        <p class="mt-1 text-sm text-zinc-500">Pipeline status updates as each artifact is prepared.</p>
                    </div>
                    <span class="text-sm font-semibold text-zinc-950">{{ $videoProject->progress_percent }}%</span>
                </div>
                <div class="mt-5 h-2 rounded-full bg-zinc-100">
                    <div class="h-2 rounded-full bg-zinc-950" style="width: {{ $videoProject->progress_percent }}%"></div>
                </div>

                <ol class="mt-6 grid gap-3 sm:grid-cols-2">
                    @foreach ($videoProject->pipelineSteps() as $step)
                        <li class="rounded-lg border p-4 {{ $step['complete'] ? 'border-emerald-200 bg-emerald-50' : ($step['active'] ? 'border-zinc-300 bg-white' : 'border-zinc-200 bg-zinc-50') }}">
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-semibold text-zinc-950">{{ $step['label'] }}</span>
                                <span class="text-xs font-medium {{ $step['complete'] ? 'text-emerald-700' : 'text-zinc-500' }}">{{ $step['complete'] ? 'Done' : ($step['active'] ? 'Waiting' : 'Pending') }}</span>
                            </div>
                        </li>
                    @endforeach
                </ol>

                @if ($videoProject->error_message)
                    <div class="mt-6 rounded-lg border border-rose-200 bg-rose-50 p-4 text-sm text-rose-800">
                        {{ $videoProject->error_message }}
                    </div>
                @endif
            </div>

            <aside class="space-y-6">
                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-zinc-950">Script preview</h2>
                    @if ($videoProject->script_content)
                        <p class="mt-3 max-h-56 overflow-auto whitespace-pre-line text-sm leading-6 text-zinc-600">{{ $videoProject->script_content }}</p>
                    @else
                        <p class="mt-3 text-sm text-zinc-500">Script is not generated yet.</p>
                    @endif
                </div>

                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-zinc-950">Output</h2>
                    @if ($videoProject->rendered_video_path)
                        <p class="mt-3 text-sm text-zinc-600">The render is ready for preview and download.</p>
                        <a class="mt-4 inline-flex w-full items-center justify-center rounded-md bg-zinc-950 px-4 py-2.5 text-sm font-semibold text-white hover:bg-zinc-800" href="{{ route('video-projects.preview', $videoProject) }}">Open preview</a>
                    @else
                        <p class="mt-3 text-sm text-zinc-500">No rendered output yet.</p>
                    @endif
                </div>
            </aside>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white shadow-sm">
            <div class="border-b border-zinc-200 p-5">
                <h2 class="text-lg font-semibold text-zinc-950">Scenes</h2>
            </div>
            @if ($videoProject->scenes->isEmpty())
                <p class="p-6 text-sm text-zinc-500">Scenes will appear after script splitting.</p>
            @else
                <div class="divide-y divide-zinc-100">
                    @foreach ($videoProject->scenes as $scene)
                        <article class="p-5">
                            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
                                <h3 class="text-sm font-semibold text-zinc-950">Scene {{ $scene->sort_order }}</h3>
                                <span class="text-xs text-zinc-500">{{ $scene->duration_seconds }}s · {{ $scene->status->value }}</span>
                            </div>
                            <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $scene->text }}</p>
                            @if ($scene->visual_prompt)
                                <p class="mt-2 text-xs text-zinc-500">{{ $scene->visual_prompt }}</p>
                            @endif
                        </article>
                    @endforeach
                </div>
            @endif
        </section>
    </div>
@endsection
