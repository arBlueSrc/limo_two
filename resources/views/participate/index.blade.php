@extends('participate.layouts.master')
@section('content')

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
            top: 12.55cm;
            right: 6.7cm;
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


        /* Hide the native file input */
        input[type="file"] {
            display: none;
        }

        /* Style the custom file input wrapper */
        .file-input {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .custom-file-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-name {
            font-style: italic;
            color: #555;
        }

    </style>

    @if(false)
        <div class="col-md-12">
            <div class="alert alert-warning alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fa fa-warning"></i> توجه!</h5>
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و
                متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است
            </div>
            <!-- /.card -->
        </div>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="col-md-12">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>حساب کاربری</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-left">
                            <li class="breadcrumb-item"><a href="#">شرکت کننده</a></li>
                            <li class="breadcrumb-item active">حساب کاربری</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle"
                                         src="{{ asset("images/avatar.png") }}"
                                         alt="User profile picture">
                                </div>

                                <h3 class="profile-username text-center">{{ auth()->user()->name . " " . auth()->user()->family }}</h3>

                                <p class="text-muted text-center">شرکت کننده</p>

                                <ul class="list-group list-group-unbordered mb-3">
                                    <li class="list-group-item">
                                        <a class="float-right"><b>موبایل : </b>{{ auth()->user()->mobile }}</a>
                                    </li>

                                </ul>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                        <!-- About Me Box -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">درباره شما</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <strong><i class="fa fa-book mr-1"></i>تعداد فرم های ثبت نامی شما</strong>

                                <p class="text-muted">
                                    {{ $single_count+$family_count+$group_count }}
                                </p>

                                <hr>

                                <ul class="list-group  mb-3">
                                    <li class="list-group-item">
                                        <div><b>فردی : </b>{{ $single_count }}</div>
                                        @foreach($single_forms as $index => $item)
                                            <div class=" card mt-3 p-3">
                                                @php
                                                    $major = \App\Models\Major::find($item->major);
                                                    $files = \App\Models\UploadFile::where('single_result_id', $item->id);
                                                    $card_meli   = \App\Models\UploadFile::where('single_result_id', $item->id)->where('type',1)->first();
                                                    $madrak      = \App\Models\UploadFile::where('single_result_id', $item->id)->where('type',2)->first();
                                                    $tarh_dars   = \App\Models\UploadFile::where('single_result_id', $item->id)->where('type',3)->first();
                                                    $tadrisVideo = \App\Models\UploadFile::where('single_result_id', $item->id)->where('type',4)->first();
                                                @endphp


                                                {{--                                                @dd($tarh_dars)--}}
                                                <p>{{ $item->name . " - " . $major->name }}</p>
                                                @if($major->id == 55 || $major->id == 56)

                                                    <form method="POST" action="{{ route('uploadFile') }}" id="form"
                                                          enctype="multipart/form-data">
                                                        @csrf

                                                        <input value="{{ $item->id }}" name="id" hidden>

                                                        <div class="form-outline mb-4">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label btn btn-info"
                                                                       for="meliCard{{ $index }}">بارگذاری تصویر کارت
                                                                    ملی</label>
                                                                @if($card_meli != null)
                                                                    <a href="{{ url('storage/'.$card_meli->path) }}"
                                                                       class="btn btn-warning">مشاهده فایل</a>
                                                                @endif
                                                            </div>

                                                            <input type='file' name="meliCard{{ $index }}"
                                                                   id="meliCard{{ $index }}">

                                                            <span class="custom-file-name"
                                                                  id="file-name1{{ $index }}">فایل انتخابی : </span>
                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label btn btn-info"
                                                                       for="madrak{{ $index }}">بارگذاری مدرک تربیت
                                                                    مربی</label>
                                                                @if($madrak != null)
                                                                    <a href="{{ url('storage/'.$madrak->path) }}"
                                                                       class="btn btn-warning">مشاهده فایل</a>
                                                                @endif
                                                            </div>
                                                            <input type='file' name="madrak{{ $index }}"
                                                                   id="madrak{{ $index }}">

                                                            <span class="custom-file-name"
                                                                  id="file-name2{{ $index }}">فایل انتخابی : </span>

                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label btn btn-info"
                                                                       for="tarh_dars{{ $index }}">بارگذاری طرح درس pdf
                                                                </label>
                                                                @if($tarh_dars != null)
                                                                    <a href="{{ url('storage/'.$tarh_dars->path) }}"
                                                                       class="btn btn-warning"> مشاهده فایل</a>
                                                                @endif
                                                            </div>
                                                            <input type='file' name="tarh_dars{{ $index }}"
                                                                   id="tarh_dars{{ $index }}">
                                                            <span class="custom-file-name"
                                                                  id="file-name3{{ $index }}">فایل انتخابی : </span>
                                                        </div>

                                                        <div class="form-outline mb-4">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label btn btn-info"
                                                                       for="tadrisVideo{{ $index }}">بارگذاری فایل
                                                                    ویدئویی
                                                                    تدریس
                                                                </label>
                                                                @if($tadrisVideo != null)
                                                                    <a href="{{ url('storage/'.$tadrisVideo->path) }}"
                                                                       class="btn btn-warning"
                                                                       @if($card_meli == null) hidden @endif>مشاهده
                                                                        فایل</a>
                                                                @endif
                                                            </div>
                                                            <input type='file' name="tadrisVideo{{ $index }}"
                                                                   id="tadrisVideo{{ $index }}">
                                                            <span class="custom-file-name"
                                                                  id="file-name4{{ $index }}">فایل انتخابی : </span>
                                                        </div>

                                                        <div class="col-12 mt-2">
                                                            <button type="submit" class="btn btn-success w-100"
                                                                    id="sendFile">ارسال فایل انتخاب شده
                                                            </button>
                                                        </div>
                                                    </form>

                                                @endif


                                                @if($major->id == 54)

                                                    <form method="POST" action="{{ route('uploadFile') }}" id="form"
                                                          enctype="multipart/form-data">
                                                        @csrf

                                                        <input value="{{ $item->id }}" name="id" hidden>

                                                        <div class="form-outline mb-4">
                                                            <div class="d-flex justify-content-between">
                                                                <label class="form-label btn btn-info"
                                                                       for="tadrisVideo{{ $index }}">بارگذاری فایل
                                                                    ویدئویی
                                                                    تدریس
                                                                </label>

                                                                @if($tadrisVideo != null)
                                                                    <a href="{{ url('storage/'.$tadrisVideo->path) }}"
                                                                       class="btn btn-warning"
                                                                    >مشاهده
                                                                        فایل</a>
                                                                @endif
                                                            </div>
                                                            <input type='file' name="tadrisVideo{{ $index }}"
                                                                   id="tadrisVideo{{ $index }}">
                                                            <span class="custom-file-name"
                                                                  id="file-name4{{ $index }}">فایل انتخابی : </span>
                                                        </div>

                                                        <div class="col-12 mt-2">
                                                            <button type="submit" class="btn btn-success w-100"
                                                                    id="sendFile">ارسال فایل انتخاب شده
                                                            </button>
                                                        </div>
                                                    </form>
                                                @endif

                                            </div>
                                        @endforeach
                                    </li>

                                    <li class="list-group-item">
                                        <a class="float-right"><b>گروهی : </b>{{ $family_count }}</a>
                                        @foreach($family_forms as $item)
                                            <br>
                                            <span class="badge badge-success">{{ $item->name }}</span>
                                        @endforeach
                                    </li>

                                    <li class="list-group-item">
                                        <a class="float-right"><b>خانوادگی : </b>{{ $group_count }}</a>
                                        @foreach($group_forms as $item)
                                            <br>
                                            <span class="badge badge-primary">نام گروه : {{ $item->name_group }}</span>
                                            <span class="badge badge-primary">سرگروه : {{ $item->head_name }}</span>
                                            <span class="badge badge-primary">فرد دوم: {{ $item->second_name }}</span>
                                            <span class="badge badge-primary">فرد سوم: {{ $item->third_name }}</span>
                                        @endforeach
                                    </li>

                                </ul>


                                <strong><i class="fa fa-pencil mr-1"></i>تعداد استفاده از شماره شما به عنوان
                                    معرف</strong>

                                <p class="text-muted">
                                    <span class="badge badge-danger">{{ $moaref_count }} عدد</span>
                                </p>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                <ul class="nav nav-pills">
                                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">اطلاعیه
                                            ها</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">زمان
                                            بندی مسابقه</a></li>
                                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">تقدیرنامه</a>
                                    </li>
                                </ul>
                            </div><!-- /.card-header -->
                            <div class="card-body">

                                @foreach($messages as $msg)

                                    <div class="tab-content">

                                        <div class="active tab-pane" id="activity">
                                            <!-- Post -->
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                         src="{{ asset('images/logo.png') }}" alt="user image">
                                                    <span class="username">
                                                  <a href="#">
                                                      @if($msg->sender_id == null)
                                                          دارلقران بسیج
                                                      @endif
                                                  </a>
                                                    </span>
                                                    <span
                                                        class="description">ارسال شده در {{ jdate($msg->created_at)->format(' Y/m/d ') }}</span>
                                                </div>
                                                <!-- /.user-block -->
                                                <p>
                                                    {{ $msg->message }}
                                                </p>

                                                {{-- <p>--}}
                                                <a href="https://eitaa.com/quran_120" class="link-black text-sm mr-2"><i
                                                        class="fa fa-share mr-1"></i> پیام به پشتیبانی در ایتا </a>
                                            </div>
                                            <!-- /.post -->
                                        </div>
                                        <!-- /.tab-pane -->
                                        @endforeach


                                        <div class="tab-pane" id="timeline">
                                            <!-- The timeline -->
                                            <ul class="timeline timeline-inverse">
                                                <!-- timeline time label -->
                                                <li class="time-label">
                                                    <span class="bg-danger">
                                                      1 خرداد 1402
                                                    </span>
                                                </li>
                                                <!-- /.timeline-label -->
                                                <!-- timeline item -->
                                                <li>
                                                    <i class="fa fa-envelope bg-primary"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i class="fa fa-clock-o"></i> 12:00</span>

                                                        <h3 class="timeline-header"><a href="#">تیم پشتیبانی</a></h3>

                                                        <div class="timeline-body">
                                                            شروع ثبت نام از تاریخ 1 مرداد شروع و تا 31 مرداد ماه 1403
                                                            ادامه خواهد داشت.
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- END timeline item -->
                                                <!-- timeline item -->
                                                <li>
                                                    <i class="fa fa-user bg-info"></i>

                                                    <div class="timeline-item">
                                                        <span class="time"><i
                                                                class="fa fa-clock-o"></i> 5 روز پیش</span>
                                                        <h3 class="timeline-header no-border">تمامی مراحل ثبت نام در
                                                            31 مرداد از طریق پیامک اطلاع رسانی خواهد شد.
                                                        </h3>
                                                    </div>
                                                </li>
                                                <!-- END timeline item -->

                                                <!-- END timeline item -->
                                                <li>
                                                    <i class="fa fa-clock-o bg-gray"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- /.tab-pane -->

                                        <div class="tab-pane" id="settings">

                                            @foreach($single_results as $single_result)
                                                <div class="mt-2" style="font-weight: bold !important;">
                                                    <form action="{{ route('printLoh') }}" id="loh-print" method="post">
                                                        @csrf
                                                        <input type="hidden" name="name"
                                                               value="{{$single_result->name}}">
                                                        <input type="hidden" name="identifier"
                                                               value="{{$single_result->id}}">
                                                        <button type="submit"
                                                                class="btn btn-primary btn-sm text-white col-4">چاپ
                                                            تقدیرنامه {{ $single_result->name }}</button>
                                                        {{--<a href="{{ route('printLoh',['single_result' => $single_result->id ]) }}"
                                                           class="btn btn-primary btn-sm text-white col-4" style=" font-weight: bold"> چاپ تقدیرنامه {{ $single_result->name }}</a>--}}
                                                    </form>
                                                </div>
                                                {{--<a href="{{ route('printLoh',['name' => $single_result ]) }}"
                                                   class="btn btn-primary btn-sm text-white col-4" style="font-family: Shabnam">پرینت تقدیرنامه</a>

                                                <a href="{{ route('printLoh',['name' => $name ]) }}"
                                                   class="btn btn-primary btn-sm text-white col-4" style="font-family: Shabnam">پرینت تقدیرنامه</a>--}}
                                            @endforeach
                                            <br>

                                            <div class="msg_hide"> برای مشاهده لوح سپاس باید از طریق کامپیوتر وارد
                                                شوید
                                            </div>

                                            <form class="main">

                                                <div class="bg"><img src="{{ asset("images/loh.jpg") }}"></div>
                                                <div class="name"> {{ $name }} </div>

                                            </form>
                                            <div class="alert alert-info alert-dismissible">
                                                {{--                                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>--}}
                                                <h5><i class="icon fa fa-info"></i> توجه!</h5>
                                                در صورت شرکت در مسابقات میتوانید با مراجعه به سایت لوح تقدیر خود را
                                                دریافت کنید.
                                            </div>

                                            {{--        <div class="alert alert-info"> </div>--}}


                                        </div>
                                        <!-- /.tab-pane -->

                                    </div>

                                    {{--                                @endforeach--}}

                                    <!-- /.tab-content -->
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    {{--    <script>document.addEventListener('contextmenu', event => event.preventDefault());</script>--}}

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {

        @foreach ($single_forms as $index => $item)
        const meliCard{{ $index }}    = document.getElementById("meliCard{{ $index }}");
        const madrak{{ $index }}      = document.getElementById("madrak{{ $index }}");
        const tarh_dars{{ $index }}   = document.getElementById("tarh_dars{{ $index }}");
        const tadrisVideo{{ $index }} = document.getElementById("tadrisVideo{{ $index }}");

        const fileName1{{ $index }} = document.getElementById("file-name1{{ $index }}");
        const fileName2{{ $index }} = document.getElementById("file-name2{{ $index }}");
        const fileName3{{ $index }} = document.getElementById("file-name3{{ $index }}");
        const fileName4{{ $index }} = document.getElementById("file-name4{{ $index }}");

        tadrisVideo{{ $index }}.addEventListener("change", function () {
            if (tadrisVideo{{ $index }}.files.length > 0) {
                fileName4{{ $index }}.textContent = 'فایل انتخابی : ' + tadrisVideo{{ $index }}.files[0].name; // Show the selected file name
            } else {
                fileName4{{ $index }}.textContent = "فایل انتخابی : "; // Reset if no file is selected
            }
        });

        tarh_dars{{ $index }}.addEventListener("change", function () {

            if (tarh_dars{{ $index }}.files.length > 0) {
                fileName3{{ $index }}.textContent = 'فایل انتخابی : ' + tarh_dars{{ $index }}.files[0].name; // Show the selected file name
            } else {
                fileName3{{ $index }}.textContent = "فایل انتخابی : "; // Reset if no file is selected
            }
        });

        madrak{{ $index }}.addEventListener("change", function () {

            if (madrak{{ $index }}.files.length > 0) {
                fileName2{{ $index }}.textContent = 'فایل انتخابی : ' + madrak{{ $index }}.files[0].name; // Show the selected file name
            } else {
                fileName2{{ $index }}.textContent = "فایل انتخابی : "; // Reset if no file is selected
            }
        });

        meliCard{{ $index }}.addEventListener("change", function () {

            if (meliCard{{ $index }}.files.length > 0) {
                fileName1{{ $index }}.textContent = 'فایل انتخابی : ' + meliCard{{ $index }}.files[0].name; // Show the selected file name
            } else {
                fileName1{{ $index }}.textContent = "فایل انتخابی : "; // Reset if no file is selected
            }
        });

        @endforeach

    });
</script>
