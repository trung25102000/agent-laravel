<?php

namespace App\Http\Controllers;

use App\Models\VideoProject;
use App\Services\VideoProjectStatusService;
use Illuminate\Http\JsonResponse;

class VideoProjectStatusController extends Controller
{
    public function __invoke(VideoProject $videoProject, VideoProjectStatusService $statusService): JsonResponse
    {
        return response()->json($statusService->payload($videoProject));
    }
}
