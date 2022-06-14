<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="author" content="">
    <meta name="keywords" content="MediaCenter, Template, eCommerce">
    <meta name="robots" content="all">
    <title>RIN-eshop | Its make shop easy</title>

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <!-- CSS only -->



    <!-- Customizable CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/owl.transitions.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/rateit.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap-select.min.css') }}">

    <!-- Icons/Glyphs -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/font-awesome.css') }}">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800'
        rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
</head>

<body class="cnt-home">

    {{-- header --}}
    @include('layouts.inc.frontend.header')

    {{-- main content --}}
    @yield('content')

    {{-- footer --}}
    @include('layouts.inc.frontend.footer')

    {{-- @include('frontend.modal.add-to-cart') --}}

    <!-- JavaScripts placed at the end of the document so the pages load faster -->
    <script src="{{ asset('frontend/assets/js/jquery-1.11.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-hover-dropdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/echo.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.easing-1.3.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.rateit.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/lightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scripts.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>




    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        // Start Product View with Modal 
        function productView(id) {
            // alert(id)
            $.ajax({
                type: 'GET',
                url: '/product/view/modal/' + id,
                dataType: 'json',
                success: function (data) {
                    console.log(data)
                    $('#pname').text(data.product.product_name_en);
                    $('#price').text(data.product.selling_price);
                    $('#pcode').text(data.product.product_code);
                    $('#pcategory').text(data.product.category.category_name_en);
                    $('#pbrand').text(data.product.brand.brand_name_en);
                    $('#pimage').attr('src', data.product.product_thambnail);
                    // $('#product_id').attr('value', data.product.id);
                    // // Color
                    $('select[name="color"]').empty();
                    $.each(data.color, function (key, value) {
                        $('select[name="color"]').append('<option value=" ' + value + ' ">' +
                            value + ' </option>')
                    }) // end color
                    // Size
                    $('select[name="size"]').empty();
                    $.each(data.size, function (key, value) {
                        $('select[name="size"]').append('<option value=" ' + value + ' ">' + value +
                            ' </option>')
                        if (data.size == "") {
                            $('#sizeArea').hide();
                        } else {
                            $('#sizeArea').show();
                        }
                    }) // end size

                    // Product Price 
                    if (data.product.discount_price == null) {
                        $('#pprice').text('');
                        $('#oldprice').text('');
                        $('#pprice').text(data.product.selling_price);
                    } else {
                        $('#pprice').text(data.product.discount_price);
                        $('#oldprice').text(data.product.selling_price);
                    } // end prodcut price 

                    // Start Stock opiton
                    if (data.product.product_qty > 0) {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#aviable').text('avialable');
                    } else {
                        $('#aviable').text('');
                        $('#stockout').text('');
                        $('#stockout').text('stockout');
                    } // end Stock Option 

                }
            })

        }
    </script>

    <script type="text/javascript">
        // Start Add To Cart Product 
        function addToCart() {

            var product_name = $('#pname').text();
            var id = $('#product_id').val();
            var color = $('#color option:selected').text();
            var size = $('#size option:selected').text();
            var qty = $('#qty').val();
            $.ajax({
                type: "POST",
                dataType: 'json',
                data: {
                    product_color: color,
                    size: size,
                    qty: qty,
                    product_name: product_name,
                },
                url: "/cart/data/store/" + id,
                success: function (data) {
                    console.log(data)
                    $('#closeModal').click();

                    // Start Message 
                    getCart();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                }
            })
        }
        getCart()
    </script>

    <script type="text/javascript">
        function getCart() {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart',
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                    $('#cartSubTotal').text(response.cartTotal);
                    $('#cartTotal').text(response.cartTotal);
                    $('#cartCount').text(response.cartQty);

                    var getCart = ''
                    $.each(response.carts, function (key, value) {

                        getCart += `<div class="cart-item product-summary">
                        <div class="row">
                            <div class="col-xs-4">
                            <div class="image"> <a href="detail.html"><img src="/${value.options.image}" alt=""></a> </div>
                            </div>
                            <div class="col-xs-7">
                            <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                            <div class="price"> ${value.price} * ${value.qty} </div>
                            </div>
                            <div class="col-xs-1 action"> 
                            <button type="submit" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                        </div>
                        </div>
                        <!-- /.cart-item -->
                        <div class="clearfix"></div>
                        <hr>`
                    });
                    $('#getCart').html(getCart);
                }
            });
        }

        getCart()
    </script>

    <script type="text/javascript">
        function getCartPage() {
            $.ajax({
                type: 'GET',
                url: '/cart',
                dataType: 'json',
                success: function (response) {
                    console.log(response)
                    $('#cartSubTotal').text(response.cartTotal);
                    $('#cartTotal').text(response.cartTotal);
                    // $('#cartCount').text(response.cartQty);

                    var myCart = ''
                    $.each(response.carts, function (key, value) {
                        console.log(response.carts);
                        myCart += `<tr>
					<td class="romove-item">
                        <button type="submit" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-trash"></i></button>
                    </td>
					<td class="cart-image">
						<a class="entry-thumbnail" href="detail.html">
						    <img src="/${value.options.image}" alt="">
						</a>
					</td>
					<td class="cart-product-name-info">
						<h4 class='cart-product-description'><a href="detail.html">${value.name}</a></h4>
						<div class="row">
							<div class="col-sm-4">
								<div class="rating rateit-small"></div>
							</div>
							<div class="col-sm-8">
								<div class="reviews">
									(06 Reviews)
								</div>
							</div>
						</div><!-- /.row -->
						<div class="cart-product-info">
											<span class="product-color">COLOR:<span>Blue</span></span>
						</div>
					</td>
					<td class="cart-product-edit"><a href="#" class="product-edit">Edit</a></td>
					<td class="cart-product-quantity">
						<button type="submit" class="btn btn-info btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)" >-</button> 
                            <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px; text-align:center;" >  
                            <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)" >+</button> 
		            </td>
					<td class="cart-product-sub-total"><span class="cart-sub-total-price">$ ${value.price}</span></td>
					<td class="cart-product-grand-total"><span class="cart-grand-total-price" >$ ${value.subtotal}</span></td>
				</tr>`
                    });
                    $('#myCart').html(myCart);
                }
            });
        }

        getCartPage()
    </script>

    <script type="text/javascript">
        /// cart remove Start 
        function cartRemove(rowId) {
            $.ajax({
                type: 'GET',
                url: '/product/mini/cart/remove/' + rowId,
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    getCart();
                    getCartPage();
                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }

        //  end cart remove 
    </script>

    <script type="text/javascript">
        // add wishlist
        function wishlist(id) {
            // console.log(id);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + id,
                success: function (data) {
                    console.log(data);

                    // Start Message 
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            });
        }
        // wishlist();

        // -------- CART INCREMENT --------//
        function cartIncrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-increment/" + rowId,
                dataType: 'json',
                success: function (data) {
                    getCartPage();
                    getCart();
                }
            });
        }
        // ---------- END CART INCREMENT -----///

        // -------- CART DECREMENT --------//
        function cartDecrement(rowId) {
            $.ajax({
                type: 'GET',
                url: "/cart-decrement/" + rowId,
                dataType: 'json',
                success: function (data) {
                    getCartPage();
                    getCart();
                }
            });
        }
        // ---------- END CART DECREMENT -----///
    </script>

</body>

</html>