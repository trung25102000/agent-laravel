@extends('layouts.app')
@section('title', 'Admin demo project')
@section('content')
<h1 class="mb-6 text-2xl font-semibold">Demo project</h1>
<x-admin.marketplace.table :items="$demos" :columns="['name' => 'Tên', 'demo_url' => 'Demo URL', 'is_active' => 'Active']" />
@endsection
