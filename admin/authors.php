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
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" width="5%">SL#</th>
                                            <th scope="col" width="10%">IMAGE</th>
                                            <th scope="col" width="10%">NAME</th>
                                            <th scope="col" width="20%">DESCRIPTION</th>
                                            <th scope="col" width="10%">Date Of Birth</th>
                                            <th scope="col" width="10%">Date Of Death</th>
                                            <th scope="col" width="10%">STATUS</th>
                                            <th scope="col" width="25%">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM authors";
                                            $result = mysqli_query($db,$sql);
                                            $i = 0;
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?=$i?></th>
                                                        <td>
                                                            <img src="img/authors/<?=$row['a_image']?>" alt="User Image" class="table-img">
                                                        </td>
                                                        <td><?=$row['a_name']?></td>
                                                        <td><?=substr($row['a_desc'],0,150)?></td>
                                                        <td><?=date("d M, Y",strtotime($row['a_dob']))?></td>
                                                        <td><?=date("d M, Y",strtotime($row['a_dod']))?></td>
                                                        <td>
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
                                                        </td>
                                                        <td>
                                                            <a href="users.php?action=Edit" class="btn btn-info">Edit</a>
                                                            <a href="users.php?action=Delete" class="btn btn-danger">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                $i++;
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
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
