@php
    $moduleName = 'màu sắc';
@endphp
@extends('layouts.admin.index')
@section('title', 'Tạo mới ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.color.index"
        childrenName="Tạo mới {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Tạo mới {{ $moduleName }}" link="dashboard.color.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <!-- Account -->
                <div class="card-body">
                    <form action="{{ route('dashboard.color.store') }}" method="POST">
                        @csrf
                        <div class="row ">
                            <div class="mb-3 col-md-9">
                                <label for="name" class="form-label">Tên màu: <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    id="name" name="name" value="{{ old('name') }}"
                                    placeholder="VD: Xanh da trời, Vàng da bò, Đỏ son ...v.v" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-3">
                                <label for="code" class="form-label">Mã màu (#HEX): <span
                                        class="text-danger">*</span></label>
                                <input class="form-control  coloris @error('code') is-invalid @enderror " type="text"
                                    id="code" name="code" value="{{ old('code') }}" placeholder="Tên màu mới"
                                    autofocus />
                                @error('code')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror

                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Tạo mới {{ $moduleName }}</button>
                            <button type="reset" class="btn btn-outline-secondary">Đặt lại</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
