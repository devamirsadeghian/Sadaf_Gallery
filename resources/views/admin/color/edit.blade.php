@extends('admin.layouts.master')


@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش رنگ</h6>
                    <form method="POST" action="{{route('colors.update',$color->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام رنگ</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{ old('title', $color->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">کد رنگ</label>
                            <div class="col-sm-10">
                                <input type="color" class="form-control text-left" dir="rtl" name="color" value="{{ old('color', $color->color) }}">
                            </div>
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection



@section('css')

@endsection

@section('script')

@endsection
