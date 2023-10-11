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

    <title>لیست نتایج</title>

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
<body class="sidebar-mini sidebar-open" style="height: auto;">
<div class="wrapper">
    <!-- Navbar -->
    <nav         class="main-header bg-white navbar-light border-bottom d-flex justify-content-between"
                 style="">
        <!-- Left navbar links -->
        {{--<ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
            </li>

        </ul>--}}

        {{--<form action="http://localhost:8000/logout" method="post">
            <input type="hidden" name="_token" value="ceFb1ZCAkeAy7BVevVpnnLMG3EN7uPSi828MEwzk">          <button class="btn btn-danger btn-sm text-white ml-3">خروج از حساب کاربری</button>
        </form>--}}

        <!-- SEARCH FORM -->


        <!-- Right navbar links -->

    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <!-- Main Sidebar Container -->
    {{-- <aside class="main-sidebar sidebar-dark-primary elevation-4" style="min-height: 2301px;">
         <!-- Brand Logo -->
         <a href="http://localhost:8000/admin" class="brand-link">
             <span class="brand-text" style="color: white; font-size: 15px; margin-right: 15px">نسرآزمون</span>
             <img src="http://localhost:8000/dist/img/logo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
         </a>

         <!-- Sidebar -->
         <div class="sidebar">
             <div>
                 <!-- Sidebar user panel (optional) -->
                 <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                     <div class="info">
                         <a href="#" class="d-block"></a>
                     </div>
                 </div>

                 <!-- Sidebar Menu -->
                 <nav class="mt-2">
                     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                         <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->




                         <li class="nav-item has-treeview ">
                             <a href="http://localhost:8000/admin/azmoon" class="nav-link ">
                                 <p>
                                     آزمون ها
                                     <i class="right fa fa-angle-left"></i>
                                 </p>
                             </a>
                         </li>


                         <li class="nav-item has-treeview ">
                             <a href="#" class="nav-link ">
                                 <p>
                                     لیست نتایج
                                     <i class="right fa fa-angle-left"></i>
                                 </p>
                             </a>
                         </li>


                         <li class="nav-item has-treeview ">
                             <a href="#" class="nav-link ">
                                 <p>
                                     لیست کاربران
                                     <i class="right fa fa-angle-left"></i>
                                 </p>
                             </a>
                         </li>

                     </ul>
                 </nav>
                 <!-- /.sidebar-menu -->
             </div>
         </div>
         <!-- /.sidebar -->
     </aside>--}}

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
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="card card-primary">

                <!-- card-header -->
                <div class="card-header" style="background: black">
                    <h3 class="card-title">نتایج آزمون</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
               {{-- <form role="form" method="post" action="{{ route("azmoon.answer",['azmoon'=>$azmoon->id]) }}" enctype="multipart/form-data">--}}
                    {{--<input type="hidden" name="_token" value="ceFb1ZCAkeAy7BVevVpnnLMG3EN7uPSi828MEwzk">            <input type="hidden" name="_method" value="POST">--}}
                    {{--@csrf
                    @method('post')
                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}">--}}

                    {{-- main azmoon begin --}}
                    <div class="card-body" id="card">

                        <div class="row">
                            <div class="col-12">
                                <label for="name">نام کاربر</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="" value="{{ $user->name }}" disabled="">
                            </div>
                            {{--<div class="col-6" style="text-align: left">
                                <div class="row justify-content-end">
                                    <a href="#" class="btn btn-outline-info" style="border-radius: 25px" data-target="#myModal" id="open" data-toggle="modal">اضافه کردن سوال +</a>
                                </div>
                            </div>--}}

                        </div>
                        @foreach($results as $result)
                        <hr class="solid">

                        <div class="form-group col-12">

                            <div class="row justify-content-end">
                                <label class="col-lg-10 justify-content-end" for="name" style="padding-bottom: 10px">عنوان آزمون : {{ $result->azmoon->name ?? "" }}</label>
{{--                                <label class="col-lg-2" for="name" style="padding-bottom: 10px"> تعداد کل سوالات :  {{ $result->azmoon()->questionCount() ?? "" }} </label>--}}
                                <label class="col-lg-2" for="name" style="padding-bottom: 10px"> تعداد کل سوالات :  {{ /*$result->true_answer+$result->wrong_answer+$result->empty_answer*/ $result->azmoon()->first()->questions()->count() }} </label>
                            </div>

                            {{--@foreach($questions as $question)--}}
                            <div class="card" style="border-radius: 10px">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="margin: 15px; color: black"> {{--{{ auth()->user()->name }}--}} </h6>
                                    </div>
                                    <div class="col-6" style="text-align: left">
                                        {{-- <div class="row justify-content-end">
                                             <h6 class="text-info" style="margin: 15px;">
                                                 سوال تستی
                                             </h6>


                                         </div>--}}
                                    </div>
                                    @php
                                        $score_of_20= ($result->true_answer - $result->wrong_answer * .25);
                                        if ($score_of_20 < 0){
                                            $score_of_20=0;
                                        }


                                    @endphp
{{--                                    <p style="margin-right: 25px; margin-left: 25px">نمره:  %{{ $result->percent }}  </p>--}}
                                    <p style="margin-right: 25px; margin-left: 25px"> نمره از بیست:<span class="badge badge-secondary"> {{ $score_of_20 }} </span> </p>
                                    <p style="margin-right: 25px; margin-left: 25px">تعداد سوالات تستی درست: {{ $result->true_answer }}</p>
                                    <p style="margin-right: 25px; margin-left: 25px">تعداد سوالات تستی غلط: {{ $result->wrong_answer }}</p>
                                    <p style="margin-right: 25px; margin-left: 25px">تعداد سوالات تستی بدون پاسخ: {{ $result->empty_answer }}</p>
                                    <p style="margin-right: 25px; margin-left: 25px">تعداد سوالات تشریحی: {{ $result->azmoon()->first()->questions()->where('type',1)->count() }}</p>


                                        <p style="margin-right: 25px; margin-left: 25px"><span class="badge badge-info" style="font-size: initial;
     font-weight: initial;">
                                                نمره نهایی: {{ $score_of_20 }}
                                        </span></p>

                                    <div class="row col-12" style="margin-right: 10px; margin-left: 50px;">

                                    </div>


                                </div>


                            </div>
                            {{--@endforeach--}}

                        </div>
                        @endforeach



                    </div>

            </div>


            {{--<button class="btn btn-success" type="submit">اتمام آزمون</button>--}}
            <a href="{{ route('azmoons.index') }}" class="btn btn-warning w-100" >بازگشت</a>
            </form>

        </div>

    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Main Footer -->
<footer style="text-align: center" class="p-2">
    <!-- To the right -->
{{--    توسعه توسط تیم نسرآزمون - تمامی حقوق محفوظ می باشد.--}}
    <!-- Default to the left -->

</footer>

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


    // the selector will match all input controls of type :checkbox
    // and attach a click event handler
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
</script>


