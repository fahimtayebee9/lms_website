<?php
  include "inc/header.php";
?>
    <!-- START HEADER-->
    <?php
        include "inc/topbar.php";
    ?>
    <!-- END HEADER-->

    <!-- START SIDEBAR-->
    <?php
        include "inc/side_menu.php";
    ?>
    <!-- END SIDEBAR-->

        <?php
            $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
            if($action == "View"){
                if(isset($_GET['view_id'])){
                    $view_id = $_GET['view_id'];
                    $sql = "SELECT * FROM users WHERE id = $view_id";
                    $res = mysqli_query($db,$sql);
                    while($rw = mysqli_fetch_assoc($res)){
                        $id         = $rw['id'];
                        $name       = $rw['name'];
                        $email      = $rw['email'];
                        $password   = $rw['password'];
                        $address    = $rw['address'];
                        $phone      = $rw['phone'];
                        $role       = $rw['role'];
                        $status     = $rw['status'];
                        $image      = $rw['image'];
                        $join_date  = $rw['join_date'];
                    }
                ?>
                    <div class="content-wrapper">
                        <!-- START PAGE CONTENT-->
                        <div class="page-heading pt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html"><i class="la la-home font-20"></i></a>
                                </li>
                                <li class="breadcrumb-item">Profile</li>
                            </ol>
                        </div>
                        <div class="page-content fade-in-up">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="ibox">
                                        <div class="ibox-body text-center">
                                            <div class="m-t-20">
                                                <?php
                                                    if(!empty($image)){
                                                        ?>
                                                            <img class="img-circle mx-auto d-block" width="200px" src="img/users/<?=$image?>" alt="Card image cap">
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img class="img-circle mx-auto d-block" style="width: 170px;" src="img/users/default.png" alt="Card image cap">
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <h5 class="font-strong m-b-10 m-t-10"><?=$name?></h5>
                                            <div class="m-b-20 text-muted"><?php if($role == 1){echo "Super Admin";}else{echo "STUDENT";}?></div>
                                            <div class="profile-social m-b-20">
                                                <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                                                <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                                                <a href="javascript:;"><i class="fa fa-pinterest"></i></a>
                                                <a href="javascript:;"><i class="fa fa-dribbble"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox">
                                        <div class="ibox-body">
                                            <div class="row text-center m-b-20">
                                                <?php
                                                    $total_bookings = $db->query("SELECT * FROM book_reservations WHERE rev_user = $view_id")->num_rows;
                                                    $completed      = $db->query("SELECT * FROM book_reservations WHERE rev_user = $view_id AND rev_status = 0")->num_rows;
                                                    $pending        = $db->query("SELECT * FROM book_reservations WHERE rev_user = $view_id AND rev_status = 1")->num_rows;
                                                ?>
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count"><?=$total_bookings?></div>
                                                    <div class="text-muted">Total Borrowings</div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count"><?=$completed?></div>
                                                    <div class="text-muted">Completed Returns</div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count"><?=$pending?></div>
                                                    <div class="text-muted">Pending Return</div>
                                                </div>
                                            </div>
                                            <!-- <p class="text-center">Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum has been</p> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="ibox">
                                        <div class="ibox-body">
                                            <ul class="nav nav-tabs tabs-line">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-bar-chart"></i>Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i>Update Information</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="tab-1">
                                                    <h4 class="text-info m-b-20 m-t-20"><i class="ti-info-alt pr-2"></i>Booking Details</h4>
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Booking ID</th>
                                                                <th>Book Name</th>
                                                                <th>Borrow Date</th>
                                                                <th>Return Date</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                                $getSQL = "SELECT * FROM book_reservations INNER JOIN books ON books.bk_id = book_reservations.book_id WHERE book_reservations.rev_user = $view_id";
                                                                $resBks = mysqli_query($db,$getSQL);
                                                                if($total_bookings == 0){
                                                                    ?>
                                                                        <tr>
                                                                            <td colspan="5" class="mt-3 alert alert-warning text-center">No Borrowings Yet</td>
                                                                        </tr>
                                                                    <?php
                                                                }
                                                                else{
                                                                    while($rowBks = mysqli_fetch_assoc($resBks)){
                                                                        ?>
                                                                            <tr>
                                                                                <td><?=$rowBks['rev_customized']?></td>
                                                                                <td><?=$rowBks['bk_name']?></td>
                                                                                <td><?=date("d M, Y", strtotime($rowBks['borrowed_From']))?></td>
                                                                                <td><?=date("d M, Y", strtotime($rowBks['borrowed_To']))?></td>
                                                                                <td>
                                                                                    <?php
                                                                                        if($rowBks['rev_status'] == 0){
                                                                                            ?>
                                                                                                <span class="badge badge-success">Returned</span>
                                                                                            <?php
                                                                                        }
                                                                                        else{
                                                                                            ?>
                                                                                                <span class="badge badge-default">Pending</span>
                                                                                            <?php
                                                                                        }
                                                                                    ?>
                                                                                </td>
                                                                            </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="tab-2">

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form action="users.php?action=Update" method="POST" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Full Name</label>
                                                                    <input type="text" name="name" class="form-control" required="required" value="<?=$name?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Email Address</label>
                                                                    <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Password</label>
                                                                    <input type="password" name="password" class="form-control" placeholder="Change The Password">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Retype Password</label>
                                                                    <input type="password" name="repassword" class="form-control" placeholder="Retype The Password">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Upload Image</label>
                                                                    <?php
                                                                        if ( !empty($image) ){ ?>
                                                                        <img src="img/users/<?php echo $image; ?>" class="form-img">
                                                                        <?php }
                                                                        else{
                                                                        echo "No Image uploaded";
                                                                        }
                                                                    ?>
                                                                    <input type="file" name="image" class="form-control-file">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Address</label>
                                                                    <input type="text" name="address" class="form-control" required="required" value="<?php echo $address; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Phone No.</label>
                                                                    <input type="text" name="phone" class="form-control" required="required" value="<?php echo $phone; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">User Role</label>
                                                                    <select name="role" class="form-control">
                                                                        <option>Please Select User Role</option>
                                                                        <option value="1" <?php if ( $role == 1 ){ echo 'selected'; } ?> >Super Admin</option>
                                                                        <option value="2" <?php if ( $role == 2 ){ echo 'selected'; } ?> >Editor</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Account Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option>Please Select User Account Status</option>
                                                                        <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                                                                        <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="updateUserID" value="<?php echo $view_id; ?>">
                                                                    <input type="submit" name="updateUser" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                        
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .profile-social a {
                                    font-size: 16px;
                                    margin: 0 10px;
                                    color: #999;
                                }

                                .profile-social a:hover {
                                    color: #485b6f;
                                }

                                .profile-stat-count {
                                    font-size: 22px
                                }
                            </style>
                            
                        </div>

                        <!-- END PAGE CONTENT-->
                        <?php include "inc/footer.php";?>

                    </div>
                <?php
                }
            }
            else{
                ?>
                    <div class="content-wrapper">
                        <!-- START PAGE CONTENT-->
                        <div class="page-heading pt-3">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html"><i class="la la-home font-20"></i></a>
                                </li>
                                <li class="breadcrumb-item">Profile</li>
                            </ol>
                        </div>
                        <?php
                            if ( !empty( $_SESSION['email'] ) || !empty( $_SESSION['password'] ) ){
                                $sql = "SELECT * FROM users WHERE id = '{$_SESSION['user_id']}'";
                                $res = mysqli_query($db,$sql);
                                while($rw = mysqli_fetch_assoc($res)){
                                    $id         = $rw['id'];
                                    $name       = $rw['name'];
                                    $email      = $rw['email'];
                                    $password   = $rw['password'];
                                    $address    = $rw['address'];
                                    $phone      = $rw['phone'];
                                    $role       = $rw['role'];
                                    $status     = $rw['status'];
                                    $image      = $rw['image'];
                                    $join_date  = $rw['join_date'];
                                }
                            }
                        ?>
                        <div class="page-content fade-in-up">
                            <div class="row">
                                <div class="col-lg-3 col-md-4">
                                    <div class="ibox">
                                        <div class="ibox-body text-center">
                                            <div class="m-t-20">
                                                <?php
                                                    if(!empty($image)){
                                                        ?>
                                                            <img class="img-circle mx-auto d-block" width="200px" src="img/users/<?=$image?>" alt="Card image cap">
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img class="img-circle mx-auto d-block" style="width: 170px;" src="img/users/default.png" alt="Card image cap">
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                            <h5 class="font-strong m-b-10 m-t-10"><?=$name?></h5>
                                            <div class="m-b-20 text-muted"><?php if($role == 1){echo "Super Admin";}else{echo "User";}?></div>
                                            <div class="profile-social m-b-20">
                                                <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                                                <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                                                <a href="javascript:;"><i class="fa fa-pinterest"></i></a>
                                                <a href="javascript:;"><i class="fa fa-dribbble"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ibox">
                                        <div class="ibox-body">
                                            <div class="row text-center m-b-20">
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count">140</div>
                                                    <div class="text-muted">Followers</div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count">$780</div>
                                                    <div class="text-muted">Sales</div>
                                                </div>
                                                <div class="col-4">
                                                    <div class="font-24 profile-stat-count">15</div>
                                                    <div class="text-muted">Projects</div>
                                                </div>
                                            </div>
                                            <p class="text-center">Lorem Ipsum is simply dummy text of the printing and industry. Lorem Ipsum has been</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-8">
                                    <div class="ibox">
                                        <div class="ibox-body">
                                            <ul class="nav nav-tabs tabs-line">
                                                <li class="nav-item">
                                                    <a class="nav-link active" href="#tab-1" data-toggle="tab"><i class="ti-bar-chart"></i> Overview</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="#tab-2" data-toggle="tab"><i class="ti-settings"></i> Settings</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane fade show active" id="tab-1">
                                                    <h4 class="text-info m-b-20 m-t-20"><i class="fa fa-shopping-basket"></i>Personal Details</h4>
                                                    <table class="table table-striped table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th>Order ID</th>
                                                                <th>Customer</th>
                                                                <th>Amount</th>
                                                                <th>Status</th>
                                                                <th width="91px">Date</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>11</td>
                                                                <td>@Jack</td>
                                                                <td>$564.00</td>
                                                                <td>
                                                                    <span class="badge badge-success">Shipped</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td>12</td>
                                                                <td>@Amalia</td>
                                                                <td>$220.60</td>
                                                                <td>
                                                                    <span class="badge badge-success">Shipped</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td>13</td>
                                                                <td>@Emma</td>
                                                                <td>$760.00</td>
                                                                <td>
                                                                    <span class="badge badge-default">Pending</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td>14</td>
                                                                <td>@James</td>
                                                                <td>$87.60</td>
                                                                <td>
                                                                    <span class="badge badge-warning">Expired</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td>15</td>
                                                                <td>@Ava</td>
                                                                <td>$430.50</td>
                                                                <td>
                                                                    <span class="badge badge-default">Pending</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                            <tr>
                                                                <td>16</td>
                                                                <td>@Noah</td>
                                                                <td>$64.00</td>
                                                                <td>
                                                                    <span class="badge badge-success">Shipped</span>
                                                                </td>
                                                                <td>10/07/2017</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="tab-pane fade" id="tab-2">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form action="users.php?action=Update" method="POST" enctype="multipart/form-data">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Full Name</label>
                                                                    <input type="text" name="name" class="form-control" required="required" value="<?=$name?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Email Address</label>
                                                                    <input type="email" name="email" class="form-control" required="required" value="<?php echo $email; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Password</label>
                                                                    <input type="password" name="password" class="form-control" placeholder="Change The Password">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Retype Password</label>
                                                                    <input type="password" name="repassword" class="form-control" placeholder="Retype The Password">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Upload Image</label>
                                                                    <?php
                                                                        if ( !empty($image) ){ ?>
                                                                        <img src="img/users/<?php echo $image; ?>" class="form-img">
                                                                        <?php }
                                                                        else{
                                                                        echo "No Image uploaded";
                                                                        }
                                                                    ?>
                                                                    <input type="file" name="image" class="form-control-file">
                                                                </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Address</label>
                                                                    <input type="text" name="address" class="form-control" required="required" value="<?php echo $address; ?>">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Phone No.</label>
                                                                    <input type="text" name="phone" class="form-control" required="required" value="<?php echo $phone; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">User Role</label>
                                                                    <select name="role" class="form-control">
                                                                        <option>Please Select User Role</option>
                                                                        <option value="1" <?php if ( $role == 1 ){ echo 'selected'; } ?> >Super Admin</option>
                                                                        <option value="2" <?php if ( $role == 2 ){ echo 'selected'; } ?> >Editor</option>
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label class="font-weight-bold">Account Status</label>
                                                                    <select name="status" class="form-control">
                                                                        <option>Please Select User Account Status</option>
                                                                        <option value="0" <?php if ( $status == 0 ){ echo 'selected'; } ?> >Inactive</option>
                                                                        <option value="1" <?php if ( $status == 1 ){ echo 'selected'; } ?> >Active</option>
                                                                    </select>
                                                                </div>

                                                        </div>
                                                        <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="updateUserID" value="<?php echo $id; ?>">
                                                                    <input type="submit" name="updateUser" class="btn btn-block btn-primary btn-flat" value="Save Changes">
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .profile-social a {
                                    font-size: 16px;
                                    margin: 0 10px;
                                    color: #999;
                                }

                                .profile-social a:hover {
                                    color: #485b6f;
                                }

                                .profile-stat-count {
                                    font-size: 22px
                                }
                            </style>
                            
                        </div>

                        <!-- END PAGE CONTENT-->
                        <?php include "inc/footer.php";?>

                    </div>
                <?php
            }
        ?>
        
    </div>

    <!-- CORE PLUGINS-->
    <?php
        include "inc/scripts.php";
    ?>
</body>

</html>