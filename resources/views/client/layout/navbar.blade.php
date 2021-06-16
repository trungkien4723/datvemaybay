<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{route('home')}}"><img  width="70px" height="30px" src="{{asset('images/web/logo.png')}}" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">TRANG CHỦ</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:#fff;">
            VÉ MÁY BAY
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">VÉ NỘI ĐỊA</a></li>
            <li><a class="dropdown-item" href="#">VÉ THEO HÃNG</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">ĐIỂM ĐẾN PHỔ BIẾN</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('home')}}">KHUYẾN MÃI</a>
        </li>
        <li class="nav-item">
          @if(auth()->check())
            <div class="dropdown">
                <a href="#" class="nav-link align-items-center text-decoration-none" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">          
                    <span class="d-none d-sm-inline mx-1" style="color:#fff;">{{auth()->user()->name}}</span>
                    @if(auth()->user()->image == null)   
                      <img src="{{asset('images/user/Sample_User_Icon.png')}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    @else
                      <img src="{{asset('images/user/'.auth()->user()->image)}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    @endif                           
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="{{route('home.edit',auth()->user()->id)}}">Tài khoản của tôi</a></li>
                    <li><a class="dropdown-item" href="{{route('change-password')}}">Đổi mật khẩu</a></li>
                    <li><hr></li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Đăng xuất</a></li>
                </ul>                
            </div>
          @else
            <a class="nav-link active" aria-current="page" href="/login">ĐĂNG NHẬP/ĐĂNG KÝ</a>
          @endif
        </li>
        <!--<li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
        </li>-->
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Tìm kiếm" aria-label="Search">
        <button class="btn btn-warning" type="submit">Tìm</button>
      </form>
    </div>
  </div>
</nav>
