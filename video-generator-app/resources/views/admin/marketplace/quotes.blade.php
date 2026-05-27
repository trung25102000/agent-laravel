@extends('layouts.app')
@section('title', 'Admin lead báo giá')
@section('content')
<h1 class="mb-6 text-2xl font-semibold">Lead/yêu cầu báo giá</h1>
<x-admin.marketplace.table :items="$quotes" :columns="['customer_name' => 'Tên', 'customer_phone' => 'Phone', 'service_type' => 'Dịch vụ', 'budget_range' => 'Ngân sách', 'status' => 'Trạng thái']" />
@endsection
