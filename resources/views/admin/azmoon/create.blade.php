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
            <h3 class="card-title">افزودن آزمون</h3>
        </div>
        <!-- /.card-header -->

        <!-- form start -->
        <form role="form" method="post" action="{{ route('azmoon.store') }}" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="card-body" id="card">

                <div class="form-group col-6">
                    <label for="name">نام آزمون</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="نام آزمون را وارد کنید">
                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary pull-left"
                        style="alignment: left; border-color: #006D3F; width: 150px; border-radius: 10px">
                    ذخیره
                </button>
            </div>
        </form>
    </div>
@endsection


