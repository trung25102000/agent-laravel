<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactMessageRequest;
use App\Http\Requests\StoreGraduationProjectRequestRequest;
use App\Http\Requests\StoreOrderRequestRequest;
use App\Http\Requests\StoreQuoteRequestRequest;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\FaqItem;
use App\Models\GraduationProjectRequest;
use App\Models\OrderRequest;
use App\Models\PricingPackage;
use App\Models\QuoteRequest;
use App\Models\SourceCodeProduct;
use App\Models\TemplateCategory;
use App\Models\WebsiteTemplate;
use App\Services\CustomerUpsertService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class MarketplaceController extends Controller
{
    public function home(): View
    {
        return view('marketplace.home', [
            'featuredTemplates' => Schema::hasTable('website_templates') ? WebsiteTemplate::query()->where('status', 'active')->latest()->limit(6)->get() : collect(),
            'packages' => Schema::hasTable('pricing_packages') ? PricingPackage::query()->where('is_active', true)->orderByDesc('is_featured')->orderBy('sort_order')->limit(6)->get() : collect(),
            'posts' => Schema::hasTable('blog_posts') ? BlogPost::query()->where('status', 'published')->latest('published_at')->limit(3)->get() : collect(),
            'faqs' => Schema::hasTable('faq_items') ? FaqItem::query()->where('is_active', true)->orderBy('sort_order')->limit(6)->get() : collect(),
        ]);
    }

    public function services(): View
    {
        return view('marketplace.services', [
            'packages' => PricingPackage::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'faqs' => FaqItem::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function templates(Request $request): View
    {
        $validated = $request->validate([
            'category' => ['nullable', 'string', 'max:120'],
            'search' => ['nullable', 'string', 'max:120'],
            'sort' => ['nullable', 'in:newest,price_asc,price_desc'],
        ]);

        $templates = WebsiteTemplate::query()
            ->with('category')
            ->where('status', 'active')
            ->when($validated['category'] ?? null, fn ($query, string $slug) => $query->whereHas('category', fn ($category) => $category->where('slug', $slug)))
            ->when($validated['search'] ?? null, fn ($query, string $search) => $query->where(fn ($inner) => $inner
                ->where('name', 'like', "%{$search}%")
                ->orWhere('summary', 'like', "%{$search}%")
            ))
            ->when(($validated['sort'] ?? 'newest') === 'price_asc', fn ($query) => $query->orderBy('price'))
            ->when(($validated['sort'] ?? 'newest') === 'price_desc', fn ($query) => $query->orderByDesc('price'))
            ->when(($validated['sort'] ?? 'newest') === 'newest', fn ($query) => $query->latest())
            ->paginate(12)
            ->withQueryString();

        return view('marketplace.templates.index', [
            'templates' => $templates,
            'categories' => TemplateCategory::query()->where('is_active', true)->orderBy('sort_order')->get(),
            'filters' => $validated,
        ]);
    }

    public function templateDetail(WebsiteTemplate $websiteTemplate): View
    {
        abort_unless($websiteTemplate->status === 'active', 404);

        return view('marketplace.templates.show', [
            'template' => $websiteTemplate->load(['category', 'demoProjects', 'attachments']),
            'packages' => PricingPackage::query()->where('is_active', true)->whereIn('package_type', ['template', 'website'])->orderBy('sort_order')->get(),
        ]);
    }

    public function pricing(string $type): View
    {
        $map = [
            'shop' => ['audience' => 'shop_owner', 'title' => 'Gói website cho shop nhỏ'],
            'landing-page' => ['audience' => 'online_seller', 'title' => 'Gói landing page chạy quảng cáo'],
            'graduation-project' => ['audience' => 'student', 'title' => 'Gói đồ án tốt nghiệp Laravel'],
        ];

        abort_unless(isset($map[$type]), 404);

        return view('marketplace.pricing', [
            'type' => $type,
            'title' => $map[$type]['title'],
            'packages' => PricingPackage::query()
                ->where('is_active', true)
                ->where('audience_type', $map[$type]['audience'])
                ->orderByDesc('is_featured')
                ->orderBy('sort_order')
                ->get(),
            'faqs' => FaqItem::query()->where('is_active', true)->where('audience_type', $map[$type]['audience'])->orderBy('sort_order')->get(),
        ]);
    }

    public function sourceCode(): View
    {
        return view('marketplace.source-code.index', [
            'products' => SourceCodeProduct::query()->with(['demoProjects', 'attachments'])->where('status', 'active')->latest()->paginate(12),
        ]);
    }

    public function sourceCodeDetail(SourceCodeProduct $sourceCodeProduct): View
    {
        abort_unless($sourceCodeProduct->status === 'active', 404);

        return view('marketplace.source-code.show', [
            'product' => $sourceCodeProduct->load(['demoProjects', 'attachments']),
        ]);
    }

    public function blog(): View
    {
        return view('marketplace.blog.index', [
            'posts' => BlogPost::query()->where('status', 'published')->latest('published_at')->paginate(9),
        ]);
    }

    public function blogDetail(BlogPost $blogPost): View
    {
        abort_unless($blogPost->status === 'published', 404);

        return view('marketplace.blog.show', ['post' => $blogPost]);
    }

    public function storeOrder(StoreOrderRequestRequest $request, CustomerUpsertService $customers): RedirectResponse
    {
        $validated = $request->validated();
        $customer = $customers->upsert([
            'name' => $validated['customer_name'],
            'email' => $validated['customer_email'] ?? null,
            'phone' => $validated['customer_phone'] ?? null,
            'customer_group' => $validated['customer_group'],
        ]);

        OrderRequest::query()->create($validated + ['customer_id' => $customer->id]);

        return back()->with('status', 'Yêu cầu mua đã được ghi nhận. Tư vấn viên sẽ liên hệ sớm.');
    }

    public function storeQuote(StoreQuoteRequestRequest $request, CustomerUpsertService $customers): RedirectResponse
    {
        $validated = $request->validated();
        $customer = $customers->upsert([
            'name' => $validated['customer_name'],
            'email' => $validated['customer_email'] ?? null,
            'phone' => $validated['customer_phone'] ?? null,
            'customer_group' => $validated['customer_group'],
        ]);

        QuoteRequest::query()->create($validated + ['customer_id' => $customer->id]);

        return back()->with('status', 'Yêu cầu báo giá đã được gửi thành công.');
    }

    public function storeGraduationRequest(StoreGraduationProjectRequestRequest $request, CustomerUpsertService $customers): RedirectResponse
    {
        $validated = $request->validated();
        $customer = $customers->upsert([
            'name' => $validated['student_name'],
            'email' => $validated['student_email'] ?? null,
            'phone' => $validated['student_phone'] ?? null,
            'customer_group' => 'student',
        ]);

        GraduationProjectRequest::query()->create($validated + [
            'customer_id' => $customer->id,
            'need_report' => $request->boolean('need_report'),
            'need_database' => $request->boolean('need_database'),
            'need_installation_guide' => $request->boolean('need_installation_guide'),
        ]);

        return back()->with('status', 'Yêu cầu đồ án đã được gửi. Đội ngũ sẽ phản hồi lộ trình triển khai.');
    }

    public function storeContact(StoreContactMessageRequest $request): RedirectResponse
    {
        ContactMessage::query()->create($request->validated());

        return back()->with('status', 'Tin nhắn đã được gửi. Cảm ơn bạn đã liên hệ.');
    }

    public function sitemap(): Response
    {
        $urls = collect([
            url('/'),
            route('services'),
            route('templates.index'),
            route('source-code.index'),
            route('blog.index'),
            route('pricing.show', 'shop'),
            route('pricing.show', 'landing-page'),
            route('pricing.show', 'graduation-project'),
        ])
            ->merge(WebsiteTemplate::query()->where('status', 'active')->pluck('slug')->map(fn ($slug) => route('templates.show', $slug)))
            ->merge(BlogPost::query()->where('status', 'published')->pluck('slug')->map(fn ($slug) => route('blog.show', $slug)))
            ->map(fn ($url) => '<url><loc>'.e($url).'</loc></url>')
            ->implode('');

        return response('<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'.$urls.'</urlset>', 200)
            ->header('Content-Type', 'application/xml');
    }

    public function robots(): Response
    {
        return response("User-agent: *\nAllow: /\nSitemap: ".url('/sitemap.xml')."\n", 200)
            ->header('Content-Type', 'text/plain');
    }
}
