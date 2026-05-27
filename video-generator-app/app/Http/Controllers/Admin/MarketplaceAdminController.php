<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\ContactMessage;
use App\Models\Customer;
use App\Models\DemoProject;
use App\Models\FaqItem;
use App\Models\GraduationProjectRequest;
use App\Models\OrderRequest;
use App\Models\PricingPackage;
use App\Models\QuoteRequest;
use App\Models\SourceCodeProduct;
use App\Models\TemplateCategory;
use App\Models\User;
use App\Models\VideoProject;
use App\Models\WebsiteTemplate;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class MarketplaceAdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $status = $request->string('status')->toString();

        return view('admin.marketplace.dashboard', [
            'stats' => [
                'templates' => WebsiteTemplate::query()->count(),
                'orders' => OrderRequest::query()->count(),
                'quotes' => QuoteRequest::query()->count(),
                'graduationRequests' => GraduationProjectRequest::query()->count(),
                'contacts' => ContactMessage::query()->count(),
            ],
            'orders' => OrderRequest::query()->latest()->limit(8)->get(),
            'quotes' => QuoteRequest::query()->latest()->limit(8)->get(),
            'users' => User::query()->latest()->limit(10)->get(),
            'projects' => VideoProject::query()
                ->with('user')
                ->when($status, fn ($query) => $query->where('status', $status))
                ->latest()
                ->limit(20)
                ->get(),
            'selectedStatus' => $status,
        ]);
    }

    public function categories(): View
    {
        return view('admin.marketplace.categories', [
            'categories' => TemplateCategory::query()->orderBy('sort_order')->paginate(20),
        ]);
    }

    public function storeCategory(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'description' => ['nullable', 'string', 'max:2000'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        TemplateCategory::query()->create($data + [
            'slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(5)),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return back()->with('status', 'Đã tạo danh mục template.');
    }

    public function templates(): View
    {
        return view('admin.marketplace.templates', [
            'templates' => WebsiteTemplate::query()->with('category')->latest()->paginate(20),
            'categories' => TemplateCategory::query()->where('is_active', true)->orderBy('sort_order')->get(),
        ]);
    }

    public function storeTemplate(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'template_category_id' => ['nullable', 'exists:template_categories,id'],
            'name' => ['required', 'string', 'max:160'],
            'audience_type' => ['required', Rule::in(['shop_owner', 'online_seller', 'student'])],
            'template_type' => ['required', 'string', 'max:80'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:8000'],
            'price' => ['nullable', 'integer', 'min:0'],
            'preview_image_path' => ['nullable', 'string', 'max:255'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        WebsiteTemplate::query()->create($data + ['slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(5))]);

        return back()->with('status', 'Đã tạo template.');
    }

    public function packages(): View
    {
        return view('admin.marketplace.packages', [
            'packages' => PricingPackage::query()->orderBy('audience_type')->orderBy('sort_order')->paginate(30),
        ]);
    }

    public function storePackage(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'audience_type' => ['required', Rule::in(['shop_owner', 'online_seller', 'student'])],
            'package_type' => ['required', 'string', 'max:80'],
            'price' => ['nullable', 'integer', 'min:0'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'benefits' => ['nullable', 'string', 'max:3000'],
            'is_featured' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        PricingPackage::query()->create(array_merge($data, [
            'slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(5)),
            'benefits' => collect(explode("\n", $data['benefits'] ?? ''))->map(fn ($line) => trim($line))->filter()->values()->all(),
            'is_featured' => $request->boolean('is_featured'),
            'is_active' => $request->boolean('is_active', true),
        ]));

        return back()->with('status', 'Đã tạo gói dịch vụ.');
    }

    public function orders(Request $request): View
    {
        $status = $request->string('status')->toString();

        return view('admin.marketplace.orders', [
            'orders' => OrderRequest::query()->with(['customer', 'websiteTemplate'])
                ->when($status, fn ($query) => $query->where('status', $status))
                ->latest()
                ->paginate(20)
                ->withQueryString(),
            'status' => $status,
        ]);
    }

    public function updateOrder(Request $request, OrderRequest $orderRequest): RedirectResponse
    {
        $data = $request->validate([
            'status' => ['required', Rule::in(['new', 'contacted', 'in_progress', 'completed', 'cancelled'])],
            'internal_note' => ['nullable', 'string', 'max:3000'],
        ]);

        $orderRequest->update($data);

        return back()->with('status', 'Đã cập nhật đơn hàng.');
    }

    public function customers(): View
    {
        return view('admin.marketplace.customers', [
            'customers' => Customer::query()->withCount(['orderRequests', 'quoteRequests', 'graduationProjectRequests'])->latest()->paginate(30),
        ]);
    }

    public function contacts(): View
    {
        return view('admin.marketplace.contacts', [
            'messages' => ContactMessage::query()->latest()->paginate(30),
        ]);
    }

    public function quotes(): View
    {
        return view('admin.marketplace.quotes', [
            'quotes' => QuoteRequest::query()->with('customer')->latest()->paginate(30),
        ]);
    }

    public function graduationRequests(): View
    {
        return view('admin.marketplace.graduation-requests', [
            'requests' => GraduationProjectRequest::query()->with('customer')->latest()->paginate(30),
        ]);
    }

    public function blogPosts(): View
    {
        return view('admin.marketplace.blog-posts', [
            'posts' => BlogPost::query()->latest()->paginate(30),
        ]);
    }

    public function storeBlogPost(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'audience_type' => ['nullable', Rule::in(['shop_owner', 'online_seller', 'student'])],
            'excerpt' => ['nullable', 'string', 'max:1000'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'published'])],
        ]);

        BlogPost::query()->create($data + [
            'slug' => Str::slug($data['title']).'-'.Str::lower(Str::random(5)),
            'published_at' => $data['status'] === 'published' ? now() : null,
        ]);

        return back()->with('status', 'Đã tạo bài SEO.');
    }

    public function sourceCodeProducts(): View
    {
        return view('admin.marketplace.source-code-products', [
            'products' => SourceCodeProduct::query()->withCount(['demoProjects', 'attachments'])->latest()->paginate(30),
        ]);
    }

    public function storeSourceCodeProduct(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:160'],
            'framework' => ['required', 'string', 'max:80'],
            'summary' => ['nullable', 'string', 'max:1000'],
            'description' => ['nullable', 'string', 'max:8000'],
            'price' => ['nullable', 'integer', 'min:0'],
            'demo_url' => ['nullable', 'url'],
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);

        SourceCodeProduct::query()->create($data + [
            'slug' => Str::slug($data['name']).'-'.Str::lower(Str::random(5)),
            'audience_type' => 'student',
        ]);

        return back()->with('status', 'Đã tạo source code Laravel.');
    }

    public function demoProjects(): View
    {
        return view('admin.marketplace.demo-projects', [
            'demos' => DemoProject::query()->latest()->paginate(30),
        ]);
    }

    public function faqs(): View
    {
        return view('admin.marketplace.faqs', [
            'faqs' => FaqItem::query()->orderBy('audience_type')->orderBy('sort_order')->paginate(30),
        ]);
    }
}
