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
                                href="">Profile Update</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="">Change Password</a></li>
                        <li style="border-bottom: 1px solid #ddd; padding:4px 0px;"><a style="font-size: 16px;"
                                href="{{ route('user.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form action="{{ route('user.logout') }}" method="post" class="d-none" id="logout-form"></form>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <h4>Welcome Mr {{Auth::user()->name}} to your dashboard !!</h4>
                <div style="background: #0f0f23; color: #fff; padding: 20px; margin-bottom: 30px;">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('user.profile_update') }}" method="POST" enctype="multipart/form-data" id="update-form">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h5>Name <span class="text-danger"> * </span> </h5>
                                        <div class="controls">
                                            <input type="text" name="name" class="form-control" required data -
                                                validation - required - message="This field is required"
                                                value="{{$user->name}}">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <h5>
                                            Email
                                            <span class="text-danger">
                                                *
                                            </span> </h5>
                                        <div class="controls">
                                            <input type="email" name="email" class="form-control" required data -
                                                validation - required - message="This field is required"
                                                value="{{$user->email}}">

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <h5>
                                            Profile
                                            Image </h5>
                                        <div class="controls">
                                            <input id="inputImage" type="file" name="image" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img id="showImage"
                                            src="{{ !empty($user->image) ? asset('uploads/user/'.$user->image): asset('backend/images/avatar/avatar-1.png') }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <button type="submit" class="btn btn-rounded btn-info">
                                Submit
                            </button> </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#inputImage').change(function (e) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#showImage').attr('src',
                    e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });

</script>
@endsection
