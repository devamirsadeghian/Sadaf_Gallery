@extends('home.layouts.master')


@section('title')
    محصولات
@endsection


@section('content')
    @include('home.layouts.errors')
    <div class="container my-5">

        <!-- Sort Bar -->
        <div class="sort-bar mb-4">
            <div class="d-flex align-items-center flex-wrap">

            <span class="sort-title ml-3">
                مرتب سازی :
            </span>

{{--                <a href="#" class="sort-item" data-url="newest">--}}
                <a href="#" class="sort-item" data-sort="newest">
                    جدیدترین
                </a>

{{--                <a href="#" class="sort-item" data-url="most_sold">--}}
                <a href="#" class="sort-item" data-sort="most_sold">
                    پرفروش ترین
                </a>

{{--                <a href="#" class="sort-item" data-url="most_viewed">--}}
                <a href="#" class="sort-item" data-sort="most_viewed">
                    پربازدیدترین
                </a>

{{--                <a href="#" class="sort-item" data-url="cheapest">--}}
                <a href="#" class="sort-item" data-sort="cheapest">
                    ارزان ترین
                </a>

{{--                <a href="#" class="sort-item" data-url="expensive">--}}
                <a href="#" class="sort-item" data-sort="expensive">
                    گران ترین
                </a>

{{--                <a href="#" class="sort-item" data-url="discount">--}}
                <a href="#" class="sort-item" data-sort="discount">
                    بیشترین تخفیف
                </a>

            </div>
        </div>


        <div class="row">

            <!-- Sidebar Filter -->
            <div class="col-lg-3 mb-4">
                <div class="filter-box">
                    <form id="filterForm">

                        <!--  Search  -->
                        <div class="row d-block mb-5 mx-auto">

                            <input
                                type="text"
                                id="search"
                                name="search"
                                class="form-control"
                                placeholder="نام محصول را جستجو کنید...">

                        </div>


                    <h5 class="filter-title d-flex ">
                        فیلتر محصولات
                    </h5>

                    <hr>

                    <!-- Category -->
                    <div class="filter-item" dir="ltr">

                        <div class="filter-header d-flex justify-content-end">
                            دسته بندی
                        </div>

                        <br>

                        <div class="filter-body text-end">
                            @foreach($categories as $category)
                                <div class="form-check d-flex justify-content-end align-items-center mb-2">

                                    <label class="form-check-label mx-4" for="category{{ $category->id }}">
                                        {{ $category->title }}
                                    </label>

                                    <input
                                        class="form-check-input m-0"
                                        type="checkbox"
                                        name="category[]"
                                        value="{{ $category->id }}"
                                        id="category{{ $category->id }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <hr>

                    <!-- Price -->
                    <h6 class="mt-2">
                        قیمت (تومان)
                    </h6>
                        <div class="price-filter mt-3">
                            <div id="priceSlider"></div>
                            <div class="price-range mt-4">
                                <div>
                                    حداکثر
                                    <b id="maxPriceText">
                                        {{ number_format(1000000) }}
                                    </b>
                                </div>

                                <div>
                                    حداقل
                                    <b id="minPriceText">
                                        {{ number_format(0) }}
                                    </b>
                                </div>

                            </div>

                            <input type="hidden" name="min_price" id="min_price">
                            <input type="hidden" name="max_price" id="max_price">
                            <input type="hidden" name="sort" id="sort" value="newest">

                        </div>

                    <hr>

                    <div class="custom-control custom-switch mt-4">
                        <input
                            type="checkbox"
                            name="available"
                            value="1"
                            class="custom-control-input"
                            id="available">
                        <label
                            class="custom-control-label"
                            for="available">
                            فقط کالاهای موجود
                        </label>
                    </div>

                    <div class="custom-control custom-switch mt-4">
                        <input
                            type="checkbox"
                            name="is_special"
                            value="1"
                            class="custom-control-input"
                            id="is_special">
                        <label
                            class="custom-control-label"
                            for="is_special">
                            فقط محصولات ویژه
                        </label>
                    </div>


                    <div class="mt-4">
                        <button
                            type="button"
                            class="btn filter-btn w-100 d-none">
                            اعمال فیلتر
                        </button>

                        <button
                            type="button"
                            class="btn clear-btn w-100 mt-2">
                            پاک کردن فیلترها
                        </button>

                    </div>

                    </form>
                </div>
            </div>


            <!-- Products -->
            <div class="col-lg-9">


                <!--  Products  Pagination  -->
                <div id="productsSection">
                    @include('home.partial.products')
                </div>


            </div>
        </div>
    </div>

@endsection


