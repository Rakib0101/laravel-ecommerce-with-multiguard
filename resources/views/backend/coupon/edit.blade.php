@extends('layouts.backend-master')
@section('content')


<!-- Content Wrapper. Contains page content -->

<div class="container-full">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="row">

            <!--   ------------ Add Coupon Page -------- -->


            <div class="col-12">

                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Coupon </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <form method="post" action="{{ route('admin.coupon.update',$coupon->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <h5>Coupon Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="coupon_code" class="form-control"
                                            value="{{ $coupon->coupon_code }}">
                                        @error('coupon_code')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Coupon Discount(%) <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="discount_value" class="form-control"
                                            value="{{ $coupon->discount_value }}">
                                        @error('discount_value')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group">
                                    <h5>Coupon Validity Date <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="date" name="validity" class="form-control"
                                            min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"
                                            value="{{ $coupon->validity }}">
                                        @error('validity')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                                <div class="text-xs-right">
                                    <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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