@extends('participate.layouts.master')
@section('content')

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
                                        <a class="float-right"><b>فردی : </b>{{ $single_count }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="float-right"><b>گروهی : </b>{{ $family_count }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <a class="float-right"><b>خانوادگی : </b>{{ $group_count }}</a>
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
                                    <li hidden class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ویرایش
                                            اطلاعات شخصی</a></li>
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

                                                <p>
                                                    <a href="https://eitaa.com/quran_120" class="link-black text-sm mr-2"><i
                                                            class="fa fa-share mr-1"></i> پیام به پشتیبانی در ایتا </a>

                                            </div>
                                            <!-- /.post -->

                                        </div>
                                        <!-- /.tab-pane -->

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
                                                            شروع ثبت نام از تاریخ 1 خرداد شروع و تا 10 مرداد ماه 1402
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
                                                            10 مرداد از طریق پیامک اطلاع رسانی خواهد شد.
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
                                            <form class="form-horizontal">
                                                <div class="form-group">
                                                    <label for="inputName" class="col-sm-2 control-label">نام</label>

                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputName"
                                                               placeholder="نام" value="{{ auth()->user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="inputEmail" class="col-sm-2 control-label">نام
                                                        خانوادگی</label>

                                                    <div class="col-sm-10">
                                                        <input type="email" class="form-control" id="inputEmail"
                                                               placeholder="نام خانوادگی"
                                                               value="{{ auth()->user()->family }}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-danger">تایید</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <!-- /.tab-pane -->

                                    </div>

                                @endforeach

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

@endsection