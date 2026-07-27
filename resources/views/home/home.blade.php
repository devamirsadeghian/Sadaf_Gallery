@extends('home.layouts.master')


@section('title')
    خانه
@endsection


@section('content')
    <!-- Carousel  -->
    <div>
        <div class="container">
            @include('home.layouts.errors')
            <div id="demo" class="carousel slide rounded-slider mt-5" data-ride="carousel">

                <!-- Indicators -->
                <ul class="carousel-indicators">
                    @foreach($Sliders as $key => $slider)
                        <li data-target="#demo"
                            data-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}">
                        </li>
                    @endforeach
                </ul>

                <!-- Slideshow -->
                <div class="carousel-inner slider-container">
                    @foreach($Sliders as $key => $slider)
                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                <img src="{{ asset('admin/slider/'.$slider->photo) }}"
                                     class="slider-image"
                                     alt="slider">
                            </div>
                    @endforeach
                </div>

                <!-- Controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>

                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>

            </div>
        </div>
    </div>
    <br><br><br><br>


    <!--  ////////////////////////////////////////////    دسته بندی محصولات    //////////////////////////////////////////  -->

    <div class="container my-5">
        <div class="row justify-content-center gx-5 gy-4">

            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mx-4">
                <a href="/shop?search=&category[]=1&min_price=0&max_price=1000000&sort=newest&page=1" class="text-decoration-none">
                    <div class="category-image">
                        <img src="{{ asset('home/images/category_main/sham.jpg')}}"
                             alt="شمع"
                             class="rounded-circle rounded-full"
                             style="height: 160px; width: 160px">
                    </div>
                    <h6 class="category-title mt-3">شمع</h6>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mx-4">
                <a href="/shop?search=&category[]=2&min_price=0&max_price=1000000&sort=newest&page=1" class="text-decoration-none">
                    <div class="category-image">
                        <img src="{{ asset('home/images/category_main/ston.jpg')}}"
                             alt="سنگ مصنوعی"
                             class="rounded-circle rounded-full"
                             style="height: 160px; width: 160px">
                    </div>
                    <h6 class="category-title mt-3">سنگ مصنوعی</h6>
                </a>
            </div>

            <div class="col-lg-2 col-md-3 col-sm-4 col-6 text-center mx-4">
                <a href="/shop?search=&category[]=3&min_price=0&max_price=1000000&sort=newest&page=1" class="text-decoration-none">
                    <div class="category-image">
                        <img src="{{ asset('home/images/category_main/ghaleb.jpg')}}"
                             alt="قالب"
                             class="rounded-circle rounded-full"
                             style="height: 160px; width: 160px">
                    </div>
                    <h6 class="category-title mt-3">قالب</h6>
                </a>
            </div>

        </div>
    </div>


    <!--  ////////////////////////////////////////////    جدید ترین محصولات    //////////////////////////////////////////  -->

    <br><br>
    <div class="container my-3 border border-r rounded" style="border: 1px solid #f1f5f9; !important; border-radius: 50%; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">جدید ترین محصولات</h2>

            <a href="{{ route('shop', 'newest') }}" class="text-decoration-none text-danger">
                مشاهده همه
            </a>
        </div>

        <div class="container my-5">
            <div class="row g-4">
                @foreach($NewestProducts->take(6) as $NewestProduct)
                    @include('home.partial.product-card',['product'=>$NewestProduct,'col'=>'col-lg-2 col-md-4'])
                @endforeach
            </div>
        </div>
    </div>



    <!--  ////////////////////////////////////////////    پرفروش ترین محصولات    //////////////////////////////////////////  -->

    <br>
    <div class="container my-3 border border-r rounded" style="border: 1px solid #f1f5f9; !important; border-radius: 50%;">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">پرفروش ترین محصولات</h2>

            <a href="{{ route('shop', 'most_sold') }}" class="text-decoration-none text-danger">
                مشاهده همه
            </a>
        </div>


        <div class="container my-5">
            <div class="row g-4">
                @foreach($MostSellerProducts->take(6) as $MostSellerProduct)
                    @include('home.partial.product-card',['product'=>$MostSellerProduct,'col'=>'col-lg-2 col-md-4'])
                @endforeach
            </div>
        </div>
    </div>



    <!--  ////////////////////////////////////////////    ارزان ترین محصولات    //////////////////////////////////////////  -->

    <br>
        <div class="container my-3 border border-r rounded" style="border: 1px solid #f1f5f9; !important; border-radius: 50%;">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">ارزان ترین محصولات</h2>

            <a href="{{ route('shop', 'cheapest') }}" class="text-decoration-none text-danger">
                مشاهده همه
            </a>
        </div>


        <div class="container my-5">
            <div class="row g-4">
                @foreach($CheapestProducts->take(6) as $CheapestProduct)
                    @include('home.partial.product-card',['product'=>$CheapestProduct,'col'=>'col-lg-2 col-md-4'])
                @endforeach
            </div>
        </div>
    </div>

@endsection



