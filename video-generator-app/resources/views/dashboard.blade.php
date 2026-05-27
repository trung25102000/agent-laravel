@extends('layouts.app')

@section('content')
    <h1>Dashboard</h1>
    <p>Welcome, {{ $user->name }}.</p>

    <section aria-labelledby="video-projects-heading">
        <h2 id="video-projects-heading">Your video projects</h2>

        <p>
            <a href="{{ route('video-projects.create') }}">Create a new video</a>
        </p>

        @if ($videoProjects->isEmpty())
            <p>You have not created any video projects yet.</p>
        @else
            <ul>
                @foreach ($videoProjects as $videoProject)
                    <li>
                        <a href="{{ route('video-projects.show', $videoProject) }}">
                            {{ $videoProject->keyword }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </section>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
