<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت نام</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Vazirmatn:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: "Vazirmatn", sans-serif;
        }
        body{
            margin:0;
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
            background:linear-gradient(135deg,#ec65e7,#c542c0,#7b2cbf);
            overflow-x:hidden;
        }
        body::before,
        body::after{
            content:"";
            position:absolute;
            border-radius:50%;
            filter:blur(80px);
            opacity:.35;
        }

        body::before{
            width:350px;
            height:350px;
            background:#fff;
            top:-120px;
            right:-100px;
        }

        body::after{
            width:250px;
            height:250px;
            background:#ffd6ff;
            left:-70px;
            bottom:-70px;
        }

        .register-card{
            width:100%;
            height: auto;
            max-width:470px;
            background:rgba(255,255,255,.18);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,.25);
            border-radius:25px;
            padding:10px;
            color:#fff;
            box-shadow:0 20px 60px rgba(0,0,0,.25);
            animation:show .8s;
        }

        @keyframes show{
            from{
                opacity:0;
                transform:translateY(25px);
            }
            to{
                opacity:1;
                transform:translateY(0);
            }
        }

        .logo{
            width:90px;
            height:90px;
            margin:auto;
            border-radius:50%;
            background:#fff;
            color:#ec65e7;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:42px;
            font-weight:bold;
            margin-bottom:20px;
        }

        h5{
            text-align:center;
            font-weight:700;
        }

        .subtitle{
            text-align:center;
            margin-bottom:30px;
            opacity:.85;
        }

        label{
            margin-bottom:8px;
            font-weight:500;
        }

        .form-control{
            height:52px;
            border:none;
            border-radius:15px;
            background:rgba(255,255,255,.15);
            color:#fff;
        }

        .form-control::placeholder{
            color:rgba(255,255,255,.75);
        }

        .form-control:focus{
            background:rgba(255,255,255,.2);
            color:#fff;
            box-shadow:0 0 0 .25rem rgba(236,101,231,.25);
        }

        .btn-register{
            width:100%;
            height:52px;
            border:none;
            border-radius:15px;
            background:#fff;
            color:#ec65e7;
            font-weight:bold;
            transition:.3s;
        }

        .btn-register:hover{
            transform:translateY(-3px);
            box-shadow:0 10px 25px rgba(255,255,255,.35);
            color:#ec65e7;
        }

        a{
            color:#fff;
            text-decoration:none;
        }

        a:hover{
            color:#ffe9ff;
        }

        .footer{
            text-align:center;
            margin-top:25px;
        }

        .alert{
            border:none;
            border-radius:12px;
        }

        @media(max-width:576px){
            .register-card{
                margin:20px;
                padding:30px 25px;
            }
        }


        /* model */
        .keyboard-modal{
            border:none;
            border-radius:28px;
            overflow:hidden;
            background:#fff;
            box-shadow:0 20px 60px rgba(236,101,231,.25);
        }

        .keyboard-modal::before{
            content:"";
            display:block;
            background:linear-gradient(90deg,#ff79c6,#ec65e7,#c542c0);
        }

        .keyboard-icon{
            width:90px;
            height:90px;
            margin:auto;
            border-radius:50%;
            background:linear-gradient(135deg,#ffd6f5,#ff8fd8);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:42px;
            box-shadow:0 12px 30px rgba(236,101,231,.35);
        }

        .english-text{
            color:#d63384;
            font-weight:800;
            letter-spacing:2px;
        }

        .btn-pink{
            background:linear-gradient(135deg,#ff5db1,#ec65e7);
            color:#fff;
            border:none;
            font-weight:600;
            transition:.3s;
            box-shadow:0 10px 25px rgba(236,101,231,.35);
        }

        .btn-pink:hover{
            color:#fff;
            transform:translateY(-3px) scale(1.03);
            box-shadow:0 18px 35px rgba(236,101,231,.45);
        }

        .modal-body{
            position:relative;
        }

        .modal-body::before{
            content:"";
            position:absolute;
            width:180px;
            height:180px;
            background:#ffd6f5;
            border-radius:50%;
            top:-80px;
            left:-80px;
            opacity:.35;
        }

        .modal-body::after{
            content:"";
            position:absolute;
            width:120px;
            height:120px;
            background:#ffc2e8;
            border-radius:50%;
            bottom:-50px;
            right:-50px;
            opacity:.35;
        }

        .modal-body>*{
            position:relative;
            z-index:2;
        }
    </style>

</head>

<body>

<div class="register-card my-3">

    <div class="logo">
        <img src="{{asset('home/images/register.png')}}" class="w-75">
    </div>

    <h5>ایجاد حساب کاربری</h5>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('register_post') }}" method="POST">
        @csrf

        <div class="">
            <label>نام</label>
            <input
                type="text"
                name="name"
                class="form-control"
                value="{{ old('name') }}"
                >
        </div>

        <div class="">
            <label>نام خانوادگی</label>
            <input
                type="text"
                name="user_name"
                class="form-control"
                value="{{ old('user_name') }}"
                >
        </div>

        <div class="">
            <label>شماره موبایل</label>
            <input
                type="text"
                name="mobile"
                class="form-control"
                placeholder="*********09"
                value="{{ old('mobile') }}"
                >
        </div>

        <div class="">
            <label>رمز عبور</label>
            <input
                type="password"
                name="password"
                class="form-control"
                placeholder="********"
                >
        </div>

        <div class="">
            <label>تکرار رمز عبور</label>
            <input
                type="password"
                name="password_confirmation"
                class="form-control"
                placeholder="********"
                >
        </div>
        <button class="btn btn-register my-3">
            ثبت نام
        </button>
    </form>

    <div class="footer my-3">
        قبلاً ثبت نام کرده‌اید؟
        <a href="{{ route('login') }}">
            ورود به حساب
        </a>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="keyboardModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content keyboard-modal">

            <div class="modal-body text-center p-5">
                <div class="keyboard-icon mb-4">
                    ⌨️
                </div>
                <p class="text-secondary fs-5 mb-2">
                    لطفاً زبان کیبورد خود را روی
                </p>
                <h2 class="english-text mb-3">
                    English (EN)
                </h2>
                <p class="text-muted mb-4">
                    برای وارد کردن ایمیل و رمز عبور، از صفحه‌کلید انگلیسی استفاده کنید.
                </p>
                <button class="btn btn-pink px-5 py-3 rounded-pill bg-info"
                        data-bs-dismiss="modal">
                    متوجه شدم ✨
                </button>
            </div>

        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    window.addEventListener('load', function () {
        const modal = new bootstrap.Modal(document.getElementById('keyboardModal'));
        modal.show();
    });
</script>


</body>
</html>

