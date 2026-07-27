@extends('admin.layouts.master')


@section('content')
    <main class="">
        <div class="row">
            @if(Session::has('message'))
                <div class="alert alert-info">
                    <div>{{session('message')}}</div>
                </div>
            @endif
        </div>
{{--        @include('admin.layouts.errors')--}}
        <div class="card">
            <div class="card-body">
                <div class="container">
                    <h6 class="card-title justify-content-center text-center">مشخصات کاربر</h6>
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">نام</th>
                            <th class="text-center align-middle text-primary">نام خانوادگی</th>
                            <th class="text-center align-middle text-primary">موبایل</th>
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
                            <td class="text-center align-middle">{{$user->mobile}}</td>
                            <td class="text-center align-middle">{{ verta($role->created_at)->format('Y/m/d') }}</td>
                        </tr>

                    </table>
                    <br>
                    <br>
                    <h6 class="card-title justify-content-center text-center">اتصال کاربر به نقش</h6>
                    <form role="form" method="POST" action="{{route('store.user.roles', $user->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 offset-3">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        @foreach($roles as $role)
                                        <div class="form-check  d-flex align-items-center">
                                            <input type="checkbox"
                                                   @if($user->hasRole($role->name))
                                                       checked
                                                   @endif
                                                   class="form-check-input" id="exampleCheck1" name="roles[]" value="{{$role->name}}">
                                            <a class="list-group-item list-group-item-action mt-2" for="exampleCheck1" data-toggle="list" href="#" role="tab">{{$role->name}}</a>
                                        </div>
                                        @endforeach
                                        <button name="submit" type="submit" class="btn btn-success mt-4 w-25  justify-content-center align-items-center text-center">ذخیره</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
            </div>
        </div>
    </main>

@endsection
