<?php
    include "../inc/db_config.php";

    if(isset($_POST['delete_id'])){
        $delete = $_POST['delete_id'];

        $sql = "DELETE FROM book_reservations WHERE rev_id = $delete";
        $result = mysqli_query($db,$sql);
        if($result){
            echo "Done";
        }
        else{
            echo mysqli_error($db);
        }
    }

    if(isset($_POST['delete_book'])){
        $delete = $_POST['delete_book'];

        $sql = "DELETE FROM books WHERE bk_id = $delete";
        $result = mysqli_query($db,$sql);
        if($result){
            echo "Done";
        }
        else{
            echo mysqli_error($db);
        }
    }
?>