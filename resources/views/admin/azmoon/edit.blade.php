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
        <div class="card-header" style="background-color: #486551">
            <h3 class="card-title">ویرایش بخش</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="{{ route('parts.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body" id="card">

                <div class="form-group col-6">
                    <label for="name">نام بخش</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="نام بخش را وارد کنید" value="{{ Crypt::decrypt($part->name) }}">
                </div>

                <div class="form-group col-6" style="margin-top: 10px">
                    <label for="store_id">انبار مربوطه را انتخاب کنید</label>
                    <select name="store_id" id="store_id" class="form-control">
                        @foreach ($stores as $store)
                            <option value="{{ $store->id }}" @if($store->id == $part->store_id) selected @endif>
                                {{ $store->name }}
                            </option>
                        @endforeach
                    </select>

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-left"
                        style="alignment: left; background-color: #006D3F !important; border-color: #006D3F; width: 150px; border-radius: 10px">
                    ذخیره
                </button>
            </div>
        </form>
    </div>
@endsection


