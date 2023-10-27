@php
    $moduleName = 'nhóm người dùng';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.group.index"
        childrenName="Danh sách {{ $moduleName }}" />
    <div class="card">
        <x-alert />
        <div class="alert alert-danger alert-dismissible mx-3 mt-3" role="alert" bis_skin_checked="1">
            Lưu ý: Không nên tự ý xóa Quản trị viên và khách hàng tránh lỗi hệ thống!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        {{-- @can('create', App\Models\Group::class) --}}
        <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.group.add"
            linkName="Tạo {{ $moduleName }}" />
        {{-- @else --}}
        <div class="d-flex justify-content-between align-items-center mx-3">
            <h5 class="card-header px-0"> Danh sách {{ $moduleName }}</h5>
        </div>
        <hr class="my-0" />
        {{-- @endcan --}}

        <hr class="my-0 mb-4" />
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th class="px-1 text-center" style="width: 50px">#ID</th>
                        <th>Tên nhóm</th>
                        {{-- @can('permission', App\Models\Group::class) --}}
                        <th style="width: 150px">Phân quyền</th>
                        {{-- @endcan --}}
                        <th style="width: 150px">Ngày tạo</th>
                        <th style="width: 150px">Cài đặt</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($groups->count() > 0)
                        @foreach ($groups as $item)
                            <tr>
                                <td> <a href="{{ route('dashboard.group.edit', $item->id) }}" style="color: inherit"
                                        title="Click xem thêm"><strong>#{{ $item->id }}</strong>
                                    </a>
                                </td>
                                <td><a href="{{ route('dashboard.group.edit', $item->id) }}" title="Click xem thêm"
                                        style="color: inherit"> <strong>{{ $item->name }}</strong>
                                    </a></td>
                                {{-- @can('permission', App\Models\Group::class) --}}
                                <td>
                                    <a href="{{ route('dashboard.group.permissions', $item->id) }}"
                                        class="btn btn-primary btn-sm">Phân
                                        quyền</a>
                                </td>
                                {{-- @endcan --}}
                                <td>
                                    <p class="m-0">{{ $item->created_at->format('d M Y') }}</p>
                                    <small>{{ $item->created_at->format('h:i A') }}</small>
                                </td>
                                <td class="text-start">
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- @can('update', App\Models\Group::class) --}}
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.group.edit', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Sửa thông tin</a>
                                            {{-- @else --}}
                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Không có quyền sửa</a>
                                            {{-- @endcan --}}
                                            {{-- @can('delete', App\Models\Group::class) --}}
                                            <form class="dropdown-item"
                                                action="{{ route('dashboard.group.delete', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn p-0  w-100 text-start" type="submit">
                                                    <i class="bx bx-trash me-1"></i>
                                                    Xóa vĩnh viễn
                                                </button>
                                            </form>
                                            {{-- @else --}}
                                            <a class="dropdown-item" href="javascript:void(0)"><i
                                                    class="bx bx-trash me-1"></i>
                                                Không có quyền xóa</a>
                                            {{-- @endcan --}}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9" class="text-center">Không có dữ liệu!</td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div>
    </div>
@endsection
