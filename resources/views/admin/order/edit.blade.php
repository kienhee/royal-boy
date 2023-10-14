@php
    $moduleName = 'bộ sưu tập';
@endphp
@extends('layouts.admin.index')
@section('title', 'Cập nhật ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.product.index"
        childrenName="Cập nhật {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Cập nhật {{ $moduleName }}" link="dashboard.product.index"
                    linkName="Danh sách {{ $moduleName }}" />
                <!-- Account -->
                <div class="card-body">
                    <form action="{{ route('dashboard.product.update', $product->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="mb-3 col-md-12">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="isNew" id="isNew"
                                        @if ($product->isNew == 1) checked @endif>
                                    <label class="form-check-label" for="isNew">Sản phẩm mới?</label>
                                </div>
                            </div>

                            <div class="mb-3 col-md-12">
                                <div class="upload__box">
                                    <label id="lfm" data-input="thumbnail" data-preview="holder"
                                        class="form-label upload-label mb-3">
                                        <p class="mb-0">Thêm hình
                                            ảnh <span class="text-danger">*</span></p>
                                        <small>(Nên chọn hình tỉ lệ 1:1)</small>
                                    </label>

                                    <input id="thumbnail" class="form-control" type="text" name="images"
                                        value="{{ $product->images }}" hidden multiple>
                                    <div id="holder" class="d-flex justify-content-center gap-3 flex-wrap">
                                        @if ($product->images)
                                            @foreach (explode(',', $product->images) as $item)
                                                <img src="{{ $item }}" class="preview-img">
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                @error('images')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="name" class="form-label">Tên sản phẩm: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror " type="text"
                                    oninput="createSlug('name','slug')" id="name" name="name"
                                    value="{{ $product->name ?? old('name') }}" placeholder="Tên sản phẩm" autofocus />
                                @error('name')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="slug" class="form-label">Đường dẫn URL: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('slug') is-invalid @enderror" type="text"
                                    id="slug" name="slug" value="{{ $product->slug ?? old('slug') }}"
                                    placeholder="Ten-san-pham" />
                                @error('slug')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">Mô tả ngắn: <span
                                        class="text-danger">*</span></label>

                                <textarea class="form-control @error('description') is-invalid @enderror " id="description" rows="3"
                                    name="description" placeholder="Mô tả ngắn về sản phẩm">{{ $product->description ?? old('description') }}</textarea>
                                @error('description')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 mb-3">
                                <label for="content-product" class="form-label">Thông tin sản phẩm : <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror " id="content-product" rows="3"
                                    name="content" placeholder="Mô tả chi tiết: Thông tin xuất xứ, chất liệu, ..v.v">{{ $product->content ?? old('content') }}</textarea>
                                @error('content')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="product_code" class="form-label">Mã sản phẩm: </label>
                                <input class="form-control @error('product_code') is-invalid @enderror " type="text"
                                    id="product_code" name="product_code"
                                    value="{{ $product->product_code ?? old('product_code') }}"
                                    placeholder="Mã sản phẩm" />
                                @error('product_code')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="product_sku" class="form-label">Mã SKU:</label>
                                <input class="form-control @error('product_sku') is-invalid @enderror " type="text"
                                    id="product_sku" name="product_sku"
                                    value="{{ $product->product_sku ?? old('product_sku') }}" placeholder="Mã SKU" />
                                @error('product_sku')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="quantity" class="form-label">Số lượng: <span
                                        class="text-danger">*</span></label>
                                <input class="form-control @error('quantity') is-invalid @enderror " type="text"
                                    id="quantity" name="quantity" value="{{ $product->quantity ?? old('quantity') }}"
                                    placeholder="Số lượng" />
                                @error('quantity')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="category_id" class="form-label">bộ sưu tập: <span
                                        class="text-danger">*</span></label>
                                <select class="form-select @error('category_id') is-invalid @enderror" name="category_id"
                                    id="category_id">
                                    <option value="">Vui lòng lựa chọn</option>
                                    @if (getAllCategories()->count() > 0)
                                        @foreach (menuSelect(getAllCategories()) as $category)
                                            <option
                                                {{ $product->category_id == $category->id || old('category_id') == $category->id ? 'selected' : '' }}
                                                value="{{ $category->id }}"
                                                @if ($category->category_id == 0) @disabled(true) @endif>
                                                {{ str_repeat('|---', $category->level) }}
                                                {{ $category->name }} </option>
                                        @endforeach
                                    @endif

                                </select>

                                @error('category_id')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="select-multiple" class="form-label">Màu sắc: <span
                                        class="text-danger">*</span></label>
                                <select id="select-multiple" class="@error('colors') is-invalid @enderror" multiple
                                    name="colors" placeholder="Chọn màu sắc" data-search="true"
                                    data-silent-initial-value-set="true">
                                    @foreach (getAllColors() as $color)
                                        <option
                                            {{ strpos($product->colors ?? old('colors'), $color->name . '-' . $color->code) !== false ? 'selected' : '' }}
                                            value="{{ $color->name }}-{{ $color->code }}">{{ $color->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('colors')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="select-multiple" class="form-label">Kích thước: <span
                                        class="text-danger">*</span></label>
                                <select id="select-multiple" class="@error('sizes') is-invalid @enderror" multiple
                                    name="sizes" placeholder="Chọn Kích thước" data-search="true"
                                    data-silent-initial-value-set="true">
                                    @foreach (getAllSizes() as $size)
                                        <option
                                            {{ strpos($product->sizes ?? old('sizes'), $size->name) !== false ? 'selected' : '' }}
                                            value="{{ $size->name }}">{{ $size->name }}
                                        </option>
                                    @endforeach

                                </select>
                                @error('sizes')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-12">
                                <label for="select-multiple" class="form-label">Giới tính: <span
                                        class="text-danger">*</span></label>
                                <select id="select-multiple" class="@error('genders') is-invalid @enderror" multiple
                                    name="genders" placeholder="Chọn giới tính" data-search="false"
                                    data-silent-initial-value-set="true">
                                    <option
                                        {{ strpos($product->genders ?? old('genders'), 'nam') !== false ? 'selected' : '' }}
                                        value="nam">Nam
                                    </option>
                                    <option
                                        {{ strpos($product->genders ?? old('genders'), 'nu') !== false ? 'selected' : '' }}
                                        value="nu">Nữ
                                    </option>
                                    <option
                                        {{ strpos($product->genders ?? old('genders'), 'unisex') !== false ? 'selected' : '' }}
                                        value="unisex">Unisex
                                    </option>


                                </select>
                                @error('genders')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label for="regular_price" class="form-label">Giá thường ("Giá bán công khai"): <span
                                        class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">$</span>
                                    <input type="text" name="regular_price"
                                        value="{{ $product->regular_price ?? old('regular_price') }}"
                                        class="form-control" placeholder="0.000">
                                    <span class="input-group-text">VND</span>
                                </div>
                                @error('regular_price')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="sale" class="form-label">Sale (%):</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">%</span>
                                    <input type="text" name="sale" class="form-control"
                                        value="{{ $product->sale ?? old('sale') }}" placeholder="0.000">
                                </div>
                                @error('sale')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="form-check form-switch mb-3 ms-3 col-md-6">
                                <input class="form-check-input" type="checkbox" name="is_Price_includes_taxes"
                                    id="is_Price_includes_taxes">
                                <label class="form-check-label" for="is_Price_includes_taxes">Giá đã bao gồm thuế</label>
                            </div>
                            <div class="mb-3 col-md-12 " id="tax">
                                <label for="tax" class="form-label">Thuế (%):</label>
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">%</span>
                                    <input type="text" name="tax" class="form-control"
                                        value="{{ $product->tax ?? old('tax') }}" placeholder="0.00">
                                </div>
                                @error('tax')
                                    <p class="text-danger my-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary me-2">Cập nhật {{ $moduleName }}</button>
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
