<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>سامانه مسک</title>
    <meta content="سامانه مسک" name="description">
    <meta content="مسک" name="keywords">

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
            height: 160vh !important;
        }
    }

    @media (min-width: 600px) and (max-width: 1400px) {
        .h-custom {
            height: 220vh !important;
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
                        <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 d-flex justify-content-center">فرم تکمیل
                            اطلاعات</h3>

                        <form class="px-md-2" id="add-user-form"  action="{{ route('form.update') }}"
                              method="POST">

                            @csrf
                            @method("POST")

                            <input hidden name="id" id="id" value="{{ $user->id }}">

                            <div class="form-outline mb-4">
                                <label class="form-label" for="name">نام*</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="lname">نام خانوادگی*</label>
                                <input type="text" id="lname" name="lname" class="form-control" value="{{ $user->lname }}"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="age">سن*</label>
                                <input type="text" id="age" name="age" class="form-control" value="{{ $user->age }}"/>
                            </div>

                            <div class="row">

                                <div class="col-6 mb-4">

                                    <label class="form-label" for="gender">جنسیت*</label>

                                    <select class="select form-control" id="gender" name="gender">
                                        <option value="1" @php if ( $user->gender == 1 ) {echo "selected";} @endphp >مرد</option>
                                        <option value="0" @php if ( $user->gender == 1 ) {echo "selected";} @endphp>زن</option>
                                    </select>

                                </div>

                                <div class="col-6 mb-4">

                                    <label class="form-label" for="edu">تحصیلات*</label>


                                    <select class="select form-control" id="edu" name="edu">
                                        <option value="0"  @php if ( $user->edu == 0 ) {echo "selected";} @endphp>دانش آموز</option>
                                        <option value="1"  @php if ( $user->edu == 1 ) {echo "selected";} @endphp>سیکل</option>
                                        <option value="2"   @php if ( $user->edu == 2 ) {echo "selected";} @endphp>دیپلم</option>
                                        <option value="3"  @php if ( $user->edu == 3 ) {echo "selected";} @endphp>فوق دیپلم</option>
                                        <option value="4"  @php if ( $user->edu == 4 ) {echo "selected";} @endphp>کارشناسی</option>
                                        <option value="5"  @php if ( $user->edu == 5 ) {echo "selected";} @endphp>کارشناسی ارشد</option>
                                        <option value="6"  @php if ( $user->edu == 6 ) {echo "selected";} @endphp>دکتری</option>
                                        <option value="7"  @php if ( $user->edu == 7 ) {echo "selected";} @endphp>حوزوی سطح 1</option>
                                        <option value="8"  @php if ( $user->edu == 8 ) {echo "selected";} @endphp>حوزوی سطح 2</option>
                                        <option value="9"  @php if ( $user->edu == 9 ) {echo "selected";} @endphp>حوزوی سطح 3</option>
                                        <option value="10"  @php if ( $user->edu == 10 ) {echo "selected";} @endphp>حوزوی سطح 4</option>
                                    </select>

                                </div>

                            </div>

                            <div class="form-outline mb-4">
                                <label class="form-label" for="vnumber">*شماره مجازی ( شماره ای که با آن حساب های کاربری
                                    شبکه های مجازی خود را می سازید )</label>
                                <input type="text" id="vnumber" name="vnumber" class="form-control" value="{{ $user->social_mobile }}"/>
                            </div>

                            <br>
                            <label class="form-label" for="form3Example1q">شبکه های مجازی که در آن عضو هستید را مشخص
                                کنید.</label>

                            <br>
                            <br>

                            <h4 class="form-label" form="form3Example1q">پیامرسان های خارجی</h4>

                            <div class="row">
                                <div class="col-6">
                                    <input type="checkbox" id="twitter" name="twitter" onclick="" @php if ( str_contains($user->external_social,"twitter") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="twitter">توئیتر</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="telegram" name="telegram" @php if ( str_contains($user->external_social,"telegram") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="telegram">تلگرام</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="instagram" name="instagram" @php if ( str_contains($user->external_social,"instagram") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="instagram">اینستاگرام</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="whatsapp" name="whatsapp" @php if ( str_contains($user->external_social,"whatsapp") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="whatsapp">واتساپ</label>
                                </div>

                                <div class="form-outline col-12 mt-1">
                                    <input type="text" id="twitter_account" name="twitter_account" class="form-control"


                                           @php

                                            if ( $user->twitter_account == null || empty($user->twitter_account) ){
                                                echo 'style="display: none"';
                                            }else{
                                                echo 'style="display: block"';
                                            }

                                           @endphp


                                           placeholder="*نام حساب کاربری توئیتر" value="{{ $user->twitter_account }}"/>
                                </div>

                                <div class="form-outline col-12 mt-2">
                                    <input type="text" id="instagram_account" name="instagram_account"  class="form-control"

                                           @php

                                               if ( $user->instagram_account == null || empty($user->instagram_account)){
                                                   echo 'style="display: none"';
                                               }else{
                                                   echo 'style="display: block"';
                                               }

                                           @endphp

                                           placeholder="*نام حساب کاربری اینستاگرام" value="{{ $user->instagram_account }}"/>
                                </div>

                            </div>


                            <hr/>


                            <h4 class="form-label" for="form3Example1q">پیامرسان های ایرانی</h4>

                            <div class="row">
                                <div class="col-6">
                                    <input type="checkbox" id="eita" name="eita" @php if ( str_contains($user->internal_socials,"eita") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="eita">ایتا</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="bale" name="bale" @php if ( str_contains($user->internal_socials,"bale") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="bale">بله</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="soroosh" name="soroosh" @php if ( str_contains($user->internal_socials,"soroosh") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="soroosh">سروش</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="igap" name="igap" @php if ( str_contains($user->internal_socials,"igap") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="igap">آی گپ</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="roobika" name="roobika" @php if ( str_contains($user->internal_socials,"roobika") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="roobika">روبیکا</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="virasti" name="virasti" @php if ( str_contains($user->internal_socials,"virasti") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="virasti">ویراستی</label>
                                </div>

                                <div class="col-6">
                                    <input type="checkbox" id="other" name="other" @php if ( str_contains($user->internal_socials,"other") ) {echo "checked";} @endphp>
                                    <label class="form-label" for="other">سایر</label>
                                </div>

                            </div>

                            <br>


                            <button type="submit" class="btn btn-success btn-lg mb-1">ذخیره</button>


                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

</body>



<script>



    $(document).ready(function(){
        $("#twitter").on('click', function(){
            if ($('#twitter').is(":checked")){
                $("#twitter_account").show(500);
            }else{
                $("#twitter_account").hide(500);
            }
        });


        $("#instagram").on('click', function(){
            if ($('#instagram').is(":checked")){
                $("#instagram_account").show(500);
            }else{
                $("#instagram_account").hide(500);
            }
        });
    });

</script>

</html>

