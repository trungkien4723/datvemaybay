<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>  @yield('title') </title>
    <!--CSS-->
    @include('client.layout.style')
</head>
<body>
    <div class="wrapper">
        @yield('content')
    </div>
    <!--JS-->
    @include('client.layout.js')
</body>
</html>