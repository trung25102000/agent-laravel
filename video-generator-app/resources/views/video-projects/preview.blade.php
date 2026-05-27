@extends('layouts.app')

@section('title', 'Preview: ' . $videoProject->keyword)

@section('content')
    <div class="space-y-6">
        <section class="flex flex-col gap-5 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between">
            <div>
                <a class="text-sm font-semibold text-zinc-500 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ route('video-projects.show', $videoProject) }}">Back to project</a>
                <h1 class="mt-3 text-3xl font-semibold text-zinc-950">Preview: {{ $videoProject->keyword }}</h1>
                <p class="mt-3 text-sm text-zinc-600">{{ $videoProject->platform_label }} · {{ $videoProject->language_label }} · {{ $videoProject->duration_label }}</p>
            </div>
            <span class="inline-flex w-fit rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $videoProject->status->badgeClasses() }}">
                {{ $videoProject->status->label() }}
            </span>
        </section>

        <section class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_22rem]">
            <div class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
                @if ($previewState['is_playable'])
                    <div class="mx-auto max-w-sm">
                        <div class="overflow-hidden rounded-lg border border-zinc-900 bg-zinc-950 shadow-sm">
                            <video class="aspect-[9/16] max-h-[72vh] w-full bg-zinc-950 object-contain" controls preload="metadata" playsinline>
                                <source src="{{ $previewState['stream_url'] }}" type="video/mp4">
                                Your browser cannot play this MP4 preview.
                            </video>
                        </div>
                        <p class="mt-3 text-center text-sm text-zinc-500">Playable MP4 preview is loaded from a protected stream route.</p>
                    </div>
                @elseif ($previewState['has_output'] && ! $previewState['file_exists'])
                    <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 text-amber-900">
                        <h2 class="text-base font-semibold">Output file is missing</h2>
                        <p class="mt-2 text-sm">The render metadata exists, but the video file is no longer available. Please render the project again.</p>
                    </div>
                @elseif ($previewState['has_output'])
                    <div class="rounded-lg border border-amber-200 bg-amber-50 p-6 text-amber-900">
                        <h2 class="text-base font-semibold">Output is not playable</h2>
                        <p class="mt-2 text-sm">This output is not an MP4 video. Re-render with the FFmpeg provider to enable browser preview.</p>
                    </div>
                @elseif ($videoProject->status === \App\Enums\VideoProjectStatusEnum::Failed)
                    <div class="rounded-lg border border-rose-200 bg-rose-50 p-6 text-rose-800">
                        <h2 class="text-base font-semibold">Render failed</h2>
                        <p class="mt-2 text-sm">{{ $videoProject->error_message ?: 'The pipeline stopped before creating an output file.' }}</p>
                    </div>
                @else
                    <div class="rounded-lg border border-zinc-200 bg-zinc-50 p-8 text-center">
                        <h2 class="text-base font-semibold text-zinc-950">This video has not been rendered yet.</h2>
                        <p class="mt-2 text-sm text-zinc-500">Once the queue finishes rendering, the preview and download actions will appear here.</p>
                    </div>
                @endif
            </div>

            <aside class="space-y-4">
                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-zinc-950">Output actions</h2>
                    @if ($previewState['file_exists'])
                        <p class="mt-3 text-sm text-zinc-600">Your rendered output is available.</p>
                        <a class="mt-4 inline-flex w-full items-center justify-center rounded-md bg-teal-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-teal-800" href="{{ route('video-projects.download', $videoProject) }}">Download video</a>
                    @else
                        <p class="mt-3 text-sm text-zinc-500">Download unlocks when the output file exists.</p>
                    @endif
                    <a class="mt-3 inline-flex w-full items-center justify-center rounded-md border border-zinc-300 bg-white px-4 py-2.5 text-sm font-semibold text-zinc-800 hover:bg-zinc-50" href="{{ route('video-projects.show', $videoProject) }}">Back to project</a>
                </div>

                <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-base font-semibold text-zinc-950">Artifacts</h2>
                    <dl class="mt-4 space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Audio</dt>
                            <dd class="font-medium text-zinc-950">{{ $videoProject->audio_path ? 'Ready' : 'Pending' }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Subtitle</dt>
                            <dd class="font-medium text-zinc-950">{{ $videoProject->subtitle_path ? 'Ready' : 'Pending' }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Output</dt>
                            <dd class="font-medium text-zinc-950">{{ $previewState['file_exists'] ? 'Ready' : 'Pending' }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Duration</dt>
                            <dd class="font-medium text-zinc-950">{{ $videoProject->render_duration_label }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Resolution</dt>
                            <dd class="font-medium text-zinc-950">{{ $videoProject->render_resolution_label }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-zinc-500">Size</dt>
                            <dd class="font-medium text-zinc-950">{{ $videoProject->render_size_label }}</dd>
                        </div>
                    </dl>
                </div>
            </aside>
        </section>
    </div>
@endsection
