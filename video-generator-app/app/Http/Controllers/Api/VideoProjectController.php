<?php

namespace App\Http\Controllers\Api;

use App\Enums\VideoProjectStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreVideoProjectRequest;
use App\Http\Resources\VideoProjectResource;
use App\Models\VideoProject;
use App\Services\VideoProjectStatusService;
use Illuminate\Http\JsonResponse;

class VideoProjectController extends Controller
{
    public function store(StoreVideoProjectRequest $request): JsonResponse
    {
        $videoProject = $request->user()->videoProjects()->create([
            ...$request->validated(),
            'status' => VideoProjectStatusEnum::Draft,
            'progress_percent' => 0,
        ]);

        return VideoProjectResource::make($videoProject)
            ->additional(['message' => 'Video project created.'])
            ->response()
            ->setStatusCode(201);
    }

    public function status(VideoProject $videoProject, VideoProjectStatusService $statusService): JsonResponse
    {
        return response()->json($statusService->payload($videoProject));
    }

    public function result(VideoProject $videoProject): JsonResponse|VideoProjectResource
    {
        if ($videoProject->status !== VideoProjectStatusEnum::Completed) {
            return response()->json([
                'message' => 'Video project is not completed yet.',
            ], 409);
        }

        return VideoProjectResource::make($videoProject);
    }
}
