<script src="{{ asset('client') }}/js/jquery-3.3.1.min.js"></script>
<script src="{{ asset('client') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('client') }}/js/jquery.magnific-popup.min.js"></script>
<script src="{{ asset('client') }}/js/jquery-ui.min.js"></script>
<script src="{{ asset('client') }}/js/mixitup.min.js"></script>
<script src="{{ asset('client') }}/js/jquery.countdown.min.js"></script>
<script src="{{ asset('client') }}/js/jquery.slicknav.js"></script>
<script src="{{ asset('client') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('client') }}/js/jquery.nicescroll.min.js"></script>
<script>
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
            error:function(err){
                if (err.status == 401) {
                    window.location.href="login"
                }
            }
        })
    }

    function removeFromFavourite(productID) {
       if (confirm("Are you sure you want to delete ?")== true) {
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
            error:function(err){
                if (err.status == 401) {
                    window.location.href="login"
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
                    }
                    else{
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
    $('#add__to_cart').on('click',function(){
       let size = $('input[name="size__radio"]:checked').val();
       let color = $('input[name="color__radio"]:checked').val();
       let quantity = $('input[name="quantity"]').val();
       let productID = $('input[name="product_id"]').val();
       $.ajax({
            url: '/add-to-cart',
            method: "post",

            data:{
                size,color,quantity,productID,_token: $('meta[name="csrf-token"]').attr('content')
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
         error:function(err){
             if (err.status == 401) {
                 window.location.href="login"
             }
         }
        })
    })
    function getCart(){
        $.ajax({
            url: '/get-cart',
            method: "get",
            success: function(data) {
                $('#cart-length').text(data.length);
            }
        })
    }
    getCart()
</script>
<script src="{{ asset('client') }}/js/main.js"></script>