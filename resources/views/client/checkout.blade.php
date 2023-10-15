@extends('layouts.client.index')
@section('content')
    <section class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__text">
                        <h4>Check Out</h4>
                        <div class="breadcrumb__links">
                            <a href="{{ route('client.index') }}">Home</a>
                            <a href="{{ route('client.shop') }}">Shop</a>
                            <span>Check Out</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="checkout__form">
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="coupon__code"><span class="icon_tag_alt"></span> Have a coupon? <a
                                    href="#">Click
                                    here</a> to enter your code</h6>
                            <h6 class="checkout__title">Billing Details</h6>

                            <div class="checkout__input">
                                <p>Full Name<span>*</span></p>
                                <input type="text" id="fullname" class="mb-2">
                                <p class="text-danger mb-3" id="fullname-err"></p>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" id="phone" class="mb-2">
                                        <p class="text-danger mb-3" id="phone-err"></p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" id="email" class="mb-2">
                                        <p class="text-danger mb-3" id="email-err"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" id="country" class="mb-2">
                                <p class="text-danger mb-3" id="country-err"></p>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" class="mb-2" id="address">
                                <p class="text-danger mb-3" id="address-err">

                                </p>
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" id="townCity" class="mb-2">
                                <p class="text-danger mb-3" id="townCity-err"></p>
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text" id="countryState" class="mb-2">
                                <p class="text-danger mb-3" id="countryState-err"></p>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" id="postcodeZIP" class="mb-2">
                                <p class="text-danger mb-3" id="postcodeZIP-err"></p>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input type="text" placeholder="Notes about your order, e.g. special notes for delivery."
                                    id="notes">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>

                                <ul class="checkout__total__all">
                                    <li>Total <span id="cart__total">0</span></li>
                                    <li>Shipping
                                        <span>free</span>
                                    </li>
                                </ul>
                                <h5 class="order__title">Payments</h5>
                                <div>
                                    <input type="radio" id="Payment_on_delivery" name="payment"
                                        value="Payment_on_delivery" checked>
                                    <label for="Payment_on_delivery">Payment on delivery</label>
                                </div>
                                <div>
                                    <input type="radio" id="Online_Payment" name="payment" value="Online_Payment">
                                    <label for="Online_Payment">Online Payment</label>
                                </div>


                                <button type="button" class="site-btn" id="place_order">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                    <p style="font-size: 20px;">Order Success</p>
                </div>

            </div>
        </div>
    </div>
@endsection
