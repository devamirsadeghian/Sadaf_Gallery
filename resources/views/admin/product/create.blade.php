@extends('admin.layouts.master')



@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title">ایجاد محصول</h6>
                    <form method="POST" action="{{route('products.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام فارسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title_fa" value="{{ old('title_fa') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام انگلیسی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="title_en" value="{{ old('title_en') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> قیمت محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="price" value="{{ old('price') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> تعداد محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="count" value="{{ old('count') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">نام گارانتی محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="guaranty" value="{{ old('guaranty') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> تخفیف محصول</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control text-left" dir="rtl" name="discount" value="{{ old('discount') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label "> توضیحات محصول</label>
                            <div class="col-sm-10">
                                <textarea name="description" rows="3" cols="8" class="form-control text-left">{{ old('description') }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">محصول ویژه</label>

                            <input type="hidden" name="is_special" value="0">

                            <input
                                type="checkbox"
                                name="is_special"
                                value="1"
                                {{ old('is_special') ? 'checked' : '' }}>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"> تاریخ اعتبار محصول ویژه </label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control text-left" dir="rtl" name="special_expiration" value="{{ old('special_expiration') }}">
                            </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">دسته بندی  </label>
                            <div class="col-sm-10">
                                <select class="form-select" name="category_id" style="width:100%">
                                    <option value="0" {{ old('category_id') == 0 ? 'selected' : '' }}>
                                        دسته اصلی
                                    </option>

                                    @foreach($categories as $key => $category)
                                        <option value="{{ $key }}"
                                            {{ old('category_id') == $key ? 'selected' : '' }}>
                                            {{ $category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-select2-id="23">
                            <label class="col-sm-2 col-form-label">برند</label>
                            <div class="col-sm-10">
                                <select class="form-select" name="brand_id" style="width:100%">
                                    <option value="">-</option>

                                    @foreach($brands as $key => $brand)
                                        <option value="{{ $key }}"
                                            {{ old('brand_id') == $key ? 'selected' : '' }}>
                                            {{ $brand }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="row">
                                <label class="form-label-color">رنگ بندی</label>
                                @foreach($colors as $color)
                                    <div class="col-md-1 mb-2 text-center">
                                        <div class="form-check p-0">

                                            <input
                                                class="form-check-input d-none"
                                                type="checkbox"
                                                name="colors[]"
                                                value="{{ $color->id }}"
                                                id="color{{ $color->id }}"
                                                {{ in_array($color->id, $selectedColors ?? []) ? 'checked' : '' }}>

                                            <label class="color-circle"
                                                   for="color{{ $color->id }}"
                                                   style="background-color: {{ $color->color }};"
                                                   title="{{ $color->title }}">
                                            </label>

                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label" for="photo"> عکس محصول </label>
                            <input name="photo" type="file" class="col-sm-10 form-control-file" id="photo">
                        </div>
                        <x-submit></x-submit>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

<style>
    .color-circle{
        width:35px;
        height:35px;
        border-radius:50%;
        border:2px solid #ddd;
        display:inline-block;
        cursor:pointer;
        transition:.3s;
    }

    .color-circle:hover{
        transform:scale(1.1);
        border-color:#ec65e7;
    }

    .form-check-input:checked + .color-circle{
        border:6px solid #ec65e7;
        box-shadow:0 0 10px rgba(236,101,231,.5);
        transform:scale(1.15);
    }

    .form-label-color{
        margin-left: 110px;
    }


</style>

@section('script')
    <script>
        $('.form-select').select2();

        var customOptions = {
            placeholder: "روز / ماه / سال"
            , twodigit: false
            , closeAfterSelect: true
            , nextButtonIcon: "fa fa-arrow-circle-right"
            , previousButtonIcon: "fa fa-arrow-circle-left"
            , buttonsColor: "#5867dd"
            , markToday: true
            , markHolidays: true
            , highlightSelectedDay: true
            , sync: true
            , gotoToday: true
        }
        kamaDatepicker('tarikh', customOptions);

    </script>
@endsection

