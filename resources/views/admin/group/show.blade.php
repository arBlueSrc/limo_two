@extends('admin.layouts.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">اطلاعات گروه</h3>
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
                            <td class="font-weight-bold">نام گروه</td>
                            <td>{{ $user->name_group }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">استان</td>
                            <td>{{ $user->ostan()->first()->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شهرستان</td>
                            <td>{{ $user->shahrestan()->first()->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">مسجد</td>
                            <td>{{ "حوزه : ". $user->mosque()->first()->hoze . " - مسجد :  " . $user->mosque()->first()->masjed}}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">مدل شرکت گروه</td>
                            <td>{{ $user->type == 1 ?  "شرکت به صورت مدل اول (هر فرد یک تکلیف)" : "شرکت به صورت مدل دوم (حفظ گروهی سوره مبارکه الرحمن)" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام و نام خانوادگی سرگروه</td>
                            <td>{{ $user->head_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">کد ملی سرگروه</td>
                            <td>{{ $user->head_national_code }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره تماس سرگروه</td>
                            <td>{{ $user->head_phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد سرگروه</td>
                            <td>{{ jdate($user->birthday)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام و نام خانوادگی نفر دوم</td>
                            <td>{{ $user->second_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره تماس نفر دوم</td>
                            <td>{{ $user->second_phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام و نام خانوادگی نفر سوم</td>
                            <td>{{ $user->third_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره تماس نفر سوم</td>
                            <td>{{ $user->third_phone }}</td>
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
