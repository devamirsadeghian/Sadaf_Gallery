<footer class="footer-section">

    <div class="container py-5">

        <div class="row align-items-center">

            <!-- نمادها -->
            <div class="col-md-3 text-center mb-4 mb-md-0">
                <img src="{{ asset('home/images/namad.png') }}"
                     class="footer-logo mb-3" alt="نماد اعتماد">

                <img src="{{ asset('home/images/samandehi.png') }}"
                     class="footer-logo mb-3" alt="ساماندهی">
            </div>

            <!-- امکانات -->
            <div class="col-md-4">
                <h5 class="footer-title">چرا صدف گالری</h5>

                <ul class="footer-list">
                    <li>🚚 ارسال سریع</li>
                    <li>⭐ تضمین کیفیت</li>
                    <li>💳 پرداخت امن</li>
                    <li>📞 پشتیبانی آنلاین</li>
                    <li>🎁 تخفیف‌های ویژه</li>
                </ul>
            </div>

            <!-- امکانات دیگر -->
            <div class="col-md-5">
                <h5 class="footer-title">همراه شما هستیم</h5>

                <ul class="footer-list">
                    <li>🎧 پشتیبانی ۲۴ ساعته</li>
                    <li>💬 مشاوره رایگان</li>
                    <li>📍 ارسال به سراسر کشور</li>
                    <li>💖 تجربه خرید لذت‌بخش</li>
                    <li>🕯️ محصولات دست‌ساز و خاص</li>
                </ul>
            </div>

        </div>

    </div>

    <div class="footer-bottom">
        © تمامی حقوق این سایت متعلق به
        <strong>Sadaf Gallery</strong>
        می‌باشد.
    </div>

</footer>



<style>
    .footer-section{
        background: linear-gradient(135deg,#ec65e7,#d43ccf);
        color:#fff;
        border-radius:25px 25px 0 0;
        margin-top:70px;
        box-shadow:0 -8px 25px rgba(236,101,231,.25);
    }

    .footer-logo{
        width:120px;
        height:120px;
        object-fit:cover;
        background:#fff;
        padding:8px;
        border-radius:30%;
        box-shadow:0 5px 15px rgba(0,0,0,.15);
        transition:.3s;
    }

    .footer-logo:hover{
        transform:translateY(-6px) scale(1.05);
    }

    .footer-title{
        font-weight:bold;
        margin-bottom:20px;
        color:#fff;
        position:relative;
    }


    .footer-list{
        list-style:none;
        padding:0;
        margin:0;
    }

    .footer-list li{
        padding:10px 0;
        transition:.3s;
        font-size:15px;
    }

    .footer-list li:hover{
        transform:translateX(-8px);
        color:#fff8b5;
    }

    .footer-bottom{
        background:rgba(255,255,255,.15);
        text-align:center;
        padding:18px;
        font-size:15px;
        backdrop-filter:blur(8px);
    }
</style>

