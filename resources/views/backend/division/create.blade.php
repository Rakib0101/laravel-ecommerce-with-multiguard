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
                    <h3 class="box-title">Add Division</h3>
                    <a href="{{route('admin.division.index')}}" class="btn btn-primary" style="float:right;">Back to Division List</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <form action="{{ route('admin.division.store')}}" method="POST">
                        @csrf
                        <div class="form-group col-12">
                            <h5>Division Name <span class="text-danger"> * </span> </h5>
                            <div class="controls">
                                <input type="text" name="division_name" class="form-control">
                                @error('division_name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="text-xs-right">
                            <input type="submit" class="btn btn-rounded btn-info" value="Add Division"> 
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
