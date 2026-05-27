@extends('layouts.app')

@section('content')
    <h1>Sign in</h1>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <label>
            Email
            <input name="email" type="email" value="{{ old('email') }}" required autofocus>
        </label>
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Password
            <input name="password" type="password" required>
        </label>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label>
            <input name="remember" type="checkbox" value="1">
            Remember me
        </label>

        <button type="submit">Login</button>
    </form>
@endsection
