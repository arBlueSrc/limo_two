<!DOCTYPE html>
<html lang="en">
<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact;
            color-adjust: exact;
        }
    }
    @font-face {
        font-family: 'Shekasteh_beta';
        src: url({{ asset('fonts/Shekasteh_beta.eot') }});
        src: url({{ asset('fonts/Shekasteh_beta.eot?#iefix') }}) format('embedded-opentype'), url({{ asset('fonts/Shekasteh_beta.woff') }}) format('woff'), url({{ asset('fonts/Shekasteh_beta.woff2') }}) format('woff2');
    }
    @font-face {
        font-family: 'BNaznnBd';
        src: url({{ asset('fonts/BNaznnBd.eot') }});
        src: url({{ asset('fonts/BNaznnBd.eot?#iefix') }}) format('embedded-opentype'), url({{ asset('fonts/BNaznnBd.woff2') }}) format('woff2'), url({{ asset('fonts/BNaznnBd.woff') }}) format('woff');
    }
    body {
        font-family: 'BNaznnBd';
    }
    .over {
        width: 21cm;
        height: 29.7cm;
        z-index: 11;
        position: absolute;
        top: 0;
        left: 0;
    }
    .main {
        width: 21cm;
        height: 29.7cm;
        position: relative;
    }
    .bg img {
        direction: rtl;
        width: 21cm;
        height: 29.7cm;
    }
    .main .name {
        font-family: 'Shekasteh_beta';
        position: absolute;
        top: 12.85cm;
        right: 5.9cm;
        text-align: right;
        direction: rtl;
        font-size: 33px;
        width: 15cm;
        color: #000;
    }
    .main .identifier{
        position: absolute;
        top: 9.25cm;
        right: 9.8cm;
        text-align: right;
        direction: rtl;
        font-size: 33px;
        width: 15cm;
        color: #000;
    }
    .msg_hide {
        display: none;
    }
    @media screen and (min-width: 10px) and (max-width: 1130px) {
        .msg_hide {
            display: block;
        }
        .side_left {
            width: 100%;
            z-index: 1;
        }
        .main, .side_left .txt .btn-group .btn {
            display: none;
        }
    }
    @media screen and (min-width: 1130px) and (max-width: 1494px) {
        .side_left {
            opacity: 0.85;
        }
    }
</style>

<head>
    <meta charset="UTF-8">
    <title> لوح تقدیر </title>
    <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-rtl.min.css') }}">
    <style></style>
</head>
{{--<body onload="window.print()">--}}
<div class="over"></div>
<div class="msg_hide"> برای مشاهده لوح سپاس باید از طریق دسکتاپ وارد شوید</div>
<form class="main">
    <div class="bg"><img src="{{ asset("images/loh2.png") }}"></div>
    <div class="identifier"> {{ $identifier }} </div>
    <div class="name"> {{ $name }} </div>
</form>
{{--<script>document.addEventListener('contextmenu', event => event.preventDefault());</script>--}}
</body>
</html>

