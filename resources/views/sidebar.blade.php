  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            @can('create_user')

          <li class="nav-item">
            <a href="{{ route('createUser') }}" class="nav-link {{ request()->routeIs('createUser') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Create User
              </p>
            </a>
          </li>

          @endcan

          <li class="nav-item">
            <a href="{{ route('viewUser') }}" class="nav-link {{ request()->routeIs('viewUser') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                View User
              </p>
            </a>
          </li>
          @can('category_module')
          <li class="nav-item">
            <a href="{{ route('createCategory') }}" class="nav-link {{ request()->routeIs('createCategory') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Create Category
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('viewCategory') }}" class="nav-link {{ request()->routeIs('viewCategory') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                View Category
              </p>
            </a>
          </li>
          @endcan
          @can('product_module')
          <li class="nav-item">
            <a href="{{ route('createProduct') }}" class="nav-link nav-link {{ request()->routeIs('createProduct') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                Create Product
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('viewProduct') }}" class="nav-link {{ request()->routeIs('viewProduct') ? 'active' : '' }}">
              <i class="nav-icon far fa-image"></i>
              <p>
                View Product
              </p>
            </a>
          </li>
          @endcan


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>