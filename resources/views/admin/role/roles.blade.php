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
                            <th class="text-center align-middle text-primary">نام</th>
                            <th class="text-center align-middle text-primary">نقش</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $index => $role)
                        <tr>
                            <td class="text-center align-middle">{{ $roles->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{$role->name}}</td>
                            <td class="text-center align-middle">
                                <a href="{{route('roles.edit',$role->id)}}">
                                    <i class="fa fa-edit" style="font-size:24px;"></i>
                                </a>
                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display:inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm">
                                        <i class="fa fa-trash-o fa-trash"" style="font-size:24px;"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($role->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach
                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $roles->links('admin.partial.pagination') }}
                    </div>

                </div>
            </div>
        </div>
    </main>
@endsection


@section('css')

@endsection

@section('script')

@endsection
