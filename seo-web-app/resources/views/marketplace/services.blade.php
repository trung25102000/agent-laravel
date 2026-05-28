@extends('layouts.app')

@section('title', 'Dịch vụ làm website')

@section('content')
    <div class="space-y-10">
        <section data-reveal>
            <p class="text-sm font-semibold text-rose-700">Dịch vụ</p>
            <h1 class="mt-2 text-3xl font-semibold text-zinc-950">Làm website, landing page và đồ án Laravel theo nhu cầu.</h1>
            <p class="mt-3 max-w-3xl text-sm leading-6 text-zinc-600">Từ mẫu có sẵn đến chỉnh sửa theo ngành, mọi gói đều ưu tiên dễ vận hành, dễ liên hệ, dễ deploy.</p>
        </section>
        <section class="grid gap-4 md:grid-cols-3" data-reveal>
            @foreach ([
                ['Website cho shop nhỏ', 'Giới thiệu cửa hàng, catalog, form đặt hàng, liên hệ Zalo/Facebook.'],
                ['Landing page quảng cáo', 'Hero rõ offer, form thu lead, tối ưu mobile, đo chuyển đổi cơ bản.'],
                ['Đồ án Laravel', 'Source code, database mẫu, báo cáo, hướng dẫn cài đặt và demo.'],
            ] as [$title, $copy])
                <article class="motion-card rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold">{{ $title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                    <div class="mt-5 h-1 overflow-hidden rounded-full bg-rose-50">
                        <div class="motion-progress h-full w-4/5 rounded-full bg-rose-500"></div>
                    </div>
                </article>
            @endforeach
        </section>
        <x-contact-cta />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
