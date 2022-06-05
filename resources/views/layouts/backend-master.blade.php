<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('backend/images/favicon.ico') }}">

    <title>RIN-eshop | Dashboard</title>
    
	<!-- Vendors Style-->
	<link rel="stylesheet" href="{{ asset('backend/css/vendors_css.css') }}">
	  
	<!-- Style-->  
	<link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/skin_color.css') }}">
	<link rel="stylesheet" href="{{ asset('backend/css/fontawesome.min.css') }}">

	{{-- Toaster Style --}}
	<link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
     
  </head>

<body class="hold-transition dark-skin sidebar-mini theme-primary fixed">
	
<div class="wrapper">
@include('layouts.inc.backend.header')
  
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.inc.backend.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('layouts.inc.backend.footer')
 <!-- Vendor JS -->
  <script src="{{ asset('backend/js/vendors.min.js') }}"></script>
  <script src="{{ asset('assets/icons/feather-icons/feather.min.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/easypiechart/dist/jquery.easypiechart.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/apexcharts-bundle/irregular-data-series.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/apexcharts-bundle/dist/apexcharts.js') }}"></script>
  <script src="{{ asset('assets/vendor_components/datatable/datatables.min.js') }}"></script>
	<script src="{{ asset('backend/js/pages/data-table.js')}}"></script>

  <!-- Sunny Admin App -->
  <script src="{{ asset('backend/js/template.js') }}"></script>
  <script src="{{ asset('backend/js/pages/dashboard.js') }}"></script>

  {{-- Toaster Js --}}
  <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
  <script>
      @if(Session::has('message'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true
      }
      toastr.success("{{ session('message') }}");
      @endif

      @if(Session::has('error'))
      toastr.options = {
          "closeButton": true,
          "progressBar": true
      }
      toastr.error("{{ session('error') }}");
      @endif

  </script>

  </body>

  </html>