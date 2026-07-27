@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش کاربر</h6>
                    <form method="POST" action="{{route('users.update',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="name" value="{{ old('name', $user->name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام خانوادگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="user_name" value="{{ old('user_name', $user->user_name) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">موبایل</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="mobile" value="{{ old('mobile', $user->mobile) }}">
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
                            <label class="col-sm-2 col-form-label mr-3" for="file"> آپلود عکس </label>
                                <img src="{{asset('admin/user/'.$user->photo)}}" class="rounded-circle" style="width: 200px; height: 180px">
                            <input name="photo" type="file" class="form-control-file" id="file">
                        </div>
                        <x-submit></x-submit>
                    </form>

                </div>
            </div>
        </div>
    </main>
@endsection
