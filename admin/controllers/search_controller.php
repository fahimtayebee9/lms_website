<?php
    include "../inc/db_config.php";

    if(isset($_POST['value'])){
        $print_html = "";
        $value = $_POST['value'];
        $sql = "SELECT * FROM `book_reservations` 
                    INNER JOIN books ON books.bk_id = book_reservations.book_ID INNER JOIN users ON users.id = book_reservations.rev_user
                    WHERE books.bk_name LIKE '%$value%' OR book_reservations.rev_customized LIKE '%$value%' OR users.name LIKE '%$value%'";
        $result = mysqli_query($db,$sql);
        $count_row = mysqli_num_rows($result);
        $serial = 0;
        while($serial < $count_row && $row = mysqli_fetch_assoc($result)){ 

            $actual_date = "";
            if(!empty($row['actual_Return'])){
                $actual_date = date("d M, Y", strtotime($row['actual_Return']));
            }
            else{
                $actual_date = "-";
            }

            // Authority Name
            $authority_name = "";
            $issued_id = $row['issued_by'];
            $sql_user = "SELECT * FROM users WHERE id = $issued_id";
            $result_user = mysqli_query($db,$sql_user);
            while($rowUser = mysqli_fetch_assoc($result_user)){
                $authority_name = $rowUser['name'];
                break;
            }

            // STATUS CHECK
            $status_ch = "";
            if($row['rev_status'] == 0){
                $status_ch =  "Returned";
            }
            else if(strtotime(date("Y-m-d")) > strtotime(date("Y-m-d",strtotime($row['borrowed_To']))) && empty($row['actual_Return'])){
                $status_ch = "Date Expired";
            }
            else{
                $status_ch = "Not returned";
            }

            // BUTTON LIST
            $btn_list = "";
            if($row['rev_status'] == 0){
                $btn_list .=
                    "<a href='bookings.php?action=View&view_id={$row['rev_id']}' class=' btn btn-outline-secondary mr-2'><i class='ti-eye'></i></a>" .
                    "<a href='bookings.php?action=Edit&edit_id={$row['rev_id']}' class='disabled btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                    "<button class='btn btn-outline-danger' onclick='suspendReservation({$row['rev_id']})'><i class='ti-trash'></i></button>";
                
            }
            else{
                $btn_list .=
                    "<a href='bookings.php?action=View&view_id={$row['rev_id']}' class=' btn btn-outline-secondary mr-2'><i class='ti-eye'></i></a>" .
                    "<a href='bookings.php?action=Edit&edit_id={$row['rev_id']}' class='disabled btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                    "<button class='btn btn-outline-danger' onclick='suspendReservation({$row['rev_id']})'><i class='ti-trash'></i></button>";
            }
            if($row['rev_id']){

            }
            $print_html .= "<tr>" .
                                "<th>" . $row['rev_customized'] . "</th>".
                                "<td>" . $row['bk_name'] . "</td>".
                                "<td>" . $row['name'] . "</td>".
                                "<td>" . date("d M, Y", strtotime($row['borrowed_From'])) . "</td>".
                                "<td>" . date("d M, Y", strtotime($row['borrowed_To'])) . "</td>".
                                "<td>" . $actual_date . "</td>".
                                "<td>" . $authority_name . "</td>".
                                "<td>" . $status_ch . "</td>".
                                "<td>" . $btn_list . "</td>".
                            "</tr>";
            $serial++;
        }
        echo $print_html;
    }

    if(isset($_POST['typeAllData'])){
        $print_html = "";
        $sql = "SELECT * FROM `book_reservations` 
                    INNER JOIN books ON books.bk_id = book_reservations.book_ID INNER JOIN users ON users.id = book_reservations.rev_user";
        $result = mysqli_query($db,$sql);
        $count_row = mysqli_num_rows($result);
        $serial = 0;
        while($serial < $count_row && $row = mysqli_fetch_assoc($result)){ 

            $actual_date = "";
            if(!empty($row['actual_Return'])){
                $actual_date = date("d M, Y", strtotime($row['actual_Return']));
            }
            else{
                $actual_date = "-";
            }

            // Authority Name
            $authority_name = "";
            $issued_id = $row['issued_by'];
            $sql_user = "SELECT * FROM users WHERE id = $issued_id";
            $result_user = mysqli_query($db,$sql_user);
            while($rowUser = mysqli_fetch_assoc($result_user)){
                $authority_name = $rowUser['name'];
            }

            // STATUS CHECK
            $status_ch = "";
            if($row['rev_status'] == 0){
                $status_ch =  "Returned";
            }
            else if(strtotime(date("Y-m-d")) > strtotime(date("Y-m-d",strtotime($row['borrowed_To']))) && empty($row['actual_Return'])){
                $status_ch = "Date Expired";
            }
            else{
                $status_ch = "Not returned";
            }

            // BUTTON LIST
            $btn_list = "";
            if($row['rev_status'] == 0){
                $btn_list .=
                    "<a href='bookings.php?action=View&view_id={$row['rev_id']}' class=' btn btn-outline-secondary mr-2'><i class='ti-eye'></i></a>" .
                    "<a href='bookings.php?action=Edit&edit_id={$row['rev_id']}' class='disabled btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                    "<button class='btn btn-outline-danger' onclick='suspendReservation({$row['rev_id']})'><i class='ti-trash'></i></button>";
                
            }
            else{
                $btn_list .=
                    "<a href='bookings.php?action=View&view_id={$row['rev_id']}' class=' btn btn-outline-secondary mr-2'><i class='ti-eye'></i></a>" .
                    "<a href='bookings.php?action=Edit&edit_id={$row['rev_id']}' class='disabled btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                    "<button class='btn btn-outline-danger' onclick='suspendReservation({$row['rev_id']})'><i class='ti-trash'></i></button>";
            }
            if($row['rev_id']){

            }
            $print_html .= "<tr>" .
                                "<th>" . $row['rev_customized'] . "</th>".
                                "<td>" . $row['bk_name'] . "</td>".
                                "<td>" . $row['name'] . "</td>".
                                "<td>" . date("d M, Y", strtotime($row['borrowed_From'])) . "</td>".
                                "<td>" . date("d M, Y", strtotime($row['borrowed_To'])) . "</td>".
                                "<td>" . $actual_date . "</td>".
                                "<td>" . $authority_name . "</td>".
                                "<td>" . $status_ch . "</td>".
                                "<td>" . $btn_list . "</td>".
                            "</tr>";
            $serial++;
        }
        echo $print_html;
    }
?>