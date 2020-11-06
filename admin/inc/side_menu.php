
  <nav class="page-sidebar" style="position: fixed!important;" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">James Brown</div><small>Administrator</small>
                    </div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a href="javascript:;" onclick="window.location='dashboard.php'"><i class="sidebar-item-icon fa fa-dashboard"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="sidebar-item-icon fa fa-dashboard"></i>
                            <span class="nav-label">Manage Users</span>
                            <i class="fa fa-angle-left arrow"></i></a>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li><a href="users.php"><i class="fa fa-circle-o"></i>All users</a></li>
                            <li class="active"><a href="users.php?action=Add"><i class="fa fa-circle-o"></i>Add New User</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="sidebar-item-icon fa fa-dashboard"></i> 
                            <span class="nav-label">Manage Authors</span>
                            <i class="fa fa-angle-left arrow"></i></a>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li><a href="authors.php"><i class="fa fa-circle-o"></i>All Authors</a></li>
                            <li class="active"><a href="authors.php?action=Add"><i class="fa fa-circle-o"></i>Add New Authors</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <i class="sidebar-item-icon fa fa-book"></i> 
                            <span class="nav-label">Manage Books</span>
                            <i class="fa fa-angle-left arrow"></i></a>
                        </a>
                        <ul class="nav-2-level collapse">
                            <li><a href="books.php"><i class="fa fa-circle-o pl-3"></i>All Books</a></li>
                            <li class="active"><a href="books.php?action=Add"><i class="fa fa-circle-o pl-3"></i>Add New Books</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" onclick="window.location='logout.php'"><i class="sidebar-item-icon fa fa-sign-out"></i>
                            <span class="nav-label">Logout</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>