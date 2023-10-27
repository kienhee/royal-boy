@php
    $moduleName = 'danh mục';
@endphp
@extends('layouts.admin.index')
@section('title', 'Cập nhật ' . $moduleName)
@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.category.index"
        childrenName="Cập nhật {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Cập nhật {{ $moduleName }}" link="dashboard.category.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <div class="card-body">
                    <form id="formAccountSettings" action="{{ route('dashboard.category.update', $category->id) }}"
                        method="POST">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Tên danh mục: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    oninput="createSlug('name','slug')" id="name" name="name"
                                    value="{{ $category->name ?? old('name') }}" placeholder="Tên danh mục" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Đường dẫn URL: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                    id="slug" name="slug" value="{{ $category->slug ?? old('slug') }}"
                                    placeholder="Ten-danh-muc" />
                                @error('slug')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">Thuộc danh mục: <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                    id="category_id">
                                    <option value="">Vui lòng lựa chọn</option>
                                    <option value="0"
                                        {{ $category->category_id == 0 || old('category_id') == 0 ? 'selected' : '' }}>Danh
                                        mục gốc</option>

                                    @if (getAllCategories()->count() > 0)
                                        @foreach (menuSelect(getAllCategories()) as $item)
                                            <option @if ($category->category_id == $item->id || old('category_id') == $item->id) @selected(true) @endif
                                                @if ($item->level != 0) @disabled(true) @endif
                                                value="{{ $item->id }}">
                                                {{ str_repeat('|--', $item->level) }}
                                                {{ $item->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('category_id')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Mô tả:</label>

                                <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="1"
                                    name="description" placeholder="Mô tả danh mục">{{ $category->description ?? old('description') }}</textarea>
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
            </div>
        </div>
    </div>
@endsection
