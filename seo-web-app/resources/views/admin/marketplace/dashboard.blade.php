@extends('layouts.app')

@section('title', 'Admin marketplace')

@section('content')
    <div class="space-y-6">
        <section>
            <p class="text-sm font-semibold text-rose-700">Admin</p>
            <h1 class="mt-2 text-3xl font-semibold">SEO Web Marketplace dashboard</h1>
            <p class="mt-2 text-sm text-zinc-600">Theo dõi template, lead, báo giá, yêu cầu đồ án và liên hệ mới.</p>
        </section>
        <section class="grid gap-4 md:grid-cols-5">
            @foreach ($stats as $label => $value)
                <div class="rounded-lg border border-zinc-200 bg-white p-4 shadow-sm">
                    <p class="text-xs uppercase text-zinc-500">{{ $label }}</p>
                    <p class="mt-2 text-2xl font-semibold">{{ $value }}</p>
                </div>
            @endforeach
        </section>
        <nav class="flex flex-wrap gap-2 text-sm">
            @foreach ([
                'categories' => 'Danh mục',
                'templates' => 'Template',
                'packages' => 'Gói dịch vụ',
                'orders' => 'Đơn hàng',
                'quotes' => 'Lead báo giá',
                'graduation-requests' => 'Yêu cầu đồ án',
                'customers' => 'Khách hàng',
                'contacts' => 'Liên hệ',
                'blog-posts' => 'Blog',
                'source-code-products' => 'Source code',
                'demo-projects' => 'Demo',
                'faqs' => 'FAQ',
            ] as $route => $label)
                <a class="rounded-md border border-zinc-200 bg-white px-3 py-2 font-semibold text-zinc-700" href="{{ route('admin.marketplace.'.$route) }}">{{ $label }}</a>
            @endforeach
        </nav>

        <section class="grid gap-6 lg:grid-cols-[18rem_1fr]">
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="font-semibold text-zinc-950">Admin users</h2>
                <div class="mt-3 space-y-3 text-sm">
                    @foreach ($users as $user)
                        <p><span class="font-semibold">{{ $user->name }}</span><br><span class="text-zinc-500">{{ $user->email }}</span></p>
                    @endforeach
                </div>
            </div>
            <div class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                <h2 class="font-semibold text-zinc-950">Lead mới cần phản hồi</h2>
                <div class="mt-4 space-y-3 text-sm">
                    @foreach ($orders as $order)
                        <div class="rounded-md border border-zinc-100 p-3">
                            <p class="font-semibold">{{ $order->customer_name }}</p>
                            <p class="text-zinc-500">{{ $order->customer_phone }} · {{ $order->need_type }} · {{ $order->status }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
