<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbName   = "library_website";

    $db = mysqli_connect($server,$username,$password,$dbName);

    if($db){
        echo "";
    }
    else {
        echo "<div class='alert alert-danger'>". mysqli_error($db) . "</div>";
    }

    global $db;
?>