<?php

namespace App\Http\Controllers;

use App\Models\VideoProject;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoProjectPreviewController extends Controller
{
    public function show(VideoProject $videoProject): View
    {
        return view('video-projects.preview', [
            'videoProject' => $videoProject,
        ]);
    }

    public function download(VideoProject $videoProject): StreamedResponse|Response
    {
        if (! $videoProject->rendered_video_path) {
            abort(404);
        }

        $disk = config('video_pipeline.storage.output_disk');

        if (! Storage::disk($disk)->exists($videoProject->rendered_video_path)) {
            abort(404);
        }

        return Storage::disk($disk)->download(
            $videoProject->rendered_video_path,
            "video-project-{$videoProject->id}.mp4"
        );
    }
}
