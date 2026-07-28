@extends('admin.layouts.master')



@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد دسته بندی</h6>
                    <form method="POST" action="{{route('sliders.update',$slider->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">عنوان اسلایدر</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{ old('title', $slider->title) }}" >
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">لینک اسلایدر</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="url" value="{{ old('url', $slider->url) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                            <input name="photo" type="file" class="form-control-file col-sm-10" id="file">
                            <span><img src="{{asset('admin/slider/'.$slider->image)}}" width="100px" alt=""></span>
                        </div>

                        <div class="form-group row">
                            <button name="submit" type="submit" class="btn btn-success btn-uppercase">
                                <i class="ti-check-box m-r-5"></i> ذخیره
                            </button>
                        </div>
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
