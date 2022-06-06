@extends('layouts.backend-master')
@section('script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
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
                    <h3 class="box-title">Add Child Category</h3>
                    <a href="{{route('admin.brands.index')}}" class="btn btn-primary" style="float:right;">Back to Child Category List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.child_category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group col-12">
                            <h5>Select Parent Category <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <select name="category_id" id=""  class="form-control">
                                    <option value="0" disable style="display:none">All Select</option>
                                    @foreach ($categories as $item)
                                        <option value="{{$item->id}}">{{$item->category_name_en}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('category_id')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>Select Sub Category <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <select name="sub_category_id" id=""  class="form-control">
                                    <option value="0" disable style="display:none">All Select</option>
                                    {{-- @foreach ($sub_categories as $item) --}}
                                        {{-- <option value=""> --}}
                                            {{-- {{$item->sub_category_name_en}} --}}
                                        {{-- </option>
                                    @endforeach --}}
                                    
                                </select>
                                @error('sub_category_id')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>Sub Category Name (English) <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="child_category_name_en" class="form-control">
                                @error('category_name_en')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>
                                Category Name (Bangla)
                                <span class="text-danger">
                                    *
                                </span> </h5>
                            <div class="controls">
                                <input type="text" name="child_category_name_bn" class="form-control">
                                @error('category_name_bn')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>
                                Category
                                Image <span class="text-danger">
                                    *
                                </span></h5>
                            <div class="controls">
                                <input type="file" name="child_category_image" class="form-control">
                                @error('category_image')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Add Sub  Category"> 
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
@section('script-footer')
    <script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            console.log(category_id);
            if (category_id) {
                $.ajax({
                    url: "{{  url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var d = $('select[name="sub_category_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="sub_category_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .sub_category_name_en + '</option>');
                        });
                    },
                    error: function (data){
                        console.log('Hi');
                        console.log(data);
                    }
                });
            } else {
                alert('danger');
            }
        });
        // $('select[name="sub_category_id"]').on('change', function () {
        //     var sub_category_id = $(this).val();
        //     if (sub_category_id) {
        //         $.ajax({
        //             url: "{{  url('/category/sub-subcategory/ajax') }}/" + sub_category_id,
        //             type: "GET",
        //             dataType: "json",
        //             success: function (data) {
        //                 var d = $('select[name="child_category_id"]').empty();
        //                 $.each(data, function (key, value) {
        //                     $('select[name="child_category_id"]').append(
        //                         '<option value="' + value.id + '">' + value
        //                         .child_category_name_en + '</option>');
        //                 });
        //             },
        //         });
        //     } else {
        //         alert('danger');
        //     }
        // });

    });

</script>
@endsection