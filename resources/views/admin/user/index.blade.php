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
                        <h3 class="card-title">لیست کاربران</h3>
                        <form action="{{ route('users.exportExcel') }}" method="get" id="excel_form">
                            <div class="row">
                                <a  href="#" onclick="document.getElementById('excel_form').submit()"  class="btn btn-outline-success" style="border-radius: 25px"
                                > خروجی اکسل <i class="fa fa-file-excel-o" ></i></a>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-bordered table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 5%; alignment: center">ردیف</th>
                            <th>نام و خانوادگی</th>
                            <th>شماره تماس</th>
                            <th style="width: 20%; alignment: center">عملیات</th>
                        </tr>
                        @foreach ($users as $user)
                            <tr>

                                <td style="width: 5%; alignment: center" class="text-center">{{ $user->id }}</td>
                                <td>{{ $user->name . " " . $user->lname }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    <a style="margin: 5px" href="{{ route('user.show', ['user' => $user->id]) }}">
                                        <ion-icon name="eye"></ion-icon>
                                    </a>
                                    <a style="margin: 5px" href="{{ route('form.edit', ['user' => $user->id]) }}">
                                        <ion-icon name="create"></ion-icon>
                                    </a>
                                    <a style="margin: 5px; color: red" href="#" onclick="setDelete({{$user}})"
                                       data-target="#deleteModal" id="open" data-toggle="modal">
                                        <ion-icon name="trash"></ion-icon>
                                    </a>
                                </td>

                            </tr>
                        @endforeach

                        </tbody>

                    </table>

                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $users->appends(['search' => request('search')])->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>








    @if(sizeof($users) != 0)
        <form method="POST" action="{{ route('user.destroy', ['user' => $user->id]) }}" id="form">
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
                                    <label for="name">آیا از حذف این شخص مطمئن هستید ؟</label>
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

    @endif
@endsection

<script>

    function setDelete(user) {
        document.getElementById("delete_id").value = user['id'];
    }

</script>
