@extends('layouts.client.index')
@section('title', 'Shop')
@section('content')

<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shop</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Section Begin -->
<section class="shop spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3">
                <form method="get">
                    <div class="shop__sidebar">
                        <div class="sidebar__categories">

                            <div class="section-title">
                                <h4>Categories</h4>
                            </div>

                            <div class="categories__accordion">
                                <div class="accordion" id="accordionExample">
                                    @foreach ($categoriesParent as $parent)
                                    <div class="card">
                                        <div class="card-heading active">
                                            <a data-toggle="collapse" data-target="#collapseOne">{{ $parent->name }}</a>
                                        </div>
                                        <div id="collapseOne" class="collapse show" data-parent="#accordionExample">
                                            <div class="card-body">
                                                <ul>
                                                    @if ($parent->categoryChildren->count())
                                                    @foreach ($parent->categoryChildren as $children)
                                                    <li class="category-cusor">
                                                        <input type="radio" class="category-radio"
                                                            @if(Request()->category == $children->id
                                                        )@checked(true)@endif
                                                        id="{{$children->name }}" value="{{$children->id }}"
                                                        name="category">
                                                        <label for="{{$children->name }}">{{$children->name }}</label>
                                                    </li>
                                                    @endforeach
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by price</h4>
                            </div>
                            <div class="size__list">
                                <label for="lowToHight">
                                    Low to hight
                                    <input type="radio" id="lowToHight" name="sort" value="asc" @if(Request()->sort ==
                                    'asc' )@checked(true)@endif>
                                    <span class="checkmark"></span>
                                </label>
                                <label for="hightToLow">
                                    Hight to low
                                    <input type="radio" id="hightToLow" name="sort" value="desc" @if(Request()->sort ==
                                    'desc' )@checked(true)@endif>
                                    <span class="checkmark"></span>
                                </label>

                            </div>
                        </div>
                        <div class="sidebar__sizes">
                            <div class="section-title">
                                <h4>Shop by size</h4>
                            </div>
                            <div class="size__list">
                                @foreach ($sizes as $size)
                                <label for="{{$size->name}}">
                                    {{$size->name}}
                                    <input type="radio" id="{{$size->name}}" name="size" value="{{$size->name}}"
                                        @if(Request()->sizes == $size->name )@checked(true)@endif>
                                    <span class="checkmark"></span>
                                </label>
                                @endforeach


                            </div>
                        </div>
                        <div class="sidebar__color">
                            <div class="section-title">
                                <h4>Shop by color</h4>
                            </div>
                            <div class=" color__list">
                                @foreach ($colors as $color)
                                <label for="{{$color->name}}">
                                    <input type="radio" class="color-checkbox" id="{{$color->name}}" name="color"
                                        value="{{$color->name}}" @if(Request()->color == $color->name
                                    )@checked(true)@endif>
                                    <div class="color-bg"
                                        style="width: 30px ; height:30px ; background: {{$color->code}};border-radius:50%;">
                                    </div>
                                </label>

                                @endforeach

                            </div>
                        </div>
                    </div>
                    <button class="btn btn-danger w-100 mb-2">Filter</button>
                    <a href="{{route('client.shop')}}" class="btn btn-outline-secondary w-100">Reset</a>
                </form>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="row">
                    @if ($products->count() )
                    @foreach ($products as $product)

                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{explode(',',$product->images)[0]}}">
                                <div class="label new">New</div>
                                <ul class="product__hover">
                                    <li><a href="{{explode(',',$product->images)[0]}}" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="javascript:void(0)" onclick="addToFavourite({{$product->id}})"><span
                                                class="icon_heart_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{route('client.product-detail',$product->slug)}}">{{$product->name}}</a>
                                </h6>
                                @if ($product->sale)
                                <div class="product__price">{{number_format(((100 - $product->sale)/100)
                                    *$product->price)}} đ <span>{{number_format($product->price)}} đ</span>
                                </div>
                                @else
                                <div class="product__price">{{number_format($product->price)}} đ
                                </div>
                                @endif

                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif

                    {{-- <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-2.jpg">
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-2.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Flowy striped skirt</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 49.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-3.jpg">
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-3.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Croc-effect bag</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-4.jpg">
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-4.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Dark wash Xavi jeans</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-5.jpg">
                                <div class="label">Sale</div>
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-5.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Ankle-cuff sandals</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-6.jpg">
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-6.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Contrasting sunglasses</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-7.jpg">
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-7.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Circular pendant earrings</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-8.jpg">
                                <div class="label stockout stockblue">Out Of Stock</div>
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-8.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Cotton T-Shirt</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 59.0</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="product__item sale">
                            <div class="product__item__pic set-bg"
                                data-setbg="{{ asset('client') }}/img/shop/shop-9.jpg">
                                <div class="label">Sale</div>
                                <ul class="product__hover">
                                    <li><a href="{{ asset('client') }}/img/shop/shop-9.jpg" class="image-popup"><span
                                                class="arrow_expand"></span></a></li>
                                    <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                    <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                </ul>
                            </div>
                            <div class="product__item__text">
                                <h6><a href="#">Water resistant zips backpack</a></h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">$ 49.0 <span>$ 59.0</span></div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-lg-12 text-center">
                        <div class="pagination__option">
                            {{ $products->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Section End -->
@endsection