@extends('layouts.app')

@section('content')
    <h1>{{ $videoProject->keyword }}</h1>
    <p>Status: {{ $videoProject->status->value }}</p>
@endsection
