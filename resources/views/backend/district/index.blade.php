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
        <div class="col-md-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Division List</h3>
                    <a href="{{route('admin.district.create')}}" class="btn btn-primary" style="float:right;">Add New
                        District</a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="example6" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Division Name</th>
                                    <th>District Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($districts as $district)

                                <tr>
                                    <td>{{$district->division->division_name}}</td>
                                    <td>{{$district->district_name}}</td>
                                    <td style="display:flex;">
                                        {{-- <a class="mr-2 btn btn-success"
                                            href="{{ route('admin.brands.show', $category->id) }}"><i
                                                class="fa fa-eye"></i></a> --}}
                                        <a class="mr-2 btn btn-primary"
                                            href="{{ route('admin.district.edit', $district->id) }}"><i
                                                class="fa fa-edit"></i></a>
                                        <form action="{{ route('admin.district.destroy', $district->id) }}" class="mr-1"
                                            method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="btn btn-danger"> <i
                                                    class="ti-trash"></i> </button>
                                        </form>
                                    </td>
                                </tr>

                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
@endsection
