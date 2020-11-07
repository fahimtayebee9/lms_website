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
      <ol class="breadcrumb d-flex">
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="pr-3 pl-3"> / </li>
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
                                                <a href="users.php?action=Edit&edit=<?=$row['id']?>" class="btn btn-info">Edit</a>
                                                <button class="btn btn-danger" onclick="deleteUser(<?=$row['id']?>)">Delete</button>
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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Users</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="users.php?action=Insert" method="POST" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" name="password" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Retype Password</label>
                                            <input type="password" name="repassword" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" required="required">
                                        </div>                     

                                </div>

                                <div class="col-lg-6">

                                        <div class="form-group">
                                            <label>Phone No.</label>
                                            <input type="text" name="phone" class="form-control" required="required">
                                        </div>

                                        <div class="form-group">
                                            <label>User Role</label>
                                            <select name="role" class="form-control">
                                                <option>Please Select User Role</option>
                                                <option value="1">Super Admin</option>
                                                <option value="2">User</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Account Status</label>
                                            <select name="status" class="form-control">
                                                <option>Please Select User Account Status</option>
                                                <option value="0">Inactive</option>
                                                <option value="1">Active</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>Upload Image</label>
                                            <input type="file" name="image" class="form-control-file">
                                        </div>
                                </div>
                                <div class="col-md-3 m-auto">
                                        <div class="form-group">
                                            <input type="submit" name="addUser" class="btn btn-block btn-primary btn-flat" value="Register User">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
            }
            else if ( $action == 'Insert' ){
                if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                    $name         = $_POST['name'];
                    $email        = $_POST['email'];
                    $password     = $_POST['password'];
                    $repassword   = $_POST['repassword'];
                    $address      = $_POST['address'];
                    $phone        = $_POST['phone'];
                    $role         = $_POST['role'];
                    $status       = $_POST['status'];

                    // Preapre the Image
                    $imageName    = $_FILES['image']['name'];
                    $imageSize    = $_FILES['image']['size'];
                    $imageTmp     = $_FILES['image']['tmp_name'];

                    $imageAllowedExtension = array("jpg", "jpeg", "png");
                    $imageExtension = strtolower( end( explode('.', $imageName) ) );
                    
                    $formErrors = array();

                    if ( strlen($name) < 3 ){
                        $formErrors[] = 'Username is too short!!!';
                    }
                    if ( $password != $repassword ){
                        $formErrors[] = 'Password Doesn\'t match!!!';
                    }
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
                    // Encrypted Password
                        $hassedPass = sha1($password);


                        if ( !empty( $imageName ) ){
                            // Change the Image Name
                            $image = rand(0, 999999) . '_' .$imageName;
                            // Upload the Image to its own Folder Location
                            move_uploaded_file($imageTmp, "img\users\\" . $image );

                            $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                header("Location: users.php?action=Manage");
                            }
                            else{
                                die("MySQLi Query Failed." . mysqli_error($db));
                            }
                        }
                        else{
                            $sql = "INSERT INTO users ( name, email, password, address, phone, role, status, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', now() )";

                            $addUser = mysqli_query($db, $sql);

                            if ( $addUser ){
                                header("Location: users.php?action=Manage");
                            }
                            else{
                                die("MySQLi Query Failed." . mysqli_error($db));
                            }
                        }
                    }
                }
            }
            else if ( $action == 'Edit' ){ 
                if ( isset($_GET['edit']) ){
                    $editID = $_GET['edit'];

                    $sql = "SELECT * FROM users WHERE id = '$editID'";
                    $readUser = mysqli_query($db, $sql);
                    while( $row = mysqli_fetch_assoc($readUser) ){
                        $id         = $row['id'];
                        $name       = $row['name'];
                        $email      = $row['email'];
                        $password   = $row['password'];
                        $address    = $row['address'];
                        $phone      = $row['phone'];
                        $role       = $row['role'];
                        $status     = $row['status'];
                        $image      = $row['image'];
                        $join_date  = $row['join_date'];
                        ?>

                    <div class="col-lg-12">
                      <div class="card">
                        <div class="card-header">
                          <h3 class="card-title">Update User Information</h3>
                        </div>
                        <div class="card-body" style="display: block;">
                          <div class="row">
                            <div class="col-lg-6">
                              <form action="users.php?action=Update" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                  <label class="font-weight-bold">Full Name</label>
                                  <input type="text" name="name" class="form-control" required="required" value="<?php echo $name; ?>">
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
                                  <label class="font-weight-bold">Address</label>
                                  <input type="text" name="address" class="form-control" required="required" value="<?php echo $address; ?>">
                                </div>

                            </div>

                            <div class="col-lg-6">
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
                            <div class="col-md-3 m-auto">
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
                <?php    
                    }// End while
                }// End isset if
            }
            else if ( $action == 'Update' ){
                // Update Start
                if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
                    $updateUserID = $_POST['updateUserID'];
                    $name         = $_POST['name'];
                    $email        = $_POST['email'];
                    $password     = $_POST['password'];
                    $repassword   = $_POST['repassword'];
                    $address      = $_POST['address'];
                    $phone        = $_POST['phone'];
                    $role         = $_POST['role'];
                    $status       = $_POST['status'];
                    $imageName    = $_FILES['image']['name'];

                  if ( !empty($imageName) ){
                    // $imageName    = $_FILES['image']['name'];
                    $imageSize    = $_FILES['image']['size'];
                    $imageTmp     = $_FILES['image']['tmp_name'];

                    $imageAllowedExtension = array("jpg", "jpeg", "png");
                    $imageExtension = strtolower( end( explode('.', $imageName) ) );
                    
                    $formErrors = array();

                    if ( strlen($name) < 3 ){
                      $formErrors = 'Username is too short!!!';
                    }
                    if ( $password != $repassword ){
                      $formErrors = 'Password Doesn\'t match!!!';
                    }
                    if ( !empty($imageName) ){
                      if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                        $formErrors = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                      }
                      if ( !empty($imageSize) && $imageSize > 2097152 ){
                        $formErrors = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                      }
                    }
                  }

                    // Print the Errors 
                    foreach( $formErrors as $error ){
                      echo '<div class="alert alert-warning">' . $error . '</div>';
                    }

                    if ( empty($formErrors) ){


                      // Upload Image and Change the Password
                      if ( !empty($password) && !empty($imageName) ){
                        // Encrypted Password
                        $hassedPass = sha1($password);

                        // Delete the Existing Image while update the new image
                        $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                        $data = mysqli_query($db, $deleteImageSQL);
                        while( $row = mysqli_fetch_assoc($data) ){
                          $existingImage = $row['image'];
                        }
                        unlink('img/users/'. $existingImage);
                        
                        // Change the Image Name
                        $image = rand(0, 999999) . '_' .$imageName;
                        // Upload the Image to its own Folder Location
                        move_uploaded_file($imageTmp, "img\users\\" . $image );

                        $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status', image='$image',new_user = '2' WHERE id = '$updateUserID' ";

                        $addUser = mysqli_query($db, $sql);

                        if ( $addUser ){
                          header("Location: users.php?do=Manage");
                        }
                        else{
                          die("MySQLi Query Failed." . mysqli_error($db));
                        }
                      }

                      // Change the Image Only
                      else if ( !empty($imageName) && empty($password) ){
                        // Delete the Existing Image while update the new image
                        $deleteImageSQL = "SELECT * FROM users WHERE id = '$updateUserID'";
                        $data = mysqli_query($db, $deleteImageSQL);
                        while( $row = mysqli_fetch_assoc($data) ){
                          $existingImage = $row['image'];
                        }
                        unlink('img/users/'. $existingImage);
                        
                        // Change the Image Name
                        $image = rand(0, 999999) . '_' .$imageName;
                        // Upload the Image to its own Folder Location
                        move_uploaded_file($imageTmp, "img\users\\" . $image );

                        $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status', image='$image', new_user = '2' WHERE id = '$updateUserID' ";

                        $addUser = mysqli_query($db, $sql);

                        if ( $addUser ){
                          header("Location: users.php?do=Manage");
                        }
                        else{
                          die("MySQLi Query Failed." . mysqli_error($db));
                        }
                      }
                      // Change the Password Only
                      else if ( !empty($password) && empty($imageName) ){
                        // Encrypted Password
                        $hassedPass = sha1($password);

                        $sql = "UPDATE users SET name='$name', email='$email', password='$hassedPass', address='$address', phone='$phone', role='$role', status='$status',new_user = '2' WHERE id = '$updateUserID' ";

                        $addUser = mysqli_query($db, $sql);

                        if ( $addUser ){
                          header("Location: users.php?do=Manage");
                        }
                        else{
                          die("MySQLi Query Failed." . mysqli_error($db));
                        }
                      }
                      // No Password and Image Update
                      else{
                        $sql = "UPDATE users SET name='$name', email='$email', address='$address', phone='$phone', role='$role', status='$status',new_user = '2' WHERE id = '$updateUserID' ";

                        $addUser = mysqli_query($db, $sql);

                        if ( $addUser ){
                          header("Location: users.php?do=Manage");
                        }
                        else{
                          die("MySQLi Query Failed." . mysqli_error($db));
                        }
                      }
                      
                    }

                }
                // Update End

            }
            else if($action == "Delete"){
                
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
