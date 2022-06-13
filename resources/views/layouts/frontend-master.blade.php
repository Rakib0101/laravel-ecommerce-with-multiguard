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

    <!-- Add to Cart Product Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width: 800px;">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-4">

                            <div class="card" style="width: 24rem;">
                                <img src=" " class="card-img-top" alt="..." style="height: 150px; width: 200px;"
                                    id="pimage">
                            </div>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <ul class="list-group">
                                <li class="list-group-item">Product Price: <strong class="text-danger">$<span
                                            id="pprice"></span></strong>
                                    <del id="oldprice">$</del>
                                </li>
                                <li class="list-group-item">Product Code: <strong id="pcode"></strong></li>
                                <li class="list-group-item">Category: <strong id="pcategory"></strong></li>
                                <li class="list-group-item">Brand: <strong id="pbrand"></strong></li>
                                <li class="list-group-item">Stock: <span class="badge badge-pill badge-success"
                                        id="aviable" style="background: green; color: white;"></span>
                                    <span class="badge badge-pill badge-danger" id="stockout"
                                        style="background: red; color: white;"></span>
                                </li>
                            </ul>

                        </div><!-- // end col md -->


                        <div class="col-md-4">

                            <div class="form-group" id="sizeArea">
                                <label for="size">Choose Size</label>
                                <select class="form-control" id="size" name="size">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group" id="sizeArea">
                                <label for="color">Choose Color</label>
                                <select class="form-control" id="color" name="color">
                                    <option>1</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div> <!-- // end form group -->

                            <div class="form-group">
                                <label for="qty">Quantity</label>
                                <input type="number" class="form-control" id="qty" value="1" min="1">
                            </div> <!-- // end form group -->

                            <input type="hidden" id="product_id" value="{{$product->id}}">
                            <button type="submit" class="btn btn-primary mb-2" onclick="addToCart()">Add to
                                Cart</button>

                        </div><!-- // end col md -->


                    </div> <!-- // end row -->



                </div> <!-- // end modal Body -->

            </div>
        </div>
    </div>
    <!-- End Add to Cart Product Modal -->


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
                    $('#closeModal').click();
                    console.log(data)
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
        getCart()
        //  end cart remove 
    </script>
    <script type="text/javascript">
        // add wishlist
        function addToWishlist(product_id) {
            console.log(product_id);
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "/add-to-wishlist/" + product_id,
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
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error'
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message 
                }
            })
        }
    </script>

</body>

</html>