<?php
    include "../inc/db_config.php";

    if(isset($_POST['delete_id'])){
        $delete = $_POST['delete_id'];

        $sql = "DELETE FROM users WHERE id = $delete";
        $result = mysqli_query($db,$sql);
        if($result){
            echo "Done";
        }
        else{
            echo mysqli_error($db);
        }
    }
?>