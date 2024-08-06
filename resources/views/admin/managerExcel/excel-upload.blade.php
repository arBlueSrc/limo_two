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



        /* spinner codes */

        /* HTML: <div class="loader"></div> */
        .loader {
            width: 50px;
            padding: 8px;
            aspect-ratio: 1;
            border-radius: 50%;
            background: #25b09b;
            --_m:
                conic-gradient(#0000 10%,#000),
                linear-gradient(#000 0 0) content-box;
            -webkit-mask: var(--_m);
            mask: var(--_m);
            -webkit-mask-composite: source-out;
            mask-composite: subtract;
            animation: l3 1s infinite linear;
        }
        @keyframes l3 {to{transform: rotate(1turn)}}


        @media screen and (max-width: 350px)  {
        .cancel-btn{
            margin-top: 1rem;
        }
        .btns-wrapper{
            justify-content: center!important;
            /*flex-flow:column ;*/
        }
        }

    </style>
@endpush
@section('content')


    <div class="row">
        <div class="col-6">
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title">افزودن مدیر استانی از طریق اکسل</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form role="form" method="post" action="{{ route('upload-excel-manager-ostan.save') }}" id="excel-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="username">فایل اکسل را وارد کنید</label>

                                <div class="row flex-nowrap">
                                    <input type="file" name="file" class="form-control" id="username" placeholder="آیین نامه دوره را وارد کنید" value="{{ old('sample_certificate') }}">
                                    <div>
                                        <img id="loading-gif" style="display: none;" src="{{ asset('images/spinner@1x-1.0s-200px-200px.gif') }}" width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ asset('files/ghaleb.xlsx') }}" type="button" class="btn btn-success">دانلود قالب اکسل</a>
                        </div>
                        <div class="alert alert-primary col-md-6 mt-2">
                            <h5 class="" style="margin-right: -1rem;"><i class="icon fa fa-check"></i> راهنما</h5>
                            <ul class="mr-4">
                                <li>قالب اکسل نمونه را دانلود کنید</li>
                                <li>اطلاعات مربوطه را وارد فایل اکسل کنید</li>
                                <li>فایل اکسل را بارگزاری کنید و دکمه ثبت را بزنید</li>
                            </ul>
                        </div>

                        <!-- Rounded switch -->
                        <div class="row justify-content-end btns-wrapper">
                            <div>
                                <button id="submit-btn" type="submit" class="btn btn-secondary btn-lg mr-3 px-5 rounded">ثبت</button>
                            </div>
                            <a href="{{ url('/admin/mosque-users/ostanUsers') }}"><button type="button" class="btn btn-outline-secondary btn-lg mr-3 px-5 rounded cancel-btn" style="">لغو</button></a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
        <div class="col-6">
            <div class="card card-success">

                <div class="card-header">
                    <h3 class="card-title">افزودن مدیر شهرستانی از طریق اکسل</h3>
                </div>
                <!-- /.card-header -->

                <!-- form start -->
                <form role="form" method="post" action="{{ route('upload-excel-manager-shahrestan.save') }}" id="excel-form" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="username">فایل اکسل را وارد کنید</label>

                                <div class="row flex-nowrap">
                                    <input type="file" name="file2" class="form-control" id="file2">
                                    <div>
                                        <img id="loading-gif" style="display: none;" src="{{ asset('images/spinner@1x-1.0s-200px-200px.gif') }}" width="40px">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="{{ asset('files/ghaleb3.xlsx') }}" type="button" class="btn btn-success">دانلود قالب اکسل</a>
                        </div>
                        <div class="alert alert-primary col-md-6 mt-2">
                            <h5 class="" style="margin-right: -1rem;"><i class="icon fa fa-check"></i> راهنما</h5>
                            <ul class="mr-4">
                                <li>قالب اکسل نمونه را دانلود کنید</li>
                                <li>اطلاعات مربوطه را وارد فایل اکسل کنید</li>
                                <li>فایل اکسل را بارگزاری کنید و دکمه ثبت را بزنید</li>
                            </ul>
                        </div>

                        <!-- Rounded switch -->
                        <div class="row justify-content-end btns-wrapper">
                            <div>
                                <button id="submit-btn" type="submit" class="btn btn-secondary btn-lg mr-3 px-5 rounded">ثبت</button>
                            </div>
                            <a href="{{ url('/admin/mosque-users/ostanUsers') }}"><button type="button" class="btn btn-outline-secondary btn-lg mr-3 px-5 rounded cancel-btn" style="">لغو</button></a>
                        </div>

                    </div>

                </form>
            </div>
        </div>
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
        });
    </script>
    <script>
        $('#submit-btn').click(function (){
            // alert('sssss')
            $('#loading-gif').show();
        })
    </script>
@endpush
