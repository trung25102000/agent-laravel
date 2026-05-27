@extends('layouts.app')

@section('title', 'Web Template Studio - Website đẹp, landing page nhanh, source Laravel')

@section('content')
    <div class="space-y-12">
        <section class="grid gap-8 rounded-lg border border-amber-100 bg-white p-6 shadow-sm lg:grid-cols-[1fr_25rem] lg:items-center">
            <div>
                <p class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-sm font-semibold text-rose-700 ring-1 ring-rose-100">Website trẻ trung, dễ dùng, triển khai nhanh</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-tight text-zinc-950 sm:text-5xl">Mua template web, landing page và source Laravel đúng nhu cầu.</h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">Dành cho chủ shop nhỏ, cá nhân kinh doanh online và sinh viên cần đồ án tốt nghiệp có database mẫu, báo cáo, hướng dẫn cài đặt.</p>
                <div class="mt-7 flex flex-wrap gap-3">
                    <a class="rounded-md bg-rose-600 px-5 py-3 text-sm font-semibold text-white hover:bg-rose-700" href="{{ route('templates.index') }}">Xem mẫu web</a>
                    <a class="rounded-md border border-zinc-300 bg-white px-5 py-3 text-sm font-semibold text-zinc-800 hover:bg-zinc-50" href="{{ route('pricing.show', 'graduation-project') }}">Gói đồ án Laravel</a>
                </div>
            </div>
            <div class="rounded-lg bg-gradient-to-br from-rose-100 via-amber-100 to-sky-100 p-5">
                <div class="rounded-lg bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-rose-700">Một website có thể bắt đầu trong hôm nay</p>
                    <div class="mt-5 space-y-3 text-sm text-zinc-700">
                        <p>• Landing page chốt lead cho quảng cáo</p>
                        <p>• Website bán hàng/catalog sản phẩm</p>
                        <p>• Source Laravel cho đồ án kèm tài liệu</p>
                        <p>• Demo rõ ràng trước khi đặt mua</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            @foreach ([
                ['Chủ shop nhỏ/lẻ', 'Website giới thiệu, bán hàng đơn giản, catalog sản phẩm và CTA Zalo rõ ràng.'],
                ['Kinh doanh online', 'Landing page đẹp, form thu lead, liên hệ Facebook/Zalo, triển khai nhanh để chạy quảng cáo.'],
                ['Sinh viên', 'Source code Laravel, database mẫu, báo cáo hướng dẫn, tài liệu cài đặt và demo project.'],
            ] as [$title, $copy])
                <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-zinc-950">{{ $title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </section>

        <section class="space-y-4">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-rose-700">Template nổi bật</p>
                    <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Mẫu web có thể demo và đặt mua ngay</h2>
                </div>
                <a class="text-sm font-semibold text-rose-700" href="{{ route('templates.index') }}">Xem tất cả</a>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($featuredTemplates as $template)
                    <x-template-card :template="$template" />
                @empty
                    <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-6 text-sm text-zinc-600 md:col-span-3">Chưa có template, admin có thể thêm trong dashboard.</div>
                @endforelse
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            @foreach ($packages as $package)
                <article class="rounded-lg border {{ $package->is_featured ? 'border-rose-300' : 'border-zinc-200' }} bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase text-rose-700">{{ $package->audience_type }}</p>
                    <h3 class="mt-2 text-lg font-semibold text-zinc-950">{{ $package->name }}</h3>
                    <p class="mt-2 text-sm text-zinc-600">{{ $package->summary }}</p>
                    <p class="mt-4 text-xl font-semibold">{{ number_format($package->price) }}đ</p>
                </article>
            @endforeach
        </section>

        <x-contact-cta />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
