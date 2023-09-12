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
        <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.group.add"
            linkName="Tạo {{ $moduleName }}" />

        <hr class="my-0 mb-4" />
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                        <th class="px-1 text-center" style="width: 50px">#ID</th>
                        <th>Tên nhóm</th>
                        <th>Ngày tạo</th>
                        <th>Cài đặt</th>
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
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.group.edit', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Sửa thông tin</a>


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
