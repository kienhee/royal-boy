@php
$moduleName = 'bộ sưu tập';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)
@section('content')
<x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.category.index" childrenName="Danh sách {{ $moduleName }}" />

<div class="nav-align-top mb-4 mt-4">

    <ul class="nav nav-pills mb-3" role="tablist">
        <li class="nav-item">
            <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-home" aria-controls="navs-top-home" aria-selected="true">
                Danh sách bộ sưu tập
            </button>
        </li>
        <li class="nav-item">
            <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="false">
                Cây bộ sưu tập
            </button>
        </li>

    </ul>
    <div class="tab-content p-0">
        <div class="tab-pane fade active show" id="navs-top-home" role="tabpanel">
            <x-alert />
            <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.category.add" linkName="Tạo {{ $moduleName }}" />
            <form method="GET" class="mx-3 mb-4 mt-4">
                <div class="row ">
                    <div class="col-md-6 col-lg-3 mb-2">
                        <div class="input-group input-group-merge">
                            <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                            <input type="search" class="form-control" placeholder="Tên bộ sưu tập" name="keywords" value="{{ Request()->keywords }}">
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-2">
                        <select class="form-select" name="status">
                            <option value="">Trạng thái</option>
                            <option value="active" {{ Request()->status == 'active' ? 'selected' : '' }}>Hoạt động
                            </option>
                            <option value="inactive" {{ Request()->status == 'inactive' ? 'selected' : '' }}>Ngừng
                                hoạt
                                động
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-2">
                        <select class="form-select" name="sort">
                            <option value="">Bộ lọc</option>
                            <option value="desc" {{ Request()->sort == 'desc' ? 'selected' : '' }}>Mới nhất
                            </option>
                            <option value="asc" {{ Request()->sort == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                        </select>
                    </div>
                    <div class="col-md-6 col-lg-3 mb-2 text-md-end">
                        <a href="{{ route('dashboard.category.index') }}" class="btn btn-outline-secondary me-2">Đặt lại
                        </a>
                        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                    </div>

                </div>
            </form>

            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="px-1 text-center" style="width: 50px">#ID</th>
                            <th>Tên bộ sưu tập</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Cài đặt</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @if ($categories->count() > 0)

                        @foreach ($categories as $item)
                        <tr>
                            <td> <a href="{{ route('dashboard.category.edit', $item->id) }}" title="Click xem thêm" style="color:inherit"><strong>#{{ $item->id }}</strong>
                                </a>
                            </td>
                            <td><a href="{{ route('dashboard.category.edit', $item->id) }}" title="Click xem thêm" style="color: inherit"><strong>{{ $item->name }}</strong>
                                </a></td>


                            <td><span class="badge  me-1 {{ $item->deleted_at == null ? 'bg-label-success ' : ' bg-label-primary' }}">{{ $item->deleted_at == null ? 'Hoạt động' : 'Đang ẩn' }}</span>
                            </td>

                            <td>
                                <p class="m-0">{{ $item->created_at->format('d M Y') }}</p>
                                <small>{{ $item->created_at->format('h:i A') }}</small>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ route('dashboard.category.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                            Xem chi tiết</a>

                                        @if (Auth::user()->id != $item->id)
                                        @if ($item->trashed() == 1)
                                        <form class="dropdown-item" action="{{ route('dashboard.category.restore', $item->id) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <button class="btn p-0  w-100 text-start" type="submit">
                                                <i class='bx bx-revision'></i>
                                                Hiện bộ sưu tập
                                            </button>
                                        </form>
                                        @endif
                                        <form class="dropdown-item" action="{{ $item->trashed() ? route('dashboard.category.force-delete', $item->id) : route('dashboard.category.soft-delete', $item->id) }}" method="POST" @if ($item->trashed()) onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')" @endif>
                                            @csrf
                                            @method('delete')
                                            <button class="btn p-0  w-100 text-start" type="submit">
                                                <i class="bx {{ $item->trashed() ? 'bx-trash' : 'bx bxs-hand' }}  me-1"></i>
                                                {{ $item->trashed() ? 'Xóa vĩnh viễn' : 'Tạm ẩn bộ sưu tập' }}
                                            </button>
                                        </form>
                                        @endif

                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="8" class="text-center">Không có dữ liệu!</td>
                        </tr>

                        @endif


                    </tbody>
                </table>
            </div>
            <div class="mx-3 mt-3">
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>
        <div class="tab-pane fade" id="navs-top-profile" role="tabpanel">
            <x-alert />
            <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.category.add" linkName="Tạo {{ $moduleName }}" />
            <ul class="wtree">{{ menuTreeCategory(getAllCategories()) }}</ul>
        </div>
    </div>
</div>
@endsection