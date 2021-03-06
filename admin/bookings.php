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
                                            <div class="ibox-head justify-content-between">
                                                <div class="ibox-title">All Bookings</div>
                                                <div class="ibox-desc">
                                                    <form class="navbar-search d-flex" method="POST">
                                                        <div class="rel">
                                                            <span class="search-icon"><i class="ti-search"></i></span>
                                                            <input type="search" name="search" id="search_box" class="form-control" placeholder="Search here..." onkeyup="search_data()"  onblur="hide()" onreset="hide()">
                                                        </div>
                                                    </form>
                                                </div>
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
                                                    <tbody id="search_result">
                                                        
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
                                                                <input type='text' disabled class='input-rounded form-control datepicker-here' name="book_from" id="book_from" data-position='bottom center'>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Borrowed To</label>
                                                                <input type='text' disabled class='input-rounded form-control datepicker-here' id="book_to" name="book_to" data-position='bottom center'>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="" class="font-weight-bold">Actual Return Date</label>
                                                                <input type='text' class='input-rounded form-control datepicker-here' id="actualDate" name="actualDate" data-position='bottom center'>
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
                                                                <input type="hidden" name="book_id" value="<?=$book_id?>">
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
                                    
                                    $rev_status       = $_POST['rev_status'];
                                    $issued_byId      = $_SESSION['user_id'];
                                    $actualDate       = $_POST['actualDate'];
                                    $rev_id           = $_POST['rev_id'];
                                    $book_id          = $_POST['book_id'];

                                    if(!empty($_POST['actualDate'])){
                                        $insert = "UPDATE `book_reservations` SET  issued_by = '$issued_byId',`actual_Return`='$actualDate',`rev_status`='$rev_status' WHERE rev_id = '$rev_id'";
                                    }
                                    else{
                                        $insert = "UPDATE `book_reservations` SET issued_by = '$issued_byId',`actual_Return`=NULL,`rev_status`='$rev_status' WHERE rev_id = '$rev_id'";
                                    
                                    }
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


            <div id="quickview-wrapper">
                <?php
                    $bookSql = "SELECT * FROM `book_reservations` 
                                INNER JOIN books ON books.bk_id = book_reservations.book_ID 
                                INNER JOIN users ON users.id = book_reservations.rev_user
                                INNER JOIN authors ON books.author_id = authors.a_id";
                    $res_books = mysqli_query($db,$bookSql);
                    while($rowBook = mysqli_fetch_assoc($res_books)){
                            $bk_name = $rowBook['bk_name'];
                            $bk_image = $rowBook['bk_image'];
                            $bk_status = $rowBook['bk_status'];
                            $bk_id = $rowBook['bk_id'];

                            // Authority Name
                            $authority_name = "";
                            $issued_id = $rowBook['issued_by'];
                            $sql_user = "SELECT * FROM users WHERE id = $issued_id";
                            $result_user = mysqli_query($db,$sql_user);
                            while($rowUser = mysqli_fetch_assoc($result_user)){
                                $authority_name = $rowUser['name'];
                            }
                        ?>
                        
                            <!-- Modal -->
                            <div class="modal bd-example-modal-lg fade" id="productmodal<?=$bk_id?>" tabindex="-1" role="dialog">
                                <div class="modal-dialog  modal-lg modal__container" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header modal__header justify-content-between">
                                            <p class="m-0 font-weight-bold">BOOKING ID : <?=$rowBook['rev_customized']?></p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="modal-product">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <!-- Start product images -->
                                                        <div class="product-images">
                                                            <div class="main-image images">
                                                                <img src="img/books/<?=$bk_image?>" class="w-100" alt="product image">
                                                            </div>
                                                        </div>
                                                        <!-- end product images -->
                                                    </div>

                                                    <div class="col-md-7">
                                                        <div class="product-info">
                                                            <h4><?=$bk_name?></h4>
                                                            <p class="mb-2">
                                                                Author : <?=$rowBook['a_name']?>
                                                            </p>
                                                            <div class="price-box-3 mb-2">
                                                                <div class="s-price-box">
                                                                    Booking Status : 
                                                                    <?php
                                                                        if($bk_status == 1){
                                                                            ?>
                                                                                <span class="new-price">Returned</span>
                                                                            <?php
                                                                        }
                                                                        else{
                                                                            ?>
                                                                                <span class="old-price">Not Returned</span>
                                                                            <?php
                                                                        }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="quick-desc">
                                                                <table>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="text-left font-weight-bold">Student Name</td>
                                                                            <td class="text-left pl-2 pr-2"> : </td>
                                                                            <td class="text-left"><?=$rowBook['name']?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="text-left font-weight-bold">Issued By</td>
                                                                            <td class="text-left pl-2 pr-2"> : </td>
                                                                            <td class="text-left"><?=$authority_name?></td>
                                                                        </tr>
                                                                        <tr class="">
                                                                            <td class="text-left font-weight-bold">Borrowed Date</td>
                                                                            <td class="text-left pl-2 pr-2"> : </td>
                                                                            <td class="text-left"><?=date("d M, Y", strtotime($rowBook['borrowed_From']))?></td>
                                                                        </tr>
                                                                        <tr c>
                                                                            <td class=" text-left font-weight-bold">Borrowed To</td>
                                                                            <td class="text-left pl-2 pr-2"> : </td>
                                                                            <td class="text-left"><?=date("d M, Y", strtotime($rowBook['borrowed_To']))?></td>
                                                                        </tr>
                                                                        <tr class="text-left">
                                                                            <td class="text-left font-weight-bold">Actual Return Date</td>
                                                                            <td class="text-left pl-2 pr-2"> : </td>
                                                                            <td class="text-left"><?=date("d M, Y", strtotime($rowBook['actual_Return']))?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                            <div class="btn-area pt-5">
                                                                <?php
                                                                    // BUTTON LIST
                                                                    $btn_list = "";
                                                                    if($rowBook['rev_status'] == 0){
                                                                        $btn_list .=
                                                                            // "<a data-toggle='modal' title='Quick View' href='#productmodal{$rowBook['rev_id']}' class='btn btn-outline-secondary quickview modal-view detail-link mr-2'><i class='ti-eye'></i></a>" .
                                                                            "<a href='bookings.php?action=Edit&edit_id={$rowBook['rev_id']}' class='disabled btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                                                                            "<button class='btn btn-outline-danger' onclick='suspendReservation({$rowBook['rev_id']})'><i class='ti-trash'></i></button>";
                                                                        
                                                                    }
                                                                    else{
                                                                        $btn_list .=
                                                                            // "<a data-toggle='modal' title='Quick View' href='#productmodal{$rowBook['rev_id']}' class='btn btn-outline-secondary quickview modal-view detail-link mr-2'><i class='ti-eye'></i></a>" .
                                                                            "<a href='bookings.php?action=Edit&edit_id={$rowBook['rev_id']}' class='btn btn-outline-info mr-2'><i class='ti-pencil-alt'></i></a>".
                                                                            "<button class='btn btn-outline-danger' onclick='suspendReservation({$rowBook['rev_id']})'><i class='ti-trash'></i></button>";
                                                                    }
                                                                    echo $btn_list;
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <?php
                    }
                ?>
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