@section('style')
    <style>
        /*----------------------------*/
        /* Sort Bar */
        /*----------------------------*/

        .sort-bar {
            background: #fff;
            border-radius: 20px;
            padding: 18px 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
        }

        .sort-title {
            font-weight: bold;
            color: #666;
        }

        .sort-item {
            text-decoration: none;
            padding: 10px 18px;
            margin: 5px;
            border-radius: 30px;
            color: #666;
            transition: .3s;
        }

        .sort-item:hover {
            background: #ec65e7;
            color: white;
        }

        .sort-item.active {
            background: #ec65e7;
            color: white;
        }


        /*----------------------------*/
        /* Sidebar */
        /*----------------------------*/


        .filter-box {
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            position: sticky;
            top: 20px;
        }


        .rotate {
            transform: rotate(180deg);
            transition: .3s;
        }


        .filter-section {
            margin-top: 20px;
        }

        .custom-check {
            display: block;
            margin-bottom: 12px;
            cursor: pointer;
        }

        .custom-check input {
            margin: 0;
        }

        .filter-btn {
            background: #ec65e7;
            color: white;
            border-radius: 30px;
        }

        .filter-btn:hover {
            background: #d94fd2;
        }

        h6 {
            display: flex;
            justify-content: right;
        }

        /*----------------------------*/
        /* Product */
        /*----------------------------*/

        .product-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, .08);
            transition: .3s;
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 35px rgba(236, 101, 231, .25);
        }

        .product-image {
            width: 100%;
            object-fit: cover;
            position: relative;
            height: 260px;
            overflow: hidden;
        }

        .product-body {
            padding: 20px;
            text-align: center;
        }


        .discount {
            padding: 6px 10px;
            position: relative;
            overflow: hidden; /* در صورت نیاز */
            z-index: 100;
            border-radius: 20px;
            font-size: 13px;
            top: 28px;
            left: 1px;
            width: 120px;
            text-align: center;
            background: #ff4d4f;
            color: white;
            transform: rotate(-45deg);
            font-weight: bold;
        }


        /*----------------------------*/
        /* price */
        /*----------------------------*/



        .noUi-target{
            margin-top:20px;
            border:none;
            height:8px;
            background:#ececec;
            box-shadow:none;
        }

        .noUi-connect{
            background:#ec65e7 !important;
        }

        .noUi-handle{
            width:22px !important;
            height:22px !important;
            border-radius:50%;
            border:none;
            background:#ec65e7;
            box-shadow:none;
            cursor:pointer;
        }

        .noUi-handle:before,
        .noUi-handle:after{
            display:none;
        }


        .price {
            color: #ec65e7 !important;
            font-size: 22px;
            font-weight: bold;
        }

        .price-filter {
            width: 100%;
            direction: rtl;
            text-align: right;
        }

        .price-slider {
            width: 100% !important;
            cursor: pointer !important;
            accent-color: #ec65e7 !important; /* رنگ صورتی */
        }

        .price-range {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100% !important;
            font-size: 14px !important;
            color: #666 !important;
        }

        .price-range b {
            color: #ec65e7 !important;
        }


        .selected-price {
            text-align: center;
            font-size: 15px;
            font-weight: bold;
            color: #555 !important;
        }

        .selected-price span {
            color: #ec65e7;
            font-size: 18px;
        }

        .text-price {
            color: #ec65e7;
        }

        .clear-btn {
            border-radius: 50px !important;
            background: #ec65e7 !important;
        }

        .clear-btn:hover {
            background: #ececec !important;
        }


        /*=========================================
                        Pagination
        ==========================================*/

        #paginationContainer{
            margin-top:50px;
            display:flex;
            justify-content:center;
        }

        #paginationContainer nav{
            display:flex;
        }

        #paginationContainer ul{
            display:flex;
            align-items:center;
            gap:12px;
            padding:0;
            margin:0;
            list-style:none;
        }

        #paginationContainer li{
            list-style:none;
        }

        #paginationContainer .page-link{
            width:40px !important;
            height:40px !important;
            padding:0 !important;
            margin:0 !important;
            min-width:40px;
            line-height:40px;
            border-radius:50% !important;
            display:flex !important;
            justify-content:center;
            align-items:center;
            font-size:15px;
            font-weight:bold;
            background:#fff;
            color:#666;
            border:none;
            text-decoration:none;
            box-shadow:0 5px 12px rgba(0,0,0,.08);
            transition:.3s;
        }

        #paginationContainer .page-link:hover{
            background:#ec65e7;
            color:#fff;
            transform:translateY(-3px);
        }

        #paginationContainer .active .page-link{
            background:#ec65e7 !important;
            color:#fff !important;
        }

        #paginationContainer .disabled .page-link{
            background:#f5f5f5;
            color:#bfbfbf;
            cursor:not-allowed;
        }

    </style>
