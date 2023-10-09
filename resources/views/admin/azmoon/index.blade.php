@php use Morilog\Jalali\CalendarUtils; @endphp
@extends('admin.layouts.master')

<!-- Select2 -->
<link rel="stylesheet" href="{{ asset('datepicker/css/persianDatepicker-default.css') }}"/>
<script src="{{ asset('datepicker/js/jquery.min.js') }}"></script>
<script src="{{ asset('datepicker/js/persianDatepicker.min.js') }}"></script>


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
                        <h3 class="card-title">لیست آزمون ها</h3>
                        <div class="row justify-content-end">
                            <a href="#" class="btn btn-outline-info" style="border-radius: 25px"
                               data-target="#myModal" id="open" data-toggle="modal"
                            >اضافه کردن آزمون +</a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-bordered table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 5%; alignment: center">ردیف</th>
                            <th>نام آزمون</th>
                            <th style="width: 20%; alignment: center">عملیات</th>
                        </tr>
                        @foreach ($azmoons as $azmoon)
                            <tr>

                                <td style="width: 5%; alignment: center" class="text-center">{{ $azmoon->id }}</td>
                                <td>{{ $azmoon->name }}</td>
                                <td>

                                    <a style="margin: 5px; color: red" href="#" onclick="setDelete({{$azmoon}})"
                                       data-target="#deleteModal" id="open" data-toggle="modal">
                                        <ion-icon name="trash"></ion-icon>
                                    </a>

                                    <a style="margin: 5px" href="{{ route('azmoon.show', ['azmoon' => $azmoon->id]) }}">
                                        <ion-icon name="book"></ion-icon>
                                    </a>

                                    <a style="margin: 5px" href="" onclick="setDateUpdate({{$azmoon}})"
                                       data-target="#updateModal" id="open" data-toggle="modal">
                                        <ion-icon name="settings"></ion-icon>
                                    </a>

                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $azmoons->appends(['search' => request('search')])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>



    <form method="post" action="{{route('azmoon.store')}}" id="form">
        @csrf
        <!-- Modal -->
        <div class="modal" tabindex="-1" role="dialog" id="myModal" style="margin-top: 100px">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="alert alert-danger" style="display:none"></div>

                    <div class="modal-header justify-content-between">
                        <h5 class="modal-title">اضافه کردن آزمون</h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="name">نام آزمون :</label>
                                <input type="text" class="form-control" name="name" id="name">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="negative_point">نمره منفی دارد ؟ :</label>
                                <select name="negative_point" id="negative_point">
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="randomic">سوالات رندوم نمایش داده شود ؟ :</label>
                                <select name="randomic" id="randomic">
                                    <option value="0">خیر</option>
                                    <option value="1">بله</option>
                                </select>
                            </div>


                            <div class="form-group col-6">
                                <label for="date">تاریخ</label>
                                <input type="text" name="date" class="form-control" id="date" value=""
                                       placeholder="تاریخ را وارد کنید">
                            </div>


                            <div class="form-group col-6">
                                <label for="duration">مدت زمان آزمون</label>
                                <div class="row">
                                    <input type="number" min="0" max="12" name="duration_h" class="form-control col-5" id="duration_h" value="0"
                                           placeholder="ساعت">
                                    <input type="number" min="0" max="60" name="duration_m" class="form-control col-5 mr-2" id="duration_m" value="0"
                                           placeholder="دقیقه">
                                </div>
                            </div>

                            <script>

                                $("#date, .date").persianDatepicker({
                                    onSelect: function () {
                                    }
                                });

                            </script>
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="start">ساعت شروع</label>
                                <input type="time" class="form-control" id="start" name="start">
                            </div>

                            <div class="form-group col-6">
                                <label for="end">ساعت پایان</label>
                                <input type="time" class="form-control" id="end" name="end">
                            </div>
                        </div>


                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 10px">
                            لغو
                        </button>
                        <button type="submit" class="btn btn-success" id="ajaxSubmit">اضافه کردن آزمون</button>
                    </div>


                </div>
            </div>
        </div>
    </form>
    @if(sizeof($azmoons) != 0)
        <form method="POST" action="{{ route('azmoon.destroy', ['azmoon' => $azmoon->id]) }}" id="form">
            @csrf
            @method('DELETE')
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="deleteModal" style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="alert alert-danger" style="display:none"></div>

                        <input hidden name="delete_id" id="delete_id" value="">

                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">اخظار!</h5>
                        </div>

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="name">تمامی اطلاعات این آزمون اعم از نتایج و سوالات حذف خواهند شد. آیا
                                        از حذف این آزمون مطمئن هستید؟</label>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"
                                    style="margin-left: 10px">لغو
                            </button>
                            <button type="submit" class="btn btn-danger" id="ajaxSubmit">حذف</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>
        <form method="post" action="{{route('azmoons.updateTime')}}" id="form">
            @csrf
            @method('POST')
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="updateModal" style="margin-top: 100px">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">به روز رسانی آزمون</h5>
                        </div>

                        <input hidden id="id_update" name="id_update" value="">

                        <div class="modal-body">
                            <div class="row">

                                <div class="form-group col-12">
                                    <label for="name_update">نام آزمون :</label>
                                    <input type="text" class="form-control" name="name_update" id="name_update">
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="negative_point_update">نمره منفی دارد ؟ :</label>
                                    <select name="negative_point_update" id="negative_point_update">
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="randomic_update">سوالات رندوم نمایش داده شود ؟ :</label>
                                    <select name="randomic_update" id="randomic_update">
                                        <option value="0">خیر</option>
                                        <option value="1">بله</option>
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="date_update">تاریخ</label>
                                    <input class="datea" type="text" name="date_update" class="form-control" id="date_update" value=""
                                           placeholder="تاریخ را وارد کنید">
                                </div>

                                <div class="form-group col-6">
                                    <label for="duration">مدت زمان آزمون</label>
                                    <div class="row">
                                        <input type="number" min="0" max="12" name="duration_h_update" class="form-control col-5" id="duration_h_update" value="0"
                                               placeholder="ساعت">
                                        <input type="number" min="0" max="60" name="duration_m_update" class="form-control col-5 mr-2" id="duration_m_update" value="0"
                                               placeholder="دقیقه">
                                    </div>
                                </div>

                                <script>

                                    $("#date, .date").persianDatepicker({
                                        onSelect: function () {

                                        }
                                    });

                                    $("#date_update").persianDatepicker({
                                        onSelect: function () {

                                        }
                                    });

                                </script>

                            </div>

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="start_update">ساعت شروع</label>
                                    <input type="time" class="form-control" id="start_update" name="start_update">
                                </div>

                                <div class="form-group col-6">
                                    <label for="end_update">ساعت پایان</label>
                                    <input type="time" class="form-control" id="end_update" name="end_update">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 10px">
                                لغو
                            </button>
                            <button type="submit" class="btn btn-success" id="ajaxSubmit">به روزرسانی آزمون</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>
    @endif

@endsection


<script>

    function setDateUpdate(azmoon) {
        document.getElementById("name_update").value = azmoon['name'];
        document.getElementById("negative_point_update").value = azmoon['negative_point'];
        document.getElementById("randomic_update").value = azmoon['randomic'];
        document.getElementById("date_update").value = azmoon['shamsi'];
        document.getElementById("start_update").value = azmoon['start_hour'];
        document.getElementById("end_update").value = azmoon['end_hour'];
        document.getElementById("id_update").value = azmoon['id'];
        document.getElementById("duration_h_update").value = azmoon['duration'].split(":")[0];
        document.getElementById("duration_m_update").value = azmoon['duration'].split(":")[1];
    }

    function setDelete(azmoon) {
        document.getElementById("delete_id").value = azmoon['id'];
    }

</script>
