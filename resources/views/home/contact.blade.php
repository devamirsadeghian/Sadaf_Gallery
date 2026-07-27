@extends('home.layouts.master')


@section('title')
    تماس با ما
@endsection


@section('content')
    @include('home.layouts.errors')

    <div class="container my-5">

        <div class="contact-box">

            <div class="text-center mb-5">
                <h2 class="contact-title">تماس با ما</h2>
                <p class="text-muted">
                    خوشحال می‌شویم نظرات، پیشنهادات و سوالات شما را بشنویم.
                </p>
            </div>

            <div class="row">

                <!-- اطلاعات تماس -->
                <div class="col-lg-5 mb-4">

                    <div class="contact-card">

                        <h4 class="mb-4">راه‌های ارتباطی</h4>

                        <div class="contact-item">
                            <span>📞</span>
                            <div>
                                <strong>تلفن</strong>
                                <p>021-12345678</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span>📱</span>
                            <div>
                                <strong>موبایل</strong>
                                <p>09123456789</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span>📧</span>
                            <div>
                                <strong>ایمیل</strong>
                                <p>info@sadafgallery.ir</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span>📍</span>
                            <div>
                                <strong>آدرس</strong>
                                <p>تهران، خیابان ...</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <span>🕒</span>
                            <div>
                                <strong>ساعات پاسخگویی</strong>
                                <p>شنبه تا پنجشنبه | ۹ تا ۱۸</p>
                            </div>
                        </div>

                    </div>

                </div>

                <!-- فرم تماس -->
                <div class="col-lg-7">

                    <div class="contact-card">
                        <form method="POST" action="{{ route('contact.store')}}">
                            @csrf
                            <div class="form-group mb-3">
                                <label>نام و نام خانوادگی</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="حسین محمدی">
                            </div>

                            <div class="form-group mb-3 mt-4">
                                <label>موبایل</label>
                                <input type="text" name="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="09123456789">
                            </div>

                            <div class="form-group mb-3 mt-4">
                                <label>موضوع</label>
                                <input type="text" name="subject" class="form-control" value="{{ old('subject') }}" placeholder="موضوع پیام را به صورت کوتاه وارد کنید">
                            </div>

                            <div class="form-group mb-3 mt-4">
                                <label>پیام / درخواست / پیشنهاد</label>
                                <textarea rows="6" name="text" class="form-control" placeholder="لطفاً پیام، درخواست یا پیشنهاد خود را با جزئیات بنویسید تا در کوتاه‌ترین زمان ممکن بررسی و پاسخ داده شود">{{ old('text') }}</textarea>
                            </div>

                            <button class="btn contact-btn w-100" type="submit">
                                ارسال پیام
                            </button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


<style>
    .contact-box{
        padding:50px;
    }

    .contact-title{
        color:#ec65e7;
        font-weight:bold;
        margin-bottom:10px;
    }

    .contact-card{
        direction: rtl;
        text-align: right;
        background:#fff;
        border-radius:20px;
        padding:30px;
        box-shadow:0 10px 30px rgba(236,101,231,.15);
        height:100%;
    }

    .contact-card label{
        display: block;
        text-align: right;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .contact-card .form-control{
        direction: rtl;
        text-align: right;
    }

    .contact-item{
        display:flex;
        align-items:flex-start;
        margin-bottom:35px;
    }

    .contact-item strong,
    .contact-item p,
    .label{
        text-align: right;
    }

    .contact-item span{
        width:70px;
        height:70px;
        border: 2px solid black;
        background:#ec65e7;
        color:#fff;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        font-size:22px;
        margin-left:15px;
    }

    .contact-item strong{
        display:block;
        margin-bottom:4px;
    }

    .contact-item p{
        margin:0;
        color:#777;
    }

    .form-control{
        border-radius:12px;
        border:1px solid #ddd;
        padding:12px;
        transition:.3s;
    }

    .form-control:focus{
        border-color:#ec65e7;
        box-shadow:0 0 10px rgba(236,101,231,.25);
    }

    .contact-btn{
        background-color: #ec65e7 !important;
        color: #fff !important;
        border-radius:12px;
        padding:12px;
        font-weight:bold;
        transition:.3s;
    }

    .contact-btn:hover{
        background:#777777;
        color:#fff;
        transform:translateY(-3px);
    }

    @media(max-width:768px){
        .contact-box{

            padding:20px;
        }
    }
</style>
