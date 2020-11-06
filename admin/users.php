<?php
  include "inc/header.php";
?>

  <?php
    include "inc/topbar.php";
  ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php
    include "inc/side_menu.php";
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Manage Users</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Manage Users</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="content">
        <?php
            $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
            if($action == "Manage"){
                ?>
                    <div class="container-fluid">
                        <div class="row">
                            <?php
                                $sql = "SELECT * FROM users";
                                $result = mysqli_query($db,$sql);
                                $i = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                ?>
                                    <div class="col-lg-3 col-md-3 col-sm-6 mb-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="mx-auto d-block">
                                                    <?php
                                                        if(!empty($row['image'])){
                                                            ?>
                                                                <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/users/<?=$row['image']?>" alt="Card image cap">
                                                            <?php
                                                        }
                                                        else{
                                                            ?>
                                                                <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/users/default.png" alt="Card image cap">
                                                            <?php
                                                        }
                                                    ?>
                                                    
                                                    <h5 class="text-sm-center mt-2 mb-1"><?=$row['name']?></h5>
                                                    <div class="location text-sm-center"><i class="fa fa-map-marker"></i> <?=$row['address']?> </div>
                                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                                        <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?=$row['phone']?></li>
                                                        <li class="small mb-3">
                                                            <span class="fa-li">
                                                            <i class="fas fa-clock"></i></span> 
                                                            Join Date #: <?=$row['join_date']?>                                  
                                                        </li>
                                                        <li class="small mb-3"><span class="fa-li"><i class="fas fa-lg fa-user"></i></span> Status: 
                                                            <?php
                                                                if($row['status'] == 0){
                                                                    ?>
                                                                        <div class="badge badge-danger">Inactive</div>
                                                                    <?php
                                                                }
                                                                else if($row['status'] == 1){
                                                                    ?>
                                                                        <div class="badge badge-success">Active</div>
                                                                    <?php
                                                                }
                                                            ?>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="card-footer m-auto">
                                                <a href="users.php?action=Edit" class="btn btn-info">Edit</a>
                                                <button class="btn btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    $i++;
                                }
                            ?>
                        </div>
                    </div>
                    
                <?php
            }
            else if($action == "Add"){
                ?>
                    <div class="alert alert-danger">
                        In ADD
                    </div>
                <?php
            }
            else if($action == "Insert"){
                ?>
                    <div class="alert4 alert4-danger">
                        In Insert
                    </div>
                <?php
            }
            else if($action == "Edit"){
                ?>
                    <div class="alert alert-info">
                        In Edit
                    </div>
                <?php
            }
            else if($action == "Update"){
                ?>
                    <div class="alert alert-danger">
                        In Update
                    </div>
                <?php
            }
            else if($action == "Delete"){
                ?>  
                    <div class="alert alert-danger">
                        In DELETE
                    </div>
                <?php
            }
        ?>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include "inc/footer.php";
  ?>

  <!-- Control Sidebar -->
  <?php
    include "inc/controlbar.php";
  ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

  <?php
    include "inc/scripts.php";
  ?>

</body>
</html>
