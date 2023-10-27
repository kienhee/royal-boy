@php
    $moduleName = 'slider';
@endphp
@extends('layouts.admin.index')
@section('title', 'Tạo mới ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.slider.index"
        childrenName="Tạo mới {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Tạo mới {{ $moduleName }}" link="dashboard.slider.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <!-- Account -->
                <div class="card-body">
                    <form id="formAccountSettings" action="{{ route('dashboard.slider.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-12">

                                <div class="upload__box d-flex justify-content-center flex-column align-items-center gap-3">
                                    <img id="img_preview" class="img-fluid object-fit-contain"
                                        src="{{ asset('images/pngtree-image-upload-icon-photo.png') }}"
                                        alt="Upload hình ảnh" />
                                    <label for="imgInp" data-preview="holder" class="form-label upload-label mb-3">
                                        <p class="mb-0"> Ảnh dành cho silder <span class="text-danger">*</span></p>
                                        <small>(Nên chọn hình chủ thể chiếm 50%)</small>
                                    </label>

                                    <input id="imgInp" accept="image/*" type="file" name="image" hidden>

                                </div>

                                @error('image')
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
