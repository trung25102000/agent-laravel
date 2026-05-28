<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProblemStoryCarouselTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_visual_problem_story_carousel(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-story-carousel', false);
        $response->assertSee('data-story-slide', false);
        $response->assertSee('data-story-control', false);
        $response->assertSee('role="region"', false);
        $response->assertSee('aria-label="Slideshow vấn đề và giải pháp cho khách hàng"', false);

        $this->assertGreaterThanOrEqual(4, substr_count($response->getContent(), 'data-story-slide'));
        $this->assertGreaterThanOrEqual(4, substr_count($response->getContent(), 'data-story-control'));
    }

    public function test_carousel_contains_core_problem_and_solution_stories(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Shop nhỏ chưa có website chuyên nghiệp');
        $response->assertSee('Landing page thiếu tin cậy');
        $response->assertSee('Phụ thuộc Facebook/Zalo');
        $response->assertSee('Source đồ án chưa đủ bộ');
        $response->assertSee('Tư vấn hướng xử lý');
        $response->assertSee('Khách hiểu vấn đề');
    }

    public function test_frontend_assets_include_story_carousel_behavior_and_motion_classes(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));
        $js = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString('[data-story-carousel]', $js);
        $this->assertStringContainsString('[data-story-slide]', $js);
        $this->assertStringContainsString('[data-story-control]', $js);
        $this->assertStringContainsString('setInterval', $js);
        $this->assertStringContainsString('mouseenter', $js);
        $this->assertStringContainsString('focusin', $js);
        $this->assertStringContainsString('.story-slide', $css);
        $this->assertStringContainsString('.story-control.is-active', $css);
        $this->assertStringContainsString('prefers-reduced-motion', $css);
    }
}
