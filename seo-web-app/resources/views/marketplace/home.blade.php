@extends('layouts.app')

@section('title', 'Web Template Studio - Làm website, landing page và source Laravel')
@section('meta_description', 'Web Template Studio giúp shop nhỏ, người bán online và sinh viên có website, landing page, source Laravel đồ án nhanh, đẹp, dễ vận hành.')

@section('content')
    <div class="space-y-14">
        <section class="grid gap-8 overflow-hidden rounded-lg border border-rose-100 bg-white p-6 shadow-sm lg:grid-cols-[1fr_28rem] lg:items-center lg:p-8">
            <div>
                <p class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-sm font-semibold text-rose-700 ring-1 ring-inset ring-rose-100">Nhận báo giá trong ngày · Xem demo trước khi đặt</p>
                <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-tight text-zinc-950 sm:text-5xl">Làm website đẹp, landing page chốt đơn và source Laravel sẵn bàn giao.</h1>
                <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">Web Template Studio giúp chủ shop nhỏ, người bán online và sinh viên có sản phẩm web rõ ràng, trẻ trung, dễ dùng, có hướng dẫn cài đặt và hỗ trợ sau bàn giao.</p>
                <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                    <a class="inline-flex justify-center rounded-md bg-rose-600 px-5 py-3 text-sm font-semibold text-white hover:bg-rose-700" href="#quote-form">Nhận tư vấn miễn phí</a>
                    <a class="inline-flex justify-center rounded-md border border-zinc-300 bg-white px-5 py-3 text-sm font-semibold text-zinc-800 hover:bg-zinc-50" href="{{ route('templates.index') }}">Xem mẫu web demo</a>
                </div>
                <div class="mt-8 grid gap-3 text-sm sm:grid-cols-3">
                    <div class="rounded-lg bg-amber-50 p-4 ring-1 ring-amber-100">
                        <p class="text-xl font-semibold text-amber-900">3-7 ngày</p>
                        <p class="mt-1 text-amber-800">triển khai gói cơ bản</p>
                    </div>
                    <div class="rounded-lg bg-sky-50 p-4 ring-1 ring-sky-100">
                        <p class="text-xl font-semibold text-sky-900">Demo trước</p>
                        <p class="mt-1 text-sky-800">rồi mới đặt chỉnh sửa</p>
                    </div>
                    <div class="rounded-lg bg-emerald-50 p-4 ring-1 ring-emerald-100">
                        <p class="text-xl font-semibold text-emerald-900">Có tài liệu</p>
                        <p class="mt-1 text-emerald-800">source, database, hướng dẫn</p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg bg-gradient-to-br from-rose-100 via-amber-100 to-sky-100 p-4">
                <div class="rounded-lg bg-white p-5 shadow-sm">
                    <p class="text-sm font-semibold text-rose-700">Gói được hỏi nhiều</p>
                    <div class="mt-4 space-y-3">
                        @foreach ([
                            ['Website cho shop nhỏ', 'Giới thiệu cửa hàng, catalog, nút Zalo/Facebook, form đặt hàng.'],
                            ['Landing Page chốt đơn', 'Hero mạnh, form thu lead, nội dung chạy quảng cáo, tối ưu mobile.'],
                            ['Source Laravel đồ án', 'Code, database mẫu, báo cáo, hướng dẫn cài đặt và demo.'],
                        ] as [$title, $copy])
                            <div class="rounded-md border border-zinc-100 p-4">
                                <h2 class="font-semibold text-zinc-950">{{ $title }}</h2>
                                <p class="mt-1 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3">
            @foreach ([
                ['Chủ shop nhỏ/lẻ', 'Cần website giới thiệu, bán hàng đơn giản, catalog sản phẩm và liên hệ Zalo rõ ràng.'],
                ['Cá nhân kinh doanh online', 'Cần landing page đẹp, form thu lead, nội dung chạy quảng cáo và triển khai nhanh.'],
                ['Sinh viên', 'Cần source Laravel, database mẫu, báo cáo hướng dẫn, tài liệu cài đặt và demo project.'],
            ] as [$title, $copy])
                <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold text-zinc-950">{{ $title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </section>

        <section class="space-y-5">
            <div>
                <p class="text-sm font-semibold text-rose-700">Quy trình dễ hiểu</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Từ ý tưởng đến bàn giao chỉ qua 5 bước.</h2>
            </div>
            <div class="grid gap-3 md:grid-cols-5">
                @foreach ([
                    'Gửi nhu cầu',
                    'Tư vấn gói phù hợp',
                    'Chọn mẫu hoặc scope',
                    'Triển khai và chỉnh sửa',
                    'Bàn giao source/tài liệu',
                ] as $index => $step)
                    <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                        <span class="grid size-8 place-items-center rounded-md bg-rose-600 text-sm font-semibold text-white">{{ $index + 1 }}</span>
                        <p class="mt-3 text-sm font-semibold text-zinc-950">{{ $step }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="space-y-4">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-rose-700">Demo nổi bật</p>
                    <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Mẫu web có thể xem trước và đặt làm ngay.</h2>
                </div>
                <a class="text-sm font-semibold text-rose-700" href="{{ route('templates.index') }}">Xem tất cả</a>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($featuredTemplates as $template)
                    <x-template-card :template="$template" />
                @empty
                    <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-6 text-sm text-zinc-600 md:col-span-3">Chưa có template công khai. Admin có thể thêm mẫu web trong dashboard.</div>
                @endforelse
            </div>
        </section>

        <section class="space-y-4">
            <div>
                <p class="text-sm font-semibold text-rose-700">Gói giá rõ ràng</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Chọn gói phù hợp mục tiêu hiện tại.</h2>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($packages as $package)
                    <article class="rounded-lg border {{ $package->is_featured ? 'border-rose-300 ring-2 ring-rose-100' : 'border-zinc-200' }} bg-white p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase text-rose-700">{{ $package->audience_type }}</p>
                        <h3 class="mt-2 text-lg font-semibold text-zinc-950">{{ $package->name }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $package->summary }}</p>
                        <p class="mt-4 text-2xl font-semibold">{{ number_format($package->price) }}đ</p>
                    </article>
                @empty
                    @foreach ([
                        ['Website cho shop nhỏ', 'Từ 2.500.000đ', 'Catalog, giới thiệu, form đặt hàng, CTA Zalo.'],
                        ['Landing Page chốt đơn', 'Từ 1.800.000đ', 'Thiết kế mobile-first, form lead, nội dung quảng cáo.'],
                        ['Source Laravel đồ án', 'Từ 2.500.000đ', 'Source, database, báo cáo, hướng dẫn cài đặt.'],
                    ] as [$name, $price, $copy])
                        <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                            <h3 class="text-lg font-semibold text-zinc-950">{{ $name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                            <p class="mt-4 text-2xl font-semibold">{{ $price }}</p>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </section>

        <x-contact-cta />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
