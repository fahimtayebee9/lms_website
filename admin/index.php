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
    <title>Login</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link href="vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="libs/css/style.css">
    <link rel="stylesheet" href="vendor/fonts/fontawesome/css/fontawesome-all.css">

    <!-- SWEET ALERT 2 -->
    <link rel="stylesheet" href="plugins\\sweetalert2\\sweetalert2.css">
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
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            <div class="card-header text-center"><a href="../index.html"><img class="logo-img pb-3" width="60%" src="img/website/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <form action="index.php?action=Login" method="POST">
                    <div class="form-group">
                        <input class="form-control form-control-lg" aria-invalid="true" name="username" id="username" type="text" placeholder="Username" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="password" id="password" type="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="remember" type="checkbox"><span class="custom-control-label">Remember Me</span>
                        </label>
                    </div>
                    <input type="submit" name="submit" value="Sign in" class="btn btn-primary btn-lg btn-block">
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="sign-up.php" class="footer-link">Create An Account</a></div>
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="forgot-password.php" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php
        if(isset($_GET['action']) && $_GET['action'] == "Login"){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $username = $_POST['username'];
                $password = sha1($_POST['password']);
                $remember = $_POST['remember'];
                // login($username, $password);

                $sql = "SELECT * FROM `users` WHERE email = '$username' AND password = '$password'";
                $result = mysqli_query($db ,$sql);

                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_assoc($result)){
                        
                        if(isset($remember)){
                            setcookie("username",$username,time() + (86400 * 30), "/");
                        }
                        else{
                            if($row['role'] == 1){
                                $_SESSION['user_id'] = $row['id'];
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['phone'] = $row['phone'];
                                $_SESSION['address'] = $row['address'];
                                $_SESSION['password'] = $row['password'];
                                $_SESSION['image'] = $row['image'];
                                $_SESSION['role'] = $row['role'];
                                $_SESSION['status'] = $row['status'];
                                $_SESSION['new_status'] = $row['new_status'];
                                $_SESSION['join_date'] = $row['join_date'];

                                $_SESSION['message'] = "LOGIN SUCCESS";
                                $_SESSION['type'] = "success";
                                header("location: dashboard.php");
                                exit();
                            }
                            else {
                                $_SESSION['message'] = "You are not an Administrative User.";
                                $_SESSION['type'] = "error";
                                header("location: ../my-account.php?action=SignIn");
                                exit();
                            }
                        }
                    }
                }
                else {
                    $_SESSION['message'] = "LOGIN FAILED" ;
                    $_SESSION['type'] = "error";
                    header("location: index.php?error");
                    exit();
                }
            }
        }
    ?>

    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <script src="../assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    
    <script>
        <?php
            if(isset($_GET['error'])){
                if(isset($_SESSION['message'])){
                    if(isset($_SESSION['type']) && $_SESSION['type'] == "error"){
                    ?>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: '<?=$_SESSION['message']?>!'
                        })
                    <?php
                    }
                    else if(isset($_SESSION['type']) && $_SESSION['type'] == "success"){
                        ?>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            })
                        <?php
                    }
                    unset($_SESSION['message'],$_SESSION['type']);
                }
            }
        ?>
    </script>

</body>
</html>