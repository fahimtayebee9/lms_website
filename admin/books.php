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

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-3">
      <ol class="breadcrumb d-flex justify-content-end">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="pl-3 pr-3"> / </li>
        <li class="active">Manage Books</li>
      </ol>
    </section>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">'
        <?php
          $action = isset($_GET['action']) ? $_GET['action'] : "Manage"; 
          if($action == "Manage"){
            ?>
              <div class="row">
                  <div class="col-md-12">
                    <?php
                      $totalBooks = $db->query("SELECT * FROM books")->num_rows;
                      $totalBooksAvl = $db->query("SELECT * FROM books WHERE bk_status = 1")->num_rows;
                    ?>
                    <p class="bg-light p-3 font-weight-normal" style="font-size: 16px;">Total Available Books <b><?=$totalBooksAvl?></b> From <b><?=$totalBooks?></b></p>
                  </div>
                  <?php
                    $sqlBooks = "SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id";
                    $resultBooks = mysqli_query($db,$sqlBooks);
                    while($rowBk = mysqli_fetch_assoc($resultBooks)){
                      ?>
                        <div class="col-lg-3 col-md-3 col-sm-4 mb-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mx-auto d-block">
                                        <?php
                                            if(!empty($rowBk['bk_image'])){
                                                ?>
                                                    <img class="rounded-circle mx-auto d-block" style="width: 170px; border-radius: 0%!important;" src="img/books/<?=$rowBk['bk_image']?>" alt="Card image cap">
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <img class="rounded-circle mx-auto d-block" style="width: 170px;" src="img/books/default.png" alt="Card image cap">
                                                <?php
                                            }
                                        ?>
                                        
                                        <h5 class="text-sm-center mt-2 mb-1"><?=$rowBk['bk_name']?></h5>
                                        <p class="text-sm-center mt-2 mb-1">
                                          <a href="search.php?action=Author&author_id=<?=$rowBk['a_id']?>"><?=$rowBk['a_name']?></a>
                                        </p>
                                        <p class="text-sm-center mt-2 mb-1">
                                          <?php
                                            if($rowBk['bk_status'] == 1){
                                              ?>
                                                <span class="badge badge-success">Available</span>
                                              <?php
                                            }
                                            else{
                                              ?>
                                                <span class="badge badge-danger">Book Not Available</span>
                                              <?php
                                            }
                                          ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="card-footer m-auto">
                                    <a href="books.php?action=View&view_id=<?=$rowBk['bk_id']?>" class="btn btn-info">View</a>
                                    <a href="books.php?action=Edit&edit_id=<?=$rowBk['bk_id']?>" class="btn btn-info">Edit</a>
                                    <button class="btn btn-danger">Delete</button>
                                </div>
                            </div>
                        </div>
                      <?php
                    }
                  ?>
              </div>
            <?php
          }
          else if($action == "View"){
            if(isset($_GET['view_id'])){
              $view_id = $_GET['view_id'];
              $sql = "SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id INNER JOIN category ON books.bk_cat = category.cat_id WHERE books.bk_id='$view_id'";
              $result_bk = mysqli_query($db,$sql);
              while($rowRs = mysqli_fetch_assoc($result_bk)){
                ?>
                  <div class="row">
                    <div class="col-lg-8 col-sm-8 col-md-8">
                      <div class="ibox">
                          <div class="ibox-body">
                              <ul class="nav nav-tabs tabs-line">
                                  <li class="nav-item">
                                      <a class="nav-link active" href="#tab-1" data-toggle="tab" aria-expanded="true"><i class="ti-bar-chart"></i> Book Information</a>
                                  </li>
                                  <li class="nav-item">
                                      <a class="nav-link" href="#tab-2" data-toggle="tab" aria-expanded="false"><i class="ti-settings"></i> Author Information</a>
                                  </li>
                              </ul>
                              <div class="tab-content">
                                  <div class="tab-pane fade active show" id="tab-1" aria-expanded="true">
                                      <table class="table table-striped">
                                          <tbody>
                                              <tr>
                                                  <th width="30%">Book Name</th>
                                                  <td><?=$rowRs['bk_name']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Book Publisher</th>
                                                  <td><?=$rowRs['publisher']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">ISBN</th>
                                                  <td><?=$rowRs['ISBN']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Edition</th>
                                                  <td><?=$rowRs['edition']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Category</th>
                                                  <td><?=$rowRs['cat_name']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Country</th>
                                                  <td><?=$rowRs['country']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Language</th>
                                                  <td><?=$rowRs['language']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Author</th>
                                                  <td><a class="nav-link" href="#tab-2" data-toggle="tab" aria-expanded="false"><?=$rowRs['a_name']?></a></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Status</th>
                                                  <td>
                                                    <?php
                                                      if($rowRs['bk_status'] == 1){
                                                        ?>
                                                          <span class="badge badge-success">Available</span>
                                                        <?php
                                                      }
                                                      else{
                                                        ?>
                                                          <span class="badge badge-danger">Book Not Available</span>
                                                        <?php
                                                      }
                                                    ?>
                                                  </td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                                  <div class="tab-pane fade" id="tab-2" aria-expanded="false">
                                      <table class="table table-striped">
                                          <tbody>
                                              <tr>
                                                  <td colspan="2" class="text-center w-100"><img src="img/authors/<?=$rowRs['a_image']?>" class="w-25 table-img" alt="Author Image"></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Author</th>
                                                  <td><?=$rowRs['a_name']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Author Info</th>
                                                  <td><?=$rowRs['a_desc']?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Date of Birth</th>
                                                  <td><?=date("d M, Y",strtotime($rowRs['a_dob']))?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Date of Death</th>
                                                  <td><?=date("d M, Y",strtotime($rowRs['a_dod']))?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Status</th>
                                                  <td>
                                                    <?php
                                                      if($rowRs['a_status'] == 1){
                                                        ?>
                                                          <span class="badge badge-success">Active</span>
                                                        <?php
                                                      }
                                                      else{
                                                        ?>
                                                          <span class="badge badge-danger">Inactive</span>
                                                        <?php
                                                      }
                                                    ?>
                                                  </td>
                                              </tr>
                                          </tbody>
                                      </table>
                                  </div>
                              </div>
                              <div class="btn-area text-center">
                                  <a href="books.php?action=Manage" class="btn btn-warning">Go Back</a>
                                  <a href="books.php?action=Edit&edit_id=<?=$rowRs['bk_id']?>" class="btn btn-info">Edit</a>
                              </div>
                          </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                        <div class="ibox">
                          <div class="ibox-body text-center">
                            <img src="img/books/<?=$rowRs['bk_image']?>" class="img-fluid w-50 " alt="Book Image">
                          </div>
                        </div>
                      
                    </div>
                  </div>
                <?php
              }
            }
            else{
              header("location: books.php?action=Manage");
            }
          }
          else if($action == "Add"){
              ?>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h3 class="card-title">Add New Book</h3>
                      </div>
                      <div class="card-body" style="display: block;">
                        <div class="row">
                          <div class="col-lg-6">
                            <form action="books.php?action=Insert" method="POST" enctype="multipart/form-data">
                              <div class="form-group">
                                <label>Book Name</label>
                                <input type="text" name="bk_name" class="input-rounded form-control" required="required">
                              </div>

                              <?php
                                if(isset($_SESSION['role']) && $_SESSION['role'] == 1){
                              ?>
                                    <div class="form-group">
                                      <label>Book Status</label>
                                      <select name="bk_status" class="form-control">
                                        <option>Please Select Post Status</option>
                                        <option value="0">Available</option>
                                        <option value="1">Unavailable</option>
                                      </select>
                                    </div>
                              <?php
                                }
                              ?>
                              
                              <div class="form-group">
                                <label>ISBN Number</label>
                                <input type="text" name="isbn" class="form-control" required="required">
                              </div>  

                              <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" name="publisher" class="form-control" required="required">
                              </div>  

                              <div class="form-group">
                                <label>Language</label>
                                <input type="text" name="language" class="form-control" required="required">
                              </div> 
                          </div>

                          <div class="col-lg-6">    
                              <div class="form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" id="category_id" onchange="getSubCategory()">
                                  <option>Please select the category</option>
                                  <?php
                                    $sql = "SELECT * FROM category WHERE status = 1 AND sub_category = 0 ORDER BY cat_name ASC";
                                    $readCat = mysqli_query($db, $sql);
                                    while( $row = mysqli_fetch_assoc($readCat) ){
                                      $cat_id   = $row['cat_id'];
                                      $cat_name = $row['cat_name'];
                                  ?>
                                      <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>
                                  <?php  }
                                  ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Sub Category</label>
                                <select class="form-control" name="sub_id" id="sub_id" disabled>
                                  <option value="0">Please select the category</option>
                                  
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Author</label>
                                <select name="author_id" class="form-control">
                                  <option value="0">Please Select Author</option>
                                  <?php
                                    $sqlA = "SELECT * FROM authors";
                                    $res = mysqli_query($db,$sqlA);
                                    while($rw = mysqli_fetch_assoc($res)){
                                      ?>
                                        <option value="<?=$rw['a_id']?>"><?=$rw['a_name']?></option>
                                      <?php
                                    }
                                  ?>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Edition</label>
                                <input type="text" name="edition" class="form-control" required="required">
                              </div> 

                              <div class="form-group">
                                <label>Country</label>
                                <input type="text" name="country" class="form-control" required="required">
                              </div> 
                          </div>

                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Upload Book Image</label>
                              <input type="file" name="bk_image" class="form-control-file" required="required">
                            </div> 
                          </div>
                          
                          <div class="col-md-4 m-auto">
                              <div class="form-group">
                                <input type="submit" name="addPost" class="btn btn-block btn-primary btn-flat" value="Publish Post">
                              </div>
                            </form>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>
              <?php
          }
          else if($action == "Insert"){
            echo "<script>alert('FORM SUBMITTED')</script>";
            if ( $_SERVER['REQUEST_METHOD'] == 'POST' ){
              $bk_name            = $_POST['bk_name'];
              $category_id      = $_POST['category_id'];
              $sub_cat          = $_POST['sub_id'];
              if(!empty($_POST['bk_status'])){
                $status = $_POST['bk_status'];
              }
              else{
                $status = 0;
              }
              $publisher        = $_POST['publisher'];
              $isbn             = $_POST['isbn'];
              $edition          = $_POST['edition'];
              $country         = $_POST['country'];
              $language         = $_POST['language'];
              $author_id        = $_POST['author_id'];

              // Preapre the Image
              $imageName    = $_FILES['bk_image']['name'];
              $imageSize    = $_FILES['bk_image']['size'];
              $imageTmp     = $_FILES['bk_image']['tmp_name'];

              $imageAllowedExtension = array("jpg", "jpeg", "png");
              $exp_arr = explode('.', $imageName);
              $imageExtension = strtolower( end( $exp_arr ) );
              
              $formErrors = [];

              
              if ( !empty($imageName) ){
                if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
                  $formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
                }
                if ( !empty($imageSize) && $imageSize > 2097152 ){
                  $formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
                }
              }

              $countSize = sizeof($formErrors);
              $count     = 0;
              while($count < $countSize){
                echo '<div class="alert alert-warning">' . $formErrors[$count] . '</div>';
                $count++;
              }

              if ( empty($formErrors) ){

                if ( !empty( $imageName ) ){
                    // Change the Image Name
                    $image = rand(0, 999999) . '_' .$imageName;
                    // Upload the Image to its own Folder Location
                    move_uploaded_file($imageTmp, "img\books\\" . $image );

                    if(!empty($sub_cat) || $sub_cat != 0){
                      $sql = "INSERT INTO `books`(`bk_name`, `publisher`, `ISBN`, `edition`, `bk_cat`, `country`, `language`, `bk_image`, `author_id`, `bk_status`) 
                            VALUES ('$bk_name', '$publisher', '$isbn', '$edition', '$sub_cat', '$country', '$language', '$image','$author_id','$status')";
                    }
                    else{
                      $sql = "INSERT INTO `books`(`bk_name`, `publisher`, `ISBN`, `edition`, `bk_cat`, `country`, `language`, `bk_image`, `author_id`, `bk_status`) 
                            VALUES ('$bk_name', '$publisher', '$isbn', '$edition', '$category_id', '$country', '$language', '$image','$author_id','$status')";
                    }
                    $addBook = mysqli_query($db, $sql);

                    if ( $addBook ){
                      header("location: books.php?action=Manage");
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                }
                else{
                  if(!empty($sub_cat) || $sub_cat != 0){
                    $sql = "INSERT INTO `books`(`bk_name`, `publisher`, `ISBN`, `edition`, `bk_cat`, `country`, `language`, `author_id`, `bk_status`) 
                            VALUES ('$bk_name', '$publisher', '$isbn', '$edition', '$sub_cat', '$country', '$language', '$author_id','$status')";
                  }
                  else{
                    $sql = "INSERT INTO `books`(`bk_name`, `publisher`, `ISBN`, `edition`, `bk_cat`, `country`, `language`, `author_id`, `bk_status`) 
                            VALUES ('$bk_name', '$publisher', '$isbn', '$edition', '$category_id', '$country', '$language', '$author_id','$status')";
                  }
                    $addBook = mysqli_query($db, $sql);

                    if ( $addBook ){
                      header("Location: books.php?do=Manage");
                    }
                    else{
                      die("MySQLi Query Failed." . mysqli_error($db));
                    }
                } 
              }

            }
          }
          else if($action == "Edit"){
              ?>
                  <div class="alert alert-info">
                      In Edit
                  </div>
              <?php
          }
          else if($action == "Update"){
              ?>
                  <div class="alert alert-danger">
                      In Update
                  </div>
              <?php
          }
          else if($action == "Delete"){
              ?>  
                  <div class="alert alert-danger">
                      In DELETE
                  </div>
              <?php
          }
        ?>
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php
    include "inc/footer.php";
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
