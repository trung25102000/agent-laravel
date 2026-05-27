@extends('layouts.app')
@section('title', 'Admin yêu cầu đồ án')
@section('content')
<h1 class="mb-6 text-2xl font-semibold">Yêu cầu đồ án tốt nghiệp</h1>
<x-admin.marketplace.table :items="$requests" :columns="['student_name' => 'Sinh viên', 'student_phone' => 'Phone', 'school' => 'Trường', 'topic' => 'Đề tài', 'status' => 'Trạng thái']" />
@endsection
