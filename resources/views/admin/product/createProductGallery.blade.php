@extends('admin.layouts.master')


@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">افزودن عکس</h6>
                    <form method="POST" action="{{route('store.gallery',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="product_id">آیدی محصول</label>
                            <input name="product_id" type="text" class="col-sm-10 form-control-file" value="{{$product->id}}" id="product_id" readonly>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="file"> آپلود عکس </label>
                            <input name="photo" type="file" class="col-sm-10 form-control-file" value="{{old('photo')}}"
                                   id="file">
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
