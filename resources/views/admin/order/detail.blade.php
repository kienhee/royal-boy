@php
    $moduleName = 'đơn hàng';
@endphp
@extends('layouts.admin.index')
@section('title', 'Thông tin ' . $moduleName)

@section('content')
    <x-breadcrumb parentName="Quản lý {{ $moduleName }}" parentLink="dashboard.order.index"
        childrenName="Thông tin {{ $moduleName }}" />
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <x-alert />
                <x-header-table tableName="Thông tin {{ $moduleName }}" link="dashboard.order.index"
                    linkName="Tất cả {{ $moduleName }}" />
                <div class="card-body pb-5">
                    <div class="row">
                        <div class="col-lg-9">

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="px-1 text-center" style="width: 50px"></th>
                                        <th>Sản phẩm</th>
                                        <th class="px-1 text-center" style="width: 130px">Số lượng</th>
                                        <th class="px-1 text-center" style="width: 130px">Đơn Giá</th>
                                        <th class="px-1 text-center" style="width: 130px">Tổng</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    @foreach ($products as $item)
                                        <tr>
                                            <td class="px-0 text-center">
                                                <img src="{{ explode(',', $item->product->images)[0] }}" alt="Ảnh"
                                                    class=" object-fit-cover border rounded w-px-40 h-px-40">
                                            </td>
                                            <td>
                                                <a href="{{ route('client.product-detail', $item->product->slug) }}"
                                                    target="_blank" style="color: inherit    " title="Click xem sản phẩm"
                                                    class="d-block">
                                                    <strong>
                                                        {{ $item->product->name }}
                                                    </strong>
                                                </a>
                                                <small>Size: {{ $item->size }}</small><br>
                                                <small>Color: {{ explode('-', $item->color)[0] }} </small>
                                            </td>
                                            <td class="text-center">
                                                x{{ $item->quantity }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($item->price) }}đ
                                            </td>
                                            <td class="text-center">
                                                <strong
                                                    class="text-success">{{ number_format($item->price * $item->quantity) }}đ</strong>
                                            </td>

                                        </tr>
                                    @endforeach




                                </tbody>
                            </table>
                            <hr class="mb-5">
                            <div class="row">
                                <div class="col-lg-6"></div>
                                <div class="col-lg-6">
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <span class="fw-semibold">Tổng số lượng :</span><span>{{ $customerInfo->quantity }}
                                            sản phẩm</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <span class="fw-semibold">Shipping
                                            :</span><span>free</span>
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <span class="fw-semibold">Tổng đơn hàng:
                                        </span><span class="text-success">{{ number_format($customerInfo->total) }}đ</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg-3  ">
                            <h5>Thông tin khách hàng</h5>
                            <hr>
                            <div class="d-flex align-items-center mb-5">
                                <div class="flex-grow-1 me-3">
                                    <span class="fw-semibold d-block">{{ $customerInfo->name }}</span>
                                    <small class="text-muted  text-right">{{ $customerInfo->email }}</small><br>
                                    <small class="text-muted  text-right">{{ $customerInfo->phone }}</small><br>
                                </div>
                                <div class="flex-shrink-0 ">
                                    <div class="avatar avatar-online">
                                        <img src="{{ asset('images/avatar-default.png') }} " alt="avatar"
                                            class="w-px-40 h-px-40 rounded-circle" style="object-fit: cover" />
                                    </div>
                                </div>
                            </div>
                            <h5>Thông tin khách hàng</h5>
                            <hr>
                            <section class="mb-5">
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Đất nước:</span><span>{{ $customerInfo->country }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Thành phố:</span><span>{{ $customerInfo->townCity }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Địa chỉ:</span><span>{{ $customerInfo->address }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Quốc gia/Tiểu
                                        bang:</span><span>{{ $customerInfo->countryState }}</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Mã bưu điện /
                                        ZIP:</span><span>{{ $customerInfo->postcodeZIP }}</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                    <span class="fw-semibold">Ghi chú:</span><span>{{ $customerInfo->notes }}</span>
                                </div>
                                @if ($customerInfo->payment == 1)
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <span class="fw-semibold">Payment:</span><span
                                            class="badge bg-label-primary me-1">Thanh toán khi nhận hàng</span>
                                    </div>
                                @else
                                    <div class="d-flex justify-content-between align-items-center flex-wrap mb-2">
                                        <span class="fw-semibold">Payment:</span><span
                                            class="badge bg-label-success me-1">Thanh toán online</span>
                                    </div>
                                @endif
                            </section>



                            <button class="btn btn-dark w-100"><i class='bx bx-printer me-1'></i><span>Xác nhận và in hóa
                                    đơn</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
