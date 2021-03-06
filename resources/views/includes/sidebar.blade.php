<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('/') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Pangkalan Data Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Simdokwan</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">{{ session('pangkalan_name')??'User Not Found' }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @if(session('pangkalan_level') == 'admin')
                <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-user"></i>
                        <p>
                            User
                        </p>
                    </a>
                </li>
                @endif
                @if(in_array(session('pangkalan_level'), ['user','admin']))
                <li class="nav-item">
                    <a href="{{ route('kegiatan.index') }}" class="nav-link">
                        <i class="nav-icon fa fa-tags"></i>
                        <p>
                            Kegiatan
                        </p>
                    </a>
                </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('user.logout') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-arrow-right-from-bracket"></i>
                        <p>
                            Keluar
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>