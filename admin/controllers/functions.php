<?php
    function login($email, $password){

        $db = dbConnection();

        if(!$db){
            echo "<div class='alert alert-danger'>". mysqli_error($db) . "</div>";
        }

        $sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($db ,$sql);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
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

                if($row['role'] == 1){
                    $_SESSION['message'] = "LOGIN SUCCESS";
                    $_SESSION['type'] = "success";
                    header("location: dashboard.php");
                    exit();
                }
            }
        }
        else {
            $_SESSION['message'] = "LOGIN FAILED ++ " . $sql ;
            $_SESSION['type'] = "error";
            header("location: login.php?error");
            exit();
        }
    }

    
?>