<script>
    document.addEventListener('DOMContentLoaded', () => {

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            iconColor: '#ec65e7',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            background: 'rgba(255,255,255,.95)',
            color: '#333',
            customClass: {
                popup: 'custom-toast'
            },
            showClass: {
                popup: 'animate__animated animate__fadeInRight'
            },
            hideClass: {
                popup: 'animate__animated animate__fadeOutRight'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer);
                toast.addEventListener('mouseleave', Swal.resumeTimer);
            }
        }); // ← اینجا باید بسته شود

        @if(session()->has('success'))
        Toast.fire({
            icon: 'success',
            title: @json(session('success'))
        });
        @endif

        @if(session()->has('error'))
        Toast.fire({
            icon: 'error',
            title: @json(session('error'))
        });
        @endif

        @if(session()->has('warning'))
        Toast.fire({
            icon: 'warning',
            title: @json(session('warning'))
        });
        @endif

        @if(session()->has('info'))
        Toast.fire({
            icon: 'info',
            title: @json(session('info'))
        });
        @endif

    });
</script>



<style>
    .custom-toast{
        border-radius:16px !important;
        border-right:5px solid #ec65e7 !important;
        backdrop-filter:blur(12px);
        box-shadow:
            0 12px 35px rgba(0,0,0,.12),
            0 5px 15px rgba(236,101,231,.18) !important;
        padding:.9rem 1rem !important;
    }

    .custom-toast .swal2-title{
        font-size:15px !important;
        font-weight:600 !important;
        color:#444 !important;
    }

    .custom-toast .swal2-timer-progress-bar{
        background:#ec65e7 !important;
    }

    .custom-toast .swal2-icon{
        border:none !important;
        transform:scale(.85);
    }

    .custom-toast:hover{
        transform:translateY(-3px);
        transition:.25s;
    }
</style>
