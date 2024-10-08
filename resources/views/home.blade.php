<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>مسابقات قرآن</title>
    <meta content="ثبت نام سی و یک امین دوره مسابقات سراسری قرآن و عترت بسیج" name="description">
    <meta content="مسابقات قرآن,مسابقات قرآن بسیج,مسابقات قرآن,قرآن بسیج" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('landing_assets/assets/img/favicon.png') }}" rel="icon">
{{--        {{ asset('landing_assets/') }}--}}

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <script>
        // !function(e,t,n){e.yektanetAnalyticsObject=n,e[n]=e[n]||function(){e[n].q.push(arguments)},e[n].q=e[n].q||[];var a=t.getElementsByTagName("head")[0],r=new Date,c="https://cdn.yektanet.com/superscript/Skz6HmQM/native-event.quranbsj.ir-32370/yn_pub.js?v="+r.getFullYear().toString()+"0"+r.getMonth()+"0"+r.getDate()+"0"+r.getHours(),s=t.createElement("link");s.rel="preload",s.as="script",s.href=c,a.appendChild(s);var l=t.createElement("script");l.async=!0,l.src=c,a.appendChild(l)}(window,document,"yektanet");
    </script>

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

    @font-face {
        font-family: Shabnam;
        src: url('landing_assets/fonts/Shabnam.ttf');
    }
    @font-face {
        font-family: Shabnam;
        font-weight: bold;
        src: url('landing_assets/fonts/ShabnamBold.ttf');
    }

    .h1, h2, h3, h4, h5, div {
        font-family: Shabnam, serif;
    }
    .table-azmoon{
        direction: rtl;
        text-align: right;
    }

</style>

<body style="background: white">

<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center" dir="rtl">



        <a href="#" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1 style="font-family: Shabnam; margin-right: 20px;">مسابقات قرآن<span>.</span></h1>
        </a>



</header><!-- End Header -->
<div class="container-fluid container-xl d-flex align-items-center justify-content-center mt-3">
<!-- ======= Hero Section ======= -->

    <div class="info d-flex align-items-center" style="margin-top: 200px">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col text-center" dir="rtl">
                    <div class="mb-3">
                        <img src="{{ asset('images/logo.png') }} " data-aos="fade-up" width="30%">
                    </div>
                    <h3 data-aos="fade-down" class="mt-4">ثبت نام سی و یک امین دوره مسابقات سراسری قرآن و عترت بسیج</h3>
                    <p data-aos="fade-down">مهلت ثبت نام به پایان رسید. فقط استان تهران بزرگ امکان ثبت نام دارد.</p>
                    {{--<div class="alert alert-warning alert-dismissible " style="text-align: right !important;">
                        <h5><i class="icon fa fa-warning"></i> توجه!</h5>
                        به دلیل استقبال گسترده و عدم امکان شرکت در آزمون برای تمامی شرکت کنندگان , تمامی آزمون های امروز لغو و نتایج آنها محاسبه نخواهد شد.زمان برگزاری آزمون مجدد در همین سامانه اعلام می شود.
                    </div>--}}



