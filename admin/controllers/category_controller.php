<?php
    include "../inc/db_config.php";
    if(isset($_POST['cat_id'])){
        $cat_idGet = $_POST['cat_id'];
        $getSubCatSQL = "SELECT * FROM category where sub_category='$cat_idGet'";
        $result       = mysqli_query($db,$getSubCatSQL);
        $rowCount     = mysqli_num_rows($result);
        $printData    = "";
        if($rowCount > 0){
            while($rowSub = mysqli_fetch_assoc($result)){
            $cat_id = $rowSub['cat_id'];
            $cat_name = $rowSub['cat_name'];
            $printData .= "<option value='$cat_id'>$cat_name</option>";
            }
            echo $printData;
        } 
        else{
            echo "0";
        }
    }
?>