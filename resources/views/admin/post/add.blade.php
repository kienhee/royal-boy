@php
    $moduleName = 'bài viết';
@endphp
@extends('layouts.admin.index')
@section('title', 'Tạo mới ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.post.index"
        childrenName="Tạo mới {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Tạo mới {{ $moduleName }}" link="dashboard.post.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <!-- Account -->
                <div class="card-body">
                    <form action="{{ route('dashboard.post.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <div class="mb-3 col-md-12">

                                <div class="upload__box d-flex justify-content-center flex-column align-items-center gap-3">
                                    <img id="img_preview" class="img-fluid object-fit-contain"
                                        src="{{ asset('images/pngtree-image-upload-icon-photo.png') }}" alt="your image" />
                                    <label for="imgInp" data-preview="holder" class="form-label upload-label mb-3">
                                        <p class="mb-0">Thêm ảnh bìa <span class="text-danger">*</span></p>
                                        <small>(Nên chọn hình tỉ lệ 1:1)</small>
                                    </label>

                                    <input id="imgInp" accept="image/*" type="file" name="cover" hidden>

                                </div>

                                @error('cover')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Tiêu đề: <span class="text-danger">*</span></label>
                                <input class="form-control @error('title') is-invalid @enderror " type="text"
                                    oninput="createSlug('title','slug')" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="Tiêu đề" autofocus />
                                @error('title')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Đường dẫn URL: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                    id="slug" name="slug" value="{{ old('slug') }}" placeholder="duong-dan-url" />
                                @error('slug')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Mô tả ngắn: <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="3"
                                    name="description" placeholder="Mô tả ngắn về về bài viết">{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="content-product" class="form-label">Nội dung bài viết : <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror " id="content-product" rows="3"
                                    name="content">{{ old('content') }}</textarea>
                                @error('content')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-12">
                                <label for="select-multiple" class="form-label">Tags: <span
                                        class="text-danger">*</span></label>
                                <select id="select-multiple" class="@error('tags') is-invalid @enderror" multiple
                                    name="tags" placeholder="Chọn tags cho bài viết" data-search="true"
                                    data-silent-initial-value-set="true">
                                    @foreach (getAllTags() as $tag)
                                        <option {{ strpos(old('tags'), $tag->name) !== false ? 'selected' : '' }}
                                            value="{{ $tag->name }}">{{ $tag->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('tags')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
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

    <script>
        const checkbox = document.getElementById('is_Price_includes_taxes')
        const input_tax = document.getElementById('tax');
        checkbox.addEventListener('change', (event) => {
            if (event.currentTarget.checked) {
                input_tax.classList.add("d-none");
            } else {
                input_tax.classList.remove("d-none");

            }
        })
    </script>

@endsection
