<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>پنل مدیریت | شروع سریع</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- bootstrap rtl -->
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css') }}">
    <!-- template rtl version -->
    <link rel="stylesheet" href="{{ asset('dist/css/custom-style.css') }}">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        aside.main-sidebar {
            /*width: auto;
            min-width: 335px;*/
        }
        /*  @media (min-width: 768px){ .my-nav-margin{margin-right: 406px;}
          }*/
        /*ul.nav-sidebar{
            white-space: normal!important;
        }*/
        .sidebar-mini .nav-sidebar, .sidebar-mini .nav-sidebar .nav-link, .sidebar-mini .nav-sidebar > .nav-header {
            white-space: normal;
        }
        /*.nav-sidebar .nav-item .nav-link{
            display: flex;
            align-items: baseline;
            justify-content: start;
        }*/
        .nav-sidebar .nav-item .nav-link p {
            display: initial;
            /*text-align: justify;*/
        }
    </style>
    @stack('styles')

    {{--<script>
        !function(e,t,n){e.yektanetAnalyticsObject=n,e[n]=e[n]||function(){e[n].q.push(arguments)},e[n].q=e[n].q||[];var a=t.getElementsByTagName("head")[0],r=new Date,c="https://cdn.yektanet.com/superscript/Skz6HmQM/native-event.quranbsj.ir-32370/yn_pub.js?v="+r.getFullYear().toString()+"0"+r.getMonth()+"0"+r.getDate()+"0"+r.getHours(),s=t.createElement("link");s.rel="preload",s.as="script",s.href=c,a.appendChild(s);var l=t.createElement("script");l.async=!0,l.src=c,a.appendChild(l)}(window,document,"yektanet");
    </script>--}}

</head>
<body class="row">
<div class="col-12">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand bg-white navbar-light border-bottom my-nav-margin d-flex justify-content-between"
        style="">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
        </ul>

        <div class="row ml-3">

            <form action="{{route('logout')}}" method="post" class="col-4">
                @csrf
                <button class="btn btn-danger btn-sm text-white ml-3">خروج</button>
            </form>

            @if(\Request::route()->getName() == 'participate')
                <a href="{{ url()->previous() }}"
                   class="btn btn-primary btn-sm text-white col-8" style="font-family: Shabnam">بازگشت به قسمت ثبت نام</a>
            @endif

        </div>


    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    <!-- Content Wrapper. Contains page content -->
    <div class="my-nav-margin">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">@yield('title')</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            @if(session()->has('message'))
                <div class="col-6">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        {{ session()->get('message') }}
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer class="main-footer" style="text-align: center; margin: 0">
        <!-- To the right -->
        - تمامی حقوق محفوظ می باشد.
        <!-- Default to the left -->
    </footer>

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>

<script src="{{ asset('dist/js/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script>
    // console.log('aaa');
    /*$('.select_location').on('change', function(){
        window.location = $(this).val();
    });*/


    //show it when the checkbox is clicked
    $('#need-money-checkbox').on('click', function () {
        if ($(this).prop('checked')) {
            $('#need-money').fadeIn();
            $('#need-money').addClass('d-flex');
        } else {
            $('#need-money').hide();
            $('#need-money').removeClass('d-flex');
        }
    });


    //show it when the checkbox is clicked
    $('#for_otherchecked').on('click', function () {
        if ($(this).prop('checked')) {
            $('#for_other').fadeIn();
            // $('#for_other').addClass('d-flex');
        } else {
            $('#for_other').hide();
            // $('#for_other').removeClass('d-flex');
        }
    });

</script>
@stack('scripts')
</body>
</html>
