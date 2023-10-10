<html lang="en" class="hydrated" style="height: auto;">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        function myFunction(number) {
            document.getElementById("question_id").value = number;
            console.log(number);
        }

        function updateQuestion(question) {
            document.getElementById("question_update").value = question['question'];
            document.getElementById("option_1_update").value = question['option_1'];
            document.getElementById("option_2_update").value = question['option_2'];
            document.getElementById("option_3_update").value = question['option_3'];
            document.getElementById("option_4_update").value = question['option_4'];
            document.getElementById("answer_update").value = question['answer'];
            console.log(number);
        }

    </script>


    <!--
    This is a starter template page. Use this page to start your new project from
    scratch. This page gets rid of all links and provides the needed markup only.
    -->

    <meta charset="utf-8">
    <style data-styles="">ion-icon {
            visibility: hidden
        }

        .hydrated {
            visibility: inherit
        }</style>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>لیست آزمون ها</title>

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
    <script nomodule="" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <style>
        .content-wrapper {
            margin-right: 0;
        }

        .main-header {
            margin-right: 0;
        }
    </style>
</head>
<body style="height: auto;">
<div class="wrapper">

    <!-- Navbar -->
    <nav
        class="main-header navbar navbar-expand bg-white
         navbar-light border-bottom my-nav-margin d-flex
          justify-content-between" style="">
        <h1></h1>

        <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="btn btn-danger btn-sm text-white m-3 left">خروج از حساب کاربری</button>
        </form>

    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper my-nav-margin" {{--style="min-height: 2301px;"--}}>
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        @if(session()->has('message'))
            <div class="col-12">
                <div class="alert alert-info alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{ session()->get('message') }}
                </div>
            </div>
    @endif
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="card card-primary">

                <!-- card-header -->
                <div  class="card-header" style="background: black">
                    <h3 class="card-title d-flex justify-content-center ">لیست آزمون ها</h3>
                    <div>
                        <a class="btn btn-warning w-100 m-1"
                           style=" color: black; border-radius: 25px"
                           href="{{ route('user.results') }}">مشاهده
                            نتایج آزمون های قبلی</a>
                    </div>
                </div>
                <!-- /.card-header -->

                <!-- form start -->

                <div class="row">
                    @foreach($azmoons as $azmoon)
                        <div class=" col-sm-12 col-lg-4 col-md-6" style="border-radius: 10px">
                            <div class="card m-2">
                                <div class="  d-flex align-content-center flex-wrap">
                                    <img class="w-30" style="width: 75px ;max-height: 100px;" src="{{asset('images/exam.png')}}"/>
                                    <div style="margin-right: 15px;margin-top: 10px;">
                                        <strong
                                            style="margin-right: 15px;margin-top: 10px; color: black;">{{ $azmoon->name }}</strong>

                                        <div class="" style="margin-right: 15px;margin-top:15px;">
                                            <span>تاریخ برگزاری</span>
                                            <span class="badge badge-info"style="font-size: initial;font-weight: bold">{{ jdate($azmoon->start_time)->format("Y/m/d H:i") }}</span>
                                        </div>

                                        @php
                                            $time1 = new DateTime($azmoon->start_time);
                                            $time2 = new DateTime($azmoon->end_time);
                                            $interval = $time1->diff($time2);

                                      $times = explode(':',$azmoon->duration);
                                      $min = $times[1];
                                      $hour = $times[0];
                                        @endphp

                                        @if($hour ==0)
                                            <p style="margin: 15px; color: black">زمان آزمون
                                                : {{ $min }} دقیقه</p>
                                        @else
                                            <p style="margin: 15px; color: black">زمان آزمون
                                                : {{ $hour }} ساعت و {{ $min }} دقیقه  </p>
                                        @endif

                                    </div>


                                </div>


                                <div class="d-flex justify-content-center ">
                                    <a class="btn btn-outline-info w-100 m-2"
                                       style="border-radius: 25px; text-align: center; align-content: center;"
                                       href="{{ route('azmoon.questions',['azmoon'=>$azmoon->id]) }}">شرکت در این
                                        آزمون</a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>

            </div>

        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


    <!-- Main Footer -->
    <footer style="text-align: center" class="p-2">
        <!-- To the right -->
{{--        توسعه توسط تیم نسرآزمون - تمامی حقوق محفوظ می باشد.--}}
        <!-- Default to the left -->

    </footer>
    <div id="sidebar-overlay"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>

<script src="{{ asset('dist/js/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
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

