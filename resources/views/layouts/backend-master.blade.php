@include('layouts.inc.backend.header')
  
  <!-- Left side column. contains the logo and sidebar -->
  @include('layouts.inc.backend.sidebar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  @yield('content')
  </div>
  <!-- /.content-wrapper -->

@include('layouts.inc.backend.footer')
