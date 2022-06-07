@extends('layouts.backend-master')
@section('content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Data Tables</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Tables</li>
                        <li class="breadcrumb-item active" aria-current="page">Data Tables</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Add Brand</h3>
                    <a href="{{route('admin.slider.index')}}" class="btn btn-primary" style="float:right;">Back to
                        Slider List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.slider.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12">
                            <h5>Title <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="title" class="form-control">
                                @error('title')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>
                                Sub Title
                                <span class="text-danger">
                                    *
                                </span> </h5>
                            <div class="controls">
                                <input type="text" name="sub_title" class="form-control">
                                @error('sub_title')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>
                                Brand
                                Image <span class="text-danger">
                                    *
                                </span></h5>
                            <div class="controls">
                                <input type="file" name="slider_image" class="form-control">
                                @error('slider_image')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>Status <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="checkbox" id="featured" name="status" aria-invalid="false" value="1">
                                <label for="featured">(do you want to show, then click pruiohcekbox !)qwe</label>
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Add Brand">
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
