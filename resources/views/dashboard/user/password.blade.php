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
                    <form action="{{  route('user.update-password') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <h5>Current Password <span class="text-danger"> * </span> </h5>
                                        <div class="controls">
                                            <input type="password" name="oldpassword" class="form-control" required data -
                                                validation - required - message="This field is required">
                                                <span class="text-danger">@error('oldpassword'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>
                                            New Password
                                            <span class="text-danger">
                                                *
                                            </span> </h5>
                                        <div class="controls">
                                            <input type="password" name="password" class="form-control" required data -
                                                validation - required - message="This field is required"
                                                >
                                            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>
                                            Confirm Password
                                            <span class="text-danger">
                                                *
                                            </span> </h5>
                                        <div class="controls">
                                            <input type="password" name="cpassword" class="form-control" required data -
                                                validation - required - message="This field is required">
                                            <span class="text-danger">@error('cpassword'){{ $message }}@enderror</span>
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
