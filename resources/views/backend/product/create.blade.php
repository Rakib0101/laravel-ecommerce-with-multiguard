@extends('layouts.backend-master')
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')

<div class="container-full">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        <!-- Basic Forms -->
        <div class="box">
            <div class="box-header with-border">
                <h4 class="box-title">Add Product </h4>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col">
                        <form method="post" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <!-- start 1st row  -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="category_id" class="form-control">
                                                        <option value="" selected="" disabled="">Select Category
                                                        </option>
                                                        @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">
                                                            {{ $category->category_name_en }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->


                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="sub_category_id" class="form-control">
                                                        <option value="" selected="" disabled="">Select SubCategory
                                                        </option>

                                                    </select>
                                                    @error('sub_category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                        <div class="col-md-4">

                                            <div class="form-group">
                                                <h5>Child Category Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="child_category_id" class="form-control">
                                                        <option value="" selected="" disabled="">Select SubCategory
                                                        </option>

                                                    </select>
                                                    @error('child_category_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div> <!-- end col md 4 -->

                                    </div> <!-- end 1st row  -->

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Brand Select <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <select name="brand_id" class="form-control">
                                                        <option value="" selected="" disabled="">Select Brand</option>
                                                        @foreach($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('brand_id')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name (English) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_en" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Name (Bangla) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_name_bn" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    {{-- end 2nd row --}}

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Code <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_code" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags (Bangla) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_en" value="Lorem,Ipsum,Amet"
                                                        data-role="tagsinput" placeholder="add tags"
                                                        style="display: none;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Tags (Bangla) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_tags_bn" value="Lorem,Ipsum,Amet"
                                                        data-role="tagsinput" placeholder="add tags"
                                                        style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Quantity <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_qty" class="form-control">
                                                </div>
                                            </div>

                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size (english) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_en"
                                                        value="Large, Medium, Small" data-role="tagsinput"
                                                        placeholder="add tags" style="display: none;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Size (Bangla) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_size_bn" value="XXL, XL, L, M, S"
                                                        data-role="tagsinput" placeholder="add tags"
                                                        style="display: none;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color (english) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_en" value="Red, Black, White"
                                                        data-role="tagsinput" placeholder="add tags"
                                                        style="display: none;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Product Color (Bangla) <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="text" name="product_color_bn"
                                                        value="White, Black , Red" data-role="tagsinput"
                                                        placeholder="add tags" style="display: none;">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Regular Price <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="regular_price"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5>Selling Price <span class="text-danger">*</span></h5>
                                                        <div class="controls">
                                                            <input type="text" name="selling_price"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12 row">
                                            <div class="form-group col-6">
                                                <h5>Product Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="product_thambnail" class="form-control"
                                                        onChange="mainThamUrl(this)">
                                                    @error('product_thambnail')
                                                    <span class="text-danger">{{ $message }}</span>
                                                    @enderror

                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <img src="" id="mainThmb">
                                            </div>
                                        </div>
                                        <div class="col-12 row">
                                            <div class="form-group col-6">
                                                <h5>Product Galleries </h5>
                                                <div class="controls">
                                                    <input type="file" name="product_galleries[]" class="form-control"
                                                        multiple="" id="multiImg">
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                            <div class="row col-6" id="preview_img"></div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description (English)<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_en" id="textarea" class="form-control"
                                                        placeholder="Textarea text"></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Short Description (Bangla)<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea name="short_descp_bn" id="textarea" class="form-control"
                                                        placeholder="Textarea text"></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Long Description (English)<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor1" name="long_descp_en" id="textarea"
                                                        class="form-control" placeholder="Textarea text"></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <h5>Long Description (Bangla)<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <textarea id="editor2" name="long_descp_bn" id="textarea"
                                                        class="form-control" placeholder="Textarea text"></textarea>
                                                    <div class="help-block"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Featured <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="checkbox" id="featured"  name="featured"
                                                        aria-invalid="false" value="1">
                                                    <label for="featured">Check this custom checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Hot Deals <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="checkbox" id="hot_deals" name="hot_deals"
                                                        aria-invalid="false" value="1">
                                                    <label for="hot_deals">Check this custom checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Special Offer <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="checkbox" id="sp_offers" name="special_offer"
                                                         aria-invalid="false" value="1">
                                                    <label for="sp_offers">Check this custom checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Special Deals<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="checkbox" id="sp_deals" name="special_deals" aria-invalid="false" value="1">
                                                    <label for="sp_deals">Check this custom checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <h5>Status <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="checkbox" id="status" name="status"
                                                        aria-invalid="false" value="1">
                                                    <label for="status">Check this custom checkbox</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-xs-right">
                                        <input type="submit" class="btn btn-rounded btn-info" value="Add Product">
                                    </div>
                                </div>

                            </div>
                        </form>

                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->
</div>

@endsection
@section('script-footer')
<script type="text/javascript">
    $(document).ready(function () {
        $('select[name="category_id"]').on('change', function () {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: "{{  url('/subcategory/ajax') }}/" + category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="child_category_id"]').html('');
                        var d = $('select[name="sub_category_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="sub_category_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .sub_category_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });
        $('select[name="sub_category_id"]').on('change', function () {
            var sub_category_id = $(this).val();
            if (sub_category_id) {
                $.ajax({
                    url: "{{  url('/sub-subcategory/ajax') }}/" + sub_category_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        var d = $('select[name="child_category_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="child_category_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .child_category_name_en + '</option>');
                        });
                    },
                });
            } else {
                alert('danger');
            }
        });

    });

</script>

//show image for product thumb

<script type="text/javascript">
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

</script>

//show image for product Galleries

<script>
    $(document).ready(function () {
        $('#multiImg').on('change', function () { //on file input change
            if (window.File && window.FileReader && window.FileList && window
                .Blob) //check File API supported browser
            {
                var data = $(this)[0].files; //this file data

                $.each(data, function (index, file) { //loop though each file
                    if (/(\.|\/)(gif|jpe?g|png)$/i.test(file
                            .type)) { //check supported file type
                        var fRead = new FileReader(); //new filereader
                        fRead.onload = (function (file) { //trigger function on successful read
                            return function (e) {
                                var img = $('<img/>').addClass('thumb').attr('src',
                                        e.target.result).width(80)
                                    .height(80); //create image element 
                                $('#preview_img').append(
                                    img); //append image to output element
                            };
                        })(file);
                        fRead.readAsDataURL(file); //URL representing the file's data.
                    }
                });

            } else {
                alert("Your browser doesn't support File API!"); //if File API is absent
            }
        });
    });

</script>

@endsection
