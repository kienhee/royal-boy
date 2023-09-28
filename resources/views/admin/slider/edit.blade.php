@php
$moduleName = 'slider';
@endphp
@extends('layouts.admin.index')
@section('title', 'Cập nhật ' . $moduleName)

@section('content')
<x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.slider.index" childrenName="Cập nhật {{ $moduleName }}" />
<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <x-alert />
            <x-header-table tableName="Cập nhật {{ $moduleName }}" link="dashboard.slider.index" linkName="Danh sách {{ $moduleName }}" />
            <!-- Account -->
            <div class="card-body">
                <form id="formAccountSettings" action="{{ route('dashboard.slider.update',$slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <div class="upload__box d-flex justify-content-center flex-column align-items-center gap-3">
                                <img id="img_preview" class="img-fluid object-fit-contain" src="{{ $slider->image ?? asset('images/pngtree-image-upload-icon-photo.png') }}" alt="Upload hình ảnh" />
                                <label for="imgInp" data-preview="holder" class="form-label upload-label mb-3">
                                    <p class="mb-0"> Ảnh dành cho silder <span class="text-danger">*</span></p>
                                    <small>(Nên chọn hình chủ thể chiếm 50%)</small>
                                </label>

                                <input id="imgInp" accept="image/*" type="file" name="image" hidden>
                                <input type="text" name="image" value="{{$slider->image}}" hidden>

                            </div>

                            @error('image')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="title" class="form-label">Tiêu đề: <span class="text-danger">*</span></label>
                            <input class="form-control @error('title') is-invalid @enderror " type="text" oninput="createSlug('title','slug')" id="title" name="title" value="{{ old('title') ?? $slider->title }}" placeholder="VD: Fall - Winter Collections 2030" autofocus />
                            @error('title')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>


                        <div class="mb-3 col-md-6">
                            <label for="category_id" class="form-label">Thuộc bộ sưu tập: <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                                <option value="">Vui lòng lựa chọn</option>
                                <option value="0">bộ sưu tập gốc</option>
                                @if (getAllCategories()->count() > 0)
                                @foreach (menuSelect(getAllCategories()) as $category)
                                <option {{ $slider->category_id == $category->id || old('category_id') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ str_repeat('|--', $category->level) }}
                                    {{ $category->name }}</option>
                                @endforeach
                                @endif


                            </select>
                            @error('category_id')
                            <p class="text-danger my-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class=" mb-3 col-md-12">
                            <label for="description" class="form-label">Mô tả ngắn:<span class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="2" name="description" placeholder="Mô tả thông tin của bộ sưu tập hoặc slider">{{ old('description')?? $slider->description }}</textarea>
                            @error('description')
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