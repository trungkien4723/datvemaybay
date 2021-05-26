<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>  @yield('title') </title>
    <!--CSS-->
    @include('manage.layout.style')
</head>
<body class="container-fluid" style="padding:0px;">
    <div class="wrapper row flex-nowrap">
        <!--sidebar-->
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0">
            @include('manage.layout.sidebar')
        </div>
        <div class="main-panel col-auto col-xl-10 col-md-9 p-4">

            <div class="content">                
                    <!--content-->
                    <div class="container-fluid">
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