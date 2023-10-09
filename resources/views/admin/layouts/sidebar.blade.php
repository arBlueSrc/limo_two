<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="">
    <!-- Brand Logo -->
    <a href="{{url('admin')}}" class="brand-link">
      <span class="brand-text" style="color: white; font-size: 15px; margin-right: 15px">مسابقات قرآن</span>
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

                @can('is_superadmin')

                  <li class="nav-item has-treeview {{ isActive(["user.create","users.ostanUsers"],'menu-open') }}">
                      <a href="#" class="nav-link {{ isActive(["user.create","users.ostanUsers"]) }}">
                          <p>
                              مدیریت مدیران استانی
                              <i class="right fa fa-angle-left"></i>
                          </p>
                      </a>
                      <ul class="nav nav-treeview">
                          <li class="nav-item">
                              <a href="{{ route('user.create') }}" class="nav-link {{ isActive("user.create") }}">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>ثبت نام مدیران استانی</p>
                              </a>
                          </li>
                          <li class="nav-item">
                              <a href="{{ route('users.ostanUsers') }}" class="nav-link {{ isActive("users.ostanUsers") }}">
                                  <i class="fa fa-circle-o nav-icon"></i>
                                  <p>لیست مدیران استانی</p>
                              </a>
                          </li>
                      </ul>
                  </li>
              @endcan
              <li class="nav-item has-treeview {{ isActive(["user.index","group.index",'family.index'],'menu-open') }}">
                  <a href="#" class="nav-link {{ isActive(["user.index","group.index",'family.index']) }}">
                      <p>
                          کاربران
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('user.index') }}" class="nav-link {{ isActive("user.index") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>لیست کاربران ثبت نام شده</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('group.index') }}" class="nav-link {{ isActive("group.index") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>لیست کاربران گروهی</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('family.index') }}" class="nav-link {{ isActive("family.index") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>لیست کاربران خانوادگی</p>
                          </a>
                      </li>
                      {{--<li class="nav-item">
                          <a href="{{ route('darolghorans.create') }}" class="nav-link {{isActive("darolghorans.create") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>افزودن دارالقرآن</p>
                          </a>
                      </li>--}}
                  </ul>
              </li>

              <li class="nav-item has-treeview {{ isActive(["user.create","users.ostanUsers"],'menu-open') }}">
                  <a href="#" class="nav-link {{ isActive(["user.create","users.ostanUsers"]) }}">
                      <p>
                          آزمون
                          <i class="right fa fa-angle-left"></i>
                      </p>
                  </a>
                  <ul class="nav nav-treeview">
                      <li class="nav-item">
                          <a href="{{ route('azmoon.index') }}" class="nav-link {{ isActive("azmoon.index") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>لیست آزمون ها</p>
                          </a>
                      </li>
                      <li class="nav-item">
                          <a href="{{ route('result.index') }}" class="nav-link {{ isActive("result.index") }}">
                              <i class="fa fa-circle-o nav-icon"></i>
                              <p>لیست نتایج</p>
                          </a>
                      </li>
                  </ul>
              </li>


          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
    </div>
    <!-- /.sidebar -->
  </aside>
