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
                            <td class="font-weight-bold">نام خانواده</td>
                            <td>{{ $user->name }}</td>
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
                            <td class="font-weight-bold">نام و نام خانوادگی پدر خانواده</td>
                            <td>{{ $user->father_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">کد ملی پدر خانواده</td>
                            <td>{{ $user->father_national_code }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد پدر خانواده</td>
                            <td>{{ jdate($user->birthdate)->format('Y-m-d') }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره تماس پدر خانواده</td>
                            <td>{{ $user->father_phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام و نام خانوادگی مادر خانواده</td>
                            <td>{{ $user->mother_name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شماره تماس مادر خانواده</td>
                            <td>{{ $user->mother_phone }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام فرزند اول</td>
                            <td>{{ $user->childs[0]->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد فرزند اول</td>
                            <td>{{ isset($user->childs[0]->birthdate)? jdate($user->childs[0]->birthdate)->format('Y-m-d') : "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام فرزند دوم</td>
                            <td>{{ $user->childs[1]->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد فرزند دوم</td>
                            <td>{{ isset($user->childs[1]->birthdate)? jdate($user->childs[1]->birthdate)->format('Y-m-d') : "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام فرزند سوم</td>
                            <td>{{ $user->childs[2]->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد فرزند سوم</td>
                            <td>{{ isset($user->childs[2]->birthdate)? jdate($user->childs[2]->birthdate)->format('Y-m-d') : "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">نام فرزند چهارم</td>
                            <td>{{ $user->childs[3]->name ?? "" }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد فرزند چهارم</td>
                            <td>{{ isset($user->childs[3]->birthdate)? jdate($user->childs[3]->birthdate)->format('Y-m-d') : "" }}</td>
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
