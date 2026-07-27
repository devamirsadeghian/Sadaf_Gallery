@extends('admin.layouts.master')


@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد نقش</h6>
                    <form method="POST" action="{{route('roles.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام نقش</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="name" value="{{old('name')}}">
                            </div>
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
