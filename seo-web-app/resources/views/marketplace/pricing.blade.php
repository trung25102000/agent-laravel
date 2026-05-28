@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="space-y-8">
        <section>
            <p class="text-sm font-semibold text-rose-700">Bảng giá</p>
            <h1 class="mt-2 text-3xl font-semibold">{{ $title }}</h1>
        </section>
        <section class="grid gap-4 md:grid-cols-3">
            @foreach ($packages as $package)
                <article class="rounded-lg border {{ $package->is_featured ? 'border-rose-300 ring-2 ring-rose-100' : 'border-zinc-200' }} bg-white p-5 shadow-sm">
                    <h2 class="text-lg font-semibold">{{ $package->name }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $package->summary }}</p>
                    <p class="mt-4 text-2xl font-semibold">{{ number_format($package->price) }}đ</p>
                    <ul class="mt-4 space-y-2 text-sm text-zinc-700">
                        @foreach ($package->benefits ?? [] as $benefit)
                            <li>• {{ $benefit }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </section>
        <x-contact-cta />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
