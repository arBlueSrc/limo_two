@extends('admin.layouts.master')
@section('content')
    @if (session()->has('message'))
        <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">

                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">لیست نتایج</h3>
                        <div class="row justify-content-end">

                            <form action="{{ route('azmoons.exportExcel') }}" method="get" id="excel_form">
                                <div class="row">

                                    <input hidden type="text" name="filter_para" id="filter_para" value="{{ $filter }}">
                                    <input hidden type="text" name="filter_type_para" id="filter_type_para" value="{{ $filter_type }}">

                                    <a  href="#" onclick="document.getElementById('excel_form').submit()"  class="btn btn-outline-success" style="border-radius: 25px"
                                    > خروجی اکسل <i class="fa fa-file-excel-o" ></i></a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form action="{{ route('result.index') }}" method="get" id="filter_form">
                        <div class="row">
                            <input type="text" name="filter" id="filter" class="mr-2 form-control w-25" placeholder="متن فیلتر ..">
                            <select name="filter_type" id="filter_type" class="form-control mr-2 col-2">
                                <option value="azmoon">بر اساس آزمون</option>
                                <option value="name">بر اساس نام کاربر</option>
                            </select>
                            <a href="#" onclick="document.getElementById('filter_form').submit()" class="btn btn-outline-info mr-2" style="border-radius: 25px"
                            >فیلتر</a>
                        </div>
                    </form>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-bordered table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                            <tr>
                                <th style="width: 5%; alignment: center">ردیف</th>
                                <th>نام و نام خانوادگی</th>
                                <th>شماره تماس</th>
                                <th>آزمون</th>
                                <th>تعداد درست</th>
                                <th>تعداد غلط</th>
                                <th>تعداد بی پاسخ</th>
                                <th>امتیاز کل از 100</th>
                                <th style="width: 20%; alignment: center">عملیات</th>
                            </tr>
                            @foreach ($results as $result)
                                <tr>
                                    <td style="width: 5%; alignment: center" class="text-center">{{ $result->id }}</td>
                                    <td>{{ $result->single_result->name ?? "" }}</td>
                                    <td>{{ $result->single_result->phone ?? "" }}</td>
                                    <td>{{ $result->azmoon_id }} - {{ $result->azmoon->name }}</td>
                                    <td>{{ $result->true_answer }}</td>
                                    <td>{{ $result->wrong_answer }}</td>
                                    <td>{{ $result->empty_answer }}</td>
                                    <td>{{ $result->percent }}</td>
                                    <td>

{{--                                        <a style="margin: 5px; color: red" href="#"--}}
{{--                                           data-target="#deleteModal" id="open" data-toggle="modal">--}}
{{--                                            <ion-icon name="trash"></ion-icon>--}}
{{--                                        </a>--}}

{{--                                        <a style="margin: 5px" href="{{ route('result.show', ['result' => $result->id]) }}">--}}
{{--                                            <ion-icon name="eye"></ion-icon>--}}
{{--                                        </a>--}}

                                    </td>


                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $results->appends(['search' => request('search')])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
