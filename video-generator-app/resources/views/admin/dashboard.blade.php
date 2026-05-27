@extends('layouts.app')

@section('content')
    <h1>Admin dashboard</h1>

    <section>
        <h2>Users</h2>
        <ul>
            @foreach ($users as $user)
                <li>{{ $user->name }} - {{ $user->email }}</li>
            @endforeach
        </ul>
    </section>

    <section>
        <h2>Video projects</h2>

        <form method="GET" action="{{ route('admin.dashboard') }}">
            <label>
                Status
                <select name="status">
                    <option value="">All</option>
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" @selected($selectedStatus === $status->value)>
                            {{ $status->value }}
                        </option>
                    @endforeach
                </select>
            </label>
            <button type="submit">Filter</button>
        </form>

        <ul>
            @foreach ($projects as $project)
                <li>{{ $project->keyword }} - {{ $project->status->value }} - {{ $project->user->email }}</li>
            @endforeach
        </ul>

        {{ $projects->links() }}
    </section>
@endsection
