@extends('layouts.app')
@section('title', 'Admin đơn hàng')
@section('content')
<section class="mb-6"><h1 class="text-2xl font-semibold">Đơn hàng/yêu cầu mua</h1><p class="mt-2 text-sm text-zinc-600">Lọc trạng thái, cập nhật xử lý và ghi chú nội bộ.</p></section>
<section class="space-y-4">
@foreach($orders as $order)
<article class="rounded-lg border bg-white p-5"><div class="flex flex-wrap justify-between gap-3"><div><h2 class="font-semibold">{{ $order->customer_name }}</h2><p class="text-sm text-zinc-600">{{ $order->customer_phone }} · {{ $order->need_type }} · {{ $order->status }}</p><p class="mt-2 text-sm">{{ $order->customization_request }}</p></div><form class="flex gap-2" method="POST" action="{{ route('admin.marketplace.orders.update', $order) }}">@csrf @method('PATCH')<select class="rounded-md border px-3 py-2 text-sm" name="status"><option value="new">new</option><option value="contacted">contacted</option><option value="in_progress">in_progress</option><option value="completed">completed</option><option value="cancelled">cancelled</option></select><input class="rounded-md border px-3 py-2 text-sm" name="internal_note" placeholder="Ghi chú"><button class="rounded-md bg-rose-600 px-3 py-2 text-sm font-semibold text-white">Cập nhật</button></form></div></article>
@endforeach
{{ $orders->links() }}
</section>
@endsection
