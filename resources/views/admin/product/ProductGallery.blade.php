@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">عکس محصول</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($images as $index => $image)
                            <tr>
                                <td class="text-center align-middle">
                                    <img src="{{asset('admin/gallery/'.$image->photo)}}" class="rounded-circle" alt="not exist" style="width: 80px; height: 65px">
                                </td>
                                <td class="text-center align-middle">
                                    <a href="{{route('delete.gallery',$image->id)}}">
                                        <i class="fa fa-trash-o" style="font-size:24px;"></i>
                                    </a>
                                </td>
                                <td class="text-center align-middle">{{ verta($image->created_at)->format('Y/m/d') }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </main>
@endsection
