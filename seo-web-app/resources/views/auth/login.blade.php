@extends('layouts.app')

@section('title', 'Đăng nhập quản trị - Web Template Studio')
@section('meta_description', 'Đăng nhập khu vực quản trị Web Template Studio để quản lý mẫu web, lead báo giá, đơn hàng và yêu cầu đồ án.')

@section('content')
    <div class="mx-auto grid max-w-5xl gap-6 lg:grid-cols-[minmax(0,1fr)_28rem] lg:items-stretch">
        <section class="rounded-lg border border-rose-100 bg-white p-6 shadow-sm md:p-8">
            <p class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-sm font-semibold text-rose-700 ring-1 ring-inset ring-rose-100">Web Template Studio</p>
            <h1 class="mt-5 text-3xl font-semibold leading-tight text-zinc-950">Đăng nhập để quản lý khách hàng và đơn dịch vụ.</h1>
            <p class="mt-3 text-sm leading-6 text-zinc-600">Khu vực admin giúp theo dõi mẫu web, gói giá, lead báo giá, yêu cầu làm website và đồ án Laravel.</p>

            <div class="mt-8 grid gap-4 sm:grid-cols-3 lg:grid-cols-1">
                <div class="rounded-lg bg-amber-50 p-4 ring-1 ring-amber-100">
                    <p class="text-sm font-semibold text-amber-900">Lead rõ ràng</p>
                    <p class="mt-1 text-xs leading-5 text-amber-800">Xem nhu cầu, số điện thoại, nhóm khách hàng và trạng thái xử lý.</p>
                </div>
                <div class="rounded-lg bg-sky-50 p-4 ring-1 ring-sky-100">
                    <p class="text-sm font-semibold text-sky-900">Quản lý sản phẩm</p>
                    <p class="mt-1 text-xs leading-5 text-sky-800">Cập nhật template, source Laravel, demo project và blog SEO.</p>
                </div>
                <div class="rounded-lg bg-rose-50 p-4 ring-1 ring-rose-100">
                    <p class="text-sm font-semibold text-rose-900">Phản hồi nhanh</p>
                    <p class="mt-1 text-xs leading-5 text-rose-800">Ưu tiên liên hệ Zalo/Facebook/Email để chốt tư vấn trong ngày.</p>
                </div>
            </div>
        </section>

        <section class="rounded-lg border border-zinc-200 bg-white p-6 shadow-sm md:p-8">
            <div>
                <h2 class="text-2xl font-semibold text-zinc-950">Đăng nhập admin</h2>
                <p class="mt-2 text-sm text-zinc-500">Dùng tài khoản quản trị để mở dashboard Web Template Studio.</p>
            </div>

            <form class="mt-6 space-y-5" method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="email">Email</label>
                    <input id="email" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-rose-600 focus:ring-2 focus:ring-rose-600/10" name="email" type="email" value="{{ old('email') }}" autocomplete="email" required autofocus>
                    @error('email')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-zinc-900" for="password">Mật khẩu</label>
                    <input id="password" class="mt-2 block w-full rounded-md border border-zinc-300 bg-white px-3 py-2.5 text-sm shadow-sm outline-none focus:border-rose-600 focus:ring-2 focus:ring-rose-600/10" name="password" type="password" autocomplete="current-password" required>
                    @error('password')
                        <p class="mt-2 text-sm font-medium text-rose-700">{{ $message }}</p>
                    @enderror
                </div>

                <label class="flex items-center gap-3 text-sm text-zinc-600">
                    <input class="size-4 rounded border-zinc-300 text-rose-600 focus:ring-rose-600" name="remember" type="checkbox" value="1">
                    Ghi nhớ thiết bị này
                </label>

                <button class="inline-flex w-full items-center justify-center rounded-md bg-rose-600 px-4 py-3 text-sm font-semibold text-white shadow-sm hover:bg-rose-700" type="submit">
                    Đăng nhập quản trị
                </button>
            </form>

            <div class="mt-6 space-y-3 text-center text-sm">
                <a class="font-semibold text-zinc-500 underline-offset-4 hover:text-zinc-950 hover:underline" href="{{ route('home') }}">Quay lại trang dịch vụ</a>
            </div>
        </section>
    </div>
@endsection
