<?php
  include "inc/header.php";
?>

  <?php
    include "inc/topbar.php";
  ?>

  <!-- Left side column. contains the logo and sidebar -->
  <?php
    include "inc/side_menu.php";
  ?>

    <?php
        if(isset($_GET['action']) && $_GET['action'] == "Search"){
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $text     = $_POST['search'];
                $text_2   = $_POST['search'];
                $text_3   = $_POST['search'];
                $text_4   = $_POST['search'];
                $text_5   = $_POST['search'];
        }
        $total_count  = 0;
        $cat_count = $db->query("SELECT * FROM category WHERE cat_name LIKE '%$text%'")->num_rows;
        $user_count = $db->query("SELECT * FROM users WHERE name LIKE '%$text_2%'")->num_rows;
        $bkRev_count = $db->query("SELECT * FROM book_reservations WHERE rev_customized LIKE '%$text%'")->num_rows;
        $bk_count    = $db->query("SELECT * FROM books WHERE bk_name LIKE '%$text_4%'")->num_rows;
        $total_count = $cat_count + $user_count + $bkRev_count + $bk_count;
    ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-3">
        <ol class="breadcrumb d-flex justify-content-between">
            <div class="start ">
                <li><i class="ti-search mr-2"></i>Search Results Found : <b><?=$total_count?></b></li>
            </div>
            <div class="d-flex justify-content-end">
                <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="pr-3 pl-3"> / </li>
                <li class="active">Search Results</li>
            </div>
        </ol>
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                    <?php
                                if(!empty($text)){
                                    if($total_count > 0){
                                        // CATGEORY DATA
                                        $cat_sql = "SELECT * FROM category WHERE cat_name LIKE '%$text%'";
                                        $res_cat = mysqli_query($db,$cat_sql);
                                        if(mysqli_num_rows($res_cat) != 0){
                                            
                                            ?>
                                            <div class="col-lg-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h3 class="card-title font-weight-bold text-center float-none">Manage All Category</h3>
                                                    </div>
                                                    <div class="card-body" style="display: block;">
                                                        <table class="table">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">
                                                                        #SL.
                                                                    </th>
                                                                    <th scope="col">
                                                                        Category Name
                                                                    </th>
                                                                    <th scope="col">
                                                                        Status
                                                                    </th>
                                                                    <th scope="col">
                                                                        Parent Category Name 
                                                                    </th>                           
                                                                    <th scope="col">
                                                                        Action
                                                                    </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                            <?php
                                                                    $i = 0;
                                                                    while ( $row = mysqli_fetch_assoc($res_cat) ) {
                                                                        $cat_id             = $row['cat_id'];
                                                                        $cat_name           = $row['cat_name'];
                                                                        $cat_desc           = $row['cat_desc'];
                                                                        $status             = $row['status'];
                                                                        $sub_category       = $row['sub_category'];
                                                                        $i++;
                                                                        ?>
                                                
                                                                        <tr>
                                                                            <td><?php echo $i; ?></td>
                                                                            <td><?php echo $cat_name; ?></td>
                                                                            <td>
                                                                            <?php
                                                                                if ( $status == 0 ){ ?>
                                                                                <span class="badge badge-danger">Inactive</span>
                                                                                <?php }
                                                                                else if ( $status == 1 ){ ?>
                                                                                <span class="badge badge-success">Active</span>
                                                                                <?php }
                                                                            ?>
                                                                            </td>
                                                
                                                                            <td>
                                                                            <?php
                                                                                if($sub_category != 0){
                                                                                $parentCatSql = "SELECT * FROM category WHERE cat_id = '$sub_category'";
                                                                                $resparent    = mysqli_query($db,$parentCatSql);
                                                                                while($rowParentx = mysqli_fetch_assoc($resparent)){
                                                                                    $subCat_name = $rowParentx['cat_name'];
                                                                                }
                                                                                echo $subCat_name;
                                                                                }
                                                                                else{
                                                                                echo "None";
                                                                                }
                                                                            ?>
                                                                            </td>
                                                                            
                                                                            <td class="project-actions">
                                                                                <a class="btn btn-info btn-sm" href="category.php?edit=<?php echo $cat_id; ?>">
                                                                                    <i class="fas fa-pencil-alt">
                                                                                    </i>
                                                                                    Edit
                                                                                </a>
                                                                                <a class="btn btn-danger btn-sm" href="#" data-toggle="modal" data-target="#delete<?php echo $cat_id; ?>">
                                                                                    <i class="fas fa-trash">
                                                                                    </i>
                                                                                    Delete
                                                                                </a>
                                                                            </td>
                                                                        </tr>

                                                                        <!-- Delete Modal -->
                                                                        <div class="modal fade" id="delete<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog">
                                                                                <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this category?</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <div class="delete-option text-center">
                                                                                    <ul>
                                                                                        <li><a href="category.php?delete=<?php echo $cat_id; ?>" class="btn btn-danger">Delete</a></li>
                                                                                        <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                                                                                    </ul>
                                                                                    </div>
                                                                                </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                
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

                                        // USERS DATA
                                        $user_sql = "SELECT * FROM users WHERE name LIKE '%$text_2%'";
                                        $res_user = mysqli_query($db,$user_sql);
                                        if(mysqli_num_rows($res_user) > 0){
                                            ?>
                                                <div class="col-lg-12 mt-5">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title font-weight-bold text-center float-none">Manage All Users</h3>
                                                        </div>
                                                        <div class="card-body" style="display: block;">
                                                        
                                                        <table class="table">
                                                            <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#Sl.</th>
                                                                <th scope="col">Image</th>
                                                                <th scope="col">Name</th>
                                                                <th scope="col">Email</th>
                                                                <th scope="col">Address</th>
                                                                <th scope="col">Phone</th>
                                                                <th scope="col">User Role</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Join Date</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <?php
                                                                $i = 0;
                                                                while( $row = mysqli_fetch_assoc($res_user) ){
                                                                    $id         = $row['id'];
                                                                    $name       = $row['name'];
                                                                    $email      = $row['email'];
                                                                    $password   = $row['password'];
                                                                    $address    = $row['address'];
                                                                    $phone      = $row['phone'];
                                                                    $role       = $row['role'];
                                                                    $status     = $row['status'];
                                                                    $image      = $row['image'];
                                                                    $join_date  = $row['join_date'];
                                                                    $i++;
                                                            ?>

                                                                <tr>
                                                                <th scope="row"><?php echo $i; ?></th>
                                                                <td>
                                                                <?php
                                                                    if ( !empty($image) ){ ?>
                                                                    <img src="img/users/<?php echo $image; ?>" class="table-img">
                                                                    <?php }
                                                                    else{ ?>
                                                                    <img src="img/users/default.png" class="table-img">
                                                                    <?php }
                                                                ?>

                                                                
                                                                </td>
                                                                <td><?php echo $name; ?></td>
                                                                <td><?php echo $email; ?></td>
                                                                <td><?php echo $address; ?></td>
                                                                <td><?php echo $phone; ?></td>
                                                                <td>
                                                                <?php
                                                                    if ( $role == 1 ){ ?>
                                                                    <span class="badge badge-success">Super Admin</span>
                                                                    <?php }
                                                                    else if ( $role == 2 ){ ?>
                                                                    <span class="badge badge-primary">Editor</span>
                                                                    <?php }
                                                                ?>
                                                                </td>
                                                                <td>
                                                                <?php
                                                                    if ( $status == 0 ){ ?>
                                                                    <span class="badge badge-danger">Inactive</span>
                                                                    <?php }
                                                                    else if ( $status == 1 ){ ?>
                                                                    <span class="badge badge-success">Active</span>
                                                                    <?php }
                                                                ?>
                                                                </td>
                                                                <td><?php echo $join_date; ?></td>
                                                                <td>
                                                                <a class="btn btn-info btn-sm" href="users.php?do=Edit&edit=<?php echo $id; ?>">
                                                                    <i class="fas fa-pencil-alt">
                                                                    </i>
                                                                    Edit
                                                                </a>


                                                                <?php
                                                                    if ( $role == 1 ){

                                                                    }
                                                                    else if ( $role == 2 ){ ?>
                                                                    <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                                                    <i class="fas fa-trash">
                                                                    </i>
                                                                    Delete
                                                                </a>
                                                                    <?php }
                                                                ?>
                                                                


                                                                </td>
                                                            </tr>
                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this User?</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                        <div class="delete-option text-center">
                                                                            <ul>
                                                                            <li><a href="users.php?do=Delete&delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a></li>
                                                                            <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                                                                            </ul>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                            <?php  }
                                                            ?>

                                                            </tbody>
                                                        </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }

                                        // POST DATA
                                        $sql = "SELECT * FROM book_reservations INNER JOIN books ON books.bk_id = book_reservations.book_id INNER JOIN category ON books.bk_cat = category.cat_id INNER JOIN authors ON books.author_id = authors.a_id INNER JOIN users ON users.id = book_reservations.rev_user WHERE book_reservations.rev_customized LIKE '%$text%'";
                                        $res_post = mysqli_query($db,$sql);
                                        if(mysqli_num_rows($res_post) > 0){
                                            ?>
                                                <div class="col-lg-12 mt-5">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title font-weight-bold text-center float-none">Manage All Posts</h3>
                                                        </div>
                                                        <div class="card-body" style="display: block;">
                                                        
                                                        <table class="table">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">#Sl.</th>
                                                                    <th scope="col">Student Name</th>
                                                                    <th scope="col">Book Name</th>                                
                                                                    <th scope="col">Category</th>
                                                                    <th scope="col">Issued BY</th>
                                                                    <th scope="col">Borrow Date</th>
                                                                    <th scope="col">Status</th>
                                                                    <th scope="col">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                            <?php
                                                                $i = 0;
                                                                while( $row = mysqli_fetch_assoc($res_post) ){
                                                                    $rev_id         = $row['rev_id'];
                                                                    $rev_customized = $row['rev_customized'];
                                                                    $bk_name    = $row['bk_name'];
                                                                    $std_name          = $row['name'];
                                                                    $cat_name    = $row['cat_name'];
                                                                    $issued_by      = $row['issued_by'];
                                                                    $status         = $row['status'];
                                                                    $borrowed_From      = $row['borrowed_From'];
                                                                    $i++;

                                                                    $getAth = "SELECT * FROM users WHERE id = $issued_by";
                                                                    $rsIsd  = mysqli_query($db,$getAth);
                                                                    while($rowIsd = mysqli_fetch_assoc($rsIsd)){
                                                                        $isd_name = $rowIsd['name'];
                                                                    }
                                                                ?>

                                                            <tr>
                                                                <th scope="row"><?php echo $rev_customized; ?></th>
                                                                <td><?=$std_name?></td>
                                                                <td><?php echo $bk_name; ?></td>
                                                                <td><?=$cat_name?></td>
                                                                <td><?=$isd_name?></td>
                                                                <td>
                                                                <?php
                                                                    if ( $status == 0 ){ ?>
                                                                        <span class="badge badge-success">Returned</span>
                                                                    <?php }
                                                                    else if ( $status == 1 ){ ?>
                                                                        <span class="badge badge-default">Pending</span>
                                                                    <?php }
                                                                ?>
                                                                </td>
                                                                <td><?php echo date("d M, Y",strtotime($borrowed_From)); ?></td>

                                                                <td>
                                                                    <a class="btn btn-info btn-sm" href="post.php?do=Edit&edit=<?php echo $post_id; ?>">
                                                                        <i class="fas fa-pencil-alt">
                                                                        </i>
                                                                    </a>
                                                                    <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $post_id; ?>">
                                                                        <i class="ti-trash"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <!-- Delete Modal -->
                                                            <div class="modal fade" id="delete<?php echo $post_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this Post?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <div class="delete-option text-center">
                                                                        <ul>
                                                                            <li><a href="post.php?do=Delete&delete=<?php echo $post_id; ?>" class="btn btn-danger">Delete</a></li>
                                                                            <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                                                                        </ul>                        
                                                                    </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>

                                                            <?php  }
                                                            ?>
                                                            
                                                            </tbody>
                                                        </table>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                        }

                                        // VISITOR DATA
                                        $vis_sql = "SELECT * FROM books INNER JOIN category ON books.bk_cat = category.cat_id INNER JOIN authors ON books.author_id = authors.a_id WHERE books.bk_name LIKE '%$text_4%'";
                                        $res_vis = mysqli_query($db,$vis_sql);
                                        if(mysqli_num_rows($res_vis) > 0){
                                            ?>
                                                <div class="col-lg-12 mt-5">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title font-weight-bold text-center float-none">Manage All Books</h3>
                                                        </div>
                                                        <div class="card-body" style="display: block;">
                                                            
                                                            <table class="table">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col">#Sl.</th>
                                                                        <th scope="col">Image</th>
                                                                        <th scope="col">Book Name</th>
                                                                        <th scope="col">Author</th>
                                                                        <th scope="col">Category</th>
                                                                        <th scope="col">Status</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                        
                                                            <?php
                                                                $i = 0;
                                                                while( $row = mysqli_fetch_assoc($res_vis) ){
                                                                    // $id         = $row['visitor_id'];
                                                                    $a_name       = $row['a_name'];
                                                                    $bk_name      = $row['bk_name'];
                                                                    $bk_image   = $row['bk_image'];
                                                                    $bk_status     = $row['bk_status'];
                                                                    $cat_name  = $row['cat_name'];
                                                                    $i++;
                                                                ?>

                                                                <tr>
                                                                    <th scope="row"><?php echo $i; ?></th>
                                                                    <td>
                                                                    <?php
                                                                        if ( !empty($image) ){ ?>
                                                                            <img src="img/books/<?php echo $bk_image; ?>"  class="book_img">
                                                                        <?php }
                                                                        else{ ?>
                                                                            <img src="img/books/temp_image.jpg" class="book_img">
                                                                        <?php }
                                                                    ?>

                                                                    
                                                                    </td>
                                                                    <td><?php echo $bk_name; ?></td>
                                                                    <td><?php echo $a_name; ?></td>
                                                                    <td><?=$cat_name?></td>
                                                                    <td>
                                                                        <?php
                                                                            if ( $bk_status == 0 ){ ?>
                                                                                <span class="badge badge-danger">Not Available</span>
                                                                            <?php }
                                                                            else if ( $bk_status == 1 ){ ?>
                                                                                <span class="badge badge-success">Available</span>
                                                                            <?php }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                        <a class="btn btn-info btn-sm" href="visitor.php?do=Edit&edit=<?php echo $id; ?>">
                                                                            <i class="fas fa-pencil-alt">
                                                                            </i>
                                                                            Edit
                                                                        </a>

                                                                        <a class="btn btn-danger btn-sm" href="" data-toggle="modal" data-target="#delete<?php echo $id; ?>">
                                                                                <i class="fas fa-trash">
                                                                                </i>
                                                                                Delete
                                                                        </a>

                                                                    </td>
                                                                </tr> 

                                                                <!-- Delete Modal -->
                                                                <div class="modal fade" id="delete<?php echo $id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">Do you Confirm to delete this User?</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="delete-option text-center">
                                                                                    <ul>
                                                                                        <li><a href="visitor.php?do=Delete&delete=<?php echo $id; ?>" class="btn btn-danger">Delete</a></li>
                                                                                        <li><button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button></li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

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
                                    }
                                    else{
                                        $_SESSION['search_warn'] = "No Results Found...";
                                        header("location: dashboard.php");
                                        exit();
                                    }
                                }
                                else{
                                    $_SESSION['search_warn'] = "Please Type Something to Search";
                                    header("location: dashboard.php");
                                    exit();
                                }
                            }
                        
                    ?>
            </div>
        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    // include "inc/footer.php";
  ?>

  <!-- Control Sidebar -->
  <?php
    include "inc/controlbar.php";
  ?>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

  <?php
    include "inc/scripts.php";
  ?>

</body>
</html>