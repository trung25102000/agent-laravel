<?php

namespace App\Http\Controllers;

use App\Enums\VideoProjectStatusEnum;
use App\Http\Requests\StoreVideoProjectRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class VideoProjectController extends Controller
{
    public function create(): View
    {
        return view('video-projects.create', [
            'platforms' => StoreVideoProjectRequest::platformOptions(),
            'tones' => StoreVideoProjectRequest::toneOptions(),
            'languages' => StoreVideoProjectRequest::languageOptions(),
            'durations' => StoreVideoProjectRequest::durationOptions(),
        ]);
    }

    public function store(StoreVideoProjectRequest $request): RedirectResponse
    {
        $videoProject = $request->user()->videoProjects()->create([
            ...$request->validated(),
            'status' => VideoProjectStatusEnum::Draft,
            'progress_percent' => 0,
        ]);

        return redirect()->route('video-projects.show', $videoProject);
    }
}
