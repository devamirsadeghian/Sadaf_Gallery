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
                            <th class="text-center align-middle text-primary">عکس</th>
                            <th class="text-center align-middle text-primary">نام اسلایدر</th>
                            <th class="text-center align-middle text-primary">ادرس</th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sliders as $index => $slider)
                        <tr>
                            <td class="text-center align-middle">{{ $sliders->firstItem() + $index }}</td>
                            <td class="text-center">
                                <img src="{{asset('admin/slider/'.$slider->photo)}}" class="rounded-circle" alt="not exist" style="width: 80px; height: 65px">
                            </td>
                            <td class="text-center align-middle">{{$slider->title}}</td>
                            <td class="text-center align-middle">{{$slider->url}}</td>
                            <td class="text-center align-middle">
                                <a href="{{route('sliders.show',$slider->id)}}">
                                    <i class="fa fa-eye mx-1" style="font-size:24px"></i>
                                </a>
                                <a href="{{route('sliders.edit',$slider->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>

                                <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($slider->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $sliders->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
