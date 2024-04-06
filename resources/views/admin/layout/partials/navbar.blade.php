<div class="container-fluid">
    <a class="navbar-brand text-white" href="#"></a>
    <button class="navbar-toggler border-white" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
        aria-label="Toggle navigation">
        <i class="fa-solid fa-bars" style="color: #ffffff;"></i>
    </button>
    <div class="collapse navbar-collapse flex-row-reverse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
            @if (auth()->user()->can(\App\Models\User::LIST) ||
                    auth()->user()->can(\App\Models\Roles::LIST))
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                        aria-expanded="false" href="#">
                        Phân quyền
                    </a>
                    <ul class="dropdown-menu bg-primary">
                        @can(\App\Models\User::LIST)
                            <li>
                                <a class="nav-link dropdown-item text-white px-2"
                                    href="{{ route(\App\Models\User::LIST) }}">Danh sách quản lý</a>
                            </li>
                        @endcan
                        @can(\App\Models\Roles::LIST)
                            <li>
                                <a class="nav-link dropdown-item text-white px-2"
                                    href="{{ route(\App\Models\Roles::LIST) }}">Vai trò</a>
                            </li>
                        @endcan
                    </ul>

                </div>
            @endif
            @if (auth()->user()->can(\App\Models\Category::LIST))
                <div class="btn-group">
                    <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                        aria-expanded="false" href="#">
                        Quản lý Danh mục
                    </a>
                    <ul class="dropdown-menu bg-primary">
                        <li><a class="nav-link dropdown-item text-white px-2" href="#">Quản lý Khóa học</a></li>
                        <li><a class="nav-link dropdown-item text-white px-2" href="#">Danh mục Học Phần(Môn
                                học)</a></li>
                        <li><a class="nav-link dropdown-item text-white px-2" href="#">Danh mục Phòng học</a>
                        </li>
                    </ul>
                </div>
            @endif
            <a class="nav-link text-white" href="#">Quản lý Lớp sinh hoạt</a>

            <a class="nav-link text-white" href="#">Quản lý lớp học phần</a>

            <div class="btn-group">
                <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false" href="#">
                    Quản lý thanh toán giảng viên
                </a>
                <ul class="dropdown-menu bg-primary">
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Danh sách Giảng viên</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Thiết lập mức thanh
                            toán</a></li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Hợp đồng - thanh toán</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Thiết lập đợt thanh
                            toán</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false" href="#">
                    Báo cáo - In ấn
                </a>
                <ul class="dropdown-menu bg-primary">
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Thống kê đăng ký học</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Báo cáo đóng học phí, lệ
                            phí</a></li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Bảng điểm học tập</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Bảng điểm thi tốt
                            nghiệp</a></li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Danh sách in bằng</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Thống kê đóng lệ phí theo
                            đợt</a></li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false" href="#">
                    Quản lý thời khóa biểu
                </a>
                <ul class="dropdown-menu bg-primary">
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Quản lý giờ học</a>
                    </li>
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Xếp thời khóa biểu</a>
                    </li>
                </ul>
            </div>

            <div class="btn-group">
                <a class="dropdown-toggle nav-link text-white" data-bs-toggle="dropdown" data-bs-display="static"
                    aria-expanded="false" href="#">
                    Thiết lập
                </a>
                <ul class="dropdown-menu dropdown-menu-lg-end bg-primary">
                    <li><a class="nav-link dropdown-item text-white px-2" href="#">Cấu hình Phân quyền</a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
