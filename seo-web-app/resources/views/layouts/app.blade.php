<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="@yield('meta_description', 'Web Template Studio cung cấp website cho shop nhỏ, landing page chốt đơn, source Laravel đồ án và dịch vụ làm web theo yêu cầu.')">
        <title>@yield('title', config('app.name'))</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-amber-50/40 text-zinc-950 antialiased">
        <div class="min-h-screen">
            <header class="border-b border-amber-100 bg-white/95">
                <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <span class="grid size-10 place-items-center rounded-lg bg-rose-600 text-sm font-semibold text-white">WEB</span>
                        <span>
                            <span class="block text-sm font-semibold text-zinc-950">{{ config('app.name', 'Web Template Studio') }}</span>
                            <span class="block text-xs text-rose-700">Template, landing page, source Laravel</span>
                        </span>
                    </a>

                    <nav class="flex flex-wrap items-center gap-2 text-sm">
                        <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('services') }}">Dịch vụ</a>
                        <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('templates.index') }}">Mẫu web</a>
                        <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('pricing.show', 'shop') }}">Gói giá</a>
                        <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('source-code.index') }}">Source Laravel</a>
                        <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('blog.index') }}">Blog</a>
                        @auth
                            @can('access-admin')
                                <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('admin.dashboard') }}">Admin</a>
                            @else
                                <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('home') }}">Trang chủ</a>
                            @endcan
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" type="submit">Đăng xuất</button>
                            </form>
                        @else
                            <a class="rounded-md px-3 py-2 text-zinc-600 hover:bg-amber-50 hover:text-rose-700" href="{{ route('login') }}">Đăng nhập</a>
                            <a class="rounded-md bg-rose-600 px-3 py-2 font-medium text-white hover:bg-rose-700" href="#quote-form">Nhận tư vấn</a>
                        @endauth
                    </nav>
                </div>
            </header>

            <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                @if (session('status'))
                    <div class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                        {{ session('status') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </body>
</html>
