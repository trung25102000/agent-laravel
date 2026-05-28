<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AnimatedTrustVisualsTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_animated_trust_visuals_and_badges(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-trust-visual="hero-mockup"', false);
        $response->assertSee('data-reveal', false);
        $response->assertSee('Demo trước khi bàn giao');
        $response->assertSee('Có source + hướng dẫn cài đặt');
        $response->assertSee('Hỗ trợ chỉnh sửa sau bàn giao');
        $response->assertSee('Phù hợp chạy quảng cáo/Zalo/Facebook');
    }

    public function test_public_ui_keeps_project_branding_without_default_laravel_copy(): void
    {
        $this->withoutVite();

        foreach (['/', '/services', '/templates'] as $path) {
            $response = $this->get($path);

            $response->assertOk();
            $response->assertSee('Web Template Studio');
            $response->assertDontSee('Laravel News');
            $response->assertDontSee('Laracasts');
            $response->assertDontSee('Documentation');
            $response->assertDontSee('AI Video Generator');
        }
    }

    public function test_frontend_assets_include_scroll_reveal_and_reduced_motion_support(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));
        $js = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString('prefers-reduced-motion', $css);
        $this->assertStringContainsString('[data-reveal]', $css);
        $this->assertStringContainsString('IntersectionObserver', $js);
        $this->assertStringContainsString('is-visible', $js);
    }
}
