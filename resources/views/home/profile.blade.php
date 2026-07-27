<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تکمیل حساب کاربری</title>
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
            overflow-y:auto;
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

        .container{
            min-height:100vh;
            display:flex;
            justify-content:center;
            align-items:center;
        }

        .login-card{
            width:100%;
            max-width:500px;
            background:rgba(255,255,255,.16);
            backdrop-filter:blur(22px);
            border:1px solid rgba(255,255,255,.25);
            border-radius:30px;
            padding:45px;
            color:#fff;
            /* وسط‌چین فرم */
            display:flex;
            flex-direction:column;
            align-items:center;
            justify-content:center;
            box-shadow: 0 15px 40px rgba(0,0,0,.25), inset 0 0 0 1px rgba(255,255,255,.05);
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

        h2{
            text-align:center;
            font-weight:700;
            margin-bottom:30px;
            letter-spacing:.5px;
        }

        label{
            margin-bottom:8px;
            font-size:14px;
            font-weight:600;
            color:#f8f8f8;
        }

        .form-control{
            height:56px;
            border-radius:16px;
            border:1px solid rgba(255,255,255,.2);
            background:rgba(255,255,255,.08);
            color:#fff;
            transition:.35s;
        }

        .form-control::placeholder{
            color:rgba(255,255,255,.65);
        }

        .form-control:focus{
            color:#fff;
            background:rgba(255,255,255,.18);
            border-color:#fff;
            transform:translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,.15), 0 0 0 4px rgba(255,255,255,.15);
        }

        .form-check-input{
            background:transparent;
            border:1px solid #fff;
        }

        .form-check-input:checked{
            background:#fff;
            border-color:#fff;
        }

        .btn-login{
            width:100%;
            border:none;
            height:56px;
            border-radius:16px;
            background:#fff;
            color:#7b2cbf;
            font-weight:700;
            font-size:17px;
            transition:.35s;

        }

        .btn-login:hover{
            transform:translateY(-4px);
            background:#f8f8f8;
            color:#5a189a;
            box-shadow:0 15px 35px rgba(255,255,255,.3);
        }

        .btn-login:active{
            transform:scale(.98);
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
            border-radius:15px;
            backdrop-filter:blur(10px);
            border:none;
        }

        .input-group-text{
            background:rgba(255,255,255,.12);
            border:1px solid rgba(255,255,255,.2);
            color:#fff;
            border-radius:16px 0 0 16px;
        }

        .input-group .form-control{
            border-radius:0 16px 16px 0;
        }

        img{
           width: 120px;
           height: 120px;
        }

        @keyframes show{

            0%{
                opacity:0;
                transform:translateY(40px) scale(.95);
            }

            100%{
                opacity:1;
                transform:translateY(0) scale(1);
            }
        }

        @media(max-width:576px){
            .login-card{
                margin:20px;
                padding:30px 25px;
            }
        }
    </style>
</head>
<body>

<div class="container my-5">
    <div class="login-card">

        <h2>تکمیل مشخصات کاربر</h2>
        <div class="text-center">
            <img src="{{asset('admin/user/'.$user->photo)}}" class="rounded-circle mb-3" alt="not_exist">
        </div>

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

        <form action="{{ route('profile.update', auth()->id() ) }}" class="w-100" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label>نام</label>
                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name', $user->name) }}"
                >
            </div>
            <div class="mb-3">
                <label>نام خانوادگی</label>
                <input
                    type="text"
                    name="user_name"
                    class="form-control"
                    value="{{ old('user_name', $user->user_name) }}"
                >
            </div>

            <div class="mb-3">
                <label>موبایل</label>
                <input
                    type="text"
                    name="mobile"
                    class="form-control"
                    value="{{ old('mobile', $user->mobile) }}"
                >
            </div>
            <div class="mb-3">
                <label>تلفن</label>
                <input
                    type="text"
                    name="phone"
                    class="form-control"
                    value="{{ old('phone', $user->phone) }}"
                >
            </div>
            <div class="mb-3">
                <label>رمز</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="در صورت عدم تغییر خالی بگذارید">
            </div>

            <div class="">
                <label>تکرار رمز عبور</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="form-control"
                    placeholder="تکرار رمز"
                    >
            </div>

            <div class="mb-3">
                <label>انتخاب پروفایل کاربر</label>
                <input
                    type="file"
                    name="photo"
                    class="form-control"
                    value="{{old('photo')}}"
                    placeholder=""
                    id="file">
            </div>

            <button type="submit" class="btn btn-login mt-3">
                ذخیره تغییرات
            </button>
        </form>
    </div>
</div>

</body>
