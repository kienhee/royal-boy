@extends('layouts.client.index')
@section('title', 'Checkout')
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

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6 class="coupon__link"><span class="icon_tag_alt"></span> <a href="#">Have a coupon?</a> Click
                    here to enter your code.</h6>
            </div>
        </div>
        <form action="#" class="checkout__form">
            <div class="row">
                <div class="col-lg-8">
                    <h5>Billing detail</h5>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="checkout__form__input">
                                <p>Full Name <span>*</span></p>
                                <input type="text" id="full_name" class="mb-3" value="{{Auth::user()->full_name}}">
                                <p class="text-danger mb-2" id="err_full_name"></p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Email <span>*</span></p>
                                <input type="text" id="email" class="mb-3" value="{{Auth::user()->email}}">
                                <p class="text-danger mb-2" id="err_email"></p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Phone Number <span>*</span></p>
                                <input type="text" id="phone_number" class="mb-3"
                                    value="{{Auth::user()->phone_number}}">
                                <p class="text-danger mb-2" id="err_phone_number"></p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Address <span>*</span></p>
                                <input type="text" id="address" class="mb-3" value="{{Auth::user()->address}}">
                                <p class="text-danger mb-2" id="err_address"></p>
                            </div>
                            <div class="checkout__form__input">
                                <p>Oder notes <span>*</span></p>
                                <input type="text" id="notes" class="mb-3"
                                    placeholder="Note about your order, e.g, special noe for delivery">
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="checkout__order">
                        <h5>Your order</h5>
                        <div class="checkout__order__product">
                            <ul>
                                <li>
                                    <span class="top__text">Product</span>
                                    <span class="top__text__right">Total</span>
                                </li>
                                <li>01. Chain buck bag <span>$ 300.0</span></li>
                                <li>02. Zip-pockets pebbled<br /> tote briefcase <span>$ 170.0</span></li>
                                <li>03. Black jean <span>$ 170.0</span></li>
                                <li>04. Cotton shirt <span>$ 110.0</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__total">
                            <ul>
                                <li>Shipping <span>Free</span></li>
                                <li>Total <span>{{$total}} đ</span></li>
                            </ul>
                        </div>
                        <div class="checkout__order__widget">
                            <label for="o-acc">
                                Create an acount?
                                <input type="checkbox" id="o-acc">
                                <span class="checkmark"></span>
                            </label>
                            <p>Create am acount by entering the information below. If you are a returing customer
                                login at the top of the page.</p>
                            <label for="check-payment">
                                Cheque payment
                                <input type="checkbox" id="check-payment">
                                <span class="checkmark"></span>
                            </label>
                            <label for="paypal">
                                PayPal
                                <input type="checkbox" id="paypal">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <button type="submit" class="site-btn" id="order">Place oder</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Checkout Section End -->
@endsection