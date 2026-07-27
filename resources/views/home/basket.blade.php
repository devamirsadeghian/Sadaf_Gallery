@extends('home.layouts.master')


@section('title')
    سبد خرید
@endsection


@section('content')
    <div class="">
        @include('home.layouts.errors')
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="glass-card my-5 mr-5 p-3">
                    <div class="p-4">
                        <h3>🛒 سبد خرید</h3>
                    </div>
                    @foreach($basketsDetails as $index => $basketsDetail)
                        <div class="cart-item mb-3">
                            <div class="row align-items-center">

                                <div class="col-md text-center">
                                    <span class="info-label">ردیف</span>
                                    <div class="info-value">{{ $loop->iteration }}</div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label d-block my-0"></span>
                                    <img src="{{ asset('admin/product/'.$basketsDetail->product->photo) }}"
                                         class="product-image">
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">نام محصول</span>
                                    <div class="product-title">
                                        {{ $basketsDetail->product->title_fa }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">کد محصول</span>
                                    <div class="info-value">
                                        {{ $basketsDetail->product->id }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">تعداد</span>
                                    <div class="info-value">
                                        {{ $basketsDetail->count }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">رنگ</span>

                                    @if($basketsDetail->color)
                                        <span
                                            style="
                                        display:inline-block;
                                        width:30px;
                                        height:30px;
                                        border-radius:50%;
                                        background-color: {{ $basketsDetail->color->color }};
                                        border:1px solid black;
                                        "
                                            title="{{ $basketsDetail->color->title }}">
                                    </span>
                                    @else
                                        <span class="bg-white text-dark">نا مشخص</span>
                                    @endif


                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">قیمت اصلی</span>
                                    <div class="price">
                                        {{ number_format($basketsDetail->price) }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">مبلغ تخفیف</span>
                                    <div class="price">
                                        {{ number_format($basketsDetail->discount) }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label">قیمت نهایی</span>
                                    <div class="price">
                                        {{ number_format( $basketsDetail->price - $basketsDetail->discount ) }}
                                    </div>
                                </div>

                                <div class="col-md text-center">
                                    <span class="info-label d-block mb-2"></span>
                                    <a href="{{ route('basket.destroy', $basketsDetail->id) }}" class="btn-remove">
                                        حذف
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="col-lg-4">
                <div class="glass-card summary p-4 my-5 mx-5">
                    <h4 class="text-right">
                        خلاصه سفارش
                    </h4>
                    <hr>
                    <div class="d-flex justify-content-between mb-3">
                        <span>تعداد کالا</span>
                        <strong>
                            {{ $basketsDetail->sum('count') }}
                        </strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>جمع کالاها</span>
                        <strong>
                            {{ number_format($total) }} تومان
                        </strong>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>هزینه ارسال</span>
                        <strong>
                            {{ number_format(90000) }} تومان
                        </strong>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between fs-5 mb-4">

                        <strong>مبلغ نهایی</strong>

                        <strong>
                            {{ number_format($total + 90000) }} تومان
                        </strong>

                    </div>

                    <a href="{{route('address.index', auth()->id() )}}" class="btn btn-main w-100 px-2">
                        ادامه فرآیند خرید
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('style')

    <style>

        *{
            font-family:'Vazirmatn',sans-serif;
        }

        body{
            margin:0;
            background:linear-gradient(135deg,#ec65e7,#c542c0,#7b2cbf);
            min-height:100vh;
            overflow-x:hidden;
        }

        body::before,
        body::after{
            content:"";
            position:fixed;
            border-radius:50%;
            filter:blur(80px);
            opacity:.35;
            z-index:0;
        }

        body::before{
            width:350px;
            height:350px;
            background:#fff;
            right:-100px;
            top:-100px;
        }

        body::after{
            width:250px;
            height:250px;
            background:#ffd6ff;
            left:-70px;
            bottom:-70px;
        }

        .glass-card{
            position:relative;
            z-index:2;
            background:rgba(255,255,255,.15);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.25);
            border-radius:25px;
            color:white;
            box-shadow:0 20px 60px rgba(0,0,0,.2);
        }

        .cart-item{
            padding:20px;
            margin-bottom:15px;
            background:rgba(255,255,255,.08);
            border:1px solid rgba(255,255,255,.15);
            border-radius:18px;
            transition:.3s;
        }

        .info-label{
            display:block;
            font-size:12px;
            color:#ffd6ff;
            margin-bottom:6px;
            font-weight:700;
            text-align:center;
        }

        .info-value{
            color:#fff;
            font-size:15px;
            font-weight:600;
        }

        .cart-item:last-child{
            border:none;
        }

        .product-image{
            width:110px;
            height:110px;
            border-radius:15px;
            object-fit:cover;
            border:2px solid rgba(255,255,255,.3);
        }

        .product-title{
            font-size:17px;
            font-weight:700;
            color:#fff;
            text-align:center;
        }

        .info-label{
            color: black;
            font-size: 14px;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .price{
            font-size:17px;
            color:#fff;
            font-weight:bold;
        }

        .qty{
            width:70px;
            background:rgba(255,255,255,.15);
            border:none;
            color:white;
            border-radius:10px;
            text-align:center;
        }

        .qty:focus{
            background:rgba(255,255,255,.25);
            color:white;
            box-shadow:none;
        }

        .summary{
            position:sticky;
            top:20px;
        }

        .summary hr{
            border-color:rgba(255,255,255,.2);
        }

        .btn-main{
            background:white !important;
            color:#ec65e7 !important;
            border:none;
            border-radius:15px;
            height:52px;
            font-weight:bold;
            transition:.3s;
            align-content: center;
        }

        .btn-main:hover{
            transform:translateY(-3px);
            color:#ec65e7;
            box-shadow:0 10px 25px rgba(255,255,255,.35);
        }

        .btn-remove{
            display:inline-block;
            padding:8px 18px;
            border-radius:10px;
            background:#ff4d6d;
            color:#fff;
            text-decoration:none;
            transition:.3s;

        }

        .btn-remove:hover{
            background:#e63946;
            color:#fff;
        }

        h3,h4,h5{
            font-weight:700;
        }

    </style>

@endsection

