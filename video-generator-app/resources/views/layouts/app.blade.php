<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-teal-50/40 text-zinc-950 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-teal-100 bg-white/95">
                <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <a href="{{ auth()->check() ? route('dashboard') : url('/') }}" class="flex items-center gap-3">
                        <span class="grid size-10 place-items-center rounded-lg bg-teal-700 text-sm font-semibold text-white">AI</span>
                        <span>
                            <span class="block text-sm font-semibold text-zinc-950">{{ config('app.name', 'AI Video') }}</span>
                            <span class="block text-xs text-teal-700">Short-form video studio</span>
                        </span>
                    </a>

                    <nav class="flex flex-wrap items-center gap-2 text-sm">
                        @auth
                            <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-teal-50 hover:text-teal-800" href="{{ route('dashboard') }}">Video workspace</a>
                            <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-teal-50 hover:text-teal-800" href="{{ route('video-projects.create') }}">New AI video</a>
                            @can('access-admin')
                                <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-teal-50 hover:text-teal-800" href="{{ route('admin.dashboard') }}">Admin</a>
                            @endcan
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-md px-3 py-2 text-zinc-600 hover:bg-teal-50 hover:text-teal-800" type="submit">Logout</button>
                            </form>
                        @else
                            <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-teal-50 hover:text-teal-800" href="{{ route('login') }}">Log in</a>
                            <a class="rounded-md bg-teal-700 px-3 py-2 font-medium text-white hover:bg-teal-800" href="{{ route('register') }}">Create account</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </body>
</html>
