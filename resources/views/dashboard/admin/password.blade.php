@extends('layouts.backend-master')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"> </script>
<div class="container-full">
    <!--Content Header(Page header) -->
    <div class="content-header">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="page-title"> Profile </h3>
                <div class="d-inline-block align-items-center">
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">
                                    <i class="mdi mdi-home-outline">
                                    </i> </a> </li>
                            <li class="breadcrumb-item active" aria - current="page">
                                Change Password </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--Main content-->
    <section class="content">

        <!--Basic Forms-->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title"> Change Password </h4>
            </div>
            <!--/.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{  route('admin.update-password') }}" method="POST">
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
                    <!--/.col -->
                </div>
                <!--/.row -->
            </div>
            <!--/.box-body -->
        </div>
        <!--/.box -->

    </section>
    <!--/.content -->
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
