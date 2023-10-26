<html lang="en" class="hydrated" style="height: auto;">
<head>
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>--}}
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

    <title>صفحه آزمون</title>

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
    <nav
        class="main-header bg-white navbar-light border-bottom d-flex justify-content-between"
        style="">

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
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">

            <div class="card card-primary">

                <!-- card-header -->
                <div class="card-header"  style="background: black">
                    <h3 class="card-title">آزمون</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form id="azmoon_form" role="form" method="post" action="{{ route("azmoon.answer",['azmoon'=>$azmoon->id]) }}" enctype="multipart/form-data">
                    {{--<input type="hidden" name="_token" value="ceFb1ZCAkeAy7BVevVpnnLMG3EN7uPSi828MEwzk">            <input type="hidden" name="_method" value="POST">--}}
                    @csrf
                    @method('post')
                    <input type="hidden" name="azmoon_id" value="{{ $azmoon->id }}" id="azmoon_id">

                    {{-- main azmoon begin --}}
                    <div class="card-body" id="card">
                        <div class="row">
                            <div class="col-lg-6">
                            <div class="col-12">
                                <label for="name">نام آزمون</label>
                                <p type="text" name="name"  id="name" placeholder="نام آزمون" value="{{ $azmoon->name }}">{{ $azmoon->name }}
                            </div>
                            <div class="col-lg-6 mt-3" style="text-align: left">
                                <div class="row justify-content-end align-items-center">
                                    <div class="text-bold ml-2">   زمان باقی مانده :    </div>   <span class="btn btn-warning text-bold" id="demo"> 0h :0m :0s   </span>
                                    {{--<a href="#" class="btn btn-outline-info" style="border-radius: 25px" data-target="#myModal" id="open" data-toggle="modal">اضافه کردن سوال +</a>--}}
                                </div>
                            {{--<div class="col-6" style="text-align: left">
                                <div class="row justify-content-end">
                                    <a href="#" class="btn btn-outline-info" style="border-radius: 25px" data-target="#myModal" id="open" data-toggle="modal">اضافه کردن سوال +</a>
                                </div>
                            </div>--}}

                        </div>

                        <hr class="solid">

                        <div class="form-group col-12 pt-4">

                            <div class="row justify-content-end">
                                <label class="col-lg-10 justify-content-end" for="name" style="padding-bottom: 10px">سوالات آزمون</label>
                                <label class="col-lg-2" for="name" style="padding-bottom: 10px">مجموعا : {{ $azmoon_question_count }} سوال</label>
                            </div>

                            @foreach($questions as $question)
                            <div class="card" style="border-radius: 10px">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="margin: 15px; color: black">سوال شماره {{ $questions->currentPage() }} )</h6>
                                    </div>
                                    <div class="col-6" style="text-align: left">
                                        <div class="row justify-content-end">
                                            <h6 class="text-info" style="margin: 15px;">
                                                سوال تستی
                                            </h6>
                                        </div>
                                    </div>
                                    <p style="margin-right: 25px; margin-left: 25px">{{ $question->question }}</p>

                                    <div class="row col-12" style="margin-right: 10px; margin-left: 50px;">

                                        <div class="col-12">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <input type="hidden" name="question_id[]" id="current_question_id" value="{{ $question->id }}">
                                                    @php
                                                        $user_last_answer=\App\Models\Answer::where('user_id',$user->id)->where('azmoon_id',$azmoon->id)->where('question_id',$question->id)->first()
                                                    @endphp
                                                @if($question->type == 0)


                                                    <div class="form-group" id="checkboxes">
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="q1" name="q{{ $question->id }}" type="checkbox" @checked($user_last_answer && $user_last_answer->user_answer == 1) value="1">
                                                            <label class="form-check-label" for="q1">{{ $question->option_1 }}</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="q2" name="q{{ $question->id }}" type="checkbox" @checked($user_last_answer && $user_last_answer->user_answer == 2) value="2">
                                                            <label class="form-check-label" for="q2">{{ $question->option_2 }}</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="q3" name="q{{ $question->id }}" type="checkbox" @checked($user_last_answer && $user_last_answer->user_answer == 3) value="3">
                                                            <label class="form-check-label" for="q3">{{ $question->option_3 }}</label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" id="q4" name="q{{ $question->id }}" type="checkbox" @checked($user_last_answer && $user_last_answer->user_answer == 4) value="4">
                                                            <label class="form-check-label" for="q4">{{ $question->option_4 }}</label>
                                                        </div>
                                                    </div>
                                                    @elseif($question->type == 1)
{{--                                                        <input type="hidden" name="text_question_id[]" value="{{ $question->id }}" id="current_question_id">--}}
                                                        <div class="form-group col-12">
                                                            <label for="question">پاسخ را وارد کنید :</label>
                                                            <textarea name="q{{ $question->id }}" class="p-2" id="textarea_input" name="answer" rows="3" cols="90">{{ $user_last_answer ? $user_last_answer->user_answer :'' }}</textarea>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                            </div>
                                        {{--<div class="col-6">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><input type="radio"></span>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><input type="radio"></span>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="col-lg-12">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><input type="radio"></span>
                                                    </div>
                                                    <input type="text" class="form-control">
                                                </div>
                                                <!-- /input-group -->
                                            </div>
                                        </div>--}}
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                            </div>


                                <div class="row">
                                    <div class="col-12">
                                        <label class="ml-3">لیست سوالات :</label>
                                    </div>
                                </div>

                        </div>
                            <div class="w-100"></div>

                            <div class="pagination-container d-flex justify-content-center align-items-center">

                                <div class="container">
                                    {{ $questions->links() }}
                                </div>
                            </div>

                    </div>

                    {{-- main azmoon end --}}






                    {{--<div class="card">
                        <div class="card-body p-0">
                            <table class="table table-striped">
                                <tbody><tr>
                                    <th style="width: 10px">#</th>
                                    <th>نام آزمون</th>
                                    <th>نمره منفی</th>
                                    <th>شرکت در ازمون</th>
                                    --}}{{--<th>پیشرفت</th>
                                    <th style="width: 40px">درصد</th>--}}{{--
                                </tr>
                                @foreach($azmoons as $azmoon)
                                <tr>
                                    <td>{{$loop->index+1 }}</td>
                                    <td>{{ $azmoon->name }}</td>
                                    <td> @if($azmoon->negative_point)  <span class="badge badge-danger p-2" style="font-size: .9rem">دارد</span> @else <span class="badge badge-info p-2" style="font-size: .9rem">ندارد</span> @endif</td>
                                    <td>    <a href="">لینک آزمون</a> </td>
                                    --}}{{--<td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">۵۵%</span></td>--}}{{--
                                </tr>
                                @endforeach
                                </tbody></table>
                        </div>
                        <!-- /.card-body -->
                    </div>--}}

                    {{--@foreach($azmoons as $azmoon)
                        <div class="card mt-2" style="border-radius: 10px">
                            <div class="row">
                                <div class="col-12">

                                    <h6 style="margin: 15px; color: black">عنوان: {{ $azmoon->name }}</h6>
                                </div>

                                <p style="margin-right: 25px; margin-left: 25px"><a href="">لینک شرکت در آزمون</a></p>




                            </div>
                        </div>
                    @endforeach--}}

                   {{-- <div class="col-lg-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><input type="radio"></span>
                            </div>
                            <input type="text" class="form-control">
                        </div>
                        <!-- /input-group -->
                    </div>--}}

                    {{--<div class="card-body" id="card">

                        <div class="row">
                            <div class="col-6">
                                <label for="name">نام آزمون</label>
                                <input type="text" name="name" class="form-control" id="name" placeholder="نام آزمون" value="aaaaa" disabled="">
                            </div>
                            <div class="col-6" style="text-align: left">
                                <div class="row justify-content-end">
                                    <a href="#" class="btn btn-outline-info" style="border-radius: 25px" data-target="#myModal" id="open" data-toggle="modal">اضافه کردن سوال +</a>
                                </div>
                            </div>

                        </div>

                        <hr class="solid">

                        <div class="form-group col-12">

                            <div class="row justify-content-end">
                                <label class="col-10 justify-content-end" for="name" style="padding-bottom: 10px">سوالات آزمون</label>
                                <label class="col-2" for="name" style="padding-bottom: 10px">مجموعا : 1 سوال</label>
                            </div>

                            <div class="card" style="border-radius: 10px">
                                <div class="row">
                                    <div class="col-6">
                                        <h6 style="margin: 15px; color: black">سوال شماره 1 )</h6>
                                    </div>
                                    <div class="col-6" style="text-align: left">
                                        <div class="row justify-content-end">
                                            <h6 class="text-info" style="margin: 15px;">
                                                سوال تستی
                                            </h6>
                                            <a onclick="myFunction(2)" href="" style="margin-top: 15px; margin-left: 20px; color: red" data-target="#deleteModal" class="delete" data-toggle="modal"><ion-icon name="trash" role="img" class="md hydrated" aria-label="trash"></ion-icon></a>
                                            <a onclick="updateQuestion({&quot;id&quot;:2,&quot;question&quot;:&quot;asdasd222&quot;,&quot;type&quot;:0,&quot;option_1&quot;:&quot;asd&quot;,&quot;option_2&quot;:&quot;asd222&quot;,&quot;option_3&quot;:&quot;asd&quot;,&quot;option_4&quot;:&quot;as&quot;,&quot;answer&quot;:2,&quot;parent_azmoon&quot;:1,&quot;created_at&quot;:&quot;2023-02-28T07:45:46.000000Z&quot;,&quot;updated_at&quot;:&quot;2023-02-28T07:46:21.000000Z&quot;})" href="" style="margin-top: 15px; margin-left: 20px; color: black" data-target="#updateModal" class="update" data-toggle="modal"><ion-icon name="create" role="img" class="md hydrated" aria-label="create"></ion-icon></a>
                                        </div>
                                    </div>
                                    <p style="margin-right: 25px; margin-left: 25px">asdasd222</p>

                                    <div class="row col-11" style="margin-right: 10px; margin-left: 50px;">

                                        <div class="col-3">
                                            <div class="callout callout-danger">
                                                <p>asd</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="callout callout-success">
                                                <p>asd222</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="callout callout-danger">
                                                <p>asd</p>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="callout callout-danger">
                                                <p>as</p>
                                            </div>
                                        </div>

                                    </div>


                                </div>
                            </div>


                        </div>

                    </div>--}}

                        <button class="btn btn-warning w-100" type="submit">اتمام آزمون</button>
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
    <script>
        /*function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);

                if (--timer < 0) {
                    timer = duration;
                    timer=0;
                }
            }, 1000);
        }

        jQuery(function ($) {
            // var fiveMinutes = 60 * 5,
            var fiveMinutes = {{--{{ $time_remain }} ,--}}
                display = $('#time');
            startTimer(fiveMinutes, display);

            /!*$("#time").click(function (){
                console.log(
                    $("#time").html()
                );
            });*!/

        });*/










        // new timer

        // Set the date we're counting down to
        //var countDownDate = new Date("Jan 5, 2024 15:37:25").getTime();
        var countDownDate = new Date("{{ $end_user_time }}").getTime();

        console.log(countDownDate);
        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            /*var now = new Date().getTime();
            var now = new Date("{{ \Illuminate\Support\Carbon::now() }}").getTime();
            var now = new Date("{{ \Illuminate\Support\Carbon::now() }}").getTime();*/
            var now = new Date().getTime();

            /*var now2 = new Date(now.toLocaleString('en-US', {
                timeZone: "Asia/tehran"
            }));*/

            /*var now2 = new Date(now.toLocaleString('fa-IR');
            console.log(now2);*/

            // Find the distance between now and the count down date
            var distance = countDownDate - now;
           /* console.log(distance);*/
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Output the result in an element with id="demo"
            document.getElementById("demo").innerHTML =/* days + "d :"*/ + hours + "ساعت :"
                + minutes + "دقیقه :" + seconds + "ثانیه ";

            // If the count down is over, write some text
            if (distance < 0) {
                $("#azmoon_form").submit();
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            }

        }, 1000);




        //pagination question ajax request

        $('.page-link').click(function (event){

            // event.preventDefault();
            let selected_answer;
            // alert('clicked')
            console.log('aaaa');
            question_id=$('#current_question_id').val();
            azmoon_id={{ $azmoon->id }}
            question_type={{ $question->type }}
            // alert(question_type);

            /*$("#checkboxes").children("input:checked").map(function() {
                // return this.name;
                alert('vvvv');
            });*/
            // var selected = [];
            // var selected_answer;

            if(question_type == 0) {

                $('#checkboxes input:checked').each(function () {
                    // selected.push($(this).attr('value'));
                    selected_answer = $(this).attr('value');
                    // selected.push($(this).attr('value'));
                });

                // selected_answer = $('#answer_input').attr('value');
            }
            else if(question_type == 1){
                    selected_answer=$('#textarea_input').val();
                    // alert(selected_answer)
            }
// alert(selected_answer)


            if(selected_answer === undefined){
                selected_answer=null;
            }
            // console.log(selected_answer)

            // alert(selected_answer);
        // if(selected_answer) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                }
            })

            $.ajax({
                type: 'POST',
                {{--url : '{{ url("/"); }}/update',--}}
                url: '{{ route('ajax.answer.update') }}',
                data: JSON.stringify({question_id: question_id, answer: selected_answer, azmoon_id: azmoon_id}),
                success: function (data) {
                    // alert(data);
                    // alert('success');
                    // console.log(data);

                    var len = data.length;


                    // $("#mosque").empty();
                    // for( var i = 0; i<len; i++){
                    //     var id = data[i]['id'];
                    //     var shahrestan = data[i]['shahrestan'];
                    //     var hoze = data[i]['hoze'];
                    //     var masjed = data[i]['masjed'];
                    //     // console.log(sharestan_holder);
                    //
                    //     $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - مسجد: "+ masjed +"</option>");
                    //
                    // }
                }
                // console.log(data);
            });
        // }
        });

    </script>





