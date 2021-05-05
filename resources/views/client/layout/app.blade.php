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
        <div class="content">

                <!--Navbar-->
                @include('client.layout.navbar')
                
                <!--content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    <!--JS-->
    @include('client.layout.js')
</body>
</html>