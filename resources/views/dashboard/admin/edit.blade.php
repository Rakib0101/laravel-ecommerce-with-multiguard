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
                                Profile Edit </li>
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
                <h4 class="box-title"> Edit Profile </h4>
            </div>
            <!--/.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form action="{{  route('admin.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <h5>Name <span class="text-danger"> * </span> </h5>
                                            <div class="controls">
                                                <input type="text" name="name" class="form-control" required data -
                                                    validation - required - message="This field is required"
                                                    value="{{$admin->name}}">
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
                                                    value="{{$admin->email}}">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <h5>
                                                Profile
                                                Image </h5>
                                            <div class="controls">
                                                <input id="inputImage" type="file" name="image" class="form-control"
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <img id="showImage" src="{{ !empty($admin->image) ? asset('uploads/admin/'.$admin->image): asset('backend/images/avatar/avatar-1.png') }}"
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
