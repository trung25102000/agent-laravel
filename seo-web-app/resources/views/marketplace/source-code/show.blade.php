@extends('layouts.app')

@section('title', $product->name)

@section('content')
    <div class="grid gap-8 lg:grid-cols-[1fr_24rem]">
        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
            <p class="text-sm font-semibold text-rose-700">{{ $product->framework }}</p>
            <h1 class="mt-2 text-3xl font-semibold">{{ $product->name }}</h1>
            <p class="mt-4 text-sm leading-6 text-zinc-600">{{ $product->description ?: $product->summary }}</p>
            <div class="mt-6">
                <h2 class="text-lg font-semibold">File đính kèm</h2>
                <ul class="mt-3 space-y-2 text-sm text-zinc-700">
                    @forelse ($product->attachments as $attachment)
                        <li>{{ $attachment->name }} · {{ $attachment->type }}</li>
                    @empty
                        <li>Admin có thể đính kèm source, báo cáo, database và hướng dẫn.</li>
                    @endforelse
                </ul>
            </div>
        </section>
        <aside class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
            <p class="text-2xl font-semibold">{{ number_format($product->price) }}đ</p>
            @if($product->demo_url)
                <a class="mt-4 block rounded-md border border-zinc-300 px-4 py-2 text-center text-sm font-semibold" href="{{ $product->demo_url }}">Xem demo</a>
            @endif
            <form class="mt-5 space-y-3" method="POST" action="{{ route('graduation-project-requests.store') }}">
                @csrf
                <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="student_name" placeholder="Tên sinh viên" required>
                <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="student_phone" placeholder="Số điện thoại/Zalo" required>
                <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="topic" value="{{ $product->name }}" required>
                <textarea class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="requirements" placeholder="Yêu cầu báo cáo, chỉnh sửa, deadline"></textarea>
                <button class="w-full rounded-md bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white">Đặt làm đồ án</button>
            </form>
        </aside>
    </div>
@endsection