@section('style')
    <style>
        /* slider */
        .rounded-slider{
            overflow: hidden;
            margin-inline: auto;
            border-radius: 20px;
            transition: all .4s ease;
            box-shadow: 0 8px 25px rgba(0,0,0,.12);
            height: 600px;
            width: 800px;
            position: relative;
        }

        .slider-container{
            overflow: hidden;
            border-radius: 20px;
        }

        .slider-image{
            height: 100%;
            width:100%;
            object-fit: fill;

            background: #000;
            transition: transform .6s ease;
            display: block;
        }


        .carousel-inner,
        .carousel-item{
            height: 100%;
        }


        /* Hover روی کل اسلایدر */
        .rounded-slider:hover{
            transform: translateY(-6px);
            box-shadow: 0 20px 45px rgba(236,101,231,.35);
        }

        /* Zoom تصویر */
        .rounded-slider:hover .slider-image{
            transform: scale(1.05);
        }

        /* افکت گرادیان */
        .carousel-item{
            position: relative;
        }

        .carousel-item::after{
            content:'';
            position:absolute;
            inset:0;
            background:linear-gradient(to top,
            rgba(0,0,0,.25),
            rgba(0,0,0,0));
            opacity:0;
            transition:.4s;
        }

        .rounded-slider:hover .carousel-item::after{
            opacity:1;
        }

        /* دکمه‌های قبلی و بعدی */
        .carousel-control-prev,
        .carousel-control-next{
            opacity:0;
            transition:.3s;
        }

        .rounded-slider:hover .carousel-control-prev,
        .rounded-slider:hover .carousel-control-next{
            opacity:1;
        }


        .rounded-slider{
            position: relative;
        }

        .rounded-slider::before{
            content:'';
            position:absolute;
            top:0;
            left:-120%;
            width:60%;
            height:100%;
            background:linear-gradient(
                120deg,
                transparent,
                rgba(255,255,255,.35),
                transparent
            );
            transition:.8s;
            z-index:5;
        }

        .rounded-slider:hover::before{
            left:150%;
        }


        /* product category */
        .category-item{
            display: inline-block;
            text-align: center;
            transition: all .35s ease;
        }


        .category-image img{
            border:4px solid #f8d4f4;
            transition: all .35s ease;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
        }


        .category-title{
            color:#333;
            font-weight:600;
            transition: all .35s ease;
        }


        .category-item:hover{
            transform: translateY(-10px);
        }


        .category-item:hover img{
            transform: scale(1.08);
            border-color:#ec65e7;
            box-shadow:0 15px 35px rgba(236,101,231,.45);
        }


        .category-item:hover .category-title{
            color:#ec65e7;
            letter-spacing:1px;
        }


        .category-image{
            position:relative;
            display:inline-block;
        }


        .category-image::after{
            content:'';
            position:absolute;
            inset:-8px;
            border:2px dashed #ec65e7;
            border-radius:50%;
            transform:scale(.8);
            opacity:0;
            transition:.35s;
        }


        .category-item:hover .category-image::after{
            transform:scale(1);
            opacity:1;
        }


        /* product */
        .card{
            border:2px solid transparent;
            transition:all .3s ease;
            cursor:pointer;
        }


        .card:hover{
            border-color: var(--pink-color);   /* رنگ دلخواه */
            box-shadow:0 8px 20px rgba(0,0,0,.15);
            transform:translateY(-5px);
        }


        .text-center{
            color: var(--pink-color);
        }



        /*----------------------------*/
        /* Product */
        /*----------------------------*/

        .product-card {

            background: white;

            border-radius: 20px;

            overflow: hidden;

            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);

            transition: .3s;

            position: relative;

        }

        .product-card:hover {

            transform: translateY(-8px);

            box-shadow: 0 18px 35px rgba(236, 101, 231, .25);

        }

        .product-image {
            width: 100%;
            object-fit: cover;
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .product-body {
            padding: 20px;
            text-align: center;
        }


        .discount {
            padding: 6px 10px;
            position: relative;
            overflow: hidden; /* در صورت نیاز */
            z-index: 100;
            border-radius: 20px;
            font-size: 13px;
            top: 28px;
            left: 1px;
            width: 120px;
            text-align: center;
            background: #ff4d4f;
            color: white;
            transform: rotate(-45deg);
            font-weight: bold;
        }


        /*----------------------------*/
        /* price */
        /*----------------------------*/

        .price {

            color: #ec65e7;

            font-size: 22px;

            font-weight: bold;

        }

        .price-filter {
            width: 100%;
            direction: rtl;
            text-align: right;
        }

        .price-slider {
            width: 100%;
            /*display:block;*/
            cursor: pointer;
            accent-color: #ec65e7; /* رنگ صورتی */
        }

        .price-range {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            font-size: 14px;
            color: #666;
        }

        .price-range b {
            color: #ec65e7;
        }


        .selected-price {

            text-align: center;

            font-size: 15px;

            font-weight: bold;

            color: #555;

        }

        .selected-price span {

            color: #ec65e7;

            font-size: 18px;

        }

        .text-price {
            color: #ec65e7;
        }

        .clear-btn {

            border-radius: 30px;

            background: #f7f7f7;

        }

        .clear-btn:hover {

            background: #ececec;

        }

    </style>
@endsection

@section('script')

@endsection

