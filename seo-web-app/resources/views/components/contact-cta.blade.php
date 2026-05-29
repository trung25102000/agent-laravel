@props([
    'headline' => 'Nói nhu cầu, nhận lộ trình và báo giá rõ ràng.',
    'description' => 'Phù hợp shop nhỏ, cá nhân chạy quảng cáo và sinh viên cần source Laravel có báo cáo, database mẫu, tài liệu cài đặt.',
    'serviceType' => null,
    'buttonLabel' => 'Gửi yêu cầu báo giá',
])

<section id="quote-form" class="grid gap-6 rounded-lg border border-rose-100 bg-white p-5 shadow-sm sm:p-6 lg:grid-cols-[1fr_26rem]" data-reveal data-contact-cta data-mobile-funnel>
    <div>
        <p class="text-sm font-semibold text-rose-700">Tư vấn nhanh</p>
        <h2 class="mt-2 text-2xl font-semibold text-zinc-950">{{ $headline }}</h2>
        <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $description }}</p>
        <div class="mt-4 grid gap-3 sm:grid-cols-3" data-contact-proof-grid>
            @foreach ([
                ['15-60 phút', 'mốc phản hồi khi brief đã đủ rõ'],
                ['3-7 ngày', 'cho website/landing page hoặc task nhỏ rõ scope'],
                ['Source + note', 'bàn giao kèm tài liệu và hỗ trợ sau bàn giao'],
            ] as [$title, $copy])
                <article class="rounded-lg border border-white bg-zinc-50 px-4 py-4 shadow-sm">
                    <p class="text-base font-semibold text-zinc-950">{{ $title }}</p>
                    <p class="mt-1 text-xs leading-5 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </div>
        <div class="mt-4 rounded-lg border border-sky-100 bg-sky-50 px-4 py-3 text-sm leading-6 text-zinc-700">
            <p><span class="font-semibold text-zinc-950">Cách gửi nhu cầu hiệu quả:</span> mô tả ngắn mục tiêu, deadline, công nghệ đang dùng và gửi link demo/reference nếu có.</p>
            <p class="mt-1"><span class="font-semibold text-zinc-950">Loại hỗ trợ nhận làm:</span> website, landing page, SEO website, fix bug, task code nhỏ, source Laravel và hỗ trợ đồ án.</p>
        </div>
        <div class="mt-5 grid gap-3 rounded-lg border border-zinc-100 bg-zinc-50 p-4 text-sm text-zinc-700">
            <p><span class="font-semibold text-zinc-950">Báo giá nhanh:</span> dùng form này khi bạn cần làm web, sửa giao diện, hỗ trợ SEO hoặc task code nhỏ.</p>
            <p><span class="font-semibold text-zinc-950">Hỗ trợ đồ án:</span> nếu bạn cần flow riêng cho sinh viên, có thể dùng form đồ án ở các section liên quan để mô tả kỹ hơn.</p>
            <p><span class="font-semibold text-zinc-950">Tin nhắn chung:</span> Zalo, Facebook và Email phù hợp khi bạn chưa chắc scope hoặc cần hỏi trước.</p>
        </div>
        <div class="mt-5 grid gap-2 text-sm sm:grid-cols-2">
            @foreach (['Demo trước khi bàn giao', 'Có source + hướng dẫn cài đặt', 'Hỗ trợ chỉnh sửa sau bàn giao', 'Phù hợp chạy quảng cáo/Zalo/Facebook'] as $badge)
                <span class="rounded-md bg-rose-50 px-3 py-2 font-semibold text-rose-800 ring-1 ring-rose-100">{{ $badge }}</span>
            @endforeach
        </div>
        <div class="mt-5 grid gap-3 text-sm sm:flex sm:flex-wrap" data-contact-channels>
            <a class="rounded-md bg-emerald-600 px-4 py-3 font-semibold text-white transition hover:-translate-y-0.5 hover:bg-emerald-700 hover:shadow-lg hover:shadow-emerald-100" href="{{ config('contact.zalo_url', '#') }}">Zalo · phản hồi nhanh</a>
            <a class="rounded-md bg-blue-600 px-4 py-3 font-semibold text-white transition hover:-translate-y-0.5 hover:bg-blue-700 hover:shadow-lg hover:shadow-blue-100" href="{{ config('contact.facebook_url', '#') }}">Facebook · gửi brief</a>
            <a class="rounded-md border border-zinc-300 px-4 py-3 font-semibold text-zinc-800 transition hover:-translate-y-0.5 hover:bg-zinc-50 hover:shadow-sm" href="mailto:{{ config('contact.email', 'hello@example.com') }}">Email · nhận scope dài</a>
        </div>
    </div>
    <form method="POST" action="{{ route('quote-requests.store') }}" class="space-y-3" data-mobile-form>
        @csrf
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_name" placeholder="Tên của bạn" required>
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_phone" placeholder="Số điện thoại/Zalo" required>
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" type="email" name="customer_email" placeholder="Email">
        <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="preferred_contact_channel" required>
            <option value="zalo">Liên hệ ưu tiên: Zalo</option>
            <option value="phone">Liên hệ ưu tiên: Gọi điện</option>
            <option value="email">Liên hệ ưu tiên: Email</option>
            <option value="facebook">Liên hệ ưu tiên: Facebook</option>
        </select>
        <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="customer_group" required>
            <option value="shop_owner">Chủ shop nhỏ/lẻ</option>
            <option value="online_seller">Cá nhân kinh doanh online</option>
            <option value="student">Sinh viên</option>
        </select>
        @if ($serviceType)
            <input name="service_type" type="hidden" value="{{ $serviceType }}">
            <div class="rounded-md border border-rose-200 bg-rose-50 px-3 py-2 text-sm font-semibold text-rose-800">
                Nhu cầu đang chọn: {{ $serviceType }}
            </div>
        @else
            <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="service_type" required>
                <option value="website">Website giới thiệu/bán hàng</option>
                <option value="landing_page">Landing page chạy quảng cáo</option>
                <option value="catalog">Catalog sản phẩm</option>
                <option value="seo">SEO website</option>
                <option value="ui_fix">Fix/chỉnh giao diện</option>
                <option value="coding_task">Task lập trình nhanh</option>
                <option value="source_code">Source code Laravel/đồ án</option>
                <option value="student_support">Hỗ trợ đồ án sinh viên</option>
                <option value="custom">Làm web theo yêu cầu riêng</option>
            </select>
        @endif
        <select class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="budget_range">
            <option value="">Ngân sách tham khảo</option>
            <option value="under_3m">Dưới 3 triệu</option>
            <option value="3m_to_7m">3-7 triệu</option>
            <option value="7m_to_15m">7-15 triệu</option>
            <option value="over_15m">Trên 15 triệu</option>
            <option value="need_consulting">Cần tư vấn thêm</option>
        </select>
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="deadline" placeholder="Deadline mong muốn, ví dụ: trong 5 ngày">
        <input class="w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="technology_stack" placeholder="Công nghệ liên quan nếu có, ví dụ Laravel, React, Next.js">
        <textarea class="min-h-28 w-full rounded-md border border-zinc-300 px-3 py-2 text-sm" name="requirements" placeholder="Mô tả nhu cầu, ngành hàng, deadline, mẫu thích..." required></textarea>
        <div class="rounded-lg border border-emerald-100 bg-emerald-50 px-3 py-3 text-sm leading-6 text-emerald-900">
            <p><span class="font-semibold">Mục tiêu của form này:</span> chốt nhanh scope, ưu tiên kênh phản hồi và biết có thể triển khai ngay hay cần audit thêm.</p>
        </div>
        <button class="w-full rounded-md bg-rose-600 px-4 py-3 text-sm font-semibold text-white hover:bg-rose-700" type="submit">{{ $buttonLabel }}</button>
    </form>
</section>
