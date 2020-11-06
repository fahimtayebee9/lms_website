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
    <section class="content-header pt-3">
      <ol class="breadcrumb d-flex justify-content-end">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="pl-3 pr-3"> / </li>
        <li class="active">Manage Authors</li>
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
                          $sql = "SELECT * FROM authors";
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
                                                            <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/users/<?=$row['a_image']?>" alt="Card image cap">
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/users/default.png" alt="Card image cap">
                                                        <?php
                                                    }
                                                ?>
                                                
                                                <h5 class="text-sm-center mt-2 mb-1"><?=$row['a_name']?></h5>
                                                <ul class="ml-4 mb-0 fa-ul text-muted">
                                                    <li class="small mb-3">
                                                        <span class="fa-li">
                                                        <i class="fas fa-clock"></i></span> 
                                                        Date Of Birth# : <?=date("d M, Y",strtotime($row['a_dob']))?>                                  
                                                    </li>
                                                    <li class="small mb-3">
                                                        <span class="fa-li">
                                                        <i class="fas fa-clock"></i></span> 
                                                        Date Of Death# : <?=date("d M, Y",strtotime($row['a_dod']))?>                                  
                                                    </li>
                                                    <li class="small mb-3"><span class="fa-li mr-3"><i class="fas fa-lg fa-user"></i></span> Status: 
                                                        <?php
                                                            if($row['status'] == 0){
                                                                ?>
                                                                    <div class="ml-3 badge badge-danger">Inactive</div>
                                                                <?php
                                                            }
                                                            else if($row['status'] == 1){
                                                                ?>
                                                                    <div class="ml-3 badge badge-success">Active</div>
                                                                <?php
                                                            }
                                                        ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-footer m-auto">
                                            <a href="authors.php?action=Edit" class="btn btn-info">Edit</a>
                                            <button class="btn btn-danger" onclick="fireDelete(<?=$row['a_id']?>)">Delete</button>
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
