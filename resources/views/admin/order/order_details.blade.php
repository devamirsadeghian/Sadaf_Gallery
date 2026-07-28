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
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">نام محصول</th>
                            <th class="text-center align-middle text-primary">قیمت کل</th>
                            <th class="text-center align-middle text-primary">تخفیف</th>
                            <th class="text-center align-middle text-primary">تعداد</th>
                            <th class="text-center align-middle text-primary">وضعیت پرداخت محصول</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($order_details as $index => $order_detail)
                        <tr>
                            <td class="text-center align-middle">{{ $order_details->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{$order_detail->product->title_fa}}</td>
                            <td class="text-center align-middle">{{ number_format($order_detail->price)  }}</td>
                            <td class="text-center align-middle">{{ number_format($order_detail->discount)  }}</td>
                            <td class="text-center align-middle">{{$order_detail->count}}</td>

                            <td class="text-center align-middle">
                                @if($order_detail->basket->is_ordered == \App\Enums\BasketDetailsStatus::received->value)
                                    <span class="cursor-pointer badge badge-success">تحویل داده شده</span>
                                @elseif($order_detail->basket->is_ordered == \App\Enums\BasketDetailsStatus::rejected->value)
                                    <span class="cursor-pointer badge badge-danger">مرجوع شده</span>
                                @elseif($order_detail->basket->is_ordered == \App\Enums\BasketDetailsStatus::processing->value)
                                    <span class="cursor-pointer badge badge-info">در حال پردازش</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">{{ verta($order_detail->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $order_details->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection


@section('css')

@endsection

@section('script')

@endsection
