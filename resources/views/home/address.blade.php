<title>آدرس</title>


<div class="container">
    @include('home.layouts.errors')
        <div class="card-box">
            <div class="logo">
                <img src="{{asset('home/images/location.png')}}" class="w-75">
            </div>
            <h2>
                آدرس
            </h2>
            <form action="{{ route('address.store', auth()->id()) }}" method="POST">
                @csrf

                <div class="mb-3">

                    <label>
                        آدرس
                    </label>

                    <textarea
                        class="form-control"
                        name="address"
                        placeholder="آدرس کامل خود را وارد کنید..."
                        required>{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">

                    <label>
                        کد پستی
                    </label>
                    <input
                        type="text"
                        name="postal_code"
                        class="form-control"
                        value="{{ old('postal_code') }}"
                        placeholder=" مثال : 1234567890">
                </div>
                <button type="submit" class="btn btn-save mt-3">
                    ادامه فرآیند خرید
                </button>
            </form>
        </div>
    </div>


<style>
    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:"Vazirmatn",sans-serif;
    }

    body{
        min-height:100vh;
        margin:0;
        padding:20px;

        display:flex;
        justify-content:center;
        align-items:center;

        background:linear-gradient(135deg,#8e2de2,#c850c0,#ff6ec4);

        overflow-x:hidden;
        overflow-y:auto;

        position:relative;
    }

    /* Background Blur */

    body::before,
    body::after{
        content:"";
        position:absolute;
        border-radius:50%;
        filter:blur(90px);
        opacity:.25;
        z-index:0;
    }

    body::before{
        width:350px;
        height:350px;
        background:#fff;
        top:-120px;
        right:-120px;
    }

    body::after{
        width:250px;
        height:250px;
        background:#ffd6ff;
        left:-80px;
        bottom:-80px;
    }

    /* Card */

    .card-box{
        position:relative;
        z-index:2;
        width:500px;
        padding:40px;
        border-radius:25px;
        background:rgba(255,255,255,.15);
        backdrop-filter:blur(20px);
        border:1px solid rgba(255,255,255,.2);
        box-shadow:
            0 20px 60px rgba(0,0,0,.25),
            inset 0 1px rgba(255,255,255,.15);
        color:#fff;
        animation:show .6s ease;
    }

    @keyframes show{
        from{
            opacity:0;
            transform:translateY(20px);
        }
        to{
            opacity:1;
            transform:translateY(0);
        }
    }

    /* Logo */

    .logo{
        width:90px;
        height:90px;
        margin:0 auto 20px;
        background:#fff;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        box-shadow:0 10px 30px rgba(0,0,0,.15);

    }

    .logo img{
        width:60%;
    }

    /* Title */

    h2{
        text-align:center;
        font-size:30px;
        font-weight:700;
        margin-bottom:30px;
    }

    /* Labels */

    label{
        display:block;
        font-weight:600;
        text-align:right;
        margin:30px 0px 10px 0px;
    }

    /* Inputs */

    .form-control{
        width:100%;
        padding:14px 16px;
        min-height:52px;
        border-radius:15px;
        border:1px solid rgba(255,255,255,.2);
        background:rgba(255,255,255,.12);
        color:black;
        transition:.3s;
        text-align: right;
    }

    textarea.form-control{
        min-height:130px;
        resize:vertical;
    }

    .form-control::placeholder{
        color:rgba(255,255,255,.75);
    }

    .form-control:focus{
        background:rgba(255,255,255,.18);
        border-color:#fff;
        color:black;
        box-shadow:0 0 15px rgba(255,255,255,.2);
        outline:none;
    }

    /* Button */

    .btn-save{
        width:100%;
        height:55px;
        margin-top:10px;
        border:none;
        border-radius:15px;
        background:#fff;
        color:#c850c0;
        font-size:16px;
        font-weight:700;
        transition:.3s;
    }

    .btn-save:hover{
        transform:translateY(-2px);
        box-shadow:0 10px 25px rgba(255,255,255,.25);
    }

    /* Tablet */
    @media (max-width:768px){

        body{
            align-items:flex-start;
        }

        .card-box{
            margin:20px 0;
            padding:30px;
        }

        h2{
            font-size:26px;
        }

        .logo{
            width:80px;
            height:80px;

        }

    }

    /* Mobile */

    @media (max-width:576px){

        body{
            padding:15px;
        }

        .card-box{
            padding:20px;
            border-radius:20px;
        }

        h2{
            font-size:22px;
            margin-bottom:20px;
        }

        .logo{
            width:70px;
            height:70px;
            margin-bottom:15px;
        }

        .form-control{
            min-height:48px;
            font-size:14px;
            padding:12px 14px;
        }

        textarea.form-control{
            min-height:110px;
        }

        .btn-save{
            height:48px;
            font-size:15px;
        }

    }
</style>

