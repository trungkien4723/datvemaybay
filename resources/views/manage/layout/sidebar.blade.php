<div class="px-sm-2 px-0 bg-dark">
    <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
        
    <!-- <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-5 d-none d-sm-inline">Menu</span>
        </a> -->


            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">


                <li class="nav-item">
                    <a href="/admin/dashboard" class="nav-link align-middle px-0">
                        <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Tổng quan</span>
                    </a>
                </li>


                <li>
                    <a href="{{route('users.index')}}" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Người dùng</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle ">
                        <i class="fs-4 bi-file-person-fill"></i> <span class="ms-1 d-none d-sm-inline">Nhân viên</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 fa fa-plane"></i> <span class="ms-1 d-none d-sm-inline">Máy bay</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 fa fa-adjust"></i> <span class="ms-1 d-none d-sm-inline">Hạng ghế</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 fa fa-paper-plane"></i> <span class="ms-1 d-none d-sm-inline">Hãng hàng không</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-diagram-3-fill"></i> <span class="ms-1 d-none d-sm-inline">Các chuyến bay</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-bookmark-star-fill"></i> <span class="ms-1 d-none d-sm-inline">Đặt vé</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-building"></i> <span class="ms-1 d-none d-sm-inline">Thành phố</span></a>
                </li>


                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-globe"></i> <span class="ms-1 d-none d-sm-inline">Khu vực</span></a>
                </li>
                    
            <!--Drop down-->
                <!-- <li>
                    <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Người dùng</span> </a>
                    <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline"></span> Danh sách người dùng </a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2 </a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#submenu2" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                        <i class="fs-4 bi-bootstrap"></i> <span class="ms-1 d-none d-sm-inline">Bootstrap</span></a>
                    <ul class="collapse nav flex-column ms-1" id="submenu2" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 1</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Item</span> 2</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-grid"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                        <li class="w-100">
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 1</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 2</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 3</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Product</span> 4</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="nav-link px-0 align-middle">
                        <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
                </li> -->
            </ul>
            <hr>
            <div class="dropdown pb-4">
                <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://github.com/mdo.png" alt="hugenerd" width="30" height="30" class="rounded-circle">
                    <span class="d-none d-sm-inline mx-1">Deep try</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                    <li><a class="dropdown-item" href="#">New project...</a></li>
                    <li><a class="dropdown-item" href="#">Settings</a></li>
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                </ul>
            </div>
    </div>
</div>
