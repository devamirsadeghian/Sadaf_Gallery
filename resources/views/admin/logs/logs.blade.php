{{--<!doctype html>--}}
{{--<html lang="en">--}}
{{--<head>--}}
{{--    <meta charset="UTF-8">--}}
{{--    <meta name="viewport"--}}
{{--          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
{{--    <meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
{{--    <title>log-viewer</title>--}}
{{--</head>--}}
{{--<body>--}}

{{--<div class="card">--}}
{{--    <p>asd</p>--}}
{{--    <div class="card-body">--}}
{{--        <iframe style="border-width: 0; width: 100%; height: 1000px;"--}}
{{--                src="{{route('log-viewer')}}"></iframe>--}}
{{--    </div>--}}
{{--</div>--}}

{{--</body>--}}
{{--</html>--}}


@extends('admin.layouts.master')


@section('content')
    <main class="">
        <iframe
            src="{{ url('/log-viewer') }}"
            style="width:100%;height:1000px;border:0;">
        </iframe>
    </main>
@endsection


@section('css')

@endsection

@section('script')

@endsection
