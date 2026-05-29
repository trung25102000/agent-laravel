<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProblemStoryCarouselTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_problem_grid_and_solution_mapping(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('data-problem-grid', false);
        $response->assertSee('data-problem-card', false);
        $response->assertSee('data-solution-card', false);

        $this->assertGreaterThanOrEqual(6, substr_count($response->getContent(), 'data-problem-card'));
        $this->assertGreaterThanOrEqual(6, substr_count($response->getContent(), 'data-solution-card'));
    }

    public function test_problem_and_solution_sections_contain_core_pain_points(): void
    {
        $this->withoutVite();

        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Không biết làm website ở đâu');
        $response->assertSee('Website tải chậm');
        $response->assertSee('Website không có khách');
        $response->assertSee('Landing Page không chuyển đổi');
        $response->assertSee('Đồ án sắp tới hạn');
        $response->assertSee('Không đủ người xử lý task');
        $response->assertSee('Mỗi pain point đều có hướng xử lý rõ');
        $response->assertSee('Task code gấp');
    }

    public function test_frontend_assets_include_problem_solution_motion_classes(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));
        $js = file_get_contents(resource_path('js/app.js'));

        $this->assertStringContainsString('IntersectionObserver', $js);
        $this->assertStringContainsString('.problem-card:hover', $css);
        $this->assertStringContainsString('.solution-card:hover', $css);
        $this->assertStringContainsString('prefers-reduced-motion', $css);
    }
}
