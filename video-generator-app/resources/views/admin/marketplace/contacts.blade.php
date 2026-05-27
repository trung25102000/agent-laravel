@extends('layouts.app')
@section('title', 'Admin liên hệ')
@section('content')
<h1 class="mb-6 text-2xl font-semibold">Tin nhắn liên hệ</h1>
<x-admin.marketplace.table :items="$messages" :columns="['name' => 'Tên', 'phone' => 'Phone', 'channel' => 'Kênh', 'message' => 'Nội dung', 'status' => 'Trạng thái']" />
@endsection
