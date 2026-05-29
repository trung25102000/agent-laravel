@extends('layouts.app')

@section('title', 'Web Template Studio - Dịch vụ web, code, app và SEO')
@section('meta_description', 'Web Template Studio cung cấp dịch vụ làm website, sửa web, hỗ trợ SEO, đồ án sinh viên và task lập trình nhanh cho cá nhân, shop nhỏ và doanh nghiệp nhỏ.')
@section('canonical', route('home'))
@section('structured_data')
    <script type="application/ld+json">
        {!! json_encode([
            '@'.'context' => 'https://schema.org',
            '@'.'type' => 'ProfessionalService',
            'name' => config('app.name', 'Web Template Studio'),
            'url' => route('home'),
            'description' => 'Dịch vụ web, code, app, SEO, hỗ trợ đồ án và task kỹ thuật cho cá nhân, shop nhỏ và doanh nghiệp nhỏ.',
            'areaServed' => 'VN',
            'serviceType' => ['Website Development', 'Landing Page', 'SEO Website', 'UI Fix', 'Technical Support'],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>
@endsection

@section('content')
    <div class="space-y-16">
        @php
            $serviceVisuals = [
                'seo' => [
                    'eyebrow' => 'SEO Website',
                    'icon' => 'SEO',
                    'gradient' => 'from-[#2563EB] via-[#06B6D4] to-[#10B981]',
                    'surface' => 'bg-sky-50',
                    'line' => 'Tăng traffic, heading và CTA',
                ],
                'website' => [
                    'eyebrow' => 'Website Development',
                    'icon' => 'WEB',
                    'gradient' => 'from-[#2563EB] via-[#7C3AED] to-[#0F172A]',
                    'surface' => 'bg-indigo-50',
                    'line' => 'Website giới thiệu và landing page',
                ],
                'ui_fix' => [
                    'eyebrow' => 'Fix Bug / UI',
                    'icon' => 'FIX',
                    'gradient' => 'from-[#F97316] via-[#EF4444] to-[#7C3AED]',
                    'surface' => 'bg-rose-50',
                    'line' => 'Sửa responsive, CTA và trust block',
                ],
                'student_support' => [
                    'eyebrow' => 'Student Project Support',
                    'icon' => 'LAB',
                    'gradient' => 'from-[#0F172A] via-[#2563EB] to-[#06B6D4]',
                    'surface' => 'bg-cyan-50',
                    'line' => 'Source, database, report và demo',
                ],
                'coding_task' => [
                    'eyebrow' => 'Technical Consultation',
                    'icon' => 'DEV',
                    'gradient' => 'from-[#10B981] via-[#06B6D4] to-[#2563EB]',
                    'surface' => 'bg-emerald-50',
                    'line' => 'API, DB, feature nhỏ và support code',
                ],
            ];

            $portfolioVisuals = [
                'landing_page' => [
                    'eyebrow' => 'Landing Page',
                    'icon' => 'LP',
                    'gradient' => 'from-[#2563EB] via-[#7C3AED] to-[#06B6D4]',
                ],
                'website' => [
                    'eyebrow' => 'Website',
                    'icon' => 'WEB',
                    'gradient' => 'from-[#0F172A] via-[#2563EB] to-[#06B6D4]',
                ],
                'seo' => [
                    'eyebrow' => 'SEO Growth',
                    'icon' => 'SEO',
                    'gradient' => 'from-[#10B981] via-[#06B6D4] to-[#2563EB]',
                ],
                'bug_fix' => [
                    'eyebrow' => 'Fix Bug',
                    'icon' => 'FIX',
                    'gradient' => 'from-[#F97316] via-[#EF4444] to-[#7C3AED]',
                ],
                'source_code' => [
                    'eyebrow' => 'Source Code',
                    'icon' => 'SRC',
                    'gradient' => 'from-[#7C3AED] via-[#2563EB] to-[#0F172A]',
                ],
            ];

            $heroScenes = [
                [
                    'eyebrow' => 'Website / Wireframe',
                    'title' => 'Website mockup đi từ wireframe sang landing page chốt lead',
                    'caption' => 'Layout, CTA và trust blocks hiện dần thay vì xuất hiện cứng.',
                    'theme' => 'from-sky-400/24 via-cyan-400/10 to-transparent',
                    'label' => 'Website',
                    'thumb' => 'Wireframe',
                    'metric' => 'Hero + CTA',
                    'accent' => 'bg-sky-300/18',
                ],
                [
                    'eyebrow' => 'Dashboard / Analytics',
                    'title' => 'Dashboard analytics và lead board hiện theo lớp rõ ràng',
                    'caption' => 'Cho cảm giác đội triển khai có process chứ không chỉ sửa từng phần rời rạc.',
                    'theme' => 'from-violet-400/22 via-indigo-400/10 to-transparent',
                    'label' => 'Dashboard',
                    'thumb' => 'Analytics',
                    'metric' => 'Lead board',
                    'accent' => 'bg-violet-300/18',
                ],
                [
                    'eyebrow' => 'Code / Laptop',
                    'title' => 'Laptop coding scene cho bug fix, API và support kỹ thuật',
                    'caption' => 'Thể hiện rõ năng lực xử lý bug, API, database và app scope nhỏ.',
                    'theme' => 'from-cyan-400/16 via-sky-400/8 to-transparent',
                    'label' => 'Code',
                    'thumb' => 'Typing',
                    'metric' => 'API ship',
                    'accent' => 'bg-emerald-300/18',
                ],
                [
                    'eyebrow' => 'SEO / Growth',
                    'title' => 'SEO ranking chart và conversion metrics đi lên theo từng chu kỳ',
                    'caption' => 'Nhấn mạnh website đẹp phải đi cùng khả năng được tìm thấy và chuyển đổi.',
                    'theme' => 'from-emerald-400/20 via-green-400/8 to-transparent',
                    'label' => 'SEO',
                    'thumb' => 'Ranking',
                    'metric' => '+31%',
                    'accent' => 'bg-emerald-300/18',
                ],
                [
                    'eyebrow' => 'Mobile App / Preview',
                    'title' => 'Mobile app preview gắn với website và landing flow',
                    'caption' => 'Khách nhìn vào hiểu ngay đây là đơn vị làm web, app và support kỹ thuật thật.',
                    'theme' => 'from-fuchsia-400/18 via-violet-400/10 to-transparent',
                    'label' => 'App',
                    'thumb' => 'Mobile',
                    'metric' => 'Companion',
                    'accent' => 'bg-fuchsia-300/18',
                ],
                [
                    'eyebrow' => 'Team / Support',
                    'title' => 'Support board cho handoff, review và follow-up sau bàn giao',
                    'caption' => 'Nhấn mạnh phần hỗ trợ, note kỹ thuật và bàn giao không bị đứt đoạn sau khi xong việc.',
                    'theme' => 'from-amber-300/18 via-orange-400/8 to-transparent',
                    'label' => 'Team',
                    'thumb' => 'Handoff',
                    'metric' => 'Support',
                    'accent' => 'bg-amber-300/18',
                ],
            ];
        @endphp

        <section class="hero-agency relative overflow-hidden rounded-[2rem] border border-sky-100/70 bg-[radial-gradient(circle_at_top_left,_rgba(37,99,235,0.22),_transparent_32%),radial-gradient(circle_at_85%_15%,_rgba(124,58,237,0.18),_transparent_28%),linear-gradient(135deg,_rgba(15,23,42,0.98),_rgba(15,23,42,0.88)_38%,_rgba(30,41,59,0.94)_100%)] shadow-[0_32px_80px_-42px_rgba(15,23,42,0.85)]" data-reveal data-landing-section="hero" data-hero-section>
            <div class="hero-agency__blur hero-agency__blur--primary"></div>
            <div class="hero-agency__blur hero-agency__blur--secondary"></div>
            <div class="grid gap-10 px-5 py-6 sm:px-7 sm:py-8 lg:grid-cols-[minmax(0,1.02fr)_minmax(22rem,0.98fr)] lg:items-center lg:px-10 lg:py-10">
                <div class="relative z-10">
                    <p class="inline-flex rounded-full border border-white/10 bg-white/8 px-4 py-2 text-xs font-semibold uppercase tracking-[0.24em] text-sky-200">Agency-grade web, SEO và technical delivery</p>
                    <h1 class="mt-6 max-w-4xl text-4xl font-semibold leading-[1.04] text-white sm:text-5xl lg:text-6xl">Biến Ý Tưởng Thành Website Chuyên Nghiệp Chỉ Trong Vài Ngày</h1>
                    <p class="mt-5 max-w-2xl text-base leading-7 text-slate-300 sm:text-lg">Thiết kế website, landing page, SEO website, fix bug, hỗ trợ đồ án và phát triển app theo yêu cầu với scope rõ, timeline minh bạch và cảm giác triển khai như một agency thực thụ.</p>

                    <div class="mt-7 grid gap-3 text-sm text-white/90 sm:grid-cols-2" data-hero-service-bullets>
                        @foreach ([
                            'Thiết kế Website',
                            'Landing Page',
                            'SEO Website',
                            'Fix Bug',
                            'Hỗ Trợ Đồ Án',
                            'Phát Triển App Theo Yêu Cầu',
                        ] as $bullet)
                            <div class="hero-bullet rounded-2xl border border-white/10 bg-white/7 px-4 py-3 backdrop-blur-sm">
                                <span class="inline-flex size-7 items-center justify-center rounded-full bg-sky-400/18 text-sm font-semibold text-sky-200">+</span>
                                <span class="ml-3 align-middle font-semibold">{{ $bullet }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex flex-col gap-3 sm:flex-row" data-hero-cta-group>
                        <a class="inline-flex justify-center rounded-xl bg-[#2563EB] px-5 py-3.5 text-sm font-semibold text-white shadow-[0_18px_38px_-20px_rgba(37,99,235,0.9)] transition hover:-translate-y-0.5 hover:bg-[#1D4ED8]" href="#quote-form">Nhận Tư Vấn Miễn Phí</a>
                        <a class="inline-flex justify-center rounded-xl border border-white/14 bg-white/8 px-5 py-3.5 text-sm font-semibold text-white transition hover:-translate-y-0.5 hover:bg-white/14" href="{{ route('portfolio.index') }}">Xem Dự Án Đã Thực Hiện</a>
                    </div>

                    <div class="mt-8 grid gap-3 text-sm sm:grid-cols-3" data-hero-trust-strip>
                        @foreach ([
                            ['Phản hồi nhanh', '15-60 phút khi đã có brief'],
                            ['Demo có chủ đích', 'mockup, scope và CTA rõ ràng'],
                            ['Bàn giao chắc tay', 'source, docs và support sau bàn giao'],
                        ] as [$title, $copy])
                            <article class="rounded-2xl border border-white/10 bg-white/7 px-4 py-4 text-slate-100 backdrop-blur-sm">
                                <p class="font-semibold">{{ $title }}</p>
                                <p class="mt-1 text-xs leading-6 text-slate-300">{{ $copy }}</p>
                            </article>
                        @endforeach
                    </div>

                    <div class="mt-7 grid gap-3 sm:grid-cols-3" data-conversion-proof-strip>
                        @foreach ([
                            ['value' => 15, 'suffix' => ' phút', 'label' => 'mốc phản hồi khi brief rõ'],
                            ['value' => 7, 'suffix' => ' ngày', 'label' => 'cho website hoặc task nhỏ rõ scope'],
                            ['value' => 30, 'suffix' => '+', 'label' => 'mẫu/flow có thể dùng làm trust asset'],
                        ] as $item)
                            <article class="rounded-2xl border border-white/10 bg-white/7 px-4 py-4 text-white backdrop-blur-sm">
                                <p class="text-2xl font-semibold">
                                    <span data-count-up="{{ $item['value'] }}">0</span>{{ $item['suffix'] }}
                                </p>
                                <p class="mt-1 text-xs leading-6 text-slate-300">{{ $item['label'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>

                <div class="hero-visual relative z-10 min-h-[34rem] sm:min-h-[38rem]" aria-label="Visual agency cho website, dashboard, code, SEO và app" data-hero-visuals data-hero-interval="4200">
                    <div class="hero-visual__backdrop rounded-[2rem] border border-white/10 bg-white/7 p-3 backdrop-blur-sm">
                        <div class="hero-visual__surface relative overflow-hidden rounded-[1.5rem] border border-white/10 bg-slate-950/96 shadow-[0_30px_70px_-38px_rgba(15,23,42,0.9)]">
                            <div class="hero-visual__frame flex items-center justify-between border-b border-white/10 px-4 py-3 text-xs text-slate-300">
                                <div class="flex items-center gap-2">
                                    <span class="size-2.5 rounded-full bg-rose-400"></span>
                                    <span class="size-2.5 rounded-full bg-amber-400"></span>
                                    <span class="size-2.5 rounded-full bg-emerald-400"></span>
                                </div>
                                <span class="rounded-full bg-white/8 px-3 py-1 font-semibold text-sky-200">Agency Delivery Board</span>
                            </div>

                            <div class="relative h-[29rem] overflow-hidden p-4 sm:h-[31rem]" data-hero-stage data-rotating-media-showcase>
                                @foreach ($heroScenes as $scene)
                                    <article class="hero-scene absolute inset-4 rounded-[1.35rem] border border-white/8 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.1),_transparent_32%),linear-gradient(160deg,_rgba(15,23,42,0.96),_rgba(30,41,59,0.92))] p-4 text-white shadow-[0_22px_42px_-28px_rgba(0,0,0,0.75)]" data-hero-scene @if (! $loop->first) hidden @endif aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                                        <div class="pointer-events-none absolute inset-0 rounded-[1.35rem] bg-gradient-to-br {{ $scene['theme'] }}"></div>
                                        <div class="relative">
                                            <p class="text-[0.72rem] font-semibold uppercase tracking-[0.22em] text-sky-200">{{ $scene['eyebrow'] }}</p>
                                            <h2 class="mt-2 max-w-xs text-2xl font-semibold leading-tight">{{ $scene['title'] }}</h2>
                                            <p class="mt-2 max-w-sm text-sm leading-6 text-slate-300">{{ $scene['caption'] }}</p>
                                        </div>

                                        <div class="relative mt-5 grid gap-4 lg:grid-cols-[1.12fr_0.88fr]">
                                            <div class="rounded-[1.2rem] border border-white/10 bg-white/6 p-4 backdrop-blur-sm">
                                                <div class="rounded-[1rem] border border-dashed border-sky-300/30 bg-slate-900/80 p-3">
                                                    <p class="text-[0.68rem] font-semibold uppercase tracking-[0.22em] text-slate-400">Live composition</p>
                                                    <div class="mt-4 space-y-3">
                                                        <div class="h-3 w-20 rounded-full bg-sky-300/35"></div>
                                                        <div class="grid gap-3 sm:grid-cols-3">
                                                            <span class="h-16 rounded-2xl border border-white/8 bg-white/9"></span>
                                                            <span class="h-16 rounded-2xl border border-white/8 bg-white/9"></span>
                                                            <span class="h-16 rounded-2xl border border-white/8 bg-white/9"></span>
                                                        </div>
                                                        <div class="rounded-[1rem] border border-white/8 bg-gradient-to-r from-white/10 to-transparent p-4">
                                                            <div class="h-3 w-3/4 rounded-full bg-white/12"></div>
                                                            <div class="mt-3 h-2.5 w-11/12 rounded-full bg-white/10"></div>
                                                            <div class="mt-2 h-2.5 w-2/3 rounded-full bg-white/10"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="space-y-3">
                                                <div class="rounded-[1.2rem] border border-white/10 bg-white/7 p-4 backdrop-blur-sm">
                                                    <p class="text-[0.68rem] font-semibold uppercase tracking-[0.22em] text-slate-400">Typing stream</p>
                                                    <div class="hero-code mt-3 rounded-[1rem] bg-slate-950/90 px-4 py-3 font-mono text-[0.74rem] leading-6 text-emerald-300">
                                                        <span class="block">$ scope: website, seo, app-support</span>
                                                        <span class="block">$ status: shipping fast with clean handoff</span>
                                                        <span class="block hero-code__cursor">_</span>
                                                    </div>
                                                </div>
                                                <div class="rounded-[1.2rem] border border-white/10 bg-white/7 p-4 backdrop-blur-sm">
                                                    <div class="flex items-end justify-between gap-3">
                                                        <div>
                                                            <p class="text-[0.68rem] font-semibold uppercase tracking-[0.22em] text-slate-400">SEO / conversion pulse</p>
                                                            <p class="mt-1 text-lg font-semibold text-white">Organic + CTA trend</p>
                                                        </div>
                                                        <span class="rounded-full bg-emerald-400/12 px-2.5 py-1 text-xs font-semibold text-emerald-200">+31%</span>
                                                    </div>
                                                    <div class="mt-4 flex h-24 items-end gap-2">
                                                        @foreach ([28, 36, 42, 58, 64, 78] as $height)
                                                            <span class="hero-chart__bar rounded-t-full bg-gradient-to-t from-cyan-400 to-emerald-300" style="height: {{ $height }}%"></span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="hero-phone rounded-[1.5rem] border border-white/10 bg-slate-900/94 p-3 shadow-[0_18px_44px_-24px_rgba(0,0,0,0.75)]">
                                                    <div class="mx-auto h-1.5 w-16 rounded-full bg-white/15"></div>
                                                    <div class="mt-4 rounded-[1.1rem] bg-gradient-to-br from-white/10 to-transparent p-3">
                                                        <div class="h-24 rounded-[1rem] bg-sky-300/18"></div>
                                                        <div class="mt-3 h-2.5 w-3/4 rounded-full bg-white/12"></div>
                                                        <div class="mt-2 h-2.5 w-1/2 rounded-full bg-white/10"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                @endforeach
                            </div>

                            <div class="border-t border-white/10 px-4 py-3">
                                <div class="grid gap-2 sm:grid-cols-3" role="tablist" aria-label="Chuyển visual hero" data-hero-media-rail>
                                    @foreach ($heroScenes as $scene)
                                        <button class="hero-scene-control hero-scene-control--media rounded-[1rem] border border-white/10 bg-white/6 px-3 py-3 text-left text-xs font-semibold text-slate-200 transition hover:bg-white/12" type="button" data-hero-control aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <span class="flex items-center justify-between gap-3">
                                                <span class="block">
                                                    <span class="block text-[0.68rem] uppercase tracking-[0.2em] text-slate-400">{{ $scene['thumb'] }}</span>
                                                    <span class="mt-1 block text-sm font-semibold text-white">{{ $scene['label'] }}</span>
                                                </span>
                                                <span class="hero-scene-control__thumb {{ $scene['accent'] }} skeleton-shimmer">
                                                    <span class="hero-scene-control__thumb-line"></span>
                                                    <span class="hero-scene-control__thumb-grid"></span>
                                                </span>
                                            </span>
                                            <span class="mt-2 block text-[0.72rem] uppercase tracking-[0.18em] text-sky-200">{{ $scene['metric'] }}</span>
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="hero-side-note hero-side-note--left rounded-2xl border border-white/10 bg-white/8 p-4 text-white backdrop-blur-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-cyan-200">Delivery speed</p>
                        <p class="mt-2 text-2xl font-semibold">3-7 ngày</p>
                        <p class="mt-1 text-sm leading-6 text-slate-300">cho website, landing page hoặc task code nhỏ đã rõ scope.</p>
                    </div>
                    <div class="hero-side-note hero-side-note--right rounded-2xl border border-white/10 bg-white/8 p-4 text-white backdrop-blur-sm">
                        <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-200">Agency note</p>
                        <p class="mt-2 text-sm font-semibold">Từ wireframe đến bản chạy được, có hướng dẫn và support sau bàn giao.</p>
                    </div>
                </div>
            </div>
        </section>

        @php
            $painPoints = [
                ['title' => 'Không biết làm website ở đâu', 'copy' => 'Lo ngại giao sai người, giao diện thiếu tin cậy hoặc bàn giao không rõ ràng.', 'icon' => '01'],
                ['title' => 'Website tải chậm', 'copy' => 'Khách thoát nhanh vì trang nặng, rối và không mượt trên mobile.', 'icon' => '02'],
                ['title' => 'Website không có khách', 'copy' => 'Có website nhưng không có SEO cơ bản, CTA yếu và thiếu nội dung chốt lead.', 'icon' => '03'],
                ['title' => 'Landing Page không chuyển đổi', 'copy' => 'Traffic có nhưng form, offer và trust block chưa đủ thuyết phục để khách để lại thông tin.', 'icon' => '04'],
                ['title' => 'Đồ án sắp tới hạn', 'copy' => 'Source chưa hoàn thiện, thiếu database, báo cáo hoặc hướng dẫn để demo/bảo vệ.', 'icon' => '05'],
                ['title' => 'Không đủ người xử lý task', 'copy' => 'Cần fix bug, API, UI hoặc database nhanh nhưng team nội bộ không kịp xoay.', 'icon' => '06'],
            ];

            $solutionMappings = [
                ['pain' => 'Website và landing page', 'solution' => 'Chốt nhanh scope, dựng giao diện service-first, CTA rõ và có demo để duyệt trước.'],
                ['pain' => 'Tốc độ và mobile UX', 'solution' => 'Rà lại layout, asset, spacing, CTA và trải nghiệm mobile để khách đọc dễ và bấm dễ.'],
                ['pain' => 'SEO và chuyển đổi', 'solution' => 'Tối ưu title, meta, nội dung, internal link, trust section và quote funnel theo mục tiêu lead.'],
                ['pain' => 'Đồ án sinh viên', 'solution' => 'Bổ sung source, database, report, tài liệu cài đặt và giải thích flow để bảo vệ chắc hơn.'],
                ['pain' => 'Task code gấp', 'solution' => 'Nhận fix bug, API, DB, giao diện hoặc feature nhỏ theo issue rõ, bàn giao kèm note kỹ thuật.'],
                ['pain' => 'Support sau bàn giao', 'solution' => 'Giữ liên hệ qua Zalo/email, hỗ trợ chỉnh sửa và triển khai tiếp khi cần mở rộng.'],
            ];
        @endphp

        <section class="space-y-6" data-reveal data-landing-section="problems" data-problem-grid>
            <div class="max-w-3xl">
                <p class="text-sm font-semibold text-rose-700">Khách hàng đang gặp vấn đề gì</p>
                <h2 class="mt-2 text-3xl font-semibold text-zinc-950">Nhìn đúng pain point trong 10 giây đầu để biết mình cần hỗ trợ kiểu nào.</h2>
                <p class="mt-3 text-sm leading-6 text-zinc-600">Các vấn đề dưới đây là lý do khách hàng thường tìm đến khi cần làm website, sửa landing page, hỗ trợ SEO, đồ án hoặc task code nhỏ.</p>
            </div>

            <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                @foreach ($painPoints as $item)
                    <article class="problem-card motion-card rounded-[1.5rem] border border-zinc-200 bg-white p-5 shadow-sm" data-problem-card data-reveal style="--reveal-delay: {{ $loop->index * 60 }}ms">
                        <div class="flex items-start justify-between gap-3">
                            <span class="grid size-11 place-items-center rounded-2xl bg-rose-50 text-sm font-semibold text-rose-700 ring-1 ring-rose-100">{{ $item['icon'] }}</span>
                            <span class="rounded-full bg-zinc-100 px-2.5 py-1 text-[0.7rem] font-semibold uppercase tracking-[0.16em] text-zinc-500">Pain point</span>
                        </div>
                        <h3 class="mt-5 text-xl font-semibold text-zinc-950">{{ $item['title'] }}</h3>
                        <p class="mt-3 text-sm leading-6 text-zinc-600">{{ $item['copy'] }}</p>
                        <div class="mt-5 flex items-center gap-2 text-sm font-semibold text-rose-700">
                            <span>Giải pháp tương ứng</span>
                            <span aria-hidden="true">→</span>
                        </div>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="grid gap-6 rounded-lg border border-emerald-100 bg-emerald-50 p-6 lg:grid-cols-[22rem_1fr]" data-reveal data-landing-section="solutions">
            <div>
                <p class="text-sm font-semibold text-emerald-800">Giải pháp tương ứng</p>
                <h2 class="mt-2 text-3xl font-semibold text-zinc-950">Mỗi pain point đều có hướng xử lý rõ và dịch vụ bám sát việc thật.</h2>
                <p class="mt-3 text-sm leading-6 text-emerald-900/80">Thay vì nói chung chung, phần này map từng nhóm vấn đề sang cách triển khai thực tế để khách hiểu vì sao nên liên hệ ngay.</p>
            </div>
            <div class="grid gap-4 md:grid-cols-2">
                @foreach ($solutionMappings as $item)
                    <article class="solution-card motion-card rounded-[1.5rem] border border-white/80 bg-white p-5 shadow-sm" data-reveal data-solution-card style="--reveal-delay: {{ $loop->index * 70 }}ms">
                        <div class="flex items-start gap-4">
                            <span class="grid size-10 shrink-0 place-items-center rounded-2xl bg-emerald-100 text-sm font-semibold text-emerald-700">{{ $loop->iteration }}</span>
                            <div>
                                <p class="text-sm font-semibold text-zinc-950">{{ $item['pain'] }}</p>
                                <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $item['solution'] }}</p>
                            </div>
                        </div>
                    </article>
                @endforeach
                @foreach ([
                    ['Có demo trước khi bàn giao', 'Xem giao diện thật, luồng liên hệ và nội dung chính trước khi chốt chỉnh sửa.'],
                    ['Giao diện đẹp, tối ưu mobile', 'Phù hợp khách xem bằng điện thoại, có cấu trúc dễ đọc và CTA nổi bật.'],
                    ['Form thu lead và CTA rõ ràng', 'Zalo, Facebook, Email và form báo giá được đặt ở điểm khách dễ hành động.'],
                    ['Bàn giao source, database, tài liệu', 'Phù hợp sinh viên hoặc khách cần tự vận hành sau khi nhận sản phẩm.'],
                ] as [$title, $copy])
                    <article class="motion-card rounded-[1.5rem] border border-white/80 bg-white p-5 shadow-sm" data-reveal data-value-card style="--reveal-delay: {{ ($loop->index + count($solutionMappings)) * 70 }}ms">
                        <h3 class="text-base font-semibold text-zinc-950">{{ $title }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        <section class="space-y-4" data-reveal data-landing-section="services">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-rose-700">Danh sách dịch vụ</p>
                    <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Chọn đúng nhóm hỗ trợ với card đủ khác biệt để nhớ ngay mình cần gì.</h2>
                </div>
                <a class="text-sm font-semibold text-rose-700" href="{{ route('services') }}">Xem catalog đầy đủ</a>
            </div>
            <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3" data-service-visual-grid>
                @foreach ($featuredServices as $service)
                    @php
                        $visual = $serviceVisuals[$service->service_group] ?? $serviceVisuals['website'];
                    @endphp
                    <article class="service-visual-card motion-card overflow-hidden rounded-[1.65rem] border border-zinc-200 bg-white shadow-sm" data-reveal data-service-visual-card style="--reveal-delay: {{ $loop->index * 70 }}ms">
                        <div class="service-visual-card__top bg-gradient-to-br {{ $visual['gradient'] }} p-5 text-white">
                            <div class="flex items-start justify-between gap-3">
                                <div>
                                    <p class="text-[0.72rem] font-semibold uppercase tracking-[0.2em] text-white/75">{{ $visual['eyebrow'] }}</p>
                                    <h3 class="mt-3 text-xl font-semibold">{{ $service->name }}</h3>
                                </div>
                                <span class="service-visual-card__icon">{{ $visual['icon'] }}</span>
                            </div>
                            <div class="service-visual-card__mockup mt-5 rounded-[1.25rem] border border-white/10 bg-white/10 p-4 backdrop-blur-sm">
                                <div class="flex items-center gap-2">
                                    <span class="size-2 rounded-full bg-white/70"></span>
                                    <span class="size-2 rounded-full bg-white/35"></span>
                                    <span class="size-2 rounded-full bg-white/25"></span>
                                </div>
                                <div class="mt-4 h-3 w-28 rounded-full bg-white/30"></div>
                                <div class="mt-3 grid grid-cols-3 gap-2">
                                    <span class="h-14 rounded-2xl bg-white/14"></span>
                                    <span class="h-14 rounded-2xl bg-white/12"></span>
                                    <span class="h-14 rounded-2xl bg-white/10"></span>
                                </div>
                            </div>
                        </div>
                        <div class="p-5">
                            <p class="text-sm leading-6 text-zinc-600">{{ $service->short_description }}</p>
                            @if ($service->key_benefits)
                                <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold">
                                    @foreach (array_slice($service->key_benefits, 0, 2) as $benefit)
                                        <span class="rounded-full px-3 py-1 {{ $visual['surface'] }} text-zinc-800">{{ $benefit }}</span>
                                    @endforeach
                                </div>
                            @endif
                            <p class="mt-4 text-sm font-semibold text-zinc-950">{{ $visual['line'] }}</p>
                            <div class="mt-5 flex flex-col gap-2 sm:flex-row">
                                <a class="rounded-xl bg-zinc-950 px-4 py-2.5 text-sm font-semibold text-white" href="{{ route('services.show', $service) }}">Xem chi tiết dịch vụ</a>
                                <a class="rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-800" href="#quote-form">Nhận tư vấn</a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
            <div class="grid gap-4 md:grid-cols-2" data-service-extended-offers>
                @foreach ([
                    ['title' => 'Mobile App Development', 'copy' => 'Nhận app nội bộ nhỏ, app companion cho web hoặc MVP gắn với API có sẵn.', 'tone' => 'from-[#7C3AED] via-[#2563EB] to-[#06B6D4]'],
                    ['title' => 'Technical Consultation', 'copy' => 'Nhận audit scope, breakdown task, hỗ trợ debug hoặc tư vấn giải pháp trước khi build lớn.', 'tone' => 'from-[#10B981] via-[#06B6D4] to-[#0F172A]'],
                ] as $item)
                    <article class="rounded-[1.5rem] border border-zinc-200 bg-white p-5 shadow-sm">
                        <div class="rounded-[1.2rem] bg-gradient-to-r {{ $item['tone'] }} p-4 text-white">
                            <p class="text-sm font-semibold">{{ $item['title'] }}</p>
                            <p class="mt-2 text-sm leading-6 text-white/85">{{ $item['copy'] }}</p>
                        </div>
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

        <section class="space-y-4" data-reveal data-landing-section="portfolio">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-sm font-semibold text-rose-700">Portfolio và case study</p>
                    <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Case study đủ hình dung cách tôi phân tích, triển khai và bàn giao dự án.</h2>
                </div>
                <a class="text-sm font-semibold text-rose-700" href="{{ route('portfolio.index') }}">Xem portfolio</a>
            </div>
            @if ($featuredDemos->isNotEmpty())
                <div class="grid gap-4 xl:grid-cols-[minmax(0,1.2fr)_minmax(20rem,0.8fr)]" data-portfolio-home-showcase>
                    @php
                        $leadDemo = $featuredDemos->first();
                        $supportingDemos = $featuredDemos->slice(1);
                        $leadDemoLabel = $leadDemo->websiteTemplate?->name ?: ($leadDemo->sourceCodeProduct?->name ?: 'Custom delivery');
                        $leadVisual = $portfolioVisuals[$leadDemo->project_type] ?? [
                            'eyebrow' => 'Case Study',
                            'icon' => 'CS',
                            'gradient' => 'from-[#2563EB] via-[#7C3AED] to-[#06B6D4]',
                        ];
                    @endphp

                    <article class="portfolio-showcase-card overflow-hidden rounded-[1.8rem] border border-zinc-200 bg-white shadow-[0_28px_80px_-50px_rgba(15,23,42,0.35)]" data-portfolio-home-hero>
                        <div class="grid gap-0 lg:grid-cols-[minmax(0,1fr)_20rem]">
                            <div class="bg-zinc-950 p-5 text-white sm:p-7">
                                <div class="flex items-center justify-between gap-4">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-[0.24em] text-sky-200">{{ $leadVisual['eyebrow'] }}</p>
                                        <h3 class="mt-3 text-2xl font-semibold">{{ $leadDemo->name }}</h3>
                                    </div>
                                    <span class="portfolio-showcase-card__icon bg-white/10 text-sky-100">{{ $leadVisual['icon'] }}</span>
                                </div>
                                <p class="mt-4 max-w-2xl text-sm leading-7 text-slate-300">{{ $leadDemo->client_problem }}</p>

                                <div class="portfolio-showcase-card__mockup mt-6 rounded-[1.4rem] border border-white/10 bg-gradient-to-br {{ $leadVisual['gradient'] }} p-4" data-portfolio-preview>
                                    <div class="rounded-[1.15rem] border border-white/16 bg-slate-950/86 p-4">
                                        <div class="flex items-center justify-between text-xs text-slate-300">
                                            <span class="font-semibold">Preview board</span>
                                            <span>{{ $leadDemoLabel }}</span>
                                        </div>
                                        <div class="mt-4 grid gap-3 sm:grid-cols-[1.15fr_0.85fr]">
                                            <div class="rounded-[1rem] border border-white/10 bg-white/8 p-4">
                                                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-sky-200">Vai trò thực hiện</p>
                                                <p class="mt-2 text-sm leading-6 text-white/90">{{ $leadDemo->role_summary }}</p>
                                            </div>
                                            <div class="space-y-3">
                                                <div class="rounded-[1rem] border border-white/10 bg-white/8 p-4">
                                                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-sky-200">Kết quả</p>
                                                    <p class="mt-2 text-sm leading-6 text-white/90">{{ $leadDemo->outcome_summary }}</p>
                                                </div>
                                                <div class="rounded-[1rem] border border-white/10 bg-white/8 p-4">
                                                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-sky-200">Tech stack</p>
                                                    <div class="mt-3 flex flex-wrap gap-2">
                                                        @foreach (collect($leadDemo->tech_stack ?? [])->take(4) as $tech)
                                                            <span class="rounded-full bg-white/10 px-3 py-1 text-xs font-semibold text-white/90">{{ $tech }}</span>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-6 flex flex-wrap gap-3">
                                    <a class="rounded-xl bg-white px-4 py-2.5 text-sm font-semibold text-zinc-950" href="{{ route('portfolio.show', $leadDemo) }}">Xem case study chi tiết</a>
                                    <a class="rounded-xl border border-white/14 px-4 py-2.5 text-sm font-semibold text-white" href="{{ $leadDemo->demo_url }}">Xem demo</a>
                                </div>
                            </div>

                            <div class="space-y-4 bg-white p-5 sm:p-6">
                                <div class="rounded-[1.35rem] border border-zinc-200 bg-zinc-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-zinc-500">Case phù hợp cho</p>
                                    <div class="mt-3 space-y-3 text-sm text-zinc-700">
                                        @foreach ($featuredServices->take(3) as $service)
                                            <div class="rounded-2xl border border-white bg-white px-4 py-3 shadow-sm">
                                                <p class="font-semibold text-zinc-950">{{ $service->name }}</p>
                                                <p class="mt-1 text-xs leading-5 text-zinc-600">{{ $service->short_description }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="rounded-[1.35rem] border border-zinc-200 bg-zinc-50 p-4">
                                    <p class="text-xs font-semibold uppercase tracking-[0.22em] text-zinc-500">Trust assets</p>
                                    <div class="mt-3 grid gap-3">
                                        <div class="rounded-2xl border border-zinc-200 bg-white px-4 py-3 shadow-sm">
                                            <p class="text-sm font-semibold text-zinc-950">Brief rõ trước khi làm</p>
                                            <p class="mt-1 text-xs leading-5 text-zinc-600">Mỗi case study đều bám problem, scope, tech stack và outcome thay vì chỉ khoe giao diện.</p>
                                        </div>
                                        <div class="rounded-2xl border border-zinc-200 bg-white px-4 py-3 shadow-sm">
                                            <p class="text-sm font-semibold text-zinc-950">Có demo và flow bàn giao</p>
                                            <p class="mt-1 text-xs leading-5 text-zinc-600">Khách có thể xem demo trước, sau đó nhận source, docs và hỗ trợ kỹ thuật khi cần.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <div class="grid gap-4" data-portfolio-home-grid>
                        @foreach ($supportingDemos as $demo)
                            @php
                                $visual = $portfolioVisuals[$demo->project_type] ?? [
                                    'eyebrow' => 'Case Study',
                                    'icon' => 'CS',
                                    'gradient' => 'from-[#2563EB] via-[#7C3AED] to-[#06B6D4]',
                                ];
                            @endphp
                            <article class="portfolio-showcase-card rounded-[1.6rem] border border-zinc-200 bg-white p-5 shadow-[0_20px_60px_-42px_rgba(15,23,42,0.3)]" data-portfolio-card>
                                <div class="rounded-[1.2rem] bg-gradient-to-br {{ $visual['gradient'] }} p-[1px]">
                                    <div class="portfolio-showcase-card__mockup rounded-[1.15rem] bg-slate-950 px-4 py-4 text-white">
                                        <div class="flex items-center justify-between">
                                            <p class="text-xs font-semibold uppercase tracking-[0.22em] text-sky-200">{{ $visual['eyebrow'] }}</p>
                                            <span class="portfolio-showcase-card__icon bg-white/10 text-sky-100">{{ $visual['icon'] }}</span>
                                        </div>
                                        <h3 class="mt-4 text-lg font-semibold">{{ $demo->name }}</h3>
                                        <p class="mt-2 text-sm leading-6 text-slate-300">{{ $demo->role_summary }}</p>
                                    </div>
                                </div>
                                <div class="mt-4 flex flex-wrap gap-2">
                                    @foreach (collect($demo->tech_stack ?? [])->take(4) as $tech)
                                        <span class="rounded-full bg-zinc-100 px-3 py-1 text-xs font-semibold text-zinc-700">{{ $tech }}</span>
                                    @endforeach
                                </div>
                                <p class="mt-4 text-sm leading-6 text-zinc-600">{{ $demo->outcome_summary }}</p>
                                <div class="mt-4 flex flex-wrap gap-3">
                                    <a class="rounded-xl bg-zinc-950 px-4 py-2.5 text-sm font-semibold text-white" href="{{ route('portfolio.show', $demo) }}">Xem case study</a>
                                    <a class="rounded-xl border border-zinc-300 px-4 py-2.5 text-sm font-semibold text-zinc-800" href="{{ $demo->demo_url }}">Xem demo</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="rounded-[1.6rem] border border-dashed border-zinc-300 bg-white p-6 text-sm text-zinc-600">Chưa có case study công khai. Hãy thêm vài portfolio project để section này trở thành trust asset chính của landing page.</div>
            @endif
        </section>

        <section class="grid gap-4 rounded-[1.8rem] border border-sky-100 bg-[linear-gradient(135deg,rgba(37,99,235,0.08),rgba(124,58,237,0.08),rgba(6,182,212,0.08))] p-6 shadow-sm lg:grid-cols-[minmax(0,1fr)_24rem]" data-reveal data-conversion-strip>
            <div>
                <p class="text-sm font-semibold text-rose-700">Sẵn sàng chốt scope</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Nếu bạn đã thấy đúng vấn đề của mình, bước tiếp theo chỉ còn là gửi brief ngắn.</h2>
                <p class="mt-3 max-w-3xl text-sm leading-6 text-zinc-600">Chỉ cần gửi mục tiêu, deadline và link tham khảo. Tôi sẽ phản hồi theo hướng: làm website mới, sửa giao diện, tối ưu SEO hay nhận task code nhỏ.</p>
                <div class="mt-5 flex flex-wrap gap-3 text-sm">
                    <a class="rounded-xl bg-[#2563EB] px-4 py-3 font-semibold text-white shadow-[0_18px_38px_-22px_rgba(37,99,235,0.72)]" href="#quote-form">Nhận tư vấn miễn phí</a>
                    <a class="rounded-xl border border-zinc-300 bg-white px-4 py-3 font-semibold text-zinc-900" href="{{ config('contact.zalo_url', '#') }}">Nhắn Zalo ngay</a>
                </div>
            </div>
            <div class="grid gap-3">
                @foreach ([
                    ['Bạn đang cần website hoặc landing page mới', 'Phù hợp nếu cần ra bản chạy được nhanh, rõ CTA và có demo để duyệt.'],
                    ['Bạn đã có web nhưng đang lỗi hoặc thiếu chuyển đổi', 'Phù hợp nếu cần fix bug, tối ưu mobile, SEO hoặc làm rõ funnel liên hệ.'],
                    ['Bạn cần hỗ trợ code, app hoặc đồ án gấp', 'Phù hợp nếu cần breakdown task, API, DB, source Laravel hoặc support bảo vệ.'],
                ] as [$title, $copy])
                    <article class="rounded-[1.2rem] border border-white/80 bg-white/90 px-4 py-4 shadow-sm">
                        <p class="font-semibold text-zinc-950">{{ $title }}</p>
                        <p class="mt-1 text-sm leading-6 text-zinc-600">{{ $copy }}</p>
                    </article>
                @endforeach
            </div>
        </section>

        @php
            $processSteps = [
                ['label' => 'Bước 1', 'title' => 'Tiếp nhận yêu cầu', 'copy' => 'Nhận brief qua form, Zalo hoặc email để nắm mục tiêu, tệp khách và deadline.'],
                ['label' => 'Bước 2', 'title' => 'Phân tích', 'copy' => 'Tách scope, nhận diện điểm nghẽn hiện tại và chốt hướng làm phù hợp ngân sách.'],
                ['label' => 'Bước 3', 'title' => 'Báo giá', 'copy' => 'Đưa ra gói xử lý, mốc thời gian và đầu ra bàn giao rõ ràng trước khi bắt đầu.'],
                ['label' => 'Bước 4', 'title' => 'Thực hiện', 'copy' => 'Triển khai giao diện, code, SEO hoặc fix bug theo checklist ưu tiên đã thống nhất.'],
                ['label' => 'Bước 5', 'title' => 'Bàn giao', 'copy' => 'Gửi source, tài liệu, demo và checklist nghiệm thu để khách dễ kiểm tra.'],
                ['label' => 'Bước 6', 'title' => 'Hỗ trợ', 'copy' => 'Theo dõi sau bàn giao, sửa các điểm nhỏ và hướng dẫn vận hành nếu cần.'],
            ];

            $feedbackItems = $testimonials->isNotEmpty()
                ? $testimonials->take(6)
                : collect([
                    (object) ['name' => 'Khách landing page', 'avatar_label' => 'LP', 'audience_type' => 'online_seller', 'service_type' => 'landing_page', 'content' => 'CTA rõ ràng hơn và có luồng tư vấn dễ chốt hơn.', 'rating' => 5, 'trust_tag' => 'Lead tăng rõ'],
                    (object) ['name' => 'Sinh viên Laravel', 'avatar_label' => 'SV', 'audience_type' => 'student', 'service_type' => 'student_support', 'content' => 'Có source, database và hướng dẫn nên hoàn thiện đồ án nhanh hơn.', 'rating' => 5, 'trust_tag' => 'Bàn giao dễ hiểu'],
                    (object) ['name' => 'Shop mỹ phẩm', 'avatar_label' => 'SM', 'audience_type' => 'shop_owner', 'service_type' => 'seo', 'content' => 'Website nhìn tin cậy hơn, tốc độ và nội dung đều được tối ưu lại.', 'rating' => 5, 'trust_tag' => 'Trust tốt hơn'],
                ]);
        @endphp

        <section class="space-y-4" data-reveal data-landing-section="feedback">
            <div>
                <p class="text-sm font-semibold text-rose-700">Feedback và cam kết</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Điều khách hàng quan tâm nhất là có người làm chắc tay, nói rõ việc và phản hồi được nhanh.</h2>
            </div>
            <div class="rounded-[1.8rem] border border-zinc-200 bg-white p-5 shadow-[0_22px_70px_-46px_rgba(15,23,42,0.32)]" data-feedback-carousel data-feedback-interval="5000">
                <div class="grid gap-4 lg:grid-cols-[minmax(0,1fr)_14rem] lg:items-start">
                    <div class="relative min-h-[16rem]" data-feedback-stage>
                        @foreach ($feedbackItems as $testimonial)
                            <article class="feedback-slide rounded-[1.5rem] border border-zinc-200 bg-zinc-50 p-5 shadow-sm" data-feedback-slide @if (! $loop->first) hidden @endif aria-hidden="{{ $loop->first ? 'false' : 'true' }}">
                                <div class="flex items-center gap-3">
                                    <span class="grid size-12 place-items-center rounded-full bg-rose-100 text-sm font-semibold text-rose-700">{{ $testimonial->avatar_label }}</span>
                                    <div>
                                        <p class="font-semibold text-zinc-950">{{ $testimonial->name }}</p>
                                        <p class="text-xs uppercase tracking-[0.18em] text-zinc-500">{{ $testimonial->audience_type }} · {{ $testimonial->service_type }}</p>
                                    </div>
                                </div>
                                <p class="mt-5 text-lg font-semibold leading-8 text-zinc-950">“{{ $testimonial->content }}”</p>
                                <div class="mt-5 flex flex-wrap items-center justify-between gap-3">
                                    <p class="rounded-full bg-white px-4 py-2 text-sm font-semibold text-zinc-950 shadow-sm">{{ $testimonial->trust_tag }}</p>
                                    <p class="text-sm text-amber-500">{{ str_repeat('★', $testimonial->rating) }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="grid gap-3" data-feedback-controls>
                        @foreach ($feedbackItems as $testimonial)
                            <button class="feedback-control rounded-[1.15rem] border border-zinc-200 bg-white px-4 py-3 text-left transition hover:border-rose-200 hover:bg-rose-50" type="button" data-feedback-control aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                <span class="block text-sm font-semibold text-zinc-950">{{ $testimonial->name }}</span>
                                <span class="mt-1 block text-xs uppercase tracking-[0.18em] text-zinc-500">{{ $testimonial->trust_tag }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        <section class="space-y-5" data-reveal data-landing-section="process">
            <div>
                <p class="text-sm font-semibold text-rose-700">Quy trình dễ hiểu</p>
                <h2 class="mt-2 text-2xl font-semibold text-zinc-950">Từ lúc nhận brief đến lúc support sau bàn giao đều có thứ tự rõ ràng.</h2>
            </div>
            <div class="process-timeline grid gap-4 xl:grid-cols-6" data-process-timeline>
                @foreach ($processSteps as $step)
                    <article class="motion-card rounded-[1.45rem] border border-zinc-200 bg-white p-5 shadow-sm" data-reveal data-process-step style="--reveal-delay: {{ $loop->index * 70 }}ms">
                        <div class="flex items-center gap-3">
                            <span class="grid size-10 place-items-center rounded-xl bg-zinc-950 text-sm font-semibold text-white">{{ $loop->iteration }}</span>
                            <p class="text-xs font-semibold uppercase tracking-[0.18em] text-rose-700">{{ $step['label'] }}</p>
                        </div>
                        <h3 class="mt-4 text-lg font-semibold text-zinc-950">{{ $step['title'] }}</h3>
                        <p class="mt-2 text-sm leading-6 text-zinc-600">{{ $step['copy'] }}</p>
                    </article>
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

        <x-contact-cta
            headline="Gửi brief ngắn để nhận scope, timeline và hướng xử lý rõ ràng."
            description="Càng mô tả rõ mục tiêu, deadline, link hiện tại hoặc reference, phần phản hồi và báo giá càng nhanh. Phù hợp nhất khi bạn đã xác định cần website mới, tối ưu SEO, sửa giao diện hoặc nhận task code nhỏ."
            buttonLabel="Nhận scope và báo giá nhanh"
        />

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

        <x-faq-list :faqs="$faqs" />
    </div>
@endsection
