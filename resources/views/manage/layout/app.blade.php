<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>  @yield('title') </title>
    <!--CSS-->
    @include('manage.layout.style')
</head>
<body>
    <div class="wrapper">

        <!--sidebar-->
        @include('manage.layout.sidebar')
        <div class="main-panel">

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