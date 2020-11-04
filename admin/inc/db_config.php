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

    function dbConnection(){
        global $server;
        global $username;
        global $password;
        global $dbName;
        $conn = mysqli_connect($server,$username,$password,$dbName);

        return $conn;
    }

    global $db;
?>