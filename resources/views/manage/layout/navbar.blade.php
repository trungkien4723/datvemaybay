<div class="dropdown pb-4">
    <a href="#" class="d-flex align-items-center text-decoration-none" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">          
        @if(auth()->user()->image == null)   
            <img src="{{asset('images/user/Sample_User_Icon.png')}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
        @else
            <img src="{{asset('images/user/'.auth()->user()->image)}}" alt="hugenerd" width="30" height="30" class="rounded-circle">
        @endif  
        <span class="d-none d-sm-inline mx-1" style="color:#000;">{{auth()->user()->name}}</span>                              
    </a>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        <li><a class="dropdown-item" href="{{route('users.edit',auth()->user()->id)}}">Tài khoản của tôi</a></li>
        <li><a class="dropdown-item" href="{{route('change-password')}}">Đổi mật khẩu</a></li>
        <li><hr></li>
        <li><a class="dropdown-item" href="{{route('logout')}}">Đăng xuất</a></li>
    </ul>                
</div>
