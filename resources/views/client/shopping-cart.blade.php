@extends('layouts.client.index')
@section('content')
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Shopping Cart</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client.index') }}">Home</a>
                            <a href="{{ route('client.shop') }}">Shop</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="shopping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="cart-list">
                                {{-- demo --}}
                                <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="{{ asset('client') }}/img/shopping-cart/cart-1.jpg" alt="">
                                        </div>
                                        <div class="product__cart__item__text">
                                            <h5>T-shirt Contrast Pocket</h5>
                                            <h6 style="color: #e53637" class="mb-1">1.0000 VND</h6>
                                            <small class="text-muted">Size: XL - Màu: Tím</small>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" value="1">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price">$ 30.00</td>
                                    <td class="cart__close"><i class="fa fa-close"></i></td>
                                </tr>
                                <tr>
                                    <td colspan="4">
                                        <h4 class="text-center">Giỏ hàng
                                            của bạn còn trống</h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div id="test"></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn">
                                <a href="{{ route('client.shop') }}">CONTINUE SHOPPING</a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <div class="continue__btn update__btn" id="update__btn">
                                <a href="javascript:void(0)"><i class="fa fa-spinner"></i>Update cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="cart__discount">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Coupon code">
                            <button type="submit">Apply</button>
                        </form>
                    </div>
                    <div class="cart__total-box" id="cart__total-box">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Total <span id="cart__total">0</span></li>
                            <li>Shipping
 <span>free</span></li>
                        </ul>
                        <a href="{{ route('client.checkout') }}" class="primary-btn" id="btn__checkout">Proceed to
                            checkout</a>
                    </div>
                </div>
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
                    <p style="font-size: 20px;"> Giỏ hàng đã được cập nhật</p>
                </div>

            </div>
        </div>
    </div>
@endsection
