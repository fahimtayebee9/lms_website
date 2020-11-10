<?php
    include "inc/header.php";
    
?>
        <!-- START HEADER-->
        <?php
            include "inc/topbar.php";
        ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php
            include "inc/side_menu.php";
        ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <div class="contain-fluid">  <!-- Total 12 Columns -->
                    <div class="row">   
                        <?php
                            $action = isset($_GET['action']) ? $_GET['action'] : "Manage";
                            if($action == "Manage"){
                                ?>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="ibox">
                                            <div class="ibox-head">
                                                <div class="ibox-title">All Bookings</div>
                                            </div>
                                            <div class="ibox-body">
                                                <table class="table">
                                                    <thead style="background-color: #354a5d;color: white;">
                                                        <tr>
                                                            <th>Booking ID</th>
                                                            <th>Book Name</th>
                                                            <th>Student Name</th>
                                                            <th>Borrowed On</th>
                                                            <th>Borrowed To</th>
                                                            <th>Actual Return Date</th>
                                                            <th>Issued By</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $sql = "SELECT * FROM `book_reservations` 
                                                                    INNER JOIN books ON books.bk_id = book_reservations.book_ID";
                                                            $result = mysqli_query($db,$sql);
                                                            while($row = mysqli_fetch_assoc($result)){
                                                                ?>
                                                                    <tr>
                                                                        <th><?=$row['rev_customized']?></th>
                                                                        <td><?=$row['bk_name']?></td>
                                                                        <td>
                                                                            <?php
                                                                                $std_id = $row['rev_user'];
                                                                                $sql_std = "SELECT * FROM users WHERE id = $std_id";
                                                                                $result_std = mysqli_query($db,$sql_std);
                                                                                while($rowStd = mysqli_fetch_assoc($result_std)){
                                                                                    $STDname = $rowStd['name'];
                                                                                }
                                                                                echo $STDname;
                                                                            ?>
                                                                        </td>
                                                                        <td><?=date("d M, Y", strtotime($row['borrowed_From']))?></td>
                                                                        <td><?=date("d M, Y", strtotime($row['borrowed_To']))?></td>
                                                                        <td>
                                                                            <?php
                                                                                if(!empty($row['actual_Return'])){
                                                                                    echo date("d M, Y", strtotime($row['actual_Return']));
                                                                                }
                                                                                else{
                                                                                    echo "-";
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                $issued_id = $row['issued_by'];
                                                                                $sql_user = "SELECT * FROM users WHERE id = $issued_id";
                                                                                $result_user = mysqli_query($db,$sql_user);
                                                                                while($rowUser = mysqli_fetch_assoc($result_user)){
                                                                                    $name = $rowUser['name'];
                                                                                }
                                                                                echo $name;
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <?php
                                                                                if($row['rev_status'] == 0){
                                                                                    ?>
                                                                                        <p class="m-0 badge badge-success">Returned</p>
                                                                                    <?php
                                                                                }
                                                                                else{
                                                                                    ?>
                                                                                        <p class="m-0 badge badge-warning">Not returned</p>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        </td>
                                                                        <td>
                                                                            <a href="bookings.php?action=Edit&edit_id=<?=$row['rev_id']?>" class="btn btn-info">Edit</a>
                                                                            <button class="btn btn-danger" onclick="suspendReservation(<?=$row['rev_id']?>)">Suspend</button>
                                                                        </td>
                                                                    </tr>
                                                                <?php
                                                            }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            else if($action == "Add"){
                                ?>
                                    <div class="col-md-6  m-auto">
                                        <div class="ibox w-100">
                                            <div class="ibox-head">
                                                <h3 class="ibox-title">Add New Booking</h3>
                                            </div>
                                            <div class="ibox-body" style="display: block;">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-10">
                                                        <form action="bookings.php?action=Insert" method="POST">
                                                            <div class="form-group">
                                                                <label for="name" class="font-weight-bold">Booking ID</label>
                                                                <input type="text" class="input-rounded form-control" name="rev_customized" id="" value="<?=generateNewBookingID()?>" disabled>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Book Name</label>
                                                                <select class="form-control input-rounded w-100" id="select2" name="book_id" required>
                                                                    <option value="0">Please Select A Book</option>
                                                                    <?php
                                                                        $catSQL = "SELECT * FROM category ORDER BY cat_name ASC";
                                                                        $res_cat = mysqli_query($db,$catSQL);
                                                                        while($rowcat = mysqli_fetch_assoc($res_cat)){
                                                                            $cat_id = $rowcat['cat_id'];
                                                                            $count_catBooks = $db->query("SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC")->num_rows;
                                                                            if($count_catBooks > 0){
                                                                                ?>
                                                                                    <optgroup label="<?=$rowcat['cat_name']?>">
                                                                                <?php
                                                                                    $booksSQL = "SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC";
                                                                                    $res_books = mysqli_query($db,$booksSQL);
                                                                                    while($rowBooks = mysqli_fetch_assoc($res_books)){
                                                                                        ?>
                                                                                            <option value="<?=$rowBooks['bk_id']?>"><?=$rowBooks['bk_name']?></option>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                                    </optgroup>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>      

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Student name</label>
                                                                <select class="form-control w-100" id="select2std" name="std_id" required>
                                                                    <option value="0">Please Select A Student</option>
                                                                    <?php
                                                                        $stdSQL = "SELECT * FROM users WHERE role = 2 ORDER BY name ASC";
                                                                        $res_std = mysqli_query($db,$stdSQL);
                                                                        $count_std = $db->query("SELECT * FROM users WHERE role = 2 ORDER BY name ASC")->num_rows;
                                                                        if($count_std > 0){
                                                                            while($rowstd = mysqli_fetch_assoc($res_std)){
                                                                                ?>
                                                                                    <option value="<?=$rowstd['id']?>"><?=$rowstd['name']?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        else{
                                                                            ?>
                                                                                <option value="0">No Student Found</option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Borrowed On</label>
                                                                <input type='text' class='input-rounded form-control datepicker-here' required name="book_from" id="book_from" data-position='bottom center'>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Borrowed To</label>
                                                                <input type='text' class='input-rounded form-control datepicker-here' required id="book_to" name="book_to" data-position='bottom center'>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Booking Status</label>
                                                                <select class="form-control w-100" id="select2status" name="rev_status" required>
                                                                    <option value="1">Please Select Status</option>
                                                                    <option value="1">Valid</option>
                                                                    <option value="0">Not Valid</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="submit" class="btn btn-success " value="Confirm Booking" name="confirm">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            }
                            else if($action == "Insert"){
                                if($_SERVER['REQUEST_METHOD'] == "POST"){
                                    
                                    $rev_customizedId = generateNewBookingID();
                                    $book_id          = $_POST['book_id'];
                                    $student_id       = $_POST['std_id'];
                                    $book_from        = $_POST['book_from'];
                                    $book_to          = $_POST['book_to'];
                                    $rev_status       = $_POST['rev_status'];
                                    $issued_byId      = $_SESSION['user_id'];

                                    $insert = "INSERT INTO `book_reservations`(`rev_customized`, `rev_user`, `issued_by`, `book_ID`, `borrowed_From`, `borrowed_To`, `actual_Return`, `rev_status`)
                                                VALUES ('$rev_customizedId','$student_id','$issued_byId','$book_id','$book_from','$book_to',NULL,'$rev_status')";
                                    $insRes = mysqli_query($db,$insert);
                                    if($insRes){
                                        $getBooksInfo = "SELECT * FROM books WHERE bk_id = $book_id";
                                        $bkRes        = mysqli_query($db,$getBooksInfo);
                                        while($rowInfo = mysqli_fetch_assoc($bkRes)){
                                            $booking_count = $rowInfo['booking_count'];
                                        }
                                        $booking_count += 1;
                                        $updateInfo = "UPDATE books SET booking_count = $booking_count, bk_status = 0 WHERE bk_id = $book_id";
                                        $resUp      = mysqli_query($db,$updateInfo);
                                        if($resUp){
                                            $_SESSION['message'] = "BOOKING CONFIRMED... Booking Id is $rev_customizedId";
                                            $_SESSION['type']    = "success";
                                            header("location: bookings.php?action=Manage");
                                            exit();
                                        }
                                    }
                                    else{
                                        $_SESSION['message'] = "SOMETHING WENT WRONG...BOOKING NOT CONFIRMED...";
                                        $_SESSION['type']    = "error";
                                        header("location: bookings.php?action=Manage");
                                        exit();
                                    }
                                    // echo $insert;
                                }
                            }
                            else if($action == "Edit"){
                                if(isset($_GET['edit_id'])){
                                    $edit_id = $_GET['edit_id'];
                                    $getAllData = "SELECT * FROM `book_reservations` INNER JOIN books ON books.bk_id = book_reservations.book_ID 
                                                INNER JOIN authors ON books.author_id = authors.a_id WHERE book_reservations.rev_id = $edit_id";
                                    $resultData = mysqli_query($db,$getAllData);
                                    while($row = mysqli_fetch_assoc($resultData)){
                                        $book_id    = $row['book_ID'];
                                        $issuedBY   = $row['issued_by'];
                                        $std_id     = $row['rev_user'];
                                        $fromDate   = $row['borrowed_From'];
                                        $toDate     = $row['borrowed_To'];
                                        $rev_status = $row['rev_status'];
                                        $revCus     = $row['rev_customized'];
                                        $rev_id     = $row['rev_id'];
                                        $_SESSION['book_from'] = $fromDate;
                                        $_SESSION['book_to'] = $toDate;
                                    }
                                    ?>
                                    <div class="col-md-6  m-auto">
                                        <div class="ibox w-100">
                                            <div class="ibox-head">
                                                <h3 class="ibox-title">Add New Booking</h3>
                                            </div>
                                            <div class="ibox-body" style="display: block;">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-10">
                                                        <form action="bookings.php?action=Update" method="POST">
                                                            <div class="form-group">
                                                                <label for="name" class="font-weight-bold">Booking ID</label>
                                                                <input type="text" class="input-rounded form-control" name="rev_custom" id="" value="<?=$revCus?>" disabled>
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Book Name</label>
                                                                <select disabled class="form-control input-rounded w-100" id="select2" name="book_id" required>
                                                                    <option value="0">Please Select A Book</option>
                                                                    <?php
                                                                        $catSQL = "SELECT * FROM category ORDER BY cat_name ASC";
                                                                        $res_cat = mysqli_query($db,$catSQL);
                                                                        while($rowcat = mysqli_fetch_assoc($res_cat)){
                                                                            $cat_id = $rowcat['cat_id'];
                                                                            $count_catBooks = $db->query("SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC")->num_rows;
                                                                            if($count_catBooks > 0){
                                                                                ?>
                                                                                    <optgroup label="<?=$rowcat['cat_name']?>">
                                                                                <?php
                                                                                    $booksSQL = "SELECT * FROM books WHERE bk_cat = '$cat_id' AND bk_status = 1 ORDER BY bk_name ASC";
                                                                                    $res_books = mysqli_query($db,$booksSQL);
                                                                                    while($rowBooks = mysqli_fetch_assoc($res_books)){
                                                                                        ?>
                                                                                            <option value="<?=$rowBooks['bk_id']?>" <?php if($book_id == $rowBooks['bk_id'] ){echo "selected";}?>><?=$rowBooks['bk_name']?></option>
                                                                                        <?php
                                                                                    }
                                                                                ?>
                                                                                    </optgroup>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>      

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Student name</label>
                                                                <select disabled class="form-control w-100" id="select2std" name="std_id" required>
                                                                    <option value="0">Please Select A Student</option>
                                                                    <?php
                                                                        $stdSQL = "SELECT * FROM users WHERE role = 2 ORDER BY name ASC";
                                                                        $res_std = mysqli_query($db,$stdSQL);
                                                                        $count_std = $db->query("SELECT * FROM users WHERE role = 2 ORDER BY name ASC")->num_rows;
                                                                        if($count_std > 0){
                                                                            while($rowstd = mysqli_fetch_assoc($res_std)){
                                                                                ?>
                                                                                    <option value="<?=$rowstd['id']?>" <?php if($std_id == $rowstd['id'] ){echo "selected";}?>><?=$rowstd['name']?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        else{
                                                                            ?>
                                                                                <option value="0">No Student Found</option>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Borrowed On</label>
                                                                <input type='text' disabled class='input-rounded form-control datepicker-here' required name="book_from" id="book_from" data-position='bottom center' value="<?=$fromDate?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Borrowed To</label>
                                                                <input type='text' disabled class='input-rounded form-control datepicker-here' required id="book_to" name="book_to" data-position='bottom center' value="<?=$toDate?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Actual Return Date</label>
                                                                <input type='text' class='input-rounded form-control datepicker-here' required id="actualDate" name="actualDate" data-position='bottom center' value="">
                                                            </div>

                                                            <div class="form-group">
                                                                <label class="font-weight-bold">Booking Status</label>
                                                                <select class="form-control w-100" id="select2status" name="rev_status" required>
                                                                    <option value="0">Please Select Status</option>
                                                                    <option value="1" <?php if($rev_status == 1){echo "selected";}?>>Valid</option>
                                                                    <option value="2" <?php if($rev_status == 0){echo "selected";}?>>Expired</option>
                                                                    <option value="3" <?php if($rev_status == 0){echo "selected";}?>>Returned</option>
                                                                    <option value="4" <?php if($rev_status == 0){echo "selected";}?>>Not Returned</option>
                                                                </select>
                                                            </div>
                                                            <div class="form-group text-center">
                                                                <input type="hidden" name="rev_id" value="<?=$rev_id?>">
                                                                <input type="submit" class="btn btn-success " value="Confirm Booking" name="confirm">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            else if($action == "Update"){
                                if($_SERVER['REQUEST_METHOD'] == "POST"){
                                    
                                    $book_id          = $_POST['book_id'];
                                    $student_id       = $_POST['std_id'];
                                    $book_from        = $_POST['book_from'];
                                    $book_to          = $_POST['book_to'];
                                    $rev_status       = $_POST['rev_status'];
                                    $issued_byId      = $_POST['issued_by'];
                                    $actualDate       = $_POST['actualDate'];
                                    $rev_id           = $_POST['rev_id'];

                                    $insert = "UPDATE `book_reservations` SET `actual_Return`='$actualDate',`rev_status`='$rev_status' WHERE rev_id = '$rev_id'";
                                    $insRes = mysqli_query($db,$insert);
                                    if($insRes){
                                        $updateInfo = "UPDATE books SET bk_status = 1 WHERE bk_id = $book_id";
                                        $resUp      = mysqli_query($db,$updateInfo);
                                        
                                        if($resUp){
                                            $_SESSION['message'] = "BOOKING INFORMATION UPDATED...";
                                            $_SESSION['type']    = "success";
                                            header("location: bookings.php?action=Manage");
                                            exit();
                                        }
                                    }
                                    else{
                                        $_SESSION['message'] = "SOMETHING WENT WRONG...BOOKING NOT UPDATED...";
                                        $_SESSION['type']    = "error";
                                        header("location: bookings.php?action=Manage");
                                        exit();
                                    }
                                    // echo $insert;
                                }
                            }
                            else if($action == "Delete"){

                            }
                        ?>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
            <?php include "inc/footer.php";?>
        </div>
    </div>
    
    <!-- END PAGA BACKDROPS-->
    <?php
        include "inc/scripts.php";
    ?>
</body>
</html>

<?php
    function generateNewBookingID(){
        $dbf = dbConnection();
        $getBkIdNew = "SELECT * from book_reservations ORDER BY rev_id DESC LIMIT 1";
        $results  = mysqli_query($dbf, $getBkIdNew);
        while($rws = mysqli_fetch_assoc($results)){
            $rev_customized = $rws['rev_customized'];
        }
        $id_arrs = explode('-',$rev_customized);
        $serials = $id_arrs[1];
        $serials += 1;
        $new_revCustomizeds = "LBK-" . $serials;

        return $new_revCustomizeds;
    }
?>