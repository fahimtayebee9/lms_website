<?php include "inc/header.php";?>
	
	<!-- Main wrapper -->
	<div class="wrapper" id="wrapper">

		<!-- Header -->
		<?php 
			include "inc/headerMain.php";
		?>
		<!-- //Header -->

		<!-- Start Search Popup -->
		<?php 
			include "inc/search_popup.php";
		?>
		<!-- End Search Popup -->
		
		<?php
			$action = isset($_GET['action']) ? $_GET['action'] : "CheckOut";

			if($action == "CheckOut"){
				if(isset($_GET['book_id'])){
					?>
						<!-- Start Bradcaump area -->
						<div class="ht__bradcaump__area bg-image--4">
							<div class="container">
								<div class="row">
									<div class="col-lg-12">
										<div class="bradcaump__inner text-center">
											<h2 class="bradcaump-title">Borrow Book</h2>
											<nav class="bradcaump-content">
												<a class="breadcrumb_item" href="index.html">Home</a>
												<span class="brd-separetor">/</span>
												<span class="breadcrumb_item active">Booking Information</span>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Bradcaump area -->
						
						<!-- Start Checkout Area -->
						<section class="wn__checkout__area section-padding--lg bg__white">
							<div class="container">
								<?php
									if(!isset($_SESSION['rev_user']) || !isset($_SESSION['email'])){
										?>
											<div class="row">
												<div class="col-lg-12">
													<div class="wn_checkout_wrap">
														<div class="checkout_info">
															<span>Returning Student ? </span>
															<a class="showlogin" href="#">Click here to login</a>
														</div>
														<div class="checkout_login">
															<?php $url = $_SERVER['REQUEST_URI'];?>
															<form class="wn__checkout__form" action="checkout.php?action=SignIn<?php if(strpos($url,'book_id')){ $book_id = $_GET['book_id']; echo "&book_id=".$book_id;}?>" method="POST">
																<p>If you have a account in library, please enter your details in the boxes below.</p>

																<div class="input__box">
																	<label>Username or Email <span>*</span></label>
																	<input type="email" name="email">
																</div>

																<div class="input__box">
																	<label>Password <span>*</span></label>
																	<input type="password" name="password">
																</div>
																<div class="form__btn">
																	<button name="login" type="submit">Login</button>
																	<label class="label-for-checkbox">
																		<input id="rememberme" name="rememberme" value="forever" type="checkbox">
																		<span>Remember me</span>
																	</label>
																	<a href="#">Lost your password?</a>
																</div>
															</form>
														</div>
													</div>
												</div>
											</div>
										<?php
									}
								?>
								<div class="row">
									<div class="col-lg-10 col-md-10 col-12 m-auto">
										<div class="customer_details">
											
											<?php
												include "inc/booking_form.php";
											?>

										</div>
										
									</div>
								</div>
							</div>
						</section>
						<!-- End Checkout Area -->
						
					<?php	
				}
				else {
					$_SESSION['message'] = "Please Select A Book To Borrow";
					$_SESSION['type']    = "warning";
					header("location: shop-grid.php");
					exit();
				}
			}
			else if ($action == "SignUp"){
				?>
					<!-- Start Bradcaump area -->
					<div class="ht__bradcaump__area bg-image--4">
						<div class="container">
							<div class="row">
								<div class="col-lg-12">
									<div class="bradcaump__inner text-center">
										<h2 class="bradcaump-title">Sign Up</h2>
										<nav class="bradcaump-content">
										<a class="breadcrumb_item" href="index.html">Home</a>
										<span class="brd-separetor">/</span>
										<span class="breadcrumb_item active">Sign Up</span>
										</nav>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End Bradcaump area -->
				<?php
			}
			else if($action == "SignIn"){
				if($_SERVER['REQUEST_METHOD'] == "POST"){
					$email 		= $_POST['email'];
					$password 	= sha1($_POST['password']);
					$remember   = $_POST['rememberme'];
					$sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
					$result = mysqli_query($db ,$sql);

					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_assoc($result)){
							$_SESSION['rev_user'] = $row['id'];
							$_SESSION['name'] = $row['name'];
							$_SESSION['email'] = $row['email'];
							$_SESSION['phone'] = $row['phone'];
							$_SESSION['address'] = $row['address'];
							$_SESSION['password'] = $row['password'];
							$_SESSION['image'] = $row['image'];
							$_SESSION['role'] = $row['role'];
							$_SESSION['status'] = $row['status'];
							$_SESSION['new_status'] = $row['new_status'];
							$_SESSION['join_date'] = $row['join_date'];

							if(isset($remember)){
								setcookie("email",$email,time() + (86400 * 30), "/");
								setcookie("password",$password,time() + (86400 * 30), "/");
							}
							else{
								if($row['role'] == 2){
									$_SESSION['message'] = "LOGIN SUCCESS";
									$_SESSION['type'] = "success";
									$full_url    = $_SERVER['REQUEST_URI'];
									$fullUrl_arr = explode('/',$full_url);
									$main_url    = end($fullUrl_arr);
									if(strpos($main_url,'SignIn')){
										$newUrl_arr		 = explode("?",$main_url);
										$newUrl      = $newUrl_arr[0] . "?" . explode('&',$newUrl_arr[1])[1];
										$location    = "location: " . $newUrl;
									}
									else{
										$location    = "location: " . $main_url;
									}
									header($location);
									exit();
								}
							}
						}
					}
					else {
						$_SESSION['message'] = "Invalid Username or password..." ;
						$_SESSION['type'] = "error";
						header("location: index.php?error");
						exit();
					}
				}
			}
			else if($action == "Insert"){
				if(isset($_SESSION['rev_user'])){
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$rev_customizedId = generateNewBookingID();
						$book_id          = $_POST['book_id'];
						$student_id       = $_SESSION['rev_user'];
						$book_from        = $_POST['book_from'];
						$book_to          = $_POST['book_to'];
						$rev_status       = 0;
						$issued_byId      = 0;

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
								header("location: shop-grid.php");
								exit();
							}
						}
						else{
							$_SESSION['message'] = "SOMETHING WENT WRONG...BOOKING NOT CONFIRMED...";
							$_SESSION['type']    = "error";
							header("location: shop-grid.php");
							exit();
						}
					}
					// echo $insert;
				}
				else{
					// $_SESSION['message'] = "SOMETHING WENT WRONG...BOOKING NOT CONFIRMED...";
					// $_SESSION['type']    = "error";
					header("location: shop-grid.php");
					exit();
				}
			}
		?>
        

		<!-- Footer Area -->
		<?php
			include "inc/footer.php";
		?>
		<!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
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