<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta content="" name="keywords">
    <meta content="" name="description">

    <title>QUẢN LÝ HỌC VIÊN</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->

    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{asset('accset/css/bootstrap.min.css') }}"> 

    <script src="{{asset('accset/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('fontawesome-free-6.5.1-web/css/all.min.css') }}">

    <!-- JQVMap -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/plugins/jqvmap/jqvmap.min.css') }}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap_fileupload/bootstrap-fileupload.min.css') }}">
    <!-- summernote -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- Style LK_Tree --}}
    <link href="{{ asset('css/style_tree.css') }}" rel="stylesheet">

    {{-- Toasrt --}}
    <link href="{{ asset('admin/toastr/build/toastr.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/toastr/build/toastrall.min.css') }}" rel="stylesheet" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @notifyCss
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Header -->
    <div class="header roboto-regular">
        <nav class="navbar navbar-expand-lg bg-primary border-bottom border-danger border-5">
            @include('admin.layout.partials.header')    
        </nav>

        <nav class="navbar navbar-expand-lg bg-primary">
            @include('admin.layout.partials.navbar')
        </nav>
    </div>
    <!-- /Header -->

    <!-- Contain -->
    <div class="container-fluid">
        <!-- <div class="" style="background-color: #78affb;">
        </div> -->
        <div class="row">
            <div class="col-12 col-sm-2 border border-secondary border-1 my-1 border-shadow " style="background-color: #e7e0e0;">
                @include('admin.layout.partials.sidebar_left')
            </div>

            <div class="col-12 col-sm-10 my-1">
                <section class="mh-100vh container-fluid mt-2">
                    @yield('contents')
                </section>  
            </div>
        </div>
    </div>
    {{-- <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            @include('admin.layout.partials.header')
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            @include('admin.layout.partials.sidebar_left')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <section class="content-header">
                @yield('breadcrumb')
                <div class="row">
                    <div class="col-xs-12">
                        <div id="flash_message">
                            @if (Session::has('message'))
                                <div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissable">
                                    <button data-dismiss="alert" class="close" type="button">
                                        <i class="ace-icon fa fa-times"></i>
                                    </button>
                                    {{ Session::get('message') }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
            <section class="mh-100vh container-fluid mt-2">
                @yield('contents')
            </section>
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @include('admin.layout.partials.footer')
            @include('admin.layout.partials.deleteModal')
        </footer>
        <!-- Footer End -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div> --}}
    <x-notify::notify />
    <!-- ./wrapper -->
    @notifyJs
    <script src="{{ asset('admin/plugins/jquery/jquery.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->

    <script src="{{ asset('admin/js/main.js') }}"></script>
    <script src="{{ asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery-validation/additional-methods.min.js') }}"></script>

    <script src="{{ asset('admin/dist/js/adminlte.js') }}"></script>

    {{-- Notification --}}
    <script src="{{ asset('admin/js/notify.js') }}"></script>
    <script src="{{ asset('admin/js/notify.min.js') }}"></script>

    <script src="{{ asset('admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <!-- AdminLTE App -->
    {{-- <script src="{{asset('bootstrap_fileupload/bootstrap-fileupload.min.js') }}"></script> --}}
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('admin/dist/js/demo.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    @yield('script')
</body>

</html>
