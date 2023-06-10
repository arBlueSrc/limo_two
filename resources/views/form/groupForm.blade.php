<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>دارالقرآن</title>
    <meta content="دارالقرآن" name="description">
    <meta content="دارالقرآن" name="keywords">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('landing_assets/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('landing_assets/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<style>

    @media all and (max-width: 600px) {
        .h-custom {
            height: 250vh !important;
        }
    }

    @media (min-width: 600px) and (max-width: 1400px) {
        .h-custom {
            height: 280vh !important;
        }
    }

    @media (min-width: 1401px) {
        .h-custom {
            height: 160vh !important;
        }
    }

    @font-face {
        font-family: Shabnam;
        src: url('landing_assets/fonts/Shabnam.ttf');
    }

    @font-face {
        font-family: Shabnam;
        font-weight: bold;
        src: url('landing_assets/fonts/Shabnam.ttf');
    }

    .h1, h2, h3, h4, h5, div {
        font-family: Shabnam, serif;
    }

    .block {
        display: block;
        width: 100%;
        border: none;
        background-color: #04AA6D;
        padding: 14px 28px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
    }
</style>

<body>

<section class="h-custom" style="background-color: #000000;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-8 col-xl-6">
                <div class="card rounded-3">

                    <img src="{{ asset('images/form_header.png') }}"
                         class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;"
                         alt="Sample photo">

                    <div class="card-body p-4 p-md-5">
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 d-flex justify-content-center">فرم ثبت نام بخش
                            گروهی
                        </h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('checkResponseGroup') }}" class="px-md-2" id="add-user-form"
                              method="POST">

                            @csrf
                            @method("POST")

                            <div class="form-outline mb-4">
                                <label class="form-label" for="NameOfGroup">نام گروه*</label>
                                <input type="text" id="namesGroup" name="group_name" class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Township">انتخاب مدل شرکت گروه*</label>
                                <select name="type" id="" class="form-control">
                                    <option value="1" {{--selected=selected--}}>شرکت به صورت مدل اول (هر فرد یک تکلیف)</option>
                                    <option value="2">شرکت به صورت مدل دوم (حفظ گروهی سوره مبارکه الرحمن)</option>
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="mobile">شماره تماس معرف (در صورت نداشتن معرف این فیلد را خالی بگذارید)</label>
                                <input type="text" id="mobile" name="moaref_mobile" class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="City">استان*</label>
                                <select name="ostan_id" id="ostans" class="form-control">
                                    @foreach($ostans as $ostan)
                                        <option
                                            value="{{ $ostan->id }}" {{ $loop->first ? 'selected=selected' : '' }}>{{ $ostan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Township">شهرستان*</label>
                                <select name="shahrestan_id" id="child_shahrestans" class="form-control">
                                    @foreach($shahrestans as $shahrestan)
                                        <option
                                            value="{{ $shahrestan->id }}" {{ $loop->first ? "selected=selected" : '' }}>{{ $shahrestan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Mosque">انتخاب مسجد محل آزمون*</label>
                                <select  name="mosque" id="mosque" class="form-control">
                                </select>
{{--                                <input type="text" id="mosque" name="mosque" class="form-control"/>--}}
                            </div>


                            <div class="form-outline mb-4">
                                <label class="form-label" for="LeadersLFname">نام و نام خانوادگی سرگروه*</label>
                                <input type="text" id="leaders_name" name="head_name" class="form-control"
                                       placeholder="نام یکی از اعضای گروه را به عنوان سرگروه  وارد نمایید"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="LeadersCode">کد ملی سرگروه*</label>
                                <input type="text" id="team_national_code" name="head_national_code"
                                       class="form-control"/>
                            </div>

                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="day" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="month" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="year" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1399; $i>=1330;$i--)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="LeadersPhone">شماره تماس سرگروه*</label>
                                <input type="text" id="team_leaders-Phone_number" name="head_phone"
                                       class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="LFName2">نام و نام خانوادگی نفر دوم*</label>
                                <input type="text" id="second_persons_name" name="second_person_name"
                                       class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="PhoneSeconde">شماره تماس نفر دوم*</label>
                                <input type="text" id="second_persons_phone_number" name="second_person_phone"
                                       class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="FLName3">نام و نام خانوادگی نفر سوم*</label>
                                <input type="text" id="Third_persons_name" name="third_person_name"
                                       class="form-control"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="LFName3">شماره تماس نفر سوم*</label>
                                <input type="text" id="third_persons_name_phone_number" name="third_persons_phone"
                                       class="form-control"/>
                            </div>
                            <br>
                            <div><h4 class="text-info">زمان دقیق آزمون به شما اطلاع رسانی خواهد شد </h4></div>
                            <div><h4 class="text-info">توجه: لطفا قبل از ذخیره اطلاعات و ثبت نام حتما <a
                                        class="text-danger" href="{{ url('/files/group_rule.pdf') }}"> آیین نامه بخش
                                        گروهی</a> را مطالعه کنید </h4></div>
                            <img width="300px" src="{{ url('/files/group_table.jpg') }}"
                                 onclick="window.open(this.src)">
                            <br>
                            <br>
                            <button type="submit" class="btn btn-success block">ذخیره</button>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <form action="{{ url('/') }}" method="get">
        <div class="modal fade" role="dialog" id="myModal" style="margin-top: 100px">

            <div class="modal-dialog" role="document">

                <div class="modal-content">

                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="modal-body">

                        <div class="d-flex justify-content-center">
                            <script
                                src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
                            <lottie-player src="{{ asset('dist/lottie/done.json') }}" background="transparent" speed="1"
                                           style="width: 300px; height: 300px;" id="lottie"></lottie-player>
                        </div>

                        <p class="d-flex justify-content-center">اطلاعات شما با موفقیت ثبت گردید. با تشکر</p>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="margin-left: 10px">
                            متوجه شدم
                        </button>
                    </div>

                </div>

            </div>

        </div>
    </form>
</section>

</body>


<script>


    /*$('#ostans').on('change', function () {
        // alert( this.value );
        let ostan_id = this.value;
        // alert( ostan_id);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}",
                'Content-Type': 'application/json'
            }
        })
        $.ajax({
            type: 'POST',
            url: '{{ url("/"); }}/get-child-shahrestans',
            data: JSON.stringify({ostan_id: ostan_id}),
            success: function (data) {
                var len = data.length;

                $("#child_shahrestans").empty();
                for (var i = 0; i < len; i++) {
                    var id = data[i]['id'];
                    var name = data[i]['name'];

                    $("#child_shahrestans").append("<option value='" + id + "'>" + name + "</option>");

                }
            }
            // console.log(data);

        });
    });*/



    let sharestan_holder=0;
    $('#ostans').on('change', function() {
        // alert( this.value );
        let ostan_id= this.value;
        // alert( ostan_id);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                'Content-Type' : 'application/json'
            }
        })
        $.ajax({
            type : 'POST',
            url : '{{ url("/"); }}/get-child-shahrestans',
            data : JSON.stringify( {ostan_id: ostan_id}),
            success : function(data) {
                var len = data.length;

                $("#child_shahrestans").empty();
                for( var i = 0; i<len; i++){

                    var id = data[i]['id'];
                    if(i==0){
                        sharestan_holder=id;
                        // console.log(id);
                    }
                    var name = data[i]['name'];

                    $("#child_shahrestans").append("<option value='"+id+"'>"+name+"</option>");

                }
                let shahrestan_id= sharestan_holder;
                // alert( ostan_id);
                // console.log(shahrestan_id);

                $.ajaxSetup({
                    headers : {
                        'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                        'Content-Type' : 'application/json'
                    }
                })
                $.ajax({
                    type : 'POST',
                    url : '{{ url("/"); }}/get-related-masjeds',
                    data : JSON.stringify( {shahrestan_id: shahrestan_id}),
                    success : function(data) {
                        // console.log(data);
                        var len = data.length;

                        $("#mosque").empty();
                        for( var i = 0; i<len; i++){
                            var id = data[i]['id'];
                            var shahrestan = data[i]['shahrestan'];
                            var hoze = data[i]['hoze'];
                            var masjed = data[i]['masjed'];
                            // console.log(sharestan_holder);
                            //  console.log(hoze);

                            $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - مسجد: "+ masjed +"</option>");

                        }
                    }
                    // console.log(data);

                });
            }
            // console.log(data);

        });


        // alert( this.value );
    });


    $('#child_shahrestans').on('change', function() {
        // alert( this.value );
        let shahrestan_id= $('#child_shahrestans').val();
        // alert( ostan_id);
        // console.log(shahrestan_id);

        $.ajaxSetup({
            headers : {
                'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                'Content-Type' : 'application/json'
            }
        })
        $.ajax({
            type : 'POST',
            url : '{{ url("/"); }}/get-related-masjeds',
            data : JSON.stringify( {shahrestan_id: shahrestan_id}),
            success : function(data) {
                // console.log(data);
                var len = data.length;

                $("#mosque").empty();
                for( var i = 0; i<len; i++){
                    var id = data[i]['id'];
                    var shahrestan = data[i]['shahrestan'];
                    var hoze = data[i]['hoze'];
                    var masjed = data[i]['masjed'];

                    $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - مسجد: "+ masjed +"</option>");
                }
            }
            // console.log(data);

        });
    });

</script>

</html>

