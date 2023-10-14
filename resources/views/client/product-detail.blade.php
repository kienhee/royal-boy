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
                            <span>{{ $product->name }}</span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <input type="hidden" value="{{ explode(',', $product->images)[0] }}" id="cover">
                        <input type="hidden" value="{{ $product->slug }}" id="slug">
                        <input type="hidden"
                            value="@if ((int) $product->sale > 0) {{ ((100 - $product->sale) / 100) * $product->regular_price }} @else{{ $product->regular_price }} @endif"
                            id="price">
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
                            @if ((int) $product->sale > 0)
                                <h3 style="color: #e53637" class="mb-1">
                                    {{ number_format(((100 - $product->sale) / 100) * $product->regular_price) }}đ
                                </h3>
                                <h5 class="mb-3"><del class="text-muted ">{{ number_format($product->regular_price) }}đ
                                    </del></h5>
                            @else
                                <h3 style="color: #e53637">
                                    {{ number_format($product->regular_price) }}đ
                                </h3>
                            @endif
                            <p>{{ $product->description }}</p>
                            <div class="product__details__option">
                                <div class="product__details__option__size">
                                    <span>Sizes:</span>
                                    @foreach (explode(',', $product->sizes) as $key => $size)
                                        <label for="{{ $size }}"
                                            class="@if ($key == 0) active @endif">{{ $size }}
                                            <input type="radio" id="{{ $size }}" name="size"
                                                value="{{ $size }}"
                                                @if ($key == 0) @checked(true) @endif>

                                        </label>
                                    @endforeach
                                </div>
                                <div class="product__details__option__color">
                                    <span>Colors:</span>
                                    @foreach (explode(',', $product->colors) as $key => $color)
                                        <input type="radio" class="option__color" id="{{ $color }}" name="color"
                                            @if ($key == 0) @checked(true) @endif
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
                                        <input type="text" value="1" id="product_quantity">
                                    </div>
                                </div>
                                <button data-product={{ $product->id }} class="primary-btn add-to-cart">Add to
                                    cart</button>
                            </div>

                            <div class="product__details__last__option">
                                <h5><span>Guaranteed Safe Checkout</span></h5>
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
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-5" role="tab"
                                        aria-selected="false">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-6" role="tab"
                                        aria-selected="false">Customer
                                        Previews(5)</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " data-toggle="tab" href="#tabs-7" role="tab"
                                        aria-selected="true">Additional
                                        information</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-5" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        {!! $product->content !!}
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-6" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane " id="tabs-7" role="tabpanel">
                                    <div class="product__details__tab__content">
                                        <p class="note">Nam tempus turpis at metus scelerisque placerat nulla deumantos
                                            solicitud felis. Pellentesque diam dolor, elementum etos lobortis des mollis
                                            ut risus. Sedcus faucibus an sullamcorper mattis drostique des commodo
                                            pharetras loremos.</p>
                                        <div class="product__details__tab__content__item">
                                            <h5>Products Infomation</h5>
                                            <p>A Pocket PC is a handheld computer, which features many of the same
                                                capabilities as a modern PC. These handy little devices allow
                                                individuals to retrieve and store e-mail messages, create a contact
                                                file, coordinate appointments, surf the internet, exchange text messages
                                                and more. Every product that is labeled as a Pocket PC must be
                                                accompanied with specific software to operate the unit and must feature
                                                a touchscreen and touchpad.</p>
                                            <p>As is the case with any new technology product, the cost of a Pocket PC
                                                was substantial during it’s early release. For approximately $700.00,
                                                consumers could purchase one of top-of-the-line Pocket PCs in 2003.
                                                These days, customers are finding that prices have become much more
                                                reasonable now that the newness is wearing off. For approximately
                                                $350.00, a new Pocket PC can now be purchased.</p>
                                        </div>
                                        <div class="product__details__tab__content__item">
                                            <h5>Material used</h5>
                                            <p>Polyester is deemed lower quality due to its none natural quality’s. Made
                                                from synthetic materials, not natural like wool. Polyester suits become
                                                creased easily and are known for not being breathable. Polyester suits
                                                tend to have a shine to them compared to wool and cotton suits, this can
                                                make the suit look cheap. The texture of velvet is luxurious and
                                                breathable. Velvet is a great choice for dinner party jacket and can be
                                                worn all year round.</p>
                                        </div>
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
                    <h3 class="related-title">Related Product</h3>
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
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
    <!-- Modal -->
    <div class="modal fade" id="modal-susccess" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered ">
            <div class="modal-content">
                <div class="modal-body d-flex justify-content-center align-items-center gap-3 flex-column text-center">
                    <img src="{{ asset('images/icon-success.png') }}" width="50" height="50" class="mb-4"
                        alt="">
                    <p style="font-size: 20px;"> The product has been added to cart</p>
                </div>

            </div>
        </div>
    </div>
    <!-- Related Section End -->
@endsection
