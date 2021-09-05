<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8"/>
    <title>  @yield('title') </title>
    <!--CSS-->
    @include('client.layout.style')
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.1.min.js"></script>
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