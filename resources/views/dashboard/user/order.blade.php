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
                <h4>Welcome Mr {{Auth::user()->name}} to your dashboard !!</h4>
                <div style="padding: 20px; margin-bottom: 30px;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>

                                <tr style="background: #e2e2e2;">
                                    <td class="col-md-1">
                                        <label for=""> Date</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Total</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> Payment</label>
                                    </td>


                                    <td class="col-md-2">
                                        <label for=""> Invoice</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> Order</label>
                                    </td>

                                    <td class="col-md-1">
                                        <label for=""> Action </label>
                                    </td>

                                </tr>


                                @foreach($orders as $order)
                                <tr>
                                    <td class="col-md-1">
                                        <label for=""> {{ $order->order_date }}</label>
                                    </td>

                                    <td class="col-md-3">
                                        <label for=""> ${{ $order->amount }}</label>
                                    </td>


                                    <td class="col-md-3">
                                        <label for=""> {{ $order->payment_method }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for=""> {{ $order->invoice_no }}</label>
                                    </td>

                                    <td class="col-md-2">
                                        <label for="">
                                            <span class="badge badge-pill badge-warning"
                                                style="background: #418DB9;">{{ $order->status }} </span>

                                        </label>
                                    </td>

                                    <td class="col-md-1">
                                        <a href="{{ route('user.order-details', $order->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i> View</a>

                                        <a href="" class="btn btn-sm btn-danger"><i class="fa fa-download"
                                                style="color: white;"></i> Invoice </a>

                                    </td>

                                </tr>
                                @endforeach
                            </tbody>

                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
