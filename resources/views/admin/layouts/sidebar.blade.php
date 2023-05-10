<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="">
    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
      <span class="brand-text" style="color: white; font-size: 15px; margin-right: 15px">سامانه مسابقات</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <div>
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="info">
            <a href="#" class="d-block">{{--{{ auth()->user()->name ." ". auth()->user()->family}}--}}</a>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


              <li class="nav-item has-treeview {{ isActive(["user.create","user.index"],'menu-open') }}">
                  <a href="{{ route('user.index') }}" class="nav-link {{ isActive(["user.create","user.index"],'menu-open') }}">
                      <p>
                          لیست کاربران
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
              </li>

          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
