@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش دسته بندی</h6>
                    <form method="POST" action="{{route('categories.update',$category->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام دسته بندی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{ old('title', $category->title) }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">دسته پدر</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="parent_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                    <option selected="selected" value="0">دسته اصلی</option>
                                    @foreach($categories as $category)
                                        <option selected="selected" value="{{ old('title', $category->id) }}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label mr-3" for="file"> آپلود عکس </label>
                                <img src="{{asset('admin/category/'.$category->photo)}}" class="rounded-circle" style="width: 200px; height: 180px">
                            <input name="photo" type="file" class="form-control-file" id="file">
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
