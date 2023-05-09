@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات دانش آموز</h3>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <td class="font-weight-bold">شناسه</td>
                            <td>{{ $user->id }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام</td>
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام خانوادگی</td>
                            <td>{{ $user->lname }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">سن</td>
                            <td>{{ $user->age }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تحصیلات</td>
                            <td>@php
                                    switch ($user->edu){
                                        case 0:
                                            echo "دانش آموز";
                                            break;
                                        case 1:
                                            echo "سیکل";
                                        break;
                                        case 2:
                                            echo "دیپلم";
                                        break;
                                        case 3:
                                            echo "فوق دیپلم";
                                        break;
                                        case 4:
                                            echo "کارشناسی";
                                        break;
                                        case 5:
                                            echo "کارشناسی ارشد";
                                        break;
                                        case 6:
                                            echo "دکتری";
                                        break;
                                        case 7:
                                            echo "حوزوی سطح 1";
                                        break;
                                        case 8:
                                            echo "حوزوی سطح 2";
                                        break;
                                        case 9:
                                            echo "حوزوی سطح 3";
                                        break;
                                        case 10:
                                            echo "حوزوی سطح 4";
                                        break;
                                        default:
                                            echo "نامشخص";
                                            break;
                                    }
                                @endphp</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">جنسیت</td>
                            <td>
                                @php
                                    if ($user->gender == 1){
                                        echo "مرد";
                                    }else{
                                        echo "زن";
                                    }
                                @endphp
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره موبایل ثبت نامی</td>
                            <td>{{ $user->mobile }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره موبایل مجازی</td>
                            <td>{{ $user->social_mobile }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">پلتفرم های داخلی</td>
                            <td>{{ $user->internal_socials }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">پلتفرم های خارجی</td>
                            <td>{{ $user->external_social }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">اکانت توئیتر</td>
                            <td>{{ $user->twitter_account }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">اکانت اینستاگرام</td>
                            <td>{{ $user->instagram_account  }}</td>
                        </tr>

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{--  {{ $user_requests->appends(['search' => request('search')])->render() }}--}}
                </div>
            </div>
            <!-- /.card -->

        </div>
    </div>
@endsection
