<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title',' فروشگاه ')</title>
    @yield('style')

    <link rel="stylesheet" href="{{asset('panel/vendors/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('panel/vendors/slick/slick-theme.css')}}">
    <link rel="stylesheet" href="{{asset('panel/vendors/vmap/jqvmap.min.css')}}">
    <link rel="stylesheet" href="{{asset('panel/vendors/select2/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider@15.8.1/dist/nouislider.min.css">

</head>

<body>
<main>

@include('home.layouts.header')
@yield('content')
@include('home.layouts.footer')
@include('home.layouts.script')
@include('home.layouts.alerts')

@yield('script')


</main>
</body>
</html>
