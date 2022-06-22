@extends('layouts.frontend-master')
@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="home.html">Home</a></li>
                <li class='active'>Dashboard</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="profile-image" style="margin-bottom: 20px; text-align:center;">
                    <img style="border-radius:50%; width:150px; height: 150px;"
                        src="{{ ($user->image) ? asset('uploads/user/'.$user->image) :asset('backend/images/user3-128x128.jpg')  }}">
                </div>
                <div class="profile-navbar bg-info" style="padding: 10px 20px;">
                    <ul class="">
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.home') }}">Dashboard</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{  route('user.edit') }}">Profile Update</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.change-password') }}">Change Password</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.my-order') }}">My Orders</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <h4 style="text-align: center;">Welcome Mr {{Auth::user()->name}} to your dashboard !!</h4>
                <div class="row">
                    <div class="col-md-6 col-12">
                        <div class="box box-bordered border-primary" style="border: 1px solid #2f2f2f; border-radius: 5px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><strong>Shipping Details</strong> </h4>
                            </div>


                            <table class="table">
                                <tr>
                                    <th> Shipping Name : </th>
                                    <th> {{ $order->name }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Phone : </th>
                                    <th> {{ $order->phone }} </th>
                                </tr>

                                <tr>
                                    <th> Shipping Email : </th>
                                    <th> {{ $order->email }} </th>
                                </tr>

                                <tr>
                                    <th> Division : </th>
                                    <th> {{ $order->division->division_name }} </th>
                                </tr>

                                <tr>
                                    <th> District : </th>
                                    <th> {{ $order->district->district_name }} </th>
                                </tr>

                                <tr>
                                    <th> State : </th>
                                    <th>{{ $order->state->state_name }} </th>
                                </tr>

                                <tr>
                                    <th> Post Code : </th>
                                    <th> {{ $order->post_code }} </th>
                                </tr>

                                <tr>
                                    <th> Order Date : </th>
                                    <th> {{ $order->order_date }} </th>
                                </tr>

                            </table>



                        </div>
                    </div> <!--  // cod md -6 -->


                    <div class="col-md-6 col-12">
                        <div class="box box-bordered border-primary" style="border: 1px solid #2f2f2f; border-radius: 5px;">
                            <div class="box-header with-border">
                                <h4 class="box-title"><strong>Order Details</strong><span class="text-danger"> Invoice :
                                        {{ $order->invoice_no }}</span></h4>
                            </div>


                            <table class="table">
                                <tr>
                                    <th> Name : </th>
                                    <th> {{ $order->user->name }} </th>
                                </tr>

                                <tr>
                                    <th> Phone : </th>
                                    <th> {{ $order->user->phone }} </th>
                                </tr>

                                <tr>
                                    <th> Payment Type : </th>
                                    <th> {{ $order->payment_method }} </th>
                                </tr>

                                <tr>
                                    <th> Tranx ID : </th>
                                    <th> {{ $order->transaction_id }} </th>
                                </tr>

                                <tr>
                                    <th> Invoice : </th>
                                    <th class="text-danger"> {{ $order->invoice_no }} </th>
                                </tr>

                                <tr>
                                    <th> Order Total : </th>
                                    <th>${{ $order->amount }} </th>
                                </tr>

                                <tr>
                                    <th> Order : </th>
                                    <th>
                                        <span class="badge badge-pill badge-warning"
                                            style="background: #418DB9;">{{ $order->status }} </span> </th>
                                </tr>



                            </table>



                        </div>
                    </div> <!--  // cod md -6 -->





                    <div class="col-md-12 col-12">
                        <div class="box box-bordered border-primary" style="border: 1px solid #2f2f2f; border-radius: 20px; margin: 10px 0px;">
                            <div class="box-header with-border">

                            </div>



                            <table class="table">
                                <tbody>

                                    <tr>
                                        <td width="10%">
                                            <label for=""> Image</label>
                                        </td>

                                        <td width="20%">
                                            <label for=""> Product Name </label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> Product Code</label>
                                        </td>


                                        <td width="10%">
                                            <label for=""> Color </label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> Size </label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> Quantity </label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> Price </label>
                                        </td>

                                    </tr>


                                    @foreach($orderItem as $item)
                                    <tr>
                                        <td width="10%">
                                            <label for=""><img src="{{ asset($item->product->product_thambnail) }}"
                                                    height="50px;" width="50px;"> </label>
                                        </td>

                                        <td width="20%">
                                            <label for=""> {{ $item->product->product_name_en }}</label>
                                        </td>


                                        <td width="10%">
                                            <label for=""> {{ $item->product->product_code }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->color }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->size }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> {{ $item->qty }}</label>
                                        </td>

                                        <td width="10%">
                                            <label for=""> ${{ $item->price }} ( $ {{ $item->price * $item->qty}} )
                                            </label>
                                        </td>

                                    </tr>
                                    @endforeach





                                </tbody>

                            </table>











                        </div>
                    </div> <!--  // cod md -12 -->

                </div>
            </div>
        </div>
        @endsection
