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
                            <td>{{ $user->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">استان</td>
                            <td>{{ $user->ostan()->first()->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">شهرستان</td>
                            <td>{{ $user->shahrestan()->first()->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">مسجد</td>
                            <td>{{ $user->mosque()->first()->hoze . " - " . $user->mosque()->first()->masjed  }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">رشته</td>
                            <td>{{ $user->major()->first()->name }}</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">تاریخ تولد</td>
                            <td>{{ jdate($user->birthday)->format('Y-m-d') }}</td>
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
