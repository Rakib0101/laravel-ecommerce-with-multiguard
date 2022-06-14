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
                    <h3 class="box-title">Update State</h3>
                    <a href="{{route('admin.state.index')}}" class="btn btn-primary" style="float:right;">Back to Brand
                        List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.state.update', $state->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group col-12">
                            <h5>Select Division <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <select name="division_id" id=""  class="form-control">
                                    <option value="0" disable style="display:none">All Select</option>
                                    @foreach ($divisions as $item)
                                        <option value="{{$item->id}}" {{$item->id === $state->division_id ? 'selected': ''}}>{{$item->division_name}}</option>
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
                                        <option value="{{$item->id}}" {{$item->id === $state->district_id ? 'selected': ''}}>{{$item->district_name}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('district_id')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <h5>State Name<span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="state_name" class="form-control"
                                    value="{{$state->state_name}}">
                                @error('state_name')
                                <span class="text-danger">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Update District">
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
