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
                            <th class="text-center align-middle text-primary">نام فارسی</th>
                            <th class="text-center align-middle text-primary">نام انگلیسی</th>
                            <th class="text-center align-middle text-primary">موجودی</th>
                            <th class="text-center align-middle text-primary">گارانتی</th>
                            <th class="text-center align-middle text-primary">قیمت</th>
                            <th class="text-center align-middle text-primary">تخفیف</th>
                            <th class="text-center align-middle text-primary"> محصول ویژه</th>
                            <th class="text-center align-middle text-primary"> تاریخ اعتبار محصول ویژه</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                            <th class="text-center align-middle text-primary">تاریخ آپدیت</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $index => $product)
                        <tr>
                            <td class="text-center align-middle">{{ $products->firstItem() + $index }}</td>
                            <td class="text-center">
                                <img src="{{asset('admin/product/'.$product->photo)}}" class="rounded-circle" alt="not exist" style="width: 95px; height: 80px">
                            </td>
                            <td class="text-center align-middle">{{$product->title_fa}}</td>
                            <td class="text-center align-middle">{{$product->title_en}}</td>
                            <td class="text-center align-middle">{{$product->count}}</td>
                            <td class="text-center align-middle">{{$product->guaranty}}</td>
                            <td class="text-center align-middle">{{ number_format($product->price) }}</td>
                            <td class="text-center align-middle">{{ number_format($product->discount) }}</td>
                            <td class="text-center align-middle">{{$product->is_special == true ? '+' : '-'}}</td>
                            <td class="text-center align-middle">{{ verta($product->special_expiration)->format('Y/m/d') }}</td>
                            <td class="text-center align-middle">
                                <a href="{{route('create.gallery',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="button" title="افزودن عکس">
                                    <i class="fa far fa-image" style="font-size:24px;"></i>
                                </a>
                                <a href="{{route('index.gallery',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="button" title="گالری محصول">
                                    <i class="fa far fa-folder-open" style="font-size:24px;"></i>
                                </a>
                                <a href="{{route('products.edit',$product->id)}}" data-bs-toggle="tooltip" data-bs-placement="button" title="ویرایش">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash" style="font-size:24px;" data-bs-toggle="tooltip" data-bs-placement="button" title="حذف"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{\Hekmatinasser\Verta\Facades\Verta::format('Y/m/d',$product->created_at)}}</td>
                            <td class="text-center align-middle">{{\Hekmatinasser\Verta\Facades\Verta::format('Y/m/d',$product->updated_at)}}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $products->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection



@section('script')
    <script>
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>
@endsection
