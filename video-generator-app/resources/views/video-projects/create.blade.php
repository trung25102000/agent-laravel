@extends('layouts.app')

@section('content')
    <h1>Create video project</h1>

    <form method="POST" action="{{ route('video-projects.store') }}">
        @csrf

        <label>
            Keyword
            <input name="keyword" value="{{ old('keyword') }}" required>
        </label>
        @error('keyword')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Desired content
            <textarea name="content_brief" rows="5">{{ old('content_brief') }}</textarea>
        </label>
        @error('content_brief')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Tone
            <select name="tone" required>
                @foreach ($tones as $value => $label)
                    <option value="{{ $value }}" @selected(old('tone', 'neutral') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        @error('tone')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Duration
            <select name="duration_seconds" required>
                @foreach ($durations as $value => $label)
                    <option value="{{ $value }}" @selected((int) old('duration_seconds', 30) === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        @error('duration_seconds')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Platform
            <select name="platform" required>
                @foreach ($platforms as $value => $label)
                    <option value="{{ $value }}" @selected(old('platform', 'tiktok') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        @error('platform')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Language
            <select name="language" required>
                @foreach ($languages as $value => $label)
                    <option value="{{ $value }}" @selected(old('language', 'vi') === $value)>{{ $label }}</option>
                @endforeach
            </select>
        </label>
        @error('language')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Save draft</button>
    </form>
@endsection
