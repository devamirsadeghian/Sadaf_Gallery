<div class="d-flex">

    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white" style="width:260px; min-height:100vh;">

        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('users.create')}}">ایجاد کاربر</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('users.index')}}">لیست کاربران</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('baskets')}}">لیست فروش</a></li>
{{--            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('roles.create')}}">ایجاد نقش</a></li>--}}
{{--            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('roles.index')}}">لیست نقش‌ها</a></li>--}}
            <hr>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('categories.create')}}">ایجاد دسته بندی</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('categories.index')}}">لیست دسته بندی</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('sliders.create')}}">ایجاد اسلایدر</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('sliders.index')}}">لیست اسلایدر</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('brands.create')}}">ایجاد برند</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('brands.index')}}">لیست برند</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('colors.create')}}">ایجاد رنگ</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('colors.index')}}">لیست رنگ</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('products.create')}}"> ایجاد محصولات </a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('products.index')}}">لیست محصولات</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('comment.index')}}">لیست کامنت</a></li>
            <li class="nav-item"><a class="nav-link text-white text-center" href="{{route('contacts.index')}}">لیست تماس با ما</a></li>
            <form action="{{ route('logout') }}" method="POST">
                @csrf

                <button id="btnDelete" type="submit" class="dropdown-item text-light text-center border-0">
                    <i class="fa fa-right-from-bracket"></i>
                    خروج
                </button>
            </form>
        </ul>
    </div>

</div>

<style>
    #sidebar .nav-link:hover{
        background:#0d6efd;
        border-radius:5px;
        transition: .4s;
    }

    #btnDelete{
        background-color: inherit;
        color: #fff;
        border: none;
        border-radius: 8px;
        width: 100%;
        transition: .3s;
    }

    #btnDelete:hover{
        background-color: #bb2d3b;
        transition: .4s;
    }

    #btnDelete:focus{
        outline: none;
        box-shadow: none;
    }

    hr{
        border: 1px solid white;
        width: 100% ;
    }
</style>
