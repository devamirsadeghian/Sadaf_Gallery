@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">نام</th>
                            <th class="text-center align-middle text-primary">نام خانوادگی</th>
                            <th class="text-center align-middle text-primary">ایمیل</th>
                            <th class="text-center align-middle text-primary">موبایل</th>
                            <th class="text-center align-middle text-primary">نقش های کاربر</th>
                            <th class="text-center align-middle text-primary"> وضعیت</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center align-middle">
                                <img src="{{asset('admin/user/'.$user->photo)}}" class="rounded-circle" alt="not exist" style="width: 130px; height: 115px">
                            </td>
                            <td class="text-center align-middle">{{$user->name}}</td>
                            <td class="text-center align-middle">{{$user->user_name}}</td>
                            <td class="text-center align-middle">{{$user->email}}</td>
                            <td class="text-center align-middle">{{$user->mobile}}</td>
                            <td class="text-center align-middle">
{{--                                <a class="btn btn-outline-info" href="{{route('create.user.roles',$user->id)}}">--}}
{{--                                    نقش های کاربر--}}
{{--                                </a>--}}
                            </td>
                            <td class="text-center align-middle">
                                @if($user->status == \App\Enums\UsersStatus::active->value)
                                    <span class="cursor-pointer badge badge-success">فعال</span>
                                @else
                                    <span class="cursor-pointer badge badge-danger">غیر فعال</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">{{\Hekmatinasser\Verta\Facades\Verta::format('Y/m/d')}}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('css')

@endsection

@section('script')

@endsection
