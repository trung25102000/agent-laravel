<?php

namespace App\Http\Controllers;

use App\Enums\VideoProjectStatusEnum;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $projectsQuery = $request->user()->videoProjects();

        return view('dashboard', [
            'user' => $request->user(),
            'videoProjects' => (clone $projectsQuery)
                ->latest()
                ->limit(12)
                ->get(),
            'projectStats' => [
                'total' => (clone $projectsQuery)->count(),
                'completed' => (clone $projectsQuery)->where('status', VideoProjectStatusEnum::Completed)->count(),
                'rendering' => (clone $projectsQuery)->where('status', VideoProjectStatusEnum::Rendering)->count(),
                'failed' => (clone $projectsQuery)->where('status', VideoProjectStatusEnum::Failed)->count(),
            ],
        ]);
    }
}
