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
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">نام</th>
                            <th class="text-center align-middle text-primary">نام خانوادگی</th>
                            <th class="text-center align-middle text-primary">موبایل</th>
                            <th class="text-center align-middle text-primary">نقش های کاربر</th>
                            <th class="text-center align-middle text-primary"> کاربر ادمین است</th>
                            <th class="text-center align-middle text-primary"> وضعیت</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td class="text-center align-middle">{{ $users->firstItem() + $index }}</td>
                            <td class="text-center align-middle">
                                <img src="{{asset('admin/user/'.$user->photo)}}" class="rounded-circle" alt="not exist" style="width: 80px; height: 65px">
                            </td>
                            <td class="text-center align-middle">{{$user->name}}</td>
                            <td class="text-center align-middle">{{$user->user_name}}</td>
                            <td class="text-center align-middle">{{$user->mobile}}</td>
                            <td class="text-center align-middle">
                                <a class="btn btn-outline-info" href="{{route('create.user.roles',$user->id)}}">
                                    نقش های کاربر
                                </a>
                            </td>
                            <td class="text-center align-middle">
                                @if($user->	is_admin == 1)
                                    <span class="cursor-pointer badge badge-success">بله</span>
                                @else
                                    <span class="cursor-pointer badge badge-danger">خیر</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                @if($user->status == \App\Enums\UsersStatus::active->value)
                                    <span class="cursor-pointer badge badge-success">فعال</span>
                                @else
                                    <span class="cursor-pointer badge badge-danger">غیر فعال</span>
                                @endif
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('users.show',$user->id)}}">
                                    <i class="fa fa-eye mx-1" style="font-size:24px"></i>
                                </a>
                                <a href="{{route('users.edit',$user->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>

                                <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash"" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($user->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $users->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
