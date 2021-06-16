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

        <!--Navbar-->
        @include('client.layout.navbar')
        @include('client.layout.slider')
        
        <div class="content">
                
                
                <!--content-->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
        @include('client.layout.footer')
    <!--JS-->
    @include('client.layout.js')
</body>
</html>