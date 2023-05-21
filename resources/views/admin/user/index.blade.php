@extends('admin.layouts.master')
@push('styles')
    <style>
        .filter-result-container span.text-bold{
            font-size: 1rem;
        }
    </style>
@endpush
@push('scripts')

    <script>
        function setDelete(user) {
            document.getElementById("delete_id").value = user['id'];
        }
        let sharestan_holder=0;
        $('#ostans').on('change', function() {
            // alert( this.value );
            let ostan_id= this.value;
            // alert( ostan_id);

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                    'Content-Type' : 'application/json'
                }
            })
            $.ajax({
                type : 'POST',
                url : '{{ url("/"); }}/get-child-shahrestans',
                data : JSON.stringify( {ostan_id: ostan_id}),
                success : function(data) {
                    var len = data.length;

                    $("#child_shahrestans").empty();
                    $("#child_shahrestans").append("<option value=''>همه</option>");
                    for( var i = 0; i<len; i++){

                        var id = data[i]['id'];
                        if(i==0){
                            sharestan_holder=id;
                            // console.log(id);
                        }
                        var name = data[i]['name'];

                        $("#child_shahrestans").append("<option value='"+id+"'>"+name+"</option>");

                    }
                    let shahrestan_id= sharestan_holder;
                    // alert( ostan_id);
                    // console.log(shahrestan_id);

                    $.ajaxSetup({
                        headers : {
                            'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                            'Content-Type' : 'application/json'
                        }
                    })
                    $.ajax({
                        type : 'POST',
                        url : '{{ url("/"); }}/get-related-masjeds',
                        data : JSON.stringify( {shahrestan_id: shahrestan_id}),
                        success : function(data) {
                            // console.log(data);
                            var len = data.length;

                            $("#mosque").empty();
                            $("#mosque").append("<option value=''>همه</option>");
                            for( var i = 0; i<len; i++){
                                var id = data[i]['id'];
                                var shahrestan = data[i]['shahrestan'];
                                var hoze = data[i]['hoze'];
                                var masjed = data[i]['masjed'];
                                // console.log(sharestan_holder);

                                $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - حوزه: "+hoze+" - مسجد: "+ masjed +"</option>");

                            }
                        }
                        // console.log(data);

                    });
                }
                // console.log(data);

            });


            // alert( this.value );
        });


        $('#child_shahrestans').on('change', function() {
            // alert( this.value );
            let shahrestan_id= $('#child_shahrestans').val();
            // alert( ostan_id);
            // console.log(shahrestan_id);

            $.ajaxSetup({
                headers : {
                    'X-CSRF-TOKEN' : "{{ csrf_token() }}",
                    'Content-Type' : 'application/json'
                }
            })
            $.ajax({
                type : 'POST',
                url : '{{ url("/"); }}/get-related-masjeds',
                data : JSON.stringify( {shahrestan_id: shahrestan_id}),
                success : function(data) {
                    // console.log(data);
                    var len = data.length;

                    $("#mosque").empty();
                    $("#mosque").append("<option value=''>همه</option>");
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var shahrestan = data[i]['shahrestan'];
                        var hoze = data[i]['hoze'];
                        var masjed = data[i]['masjed'];
                       /* if(i == 0){
                            $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - حوزه: "+hoze+" - مسجد: "+ masjed +"</option>");
                        }*/

                        $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - حوزه: "+hoze+" - مسجد: "+ masjed +"</option>");

                    }
                }
                // console.log(data);

            });
        });


        $('#ostans').change(function() {
            if ($(this).val() == "") {
                $('#child_shahrestans option[value=""]').attr('selected','selected');
                $('#mosque option[value=""]').attr('selected','selected');
            }
        });
        $('#child_shahrestans').change(function() {
            if ($(this).val() == "") {
                $('#mosque option[value=""]').attr('selected','selected');
            }
        });

    </script>
@endpush
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
                    <form action="{{ route('users.search') }}" method="post">
                        @csrf
                        @method('POST')
                    <div class="my-form-container row">
                        <div class="form-group col-md-3">
                            <label>استان</label>
                            <select name="ostan" id="ostans" class="form-control">
                                <option value="">همه</option>
                                @foreach($ostans as $ostan)
                                    <option value="{{ $ostan->id }}" @if( isset($selected['ostan']) && $selected['ostan'] == $ostan->id ) selected @endif >{{ $ostan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>شهرستان</label>
                            <select name="shahrestan" id="child_shahrestans" class="form-control">
                                <option value="">همه</option>
                                @foreach($shahrestans as $shahrestan)
                                    <option value="{{ $shahrestan->id }}" @if( isset($selected['shahrestan']) && ($selected['shahrestan']== $shahrestan->id) ) selected @endif >{{ $shahrestan->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>مسجد</label>
                            <select name="mosque" id="mosque" class="form-control">
                                <option value="">همه</option>
                                @isset($masjeds)
                                @foreach($masjeds as $masjed)
                                    <option value="{{ $masjed->id }}" @if( isset($selected['mosque']) && ($selected['mosque']== $masjed->id) ) selected @endif >{{ 'حوزه :'. $masjed->hoze .' - مسجد : '. $masjed->masjed }}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="form-group d-flex align-items-end mr-2">
                            <button class="btn btn-secondary" style="max-height:content-box" type="submit">جستجو</button>
                        </div>

                    </div>

                    </form>
                    <div class="filter-result-container py-3">
                    @isset($selected['ostan'])
                    <span>کلید جستجو : </span>
                        استان :
                    <span class="text-bold badge badge-primary font-"> {{ \App\Models\Ostan::find($selected['ostan'])->name }}</span>
                    @endisset
                    @isset($selected['shahrestan'])
                        - شهرستان :
                        <span class="text-bold badge badge-warning"> {{ \App\Models\Shahrestan::find($selected['shahrestan'])->name  }}</span>
                    @endisset
                    @isset($selected['mosque'])
                        - حوزه :
                        <span class="text-bold badge badge-danger"> {{ \App\Models\masjed::find($selected['mosque'])->hoze  }}</span>
                        - مسجد :
                        <span class="text-bold badge badge-success"> {{ \App\Models\masjed::find($selected['mosque'])->masjed  }}</span>
                    @endisset
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
                            <th>استان</th>
                            <th>شهرستان</th>
                            <th style="width: 20%; alignment: center">عملیات</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td style="width: 5%; alignment: center" class="text-center">{{ $users->firstItem()+$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->ostan()->first()->name }}</td>
                                <td>{{ $user->shahrestan()->first()->name }}</td>
                                <td>
                                    <a style="margin: 5px" href="{{ route('user.show', ['user' => $user->id]) }}">
                                        <ion-icon name="eye"></ion-icon>
                                    </a>
                                    {{--<a style="margin: 5px" href="{{ route('form.edit', ['user' => $user->id]) }}">
                                        <ion-icon name="create"></ion-icon>
                                    </a>--}}
                                    {{--<a style="margin: 5px; color: red" href="#" onclick="setDelete({{$user}})"
                                       data-target="#deleteModal" id="open" data-toggle="modal">
                                        <ion-icon name="trash"></ion-icon>
                                    </a>--}}
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
