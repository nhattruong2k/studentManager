    {{-- <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-user"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="{{ route('profile') }}" class="dropdown-item">
                    Hồ sơ cá nhân
                </a>
                <a href="{{ route('changePassword') }}" class="dropdown-item">
                    Thay đổi mật khẩu
                </a>
                <a href="{{ route('admin.logout')}}" class="dropdown-item">
                    Đăng Xuất
                </a>
            </div>
        </li>
    </ul> --}}
    <div class="container-fluid">
        <a class="navbar-brand text-white pt-3 pb-0 fs-3" href="{{route('admin-home')}}">Quản lý Đào Tạo</a>
        <div class="collapse d-flex flex-row-reverse">
            <ul class="nav">
                <li class="nav-item">
                    <p class="nav-link text-white">Lớp học xong</p>
                </li>
                <li class="nav-item fs-5">
                    <p class="nav-link rounded-circle bg-danger text-white">0</p>
                </li>
                <li class="nav-item">
                    <p class="nav-link rounded-circle bg-dark text-white mx-1 fs-5">
                        <i class="fa-solid fa-download"></i>
                    </p>
                </li>
                <li class="nav-item">
                    <a href="{{route('admin.logout')}}">
                        <p class="nav-link rounded-circle bg-dark text-white fs-5">
                            <i class="fa-solid fa-right-to-bracket"></i>
                        </p>
                    </a>
                </li>
            </ul>
        </div>
    </div>