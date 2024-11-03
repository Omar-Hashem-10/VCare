@include('web.admin.layouts.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

@include('web.admin.layouts.header')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>

  @include('web.admin.layouts.footer')

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('web.admin.layouts.scripts')