{{--                    <p data-aos="fade-up">ثبت نام فقط برای شهر تهران بزرگ امکان پذیر است. زمان  دقیق  مسابقات  به زودی بصورت  پیامک  از  طرف مجریان مسابقات، اطلاع رسانی می شود.</p>--}}
{{--                    <p data-aos="fade-up">ثبت نام به پایان رسیده است. زمان  دقیق  مسابقات  به زودی بصورت  پیامک  از  طرف مجریان مسابقات، اطلاع رسانی می شود.</p>--}}

                    <div class="py-5">
                    <a data-aos="fade-up" data-aos-delay="200" href="{{ route('login') }}" class="btn-get-started btn btn-outline-success btn-lg rounded m-2"
                       style="font-family: Shabnam;">ورود</a>
                    <a data-aos="fade-up" data-aos-delay="200" href="{{ asset('files/ayinnameh.pdf')  }}"
                       class="btn-get-started btn btn-outline-success btn-lg m-2" style="font-family: Shabnam" target=”_blank”>آیین نامه</a>
                    <a data-aos="fade-up" data-aos-delay="200" href="https://eitaa.com/quran_120"
                       class="btn-get-started btn btn-outline-success btn-lg m-2" style="font-family: Shabnam">ارتباط با ما</a>
                    </div>
                </div>
            </div>


            <div class="card table-azmoon mt-3" hidden>
                <div class="card-header">
                    <h3 class="card-title">زمان برگزاری آزمون ها</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table table-condensed mb-0">
                        <tbody><tr>
                            <th style="width: 10px">#</th>
                            <th>عنوان</th>
                            <th>تاریخ</th>
                            <th style="width: 40px">ساعت برگزاری</th>
                        </tr>

                        <tr>
                            <td>1.</td>
                            <td>حفظ و ترجمه 40 حدیث بالای 16 سال</td>
                            <td>
                                چهارشنبه ۳ آبان‌
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">ساعت ۱۸:۰۰ تا ۱۹:۰۰</span></td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>کتاب صراط  بالای 16 سال</td>
                            <td>
                                چهارشنبه ۳ آبان‌
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">ساعت ۲۱:۰۰ تا ۲۲:۰۰</span></td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>مفاهیم نامه 53 نهج البلاغه بالای 16 سال</td>
                            <td>
                                پنجشنبه ۴ آبان‌
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">ساعت ۱۸:۰۰ تا ۱۹:۰۰</span></td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>مفاهیم  دعای 20 صحیفه سجادیه</td>
                            <td>
                                پنجشنبه ۴ آبان‌
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">ساعت ۲۱:۰۰ تا ۲۲:۰۰</span></td>
                        </tr>
                         <tr>
                            <td>5.</td>
                            <td>مفاهيم سوره اعلی  زیر 16 سال</td>
                            <td>
                                اعلام میگردد
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">اعلام میگردد‌</span></td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td>مفاهیم سوره مؤمنون بالای 16 سال</td>
                            <td>
                                اعلام میگردد‌
                            </td>
                            <td><span class="badge bg-success" style="font-size: .8rem">اعلام میگردد‌</span></td>
                        </tr>
                        </tbody></table>
                </div>
                <!-- /.card-body -->
            </div>

            <div class="alert alert-warning mt-3" style="text-align: right !important; direction: rtl" hidden>
                <h5><i class="icon fa fa-warning"></i> توجه !</h5>
                <ul>
                    <li>زمان آزمون مطابق با جدول بالا می باشد و در رشته های مختلف متفاوت است.</li>
                    <li>پس از ورود کردن شماره تماسی که با آن ثبت‌نام کرده اید به صفحه شخصی خود وارد شده و وارد آزمون خود شوید.</li>
                    <li>زمان آزمون محدود است و فقط در ساعات تعیین شده میتوانید وارد شوید و به سوالات پاسخ دهید.</li>
                    <li>مهلت پاسخگویی به تمام سوالات فقط پانزده دقیقه می باشد.</li>
                    <li>تعداد سوالات ۲۰ سوال تستی و دو سوال تشریحی می باشد.</li>
                    <li>آزمون دارای نمره منفی (یک سوم نمره منفی) می باشد.</li>
                </ul>
            </div>



        </div>
    </div>

    <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
        <div class="carousel-item active" style="background: black"></div>
    </div>

<!-- End Hero Section -->
</div>

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

    function onClicked1() {
        window.open("https://ck.chavosh.org/click/8a792230-afc1-4b07-a081-ce762668169a", '_blank', 'width=100,height=100');
    }

    function onClicked2() {

        let userAgent = navigator.userAgent;
        let browserName;

        if (userAgent.match(/chrome|chromium|crios/i)) {
            window.tabs.create({
                url: 'https://ck.chavosh.org/click/426dff0b-c7f7-4135-a7d4-cd207e89262f',
                active: false
            });
        } else {
            var a = document.createElement("a");
            a.href = "https://ck.chavosh.org/click/8a792230-afc1-4b07-a081-ce762668169a";
            var evt = document.createEvent("MouseEvents");

            //the tenth parameter of initMouseEvent sets ctrl key
            evt.initMouseEvent("click", true, true, window, 0, 0, 0, 0, 0, true, false, false, false, 0, null);
            a.dispatchEvent(evt);
        }
    }

    function onClicked3() {

        let userAgent = navigator.userAgent;
        let browserName;


        if (userAgent.match(/chrome|chromium|crios/i)) {
            window.tabs.create({
                url: 'https://ck.chavosh.org/click/426dff0b-c7f7-4135-a7d4-cd207e89262f',
                active: false
            });
        } else {
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





