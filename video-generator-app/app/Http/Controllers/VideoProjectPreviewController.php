<?php

namespace App\Http\Controllers;

use App\Models\VideoProject;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;

class VideoProjectPreviewController extends Controller
{
    public function show(VideoProject $videoProject): View
    {
        $disk = $videoProject->outputDisk();
        $hasOutput = $videoProject->rendered_video_path !== null;
        $fileExists = $hasOutput && Storage::disk($disk)->exists($videoProject->rendered_video_path);
        $isPlayable = $fileExists && $videoProject->hasPlayableVideoOutput();

        return view('video-projects.preview', [
            'videoProject' => $videoProject->load('assets'),
            'previewState' => [
                'has_output' => $hasOutput,
                'file_exists' => $fileExists,
                'is_playable' => $isPlayable,
                'stream_url' => $isPlayable ? route('video-projects.stream', $videoProject) : null,
            ],
        ]);
    }

    public function stream(VideoProject $videoProject): BinaryFileResponse
    {
        if (! $videoProject->rendered_video_path || ! $videoProject->hasPlayableVideoOutput()) {
            abort(404);
        }

        $disk = $videoProject->outputDisk();

        if (! Storage::disk($disk)->exists($videoProject->rendered_video_path)) {
            abort(404);
        }

        return response()->file(Storage::disk($disk)->path($videoProject->rendered_video_path), [
            'Accept-Ranges' => 'bytes',
            'Content-Disposition' => 'inline; filename="video-project-'.$videoProject->id.'.mp4"',
            'Content-Type' => 'video/mp4',
        ]);
    }

    public function download(VideoProject $videoProject): StreamedResponse|Response
    {
        if (! $videoProject->rendered_video_path) {
            abort(404);
        }

        $disk = $videoProject->outputDisk();

        if (! Storage::disk($disk)->exists($videoProject->rendered_video_path)) {
            abort(404);
        }

        return Storage::disk($disk)->download(
            $videoProject->rendered_video_path,
            "video-project-{$videoProject->id}.mp4"
        );
    }
}
