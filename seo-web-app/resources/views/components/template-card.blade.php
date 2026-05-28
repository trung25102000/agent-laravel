@props(['template'])

<article class="flex h-full flex-col rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
    <div class="rounded-md bg-gradient-to-br from-rose-100 via-amber-100 to-sky-100 p-5">
        <p class="text-xs font-semibold uppercase text-rose-700">{{ $template->category?->name ?? 'Template' }}</p>
        <h3 class="mt-3 text-lg font-semibold text-zinc-950">{{ $template->name }}</h3>
        <p class="mt-2 text-sm leading-6 text-zinc-700">{{ $template->summary }}</p>
    </div>
    <div class="mt-4 flex flex-1 flex-col justify-between gap-4">
        <p class="text-sm font-semibold text-zinc-950">{{ number_format($template->price) }}đ</p>
        <div class="flex gap-2">
            <a class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white" href="{{ route('templates.show', $template) }}">Xem chi tiết</a>
            @if ($template->demo_url)
                <a class="rounded-md border border-zinc-300 px-3 py-2 text-sm font-semibold text-zinc-800" href="{{ $template->demo_url }}">Demo</a>
            @endif
        </div>
    </div>
</article>
