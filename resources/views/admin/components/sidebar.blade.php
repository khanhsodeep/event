<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="{{ asset('/img/logo.png') }}" alt="" class="brand-image  elevation-3" style="opacity: 0.8" />
        <span class="brand-text font-weight-light">Admin-VLU</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('assets/dist/img/avatar5.png') }}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <a href="{{route('admin.profile')}}">
                    <?php $auth = request()->session()->get('auth');
                        echo 'Xin chào' . ', ' . $auth->fullname
                    ?>

                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
       with font-awesome or any other icon font library -->
              
             
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Tổng quan
                        </p>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{route('admin.user')}}" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Quản lí người dùng
                        </p>
                    </a>
                </li>
              
                <li class="nav-item">
                    <a href="{{route('admin.event')}}" class="nav-link">
                        <i class="nav-icon fas fa-check"></i>
                        <p>
                           Quản lí sự kiện
                        </p>
                    </a>
                </li>
               
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>