@extends('layouts.app')

@section('content')
    <h1>Preview: {{ $videoProject->keyword }}</h1>

    @if ($videoProject->rendered_video_path)
        <p>Your rendered video is ready.</p>
        <p>
            <a href="{{ route('video-projects.download', $videoProject) }}">Download video</a>
        </p>
    @else
        <p>This video has not been rendered yet.</p>
    @endif
@endsection
