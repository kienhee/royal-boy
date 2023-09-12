@php
    $moduleName = 'kích thước';
@endphp
@extends('layouts.admin.index')
@section('title', 'Cập nhật ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.size.index"
        childrenName="Cập nhật {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Cập nhật {{ $moduleName }}" link="dashboard.size.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <!-- Account -->
                <div class="card-body">
                    <form action="{{ route('dashboard.size.update', $size->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="row ">
                            <div class="mb-3 col-md-12">
                                <label for="name" class="form-label">Tên kích thước: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    id="name" name="name" value="{{ $size->name ?? old('name') }}"
                                    placeholder="VD: Size L, M, XL, 1.5, 25 ...v.v" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Cập nhật {{ $moduleName }}</button>
                            <button type="reset" class="btn btn-outline-secondary">Đặt lại</button>
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
@endsection
