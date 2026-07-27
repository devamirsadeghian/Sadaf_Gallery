@extends('admin.layouts.master')


@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد گروه ویژگی ها</h6>
                    <form method="POST" action="{{route('property_groups.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">عنوان ایجاد گروه ویژگی ها</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title" value="{{old('title')}}">
                            </div>
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

