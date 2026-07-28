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
                            <th class="text-center align-middle text-primary">نام دسته بندی</th>
                            <th class="text-center align-middle text-primary">دسته پدر</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center align-middle">
                                <img src="{{asset('admin/category/'.$category->photo)}}" class="rounded-circle" alt="not exist" style="width: 130px; height: 115px">
                            </td>
                            <td class="text-center align-middle">{{$category->title}}</td>
                            <td class="text-center align-middle">{{$category->parent->title}}</td>
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
