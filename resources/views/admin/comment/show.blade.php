@extends('admin.layouts.master')

@section('content')
    <main class="">
        <div class="card">
            <div class="card-body">
                <div class="table overflow-auto" tabindex="8">
                    <table class="table table-striped table-hover">
                        <thead class="thead-light">
                        <tr>
                            <th class="text-center align-middle text-primary">متن کامنت کاربر</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="text-center align-middle">{{$comment->body}}</td>
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
