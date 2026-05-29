@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="space-y-8">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-rose-700">Bảng giá</p>
            <h1 class="mt-2 text-3xl font-semibold">{{ $title }}</h1>
            <p class="mt-3 max-w-3xl text-sm leading-6 text-zinc-600">Đây là mức giá tham khảo để bạn hình dung phạm vi phù hợp. Giá thực tế sẽ được chốt lại theo số lượng màn hình, mức độ custom, tài nguyên sẵn có và deadline.</p>
        </section>
        <section class="grid gap-4 md:grid-cols-3">
            @foreach ($packages as $package)
                <article class="rounded-lg border {{ $package->is_featured ? 'border-rose-300 ring-2 ring-rose-100' : 'border-zinc-200' }} bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase text-rose-700">{{ str_replace('_', ' ', $package->package_type) }}</p>
                    <h2 class="text-lg font-semibold">{{ $package->name }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $package->summary }}</p>
                    <p class="mt-4 text-2xl font-semibold">Từ {{ number_format($package->price) }}đ</p>
                    <ul class="mt-4 space-y-2 text-sm text-zinc-700">
                        @foreach ($package->benefits ?? [] as $benefit)
                            <li>• {{ $benefit }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-5 rounded-lg bg-zinc-50 p-3 text-sm text-zinc-600">
                        Phù hợp khi cần scope rõ, có demo trước, và muốn biết trước phần nào được bao gồm hoặc cần báo giá riêng.
                    </div>
                    <div class="mt-5 flex flex-wrap gap-2">
                        <a class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white" href="#quote-form">Nhận báo giá chính xác</a>
                        <a class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-semibold text-zinc-800" href="{{ route('services') }}">Xem dịch vụ liên quan</a>
                    </div>
                </article>
            @endforeach
        </section>
        <section class="grid gap-4 rounded-lg border border-amber-100 bg-amber-50 p-5 md:grid-cols-3">
            @foreach ([
                ['Bao gồm', 'Tư vấn scope, triển khai theo phạm vi đã chốt, chỉnh sửa hợp lý trong gói và hướng dẫn bàn giao.'],
                ['Chưa bao gồm mặc định', 'Nội dung copywriting lớn, media mua ngoài, hạ tầng đặc thù hoặc tích hợp vượt phạm vi gói.'],
                ['Bước tiếp theo', 'Gửi nhu cầu để nhận scope, timeline, gói phù hợp và báo giá chính xác hơn theo use case thực tế.'],
            ] as [$label, $copy])
                <article class="rounded-lg bg-white p-4 shadow-sm">
                    <p class="text-sm font-semibold text-rose-700">{{ $label }}</p>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </section>
        <x-contact-cta :service-type="$type === 'seo' ? 'seo' : ($type === 'ui-fix' ? 'ui_fix' : ($type === 'coding-task' ? 'coding_task' : ($type === 'graduation-project' ? 'student_support' : 'website')))" />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
