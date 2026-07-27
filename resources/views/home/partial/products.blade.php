<div class="products-header mb-4 d-block">
    <span>
        {{ $products->total() }} محصول یافت شد
    </span>
</div>

<div class="row" id="productsContainer">
    @if($products)
        @foreach($products as $product)
            @include('home.partial.product-card')
      @endforeach
    @endif
</div>


<div id="paginationContainer">
    @include('home.partial.pagination')
</div>


<style>
    /*------------------------------*/
    /* Custom Pagination */
    /*------------------------------*/

    .custom-pagination{
        margin-top:45px;
        display:flex;
        justify-content:center;
        align-items:center;
        gap:10px;
        flex-wrap:wrap;
    }

    .page-number{
        width:42px;
        height:42px;
        border-radius:50%;
        display:flex;
        justify-content:center;
        align-items:center;
        background:white;
        color:#666;
        text-decoration:none;
        font-weight:bold;
        box-shadow:0 6px 15px rgba(0,0,0,.08);
        transition:.25s;
    }

    .page-number:hover{
        background:#ec65e7;
        color:white;
        transform:translateY(-3px);
    }

    .page-number.active{
        background:#ec65e7;
        color:white;
    }

    .page-btn{
        padding:10px 20px;
        border-radius:30px;
        background:white;
        color:#666;
        text-decoration:none;
        font-weight:bold;
        box-shadow:0 6px 15px rgba(0,0,0,.08);
        transition:.25s;
    }

    .page-btn:hover{
        background:#ec65e7;
        color:white;
        transform:translateY(-3px);
    }

    .page-btn.disabled{
        opacity:.45;
        pointer-events:none;
    }
</style>
