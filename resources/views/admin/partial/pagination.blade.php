@if ($paginator->hasPages())
    <nav id="paginationContainer">
        <ul class="pagination">

            {{-- Previous --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link page-nav">← قبلی</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link page-nav" href="{{ $paginator->previousPageUrl() }}">
                        ← قبلی
                    </a>
                </li>
            @endif

            {{-- Page Numbers --}}
            @foreach ($elements as $element)

                @if (is_string($element))
                    <li class="page-item disabled">
                        <span class="page-link">{{ $element }}</span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif

            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link page-nav" href="{{ $paginator->nextPageUrl() }}">
                        بعدی →
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link page-nav">بعدی →</span>
                </li>
            @endif

        </ul>
    </nav>
@endif

<style>
    #paginationContainer{
        margin-top:50px;
        display:flex;
        justify-content:center;
    }

    #paginationContainer nav{
        display:flex;

    }

    #paginationContainer ul{
        display: flex;
        flex-direction: row-reverse;
        align-items: center;
        gap: 12px;
        padding:0;
        margin:0;
        list-style:none;

    }

    #paginationContainer li{
        list-style:none;
    }

    #paginationContainer .page-link{
        width:50px !important;
        height:50px !important;
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
