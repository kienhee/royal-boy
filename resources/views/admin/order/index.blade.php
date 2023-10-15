@php
    $moduleName = 'đơn hàng';
@endphp
@extends('layouts.admin.index')
@section('title', 'Quản lý ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.order.index"
        childrenName="Tất cả {{ $moduleName }}" />
    <div class="card">
        <x-alert />
        <div class="d-flex justify-content-between align-items-center mx-3">
            <h5 class="card-header px-0">Tất cả {{ $moduleName }}</h5>
        </div>
        <hr class="my-0" />

        <form method="GET" class="mx-3 mb-4 mt-4">
            <div class="row ">
                <div class="col-md-6 col-lg-3 mb-2">
                    <div class="input-group input-group-merge">
                        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                        <input type="search" class="form-control" placeholder="Tên khách hàng, email hoặc sdt"
                            name="keywords" value="{{ Request()->keywords }}">
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-2">
                    <select class="form-select" name="status">
                        <option value="">Trạng thái</option>
                        <option value="pending" {{ Request()->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ Request()->status == 'completed' ? 'selected' : '' }}>Completed
                        </option>
                        <option value="refunded" {{ Request()->status == 'refunded' ? 'selected' : '' }}>Refunded
                        </option>
                    </select>
                </div>

                <div class="col-md-6 col-lg-3 mb-2">
                    <select class="form-select" name="sort">
                        <option value="">Bộ lọc</option>
                        <option value="desc" {{ Request()->sort == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                        <option value="asc" {{ Request()->sort == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                    </select>
                </div>


                <div class="col-md-6 col-lg-3 mb-2 text-md-end">
                    <a href="{{ route('dashboard.order.index') }}" class="btn btn-outline-secondary">Đặt lại </a>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </div>

            </div>
        </form>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th class="px-1 text-center" style="width: 50px">#ID</th>
                        <th>Khách hàng</th>
                        <th class="px-1 text-center" style="width: 130px">Tổng đơn hàng</th>
                        <th class="px-1 text-center" style="width: 130px">Số lượng</th>
                        <th style="width: 130px">Ngày đặt</th>
                        <th class="px-1" style="width: 130px">Trạng thái</th>
                        <th class="px-1 text-center" style="width: 130px">Cài đặt</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @if ($orders->count() > 0)
                        @foreach ($orders as $item)
                            <tr>
                                <td class="px-0 text-center">
                                    <a href="{{ route('dashboard.order.order-detail', $item->id) }}" title="Click xem thêm"
                                        style="color: inherit"><strong>#{{ $item->id }}</strong>
                                    </a>
                                </td>

                                <td>
                                    <a href="{{ route('dashboard.order.order-detail', $item->id) }}"
                                        style="color: inherit    " title="Click xem thêm" class="d-block">
                                        <strong>
                                            {{ $item->name }}
                                        </strong>
                                    </a>
                                    <small>Email: {{ $item->email }} </small><br>
                                    <small>SDT: {{ $item->phone }}</small>
                                </td>
                                <td class="px-0 text-center text-success">
                                    {{ number_format($item->total) }}đ
                                </td>
                                <td class="px-0 text-center">
                                    x{{ $item->quantity }}
                                </td>

                                <td>
                                    <p class="m-0">{{ $item->created_at->format('d M Y') }}</p>
                                    <small>{{ $item->created_at->format('h:i A') }}</small>
                                </td>
                                <td class="text-center px-0">

                                    <select onchange="changeStatusOrder(this,{{ $item->id }})"
                                        class="form-select status__order {{ $item->status == 1 ? 'text-warning' : '' }}  {{ $item->status == 2 ? 'text-success' : '' }}{{ $item->status == 3 ? 'text-primary' : '' }}">
                                        <option value="pending" @if ($item->status == 1) @selected(true) @endif>
                                            Pending</option>
                                        <option value="completed" @if ($item->status == 2) @selected(true) @endif>
                                            Completed
                                        </option>
                                        <option value="refunded" @if ($item->status == 3) @selected(true) @endif>
                                            Refunded
                                        </option>
                                    </select>
                                </td>
                                <td class="px-0 text-center">

                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                                href="{{ route('dashboard.order.order-detail', $item->id) }}"><i
                                                    class="bx bx-edit-alt me-1"></i>
                                                Xem thêm</a>
                                            <form class="dropdown-item"
                                                action="{{ route('dashboard.order.delete', $item->id) }}" method="POST"
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
        <div class="mx-3 mt-3">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
    <script>
        function changeStatusOrder(selectElement, orderId) {
            let optionElement = selectElement.options[selectElement.selectedIndex].value;
            let status = 1;
            if (optionElement == 'pending') {
                status = 1
            } else if (optionElement == 'completed') {
                status = 2
            } else {
                status = 3
            }
            $.ajax({
                type: "put",
                url: `orders/change-status`,
                data: {
                    orderId,
                    status,
                    _token: $("input[name='_token']").val(),
                }
            })
        }
    </script>
@endsection
