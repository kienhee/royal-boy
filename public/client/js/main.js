/*  ---------------------------------------------------
    Template Name: Male Fashion
    Description: Male Fashion - ecommerce teplate
    Author: Colorib
    Author URI: https://www.colorib.com/
    Version: 1.0
    Created: Colorib
---------------------------------------------------------  */

"use strict";

(function ($) {
    /*------------------
        Preloader
    --------------------*/
    $(window).on("load", function () {
        $(".loader").fadeOut();
        $("#preloder").delay(100).fadeOut("slow");

        /*------------------
            Gallery filter
        --------------------*/
        $(".filter__controls li").on("click", function () {
            $(".filter__controls li").removeClass("active");
            $(this).addClass("active");
        });
        if ($(".product__filter").length > 0) {
            var containerEl = document.querySelector(".product__filter");
            var mixer = mixitup(containerEl);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $(".set-bg").each(function () {
        var bg = $(this).data("setbg");
        $(this).css("background-image", "url(" + bg + ")");
    });

    //Search Switch
    $(".search-switch").on("click", function () {
        $(".search-model").fadeIn(400);
    });

    $(".search-close-switch").on("click", function () {
        $(".search-model").fadeOut(400, function () {
            $("#search-input").val("");
        });
    });

    /*------------------
        Navigation
    --------------------*/
    $(".mobile-menu").slicknav({
        prependTo: "#mobile-menu-wrap",
        allowParentLinks: true,
    });

    /*------------------
        Accordin Active
    --------------------*/
    $(".collapse").on("shown.bs.collapse", function () {
        $(this).prev().addClass("active");
    });

    $(".collapse").on("hidden.bs.collapse", function () {
        $(this).prev().removeClass("active");
    });

    //Canvas Menu
    $(".canvas__open").on("click", function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay").on("click", function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    /*-----------------------
        Hero Slider
    ------------------------*/
    $(".hero__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: [
            "<span class='arrow_left'><span/>",
            "<span class='arrow_right'><span/>",
        ],
        animateOut: "fadeOut",
        animateIn: "fadeIn",
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true,
        autoplayTimeout: 5000,
    });

    /*--------------------------
        Select
    ----------------------------*/
    $("select").niceSelect();

    /*-------------------
        Radio Btn
    --------------------- */
    $(
        ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
    ).on("click", function () {
        $(
            ".product__color__select label, .shop__sidebar__size label, .product__details__option__size label"
        ).removeClass("active");
        $(this).addClass("active");
    });

    /*-------------------
        Scroll
    --------------------- */
    $(".nice-scroll").niceScroll({
        cursorcolor: "#0d0d0d",
        cursorwidth: "5px",
        background: "#e5e5e5",
        cursorborder: "",
        autohidemode: true,
        horizrailenabled: false,
    });

    /*------------------
        CountDown
    --------------------*/
    // For demo preview start
    var today = new Date();
    var dd = String(today.getDate()).padStart(2, "0");
    var mm = String(today.getMonth() + 1).padStart(2, "0"); //January is 0!
    var yyyy = today.getFullYear();

    if (mm == 12) {
        mm = "01";
        yyyy = yyyy + 1;
    } else {
        mm = parseInt(mm) + 1;
        mm = String(mm).padStart(2, "0");
    }
    var timerdate = mm + "/" + dd + "/" + yyyy;
    // For demo preview end

    // Uncomment below and use your date //

    /* var timerdate = "2020/12/30" */

    $("#countdown").countdown(timerdate, function (event) {
        $(this).html(
            event.strftime(
                "<div class='cd-item'><span>%D</span> <p>Days</p> </div>" +
                    "<div class='cd-item'><span>%H</span> <p>Hours</p> </div>" +
                    "<div class='cd-item'><span>%M</span> <p>Minutes</p> </div>" +
                    "<div class='cd-item'><span>%S</span> <p>Seconds</p> </div>"
            )
        );
    });

    /*------------------
        Magnific
    --------------------*/
    $(".video-popup").magnificPopup({
        type: "iframe",
    });

    /*-------------------
        Quantity change
    --------------------- */
    var proQty = $(".pro-qty");
    proQty.prepend('<span class="fa fa-angle-up dec qtybtn"></span>');
    proQty.append('<span class="fa fa-angle-down inc qtybtn"></span>');
    proQty.on("click", ".qtybtn", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if ($button.hasClass("dec")) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });

    /*------------------
        Achieve Counter
    --------------------*/
    $(".cn_num").each(function () {
        $(this)
            .prop("Counter", 0)
            .animate(
                {
                    Counter: $(this).text(),
                },
                {
                    duration: 4000,
                    easing: "swing",
                    step: function (now) {
                        $(this).text(Math.ceil(now));
                    },
                }
            );
    });

    function getCart() {
        let lengthCart = $("#lengthCart");
        $.ajax({
            type: "get",
            url: "/get-cart",
            success: function (cart) {
                if (typeof cart == "object") {
                    cart = Object.values(cart);
                }
                lengthCart.text(Object.keys(cart).length);
                let html = "";
                if (cart.length > 0) {
                    // handle show
                    cart.forEach((item) => {
                        html += ` <tr>
                                    <td class="product__cart__item">
                                        <div class="product__cart__item__pic">
                                            <img src="${item.cover}" alt="${
                            item.name
                        }" width="90" height="90">
                                        </div>
                                         <div class="product__cart__item__text">
                                           <h5 class="mb-1"><a href="/cua-hang/${
                                               item.slug
                                           }" style="color:inherit">${
                            item.name
                        }</a></h5>
                        
                                            <h6 style="color: #e53637" class="mb-1">${new Intl.NumberFormat(
                                                "vi-VN",
                                                {
                                                    style: "currency",
                                                    currency: "VND",
                                                }
                                            ).format(item.price)}</h6>
                                            <small class="text-muted">Size: ${
                                                item.size
                                            } - Màu: ${
                            item.color.split("-")[0]
                        }</small>
                                        </div>
                                    </td>
                                    <td class="quantity__item">
                                        <div class="quantity">
                                            <div class="pro-qty-2">
                                                <input type="text" name="quantity" value="${
                                                    item.quantity
                                                }">
                                                <input type="hidden" value="${
                                                    item.price
                                                }"                              >
                                                <input type="hidden" name="cart__price-uuid" value="${
                                                    item.uuid
                                                }"                              >
                                            </div>
                                        </div>
                                    </td>
                                    <td class="cart__price" id="cart__price-${
                                        item.uuid
                                    }">${new Intl.NumberFormat("vi-VN", {
                            style: "currency",
                            currency: "VND",
                        }).format(item.price * item.quantity)}</td>
                                    <td class="cart__close"><button class="btn btn-remove-cart">
                                      <input type="hidden" name="cart__price-uuid" value="${
                                          item.uuid
                                      }"                              >
                                    <i class="fa fa-close" ></i></button></td>
                                </tr>`;
                    });
                    // hanlde inc dec
                    $("#cart-list").html(html);
                    var proQty2 = $(".pro-qty-2");
                    proQty2.prepend(
                        '<span class="fa fa-angle-left dec qtybtn"></span>'
                    );
                    proQty2.append(
                        '<span class="fa fa-angle-right inc qtybtn"></span>'
                    );

                    proQty2.on("click", ".qtybtn", function () {
                        var $button = $(this);
                        var oldValue = $button
                            .parent()
                            .find("input[name='quantity']")
                            .val();
                        let cartPriceUUID = $button
                            .parent()
                            .find("input[name='cart__price-uuid']")
                            .val();
                        let price = $button
                            .parent()
                            .find("input[type='hidden']")
                            .val();
                        let cartPrice = $(`#cart__price-${cartPriceUUID}`);
                        let findIndexItemCart = cart.findIndex(
                            (item) => item.uuid == cartPriceUUID
                        );
                        if ($button.hasClass("inc")) {
                            var newVal = parseFloat(oldValue) + 1;
                            cart[findIndexItemCart].quantity++;
                        } else {
                            // Don't allow decrementing below zero
                            if (oldValue > 0) {
                                var newVal = parseFloat(oldValue) - 1;
                                cart[findIndexItemCart].quantity--;
                            } else {
                                newVal = 0;
                            }
                        }

                        $button
                            .parent()
                            .find("input[name='quantity']")
                            .val(newVal);
                        cartPrice.text(
                            new Intl.NumberFormat("vi-VN", {
                                style: "currency",
                                currency: "VND",
                            }).format(newVal * price)
                        );
                    });

                    let cartTotal = $("#cart__total");
                    let total = cart.reduce((total, item) => {
                        return total + Math.round(item.quantity * item.price);
                    }, 0);
                    cartTotal.text(
                        new Intl.NumberFormat("vi-VN", {
                            style: "currency",
                            currency: "VND",
                        }).format(total)
                    );
                    //remove item
                    var btnRemoveFromCart = $(".btn-remove-cart");

                    btnRemoveFromCart.on("click", function () {
                        let cartPriceUUID = $(this)
                            .parent()
                            .find("input[name='cart__price-uuid']")
                            .val();
                        if (
                            confirm("Are you sure you don't want to delete?!")
                        ) {
                            $.ajax({
                                type: "delete",
                                url: "/cart/remove-from-cart",
                                data: {
                                    uuid: cartPriceUUID,
                                    _token: $("input[name='_token']").val(),
                                },
                                success: function (data) {
                                    if (data) {
                                        getCart();
                                    }
                                },
                            });
                        }
                    });

                    $("#update__btn").on("click", () => {
                        $.ajax({
                            type: "PUT",
                            url: "/cart/update-to-cart",
                            data: {
                                cartData: cart,
                                _token: $("input[name='_token']").val(),
                            },
                            success: function (data) {
                                if (data) {
                                    getCart();
                                    $("#modal-susccess").modal("show");
                                    setTimeout(() => {
                                        $("#modal-susccess").modal("hide");
                                    }, 2000);
                                }
                            },
                        });
                    });
                } else {
                    $("#update__btn").css("display", "none");
                    $("#cart__total-box").css("display", "none");
                    html = `<tr><td colspan="4"><h5 class="text-center">Giỏ hàng của bạn còn trống</h5></td></tr>`;
                    $("#cart-list").html(html);
                }
            },
        });
    }
    getCart();

    $(".add-to-cart").click(function () {
        let product_id = $(this).data("product");
        let product_size = $("input[name='size']:checked").val();
        let product_color = $("input[name='color']:checked").val();
        let product_quantity = $("#product_quantity").val();
        let product_cover = $("#cover").val();
        let product_price = $("#price").val();
        let product_slug = $("#slug").val();
        $.ajax({
            type: "POST",
            url: "/cart/add-to-cart",
            data: {
                product_id,
                product_size,
                product_color,
                product_quantity,
                product_cover,
                product_price,
                product_slug,
                _token: $("input[name='_token']").val(),
            },
            success: function (data) {
                if (data) {
                    $("#modal-susccess").modal("show");
                    getCart();
                    setTimeout(() => {
                        $("#modal-susccess").modal("hide");
                    }, 2000);
                }
            },
        });
    });
    $("#place_order").click(function (event) {
        let fullName = $("#fullname").val();
        let phone = $("#phone").val();
        let email = $("#email").val();
        let country = $("#country").val();
        let address = $("#address").val();
        let townCity = $("#townCity").val();
        let countryState = $("#countryState").val();
        let postcodeZIP = $("#postcodeZIP").val();
        let notes = $("#notes").val();

        let fullNameErr = $("#fullname-err");
        let phoneErr = $("#phone-err");
        let emailErr = $("#email-err");
        let countryErr = $("#country-err");
        let addressErr = $("#address-err");
        let townCityErr = $("#townCity-err");
        let countryStateErr = $("#countryState-err");
        let postcodeZIPErr = $("#postcodeZIP-err");
        let validate = false;
        console.log(
            fullName,
            phone,
            email,
            country,
            address,
            townCity,
            countryState,
            postcodeZIP,
            notes
        );
        // Kiểm tra mỗi trường
        if (fullName === "") {
            fullNameErr.text("Vui lòng nhập họ và tên.");
        } else {
            fullNameErr.css("display", "none");
        }

        // Kiểm tra số điện thoại theo định dạng (ví dụ: +1234567890)
        if (!isValidPhoneNumber(phone)) {
            phoneErr.text(
                "Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại theo định dạng +1234567890."
            );
        } else {
            phoneErr.css("display", "none");
            validate = true;
        }

        if (email === "" || !isValidEmail(email)) {
            emailErr.text("Vui lòng nhập địa chỉ email hợp lệ.");
        } else {
            emailErr.css("display", "none");
            validate = true;
        }

        if (country === "") {
            countryErr.text("Vui lòng nhập quốc gia.");
        } else {
            countryErr.css("display", "none");
            validate = true;
        }

        if (address === "") {
            addressErr.text("Vui lòng nhập địa chỉ.");
        } else {
            addressErr.css("display", "none");
            validate = true;
        }

        if (townCity === "") {
            townCityErr.text("Vui lòng nhập thị trấn hoặc thành phố.");
        } else {
            townCityErr.css("display", "none");
            validate = true;
        }

        if (countryState === "") {
            countryStateErr.text("Vui lòng nhập quận hoặc tỉnh.");
        } else {
            countryStateErr.css("display", "none");
            validate = true;
        }

        if (postcodeZIP === "") {
            postcodeZIPErr.text("Vui lòng nhập mã bưu điện / ZIP.");
        } else {
            postcodeZIPErr.css("display", "none");
            validate = true;
        }
        if (validate == false) {
            event.preventDefault();
        }
    });
    function isValidPhoneNumber(phone) {
        // Kiểm tra số điện thoại theo định dạng +1234567890
        return /^\+\d{10}$/.test(phone);
    }

    function isValidEmail(email) {
        // Hàm kiểm tra tính hợp lệ của địa chỉ email, bạn có thể sử dụng biểu thức chính quy hoặc thư viện kiểm tra email.
        // Ở đây, chúng tôi kiểm tra địa chỉ email chỉ đơn giản.
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
    }
})(jQuery);
