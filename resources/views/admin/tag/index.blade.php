@php
    $moduleName = 'thẻ';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.tag.index"
        childrenName="Danh sách {{ $moduleName }}" />
    <div class="card">
        <x-alert />
        <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.tag.add"
            linkName="Tạo {{ $moduleName }}" />

        <div class="table-responsive text-nowrap mt-4">
            <table class="table">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Tên thẻ</th>
                        <th>Ngày tạo</th>
                        <th>Cài đặt</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($tags->count() > 0)

                        @foreach ($tags as $item)
                            <tr>
                                <td> <a href="{{ route('dashboard.tag.edit', $item->id) }}" title="Click xem thêm"
                                        style="color: inherit"><strong>#{{ $item->id }}</strong>
                                    </a>
                                </td>
                                <td> <a href="{{ route('dashboard.tag.edit', $item->id) }}" title="Click xem thêm"
                                        style="color: inherit"><strong>{{ $item->name }}</strong>
                                    </a></td>

                                <td>
                                    {{ $item->created_at->format('d-m-Y') ?? '' }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{ route('dashboard.tag.edit', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Sửa thông tin</a>
                                            <form class="dropdown-item"
                                                action="{{ route('dashboard.tag.delete', $item->id) }}" method="POST"
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
