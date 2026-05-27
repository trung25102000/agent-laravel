@extends('layouts.app')

@section('content')
    <h1>Create your account</h1>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <label>
            Name
            <input name="name" value="{{ old('name') }}" required autofocus>
        </label>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label>
            Email
            <input name="email" type="email" value="{{ old('email') }}" required>
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
            Confirm password
            <input name="password_confirmation" type="password" required>
        </label>

        <button type="submit">Register</button>
    </form>
@endsection
