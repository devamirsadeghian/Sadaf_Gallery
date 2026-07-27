@extends('admin.layouts.master')



@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش گروه ویژگی ها</h6>
                    <form method="POST" action="{{route('properties.update',$property->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام ویژگی</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{ old('title', $property->title) }}">
                            </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">عنوان گروه ویژگی ها  </label>
                            <div class="col-sm-10">
                                <select class="form-select" name="property_group_id" style="width: 100%;" data-select2-id="1"
                                        tabindex="-1" aria-hidden="true">
                                    @foreach($propertyGroups as $key => $propertyGroup)
                                        <option selected="selected" value="{{$key}}">{{$propertyGroup}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
