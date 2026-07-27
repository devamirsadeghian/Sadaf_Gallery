@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ویرایش نقش</h6>
                    <form method="POST" action="{{route('roles.update',$role->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group row">
                            <label  class="col-sm-2 col-form-label">نام</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="name" value="{{ old('name', $role->name) }}">
                            </div>
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
