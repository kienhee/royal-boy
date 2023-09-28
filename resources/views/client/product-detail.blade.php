@extends('layouts.client.index')
@section('content')
    <!-- Shop Details Section Begin -->
    <section class="shop-details">
        <div class="product__details__pic">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__breadcrumb">
                            <a href="{{ route('client.index') }}">Home</a>
                            <a href="{{ route('client.shop') }}">Shop</a>
                            <span>Product Details</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <ul class="nav nav-tabs" role="tablist">
                            @foreach (explode(',', $product->images) as $key => $item)
                                <li class="nav-item ">
                                    <a class="nav-link {{ $key == 0 ? 'active' : '' }}" data-toggle="tab"
                                        href="#tabs-{{ $key }}" role="tab">
                                        <div class="product__thumb__pic set-bg" data-setbg="{{ $item }}"
                                            style="background-image: url(&quot;{{ $item }}&quot;);">
                                        </div>
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="col-lg-6 col-md-9">
                        <div class="tab-content">
                            @foreach (explode(',', $product->images) as $key => $item)
                                <div class="tab-pane {{ $key == 0 ? 'active' : '' }}" id="tabs-{{ $key }}"
                                    role="tabpanel">
                                    <div class="product__details__pic__item">
                                        <img src="{{ $item }}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="product__details__content">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-lg-8">
                        <div class="product__details__text">
                            <h4>{{ $product->name }}</h4>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <span> - 5 Reviews</span>
                            </div>
                            <h3>{{ number_format($product->regular_price) }} VND<span>70.00</span></h3>
                            <p>{{ $product->description }}</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Size:</span>
                                    @foreach (explode(',', $product->sizes) as $size)
                                        <label for="{{ $size }}">{{ $size }}
                                            <input type="radio" id="{{ $size }}">
                                        </label>
                                    @endforeach


                                </div>
                                <div class="product__details__option__color">
                                    <span>Màu sắc:</span>
                                    @foreach (explode(',', $product->colors) as $color)
                                        <input type="radio" class="option__color" id="{{ $color }}" name="color"
                                            value="{{ $color }}">
                                        <label for="{{ $color }}" title="{{ explode('-', $color)[0] }}"
                                            style="background: {{ explode('-', $color)[1] }}">

                                        </label>
                                    @endforeach


                                </div>
                            </div>
                            <div class="product__details__cart__option">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                                <button data-url="{{ route('client.add-to-cart', $product->slug) }}"
                                    class="primary-btn add-to-cart">Thêm vào
                                    giỏ
                                    hàng</button>
                            </div>

                            <div class="product__details__last__option">
                                <h5><span>Đảm bảo thanh toán an toàn</span></h5>
                                <img src="{{ asset('client') }}/img/shop-details/details-payment.png" alt="">
                                <ul>
                                    <li><span>SKU:</span> 3812912</li>
                                    <li><span>Categories:</span> {{ $product->category->name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab">Mô tả sản
                                        phẩm</a>
                                </li>

                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        {!! $product->content !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Details Section End -->

    <!-- Related Section Begin -->
    <section class="related spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="related-title">Sản phẩm liên quan</h3>
                </div>
            </div>
            <div class="row">

                @foreach ($relateds as $product)
                    <div class="col-lg-3 col-md-6 col-sm-6 col-sm-6">
                        <a href="{{ route('client.product-detail', $product->slug) }}" class="product__item sale">
                            <div class="product__item__pic set-bg" data-setbg="{{ explode(',', $product->images)[0] }}"
                                style="background-image: url(&quot;{{ explode(',', $product->images)[0] }}&quot;);">
                                @if (((int) $product->sale > 0 && $product->isNew == 0) || ((int) $product->sale > 0 && $product->isNew == 1))
                                    <span class="label">Sale {{ (int) $product->sale }}%</span> <br>
                                @elseif ($product->isNew == 1 && (int) $product->sale == 0)
                                    <span class="label">New</span> <br>
                                @endif

                            </div>
                            <div class="product__item__text">
                                <a href="{{ route('client.product-detail', $product->slug) }}">{{ $product->name }}</a>
                                <div class="rating">
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                </div>

                                @if ((int) $product->sale > 0)
                                    <h5 style="color: #e53637">
                                        {{ number_format(((100 - $product->sale) / 100) * $product->regular_price) }}đ
                                    </h5>
                                    <del class="text-muted ">{{ number_format($product->regular_price) }}đ
                                    </del>
                                @else
                                    <h5 style="color: #e53637">
                                        {{ number_format($product->regular_price) }}đ
                                    </h5>
                                @endif

                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Section End -->
@endsection
