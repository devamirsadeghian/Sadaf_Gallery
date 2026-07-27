<header class="navbar navbar-expand-lg bg-dark shadow-sm px-4 py-2">

    <!-- عنوان -->
    <div class="d-flex align-items-center">
        <h5 class="mb-0 fw-bold text-white">
            پنل مدیریت
        </h5>
    </div>

    <!-- آیکون‌ها -->
    <div class="d-flex align-items-center gap-2 ms-auto">

        <a href="{{ route('contacts.index') }}" title="پیام‌های تماس با ما">
            <button class="btn btn-light position-relative">
                <i class="fa fa-envelope"></i>

                @if($ContactMessages > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $ContactMessages }}
                    </span>
                @else
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        ✓
                    </span>
                @endif
            </button>
        </a>

        <a href="{{ route('comment.index') }}" title="نظرات در انتظار تایید">
            <button class="btn btn-light position-relative">
                <i class="fa fa-comments"></i>

                @if($CommentDraft > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        {{ $CommentDraft }}
                    </span>
                @else
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                        ✓
                    </span>
                @endif
            </button>
        </a>

    </div>
</header>

<style>
    header{
        height:70px;
        border-bottom:1px solid #eee;

    }

    header .btn{
        border-radius: 10px;
        width: 48px;
        height: 48px;
    }

    header .btn i {
        font-size: 18px;
    }

    .gap-2 {
        gap: 10px;
    }
    header img{
        object-fit:cover;
    }

    .dropdown-toggle::after{
        margin-right:8px;
    }

    .navbar{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
