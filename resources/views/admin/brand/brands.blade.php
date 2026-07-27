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
                            <th class="text-center align-middle text-primary">نام برند</th>
                            <th class="text-center align-middle text-primary">ویرایش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($brands as $index => $brand)
                        <tr>
                            <td class="text-center align-middle">{{ $brands->firstItem() + $index }}</td>
                            <td class="text-center">
                                <img src="{{asset('admin/brand/'.$brand->photo)}}" class="rounded-circle" alt="not exist" style="width: 95px; height: 80px">
                            </td>
                            <td class="text-center align-middle">{{$brand->title}}</td>
                            <td class="text-center align-middle">
                                <a href="{{route('brands.edit',$brand->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>

                                <form action="{{ route('brands.destroy', $brand->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash"" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($brand->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $brands->links('admin.partial.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
