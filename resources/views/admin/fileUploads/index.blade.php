@extends('admin.layouts.master')
@push('styles')
    <style>
        .filter-result-container span.text-bold {
            font-size: 1rem;
        }
    </style>
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
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="card-title">لیست فایل های اپلود شده</h3>
                        {{--                        <form action="{{ route('excel.download') }}" method="get" id="excel_form" enctype="multipart/form-data">--}}
                        {{--                            @isset($selected)--}}
                        {{--                                <input type="hidden" name="ostan" value="{{ $selected['ostan'] ?? ""  }}">--}}
                        {{--                                <input type="hidden" name="shahrestan" value="{{ $selected['shahrestan'] ?? ""  }}">--}}
                        {{--                                <input type="hidden" name="mosque" value="{{ $selected['mosque']  ?? "" }}" >--}}
                        {{--                            @endisset--}}
                        {{--                            <div class="row">--}}
                        {{--                                <a  href="#" onclick="document.getElementById('excel_form').submit()"  class="btn btn-outline-success" style="border-radius: 25px"--}}
                        {{--                                > خروجی اکسل <i class="fa fa-file-excel-o" ></i></a>--}}
                        {{--                            </div>--}}
                        {{--                        </form>--}}
                    </div>

                    @can('is_superadmin')
                        <form action="{{ route('uploadedFiles') }}" method="get" class="mt-3">
                            @csrf
                            @method('POST')
                            <div class="my-form-container row">

                                <div class="form-group col-md-3">
                                    <label>نوع فایل</label>
                                    <select name="type" id="type" class="form-control">
                                        <option value="0" @if( isset($selected['type']) && ($selected['type']== 0) ) selected @endif>همه</option>
                                        <option value="1" @if( isset($selected['type']) && ($selected['type']== 1) ) selected @endif>کارت ملی</option>
                                        <option value="2" @if( isset($selected['type']) && ($selected['type']== 2) ) selected @endif>مدرک تخصصی</option>
                                        <option value="3" @if( isset($selected['type']) && ($selected['type']== 3) ) selected @endif>طرح درس</option>
                                        <option value="4" @if( isset($selected['type']) && ($selected['type']== 4) ) selected @endif>ویدئوی تدریس</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label>رشته</label>
                                    <select name="major" id="major" class="form-control">
                                        <option value="0">همه</option>
                                        @foreach($majors as $major)
                                            <option value="{{ $major->id }}"
                                                    @if( isset($selected['major']) && ($selected['major']== $major->id) ) selected @endif >{{ $major->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="code_meli">کدملی</label>
                                    <input type="text" name="code_meli" class="form-control" id="code_meli"
                                           @if( isset($selected['code_meli'])) ) value="{{ $selected['code_meli'] }}" @endif
                                           placeholder="کدملی کاربر را وارد کنید">
                                </div>

                                <div class="form-group d-flex align-items-end mr-2">
                                    <button class="btn btn-secondary" style="max-height:content-box" type="submit">
                                        جستجو
                                    </button>
                                </div>

                            </div>

                        </form>
                    @endcan

                    <div class="filter-result-container py-3">
                        @isset($selected['ostan'])
                            <span>کلید جستجو : </span>
                            استان :
                            <span
                                class="text-bold badge badge-primary font-"> {{ \App\Models\Ostan::find($selected['ostan'])->name }}</span>
                        @endisset
                        @isset($selected['shahrestan'])
                            - شهرستان :
                            <span
                                class="text-bold badge badge-warning"> {{ \App\Models\Shahrestan::find($selected['shahrestan'])->name  }}</span>
                        @endisset
                        @isset($selected['mosque'])
                            - حوزه :
                            <span
                                class="text-bold badge badge-danger"> {{ \App\Models\masjed::find($selected['mosque'])->hoze  }}</span>
                            - مسجد :
                            <span
                                class="text-bold badge badge-success"> {{ \App\Models\masjed::find($selected['mosque'])->masjed  }}</span>
                        @endisset
                    </div>
                </div>


                <!-- /.card-body -->
                <div class="card-body table-bordered table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th style="width: 5%; alignment: center">ردیف</th>
                            <th>فایل</th>
                            <th>نام کاربر</th>
                            <th>کدملی کاربر</th>
                            <th>شماره تماس کاربر</th>

                        </tr>
                        @foreach ($files as $key => $file)
                            <tr>
                                <td style="width: 5%; alignment: center" class="text-center">{{ $file->id }}</td>
                                <td>
                                    <a href="{{ asset('storage/'.$file->path) }}" class="btn btn-primary">دانلود
                                        فایل</a>
                                </td>
                                <td>
                                    {{ $file->singleResultItem()->name ?? "خطا" }}
                                </td>
                                <td>
                                    {{ $file->singleResultItem()->national_code ?? "خطا" }}
                                </td>

                                <td>
                                    {{ $file->singleResultItem()->phone ?? "خطا" }}
                                </td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{ $files->withQueryString()->render() }}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
