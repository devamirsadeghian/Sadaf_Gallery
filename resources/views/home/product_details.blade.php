@extends('home.layouts.master')


@section('title')
    جزيیات محصول
@endsection




@section('content')

        <div class="container my-5">
            <div class="row">
                <!-- تصاویر -->
                <div class="col-lg-5">
                    <div class="product-gallery">
                        <img
                            id="mainImage"
                            src="{{ asset('admin/product/'.$product->photo) }}"
                            class=" main-image">
                    </div>
                    <div class="mt-3 d-flex justify-content-center">

                        <img src="{{ asset('admin/product/'.$product->photo) }}"
                             class="thumb-image active-thumb">

                        @foreach($product->galleries as $image)

                            <img src="{{ asset('admin/gallery/'.$image->photo) }}"
                                 class="thumb-image">

                        @endforeach
                    </div>
                </div>
                <!-- اطلاعات -->

                <div class="col-lg-7">
                    <h2 class="fw-bold mx-1">
                        {{ $product->title_fa }}
                    </h2>

                    <p class="text-muted mx-1">
                        {{ $product->title_en }}
                    </p>
                    <hr>
                    <div class="mb-3">
                        @if($product->count != 0)
                            <span class="badge bg-success">
                            موجود در انبار
                            </span>
                        @else
                            <span class="badge bg-danger">
                            ناموجود
                            </span>
                        @endif

                        <span class="text-muted mx-1">
                            کد کالا :
                        {{ $product->id }}
                        </span>
                    </div>


                    @if($product->discount)
                        <div>
                    <span class="old-price">
                        {{ number_format($product->price) }}
                    </span>
                            <span class="discount-badge">
                                {{$product->discount_percent}}%
                            </span>

                        </div>
                        <h2 class="new-price mt-2">
                            {{ number_format($product->price-$product->discount) }}
                            تومان
                        </h2>
                    @else
                        <h2 class="new-price">
                            {{ number_format($product->price) }}
                            تومان
                        </h2>
                    @endif
                    <hr>
                    <!-- رنگ -->

                    <h5>
                        انتخاب رنگ
                    </h5>
                    <form method="POST" action="{{route('basket.store',$product->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="my-3">
                        @foreach($product->colors as $color)
                            <label class="color-label">
                                <input
                                    type="radio"
                                    name="color_id"
                                    value="{{ $color->id }}"
                                    class="color-input">

                                <span
                                    class="color-item"
                                    style="background: {{ $color->color }}"
                                    title="{{ $color->title }}">

                                </span>

                            </label>
                        @endforeach
                    </div>
                    <hr>

                    <!-- تعداد -->
                    <h5>
                        تعداد
                    </h5>

                    <div class="quantity-box">
                        <button class="qty-btn" id="plus" type="button">
                            +
                        </button>
                        <input
                            id="qty"
                            name="count"
                            type="text"
                            value="1"
                            readonly>
                        <button class="qty-btn" id="minus" type="button">
                            -
                        </button>
                    </div>

                    <div class="mt-4">
                        <button class="btn add-cart-btn" name="submit" type="submit">
                            🛒 افزودن به سبد خرید
                        </button>
                    </div>

                    </form>

                </div>
            </div>
        </div>

        {{--                        comment--}}

        <hr class="container ">

        <div class="container mb-5">

            <div class="review-box">

                <h4 class="my-5 text-center">
                    نظرات کاربران
                </h4>

                {{-- فرم ثبت نظر --}}
                @auth
                    <form action="{{ route('comments.store', $product->id) }}" method="POST">
                        @csrf

                        <div class="mb-3">
                    <textarea
                        class="form-control review-textarea"
                        name="body"
                        rows="4"
                        placeholder="نظر خود را درباره این محصول بنویسید..."></textarea>
                        </div>

                        <div class="mb-3">
                            <div class="mb-4 text-center">
                                <label class="form-label fw-bold mb-3 d-block">
                                    امتیاز شما
                                </label>

                                <div class="rating-box">
                                    @for($i = 1; $i <= 5; $i++)
                                        <input
                                            type="radio"
                                            name="rate"
                                            value="{{ $i }}"
                                            id="rate{{ $i }}"
                                            class="d-none"
                                            required>

                                        <label for="rate{{ $i }}" class="rate-item">
                                            <i class="fas fa-star"></i>
                                            <span>{{ $i }}</span>
                                        </label>
                                    @endfor
                                </div>
                            </div>

                            <div class="text-center">
                                <button class="btn review-btn">
                                    ثبت نظر
                                </button>
                            </div>

                            </div>
                    </form>
                @else

                    <div class="alert alert-light border text-center">
                        برای ثبت نظر ابتدا
                        <a href="{{ route('login') }}">
                            وارد حساب کاربری
                        </a>
                        شوید.
                    </div>
                @endauth

                <hr class="my-5 hr-border">




                {{-- لیست نظرات --}}

                @forelse($comments as $comment)

                    <div class="comment-card">
                        <div class="comment-header">
                            <div class="comment-user">
                                <strong>
                                    {{ $comment->user->name }} {{ $comment->user->user_name }}
                                </strong>

                                <span class="comment-rate">
                                    <i class="fas fa-star"></i>
                                    {{ $comment->rate }}
                                </span>
                            </div>

                            <small>
                                {{ \Hekmatinasser\Verta\Facades\Verta::format('Y/m/d',$comment->created_at) }}
                            </small>
                        </div>

                        <p class="comment-body text-right">
                            {{ $comment->body }}
                        </p>

                        {{-- پاسخ مدیریت --}}
                        @foreach($comment->replies as $reply)
                            <div class="admin-reply mt-3 text-end">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="reply-title">
                                        <i class="fas fa-user-shield ms-1"></i>

                                        پاسخ ادمین در جواب
                                        <strong>
                                            {{ $comment->user->name }} {{ $comment->user->user_name }}
                                        </strong>
                                    </div>

                                    <small class="text-muted">
                                        {{ \Hekmatinasser\Verta\Facades\Verta::format('Y/m/d', $reply->created_at) }}
                                    </small>
                                </div>

                                <div class="reply-text mt-2">
                                    {{ $reply->body }}
                                </div>

                            </div>
                        @endforeach

                        {{-- فرم پاسخ فقط برای ادمین --}}
                        @if(auth()->check() && auth()->user()->is_admin)

                            <div class="text-end mt-3">

                                <button
                                    class="reply-btn"
                                    type="button"
                                    onclick="toggleReply({{ $comment->id }})">

                                    <i class="fas fa-reply"></i>
                                    پاسخ

                                </button>

                            </div>

                            <form
                                id="reply-form-{{ $comment->id }}"
                                action="{{ route('comments.reply',$comment->id) }}"
                                method="POST"
                                class="reply-form">

                                @csrf

                                <textarea
                                    name="body"
                                    rows="3"
                                    class="form-control"
                                    placeholder="پاسخ ادمین..."></textarea>

                                <div class="text-end mt-2">
                                    <button class="send-reply-btn">
                                        ثبت پاسخ
                                    </button>
                                </div>

                            </form>

                        @endif

                    </div>






                @empty
{{--                    <div class="text-center text-muted py-4">--}}
{{--                        هنوز نظری برای این محصول ثبت نشده است.--}}
{{--                    </div>--}}

                    <div class="text-center text-muted">
                        نظری ثبت نشده است.
                    </div>
                @endforelse

            </div>
        </div>