@endsection

@section('script')
    <script>
        // فعال شدن مرتب سازی
        $(".sort-item").click(function () {
            $(".sort-item").removeClass("active");
            $(this).addClass("active");
        });

        //////   (((((((( filter )))))))))
        //////   (((((((( filter )))))))))

        // Debounce Search
        let searchTimer;
        document.getElementById('search').addEventListener('keyup', function () {
            clearTimeout(searchTimer);
            searchTimer = setTimeout(function () {
                loadProducts(1);
            }, 1500);
        });


        // price
        const data = new FormData(document.getElementById('filterForm'));

        const slider = document.getElementById('priceSlider');

        noUiSlider.create(slider, {
            start: [0,1000000],
            connect:true,
            step:10000,
            range:{
                min:0,
                max:1000000
            }
        });


        slider.noUiSlider.on('update', function(values){

            const min=Math.round(values[0]);
            const max=Math.round(values[1]);

            document.getElementById("minPriceText").innerHTML=
                Number(min).toLocaleString('fa-IR');

            document.getElementById("maxPriceText").innerHTML=
                Number(max).toLocaleString('fa-IR');

            document.getElementById("min_price").value=min;
            document.getElementById("max_price").value=max;

        });




        // loadProducts
        function loadProducts(page=1){

            const formData = new FormData(document.getElementById('filterForm'));
            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }
            console.log(
                document.querySelectorAll('input[name="category[]"]:checked')
            );
            formData.append('page',page);

            const params = new URLSearchParams(formData);
            window.history.replaceState({}, '', '/shop?' + params.toString());

            fetch('/shop/filter?'+params.toString())

                .then(res=>res.text())
                .then(html=>{
                    document.getElementById('productsSection').innerHTML = html;
                    bindPagination();
                });
        }


        const search = new URLSearchParams(window.location.search);
        if(search.has('sort')){
            document.getElementById('sort').value = search.get('sort');
        }

        if(search.has('is_special')){
            document.getElementById('is_special').checked = true;
        }

        if(search.has('available')){
            document.getElementById('available').checked = true;
        }

        search.getAll('category[]').forEach(function(id){
            let checkbox = document.querySelector(
                'input[name="category[]"][value="'+id+'"]'
            );

            if(checkbox){
                checkbox.checked = true;
            }
        });

        if(search.has('min_price')){
            document.getElementById('min_price').value =
                search.get('min_price');
        }

        if(search.has('max_price')){
            document.getElementById('max_price').value =
                search.get('max_price');
        }


        slider.noUiSlider.set([
            search.get('min_price'),
            search.get('max_price')
        ]);


        if(window.location.search){
            loadProducts();
        }


        function bindPagination(){
            document.querySelectorAll('.custom-pagination a').forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();

                    const url = new URL(this.href);
                    const page = url.searchParams.get('page');

                    loadProducts(page);
                });
            });
        }

        bindPagination();



        document.querySelector('.filter-btn').addEventListener('click',function(e){
            e.preventDefault();
            loadProducts(1);
        });


        document.querySelector('.clear-btn').addEventListener('click',function(e){
            e.preventDefault();
            document.getElementById('filterForm').reset();
            slider.noUiSlider.set([0,1000000]);

            document.getElementById('min_price').value = 0;
            document.getElementById('max_price').value = 1000000;
            document.getElementById('sort').value='newest';

            document.querySelectorAll('.sort-item').forEach(item => {
                item.classList.remove('active');
            });

            document.querySelector('.sort-item[data-sort="newest"]').classList.add('active');

            window.history.replaceState({}, '', '/shop');

            loadProducts(1);
        });


        // Category Checkbox
        document.querySelectorAll(
            'input[name="category[]"]'
        )
            .forEach(item=>{
                item.addEventListener('change',()=>{
                    loadProducts();
                });
            });


        document.getElementById('available')
            .addEventListener('change',()=>{
                loadProducts();
            });


        document.getElementById('is_special')
            .addEventListener('change',()=>{
                loadProducts();
            });


        slider.noUiSlider.on('change',function(){
            loadProducts();
        });


        document.querySelectorAll(".sort-item").forEach(item => {
            item.addEventListener("click", function (e) {
                e.preventDefault();
                document.querySelectorAll(".sort-item")
                    .forEach(i => i.classList.remove("active"));
                this.classList.add("active");

                document.getElementById("sort").value = this.dataset.sort;
                loadProducts();
            });
        });

    </script>
@endsection
