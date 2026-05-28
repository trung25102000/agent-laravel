<section id="quote-form" class="grid gap-6 rounded-lg border border-rose-100 bg-white p-6 shadow-sm lg:grid-cols-[1fr_26rem]">
    <div>
        <p class="text-sm font-semibold text-rose-700">Tư vấn nhanh</p>
        <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Nói nhu cầu, nhận lộ trình và báo giá rõ ràng.</h2>
        <p class="mt-3 text-sm leading-6 text-zinc-600">Phù hợp shop nhỏ, cá nhân chạy quảng cáo và sinh viên cần source Laravel có báo cáo, database mẫu, tài liệu cài đặt.</p>
        <div class="mt-5 flex flex-wrap gap-3 text-sm">
            <a class="rounded-md bg-emerald-600 px-4 py-2 font-semibold text-white" href="{{ config('contact.zalo_url', '#') }}">Zalo</a>
            <a class="rounded-md bg-blue-600 px-4 py-2 font-semibold text-white" href="{{ config('contact.facebook_url', '#') }}">Facebook</a>
            <a class="rounded-md border border-zinc-300 px-4 py-2 font-semibold text-zinc-800" href="mailto:{{ config('contact.email', 'hello@example.com') }}">Email</a>
        </div>
    </div>
    <form method="POST" action="{{ route('quote-requests.store') }}" class="space-y-3">
        @csrf
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_name" placeholder="Tên của bạn" required>
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_phone" placeholder="Số điện thoại/Zalo" required>
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" type="email" name="customer_email" placeholder="Email">
        <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_group" required>
            <option value="shop_owner">Chủ shop nhỏ/lẻ</option>
            <option value="online_seller">Cá nhân kinh doanh online</option>
            <option value="student">Sinh viên</option>
        </select>
        <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="service_type" required>
            <option value="website">Website giới thiệu/bán hàng</option>
            <option value="landing_page">Landing page chạy quảng cáo</option>
            <option value="catalog">Catalog sản phẩm</option>
            <option value="source_code">Source code Laravel/đồ án</option>
            <option value="custom">Làm web theo yêu cầu</option>
        </select>
        <textarea class="min-h-28 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="requirements" placeholder="Mô tả nhu cầu, ngành hàng, deadline, mẫu thích..." required></textarea>
        <button class="w-full rounded-md bg-rose-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-rose-700" type="submit">Gửi yêu cầu báo giá</button>
    </form>
</section>
