function formatNumber(number) {
    if (typeof number != 'number') {
        number = parseFloat(number)
    }
    return number.toLocaleString('vi-VN', {
        style: 'currency',
        currency: 'VND'
    });
}

function calcSale(price, sale) {
    let percent = (100 - sale) / 100;
    return percent * price
}
// Favourites
function addToFavourite(productID) {
    $.ajax({
        url: '/add-to-favourite',
        method: "post",
        data: {
            id: productID,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {

            let content = $('#content-notice')
            if (data) {
                $('#icon-yes').css('display', 'block');
                $('#icon-no').css('display', 'none');
                content.text('Add successful favorites')
                $('#modalNotice').modal('show')
                getFavourites()
            } else {
                $('#icon-no').css('display', 'block');
                $('#icon-yes').css('display', 'none');
                content.text('Add favorites failed')
                $('#modalNotice').modal('show')
            }
        },
        error: function(err) {
            if (err.status == 401) {
                window.location.href = "login"
            }
        }
    })
}

function removeFromFavourite(productID) {
    if (confirm("Are you sure you want to delete ?") == true) {
        $.ajax({
            url: '/remove-from-favourite',
            method: "delete",
            data: {
                id: productID,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                let content = $('#content-notice')
                if (data) {
                    $('#icon-yes').css('display', 'block');
                    $('#icon-no').css('display', 'none');
                    content.text('Successful deletion')
                    $('#modalNotice').modal('show')
                    getFavourites()
                } else {
                    $('#icon-no').css('display', 'block');
                    $('#icon-yes').css('display', 'none');
                    content.text('Deletion failed')
                    $('#modalNotice').modal('show')
                }
            },
            error: function(err) {
                if (err.status == 401) {
                    window.location.href = "login"
                }
            }
        })
    }
}

function getFavourites() {
    $.ajax({
        url: '/get-favourite',
        method: "get",
        success: function(data) {
            if (data) {
                $('#favourite-length').text(data.length);
                let propertyGallery = $('#property__gallery');
                if (data.length > 0) {
                    let html = '';
                    data.forEach(item => {
                        html += `<div class="col-lg-3 col-md-4 col-sm-6 mix ${item.product.category.slug}">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="${item.product.images.split(",")[0]}" style="background-image: url(&quot;${item.product.images.split(",")[0]}&quot;);">
                    <ul class="product__hover">
                        <li><a href="${item.product.images.split(",")[0]}" class="image-popup"><span
                                    class="arrow_expand"></span></a></li>
                        <li>
                            <a href="javascript:void(0)"
                                onclick="removeFromFavourite(${item.product.id})"><span
                                    class="icon_close"></span></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a
                            href="/shop/${item.product.slug}">${item.product.name}</a>
                    </h6>
                  
                    ${
                        item.product.sale ? `<div class='product__price'>${item.product.priceNew} đ  <span> ${item.product.priceOld}
                            đ</span>`:` <div class="product__price">${item.product.priceOld}  đ
                    </div>`
                    }

                </div>
            </div>
            </div>
        </div>`
                    });

                    propertyGallery.html(html);
                    $('.image-popup').magnificPopup({
                        type: 'image'
                    });

                } else {
                    propertyGallery.html(`<div class="col-12 pt-5 pb-5">

<h4 class="text-center"><strong> Empty favorites</strong></h4>
</div>`)
                }
            }
        }
    })
}
getFavourites()
// Favourites
// Cart
$('#add__to_cart').on('click', function() {
    let size = $('input[name="size__radio"]:checked').val();
    let color = $('input[name="color__radio"]:checked').val();
    let quantity = $('input[name="quantity"]').val();
    let productID = $('input[name="product_id"]').val();
    $.ajax({
        url: '/add-to-cart',
        method: "post",

        data: {
            size,
            color,
            quantity,
            productID,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function(data) {

            let content = $('#content-notice')
            if (data) {
                $('#icon-yes').css('display', 'block');
                $('#icon-no').css('display', 'none');
                content.text('Add successful cart')
                $('#modalNotice').modal('show')
                getCart()
            } else {
                $('#icon-no').css('display', 'block');
                $('#icon-yes').css('display', 'none');
                content.text('Add cart failed')
                $('#modalNotice').modal('show')
            }
        },
        error: function(err) {
            if (err.status == 401) {
                window.location.href = "login"
            }
        }
    })
})

function getCart() {
    $.ajax({
        url: '/get-cart',
        method: "get",
        success: function(cart) {
            $('#cart-length').text(cart.length);

            if (cart.length > 0) {

                function cartTotal(cart) {
                    let total = cart.reduce(function(total, item) {
                        if (item.product.sale > 0) {
                            return (calcSale(item.product.price, item.product.sale) * item
                                .quantity) + total;
                        } else {
                            return (item.product.price * item.quantity) + total
                        }
                    }, 0)
                    $('#cart_total').text(formatNumber(total))
                }
                $('#update_cart').css('display', 'inline-block');
                $('#process_to_checkout').css('display', 'block');
                let displayCart = $('#cart');
                let html = '';
                cart.forEach(item => {
                    html += `<tr>
                            <td class="cart__product__item">
                                <img src="${item.product.images.split(",")[0]}" width="100px" height="100px" style="object-fit:contain" alt="image">
                                <div class="cart__product__item__title">
                                    <h6><a href="/shop/${item.product.slug}" style="color:inherit" title="${item.product.name}">${item.product.name}</a></h6>
                                    <p class="mb-0">Size: ${item.size}</p>
                                    <p class="d-flex align-items-center"><span>Color:</span> <span
                                            class="ml-2 d-block"
                                            style="width: 15px; height:15px;border-radius:2px;background:${item.color.split("-")[1]}"></span>
                                    </p>
                                </div>
                            </td>
                            ${item.product.sale > 0 ? `<td class="cart__price">${formatNumber( calcSale(item.product.price,item.product.sale))}  <del class="text-secondary">${formatNumber(item.product.price)}</del></td>
                            `:`<td class="cart__price"> ${formatNumber(item.product.price)}</td>`}
                            <td class="cart__quantity">
                                <div class="pro-qty">
                                    <input type="text" value="${item.quantity}"name="quantity">
                                    <input type="hidden" value="${item.id}" name="cartID">
                                </div>
                            </td>
                            ${
                                item.product.sale > 0 ? `<td class="cart__total " id="cart__total-${item.id}">${formatNumber( item.quantity* calcSale(item.product.price,item.product.sale))}</td>`:
                                `<td class="cart__total" id="cart__total-${item.id}">${formatNumber(item.quantity*item.product.price)}</td>`
                            }
                            
                            <td class="cart__close"><span class="icon_close" onclick="deleteProductFromCart(${item.id})"></span></td>
                        </tr>`
                });
                displayCart.html(html);
                let proQty = $('.pro-qty');
                proQty.prepend('<span class="dec qtybtn">-</span>');
                proQty.append('<span class="inc qtybtn">+</span>');
                proQty.on('click', '.qtybtn', function() {
                    var $button = $(this);

                    var oldValue = $button.parent().find('input[name="quantity"]').val();
                    var cartID = $button.parent().find('input[name="cartID"]').val()
                    let cartTotal = $('#cart__total-' + cartID)
                    var productIndex = cart.findIndex(item => item.id == cartID)

                    if ($button.hasClass('inc')) {
                        var newVal = parseFloat(oldValue) + 1;
                        cart[productIndex].quantity = newVal;
                        cartTotal.text(cart[productIndex].product.sale > 0 ? formatNumber(
                            newVal * calcSale(cart[productIndex].product.price, cart[
                                productIndex].product.sale)) : formatNumber(cart[
                            productIndex].product.price * newVal));
                    } else {
                        // Don't allow decrementing below zero
                        if (oldValue >= 1) {
                            var newVal = parseFloat(oldValue) - 1;
                            cart[productIndex].quantity = newVal;
                            cartTotal.text(cart[productIndex].product.sale > 0 ? formatNumber(
                                newVal * calcSale(cart[productIndex].product.price,
                                    cart[productIndex].product.sale)) : formatNumber(
                                cart[productIndex].product.price * newVal));
                        } else {

                            newVal = 0;
                        }
                    }
                    
                    $button.parent().find('input[name="quantity"]').val(newVal);
                });
                // Update cart
                $('#update_cart').on('click', function() {
                    $.ajax({
                        url: '/update-cart',
                        method: "put",
                        data: {
                            cart,
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            let content = $('#content-notice')
                            if (data) {
                                $('#icon-yes').css('display', 'block');
                                $('#icon-no').css('display', 'none');
                                content.text('Cart updated successfully')
                                $('#modalNotice').modal('show')
                                cartTotal(cart)
                            } else {
                                $('#icon-no').css('display', 'block');
                                $('#icon-yes').css('display', 'none');
                                content.text('Cart update failed')
                                $('#modalNotice').modal('show')
                            }
                        },
                        error: function(err) {
                            if (err.status == 401) {
                                window.location.href = "login"
                            }
                        }
                    })
                })

                cartTotal(cart)
            } else {
                $('#process_to_checkout').css('display', 'none');
                $('#cart').html(
                    '<tr><td colspan="5" class="text-center"><strong>Empty Cart</strong></td></tr>')
            }

        }
    })
}



function deleteProductFromCart(cartID) {
    if (confirm("Are you sure you want to delete ?") == true) {
        $.ajax({
            url: '/remove-from-cart',
            method: "delete",
            data: {
                id: cartID,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                let content = $('#content-notice')
                if (data) {
                    getCart()
                    $('#icon-yes').css('display', 'block');
                    $('#icon-no').css('display', 'none');
                    content.text('Successful deletion')
                    $('#modalNotice').modal('show')
                } else {
                    $('#icon-no').css('display', 'block');
                    $('#icon-yes').css('display', 'none');
                    content.text('Deletion failed')
                    $('#modalNotice').modal('show')
                }
            },
            error: function(err) {
                if (err.status == 401) {
                    window.location.href = "login"
                }
            }
        })
    }
}
getCart()
$('#order').on('click',function(){
    let full_name = $('#full_name').val();
    let email = $('#email').val();
    let phone_number = $('#phone_number').val();
    let address = $('#address').val();
    let notes = $('#notes').val();

    let err_full_name = $('#err_full_name');
    let err_email = $('#err_email');
    let err_phone_number = $('#err_phone_number');
    let err_address = $('#err_address');

    $.ajax({
            url: '/place-order',
            method: "post",
            data: {
                full_name,email,address,notes,phone_number,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                let content = $('#content-notice')
                if (data) {
                    getCart()
                    $('#icon-yes').css('display', 'block');
                    $('#icon-no').css('display', 'none');
                    content.text('Successful order')
                    $('#modalNotice').modal('show')
                    setTimeout(() => {
                        window.location = "/shop";
                    }, 3000);
                } else {
                    $('#icon-no').css('display', 'block');
                    $('#icon-yes').css('display', 'none');
                    content.text('Failed order')
                    $('#modalNotice').modal('show')
                }
            },
            error: function(err) {

             if (err.responseJSON.errors?.full_name) {
                err_full_name.text(err.responseJSON.errors.full_name[0])
             }
             else{
                err_full_name.text("")
             }

             if (err.responseJSON.errors?.address) {
                err_address.text(err.responseJSON.errors.address[0])
             }
             else{
                err_address.text("")
             }
             if (err.responseJSON.errors?.email) {
                err_email.text(err.responseJSON.errors.email[0])
             }
             else{
                err_email.text("")
             }
             if (err.responseJSON.errors?.phone_number) {
                err_phone_number.text(err.responseJSON.errors.phone_number[0])
             }
             else{
                err_phone_number.text("")
             }
            
            }
        })
})
