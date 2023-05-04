<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/dashboard')}}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="ui-basic">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/category')}}">View Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/brand')}}">View Brand</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#prod" aria-expanded="false" aria-controls="prod">
          <i class="mdi mdi mdi-alpha-p-circle menu-icon"></i>
          <span class="menu-title">Product</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="prod">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/products')}}">View Product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/products/create')}}">Add Product</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/colors/')}}">
          <i class="mdi mdi-palette menu-icon"></i>
          <span class="menu-title">Color</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/orders/')}}">
          <i class="mdi mdi-grid-large menu-icon"></i>
          <span class="menu-title">Orders</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('admin/review')}}">
          <i class="mdi mdi-star-circle menu-icon "></i>
          <span class="menu-title">Review</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
          <i class="mdi mdi-account menu-icon"></i>
          <span class="menu-title">User</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="auth">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{url('admin/users')}}"> All User </a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="documentation/documentation.html">
          <i class="mdi mdi-file-document-box-outline menu-icon"></i>
          <span class="menu-title">Documentation</span>
        </a>
      </li>
    </ul>
  </nav>