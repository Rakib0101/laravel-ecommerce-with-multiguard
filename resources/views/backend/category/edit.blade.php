@extends('layouts.backend-master')
@section('content')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"> </script>
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
                    <a href="{{route('admin.category.index')}}" class="btn btn-primary" style="float:right;">Back to Brand
                        List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <h5>Brand Name (English) <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="category_name_en" class="form-control"
                                    value="{{$category->category_name_en}}">
                                @error('category_name_en')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>
                                Brand Name (Bangla)
                                <span class="text-danger">
                                    *
                                </span> </h5>
                            <div class="controls">
                                <input type="text" name="category_name_bn" class="form-control"
                                    value="{{$category->category_name_bn}}">
                                @error('category_name_bn')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>

                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <h5>
                                    Brand
                                    Image <span class="text-danger">
                                        *
                                    </span></h5>
                                <div class="controls">
                                    <input type="file" id="inputImage" name="category_image" class="form-control">
                                    @error('category_image')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <img id="showImage"
                                    src="{{ !empty($category->category_image) ? asset('uploads/brand/'.$category->category_image): asset('frontend/images/brands/brand1.png') }}"
                                    alt="">
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Update Category">
                        </div>
                    </form>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
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
