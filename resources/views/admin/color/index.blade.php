@php
    $moduleName = 'màu sắc';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.color.index"
        childrenName="Danh sách {{ $moduleName }}" />
    <div class="card">
        <x-alert />
        <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.color.add"
            linkName="Tạo {{ $moduleName }}" />


        <div class="table-responsive text-nowrap mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên màu</th>
                        <th>Mã code</th>
                        <th>Ngày tạo</th>
                        <th>Cài đặt</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($colors->count() > 0)

                        @foreach ($colors as $item)
                            <tr>
                                <td> <a href="{{ route('dashboard.color.edit', $item->id) }}" style="color: inherit"
                                        title="Click xem thêm"><strong>#{{ $item->id }}</strong>
                                    </a>
                                </td>
                                <td><a href="{{ route('dashboard.color.edit', $item->id) }}" title="Click xem thêm"
                                        style="color: inherit"><strong>{{ $item->name }}</strong>
                                    </a></td>
                                <td>
                                    <span>{{ $item->code }} </span>
                                    <span class="w-px-20 h-px-20  d-inline-block"
                                        style="border-radius:2px;background-color:{{ $item->code }}"></span>
                                </td>
                                <td>
                                    <p class="m-0">{{ $item->created_at->format('d M Y') }}</p>
                                    <small>{{ $item->created_at->format('h:i A') }}</small>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.color.edit', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Sửa thông tin</a>
                                            <form class="dropdown-item"
                                                action="{{ route('dashboard.color.delete', $item->id) }}" method="POST"
                                                onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')">
                                                @csrf
                                                @method('delete')
                                                <button class="btn p-0  w-100 text-start" type="submit">
                                                    <i class="bx bx-trash  me-1"></i>
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
                            <td colspan="5" class="text-center">Không có dữ liệu!</td>
                        </tr>

                    @endif


                </tbody>
            </table>
        </div>

    </div>
@endsection
