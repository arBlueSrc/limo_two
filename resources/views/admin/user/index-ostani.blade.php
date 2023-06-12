@extends('admin.layouts.master')
@push('styles')
    <style>
        .filter-result-container span.text-bold {
            font-size: 1rem;
        }
    </style>
@endpush
@push('scripts')

    <script>
        function setDelete(user) {
            document.getElementById("delete_id").value = user['id'];
        }

        let sharestan_holder = 0;
        $('#ostans').on('change', function () {
            // alert( this.value );
            let ostan_id = this.value;
            // alert( ostan_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: 'POST',
                url: '{{ url("/"); }}/get-child-shahrestans',
                data: JSON.stringify({ostan_id: ostan_id}),
                success: function (data) {
                    var len = data.length;

                    $("#child_shahrestans").empty();
                    $("#child_shahrestans").append("<option value=''>همه</option>");
                    for (var i = 0; i < len; i++) {

                        var id = data[i]['id'];
                        if (i == 0) {
                            sharestan_holder = id;
                            // console.log(id);
                        }
                        var name = data[i]['name'];

                        $("#child_shahrestans").append("<option value='" + id + "'>" + name + "</option>");

                    }
                    let shahrestan_id = sharestan_holder;
                    // alert( ostan_id);
                    // console.log(shahrestan_id);

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Content-Type': 'application/json'
                        }
                    })
                    $.ajax({
                        type: 'POST',
                        url: '{{ url("/"); }}/get-related-masjeds',
                        data: JSON.stringify({shahrestan_id: shahrestan_id}),
                        success: function (data) {
                            // console.log(data);
                            var len = data.length;

                            $("#mosque").empty();
                            $("#mosque").append("<option value=''>همه</option>");
                            for (var i = 0; i < len; i++) {
                                var id = data[i]['id'];
                                var shahrestan = data[i]['shahrestan'];
                                var hoze = data[i]['hoze'];
                                var masjed = data[i]['masjed'];
                                // console.log(sharestan_holder);

                                $("#mosque").append("<option value='" + id + "'>" + shahrestan + " - مسجد: " + masjed + "</option>");

                            }
                        }
                        // console.log(data);

                    });
                }
                // console.log(data);

            });


            // alert( this.value );
        });


        $('#child_shahrestans').on('change', function () {
            // alert( this.value );
            let shahrestan_id = $('#child_shahrestans').val();
            // alert( ostan_id);
            // console.log(shahrestan_id);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Content-Type': 'application/json'
                }
            })
            $.ajax({
                type: 'POST',
                url: '{{ url("/"); }}/get-related-masjeds',
                data: JSON.stringify({shahrestan_id: shahrestan_id}),
                success: function (data) {
                    // console.log(data);
                    var len = data.length;

                    $("#mosque").empty();
                    $("#mosque").append("<option value=''>همه</option>");
                    for (var i = 0; i < len; i++) {
                        var id = data[i]['id'];
                        var shahrestan = data[i]['shahrestan'];
                        var hoze = data[i]['hoze'];
                        var masjed = data[i]['masjed'];
                        /* if(i == 0){
                             $("#mosque").append("<option value='"+id+"'>"+shahrestan+" - مسجد: "+ masjed +"</option>");
                         }*/

                        $("#mosque").append("<option value='" + id + "'>" + shahrestan + " - مسجد: " + masjed + "</option>");

                    }
                }
                // console.log(data);

            });
        });


        $('#ostans').change(function () {
            if ($(this).val() == "") {
                $('#child_shahrestans option[value=""]').attr('selected', 'selected');
                $('#mosque option[value=""]').attr('selected', 'selected');
            }
        });
        $('#child_shahrestans').change(function () {
            if ($(this).val() == "") {
                $('#mosque option[value=""]').attr('selected', 'selected');
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
                <!-- /.card-header -->
                <div class="card-body table-bordered table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 5%; alignment: center">ردیف</th>
                            <th>نام و خانوادگی</th>
                            <th>استان</th>
                            <th>شهرستان</th>
                            <th hidden style="width: 20%; alignment: center">عملیات</th>
                        </tr>
                        @foreach ($users as $key => $user)
                            <tr>
                                <td style="width: 5%; alignment: center"
                                    class="text-center">{{ $users->firstItem()+$key }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->ostan()->first()->name }}</td>
                                <td>{{ $user->shahrestan()->first()->name ?? "" }}</td>
                                <td hidden>
                                    <a style="margin: 5px" href="{{ route('user.show', ['user' => $user->id]) }}">
                                        <ion-icon name="eye"></ion-icon>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $users->withQueryString()->render() }}
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
