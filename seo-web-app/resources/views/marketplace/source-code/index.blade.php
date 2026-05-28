@extends('layouts.app')

@section('title', 'Source code Laravel cho sinh viên')

@section('content')
    <div class="space-y-6">
        <section>
            <h1 class="text-3xl font-semibold">Source code Laravel và demo project</h1>
            <p class="mt-2 text-sm text-zinc-600">Có database mẫu, báo cáo, hướng dẫn cài đặt và demo để xem trước.</p>
        </section>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ($products as $product)
                <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase text-rose-700">{{ $product->framework }}</p>
                    <h2 class="mt-2 text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $product->summary }}</p>
                    <p class="mt-4 font-semibold">{{ number_format($product->price) }}đ</p>
                    <a class="mt-4 inline-flex rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white" href="{{ route('source-code.show', $product) }}">Xem source</a>
                </article>
            @endforeach
        </div>
        {{ $products->links() }}
    </div>
@endsection
