@extends('layouts.app')
@section('title', 'Admin khách hàng')
@section('content')
<h1 class="mb-6 text-2xl font-semibold">Khách hàng</h1>
<x-admin.marketplace.table :items="$customers" :columns="['name' => 'Tên', 'email' => 'Email', 'phone' => 'Phone', 'customer_group' => 'Nhóm', 'order_requests_count' => 'Đơn']" />
@endsection
