<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="">

    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
        <span class="brand-text" style="color: white; font-size: 15px; margin-right: 15px; align-content: center">مسابقات قرآن</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div>
            <!-- Sidebar user panel (optional) -->
            <div class="row user-panel mt-3 pb-3 mb-3 d-flex align-items-center">
                <div class="text-center info col-12">
                        <a href="#" class="align-content-center">{{ auth()->user()->mobile }}</a>
                </div>
            </div>


            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    @can('is_participant')
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link {{ isActive("user.create") }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>تقدیر نامه</p>
                                </a>
                                <a href="{{ route('user.create') }}" class="nav-link {{ isActive("user.create") }}">
                                    <i class="fa fa-circle-o nav-icon"></i>
                                    <p>گواهینامه</p>
                                </a>
                            </li>
                    @endcan
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
    </div>
    <!-- /.sidebar -->
</aside>
