@extends('admin.layouts.master')
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

    <div class="card card-primary">

        <!-- card-header -->
        <div class="card-header">
            <h3 class="card-title">تنظیمات آزمون</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="{{ route('azmoon.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body" id="card">

                <div class="row">

                    <div class=" col-6">

                        <div class="form-group col-12">

                        <label for="name">نام آزمون</label>
                        <div class="row">
                            <div class="col-10">
                                <input type="text" name="name" class="form-control" id="name" placeholder="نام آزمون"
                                       value="{{ $azmoon->name }}">
                            </div>
                            <div class="col-2">
                                <a onclick="updateTitle()" href="" style="color: black">
                                    <ion-icon name="checkmark-done-circle"
                                              style="margin-top: 5px; margin-left: 20px; width: 30px; height: 30px; color: dodgerblue"></ion-icon>
                                </a>
                            </div>
                        </div>
                        </div>


                        <div class="form-group col-12">
                            <label for="question_number">چه تعدادی از سوالات برای کاربر نمایش داده شود؟</label>
                            <div class="row">
                                <div class="col-10">
                                    <input type="number" min="1" max="{{ sizeof($questions) }}" class="form-control" name="question_number" id="question_number" value="{{ $azmoon->randomic_number }}">
                                </div>
                                <div class="col-2">
                                    <a onclick="updateRandomicNumber()" href="" style="color: black">
                                        <ion-icon name="checkmark-done-circle"
                                                  style="margin-top: 5px; margin-left: 20px; width: 30px; height: 30px; color: dodgerblue"></ion-icon>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-6" style="text-align: left">
                        <div class="row justify-content-end">
                            <a href="#" class="btn btn-outline-info" style="border-radius: 25px"
                               data-target="#myModal" id="open" data-toggle="modal"
                            >اضافه کردن سوال تستی +</a>
                        </div>

                        <div class="row justify-content-end mt-2">
                            <a href="#" class="btn btn-outline-info" style="border-radius: 25px"
                               data-target="#explanatory_modal" id="open" data-toggle="modal"
                            >اضافه کردن سوال تشریحی +</a>
                        </div>

                        <div class="row justify-content-end mt-2">
                            <a href="#" class="btn btn-outline-success" style="border-radius: 25px"
                               data-target="#excelModal" id="openExcel" data-toggle="modal"
                            > <i class="fa fa-file-excel-o"></i> وارد کردن سوال با اکسل +</a>
                        </div>
                    </div>


                </div>

                <hr class="solid">

                <div class="form-group col-12">

                    <div class="row justify-content-end">
                        <label class="col-10 justify-content-end" for="name" style="padding-bottom: 10px">سوالات
                            آزمون</label>
                        <label class="col-2" for="name" style="padding-bottom: 10px">مجموعا : {{ sizeof($questions) }}
                            سوال</label>
                    </div>

                    @php($question_number = 0)
                    @foreach($questions as $question)
                        @php($question_number += 1)
                        <div class="card" style="border-radius: 10px">
                            <div class="row">
                                <div class="col-6">
                                    <h6 style="margin: 15px; color: black">سوال شماره {{ $question_number }} )</h6>
                                </div>
                                <div class="col-6" style="text-align: left">
                                    <div class="row justify-content-end">
                                        <h6 class="text-info" style="margin: 15px;">
                                            @if($question->type == 0)
                                                سوال تستی
                                            @else
                                                سوال تشریحی
                                            @endif
                                        </h6>
                                        <a onclick="myFunction({{$question->id}})" href=""
                                           style="margin-top: 15px; margin-left: 20px; color: red"
                                           data-target="#deleteModal" class="delete" data-toggle="modal">
                                            <ion-icon name="trash"></ion-icon>
                                        </a>
                                        <a onclick="updateQuestion({{$question}})" href=""
                                           style="margin-top: 15px; margin-left: 20px; color: black"
                                           data-target="#updateModal" class="update" data-toggle="modal">
                                            <ion-icon name="create"></ion-icon>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <p style="margin-right: 25px; margin-left: 25px">{{ $question->question }}</p>
                                </div>

                                @if($question->type == 0)
                                <div class="row col-11" style="margin-right: 10px; margin-left: 50px;">

                                    <div class="col-3">
                                        <div class="callout {{isCorrect($question->answer == 1)}}">
                                            <p>{{ $question->option_1 }}</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="callout {{isCorrect($question->answer == 2)}}">
                                            <p>{{ $question->option_2 }}</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="callout {{isCorrect($question->answer == 3)}}">
                                            <p>{{ $question->option_3 }}</p>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="callout {{isCorrect($question->answer == 4)}}">
                                            <p>{{ $question->option_4 }}</p>
                                        </div>
                                    </div>
                                </div>
                                @else
                                    <div class="col-12 px-3" {{--style="margin-right: 25px"--}}>
                                    <div class="form-group px-4">
                                        <label>پاسخ نمونه :</label>
                                        <textarea class="form-control" rows="3" cols="90" placeholder="" disabled="">{{ $question->tashrihi_answer }}</textarea>
                                    </div>
                                    </div>
                                @endif

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </form>

        {{--modal--}}
        <form method="post" action="{{route('question.store')}}" id="form">
            @csrf
            <!-- Modal -->
            <div class="modal" tabindex="-1" role="dialog" id="myModal" style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">اضافه کردن سوال</h5>
                        </div>

                        <input hidden id="azmoon_id" name="azmoon_id" value="{{ $azmoon->id }}">

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="question">صورت سوال :</label>
                                    <input type="text" class="form-control" name="question" id="question">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="option_1">گزینه 1 :</label>
                                    <input type="text" class="form-control" name="option_1" id="option_1">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="option_2">گزینه 2 :</label>
                                    <input type="text" class="form-control" name="option_2" id="option_2">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="option_3">گزینه 3 :</label>
                                    <input type="text" class="form-control" name="option_3" id="option_3">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="option_4">گزینه 4 :</label>
                                    <input type="text" class="form-control" name="option_4" id="option_4">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="end">گزینه صحیح :</label>
                                    <select name="answer" id="asnwer">
                                        @for($i=1; $i<5; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 10px">
                                لغو
                            </button>
                            <button type="submit" class="btn btn-success" id="ajaxSubmit">اضافه کردن سوال</button>
                        </div>

                    </div>
                </div>
            </div>
        </form>

        <form method="post" action="{{route('tashrihi.question.store')}}" id="form">
            @csrf
            <!-- Modal -->

            {{-- add           explantory questions--}}
            <div class="modal" tabindex="-1" role="dialog" id="explanatory_modal"  style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">اضافه کردن سوال تشریحی</h5>
                        </div>

                        <input hidden id="azmoon_id" name="azmoon_id" value="{{ $azmoon->id }}">

                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-12">
                                    <label for="question">صورت سوال :</label>
                                    <input type="text" class="form-control" name="question" id="question">
                                </div>

                                <div class="form-group col-12">
                                    <label for="question">پاسخ صحیح را وارد کنید :</label>
                                    <textarea name="true_answer" rows="3" cols="50"></textarea>
                                </div>

                                {{--<div class="form-group col-md-6">
                                    <label for="end">گزینه صحیح :</label>
                                    <select name="answer" id="asnwer">
                                        @for($i=1; $i<5; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>--}}

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal" style="margin-left: 10px">
                                لغو
                            </button>
                            <button type="submit" class="btn btn-success" id="ajaxSubmit">اضافه کردن سوال</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>

        @if(sizeof($questions) != 0)
            <form method="POST" action="{{ route('question.destroy', ['question' => $question->id]) }}" id="form">
                @csrf
                @method('DELETE')
                <!-- Modal -->
                <div class="modal" tabindex="-1" role="dialog" id="deleteModal" style="margin-top: 100px">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="alert alert-danger" style="display:none"></div>

                            <input id="question_id" name="question_id" type="hidden" value=""/>

                            <div class="modal-header justify-content-between">
                                <h5 class="modal-title">اخظار!</h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="name">تمامی اطلاعات این سوال اعم از سوال و گزینه ها حذف خواهند شد.
                                            آیا از حذف این آزمون مطمئن هستید؟</label>
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

            <form method="POST" action="{{ route('question.update', ['question' => $question->id]) }}" id="form">
                @csrf
                @method('PATCH')
                <!-- Modal -->
                <div class="modal" tabindex="-1" role="dialog" id="updateModal" style="margin-top: 100px">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="alert alert-danger" style="display:none"></div>

                            <div class="modal-header justify-content-between">
                                <h5 class="modal-title">اضافه کردن سوال</h5>
                            </div>

                            <div class="modal-body">
                                <div class="row">
                                    <div class="form-group col-12">
                                        <label for="question_update">صورت سوال :</label>
                                        <input type="text" class="form-control" name="question_update"
                                               id="question_update">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="option_1_update">گزینه 1 :</label>
                                        <input type="text" class="form-control" name="option_1_update"
                                               id="option_1_update">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="option_2_update">گزینه 2 :</label>
                                        <input type="text" class="form-control" name="option_2_update"
                                               id="option_2_update">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="option_3_update">گزینه 3 :</label>
                                        <input type="text" class="form-control" name="option_3_update"
                                               id="option_3_update">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="option_4_update">گزینه 4 :</label>
                                        <input type="text" class="form-control" name="option_4_update"
                                               id="option_4_update">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="end">گزینه صحیح :</label>
                                        <select name="answer_update" id="answer_update">
                                            @for($i=1; $i<5; $i++)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                        style="margin-left: 10px">لغو
                                </button>
                                <button type="submit" class="btn btn-success" id="ajaxSubmit">اضافه کردن سوال</button>
                            </div>


                        </div>
                    </div>
                </div>
            </form>
        @endif
        <form method="POST" action="{{ route('questions.uploadExcel') }}" id="form"  enctype="multipart/form-data">
            @csrf
            <!-- Modal -->
            <div class="modal" tabindex="+1" role="dialog" id="excelModal" style="margin-top: 100px">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">

                        <div class="alert alert-danger" style="display:none"></div>

                        <div class="modal-header justify-content-between">
                            <h5 class="modal-title">اضافه کردن سوال</h5>
                        </div>

                        <input hidden id="azmoon_id" name="azmoon_id" value="{{ $azmoon->id }}">

                        <div class="row m-3">
                            <a href="{{ url('temp/sample.xlsx') }}" class="btn btn-outline-success" style="border-radius: 25px"
                            > <i class="fa fa-file-excel-o"></i> دانلود فایل نمونه +</a>
                            <p class="mt-2">ابتدا فایل اکسل بالا را دانلود کنید، سپس سوالات خود را در آن وارد کرده و در نهایت فایل نهایی را از قسمت پایین انتخاب و اپلود نمایید.</p>
                        </div>

                        <div class="form-group m-3">
                            <label for="exampleInputFile">ارسال فایل</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" id="file" class="form-control" accept=".xlsx,.xls">
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    style="margin-left: 10px">لغو
                            </button>
                            <button type="submit" class="btn btn-success" id="ajaxSubmit">اپلود فایل اکسل</button>
                        </div>


                    </div>
                </div>
            </div>
        </form>

    </div>

@endsection
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

    function myFunction(number) {
        document.getElementById("question_id").value = number;
        console.log(number);
    }

    function updateQuestion(question) {
        document.getElementById("question_update").value = question['question'];
        document.getElementById("option_1_update").value = question['option_1'];
        document.getElementById("option_2_update").value = question['option_2'];
        document.getElementById("option_3_update").value = question['option_3'];
        document.getElementById("option_4_update").value = question['option_4'];
        document.getElementById("answer_update").value = question['answer'];
        console.log(number);
    }

    function updateTitle() {
        var newName = document.getElementById("name").value;
        var azmoonId = document.getElementById("azmoon_id").value;
        var href = "{{ route('azmoons.updateTitle') }}" + "?";
        href = href + 'name=' + newName + "&";
        href = href + 'id=' + azmoonId;
        window.location = href;
    }


    function updateRandomicNumber() {
        var questionNumber = document.getElementById("question_number").value;
        var azmoonId = document.getElementById("azmoon_id").value;
        var href = "{{ route('azmoons.updateRandomicNumber') }}" + "?";
        href = href + 'questionNumber=' + questionNumber + "&";
        href = href + 'id=' + azmoonId;
        window.location = href;
    }

</script>




