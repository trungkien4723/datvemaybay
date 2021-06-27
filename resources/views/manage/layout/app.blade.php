<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>  @yield('title') </title>
    <!--CSS-->
    @include('manage.layout.style')
</head>
<body class="container-fluid" style="padding:0px; margin:0px">
    <div class="wrapper">
        <div class="row flex-nowrap">
            <div class="col-auto col-md-2 col-xl-2 col-sm-1 px-sm-2 px-0 bg-dark">
                @include('manage.layout.sidebar')
            </div>
            <div class="main-panel col-auto col-md-8 col-xl-8 col-sm-9 px-4 py-3">
                @include('manage.layout.navbar')
                <div class="content">
                    <div>
                        @yield('content')
                    </div>
                </div>                
            </div>            
        </div>
    </div>
</div>
    <!--JS-->
    @include('manage.layout.js')
</body>
</html>