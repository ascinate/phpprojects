<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url();?>admin/dashboard" class="brand-link">
      <img src="<?php echo base_url();?>files/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="<?php echo base_url();?>admin/dashboard" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard <i class="right fas fa-angle-left"></i></p>
            </a>
          </li>
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p> Manage Users<i class="fas fa-angle-left right"></i></p>
            </a>
            
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/dashboard/adduser" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url();?>admin/dashboard/users" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>
          

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
