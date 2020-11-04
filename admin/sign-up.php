<?php
    // include "controllers/functions.php";
    include "inc/db_config.php";
    session_start();
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Sign-Up | Library</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link href="vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="libs/css/style.css">
    <link rel="stylesheet" href="vendor/fonts/fontawesome/css/fontawesome-all.css">

    <!-- SWEET ALERT 2 -->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.css">
    <script src="plugins/sweetalert2/sweetalert2.min.js" type="text/javaScript"></script>


    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .reg-card{
        width: 480px!important;
    }
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
    <!-- ============================================================== -->
    <!-- signup form  -->
    <!-- ============================================================== -->
    <form class="splash-container" action="sign-up.php?action=Registration" method="POST" enctype="multipart/form-data">
        <div class="card reg-card">
            <div class="card-header">
                <h3 class="mb-1">Registrations Form</h3>
                <p>Please enter your user information.</p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="name" required="" placeholder="Full Name" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="E-mail" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="address" required="" placeholder="Address" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" type="text" name="phone" required="" placeholder="Phone" autocomplete="off">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="pass1" type="password" name="password" required placeholder="Password">
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" required type="password" name="cpassword" placeholder="Confirm Password">
                </div>
                <div class="form-group">
                    <input class="form-control-file shadow-none" type="file" name="image" required placeholder="">
                </div>
                <div class="form-group pt-2">
                    <input class="btn btn-block btn-primary" type="submit" value="Register My Account">
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" name="terms" type="checkbox"><span class="custom-control-label">By creating an account, you agree the <a href="#">terms and conditions</a></span>
                    </label>
                </div>
                <div class="form-group row pt-0">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-2">
                        <button class="btn btn-block btn-social btn-facebook " type="button">Facebook</button>
                    </div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <button class="btn  btn-block btn-social btn-twitter" type="button">Twitter</button>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p>Already member? <a href="#" class="text-secondary">Login Here.</a></p>
            </div>
        </div>
    </form>

    <?php
        if(isset($_GET['action'])){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $cpassword = $_POST['cpassword'];
                $address     = $_POST['address'];
                $phone     = $_POST['phone'];

                // Preapre the Image
                $imageName    = $_FILES['image']['name'];
                $imageSize    = $_FILES['image']['size'];
                $imageTmp     = $_FILES['image']['tmp_name'];

                $imageAllowedExtension = array("jpg", "jpeg", "png");
                $exp_arr = explode('.', $imageName);
                $imageExtension = strtolower( end( $exp_arr ) );
                
                $formErrors = [];

                if ( !empty($imageName) ){
                  if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                    $formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                  }
                  if ( !empty($imageSize) && $imageSize > 2097152 ){
                    $formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                  }
                }
                if($password != $cpassword){
                    $formErrors[] = 'Password did not match!!!';
                }

                if(empty($_POST['terms'])){
                    $formErrors[] = 'Terms And Policies Not Accepted!!!';
                }

                $countSize = sizeof($formErrors);
                $count     = 0;
                while($count < $countSize){
                //   echo '<div class="alert alert-danger">' . $formErrors[$count] . '</div>';
                  $count++;
                }

                if ( empty($formErrors) && $password == $cpassword && !empty($terms)){
                    $image = rand(0, 999999) . '_' .$imageName;
                    // Upload the Image to its own Folder Location
                    move_uploaded_file($imageTmp, "img/users/" . $image );

                    $hashed = sha1($password);

                    $sql = "INSERT INTO `users`(`name`, `email`, `password`, `address`, `phone`, `role`, `status`, `new_user`, `image`, `join_date`) 
                            VALUES ('$name','$email','$hashed','$address','$phone','2','0',1,'$image',now())";
                    $result = mysqli_query($db,$sql);

                    if($result){
                        $_SESSION['message'] = "Registration Success !!! \n Please Login to Continue!!";
                        $_SESSION['type'] = "success";
                        header("location: index.php");
                        exit();
                    }
                    else{
                        $_SESSION['message'] = "Registration Failed !!!\n" . mysqli_error($db);
                        $_SESSION['type'] = "error";
                        header("location: sign-up.php");
                        exit();
                    }
                }
            }
            else{
                ?>
                <script>
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3500
                    });
                    <?php
                    foreach($formErrors as $error){
                        ?>  
                            Toast.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '<?=$error?>',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        <?php
                    }
                    if(isset($_SESSION['message'])){
                        ?>  
                            Toast.fire({
                                position: 'top-end',
                                icon: 'error',
                                title: '<?=$_SESSION['message']?>',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        <?php
                    }
                    ?>
                </script>
                <?php
            }
        }
    ?>


</body>
</html>