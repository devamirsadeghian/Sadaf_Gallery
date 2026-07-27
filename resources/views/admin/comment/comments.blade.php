@extends('admin.layouts.master')

@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">
                {{-- User Comment --}}
                <label> کامنت کاربران</label>
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">کاربر</th>
                            <th class="text-center align-middle text-primary">محصول</th>
                            <th class="text-center align-middle text-primary">متن کامنت کاربر</th>
                            <th class="text-center align-middle text-primary">امتیاز</th>
                            <th class="text-center align-middle text-primary">وضعیت</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userComments as $index => $userComment)
                        <tr>
                            <td class="text-center align-middle">{{ $userComments->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{$userComment->user->name . $userComment->user->user_name}}</td>
                            <td class="text-center align-middle">{{$userComment->product?->title_fa}}</td>
                            <td class="text-center align-middle">{{$userComment->body}}</td>
                            <td class="text-center align-middle">{{$userComment->rate}}</td>
                            <td class="text-center align-middle">{{$userComment->status}}</td>
                            <td class="text-center align-middle d-flex justify-content-center">
                                <a href="{{route('comment.show',$userComment->id)}}">
                                    <i class="fa fa-eye mx-2 mt-1" style="font-size:24px"></i>
                                </a>
                                <form action="{{ route('comment.accept', $userComment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success mx-1">
                                        تایید
                                    </button>
                                </form>
                                <form action="{{ route('comment.reject', $userComment->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-warning mx-1">
                                        رد
                                    </button>
                                </form>
                                <form action="{{ route('comment.destroy', $userComment->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این نظر مطمئن هستید؟')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mx-1">
                                        حذف
                                    </button>
                                </form>

                            </td>
                            <td class="text-center align-middle">{{ verta($userComment->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $userComments->links('admin.partial.pagination') }}
                    </div>

                </div>

                <hr>
                <hr>


                {{-- Admin Comment --}}
                <label> کامنت ادمین</label>
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">کاربر</th>
                            <th class="text-center align-middle text-primary">محصول</th>
                            <th class="text-center align-middle text-primary">متن کامنت کاربر</th>
                            <th class="text-center align-middle text-primary">امتیاز</th>
                            <th class="text-center align-middle text-primary">وضعیت</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($adminComments as $index => $adminComment)
                            <tr>
                                <td class="text-center align-middle">{{ $adminComments->firstItem() + $index }}</td>
                                <td class="text-center align-middle">{{$adminComment->user->name . $adminComment->user->user_name}}</td>
                                <td class="text-center align-middle">{{$adminComment->product->title_fa}}</td>
                                <td class="text-center align-middle">{{$adminComment->body}}</td>
                                <td class="text-center align-middle">{{$adminComment->rate ?? 'ــــــــــ'}}</td>
                                <td class="text-center align-middle">{{$adminComment->status}}</td>
                                <td class="text-center align-middle d-flex justify-content-center">
                                    <a href="{{route('comment.show',$adminComment->id)}}">
                                        <i class="fa fa-eye mx-2 mt-1" style="font-size:24px"></i>
                                    </a>
                                    <form action="{{ route('comment.destroy', $adminComment->id) }}" method="POST" onsubmit="return confirm('آیا از حذف این نظر مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger mx-1">
                                            حذف
                                        </button>
                                    </form>

                                </td>
                                <td class="text-center align-middle">{{ verta($adminComment->created_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach

                    </table>
                    <div style="margin: 40px !important;"
                         class="pagination pagination-rounded pagination-sm d-flex justify-content-center">
                    </div>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $adminComments->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
