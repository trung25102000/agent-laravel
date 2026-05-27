@extends('layouts.app')

@section('title', 'Video workspace')

@section('content')
    <div class="flex flex-col gap-6">
        <section class="flex flex-col gap-5 rounded-lg border border-zinc-200 bg-white p-6 shadow-sm lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-sm font-medium text-zinc-500">Welcome, {{ $user->name }}.</p>
                <h1 class="mt-2 text-3xl font-semibold tracking-normal text-zinc-950">Video workspace</h1>
                <p class="mt-3 max-w-2xl text-sm leading-6 text-zinc-600">Create vertical AI videos, watch pipeline progress, and download finished outputs from one workspace.</p>
            </div>
            <a class="inline-flex items-center justify-center rounded-md bg-teal-700 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-teal-800" href="{{ route('video-projects.create') }}">
                Create a new video
            </a>
        </section>

        <section class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4" aria-label="Project summary">
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-zinc-500">Total projects</p>
                <p class="mt-2 text-3xl font-semibold">{{ $projectStats['total'] }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-zinc-500">Completed</p>
                <p class="mt-2 text-3xl font-semibold">{{ $projectStats['completed'] }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-zinc-500">Rendering</p>
                <p class="mt-2 text-3xl font-semibold">{{ $projectStats['rendering'] }}</p>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <p class="text-sm text-zinc-500">Needs review</p>
                <p class="mt-2 text-3xl font-semibold">{{ $projectStats['failed'] }}</p>
            </div>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white shadow-sm" aria-labelledby="video-projects-heading">
            <div class="flex flex-col gap-3 border-b border-zinc-200 p-5 sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h2 id="video-projects-heading" class="text-lg font-semibold text-zinc-950">Your video projects</h2>
                    <p class="mt-1 text-sm text-zinc-500">Recent projects are sorted by latest activity.</p>
                </div>
                <a class="text-sm font-semibold text-zinc-950 underline-offset-4 hover:underline" href="{{ route('video-projects.create') }}">Create a new video</a>
            </div>

            @if ($videoProjects->isEmpty())
                <div class="p-8 text-center">
                    <p class="text-base font-medium text-zinc-950">You have not created any video projects yet.</p>
                    <p class="mt-2 text-sm text-zinc-500">Start with a topic, choose a style, then let the pipeline prepare the script and render assets.</p>
                    <a class="mt-5 inline-flex items-center justify-center rounded-md bg-teal-700 px-4 py-2.5 text-sm font-semibold text-white hover:bg-teal-800" href="{{ route('video-projects.create') }}">Create a new video</a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 text-sm">
                        <thead class="bg-zinc-50 text-left text-xs font-semibold uppercase tracking-normal text-zinc-500">
                            <tr>
                                <th class="px-5 py-3">Project</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3">Progress</th>
                                <th class="px-5 py-3">Format</th>
                                <th class="px-5 py-3 text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @foreach ($videoProjects as $videoProject)
                                <tr>
                                    <td class="px-5 py-4">
                                        <a class="font-semibold text-zinc-950 underline-offset-4 hover:underline" href="{{ route('video-projects.show', $videoProject) }}">{{ $videoProject->keyword }}</a>
                                        <p class="mt-1 max-w-md truncate text-xs text-zinc-500">{{ $videoProject->content_brief ?: 'No brief added.' }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $videoProject->status->badgeClasses() }}">
                                            {{ $videoProject->status->label() }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex min-w-36 items-center gap-3">
                                            <div class="h-2 flex-1 rounded-full bg-zinc-100">
                                                <div class="h-2 rounded-full bg-teal-700" style="width: {{ $videoProject->progress_percent }}%"></div>
                                            </div>
                                            <span class="w-10 text-right text-xs text-zinc-500">{{ $videoProject->progress_percent }}%</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-zinc-600">{{ $videoProject->platform_label }} · {{ $videoProject->language_label }} · {{ $videoProject->duration_label }}</td>
                                    <td class="px-5 py-4 text-right">
                                        <a class="font-semibold text-zinc-950 underline-offset-4 hover:underline" href="{{ route('video-projects.show', $videoProject) }}">Open</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
@endsection
