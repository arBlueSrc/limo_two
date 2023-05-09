@extends('admin.layouts.master')
@section('content')


   {{-- @if(session()->has('register'))

        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-bullhorn"></i>
                        اعلانات
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="callout callout-warning">
                        <h5>حساب کاربری شما ساخته شد!</h5>

                        <p>لطفا تا تایید مرکز صبر کنید.به محض تایید مرکز به شما اطلاع رسانی خواهد گردید</p>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    @endif--}}
    <div class="col-md-6">
        {{--<div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fa fa-bullhorn"></i>
                    اعلانات
                </h3>
            </div>
            <div class="card-body">--}}
   {{-- <div class="alert alert-info alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="--}}{{--icon fa fa-info--}}{{--"></i>کاربر گرامی</h5>
        تشکر بابت ثبت اطلاعات,
        این سامانه در حال ارتقاء می باشد.
    </div>--}}
        {{--@can('can_complete_profile')
        <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fa fa-warning"></i> توجه!</h5>
            کاربر گرامی , مدرک تخصصی شما جهت تایید حساب کاربری شما لازم است.جهت بارگزاری مدرک تخصصی به بخش تکمیل پروفایل مراجعه کنید.
        </div>
            @endcan--}}
            </div>
   {{--     </div>
    </div>--}}
@endsection
