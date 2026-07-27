<!DOCTYPE html>
<html lang="fa" dir="rtl">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> قالب مدیریتی </title>
    <meta name="theme-color" content="#5867dd">
    <link rel="shortcut icon" href="{{asset('panel/assets/media/image/favicon.png')}}"> {{-- logo --}}
    <link rel="stylesheet" href="{{asset('panel/vendors/bundle.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/vendors/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('panel/vendors/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('panel/vendors/vmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/assets/css/app.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/assets/icons/font-awesome/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('panel/vendors/select2/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/custom.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    @yield('css')
</head>

<body class="pt-0">

@include('admin.layouts.header',[$title=>$title])

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-1 bg-light p-0 m-0">
            @include('admin.layouts.sidebar')

        </div>

        <!-- Content -->
        <div class="col-md-11">
            @yield('content')

        </div>
    </div>
</div>

@include('admin.layouts.script')
@include('admin.layouts.alerts')

@yield('script')

</body>
</html>
