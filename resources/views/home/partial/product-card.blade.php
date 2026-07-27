<div class="{{ $col ?? 'col-lg-3 col-md-6' }} mb-4">
    <div class="product-card">

        <img class="product-image"
             src="{{ asset('admin/product/'.$product->photo) }}"
             onerror="this.src='{{ asset('home/images/no-image1.jpg') }}'"
             alt="{{ $product->title_fa }}">


        <div class="product-body">

            <h6 class="d-flex justify-content-center">
                {{ $product->title_fa }}
            </h6>

            <div class="rating my-2">
                @php
                    $rating = $product->average_rate;
                @endphp
                @for($i=1;$i<=5;$i++)
                    @if($rating >= $i)
                        <i class="fas fa-star text-warning"></i>
                    @elseif($rating >= $i-0.5)
                        <i class="fas fa-star-half-alt text-warning"></i>
                    @else
                        <i class="far fa-star text-warning"></i>
                    @endif
                @endfor
            </div>

            @if($product->discount)
                <del>
                    {{ number_format($product->price) }} تومان
                </del>
                <span class="discount-badge bg-danger rounded-circle p-1 text-white">
                    {{ $product->discount_percent }}%
                </span>
            @endif

            <div class="price my-1">
                {{ number_format($product->price-$product->discount) }}
                تومان
            </div>

            <a href="{{ route('product_details',$product->id) }}"
               class="btn btn-outline-primary btn-block mt-3">

                @if($product->count)
                    مشاهده محصول
                @else
                    ناموجود
                @endif
            </a>
        </div>
    </div>
</div>



<style>
    .placeholder-image{
        width:100%;
        height:260px;
        background:linear-gradient(135deg,#f8f9fa,#e9ecef);
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        color:#6c757d;
        border-radius:12px;
    }

    .placeholder-image i{
        font-size:60px;
        margin-bottom:12px;
        color:#adb5bd;
    }

    .placeholder-image span{
        font-size:15px;
        font-weight:500;
    }
</style>
