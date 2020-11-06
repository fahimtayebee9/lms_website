
  <nav class="page-sidebar" style="position: fixed!important;" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <?php
                        if ( !empty( $_SESSION['email'] ) || !empty( $_SESSION['password'] ) ){
                            $sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
                            $res = mysqli_query($db,$sql);
                            while($rw = mysqli_fetch_assoc($res)){
                                $name = $rw['name'];
                                $role = $rw['role'];
                                $image = $rw['image'];
                            }
                        }
                    ?>
                    <div>
                        <?php
                            if(!empty($image)){
                                ?>
                                    <img class="rounded-circle mx-auto d-block" width="45px" src="img/users/<?=$image?>" alt="Card image cap">
                                <?php
                            }
                            else{
                                ?>
                                    <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/users/default.png" alt="Card image cap">
                                <?php
                            }
                        ?>
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?=$name?></div><small><?php if($role == 1){echo "Super Admin";}else{echo "User";}?></small>
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