<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<header class="header">
    <div class="container">

        <nav class="navbar navbar-expand-lg p-0">

            <!-- لوگو -->
            <a class="navbar-brand m-0" href="/">
                <img src="{{ asset('home/images/logo.png') }}" class="logo">
            </a>

            <button class="navbar-toggler bg-white"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarMenu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMenu">

                <!-- منو -->
                <ul class="navbar-nav mx-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">خانه</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('shop') }}">محصولات</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">مقالات</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">
                            <i class="fa fa-phone ml-1"></i>
                            تماس با ما
                        </a>
                    </li>
                </ul>

                <a href="{{ route('basket.index') }}" class="cart-btn position-relative">
                    <i class="fa-solid fa-cart-shopping"></i>
{{--                    @if($basketCount>0)--}}
{{--                        <span class="cart-badge">--}}
{{--                            {{ $basketCount }}--}}
{{--                        </span>--}}
{{--                    @endif--}}
                </a>

                <div class="d-flex align-items-center">

                    <!-- شبکه های اجتماعی -->

                    <div class="social-links">

                        <a href="#">
                            <img src="{{ asset('home/images/icons/instagram.png') }}">
                        </a>

                        <a href="#">
                            <img src="{{ asset('home/images/icons/telegram.png') }}">
                        </a>

                        <a href="#">
                            <img src="{{ asset('home/images/icons/eitaa.png') }}">
                        </a>

                        <a href="#">
                            <img src="{{ asset('home/images/icons/rubika.png') }}">
                        </a>

                    </div>

                    @auth

                        <div class="dropdown me-3">

                            <button class="btn profile-btn dropdown-toggle"
                                    data-bs-toggle="dropdown">

                                <i class="fa-solid fa-circle-user ms-2"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end">

                                <li>
                                    <a class="dropdown-item"
                                       href="{{ route('profile.index',auth()->id()) }}">
                                        تکمیل حساب کاربری
                                    </a>
                                </li>


                                <li><hr class="dropdown-divider"></li>

                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button class="dropdown-item text-danger">
                                            خروج
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>

                    @endauth

                    @guest()
                        <div class="auth-box">
                            <a class="auth-link" href="{{ route('login') }}">ورود</a>
                            <span class="divider">|</span>
                            <a class="auth-link" href="{{ route('register') }}">ثبت‌نام</a>
                        </div>
                    @endguest
                </div>
            </div>
        </nav>
    </div>
</header>

<style>
    .header-link{
        text-decoration: none;
    }

    .header-link:hover{
        text-decoration: none;
        color: #fff6b0;
    }

    .header{

        background:linear-gradient(90deg,#ec65e7,#d43ccf);

        box-shadow:0 8px 20px rgba(0,0,0,.08);

        padding:8px 0;

    }

    .logo{
        height:70px;
        border-radius: 50%;
    }

    .nav-link{

        color:white !important;

        font-weight:600;

        margin:0 10px;

        transition:.3s;

    }

    .nav-link:hover{

        color:#fff6b0 !important;

    }


    .mian-head{
        min-height:80px;
        padding:10px 0;
    }


    .profile-btn {
        background:#fff;
        color:#ec65e7;
        border:none;
        border-radius:30px;
        font-weight:600;
        padding:8px 18px;
    }



    .profile-btn:hover,
    .profile-btn:focus {
        border-color: #d94dd4;
        background:#fdf0fd;
        color:#c53fc0;
    }

    .dropdown-menu {
        border: 1px solid #ec65e7;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(236, 101, 231, 0.2);
    }

    .dropdown-item:hover {
        background-color: #fdf0fd;
        color: #ec65e7;
    }

    .dropdown-item.text-danger:hover {
        background-color: #ffeaea;
    }


    /* social-media */
    .social-links{
        display:flex;
        gap:12px;
        align-items:center;
        margin-right:20px;
    }

    .social-links a{
        width:42px;
        height:42px;
        background:white;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        transition:.3s;
        margin-left: 5px;
    }

    .social-links a:hover{
        transform:translateY(-4px);
        box-shadow:0 8px 20px rgba(0,0,0,.18);
    }

    .social-links img{
        width:22px;
    }


    .profile-btn{

        background:white;

        color:#ec65e7;

        border:none;

        border-radius:25px;

        font-weight:bold;

        padding:8px 18px;

    }

    .profile-btn:hover{

        background:#fff4ff;

        color:#d43ccf;

    }

    .dropdown-menu{

        border-radius:15px;

        border:none;

        box-shadow:0 10px 30px rgba(0,0,0,.15);

    }

    .cart-btn{

        width:45px;
        height:45px;

        background:white;

        color:#ec65e7;

        border-radius:50%;

        display:flex;

        align-items:center;

        justify-content:center;

        text-decoration:none;

        position:relative;

        transition:.3s;

        margin-left:15px;

    }

    .cart-btn:hover{

        background:#fff2ff;

        color:#d741d2;

        transform:translateY(-3px);

    }

    .cart-btn i{

        font-size:20px;

    }

    .cart-badge{

        position:absolute;

        top:-5px;

        right:-4px;

        width:20px;

        height:20px;

        border-radius:50%;

        background:red;

        color:white;

        font-size:11px;

        display:flex;

        justify-content:center;

        align-items:center;

        font-weight:bold;

    }


    /*login & register*/
    .auth-box {
        margin-right: 15px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 10px;
        border: 1px solid rgba(255,255,255,.4);
        border-radius: 50px;
        background: rgba(255,255,255,.08);
        backdrop-filter: blur(8px);
        transition: all .3s ease;
    }

    .auth-box:hover {
        border-color: #fff;
        background: rgba(255,255,255,.15);
    }

    .auth-link {
        color: #fff;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color .3s ease;
    }

    .auth-link:hover {
        color: #ffc107; /* زرد Bootstrap */
    }

    .divider {
        color: rgba(255,255,255,.5);
    }
</style>


<script>
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    [...tooltipTriggerList].map(el => new bootstrap.Tooltip(el));
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
