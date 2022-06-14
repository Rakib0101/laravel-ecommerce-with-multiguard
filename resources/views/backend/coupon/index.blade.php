@extends('layouts.backend-master')
@section('content')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">



            <div class="col-8">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Coupon List</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Coupon Name </th>
                                        <th>Coupon Discount</th>
                                        <th>Validity </th>
                                        <th>Status </th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($coupons as $item)
                                    <tr>
                                        <td> {{ $item->coupon_code }} </td>
                                        <td> {{ $item->discount_value }}% </td>
                                        <td> {{ Carbon\Carbon::parse($item->validity)->format('D, d F Y') }}</td>

                                        <td>
                                            @if($item->validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                            <span class="badge badge-pill badge-success"> Valid </span>
                                            @else
                                            <span class="badge badge-pill badge-danger"> Invalid </span>
                                            @endif

                                        </td>

                                        <td style="display:flex;">
                                            <a href="{{ route('admin.coupon.edit',$item->id) }}"
                                                class="btn btn-sm btn-info" title="Edit Data"><i
                                                    class="fa fa-pencil"></i> </a>
                                            <form action="{{ route('admin.coupon.destroy', $item->id) }}"
                                                class="mr-1" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger"> <i class="ti-trash"></i>
                                                </button>
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
            <!-- /.col -->


            <!--   ------------ Add Category Page -------- -->


            <div class="col-4">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Coupon </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">


                            <form method="post" action="{{ route('admin.coupon.store') }}">
                                @csrf


                                <div class="form-group">
                                    <h5>Coupon Code <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_code" class="form-control">
                                        @error('coupon_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_value" class="form-control">
                                        @error('discount_value')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="validity" class="form-control"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                        @error('validity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                                </div>
                            </form>





                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>




        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->

</div>

@endsection