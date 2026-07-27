@if ($products->hasPages())

    @php
        $products = $products->appends(request()->query());
    @endphp

    <nav class="custom-pagination" dir="ltr">

        {{-- قبلی --}}

        @if($products->onFirstPage())
            <span class="page-btn disabled">
            ← قبلی
            </span>
        @else
            <a class="page-btn"
               href="{{ $products->previousPageUrl() }}">
                ← قبلی
            </a>
        @endif

        {{-- شماره صفحات --}}
        @foreach($products->linkCollection() as $link)

            @continue($link['label'] == '&laquo; Previous')
            @continue($link['label'] == 'Next &raquo;')

            @if($link['active'])
                <span class="page-number active">
                    {{ $link['label'] }}
                </span>
            @else
                <a href="{{ $link['url'] }}"
                   class="page-number">
                    {{ $link['label'] }}
                </a>
            @endif
        @endforeach

        {{-- بعدی --}}
        @if($products->hasMorePages())
            <a class="page-btn"
               href="{{ $products->nextPageUrl() }}">
                بعدی →
            </a>
        @else
            <span class="page-btn disabled">
            بعدی →
            </span>

        @endif

    </nav>

@endif


<style>
    .custom-pagination{
        display:flex;
        justify-content:center;
        align-items:center;
        flex-wrap:wrap;
        gap:12px;
        margin:45px 0;
    }

    .page-number,
    .page-btn{
        user-select:none;
        font-family:inherit;
    }

    @media(max-width:768px){
        .page-btn{
            padding:8px 14px;
            font-size:14px;
        }

        .page-number{
            width:38px;
            height:38px;
        }
    }
</style>
