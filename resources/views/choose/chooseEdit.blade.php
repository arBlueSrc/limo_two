@php use App\Models\Major; @endphp
    <!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>مسابقات قرآن</title>
    <meta content="مسابقات قرآن" name="description">
    <meta content="مسابقات قرآن" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
    {{--    {{ asset('landing_assets/') }}--}}
    <link href="{{ asset('landing_assets/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

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

    <!-- Template Main CSS File -->
    <link href="{{ asset('landing_assets/assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
    * Template Name: UpConstruction - v1.3.0
    * Template URL: https://bootstrapmade.com/upconstruction-bootstrap-construction-website-template/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->

    {{--<script>
        !function(e,t,n){e.yektanetAnalyticsObject=n,e[n]=e[n]||function(){e[n].q.push(arguments)},e[n].q=e[n].q||[];var a=t.getElementsByTagName("head")[0],r=new Date,c="https://cdn.yektanet.com/superscript/Skz6HmQM/native-event.quranbsj.ir-32370/yn_pub.js?v="+r.getFullYear().toString()+"0"+r.getMonth()+"0"+r.getDate()+"0"+r.getHours(),s=t.createElement("link");s.rel="preload",s.as="script",s.href=c,a.appendChild(s);var l=t.createElement("script");l.async=!0,l.src=c,a.appendChild(l)}(window,document,"yektanet");
    </script>--}}

</head>

<style>

    @font-face {
        font-family: Shabnam;
        src: url('landing_assets/fonts/Shabnam.ttf');
    }
    @font-face {
        font-family: Shabnam;
        font-weight: bold;
        src: url('landing_assets/fonts/Shabnam.ttf');
    }

    .h1, h2, h3, h4, h5, div, a {
        font-family: Shabnam, serif;
    }

</style>

<body style="background: white">

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center" dir="rtl">

    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


        <a href="#" class="logo d-flex align-items-center">

            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 style="font-family: Shabnam; margin-right: 20px;">مسابقات قرآن<span>.</span></h1>
        </a>

        <div class="row">

            @if(auth()->user()->role == 0)
                <a href="{{ route('show_form') }}"
                   class="btn btn-primary btn-sm text-white" style="font-family: Shabnam">برگشت</a>
            @endif

        </div>

    </div>

</header><!-- End Header -->


<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">

    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" dir="rtl">

                    <div class="alert" role="alert">

                        <h4 data-aos="fade-down" class="text-muted">
                            @if(sizeof($single_forms) == 0 && sizeof($group_forms) == 0 && sizeof($family_forms) == 0)
                                هنوز فرمی ثبت نکرده اید
                                @else
                                فرم مورد نظر را برای ویرایش انتخاب کنید
                            @endif
                        </h4>
                        <br>

                        @foreach($single_forms as $single_item)

                            <a data-aosa-aos="fade-up" data-aos-delay="200" href="{{ route('singleEdit',['id' => $single_item->id]) }}"
                               class="btn-get-started" style="font-family: Shabnam">فردی
                                - {{ $single_item->name . " - " . Major::find($single_item->major)->name }}</a>
                            <br>

                        @endforeach

                        @foreach($group_forms as $group_item)

                            <a data-aosa-aos="fade-up" data-aos-delay="200" href="{{ route('groupEdit',['id' => $group_item->id]) }}"
                               class="btn-get-started" style="font-family: Shabnam">گروهی
                                - {{ $group_item->name_group  }}</a>
                            <br>

                        @endforeach

                        @foreach($family_forms as $family_item)

                            <a data-aosa-aos="fade-up" data-aos-delay="200" href="{{ route('familyEdit',['id' => $family_item->id]) }}"
                               class="btn-get-started" style="font-family: Shabnam">خانوادگی
                                - {{ $family_item->name   }}</a>
                            <br>

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-item active" style="background: black"></div>
    </div>

</section><!-- End Hero Section -->


<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="{{ asset('landing_assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('landing_assets/assets/vendor/php-email-form/validate.js') }}"></script>

<!-- Template Main JS File -->
<script src="{{ asset('landing_assets/assets/js/main.js') }}"></script>

</body>

</html>
