@endsection


@section('style')
    <style>
        .form-label{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        .rating-box{
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
        }

        /* Product Page */
        .product-gallery{
            background:#fff;
            border-radius:20px;
            padding:20px;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
            text-align:center;
            transition:.4s;
        }

        .product-gallery:hover{
            box-shadow:0 35px 55px rgba(236,101,231,.25);
            border-color:#ec65e7;
        }

        .main-image{
            width:100%;
            height:380px;
            object-fit:contain;
            transition:.8s;
            cursor:zoom-in;
            background:white;
        }

        .main-image:hover{
            transform:scale(0.04);
        }

         /* Thumbnail */

        .thumb-image{
            width:80px;
            height:80px;
            object-fit:cover;
            border-radius:15px;
            margin:8px;
            cursor:pointer;
            border:2px solid transparent;
            transition:.3s;
            padding:4px;
            background:white;
        }

        .thumb-image:hover{
            transform:translateY(-10px);
            border-color:#ec65e7;
            box-shadow:0 8px 20px rgba(236,101,231,.35);
        }

        .active-thumb{
            border-color:#ec65e7;
        }

        /* Title */

        h2{
            font-weight:700;
        }

        .text-muted{
            font-size:15px;
        }

        /* Price */

        .old-price{
            color:#999;
            font-size:18px;
            text-decoration:line-through;
            margin-left:10px;
        }

        .new-price{
            color:#ec65e7;
            font-size:34px;
            font-weight:bold;
        }

        /* Discount Badge */

        .discount-badge{
            background:#ff3c57;
            color:white;
            padding:5px 12px;
            border-radius:30px;
            font-size:15px;
            font-weight:bold;
        }


        /* Colors */

        .color-circle{
            width:38px;
            height:38px;
            border-radius:50%;
            display:inline-block;
            margin-left:10px;
            cursor:pointer;
            border:3px solid white;
            box-shadow:0 5px 15px rgba(0,0,0,.15);
            transition:.3s;
        }

        .color-circle:hover{
            transform:scale(1.18);
            border-color:#ec65e7;
        }

        /* Quantity */

        .quantity-box{
            display:flex;
            justify-content: left;
            align-items:center;
            width:150px;
            border:1px solid #ddd;
            border-radius:12px;
            overflow:hidden;
            margin-right: auto; /* قرار گرفتن در سمت چپ */
        }

        .qty-btn{
            width:45px;
            height:45px;
            border:none;
            background:#f8f8f8;
            font-size:22px;
            transition:.3s;
        }

        .qty-btn:hover{
            background:#ec65e7;
            color:white;
        }

        #qty{
            width:60px;
            text-align:center;
            border:none;
            font-size:18px;
        }

        /* Button */

        .add-cart-btn{
            width:100%;
            height:55px;
            background:#ec65e7 !important;
            color:white !important;
            font-size:18px;
            font-weight:bold;
            border-radius:15px;
            transition:.35s;
            border:none;
        }

        .add-cart-btn:hover{
            background:#d943d2;
            transform:translateY(-3px);
            box-shadow:0 12px 25px rgba(236,101,231,.4);
        }

        /* Store Feature */

        .list-unstyled li{
            margin-bottom:12px;
            font-size:16px;
        }

        /* Hover Animation */

        .product-gallery,
        .add-cart-btn,
        .thumb-image,
        .color-circle{
            transition:all .35s ease;
        }

        /* Responsive */

        @media(max-width:992px){
            .main-image{
                height:320px;
            }

            .new-price{
                font-size:28px;
            }
        }

        @media(max-width:768px){
            .thumb-image{
                width:60px;
                height:60px;
            }

            .main-image{
                height:250px;
            }

        }

        .active-color{
            border:4px solid #ec65e7 !important;
            transform:scale(1.2);
            box-shadow:0 8px 25px rgba(236,101,231,.45);
        }


        /* add color */
        .color-label{
            cursor:pointer;
            margin-left:12px;
        }

        .color-input{
            display:none;
        }

        .color-item{
            width:42px;
            height:42px;
            border-radius:50%;
            display:inline-block;
            border:3px solid #ddd;
            transition:.3s;
            box-shadow:0 3px 10px rgba(0,0,0,.15);
        }

        .color-item:hover{
            transform:scale(1.15);
            border-color:#ec65e7;
        }

        .color-input:checked + .color-item{
            border:4px solid #ec65e7;
            transform:scale(1.18);
            box-shadow:0 10px 25px rgba(236,101,231,.45);
        }


        /*comment*/
        .review-box{
            background:#fff;
            border-radius:20px;
            padding:35px;
            box-shadow:0 8px 25px rgba(0,0,0,.08);
        }

        .review-box h4{
            font-weight:700;
            color:#ec65e7;
        }

        .review-textarea{
            border-radius:15px;
            resize:none;
            padding:15px;
            border:1px solid #ddd;
        }

        .review-textarea:focus{
            border-color:#ec65e7;
            box-shadow:0 0 0 .2rem rgba(236,101,231,.15);
        }

        .review-btn{;
            background:#ec65e7 !important;
            color:white;
            border:none;
            padding:10px 35px;
            border-radius:12px;
            transition:.3s;
        }

        .review-btn:hover{
            background:#d84bd4 !important;
            color:white;
            transform:translateY(-2px);
        }


        .hr-border{
            border-top: 5px solid black
        }

        /*input rate*/
        .rating-box{
            display:flex;
            gap:12px;
            flex-wrap:wrap;
        }

        .rate-item{
            display:flex;
            align-items:center;
            gap:6px;
            padding:8px 16px;
            border:2px solid #e9ecef;
            border-radius:50px;
            background:#fff;
            cursor:pointer;
            transition:.3s;
            font-weight:600;
            color:#555;
        }

        .rate-item i{
            color:#ec65e7;
            margin-top:4px;
            transition:.3s;
        }

        input[type=radio]:checked + .rate-item{
            background:#ec65e7;
            transform:translateY(-5px);
            background: rgb(254,190,245);
            border-color:black;
            color:#222;
        }

        input[type="radio"]:checked + .rate-item i{
            color:#ec65e7;
        }

        .rate-item:hover{
            transform:translateY(-3px);
            border-color:#ec65e7;
            background:#fff8e1;
            box-shadow:0 4px 12px rgba(255,193,7,.25);
        }

        .comment-card{
            background:#fff;
            border-radius:16px;
            padding:20px;
            margin-bottom:20px;
            border:1px solid #eee;
            box-shadow:0 5px 15px rgba(0,0,0,.05);
        }

        .comment-header{
            display:flex;
            justify-content:space-between;
            align-items:center;
            margin-bottom:15px;
        }

        .comment-user{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .comment-rate{
            background:#ec65e7;
            color:#fff;
            padding:5px 12px;
            border-radius:30px;
            font-size:13px;
        }

        .comment-body{
            line-height:2;
            color:#555;
        }

        .reply-btn{
            display: block;
            margin-right: inherit;
            margin-left: 0;
            background:#ec65e7;
            color:#fff;
            border:none;
            padding:8px 20px;
            border-radius:10px;
            transition:.3s;
            margin-top:15px;
            align-items: center;
            gap: 8px;
            direction: rtl;
        }

        .reply-btn:hover{

            background:#d84dd3;
        }

        .reply-form{
            display: none;
            margin-top: 15px;
            text-align: right;
            direction: rtl;
            border-radius: 12px;
        }

        .reply-form textarea{
            text-align: right;
            direction: rtl;
            border-radius: 12px;
        }

        .send-reply-btn{
            margin-top: 10px;
            background:#ec65e7;
            color:#fff;
            border:none;
            padding:10px 25px;
            border-radius:10px;
        }

        .admin-reply{
            direction: rtl;
            text-align: right;
            margin-top: 20px;
            padding: 18px;
            background: #fff5ff;
            border-right: 5px solid #ec65e7;
            border-radius: 12px;
            margin-right:35px;
            border-right:5px solid #ec65e7;
        }

        .reply-title{
            display: flex;
            justify-content: flex-start;
            align-items: center;
            gap: 8px;
            color: #ec65e7;
            font-weight: bold;
            font-size:15px;
            margin-bottom:8px;
        }

        .reply-title strong{
            color:#333;
        }

        .reply-text{
            direction: rtl;
            text-align: right;
            line-height: 2;
            color: #555;
        }

        .admin-reply small{
            text-align: right;
        }
    </style>
@endsection


@section('script')
    <script>
        // تغییر تصویر اصلی
        const thumbs = document.querySelectorAll(".thumb-image");
        const mainImage = document.getElementById("mainImage");

        thumbs.forEach(function(item){

            item.addEventListener("click",function(){

                mainImage.src = this.src;

                thumbs.forEach(function(img){
                    img.classList.remove("active-thumb");
                });

                this.classList.add("active-thumb");
            });
        });

        // افزایش تعداد
        const plus = document.getElementById("plus");
        const minus = document.getElementById("minus");
        const qty = document.getElementById("qty");

        plus.addEventListener("click",function(e){
            e.preventDefault();
            qty.value = parseInt(qty.value)+1;
        });


        // کاهش تعداد
        minus.addEventListener("click",function(e){
            e.preventDefault();
            if(parseInt(qty.value)>1){
                qty.value = parseInt(qty.value)-1;
            }
        });


        // انتخاب رنگ
        const colors=document.querySelectorAll(".color-circle");

        colors.forEach(function(color){

            color.addEventListener("click",function(){

                colors.forEach(function(item){
                    item.classList.remove("active-color");
                });

                this.classList.add("active-color");
            });
        });

        // افکت زوم تصویر
        mainImage.addEventListener("mousemove",function(e){

            const x=e.offsetX;
            const y=e.offsetY;

            this.style.transformOrigin=x+"px "+y+"px";
            this.style.transform="scale(1.05)";
        });

        mainImage.addEventListener("mouseleave",function(){

            this.style.transformOrigin="center";
            this.style.transform="scale(1)";
        });


        function toggleReply(id){

            let form=document.getElementById('reply-form-'+id);

            if(form.style.display==="block"){
                form.style.display="none";
            }else{
                form.style.display="block";
            }

        }

    </script>
@endsection
