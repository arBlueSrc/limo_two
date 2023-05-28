@extends('admin.layouts.master')
@push('styles')
    <style>
        .my-btn-color{
            background-color: #006780;
        }

        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
@endpush
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">ایجاد کاربر جدید</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="{{ route('user.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">

                <div class="row">
                    <div class="form-group col-6">
                        <label for="name">نام و نام خانوادگی</label>
                        <input type="text" name="name" class="form-control" id="username" placeholder="نام و نام خانوادگی کاربر را وارد کنید" value="{{ old('name') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="code_meli">کدملی</label>
                        <input type="text" name="national_code" class="form-control" id="username" placeholder="کدملی کاربر را وارد کنید" value="{{ old('ostan') }}">
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-6">
                        <label for="mobile">شماره همراه</label>
                        <input type="text" name="mobile" class="form-control" id="username" placeholder="شماره همراه کاربر را وارد کنید" value="{{ old('ostan') }}">
                    </div>
                    <div class="form-group col-6">
                        <label for="role">نقش</label>
                        <select  name="role" id="user_role" class="form-control">
                            <option value="2">مدیر استانی</option>

                        </select>
                    </div>
                </div>



                <div class="row">
                    <div class="form-group col-6">
                        <label for="username">استان</label>
                        <select  name="ostan_id" id="ostans" class="form-control" >
                            @foreach($ostans as $ostan)
                                <option value="{{ $ostan->id }}" {{ $loop->first ? 'selected=selected' : '' }}>{{ $ostan->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-6">
                        <label for="username">شهرستان</label>
                        <select  name="shahrestan_id" id="child_shahrestans" class="form-control">
                            @foreach($shahrestans as $shahrestan)
                                <option value="{{ $shahrestan->id }}" {{ $loop->first ? "selected=selected" : '' }}>{{ $shahrestan->name }}</option>
                            @endforeach>
                        </select>
                    </div>
                </div>

                {{--<div class="row">
                    <div class="form-group col-6">
                        <label for="code_meli">کلمه عبور</label>
                        <input type="password" name="password" class="form-control" id="username" placeholder="کلمه عبور را وارد کنید" value="">
                    </div>
                    <div class="form-group col-6">
                        <label for="mobile">تکرار کلمه عبور</label>
                        <input type="password" name="password_confirmation" class="form-control" id="username" placeholder="تکرار کلمه عبور را وارد کنید" value="">
                    </div>
                </div>--}}
             <label class="py-3" for="mobile">تاریخ تولد</label>
             <div class="row">
                 <div class="form-group col-4">
                     <label for="mobile">سال</label>
                     <select name="year" class="form-control" id="">
                         @for($i=1401 ; $i > 1300;$i-- )
                             <option value="{{ $i }}">{{ $i }}</option>
                         @endfor
                     </select>
                 </div>
                 <div class="form-group col-4">

                     <label for="mobile">ماه</label>

                     <select name="month" class="form-control" id="">
                         @for($i=1 ; $i <= 12;$i++ )
                             <option value="{{ $i }}">{{ $i }}</option>
                         @endfor
                     </select>

                 </div>
                 <div class="form-group col-4">

                     <label for="mobile">روز</label>

                     <select name="day" class="form-control" id="">
                         @for($i=1 ; $i <= 31;$i++ )
                             <option value="{{ $i }}">{{ $i }}</option>
                         @endfor
                     </select>

                 </div>
             </div>
                <!-- Rounded switch -->
                <div class="row align-items-center">

                    <label for="">فعال</label>

                    <label class="switch mx-3">
                        <label for=""></label>
                        <input name="status" type="checkbox" checked>
                        <span class="slider round"></span>
                    </label>

                    <label for="">غیر فعال</label>

                </div>

                <div class="row justify-content-end">
                    <button type="submit" class="btn btn-secondary btn-lg mr-3 px-5 rounded">ثبت</button>
                    <a href="{{ route('user.index') }}"><button type="button" class="btn btn-outline-secondary btn-lg mr-3 px-5 rounded">لغو</button></a>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('scripts')
    <script>

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
                    for( var i = 0; i<len; i++){
                        var id = data[i]['id'];
                        var name = data[i]['name'];

                        $("#child_shahrestans").append("<option value='"+id+"'>"+name+"</option>");

                    }
                }
                // console.log(data);

            });
        });
        // console.log($('#user_role').val());

/*if($('#user_role').val()==7){
    $('#darolghoran').fadeIn();
    $('#need-money').addClass('d-flex');
}
        //show it when the checkbox is clicked
        $('#user_role').on('change', function () {
            // alert(this.value )
            if (this.value == 7) {
                // console.log('aaa');
                $('#darolghoran').fadeIn();
                $('#need-money').addClass('d-flex');
            } else {
                // console.log('bbb');
                $('#darolghoran').hide();
                $('#need-money').removeClass('d-flex');
            }
        });*/
    </script>
@endpush
