<template>
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/customers" class="brand-link">

        <span class="brand-text font-weight-light">Quản Lý Học Viên</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <router-link to="/" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/customers" class="nav-link">
                       <i class="fas fa-users"></i>
                        <p>
                            Danh Sách Học Viên
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/customers/hocvienthidau" class="nav-link">
                      <i class="fas fa-user-check"></i>
                        <p>
                            Học Viên Thi Đậu
                        </p>
                    </router-link>
                </li>
                <li class="nav-item">
                    <router-link to="/customers/hocvienthidau" class="nav-link">
                        <i class="fas fa-user-times"></i>
                        <p>
                            Học Viên Thi Rớt
                        </p>
                    </router-link>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
</template>
<style  scoped>
@media (max-width: 1024px) {
  .main-sidebar {
    width: 173px !important;
  }
}
</style>