@extends('layouts.app')

@section('title', $post->meta_title ?: $post->title)

@section('content')
    <article class="mx-auto max-w-3xl rounded-lg border border-zinc-200 bg-white p-6 shadow-sm">
        <p class="text-sm font-semibold text-rose-700">{{ $post->audience_type }}</p>
        <h1 class="mt-2 text-3xl font-semibold">{{ $post->title }}</h1>
        <div class="mt-6 whitespace-pre-line text-sm leading-7 text-zinc-700">{{ $post->content }}</div>
    </article>
@endsection
