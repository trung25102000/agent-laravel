<?php

return [
    'queue' => env('VIDEO_PIPELINE_QUEUE', 'video'),
    'retry_after' => (int) env('VIDEO_PIPELINE_RETRY_AFTER', 1200),

    'providers' => [
        'script' => env('AI_SCRIPT_PROVIDER', 'mock'),
        'image' => env('AI_IMAGE_PROVIDER', 'mock'),
        'tts' => env('TTS_PROVIDER', 'mock'),
    ],

    'storage' => [
        'disk' => env('VIDEO_STORAGE_DISK', env('FILESYSTEM_DISK', 'local')),
        'output_disk' => env('VIDEO_OUTPUT_DISK', env('VIDEO_STORAGE_DISK', env('FILESYSTEM_DISK', 'local'))),
        'directories' => [
            'videos' => 'videos',
            'audio' => 'audio',
            'subtitles' => 'subtitles',
            'assets' => 'assets',
            'previews' => 'previews',
        ],
    ],

    'render' => [
        'ffmpeg_binary' => env('FFMPEG_BINARY', 'ffmpeg'),
        'ffprobe_binary' => env('FFPROBE_BINARY', 'ffprobe'),
        'timeout' => (int) env('VIDEO_RENDER_TIMEOUT', 1200),
        'width' => (int) env('VIDEO_DEFAULT_WIDTH', 1080),
        'height' => (int) env('VIDEO_DEFAULT_HEIGHT', 1920),
        'fps' => (int) env('VIDEO_DEFAULT_FPS', 30),
        'aspect_ratio' => env('VIDEO_DEFAULT_ASPECT_RATIO', '9:16'),
        'default_duration' => (int) env('VIDEO_DEFAULT_DURATION', 30),
    ],
];
