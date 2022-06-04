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
                <div class="profile-navbar bg-info" style="padding: 10px 20px;">
                    <ul class="">
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="">Dashboard</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{  route('user.edit') }}">Profile Update</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="">Change Password</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form">
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <h4>Welcome Mr {{Auth::user()->name}} to your dashboard !!</h4>
                <div style="background: #0f0f23; color: #fff; padding: 20px; margin-bottom: 30px;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div style="text-align:center;">
                        <h3 class="widget-user-username">Mr {{Auth::user()->name}}</h3>
                        <h6 class="widget-user-desc">{{Auth::user()->email}}</h6>

                    </div>
                    <div style="text-align:center;">
                        <img style="border-radius:50%; width:80px; height: 80px;" src="{{ ($user->image) ? asset('uploads/user/'.$user->image) :asset('backend/images/user3-128x128.jpg')  }}">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">12K</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 br-1 bl-1">
                                <div class="description-block">
                                    <h5 class="description-header">550</h5>
                                    <span class="description-text">FOLLOWERS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">158</h5>
                                    <span class="description-text">TWEETS</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
