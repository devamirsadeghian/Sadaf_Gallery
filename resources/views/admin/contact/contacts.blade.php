@extends('admin.layouts.master')

@section('content')
    <main class="">
        @include('admin.layouts.errors')
        <div class="card">
            <div class="card-body">

                <label> کامنت کاربران</label>
                <span>{{ $title }}</span>
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">ردیف</th>
                            <th class="text-center align-middle text-primary">کاربر</th>
                            <th class="text-center align-middle text-primary">موبایل</th>
                            <th class="text-center align-middle text-primary">موضوع</th>
                            <th class="text-center align-middle text-primary w-75">متن کاربر</th>
                            <th class="text-center align-middle text-primary">وضعیت</th>
                            <th class="text-center align-middle text-primary">عملیات</th>
                            <th class="text-center align-middle text-primary">تاریخ ایجاد</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contacts as $index => $contact)
                        <tr>
                            <td class="text-center align-middle">{{ $contacts->firstItem() + $index }}</td>
                            <td class="text-center align-middle">{{ $contact->name }}</td>
                            <td class="text-center align-middle">{{ $contact->mobile }}</td>
                            <td class="text-center align-middle">{{ $contact->subject }}</td>
                            <td class="align-middle text-center"
                                style="max-width: 600px; white-space: normal; overflow-wrap: break-word;">
                                {{ $contact->text }}</td>

                            <td class="text-center align-middle">
                                @if($contact->status == \App\Enums\ContactStatus::answered->value)
                                    <span class="cursor-pointer badge badge-success">پاسخ داده شده</span>
                                @elseif($contact->status == \App\Enums\ContactStatus::unread->value)
                                    <span class="cursor-pointer badge badge-danger">خوانده نشده</span>
                                @elseif($contact->status == \App\Enums\ContactStatus::read->value)
                                    <span class="cursor-pointer badge badge-info">خوانده شده</span>
                                @endif
                            </td>

                            <td class="text-center align-middle">
                                <form action="{{ route('contacts.read', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success mx-1">
                                        بررسی شد
                                    </button>
                                </form>
                            </td>
                            <td class="text-center align-middle">{{ verta($contact->created_at)->format('Y/m/d') }}</td>
                        </tr>
                        @endforeach

                    </table>

                    <div class="mt-4 d-flex justify-content-center">
                        {{ $contacts->links('admin.partial.pagination') }}
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
