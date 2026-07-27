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
                            <th class="text-center align-middle text-primary">نام اسلایدر</th>
                            <th class="text-center align-middle text-primary">آدرس</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center align-middle">
                                <img src="{{asset('admin/slider/'.$slider->photo)}}" class="rounded-circle" alt="not exist" style="width: 130px; height: 115px">
                            </td>
                            <td class="text-center align-middle">{{$slider->title}}</td>
                            <td class="text-center align-middle">{{$slider->url}}</td>
                            <td class="text-center align-middle">{{\Hekmatinasser\Verta\Facades\Verta::format('Y/m/d')}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
