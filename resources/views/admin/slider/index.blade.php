@php
$moduleName = 'Slider';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)

@section('content')
<x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.slider.index" childrenName="Danh sách {{ $moduleName }}" />
<div class="card">
    <x-alert />
    <x-header-table tableName="Danh sách {{ $moduleName }}" link="dashboard.slider.add" linkName="Tạo {{ $moduleName }}" />



    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th class="px-1 text-center" style="width: 50px">#ID</th>
                    <th class="px-1 text-center" style="width: 50px"></th>
                    <th>Tiêu đề</th>
                    <th>Mô tả ngắn</th>
                    <th style="width: 130px">Bộ sưu tập</th>
                    <th style="width: 130px">Ngày đăng</th>
                    <th style="width: 130px">Trạng thái</th>
                    <th style="width: 130px">Cài đặt</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @if ($sliders->count() > 0)
                @foreach ($sliders as $item)
                <tr>
                    <td class="px-0 text-center">
                        <a href="{{ route('dashboard.slider.edit', $item->id) }}" title="Click xem thêm" style="color: inherit"><strong>{{ $item->id }}</strong>
                        </a>
                    </td>
                    <td class="px-0 text-center">
                        <img src="{{ $item->image ?? asset('images/no-img.png') }}" style="object-fit: contain" alt="Ảnh" class=" border rounded w-px-40 h-px-40">
                    </td>
                    <td>
                        <a href="{{ route('dashboard.slider.edit', $item->id) }}" style="color: inherit    " title="Click xem thêm">
                            <strong>
                                {{ $item->title }}
                            </strong>
                        </a>
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                    <td class="text-center px-0">
                        {{ $item->category->name }}
                    </td>
                    <td>
                        <p class="m-0">{{ $item->created_at->format('d M Y') }}</p>
                        <small>{{ $item->created_at->format('h:i A') }}</small>
                    </td>
                    <td class="px-0 text-center"><span class="badge  me-1 {{ $item->deleted_at == null ? 'bg-label-success ' : ' bg-label-primary' }}">{{ $item->deleted_at == null ? 'Công khai' : 'Tạm ẩn' }}</span>
                    </td>

                    <td class="px-0 text-center">
                        <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{ route('dashboard.slider.edit', $item->id) }}"><i class="bx bx-edit-alt me-1"></i>
                                    Xem thêm</a>


                                @if ($item->trashed() == 1)
                                <form class="dropdown-item" action="{{ route('dashboard.slider.restore', $item->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button class="btn p-0  w-100 text-start" type="submit">
                                        <i class='bx bx-revision'></i>
                                        Khôi phục hoạt động
                                    </button>
                                </form>
                                @endif
                                <form class="dropdown-item" action="{{ $item->trashed() ? route('dashboard.slider.force-delete', $item->id) : route('dashboard.slider.soft-delete', $item->id) }}" method="POST" @if ($item->trashed()) onsubmit="return confirm('Bạn chắc chắn muốn xóa vĩnh viễn?')" @endif>
                                    @csrf
                                    @method('delete')
                                    <button class="btn p-0  w-100 text-start" type="submit">
                                        <i class="bx {{ $item->trashed() ? 'bx-trash' : 'bx bxs-hand' }}  me-1"></i>
                                        {{ $item->trashed() ? 'Xóa vĩnh viễn' : 'Tạm ngưng hoạt động' }}
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
    <div class="mx-3 mt-3">
        {{ $sliders->withQueryString()->links() }}
    </div>
</div>
@endsection