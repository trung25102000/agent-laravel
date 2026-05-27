<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\MarketplaceAdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\VideoProjectController;
use App\Http\Controllers\VideoProjectPreviewController;
use App\Http\Controllers\VideoProjectStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MarketplaceController::class, 'home'])->name('home');
Route::get('/services', [MarketplaceController::class, 'services'])->name('services');
Route::get('/templates', [MarketplaceController::class, 'templates'])->name('templates.index');
Route::get('/templates/{websiteTemplate:slug}', [MarketplaceController::class, 'templateDetail'])->name('templates.show');
Route::get('/pricing/{type}', [MarketplaceController::class, 'pricing'])->name('pricing.show');
Route::get('/source-code', [MarketplaceController::class, 'sourceCode'])->name('source-code.index');
Route::get('/source-code/{sourceCodeProduct:slug}', [MarketplaceController::class, 'sourceCodeDetail'])->name('source-code.show');
Route::get('/blog', [MarketplaceController::class, 'blog'])->name('blog.index');
Route::get('/blog/{blogPost:slug}', [MarketplaceController::class, 'blogDetail'])->name('blog.show');
Route::get('/sitemap.xml', [MarketplaceController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [MarketplaceController::class, 'robots'])->name('robots');

Route::middleware('throttle:10,1')->group(function (): void {
    Route::post('/orders', [MarketplaceController::class, 'storeOrder'])->name('orders.store');
    Route::post('/quote-requests', [MarketplaceController::class, 'storeQuote'])->name('quote-requests.store');
    Route::post('/graduation-project-requests', [MarketplaceController::class, 'storeGraduationRequest'])->name('graduation-project-requests.store');
    Route::post('/contact-messages', [MarketplaceController::class, 'storeContact'])->name('contact-messages.store');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});

Route::middleware('auth')->group(function (): void {
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/video-projects/create', [VideoProjectController::class, 'create'])->name('video-projects.create');
    Route::post('/video-projects', [VideoProjectController::class, 'store'])->name('video-projects.store');

    Route::get('/video-projects/{videoProject}', [VideoProjectController::class, 'show'])
        ->can('view', 'videoProject')
        ->name('video-projects.show');

    Route::get('/video-projects/{videoProject}/status', VideoProjectStatusController::class)
        ->can('view', 'videoProject')
        ->name('video-projects.status');

    Route::get('/video-projects/{videoProject}/preview', [VideoProjectPreviewController::class, 'show'])
        ->can('view', 'videoProject')
        ->name('video-projects.preview');

    Route::get('/video-projects/{videoProject}/stream', [VideoProjectPreviewController::class, 'stream'])
        ->can('view', 'videoProject')
        ->name('video-projects.stream');

    Route::get('/video-projects/{videoProject}/download', [VideoProjectPreviewController::class, 'download'])
        ->can('view', 'videoProject')
        ->name('video-projects.download');

    Route::get('/admin/video-projects', AdminDashboardController::class)
        ->can('access-admin')
        ->name('admin.video-projects');

    Route::get('/admin', [MarketplaceAdminController::class, 'dashboard'])
        ->can('access-admin')
        ->name('admin.dashboard');

    Route::prefix('/admin/marketplace')->name('admin.marketplace.')->middleware('can:access-admin')->group(function (): void {
        Route::get('/categories', [MarketplaceAdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [MarketplaceAdminController::class, 'storeCategory'])->name('categories.store');
        Route::get('/templates', [MarketplaceAdminController::class, 'templates'])->name('templates');
        Route::post('/templates', [MarketplaceAdminController::class, 'storeTemplate'])->name('templates.store');
        Route::get('/packages', [MarketplaceAdminController::class, 'packages'])->name('packages');
        Route::post('/packages', [MarketplaceAdminController::class, 'storePackage'])->name('packages.store');
        Route::get('/orders', [MarketplaceAdminController::class, 'orders'])->name('orders');
        Route::patch('/orders/{orderRequest}', [MarketplaceAdminController::class, 'updateOrder'])->name('orders.update');
        Route::get('/customers', [MarketplaceAdminController::class, 'customers'])->name('customers');
        Route::get('/contacts', [MarketplaceAdminController::class, 'contacts'])->name('contacts');
        Route::get('/quotes', [MarketplaceAdminController::class, 'quotes'])->name('quotes');
        Route::get('/graduation-requests', [MarketplaceAdminController::class, 'graduationRequests'])->name('graduation-requests');
        Route::get('/blog-posts', [MarketplaceAdminController::class, 'blogPosts'])->name('blog-posts');
        Route::post('/blog-posts', [MarketplaceAdminController::class, 'storeBlogPost'])->name('blog-posts.store');
        Route::get('/source-code-products', [MarketplaceAdminController::class, 'sourceCodeProducts'])->name('source-code-products');
        Route::post('/source-code-products', [MarketplaceAdminController::class, 'storeSourceCodeProduct'])->name('source-code-products.store');
        Route::get('/demo-projects', [MarketplaceAdminController::class, 'demoProjects'])->name('demo-projects');
        Route::get('/faqs', [MarketplaceAdminController::class, 'faqs'])->name('faqs');
    });
});
