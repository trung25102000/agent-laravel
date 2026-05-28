@extends('layouts.app')

@section('title', 'Blog SEO website và đồ án Laravel')

@section('content')
    <div class="space-y-6">
        <section>
            <h1 class="text-3xl font-semibold">Blog SEO</h1>
            <p class="mt-2 text-sm text-zinc-600">Nội dung theo nhóm khách hàng: shop nhỏ, kinh doanh online và sinh viên.</p>
        </section>
        <div class="grid gap-4 md:grid-cols-3">
            @foreach ($posts as $post)
                <article class="rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                    <p class="text-xs font-semibold uppercase text-rose-700">{{ $post->audience_type }}</p>
                    <h2 class="mt-2 text-lg font-semibold">{{ $post->title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $post->excerpt }}</p>
                    <a class="mt-4 inline-flex text-sm font-semibold text-rose-700" href="{{ route('blog.show', $post) }}">Đọc bài</a>
                </article>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
@endsection
