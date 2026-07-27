@extends('admin.layouts.master')

@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف سفارش</th>
                            <th class="text-center align-middle text-primary">خریدار</th>
                            <th class="text-center align-middle text-primary">کد پیگیری</th>
                            <th class="text-center align-middle text-primary"> وضعیت پرداخت</th>
                            <th class="text-center align-middle text-primary">لیست محصولات سفارش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($baskets as $index => $basket)
                        <tr>
                            <td class="text-center align-middle">{{ $baskets->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{ optional($basket->user)->name }}{{ optional($basket->user)->user_name }}</td>
                            <td class="text-center align-middle">{{$basket->code}}</td>
                            <td class="text-center align-middle">
                                @if($basket->status == \App\Enums\BasketStatus::success->value)
                                    <span class="cursor-pointer badge badge-success">تحویل داده شده</span>
                                @elseif($basket->status == \App\Enums\BasketStatus::failed->value)
                                    <span class="cursor-pointer badge badge-danger">مرجوع شده</span>
                                @elseif($basket->status == \App\Enums\BasketStatus::draft->value)
                                    <span class="cursor-pointer badge badge-info">در حال پردازش</span>
                                @endif
                            </td>

                            <td class="text-center align-middle">
                                <a class="btn btn-outline-info" href="{{ route('baskets_details', $basket->id) }}">
                                    <i class="fas fa-box-open"></i>
                                </a>
                            </td>
                            <td class="text-center align-middle">{{ verta($basket->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $baskets->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
