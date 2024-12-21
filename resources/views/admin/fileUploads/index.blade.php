@extends('admin.layouts.master')
@push('styles')
    <style>
        .filter-result-container span.text-bold{
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
                                    <a href="{{ asset($file->path) }}" class="btn btn-primary">دانلود فایل</a>
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
