@extends('layouts.app')

@section('title', 'Admin dashboard')

@section('content')
    <div class="space-y-6">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-medium text-zinc-500">Operations</p>
            <h1 class="mt-2 text-3xl font-semibold text-zinc-950">Admin dashboard</h1>
            <p class="mt-3 text-sm text-zinc-600">Monitor users, project status, and pipeline failures without exposing internal storage paths.</p>
        </section>

        <section class="grid gap-6 lg:grid-cols-[22rem_minmax(0,1fr)]">
            <div class="rounded-lg border border-zinc-200 bg-white shadow-sm">
                <div class="border-b border-zinc-200 p-5">
                    <h2 class="text-lg font-semibold text-zinc-950">Users</h2>
                </div>
                <ul class="divide-y divide-zinc-100">
                    @foreach ($users as $user)
                        <li class="p-5">
                            <p class="text-sm font-semibold text-zinc-950">{{ $user->name }}</p>
                            <p class="mt-1 break-all text-xs text-zinc-500">{{ $user->email }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="rounded-lg border border-zinc-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-zinc-200 p-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-zinc-950">Video projects</h2>
                        <p class="mt-1 text-sm text-zinc-500">Filter projects by pipeline state.</p>
                    </div>

                    <form class="flex gap-2" method="GET" action="{{ route('admin.dashboard') }}">
                        <label class="sr-only" for="status">Status</label>
                        <select id="status" class="rounded-md border border-zinc-300 bg-white px-3 py-2 text-sm" name="status">
                            <option value="">All</option>
                            @foreach ($statuses as $status)
                                <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>
                                    {{ $status->label() }}
                                </option>
                            @endforeach
                        </select>
                        <button class="rounded-md bg-zinc-950 px-4 py-2 text-sm font-semibold text-white hover:bg-zinc-800" type="submit">Filter</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200 text-sm">
                        <thead class="bg-zinc-50 text-left text-xs font-semibold uppercase tracking-normal text-zinc-500">
                            <tr>
                                <th class="px-5 py-3">Project</th>
                                <th class="px-5 py-3">Owner</th>
                                <th class="px-5 py-3">Status</th>
                                <th class="px-5 py-3">Progress</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-zinc-100">
                            @foreach ($projects as $project)
                                <tr>
                                    <td class="px-5 py-4">
                                        <p class="font-semibold text-zinc-950">{{ $project->keyword }}</p>
                                        <p class="mt-1 text-xs text-zinc-500">{{ $project->platform_label }} · {{ $project->duration_label }}</p>
                                    </td>
                                    <td class="px-5 py-4 break-all text-zinc-600">{{ $project->user->email }}</td>
                                    <td class="px-5 py-4">
                                        <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $project->status->badgeClasses() }}">
                                            {{ $project->status->label() }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-4 text-zinc-600">{{ $project->progress_percent }}%</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-zinc-200 p-5">
                    {{ $projects->links() }}
                </div>
            </div>
        </section>
    </div>
@endsection
