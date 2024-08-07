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
                            خانوادگی
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
                        <form action="{{ route('checkResponseFamilyEdit') }}" class="px-md-2" id="add-user-form"
                              method="POST">

                            @csrf
                            @method("POST")

                            <input hidden value="{{ $family_result->id }}" id="id" name="id">

                            <div class="form-outline mb-4">
                                <label class="form-label" for="family_name">نام خانواده*</label>
                                <input type="text" id="fname" name="family_name" class="form-control" value="{{ $family_result->name }}"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="City">استان*</label>

                                <select name="ostan_id" id="ostans" class="form-control">
                                    @foreach($ostans as $ostan)
                                        <option
                                            value="{{ $ostan->id }}" @selected($ostan->id == $family_result->ostan_id)>{{ $ostan->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="Township">شهرستان*</label>
                                <select name="shahrestan_id" id="child_shahrestans" class="form-control">
                                    @foreach($shahrestans as $shahrestan)
                                        <option
                                            value="{{ $shahrestan->id }}" @selected($shahrestan->id == $family_result->shahrestan_id)>{{ $shahrestan->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="mosque">انتخاب مسجد محل آزمون*</label>
                                {{--                                <input type="text" id="mosque" name="mosque" class="form-control"/>--}}
                                <select  name="mosque" id="mosque" class="form-control">
                                    @foreach($mosques as $mosuque)
                                        <option
                                            value="{{ $mosuque->id }}" @selected($mosuque->id == $family_result->mosque_id)>{{ $mosuque->masjed }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Fname">نام ونام خانوادگی پدر خانواده*</label>
                                <input type="text" id="names father" name="father_name" class="form-control"
                                    value="{{ $family_result->father_name }}"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Fcode">کد ملی پدر خانواده*</label>
                                <input type="text" id="fNational Code" name="father_national_code"
                                       class="form-control" value="{{ $family_result->father_national_code }}"/>
                            </div>


                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="day" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}"  @selected($i == $b_day)>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="month" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}" @selected($i == $b_month)>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="year" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1400; $i>=1330;$i--)
                                                <option value="{{ $i }}" @selected($i == $b_year)>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="Fphone">شماره تماس پدر خانواده*</label>
                                <input type="text" id="FPhone number" name="father_phone" class="form-control"
                                 value="{{ $family_result->father_phone }}"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="mLname">نام و نام خانوادگی مادر خانواده*</label>
                                <input type="text" id="names mather" name="mother_name" class="form-control"
                                value="{{ $family_result->mother_name }}"/>
                            </div>
                            <div class="form-outline mb-4">
                                <label class="form-label" for="Mname">شماره تماس مادر خانواده*</label>
                                <input type="text" id="mPhone number" name="mother_phone" class="form-control"
                                value="{{ $family_result->mother_phone }}"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="number_of_chaild">نام فرزند اول*</label>
                                <input type="text" id="number_chaild" name="child_name1" class="form-control" value="{{ $children[0]->name ?? "" }}"/>
                            </div>


                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد فرزند اول*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="child_day1" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_1[2])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_month1" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}"  @selected($i == $shamsi_date_1[1])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_year1" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1400; $i>=1330;$i--)
                                                <option value="{{ $i }}"  @selected($i == $shamsi_date_1[0])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="form-outline mb-4">
                                <label class="form-label" for="number_of_chaild">نام فرزند دوم*</label>
                                <input type="text" id="number_chaild" name="child_name2" class="form-control" value="{{ $children[1]->name ?? "" }}"/>
                            </div>


                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد فرزند دوم*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="child_day2" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_2[2]) >{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_month2" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_2[1])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_year2" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1400; $i>=1330;$i--)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_2[0])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="number_of_chaild">نام فرزند سوم*</label>
                                <input type="text" id="number_chaild" name="child_name3" class="form-control" value="{{ $children[2]->name ?? "" }}"/>
                            </div>


                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد فرزند سوم*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="child_day3" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_3[2])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_month3" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_3[1])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_year3" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1400; $i>=1330;$i--)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_3[0])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="number_of_chaild">نام فرزند چهارم*</label>
                                <input type="text" id="number_chaild" name="child_name4" class="form-control" value="{{ $children[3]->name ?? "" }}"/>
                            </div>


                            <div class="row">
                                <label class="form-label" for="Date_of_birth">تاریخ تولد فرزند چهارم*</label>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select class="form-control" name="child_day4" id="Day">
                                            <option value="" class="form-control" selected>روز</option>
                                            @for($i=1; $i<=31;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_4[2])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_month4" class="form-control" id="Month">
                                            <option value="" class="form-control" selected>ماه</option>
                                            @for($i=1; $i<=12;$i++)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_4[1])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                        <select name="child_year4" class="form-control">
                                            <option value="" class="form-control" selected>سال</option>
                                            @for($i=1400; $i>=1330;$i--)
                                                <option value="{{ $i }}" @selected($i == $shamsi_date_4[0])>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>

                                <button type="submit" class="btn btn-success block">به روزرسانی</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>


</section>

</body>


<script>

    function imgWindow() {
        window.open("image")
    }




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

