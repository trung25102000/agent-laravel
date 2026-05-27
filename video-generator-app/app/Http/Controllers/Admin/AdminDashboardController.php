<?php

namespace App\Http\Controllers\Admin;

use App\Enums\VideoProjectStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VideoProject;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\Rule;

class AdminDashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $validated = $request->validate([
            'status' => ['nullable', 'string', Rule::enum(VideoProjectStatusEnum::class)],
        ]);

        $projects = VideoProject::query()
            ->with('user')
            ->when($validated['status'] ?? null, fn ($query, string $status) => $query->where('status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.dashboard', [
            'users' => User::query()->latest()->limit(20)->get(),
            'projects' => $projects,
            'statuses' => VideoProjectStatusEnum::cases(),
            'selectedStatus' => $validated['status'] ?? null,
        ]);
    }
}
