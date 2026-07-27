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
                            <th class="text-center align-middle text-primary">نام دسته بندی</th>
                            <th class="text-center align-middle text-primary">دسته پدر</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $index => $category)
                        <tr>
                            <td class="text-center align-middle">{{ $categories->firstItem() + $index }}</td>
                            <td class="text-center align-middle">
                                <img src="{{asset('admin/category/'.$category->photo)}}" class="rounded-circle" alt="not exist" style="width: 80px; height: 65px">
                            </td>
                            <td class="text-center align-middle">{{$category->title}}</td>
                            <td class="text-center align-middle">{{($category->parent_id == 0 ? "----" : $category->parent->title )}}</td>
                            <td class="text-center align-middle">
                                <a href="{{route('categories.show',$category->id)}}">
                                    <i class="fa fa-eye mx-1" style="font-size:24px"></i>
                                </a>
                                <a href="{{route('categories.edit',$category->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>

                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash"" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($category->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $categories->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection
