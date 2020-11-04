<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                  <i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active">
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Manage Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="users.php"><i class="fa fa-circle-o"></i>All users</a></li>
                    <li class="active"><a href="users.php?action=Add"><i class="fa fa-circle-o"></i>Add New User</a></li>
                </ul>
            </li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Manage Authors</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="authors.php"><i class="fa fa-circle-o"></i>All Authors</a></li>
                    <li class="active"><a href="authors.php?action=Add"><i class="fa fa-circle-o"></i>Add New Authors</a></li>
                </ul>
            </li>
            <li class="active treeview menu-open">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Manage Books</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="books.php"><i class="fa fa-circle-o"></i>All Books</a></li>
                    <li class="active"><a href="books.php?action=Add"><i class="fa fa-circle-o"></i>Add New Books</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="logout.php" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i> 
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
  </aside>