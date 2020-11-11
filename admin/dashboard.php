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
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-success color-white widget-stat">
                            <div class="ibox-body">
                                <?php 
                                    $pendings = $db->query("SELECT * FROM book_reservations WHERE rev_status = 1")->num_rows;
                                ?>
                                <h2 class="m-b-5 font-strong"><?=$pendings?></h2>
                                <div class="m-b-5">PENDING BOOKINGS</div><i class="ti-shopping-cart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>25% higher</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-info color-white widget-stat">
                            <div class="ibox-body">
                                <?php 
                                    $bookings = $db->query("SELECT * FROM book_reservations")->num_rows;
                                ?>
                                <h2 class="m-b-5 font-strong"><?=$bookings?></h2>
                                <div class="m-b-5">TOTAL BOOKINGS</div><i class="ti-bar-chart widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>17% higher</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-warning color-white widget-stat">
                            <div class="ibox-body">
                                <?php 
                                    $stdusers = $db->query("SELECT * FROM `users` WHERE role = 2")->num_rows;
                                ?>
                                <h2 class="m-b-5 font-strong"><?=$stdusers?></h2>
                                <div class="m-b-5">TOTAL STUDENTS</div><i class="fa fa-money widget-stat-icon"></i>
                                <div><i class="fa fa-level-up m-r-5"></i><small>22% higher</small></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="ibox bg-danger color-white widget-stat">
                            <div class="ibox-body">
                                <?php 
                                    $newUser = $db->query("SELECT * FROM `users` WHERE new_user = 1")->num_rows;
                                ?>
                                <h2 class="m-b-5 font-strong"><?=$newUser?></h2>
                                <div class="m-b-5">NEW STUDENTS</div><i class="ti-user widget-stat-icon"></i>
                                <div><i class="fa fa-level-down m-r-5"></i><small>-12% Lower</small></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Latest Bookings</div>
                                <div class="ibox-tools">
                                    <a class="ibox-collapse"><i class="fa fa-minus"></i></a>
                                    <a class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item">option 1</a>
                                        <a class="dropdown-item">option 2</a>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-body">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="dash-text">Booking ID</th>
                                            <th class="dash-text">Book Name</th>
                                            <th class="dash-text">Student Name</th>
                                            <th class="dash-text">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $sql = "SELECT * FROM `book_reservations` 
                                                    INNER JOIN books ON books.bk_id = book_reservations.book_ID ORDER BY rev_id DESC LIMIT 10";
                                            $result = mysqli_query($db,$sql);
                                            while($row = mysqli_fetch_assoc($result)){
                                                ?>
                                                    <tr>
                                                        <th class="dash-text"><?=$row['rev_customized']?></th>
                                                        <td class="dash-text"><?=$row['bk_name']?></td>
                                                        <td class="dash-text">
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
                                                        <td class="dash-text">
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
                                                    </tr>
                                                <?php
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="ibox-footer text-center">
                                <a href="bookings.php?action=Manage">View All Bookings</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="ibox">
                            <div class="ibox-head">
                                <div class="ibox-title">Best Books</div>
                            </div>
                            <div class="ibox-body">
                                <ul class="media-list media-list-divider m-0">
                                    <?php
                                        $sql = "SELECT DISTINCT books.bk_id, book_reservations.book_ID,books.bk_name, books.booking_count,authors.a_name,books.bk_image FROM `book_reservations` 
                                                INNER JOIN books ON book_reservations.book_ID = books.bk_id INNER JOIN authors ON books.author_id = authors.a_id ORDER BY books.booking_count DESC LIMIT 4 ";
                                        $list = mysqli_query($db,$sql);
                                        while($list_item = mysqli_fetch_assoc($list)){
                                            ?>
                                                <li class="media">
                                                    <a class="media-img" href="javascript:;">
                                                        <?php
                                                            if(!empty($list_item['bk_image'])){
                                                                ?>
                                                                    <img src="img/books/<?=$list_item['bk_image']?>" width="50px;" />
                                                                <?php
                                                            }
                                                            else{
                                                                ?>
                                                                    <img src="./assets/img/image.jpg" width="50px;" />
                                                                <?php
                                                            }
                                                        ?>
                                                        
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <a href="books.php?action=View&view_id=<?=$list_item['bk_id']?>"><?=$list_item['bk_name']?></a>
                                                            <span class="font-16 float-right"><?=$list_item['booking_count']?></span>
                                                        </div>
                                                        <div class="font-13">Author : <?=$list_item['a_name']?></div>
                                                    </div>
                                                </li>
                                            <?php
                                        }
                                    ?>
                                </ul>
                            </div>
                            <div class="ibox-footer text-center">
                                <a href="books.php?action=Manage">View All Books</a>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    .visitors-table tbody tr td:last-child {
                        display: flex;
                        align-items: center;
                    }

                    .visitors-table .progress {
                        flex: 1;
                    }

                    .visitors-table .progress-parcent {
                        text-align: right;
                        margin-left: 10px;
                    }
                </style>
                
            </div>
            <!-- END PAGE CONTENT-->
            <footer class="page-footer">
                <div class="font-13">2018 © <b>AdminCAST</b> - All rights reserved.</div>
                
                <div class="to-top"><i class="fa fa-angle-double-up"></i></div>
            </footer>
        </div>
    </div>

    
    <?php
        include "inc/scripts.php";
    ?>

</body>

</html>