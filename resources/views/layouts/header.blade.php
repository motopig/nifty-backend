<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expanded Navigation | Nifty - Admin Template</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&amp;subset=latin" rel="stylesheet">
    <link href={{ asset("css/bootstrap.min.css") }} rel="stylesheet">
    <link href={{ asset("css/nifty.min.css") }} rel="stylesheet">
    <link href={{ asset("css/themify-icons/themify-icons.min.css") }} rel="stylesheet">


    <link href={{ asset("css/nifty-demo-icons.min.css") }} rel="stylesheet">
    <link href={{ asset("css/nifty-demo.min.css") }} rel="stylesheet">
    <link href={{ asset("css/themes/type-c/theme-ocean.min.css") }} rel="stylesheet">
    <link href={{ asset("css/custom.css") }} rel="stylesheet">

    @yield('styles')
    @show

    <link href={{ asset("css/pace.min.css") }} rel="stylesheet">
    <script src={{ asset("js/pace.min.js") }}></script>
    <script src={{ asset("js/jquery-2.2.4.min.js") }}></script>
    <script src={{ asset("js/bootstrap.min.js") }}></script>
    <script src="{{ asset('plugins/layer/layer.js')}}"></script>
    <script src={{ asset("js/nifty.min.js") }}></script>

    <script src={{ asset("js/nifty-demo.min.js") }}></script>
    <script src={{ asset("js/custom.js") }}></script>

    @yield('headScripts')
    @show

</head>

<body>
<div id="container" class="effect mainnav-lg">







