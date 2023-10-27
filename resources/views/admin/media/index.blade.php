@php
    $moduleName = 'nhóm người dùng';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)
@section('content')
    <iframe src="/laravel-filemanager?type=image" style="width: 100%; height: 100%; overflow: hidden; border: none;"></iframe>
@endsection
