@extends('layouts.client.index')
@section('title', 'Shop cart')
@section('content')
<!-- Breadcrumb Begin -->
<div class="breadcrumb-option">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb__links">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <span>Shopping cart</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Cart Section Begin -->
<section class="shop-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="shop__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="cart">
                            {{-- <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('client')}}/img/shop-cart/cp-1.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Chain bucket bag</h6>
                                        <p class="mb-0">Size: Xl</p>
                                        <p class="d-flex align-items-center"><span>Color:</span> <span
                                                class="ml-2 d-block"
                                                style="width: 15px; height:15px;border-radius:2px;background:red"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="cart__price">$ 150.0 <del class="text-secondary">100</del></td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 300.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr> --}}
                            {{-- <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('client')}}/img/shop-cart/cp-2.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Zip-pockets pebbled tote briefcase</h6>
                                        <p class="mb-0">Size: Xl</p>
                                        <p class="d-flex align-items-center"><span>Color:</span> <span
                                                class="ml-2 d-block"
                                                style="width: 15px; height:15px;border-radius:2px;background:red"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="cart__price">$ 170.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 170.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('client')}}/img/shop-cart/cp-3.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Black jean</h6>
                                        <p class="mb-0">Size: Xl</p>
                                        <p class="d-flex align-items-center"><span>Color:</span> <span
                                                class="ml-2 d-block"
                                                style="width: 15px; height:15px;border-radius:2px;background:red"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="cart__price">$ 85.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 170.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr>
                            <tr>
                                <td class="cart__product__item">
                                    <img src="{{asset('client')}}/img/shop-cart/cp-4.jpg" alt="">
                                    <div class="cart__product__item__title">
                                        <h6>Cotton Shirt</h6>
                                        <p class="mb-0">Size: Xl</p>
                                        <p class="d-flex align-items-center"><span>Color:</span> <span
                                                class="ml-2 d-block"
                                                style="width: 15px; height:15px;border-radius:2px;background:red"></span>
                                        </p>
                                    </div>
                                </td>
                                <td class="cart__price">$ 55.0</td>
                                <td class="cart__quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </td>
                                <td class="cart__total">$ 110.0</td>
                                <td class="cart__close"><span class="icon_close"></span></td>
                            </tr> --}}

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn">
                    <a href="/shop">Continue Shopping</a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="cart__btn update__btn">
                    <a href="javascript:void(0)" id="update_cart"><span class="icon_loading"></span> Update cart</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="discount__content">
                    <h6>Discount codes</h6>
                    <form action="#">
                        <input type="text" placeholder="Enter your coupon code">
                        <button type="submit" class="site-btn">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-2">
                <div class="cart__total__procced" id="process_to_checkout">
                    <h6>Cart total</h6>
                    <ul>
                        <li>Shipping <span>Free</span></li>
                        <li>Total <span id="cart_total"></span></li>
                    </ul>
                    <a href="{{route('client.checkout')}}" class="primary-btn text-white">Proceed to checkout</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shop Cart Section End -->
@endsection