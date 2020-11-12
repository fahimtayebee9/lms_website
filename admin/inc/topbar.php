    <section class="headers">
        <div class="page-brand">
            <a class="link" href="dashboard.php">
                <span class="brand">Library
                    <span class="brand-tip">MS</span>
                </span>
                <span class="brand-mini">LM</span>
            </a>
        </div>
        <div class="flexbox flex-1">
            <!-- START TOP-LEFT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li>
                    <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                </li>
                <li>
                    <form class="navbar-search" action="search.php?action=Search" method="POST">
                        <div class="rel">
                            <span class="search-icon"><i class="ti-search"></i></span>
                            <input type="search" name="search" class="form-control" placeholder="Search here...">
                        </div>
                    </form>
                </li>
            </ul>
            <!-- END TOP-LEFT TOOLBAR-->

            <!-- START TOP-RIGHT TOOLBAR-->
            <ul class="nav navbar-toolbar">
                <li class="dropdown dropdown-inbox">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope-o"></i>
                        <span class="badge badge-primary envelope-badge">9</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                        <li class="dropdown-menu-header">
                            <div>
                                <span><strong>9 New</strong> Messages</span>
                                <a class="pull-right" href="mailbox.html">view all</a>
                            </div>
                        </li>
                        <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                            <div>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="./assets/img/users/u1.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"> </div>Jeanne Gonzalez<small class="text-muted float-right">Just now</small>
                                            <div class="font-13">Your proposal interested me.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="./assets/img/users/u2.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Becky Brooks<small class="text-muted float-right">18 mins</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="./assets/img/users/u3.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Frank Cruz<small class="text-muted float-right">18 mins</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <img src="./assets/img/users/u4.jpg" />
                                        </div>
                                        <div class="media-body">
                                            <div class="font-strong"></div>Rose Pearson<small class="text-muted float-right">3 hrs</small>
                                            <div class="font-13">Lorem Ipsum is simply.</div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="dropdown dropdown-notification">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o rel"><span class="notify-signal"></span></i></a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                        <li class="dropdown-menu-header">
                            <div>
                                <span><strong>5 New</strong> Notifications</span>
                                <a class="pull-right" href="javascript:;">view all</a>
                            </div>
                        </li>
                        <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                            <div>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-success badge-big"><i class="fa fa-check"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">4 task compiled</div><small class="text-muted">22 mins</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-danger badge-big"><i class="fa fa-bolt"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">Server #7 rebooted</div><small class="text-muted">2 hrs</small></div>
                                    </div>
                                </a>
                                <a class="list-group-item">
                                    <div class="media">
                                        <div class="media-img">
                                            <span class="badge badge-success badge-big"><i class="fa fa-user"></i></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-13">New user registered</div><small class="text-muted">2 hrs</small></div>
                                        </div>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown dropdown-user">
                        <?php
                            if(isset($_SESSION['user_id'])){
                                $user_id = $_SESSION['user_id'];
                                $getData = "SELECT * FROM users WHERE id = '$user_id'";
                                $result = mysqli_query($db,$getData);
                                while($row = mysqli_fetch_assoc($result)){
                                    $image = $row['image'];
                                    $role = $row['role'];
                                }
                            }
                        ?>
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <?php
                                if(!empty($image)){
                                    ?>
                                        <img src="img/users/<?=$image?>" />
                                    <?php
                                }
                                else{
                                    ?>
                                        <img src="img/users/admin-avatar.png" />
                                    <?php
                                }
                            ?>
                            
                            <span></span>
                                <?php
                                    if($role == 1){
                                        echo "Super Admin";
                                    }
                                ?>
                                <i class="fa fa-angle-down m-l-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="profile.php"><i class="fa fa-user"></i>Profile</a>
                            <a class="dropdown-item" href="profile.php"><i class="fa fa-cog"></i>Settings</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
            </ul>
            <!-- END TOP-RIGHT TOOLBAR-->
        </div>
    </section>
