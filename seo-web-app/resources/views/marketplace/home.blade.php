@extends('layouts.app')

@section('title', 'Web Template Studio - Làm website, landing page và source Laravel')
@section('meta_description', 'Web Template Studio giúp shop nhỏ, người bán online và sinh viên có website, landing page, source Laravel đồ án nhanh, đẹp, dễ vận hành.')

@section('content')
    <div class="space-y-16">
        <section class="overflow-hidden rounded-lg border border-rose-100 bg-white shadow-sm" data-reveal data-landing-section="hero">
            <div class="grid gap-8 p-6 lg:grid-cols-[1fr_30rem] lg:items-center lg:p-8">
                <div>
                    <p class="inline-flex rounded-full bg-rose-50 px-3 py-1 text-sm font-semibold text-rose-700 ring-1 ring-inset ring-rose-100">Dành cho shop nhỏ, người bán online và sinh viên cần sản phẩm web thật</p>
                    <h1 class="mt-5 max-w-4xl text-4xl font-semibold leading-tight text-zinc-950 sm:text-5xl">Có website đẹp để khách tin hơn, dễ chốt đơn hơn và bàn giao rõ ràng hơn.</h1>
                    <p class="mt-5 max-w-2xl text-base leading-7 text-zinc-600">Web Template Studio biến nhu cầu làm web, landing page hoặc source Laravel thành một lộ trình dễ hiểu: xem demo trước, chốt phạm vi rõ, triển khai nhanh và có hướng dẫn sau bàn giao.</p>
                    <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                        <a class="inline-flex justify-center rounded-md bg-rose-600 px-5 py-3 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-rose-700 hover:shadow-lg hover:shadow-rose-200" href="#quote-form">Nhận tư vấn miễn phí</a>
                        <a class="inline-flex justify-center rounded-md border border-zinc-300 bg-white px-5 py-3 text-sm font-semibold text-zinc-800 transition hover:-translate-y-0.5 hover:bg-zinc-50 hover:shadow-sm" href="{{ route('templates.index') }}">Xem mẫu web demo</a>
                    </div>
                    <div class="mt-8 grid gap-3 text-sm sm:grid-cols-3">
                        @foreach ([
                            ['3-7 ngày', 'triển khai gói cơ bản'],
                            ['Demo trước', 'rồi mới đặt chỉnh sửa'],
                            ['Bàn giao rõ', 'source, database, hướng dẫn'],
                        ] as [$title, $copy])
                            <div class="motion-card rounded-lg bg-white p-4 ring-1 ring-zinc-100" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                                <p class="text-xl font-semibold text-zinc-950">{{ $title }}</p>
                                <p class="mt-1 text-zinc-600">{{ $copy }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="relative min-h-[30rem]" aria-label="Mockup website, landing page và dashboard dịch vụ" data-trust-visual="hero-mockup">
                    <div class="motion-float rounded-lg bg-gradient-to-br from-rose-100 via-amber-100 to-sky-100 p-4 shadow-sm">
                        <div class="overflow-hidden rounded-lg border border-white/80 bg-white shadow-xl shadow-rose-100">
                            <div class="flex items-center gap-2 border-b border-zinc-100 bg-zinc-50 px-4 py-3">
                                <span class="size-3 rounded-full bg-rose-400"></span>
                                <span class="size-3 rounded-full bg-amber-400"></span>
                                <span class="size-3 rounded-full bg-emerald-400"></span>
                                <span class="ml-2 h-2 w-32 rounded-full bg-zinc-200"></span>
                            </div>
                            <div class="grid gap-4 p-5">
                                <div class="rounded-lg bg-rose-50 p-4">
                                    <p class="text-xs font-semibold uppercase text-rose-700">Landing page chốt đơn</p>
                                    <div class="mt-3 h-4 w-3/4 rounded-full bg-rose-200"></div>
                                    <div class="mt-2 h-3 w-1/2 rounded-full bg-amber-200"></div>
                                    <div class="mt-5 grid gap-2 sm:grid-cols-3">
                                        <span class="h-16 rounded-md bg-white ring-1 ring-rose-100"></span>
                                        <span class="h-16 rounded-md bg-white ring-1 ring-rose-100"></span>
                                        <span class="h-16 rounded-md bg-white ring-1 ring-rose-100"></span>
                                    </div>
                                </div>
                                <div class="grid gap-3 sm:grid-cols-[1fr_9rem]">
                                    <div class="rounded-lg border border-zinc-100 p-4">
                                        <div class="h-3 w-24 rounded-full bg-sky-200"></div>
                                        <div class="mt-4 space-y-2">
                                            <div class="h-2 rounded-full bg-zinc-100"></div>
                                            <div class="h-2 w-5/6 rounded-full bg-zinc-100"></div>
                                            <div class="h-2 w-2/3 rounded-full bg-zinc-100"></div>
                                        </div>
                                    </div>
                                    <div class="rounded-lg bg-zinc-950 p-4 text-white">
                                        <p class="text-xs text-zinc-300">Lead mới</p>
                                        <p class="mt-2 text-2xl font-semibold">24</p>
                                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-white/20">
                                            <div class="motion-progress h-full w-4/5 rounded-full bg-emerald-300"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="relative overflow-hidden rounded-lg border border-emerald-100 bg-emerald-50 p-3">
                                    <div class="motion-scan absolute inset-y-0 left-0 w-20 bg-white/50"></div>
                                    <p class="relative text-sm font-semibold text-emerald-800">Đã sẵn sàng demo trước khi bàn giao</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="motion-float-slow absolute bottom-4 right-2 w-56 rounded-lg border border-zinc-100 bg-white p-4 shadow-lg shadow-zinc-200/70 sm:right-8">
                        <p class="text-xs font-semibold uppercase text-sky-700">Source Laravel</p>
                        <p class="mt-2 text-sm font-semibold text-zinc-950">Code + database + hướng dẫn</p>
                        <div class="mt-3 space-y-1.5">
                            <div class="h-2 rounded-full bg-zinc-100"></div>
                            <div class="h-2 w-4/5 rounded-full bg-zinc-100"></div>
                            <div class="h-2 w-2/3 rounded-full bg-zinc-100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $problemStories = [
                [
                    'audience' => 'Chủ shop nhỏ',
                    'title' => 'Shop nhỏ chưa có website chuyên nghiệp',
                    'problem' => 'Khách chỉ thấy vài bài đăng rời rạc nên khó tin tưởng thương hiệu và khó xem lại sản phẩm.',
                    'solution' => 'Dựng website giới thiệu/catalog có CTA Zalo rõ ràng, giúp khách xem nhanh sản phẩm và liên hệ ngay.',
                    'visual' => 'Catalog mini + CTA Zalo',
                ],
                [
                    'audience' => 'Người chạy quảng cáo',
                    'title' => 'Landing page thiếu tin cậy',
                    'problem' => 'Quảng cáo có lượt click nhưng form lead yếu, nội dung chưa đủ thuyết phục và CTA bị chìm.',
                    'solution' => 'Thiết kế landing page mobile-first với offer rõ, form thu lead nổi bật và block bằng chứng tin cậy.',
                    'visual' => 'Form lead + offer',
                ],
                [
                    'audience' => 'Người bán online',
                    'title' => 'Phụ thuộc Facebook/Zalo',
                    'problem' => 'Thông tin sản phẩm, bảng giá và câu hỏi thường gặp nằm rải rác nên khách dễ bỏ qua.',
                    'solution' => 'Tạo một điểm chạm chính thức để gom sản phẩm, bảng giá, FAQ và các nút liên hệ nhanh.',
                    'visual' => 'Hub bán hàng',
                ],
                [
                    'audience' => 'Sinh viên',
                    'title' => 'Source đồ án chưa đủ bộ',
                    'problem' => 'Có code nhưng thiếu database mẫu, báo cáo, hướng dẫn cài đặt và demo để bảo vệ đồ án.',
                    'solution' => 'Bàn giao source Laravel kèm database, tài liệu chạy project, demo và ghi chú triển khai rõ ràng.',
                    'visual' => 'Source + database',
                ],
            ];
        @endphp

        <section class="space-y-6" data-reveal data-landing-section="problems" data-story-carousel data-story-interval="5200" role="region" aria-label="Slideshow vấn đề và giải pháp cho khách hàng">
            <div class="max-w-3xl">
                <p class="text-sm font-semibold text-rose-700">Vấn đề thường gặp</p>
                <h2 class="mt-2 text-3xl font-semibold text-zinc-950">Trước khi có website tốt, khách thường rời đi vì thiếu niềm tin.</h2>
                <p class="mt-3 text-sm leading-6 text-zinc-600">Không phải ai cũng cần hệ thống phức tạp ngay từ đầu. Điều quan trọng là có một điểm chạm chuyên nghiệp, dễ hiểu và đủ tin cậy để khách liên hệ.</p>
            </div>

            <div class="relative">
                @foreach ($problemStories as $story)
                    <article class="story-slide rounded-lg border border-zinc-200 bg-white p-5 shadow-sm" data-story-slide @if (! $loop->first) aria-hidden="true" @endif>
                        <div class="grid gap-6 lg:grid-cols-[1fr_24rem] lg:items-center">
                            <div>
                                <p class="text-sm font-semibold text-rose-700">Câu chuyện {{ $loop->iteration }} · {{ $story['audience'] }}</p>
                                <h3 class="mt-2 text-2xl font-semibold text-zinc-950">{{ $story['title'] }}</h3>
                                <div class="mt-5 grid gap-3 md:grid-cols-2">
                                    <div class="rounded-lg bg-rose-50 p-4 ring-1 ring-rose-100">
                                        <p class="text-xs font-semibold uppercase text-rose-700">Vấn đề</p>
                                        <p class="mt-2 text-sm leading-6 text-rose-950">{{ $story['problem'] }}</p>
                                    </div>
                                    <div class="rounded-lg bg-emerald-50 p-4 ring-1 ring-emerald-100">
                                        <p class="text-xs font-semibold uppercase text-emerald-700">Giải pháp</p>
                                        <p class="mt-2 text-sm leading-6 text-emerald-950">{{ $story['solution'] }}</p>
                                    </div>
                                </div>
                                <a class="mt-5 inline-flex rounded-md bg-rose-600 px-4 py-2 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-rose-700" href="#quote-form">Tư vấn hướng xử lý</a>
                            </div>

                            <div class="story-visual overflow-hidden rounded-lg bg-gradient-to-br from-rose-50 via-white to-sky-50 p-4 ring-1 ring-zinc-100">
                                <div class="motion-float-slow rounded-lg bg-white p-4 shadow-sm">
                                    <div class="flex items-center justify-between border-b border-zinc-100 pb-3">
                                        <span class="text-xs font-semibold uppercase text-zinc-500">{{ $story['visual'] }}</span>
                                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-xs font-semibold text-emerald-700">Live demo</span>
                                    </div>
                                    <div class="mt-4 grid gap-3">
                                        <div class="h-24 rounded-lg bg-rose-100 ring-1 ring-rose-200"></div>
                                        <div class="grid grid-cols-3 gap-2">
                                            <span class="h-14 rounded-md bg-zinc-100"></span>
                                            <span class="h-14 rounded-md bg-zinc-100"></span>
                                            <span class="h-14 rounded-md bg-zinc-100"></span>
                                        </div>
                                        <div class="space-y-2">
                                            <div class="h-2.5 w-4/5 rounded-full bg-zinc-200"></div>
                                            <div class="h-2.5 w-2/3 rounded-full bg-zinc-200"></div>
                                            <div class="h-2.5 w-1/2 rounded-full bg-zinc-200"></div>
                                        </div>
                                        <div class="relative overflow-hidden rounded-md bg-zinc-950 p-3 text-white">
                                            <div class="motion-scan absolute inset-y-0 left-0 w-16 bg-white/10"></div>
                                            <p class="relative text-sm font-semibold">Khách hiểu vấn đề → thấy giải pháp → bấm liên hệ</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="flex flex-wrap gap-2" role="tablist" aria-label="Chọn câu chuyện vấn đề">
                @foreach ($problemStories as $story)
                    <button class="story-control rounded-full border border-rose-100 bg-white px-3 py-2 text-sm font-semibold text-zinc-700 hover:bg-rose-50" type="button" data-story-control aria-label="Xem câu chuyện: {{ $story['title'] }}" aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                        {{ $loop->iteration }}. {{ $story['audience'] }}
                    </button>
                @endforeach
            </div>
        </section>

        <section class="grid gap-6 rounded-lg border border-emerald-100 bg-emerald-50 p-6 lg:grid-cols-[22rem_1fr]" data-reveal data-landing-section="solutions">
            <div>
                <p class="text-sm font-semibold text-emerald-800">Giá trị nhận được</p>
                <h2 class="mt-2 text-3xl font-semibold text-zinc-950">Một landing page tốt không chỉ đẹp, nó giúp khách hiểu và hành động.</h2>
                <p class="mt-3 text-sm leading-6 text-emerald-900/80">Mỗi block trên trang được thiết kế để trả lời một câu hỏi của khách: bạn bán gì, có đáng tin không, xem được demo không, và liên hệ bằng cách nào.</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ([
                    ['Có demo trước khi bàn giao', 'Xem giao diện thật, luồng liên hệ và nội dung chính trước khi chốt chỉnh sửa.'],
                    ['Giao diện đẹp, tối ưu mobile', 'Phù hợp khách xem bằng điện thoại, có cấu trúc dễ đọc và CTA nổi bật.'],
                    ['Form thu lead và CTA rõ ràng', 'Zalo, Facebook, Email và form báo giá được đặt ở điểm khách dễ hành động.'],
                    ['Bàn giao source, database, tài liệu', 'Phù hợp sinh viên hoặc khách cần tự vận hành sau khi nhận sản phẩm.'],
                    ['Hỗ trợ deploy và chỉnh sửa sau bàn giao', 'Giảm rủi ro khi đưa website lên môi trường thật hoặc cần thay nội dung.'],
                    ['Phạm vi gói minh bạch', 'Biết trước nên chọn website, landing page, catalog hay source Laravel đồ án.'],
                ] as [$title, $copy])
                    <article class="motion-card rounded-lg border border-white/80 bg-white p-5 shadow-sm" data-reveal data-value-card style="--reveal-delay: {{ $loop->index * 70 }}ms">
                        <h3 class="text-base font-semibold text-zinc-950">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-3" data-reveal data-landing-section="audiences">
            @foreach ([
                ['Chủ shop nhỏ/lẻ', 'Website giới thiệu, bán hàng đơn giản, catalog sản phẩm và liên hệ Zalo rõ ràng.'],
                ['Cá nhân kinh doanh online', 'Landing page đẹp, form thu lead, nội dung chạy quảng cáo và triển khai nhanh.'],
                ['Sinh viên', 'Source Laravel, database mẫu, báo cáo hướng dẫn, tài liệu cài đặt và demo project.'],
            ] as [$title, $copy])
                <article class="motion-card rounded-lg border border-zinc-200 bg-white p-5 shadow-sm" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                    <h2 class="text-lg font-semibold text-zinc-950">{{ $title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </section>

        <section class="space-y-4" data-reveal>
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-rose-700">Demo nổi bật</p>
                    <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Mẫu web có thể xem trước và đặt làm ngay.</h2>
                </div>
                <a class="text-sm font-semibold text-rose-700" href="{{ route('templates.index') }}">Xem tất cả</a>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($featuredTemplates as $template)
                    <x-template-card :template="$template" />
                @empty
                    <div class="rounded-lg border border-dashed border-zinc-300 bg-white p-6 text-sm text-zinc-600 md:col-span-3">Chưa có template công khai. Hãy thêm một vài mẫu demo để khách dễ hình dung dịch vụ.</div>
                @endforelse
            </div>
        </section>

        <section class="space-y-5" data-reveal data-landing-section="process">
            <div>
                <p class="text-sm font-semibold text-rose-700">Quy trình dễ hiểu</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Từ ý tưởng đến bàn giao chỉ qua 5 bước.</h2>
            </div>
            <div class="relative grid gap-3 md:grid-cols-5">
                @foreach ([
                    'Gửi nhu cầu',
                    'Tư vấn gói phù hợp',
                    'Chọn mẫu hoặc scope',
                    'Triển khai và chỉnh sửa',
                    'Bàn giao source/tài liệu',
                ] as $index => $step)
                    <div class="motion-card rounded-lg border border-zinc-200 bg-white p-4 shadow-sm" data-reveal style="--reveal-delay: {{ $index * 70 }}ms">
                        <span class="grid size-8 place-items-center rounded-md bg-rose-600 text-sm font-semibold text-white">{{ $index + 1 }}</span>
                        <p class="mt-3 text-sm font-semibold text-zinc-950">{{ $step }}</p>
                        <div class="mt-4 h-1 overflow-hidden rounded-full bg-rose-50">
                            <div class="motion-progress h-full rounded-full bg-rose-500" style="width: {{ 18 + ($index * 18) }}%"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="grid gap-4 md:grid-cols-4" data-reveal data-landing-section="trust">
            @foreach ([
                ['Demo trước khi bàn giao', 'Xem đúng giao diện và luồng đặt hàng trước khi chốt.'],
                ['Có source + hướng dẫn cài đặt', 'Bàn giao code, database mẫu và tài liệu chạy project.'],
                ['Hỗ trợ chỉnh sửa sau bàn giao', 'Có thời gian hỗ trợ để shop/sinh viên yên tâm vận hành.'],
                ['Phù hợp chạy quảng cáo/Zalo/Facebook', 'CTA, form lead và liên hệ nhanh được đặt đúng vị trí.'],
            ] as [$title, $copy])
                <article class="motion-card rounded-lg border border-rose-100 bg-white p-5 shadow-sm" data-reveal data-trust-badge style="--reveal-delay: {{ $loop->index * 70 }}ms">
                    <div class="grid size-10 place-items-center rounded-md bg-rose-50 text-rose-700">
                        <span class="size-3 rounded-full bg-current"></span>
                    </div>
                    <h2 class="mt-4 text-base font-semibold text-zinc-950">{{ $title }}</h2>
                    <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                </article>
            @endforeach
        </section>

        <section class="space-y-4" data-reveal>
            <div>
                <p class="text-sm font-semibold text-rose-700">Gói giá rõ ràng</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Chọn gói phù hợp mục tiêu hiện tại.</h2>
            </div>
            <div class="grid gap-4 md:grid-cols-3">
                @forelse ($packages as $package)
                    <article class="motion-card rounded-lg border {{ $package->is_featured ? 'border-rose-300 ring-2 ring-rose-100' : 'border-zinc-200' }} bg-white p-5 shadow-sm">
                        <p class="text-xs font-semibold uppercase text-rose-700">{{ $package->audience_type }}</p>
                        <h3 class="mt-2 text-lg font-semibold text-zinc-950">{{ $package->name }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $package->summary }}</p>
                        <p class="mt-4 text-2xl font-semibold">{{ number_format($package->price) }}đ</p>
                    </article>
                @empty
                    @foreach ([
                        ['Website cho shop nhỏ', 'Từ 2.500.000đ', 'Catalog, giới thiệu, form đặt hàng, CTA Zalo.'],
                        ['Landing Page chốt đơn', 'Từ 1.800.000đ', 'Thiết kế mobile-first, form lead, nội dung quảng cáo.'],
                        ['Source Laravel đồ án', 'Từ 2.500.000đ', 'Source, database, báo cáo, hướng dẫn cài đặt.'],
                    ] as [$name, $price, $copy])
                        <article class="motion-card rounded-lg border border-zinc-200 bg-white p-5 shadow-sm">
                            <h3 class="text-lg font-semibold text-zinc-950">{{ $name }}</h3>
                            <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                            <p class="mt-4 text-2xl font-semibold">{{ $price }}</p>
                        </article>
                    @endforeach
                @endforelse
            </div>
        </section>

        <x-contact-cta />
        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
