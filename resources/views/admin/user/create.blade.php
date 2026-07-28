@extends('admin.layouts.master')


@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد کاربر</h6>
                    <form method="POST" action="{{route('users.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="name" value="{{old('name')}}">
                            </div>
                        </div><div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="user_name" value="{{old('user_name')}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">موبایل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="mobile" value="{{old('mobile')}}" placeholder="مثال : 9137770022">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">پسورد</label>
                            <div class="col-sm-10">
                                <input type="password" name="password" value="{{old('password')}}" class="form-control text-left" dir="rtl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">تکرار پسورد</label>
                            <div class="col-sm-10">
                                <input type="password" name="password_confirmation" value="{{old('password_confirmation')}}" class="form-control text-left" dir="rtl">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                            <input name="photo" type="file" value="{{old('photo')}}" class="col-sm-10" id="file">
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
