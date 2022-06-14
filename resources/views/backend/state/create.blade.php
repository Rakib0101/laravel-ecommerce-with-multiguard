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
                    <h3 class="box-title">Add State</h3>
                    <a href="{{route('admin.district.index')}}" class="btn btn-primary" style="float:right;">Back to Division List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.state.store')}}" method="POST">
                        @csrf
                        <div class="form-group col-12">
                            <h5>Select Division <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <select name="division_id" id=""  class="form-control">
                                    <option value="0" disable style="display:none">All Select</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{$item->id}}">{{$item->division_name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('division_id')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>Select District <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <select name="district_id" id=""  class="form-control">
                                    <option value="0" disable style="display:none">All Select</option>
                                    @foreach ($districts as $item)
                                        <option value="{{$item->id}}">{{$item->district_name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('district_id')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-12">
                            <h5>State Name <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="state_name" class="form-control">
                                @error('state_name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Add District"> 
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
        $('select[name="division_id"]').on('change', function () {
            var division_id = $(this).val();
            console.log(division_id);
            if (division_id) {
                $.ajax({
                    url: "{{  url('/district/ajax') }}/" + division_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        console.log(data);
                        var d = $('select[name="district_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="district_id"]').append(
                                '<option value="' + value.id + '">' + value
                                .district_name + '</option>');
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

    });

</script>
