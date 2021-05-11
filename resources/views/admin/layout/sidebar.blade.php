<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile not-navigation-link">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="{{ asset('admin/assets/images/faces/face1.jpg') }}" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name">{{Auth::user()->name}}</p>
            <div class="dropdown" data-display="static">
              <a href="#" class="nav-link d-flex user-switch-dropdown-toggler" id="UsersettingsDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <small class="designation text-muted">{{Auth::user()->roles[0]->name}}</small>
                <span class="status-indicator online"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="UsersettingsDropdown">
                <a class="dropdown-item p-0">
                  <div class="d-flex border-bottom">
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-bookmark-plus-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center border-left border-right">
                      <i class="mdi mdi-account-outline mr-0 text-gray"></i>
                    </div>
                    <div class="py-3 px-4 d-flex align-items-center justify-content-center">
                      <i class="mdi mdi-alarm-check mr-0 text-gray"></i>
                    </div>
                  </div>
                </a>
                <a class="dropdown-item mt-2"> Manage Accounts </a>
                <a class="dropdown-item"> Change Password </a>
                <a class="dropdown-item"> Check Inbox </a>
                <a class="dropdown-item"> Sign Out </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </li>
    <li class="nav-item {{Request::is('admin/dashboard') ? 'active' : ''}}">
      <a class="nav-link" href="{{ route('admin.dashboard') }}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/products') ? 'active' : ''}}
                        {{Request::is('admin/create_product') ? 'active' : ''}}
                        {{Request::is('admin/product/edit/*') ? 'active' : ''}}
                        {{Request::is('admin/manage_categories') ? 'active' : ''}}
      ">
      <a class="nav-link" data-toggle="collapse" href="#manage-products"  aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-shopping"></i>
        <span class="menu-title">Products</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="manage-products">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/products') ? 'active' : ''}}
                              {{Request::is('admin/product/edit/*') ? 'active' : ''}}
          ">
            <a class="nav-link" href="{{route('admin.products')}}">Manage Products</a>
          </li>
          <li class="nav-item {{Request::is('admin/create_product') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.product.create')}}">Add Product</a>
          </li>
          <li class="nav-item {{Request::is('admin/manage_categories') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_categories')}}">Manage Categories</a>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{Request::is('admin/manage_orders/new') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/pending') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/cancelled') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/dispatched') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/completed') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/complains/current') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/complains/refunded') ? 'active' : ''}}
                        {{Request::is('admin/manage_orders/complains/resolved') ? 'active' : ''}}
                        ">
      <a class="nav-link" data-toggle="collapse" href="#manage-orders"  aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-briefcase"></i>
        <span class="menu-title">Order Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="manage-orders">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/manage_orders/new') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_orders.new')}}">New Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/manage_orders/pending') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_orders.pending')}}">Pending Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/manage_orders/cancelled') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_orders.cancelled')}}">Cancellation Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/manage_orders/dispatched') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_orders.dispatched')}}">Dispatch Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/manage_orders/completed') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.manage_orders.completed')}}">Completed Orders</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#complain-orders"  aria-controls="basic-ui">
              <i class="menu-icon mdi mdi-application"></i>
              <span class="menu-title">Complain Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="complain-orders">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::is('admin/manage_orders/complains/current') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.manage_orders.complains.current')}}">Current Complains</a>
                </li>
                <li class="nav-item {{Request::is('admin/manage_orders/complains/refunded') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.manage_orders.complains.refunded')}}">Refunded</a>
                </li>
                <li class="nav-item {{Request::is('admin/manage_orders/complains/resolved') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.manage_orders.complains.resolved')}}">Resolved</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{route('admin.inventory_management')}}">
        <i class="menu-icon mdi mdi-television"></i>
        <span class="menu-title">Inventory Management System</span>
      </a>
    </li>
    <li class="nav-item {{Request::is('admin/shipping_management/new') ? 'active' : ''}}
                        {{Request::is('admin/shipping_management/dispatched') ? 'active' : ''}}
                        {{Request::is('admin/shipping_management/completed') ? 'active' : ''}}
                        {{Request::is('admin/shipping_management/complains/current') ? 'active' : ''}}
                        {{Request::is('admin/shipping_management/complains/refunded') ? 'active' : ''}}
                        {{Request::is('admin/shipping_management/complains/resolved') ? 'active' : ''}}">
      <a class="nav-link" data-toggle="collapse" href="#shipping-management"  aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-ship-wheel"></i>
        <span class="menu-title">Shipping Management</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="shipping-management">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/shipping_management/new') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.shipping_management.new')}}">New Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/shipping_management/dispatched') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.shipping_management.dispatched')}}">Dispatch Orders</a>
          </li>
          <li class="nav-item {{Request::is('admin/shipping_management/completed') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.shipping_management.completed')}}">Completed Orders</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" data-toggle="collapse" href="#complain-shipping"  aria-controls="basic-ui">
              <i class="menu-icon mdi mdi-application"></i>
              <span class="menu-title">Complain Orders</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse " id="complain-shipping">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item {{Request::is('admin/shipping_management/complains/current') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.shipping_management.complains.current')}}">Current Complains</a>
                </li>
                <li class="nav-item {{Request::is('admin/shipping_management/complains/refunded') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.shipping_management.complains.refunded')}}">Refunded</a>
                </li>
                <li class="nav-item {{Request::is('admin/shipping_management/complains/resolved') ? 'active' : ''}}">
                  <a class="nav-link" href="{{route('admin.shipping_management.complains.resolved')}}">Resolved</a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{Request::is('admin/profile_setting') ? 'active' : ''}}
                        {{Request::is('admin/password_setting') ? 'active' : ''}}">
      <a class="nav-link" data-toggle="collapse" href="#settings"  aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-settings"></i>
        <span class="menu-title">Settings</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="settings">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item {{Request::is('admin/profile_setting') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.profile_setting')}}">Profile Setting</a>
          </li>
          <li class="nav-item {{Request::is('admin/password_setting') ? 'active' : ''}}">
            <a class="nav-link" href="{{route('admin.password_setting')}}">Password Setting</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Payment Setting</a>
          </li>
        </ul>
      </div>
    </li>

    <li class="nav-item ">
      <a class="nav-link" data-toggle="collapse" href="#tickets"  aria-controls="basic-ui">
        <i class="menu-icon mdi mdi-ticket"></i>
        <span class="menu-title">Tickets</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse " id="tickets">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/basic-ui/buttons') }}">Open Tickets</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="{{ url('/basic-ui/dropdowns') }}">Closed Tickets</a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>