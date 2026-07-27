@extends('admin.layouts.master')



@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">نام رنگ</th>
                            <th class="text-center align-middle text-primary">کد رنگ</th>
                            <th class="text-center align-middle text-primary">نمایش رنگ</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($colors as $index => $color)
                        <tr>
                            <td class="text-center align-middle">{{ $colors->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{$color->title}}</td>
                            <td class="text-center align-middle">{{$color->color}}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-lg btn-rounded" style="background-color: {{$color->color}}"></button>
                            </td>
                            <td class="text-center align-middle">
                                <a href="{{route('colors.edit',$color->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>
                                <form action="{{ route('colors.destroy', $color->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($color->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $colors->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
