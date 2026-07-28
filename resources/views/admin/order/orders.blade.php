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
                            <th class="text-center align-middle text-primary">خریدار</th>
                            <th class="text-center align-middle text-primary">کد پیگیری</th>
                            <th class="text-center align-middle text-primary"> وضعیت پرداخت</th>
                            <th class="text-center align-middle text-primary">لیست محصولات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $index => $order)
                        <tr>
                            <td class="text-center align-middle">{{ $orders->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{$order->user->name." ".$order->user->user_name}}</td>
                            <td class="text-center align-middle">{{$order->code}}</td>
{{--                            @dd($order->status)--}}
                            <td class="text-center align-middle">
                                @if($order->is_ordered == \App\Enums\BasketStatus::success->value)
                                    <span class="cursor-pointer badge badge-success">success</span>
                                @elseif($order->is_ordered == \App\Enums\BasketStatus::failed->value)
                                    <span class="cursor-pointer badge badge-danger">failed</span>
                                @elseif($order->is_ordered == \App\Enums\BasketStatus::draft->value)
                                    <span class="cursor-pointer badge badge-info">draft</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <a class="btn btn-outline-info" href="{{route('order_details',$order->user_id)}}">
                                    لیست محصولات
                                </a>
                            </td>
                            <td class="text-center align-middle">{{ verta($order->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $orders->links('admin.partial.pagination') }}
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
