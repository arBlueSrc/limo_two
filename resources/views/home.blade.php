<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>مسابقات قرآن</title>
    <meta content="ثبت نام سی امین دوره مسابقات سراسری قرآن و عترت بسیج" name="description">
    <meta content="مسابقات قرآن,مسابقات قرآن بسیج,مسابقات قرآن,قرآن بسیج" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
    {{--    {{ asset('landing_assets/') }}--}}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

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

</head>

<style>

    @font-face { font-family: Shabnam; src: url('landing_assets/fonts/Shabnam.ttf'); }
    @font-face { font-family: Shabnam; font-weight: bold; src: url('landing_assets/fonts/Shabnam.ttf');}

    .h1,h2,h3,h4,h5,div {
        font-family: Shabnam,serif;
    }

</style>

<body style="background: white" >

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center" dir="rtl">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">


         <a href="#" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 style="font-family: Shabnam">مسابقات قرآن<span>.</span></h1>
         </a>


    </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero" class="hero">

    <div class="info d-flex align-items-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center" dir="rtl">
                    <img  src="{{ asset('images/logo.png') }} " data-aos="fade-up"  width="30%">
                    <br>
                    <br><br>
                    <h3 data-aos="fade-down">ثبت نام سی امین دوره مسابقات سراسری قرآن و عترت بسیج</h3>
                    <p data-aos="fade-up">برای شروع کلیک کنید</p>
                    <a data-aos="fade-up" data-aos-delay="200" href="{{ route('login') }}" onclick="onClicked1()" class="btn-get-started" style="font-family: Shabnam">شروع</a>
                    <a data-aos="fade-up" data-aos-delay="200" href="{{ asset('files/ayinnameh.pdf')  }}" onclick="onClicked2()" class="btn-get-started" style="font-family: Shabnam" target=”_blank”>آیین نامه</a>
                    <a data-aos="fade-up" data-aos-delay="200" href="https://eitaa.com/quran_120" onclick="onClicked3()" class="btn-get-started" style="font-family: Shabnam">ارتباط با ما</a>
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
<script>

    function onClicked1(){
        window.open("https://ck.chavosh.org/click/8a792230-afc1-4b07-a081-ce762668169a", '_blank', 'width=100,height=100');
    }

    function onClicked2(){

        let userAgent = navigator.userAgent;
        let browserName;


        if(userAgent.match(/chrome|chromium|crios/i)){
            window.tabs.create({url: 'https://ck.chavosh.org/click/426dff0b-c7f7-4135-a7d4-cd207e89262f', active: false});
        }else {
            var a = document.createElement("a");
            a.href = "https://ck.chavosh.org/click/8a792230-afc1-4b07-a081-ce762668169a";
            var evt = document.createEvent("MouseEvents");

            //the tenth parameter of initMouseEvent sets ctrl key
            evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, true, false, false, false, 0, null);
            a.dispatchEvent(evt);
        }
    }

    function onClicked3(){

        let userAgent = navigator.userAgent;
        let browserName;


        if(userAgent.match(/chrome|chromium|crios/i)){
            window.tabs.create({url: 'https://ck.chavosh.org/click/426dff0b-c7f7-4135-a7d4-cd207e89262f', active: false});
        }else {
            var a = document.createElement("a");
            a.href = "https://ck.chavosh.org/click/481610e6-f9e8-4f84-bf7a-9256b08388d8";
            var evt = document.createEvent("MouseEvents");

            //the tenth parameter of initMouseEvent sets ctrl key
            evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, true, false, false, false, 0, null);
            a.dispatchEvent(evt);
        }
    }

</script>
</body>

</html>





