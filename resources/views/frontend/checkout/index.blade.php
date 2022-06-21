@extends('layouts.frontend-master')
@section('content')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="#">Home</a></li>
                <li class='active'>Checkout</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="checkout-box ">
            <div class="row">
                <div class="col-md-8">
                    <div class="panel-group checkout-steps">
                        <!-- checkout-step-01  -->
                        <div class="panel panel-default checkout-step-01">

                            <div>

                                <!-- panel-body  -->
                                <div class="panel-body">
                                    <div class="row">

                                        <!-- guest-login -->
                                        <div class="col-12 guest-login">
                                            <div class="col-12 already-registered-login">
                                                <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                                <form class="register-form row" role="form" action="{{ route('user.checkout.store') }}" method="POST">
                                                    @csrf
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="info-title"
                                                                for="exampleInputEmail1"><b>Shipping Name</b>
                                                                <span>*</span></label>
                                                            <input type="text" name="shipping_name"
                                                                class="form-control unicase-form-control text-input"
                                                                id="exampleInputEmail1" placeholder="Full Name"
                                                                value="{{ Auth::user()->name }}" required="">
                                                        </div> <!-- // end form group  -->


                                                        <div class="form-group">
                                                            <label class="info-title"
                                                                for="exampleInputEmail1"><b>Email</b>
                                                                <span>*</span></label>
                                                            <input type="email" name="shipping_email"
                                                                class="form-control unicase-form-control text-input"
                                                                id="exampleInputEmail1" placeholder="Email"
                                                                value="{{ Auth::user()->email }}" required="">
                                                        </div> <!-- // end form group  -->


                                                        <div class="form-group">
                                                            <label class="info-title"
                                                                for="exampleInputEmail1"><b>Phone</b>
                                                                <span>*</span></label>
                                                            <input type="number" name="shipping_phone"
                                                                class="form-control unicase-form-control text-input"
                                                                id="exampleInputEmail1" placeholder="Phone"
                                                                value="{{ Auth::user()->phone }}" required="">
                                                        </div> <!-- // end form group  -->


                                                        <div class="form-group">
                                                            <label class="info-title" for="exampleInputEmail1"><b>Post
                                                                    Code</b>
                                                                <span>*</span></label>
                                                            <input type="text" name="post_code"
                                                                class="form-control unicase-form-control text-input"
                                                                id="exampleInputEmail1" placeholder="Post Code"
                                                                required="">
                                                        </div> <!-- // end form group  -->
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <h5><b>Division Select </b> <span
                                                                    class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="division_id" class="form-control"
                                                                    required="">
                                                                    <option value="" selected="" disabled="">Select
                                                                        Division
                                                                    </option>
                                                                    @foreach($divisions as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->division_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                @error('division_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- // end form group -->


                                                        <div class="form-group">
                                                            <h5><b>District Select</b> <span
                                                                    class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <select name="district_id" class="form-control"
                                                                    required="">
                                                                    <option value="" selected="" disabled="">Select
                                                                        District
                                                                    </option>

                                                                </select>
                                                                @error('district_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- // end form group -->


                                                        <div class="form-group">
                                                            <h5><b>State Select</b> <span class="text-danger">*</span>
                                                            </h5>
                                                            <div class="controls">
                                                                <select name="state_id" class="form-control"
                                                                    required="">
                                                                    <option value="" selected="" disabled="">Select
                                                                        State</option>

                                                                </select>
                                                                @error('state_id')
                                                                <span class="text-danger">{{ $message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div> <!-- // end form group -->


                                                        <div class="form-group">
                                                            <label class="info-title"
                                                                for="exampleInputEmail1"><b>Notes</b>

                                                                <span>*</span></label>
                                                            <textarea class="form-control" cols="30" rows="5"
                                                                placeholder="Notes" name="notes"></textarea>
                                                        </div> <!-- // end form group  -->
                                                    </div>


                                                    <!-- checkout-progress-sidebar -->
                                                    <div class="checkout-progress-sidebar ">
                                                        <div class="panel-group">
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="unicase-checkout-title">Select Payment
                                                                        Method</h4>
                                                                </div>

                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <label for="">Stripe</label>
                                                                        <input type="radio" name="payment_method"
                                                                            value="stripe">
                                                                        <img
                                                                            src="{{ asset('frontend/assets/images/payments/4.png') }}">
                                                                    </div> <!-- end col md 4 -->

                                                                    <div class="col-md-4">
                                                                        <label for="">Card</label>
                                                                        <input type="radio" name="payment_method"
                                                                            value="card">
                                                                        <img
                                                                            src="{{ asset('frontend/assets/images/payments/3.png') }}">
                                                                    </div> <!-- end col md 4 -->

                                                                    <div class="col-md-4">
                                                                        <label for="">Cash</label>
                                                                        <input type="radio" name="payment_method"
                                                                            value="cash">
                                                                        <img
                                                                            src="{{ asset('frontend/assets/images/payments/2.png') }}">
                                                                    </div> <!-- end col md 4 -->


                                                                </div> <!-- // end row  -->


                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- checkout-progress-sidebar -->
                                                    <button type="submit"
                                                        class="btn-upper btn btn-primary checkout-page-button checkout-continue ">Continue</button>
                                                </form>
                                                <!-- radio-form  -->
                                            </div>

                                        </div>
                                    </div>
                                    <!-- panel-body  -->
                                </div>
                            </div><!-- row -->
                        </div>
                        <!-- checkout-step-01  -->

                    </div><!-- /.checkout-steps -->
                </div>
                <div class="col-md-4">
                    <!-- checkout-progress-sidebar -->
                    <div class="checkout-progress-sidebar ">
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                                </div>
                                <div class="">
                                    <ul class="nav nav-checkout-progress list-unstyled">
                                        @foreach($carts as $cart)
                                        <li>
                                            <strong>Image : </strong>
                                            <img src="{{ asset($cart->options->image) }}" alt="" style="width:50px;">
                                        </li>
                                        <li>
                                            <strong>Quantity : </strong>
                                            <span>{{ $cart->qty }}</span>
                                            <strong>Color : </strong>
                                            <span>{{ $cart->options->color }}</span>
                                            <strong>Size: </strong>
                                            <span>{{ $cart->options->size }}</span>
                                        </li>
                                        @endforeach
                                        <li>
                                            @if(Session::has('coupon'))

                                            <strong>Coupon Name : </strong>
                                            <span>{{ Session()->get('coupon')['coupon_code'] }}
                                                ({{ Session()->get('coupon')['discount_value'] }} %)
                                            </span>
                                            <hr>
                                            <strong>Discount Amount : </strong>
                                            <span>$ {{ Session()->get('coupon')['discount_amount'] }}
                                            </span>
                                            <hr>
                                            <strong>Sub Total : </strong>
                                            <span>$ {{ $cartTotal }}</span>
                                            <hr>
                                            <strong>Grand Total : </strong>
                                            <span>$ {{ Session()->get('coupon')['total_amount'] }}
                                            </span>
                                            @else
                                            <hr>
                                            <strong>Sub Total : </strong>
                                            <span>$ {{ $cartTotal }}</span>
                                            <hr>
                                            <strong>Grand Total : </strong>
                                            <span>$ {{ $cartTotal }}</span>
                                            @endif

                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- /.row -->
        </div><!-- /.checkout-box -->
        <!-- ============================================== BRANDS CAROUSEL ============================================== -->
        @include('layouts.inc.frontend.brands')
        <!-- /.logo-slider -->
        <!-- ============================================== BRANDS CAROUSEL : END ============================================== -->
    </div><!-- /.container -->
</div><!-- /.body-content -->
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="division_id"]').on('change', function () {
            var division_id = $(this).val();
            if (division_id) {
                $.ajax({
                    url: "{{  url('/district-get/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="state_id"]').empty();
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="district_id"]').on('change', function () {
            var district_id = $(this).val();
            if (district_id) {
                $.ajax({
                    url: "{{  url('/state-get/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="state_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="state_id"]').append('<option value="' +
                                value.id + '">' + value.state_name + '</option>'
                            );
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });

</script>
@endsection
