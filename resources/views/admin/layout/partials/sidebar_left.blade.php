    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">{{ __('common.management_student') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        {{-- User & Role --}}
        
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    {{-- Home Dashboard --}}
                    <li class="nav-item">
                        <a href="{{ route('admin-home') }}" class="nav-link">
                            <i class="nav-icon fas  fa-home"></i>
                            <p>
                                {{ __('common.home') }}
                            </p>
                        </a>
                    </li>
                    @if(auth()->user()->can(\App\Models\User::LIST) || auth()->user()->can(\App\Models\Roles::LIST))
                    {{-- User & Role --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ __('users.managements') }}
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can(\App\Models\User::LIST)
                            <li class="nav-item">
                                <a href="{{ route(\App\Models\User::LIST) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('users.user') }}
                                    </p>
                                </a>
                            </li>
                            @endcan
                            @can(\App\Models\Roles::LIST)
                            <li class="nav-item">
                                <a href="{{ route(\App\Models\Roles::LIST) }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>
                                        {{ __('users.role') }}
                                    </p>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endif
                </ul>
            </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
