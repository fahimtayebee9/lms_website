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
                                                    if(!empty($row['a_image'])){
                                                        ?>
                                                            <img class="rounded-circle mx-auto d-block" style="width: 170px; height: 170px;" src="img/authors/<?=$row['a_image']?>" alt="Card image cap">
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <img class="rounded-circle mx-auto d-block" style="width: 170px; height: 170px;" src="img/users/default.png" alt="Card image cap">
                                                        <?php
                                                    }
                                                ?>
                                                
                                                <h5 class="text-sm-center mt-2 mb-1"><?=$row['a_name']?></h5>
                                                <ul class="ml-4 mb-0 mt-3 fa-ul text-muted">
                                                    <li class="small mb-3">
                                                        <span class="fa-li">
                                                        <i class="fa fa-clock"></i></span> 
                                                        Date Of Birth# : <?=date("d M, Y",strtotime($row['a_dob']))?>                                  
                                                    </li>
                                                    <li class="small mb-3">
                                                        <span class="fa-li">
                                                        <i class="fa fa-clock"></i></span> 
                                                        Date Of Death# : <?=date("d M, Y",strtotime($row['a_dod']))?>                                  
                                                    </li>
                                                    <li class="small mb-3"><span class="fa-li mr-3"><i class="fas fa-lg fa-user"></i></span> Status: 
                                                        <?php
                                                            if($row['a_status'] == 0){
                                                                ?>
                                                                    <div class="ml-3 badge badge-danger">Inactive</div>
                                                                <?php
                                                            }
                                                            else if($row['a_status'] == 1){
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
                                            <a href="authors.php?action=Edit&edit_id=<?=$row['a_id']?>" class="btn btn-info">Edit</a>
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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Add New Author</h3>
                                    </div>
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action="authors.php?action=Insert" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Full Name</label>
                                                        <input type="text" name="a_name" class="form-control" required="required">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Account Status</label>
                                                        <select name="a_status" class="form-control">
                                                            <option>Please Select User Account Status</option>
                                                            <option value="0">Inactive</option>
                                                            <option value="1">Active</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Date Of Birth</label>
                                                        <input type='text' class='input-rounded form-control datepicker-here' id="dob" name="dob" data-position='bottom left'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Date Of Death</label>
                                                        <input type='text' class='input-rounded form-control datepicker-here' id="dod" name="dod" data-position='bottom left'>
                                                    </div>      

                                                    <div class="form-group">
                                                        <img src="img/users/preview.jpg" alt="" class="preview mb-3" id="previewImg">
                                                        <label class="font-weight-bold">Upload Image</label>
                                                        <input type="file" name="image" class="form-control-file" onchange="document.getElementById('previewImg').src = window.URL.createObjectURL(this.files[0])">
                                                    </div>        
                                                    
                                            </div>

                                            <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label class="font-weight-bold" >Description</label>
                                                        <textarea class="form-control" id="ckeditor" name="a_desc" rows="15">

                                                        </textarea>
                                                    </div>     
                                                    
                                            </div>

                                            <div class="col-md-3 m-auto">
                                                    <div class="form-group">
                                                        <input type="submit" name="addAuthor" class="btn btn-block btn-info btn-flat" value="Add Author">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
            }
            else if($action == "Insert"){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $a_name = $_POST['a_name'];
                    $a_desc = mysqli_real_escape_string($db, $_POST['a_desc']);
                    $a_dob  = $_POST['dob'];
                    $a_dod  = $_POST['dod'];
                    $a_status = $_POST['a_status'];

                    // Preapre the Image
                    $imageName    = $_FILES['image']['name'];
                    $imageSize    = $_FILES['image']['size'];
                    $imageTmp     = $_FILES['image']['tmp_name'];

                    $imageAllowedExtension = array("jpg", "jpeg", "png");
                    $imageExtension = strtolower( end( explode('.', $imageName) ) );
                    
                    $formErrors = array();

                    if ( !empty($imageName) ){
                        if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                            $formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                        }
                        if ( !empty($imageSize) && $imageSize > 2097152 ){
                            $formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                        }
                    }

                    // Print the Errors 
                    foreach( $formErrors as $error ){
                        echo '<div class="alert alert-warning">' . $error . '</div>';
                    }

                    if ( empty($formErrors) ){

                        if ( !empty( $imageName ) ){

                            // Change the Image Name
                            $image = rand(0, 999999) . '_' .$imageName;
                            // Upload the Image to its own Folder Location
                            move_uploaded_file($imageTmp, "img/authors/" . $image );

                            if(empty($a_dob) && empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_image`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$image','$a_desc','','','$a_status')";
                            }
                            else if(!empty($a_dob) && empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_image`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$image','$a_desc','$a_dob','','$a_status')";
                            }
                            else if(empty($a_dob) && !empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_image`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$image','$a_desc','','$a_dod','$a_status')";
                            }
                            else{
                                $sql = "INSERT INTO `authors`(`a_name`, `a_image`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$image','$a_desc','$a_dob','$a_dod','$a_status')";
                            }

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                $_SESSION['message'] = "Author Added Successfully";
                                $_SESSION['type']    = "success";
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                            else{
                                $_SESSION['message'] = "Author Not Added Successfully";
                                $_SESSION['type']    = "error";
                                die("MySQLi Query Failed." . mysqli_error($db));
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                        }
                        else{
                            if(empty($a_dob) && empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$a_desc','','','$a_status')";
                            }
                            else if(!empty($a_dob) && empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$a_desc','$a_dob','','$a_status')";
                            }
                            else if(empty($a_dob) && !empty($a_dod)){
                                $sql = "INSERT INTO `authors`(`a_name`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$a_desc','','$a_dod','$a_status')";
                            }
                            else{
                                $sql = "INSERT INTO `authors`(`a_name`, `a_desc`, `a_dob`, `a_dod`, `a_status`) 
                                        VALUES ('$a_name','$a_desc','$a_dob','$a_dod','$a_status')";
                            }
                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                $_SESSION['message'] = "Author Added Successfully";
                                $_SESSION['type']    = "success";
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                            else{
                                $_SESSION['message'] = "Author Not Added Successfully";
                                $_SESSION['type']    = "error";
                                die("MySQLi Query Failed." . mysqli_error($db));
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                        }
                    }
                }
            }
            else if($action == "Edit"){
                if(isset($_GET['edit_id'])){
                    $edit_id = $_GET['edit_id'];
                    $getData = "SELECT * FROM authors WHERE a_id = '$edit_id'";
                    $resData = mysqli_query($db,$getData);
                    while($rowData = mysqli_fetch_assoc($resData)){
                        $a_name     = $rowData['a_name'];
                        $a_desc     = $rowData['a_desc'];
                        $a_image    = $rowData['a_image'];
                        $a_dob      = $rowData['a_dob'];
                        $a_dod      = $rowData['a_dod'];
                        $a_status   = $rowData['a_status'];
                    }

                    ?>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title font-weight-bold">Edit Author Information</h3>
                                    </div>
                                    <div class="card-body" style="display: block;">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action="authors.php?action=Update" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Full Name</label>
                                                        <input type="text" name="a_name" class="form-control" value="<?=$a_name?>">
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Account Status</label>
                                                        <select name="a_status" class="form-control">
                                                            <option>Please Select User Account Status</option>
                                                            <option value="0" <?php if($a_status == 0){echo "selected";}?>>Inactive</option>
                                                            <option value="1" <?php if($a_status == 1){echo "selected";}?>>Active</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Date Of Birth</label>
                                                        <input type='text' class='input-rounded form-control datepicker-here' id="dob" name="dob" value="<?=$a_dob?>" data-position='bottom left'>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="font-weight-bold">Date Of Death</label>
                                                        <input type='text' class='input-rounded form-control datepicker-here' id="dod" name="dod" value="<?=$a_dod?>" data-position='bottom left'>
                                                    </div>      

                                                    <div class="form-group">
                                                        <?php
                                                            if(!empty($a_image)){
                                                                ?>
                                                                    <img src="img/authors/<?=$a_image?>" alt="" class="preview mb-3" id="previewImg">
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                    <img src="img/users/preview.jpg" alt="" class="preview mb-3" id="previewImg">
                                                                <?php
                                                            }
                                                        ?>
                                                        <label class="font-weight-bold">Upload Image</label>
                                                        <input type="file" name="image" class="form-control-file" onchange="document.getElementById('previewImg').src = window.URL.createObjectURL(this.files[0])">
                                                    </div>        
                                                    
                                            </div>

                                            <div class="col-lg-6">

                                                    <div class="form-group">
                                                        <label class="font-weight-bold" >Description</label>
                                                        <textarea class="form-control" id="ckeditor" name="a_desc" rows="15">
                                                            <?=$a_desc?>
                                                        </textarea>
                                                    </div>     
                                                    
                                            </div>

                                            <div class="col-md-3 m-auto">
                                                    <div class="form-group">
                                                        <input type="hidden" name="edit_id" value="<?=$edit_id?>">
                                                        <input type="submit" name="addAuthor" class="btn btn-block btn-info btn-flat" value="Save Changes">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                }
            }
            else if($action == "Update"){
                if($_SERVER['REQUEST_METHOD'] == "POST"){
                    $a_name = $_POST['a_name'];
                    $a_desc = mysqli_real_escape_string($db, $_POST['a_desc']);
                    $a_dob  = $_POST['dob'];
                    $a_dod  = $_POST['dod'];
                    $a_status = $_POST['a_status'];
                    $edit_id  = $_POST['edit_id'];

                    // Preapre the Image
                    $imageName    = $_FILES['image']['name'];
                    $imageSize    = $_FILES['image']['size'];
                    $imageTmp     = $_FILES['image']['tmp_name'];

                    $imageAllowedExtension = array("jpg", "jpeg", "png");
                    $imageExtension = strtolower( end( explode('.', $imageName) ) );
                    
                    $formErrors = array();

                    if ( !empty($imageName) ){
                        if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                            $formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                        }
                        if ( !empty($imageSize) && $imageSize > 2097152 ){
                            $formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                        }
                    }

                    // Print the Errors 
                    foreach( $formErrors as $error ){
                        echo '<div class="alert alert-warning">' . $error . '</div>';
                    }

                    if ( empty($formErrors) ){

                        if ( !empty( $imageName ) ){

                            // Change the Image Name
                            $image = rand(0, 999999) . '_' .$imageName;
                            // Upload the Image to its own Folder Location
                            move_uploaded_file($imageTmp, "img/authors/" . $image );
                            
                            if(empty($a_dob) && empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',`a_image`='$a_image',
                                        `a_desc`='$a_desc',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else if(!empty($a_dob) && empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',`a_image`='$a_image',
                                        `a_desc`='$a_desc',`a_dob`='$a_dob',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else if(empty($a_dob) && !empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',`a_image`='$a_image',
                                        `a_desc`='$a_desc',`a_dod`='$a_dod',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else{
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',`a_image`='$a_image',
                                        `a_desc`='$a_desc',`a_dob`='$a_dob',`a_dod`='$a_dod',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                $_SESSION['message'] = "Author Added Successfully";
                                $_SESSION['type']    = "success";
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                            else{
                                $_SESSION['message'] = "Author Not Added Successfully";
                                $_SESSION['type']    = "error";
                                die("MySQLi Query Failed." . mysqli_error($db));
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                        }
                        else{
                            if(empty($a_dob) && empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',`a_desc`='$a_desc', `a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else if(!empty($a_dob) && empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',
                                        `a_desc`='$a_desc',`a_dob`='$a_dob',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else if(empty($a_dob) && !empty($a_dod)){
                                $sql = "UPDATE `authors` SET `a_name`='$a_name',
                                        `a_desc`='$a_desc',`a_dod`='$a_dod',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }
                            else{
                                $sql = "UPDATE `authors` SET `a_name`='$a_name', `a_desc`='$a_desc', `a_dob`='$a_dob',
                                        `a_dod`='$a_dod',`a_status`='$a_status' WHERE `a_id`= '$edit_id'";
                            }

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                $_SESSION['message'] = "Author Updated Successfully";
                                $_SESSION['type']    = "success";
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                            else{
                                $_SESSION['message'] = "Author Not Updated Successfully";
                                $_SESSION['type']    = "error";
                                die("MySQLi Query Failed." . mysqli_error($db));
                                header("Location: authors.php?action=Manage");
                                exit();
                            }
                        }
                    }
                }
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
