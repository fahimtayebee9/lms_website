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
			if(isset($_SESSION['rev_user'])){
				$rev_user = $_SESSION['rev_user'];
				$sql = "SELECT * FROM users WHERE id = '$rev_user'";
				$result = mysqli_query($db, $sql);
				while($row = mysqli_fetch_assoc($result)){
					$user_image = $row['image'];
					$user_id    = $row['id'];
					$name 		= $row['name'];
					$email 		= $row['email'];
					$phone      = $row['phone'];
					$password   = $row['password'];
					$role 		= $row['role'];
					$status     = $row['status'];
					$join_date  = $row['join_date']; 
					$address    = $row['address'];
				}
				// TERNARY OPERATOR
				$action = isset($_GET['action']) ? $_GET['action'] : "Manage";
				if($action == "Manage"){
					?>
						<!-- Start Bradcaump area -->
						<div class="ht__bradcaump__area bg-image--6">
							<div class="container">
								<div class="row">
									<div class="col-lg-12">
										<div class="bradcaump__inner text-center">
											<h2 class="bradcaump-title">My Account</h2>
											<nav class="bradcaump-content">
											<a class="breadcrumb_item" href="index.html">Home</a>
											<span class="brd-separetor">/</span>
											<span class="breadcrumb_item active">My Account</span>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Bradcaump area -->
						
						<!-- Start My Account Area -->
						<section class="my_account_area pt--80 pb--55 bg--white">
							<div class="container">
								<div class="row">
									<div class="col-lg-6 m-auto col-12">
										<div class="my__account__wrapper text-center">
											<?php
												if(!empty($user_image)){
													?>
														<img src="admin/img/users/<?=$user_image;?>" class="profileIMG" alt="">
													<?php
												}
												else{
													?>
														<img src="admin/img/users/default.jpg" class="profileIMG" alt="">
													<?php
												}
											?>
										</div>
									</div>
									<div class="col-lg-10 pt-5 m-auto  col-12">
										<div class="my__account__wrapper">
											<table class="table table-striped">
												<tbody>
													<tr>
														<th scope="row">Name</th>
														<th> : </th>
														<td><?=$name?></td>
													</tr>
													<tr>
														<th scope="row">Email</th>
														<th> : </th>
														<td><?=$email?></td>
													</tr>
													<tr>
														<th scope="row">Phone</th>
														<th> : </th>
														<td><?=$phone;?></td>
													</tr>
													<tr>
														<th scope="row">Role</th>
														<th> : </th>
														<td>
															<?php
																if($role == 2){
																	?>
																		<p class="m-0 badge badge-info">STUDENT</p>
																	<?php
																}
															?>
														</td>
													</tr>
													<tr>
														<th scope="row">Status</th>
														<th> : </th>
														<td>
															<?php
																if($status == 1){
																	?>
																		<p class="m-0 badge badge-info">ACTIVE</p>
																	<?php
																}
																else{
																	?>
																		<p class="m-0 badge badge-danger">INACTIVE</p>
																	<?php
																}
															?>
														</td>
													</tr>
													<tr>
														<th scope="row">Join Date</th>
														<th> : </th>
														<td><?=date("d M, Y",strtotime($join_date))?></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="col-lg-6 col-sm-8 col-md-8 text-center justify-content-between m-auto pt-3">
										<a class="btn btn-info text-light" href="my-account.php?action=BorrowList">View Borrow List</a>
										<a class="btn btn-warning text-light" href="my-account.php?action=ChangeInfo">Change Information</a>
										<a class="btn btn-danger text-light" href="inc/logout.php">Sign Out</a>
									</div>
								</div>
							</div>
						</section>
						<!-- End My Account Area -->
					<?php
				}
				else if($action == "ChangeInfo"){
					?>
						<!-- Start Bradcaump area -->
						<div class="ht__bradcaump__area bg-image--6">
							<div class="container">
								<div class="row">
									<div class="col-lg-12">
										<div class="bradcaump__inner text-center">
											<h2 class="bradcaump-title">Account Information</h2>
											<nav class="bradcaump-content">
											<a class="breadcrumb_item" href="index.html">Home</a>
											<span class="brd-separetor">/</span>
											<span class="breadcrumb_item active">Account Settings</span>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Bradcaump area -->

						<!-- Start My Account Area -->
						<section class="my_account_area pt--80 pb--55 bg--white">
							<div class="container">
								<div class="row">
									<div class="col-lg-10 m-auto col-12">
										<div class="my__account__wrapper">
											<form action="my-account.php?action=Update" method="POST">
												<div class="account__form">
													<div class="row">
														<div class="col-md-6">
															<div class="input__box">
																<label class="font-weight-bold">Name</label>
																<input type="text" name="name" value="<?=$name?>">
															</div>
															<div class="input__box">
																<label class="font-weight-bold">Username or email address</label>
																<input type="email" name="email" value="<?=$email?>">
															</div>
															<div class="input__box">
																<label class="font-weight-bold">Password</label>
																<input type="password" name="password" >
															</div>
															<div class="input__box">
																<label class="font-weight-bold">Profile Picture</label>
																<input type="file" name="picture" class="form-control-file border-none">
															</div>
														</div>
														<div class="col-md-6">
															<div class="input__box">
																<label class="font-weight-bold">Phone</label>
																<input type="text" name="phone" value="<?=$phone?>">
															</div>
															<div class="input__box">
																<label class="font-weight-bold">Address</label>
																<input type="text" name="address" value="<?=$address?>">
															</div>
															<div class="input__box">
																<label class="font-weight-bold">Confirm Password</label>
																<input type="password" name="confrimPassword" >
															</div>
														</div>
														<div class="col-md-6 m-auto text-center">
															<div class="form__btn d-block">
																<label class="label-for-checkbox mt-3 mb-3 align-items-center">
																	<input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
																	<span>Remember me</span>
																</label>
																<br>
																<button class=" text-center">Login</button>
															</div>
														</div>
													</div>
													
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</section>
						<!-- End My Account Area -->
					<?php
				}
				else if($action == "BorrowList"){
					?>
						<!-- Start Bradcaump area -->
						<div class="ht__bradcaump__area bg-image--6">
							<div class="container">
								<div class="row">
									<div class="col-lg-12">
										<div class="bradcaump__inner text-center">
											<h2 class="bradcaump-title">My Borrowings</h2>
											<nav class="bradcaump-content">
											<a class="breadcrumb_item" href="index.html">Home</a>
											<span class="brd-separetor">/</span>
											<span class="breadcrumb_item active">My Borrowings</span>
											</nav>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- End Bradcaump area -->
						
						<!-- Start My Account Area -->
						<section class="my_account_area pt--80 pb--55 bg--white">
							<div class="container">
								<div class="row">
									<div class="col-lg-10 pt-5 m-auto  col-12">
										<div class="my__account__wrapper">
											<table class="table table-striped">
												<thead>
													<tr>
														<th scope="col">SL#</th>
														<th scope="col">Book Name</th>
														<th scope="col">Author Name</th>
														<th scope="col">Borrowed On</th>
														<th scope="col">Returned On</th>
														<th scope="col">Status</th>
													</tr>
												</thead>
												<tbody>
													<?php
														$bookingsSQL = "SELECT * FROM book_reservations INNER JOIN books ON books.bk_id = book_reservations.book_id
																		INNER JOIN authors ON authors.a_id = books.author_id WHERE book_reservations.rev_user = $rev_user";
														$resBookings = mysqli_query($db,$bookingsSQL);
														while($rowBooking = mysqli_fetch_assoc($resBookings)){
															?>
																<tr>
																	<th scope="row"><?=$rowBooking['rev_customized']?></th>
																	<td><?=$rowBooking['bk_name']?></td>
																	<td><?=$rowBooking['a_name']?></td>
																	<td><?=date("d M, Y", strtotime($rowBooking['borrowed_From']))?></td>
																	<td>
																		<?php
																			if(!empty($rowBooking['actual_Return'])){
																				echo date("d M, Y", strtotime($rowBooking['actual_Return']));
																			}
																			else{
																				echo "-";
																			}
																		?>
																	</td>
																	<td>
																		<?php
																			if($rowBooking['rev_status'] == 0){
																				?>
																					<p class="m-0 badge badge-success">RETURNED</p>
																				<?php
																			}
																			else{
																				?>
																					<p class="m-0 badge badge-warning">NOT RETURNED</p>
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
									</div>
									<div class="col-lg-6 col-sm-8 col-md-8 text-center justify-content-between m-auto pt-3">
										<a class="btn btn-info text-light" href="my-account.php?action=Manage">Go Back</a>
									</div>
								</div>
							</div>
						</section>
						<!-- End My Account Area -->
					<?php
				}
			}
			else{
				$action = isset($_GET['action']) ? $_GET['action'] : "Manage";
				if($action == "SignIn"){
					if(!isset($_SESSION['rev_user'])){
						?>
							<!-- Start Bradcaump area -->
							<div class="ht__bradcaump__area bg-image--6">
								<div class="container">
									<div class="row">
										<div class="col-lg-12">
											<div class="bradcaump__inner text-center">
												<h2 class="bradcaump-title">Sign In</h2>
												<nav class="bradcaump-content">
												<a class="breadcrumb_item" href="index.html">Home</a>
												<span class="brd-separetor">/</span>
												<span class="breadcrumb_item active">Sign In</span>
												</nav>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- End Bradcaump area -->
	
							<!-- Start My Account Area -->
							<section class="my_account_area pt--80 pb--55 bg--white">
								<div class="container">
									<div class="row">
										<div class="col-lg-7 m-auto col-12">
											<div class="my__account__wrapper">
												
												<form action="my-account.php?action=Login" method="POST">
													<div class="account__form">
														<div class="input__box">
															<label class="font-weight-bold">Username or email address <span>*</span></label>
															<input type="text" name="email">
														</div>
														<div class="input__box">
															<label class="font-weight-bold">Password<span>*</span></label>
															<input type="password" name="password">
														</div>
														<div class="form__btn">
															<button>Login</button>
															<label class="label-for-checkbox">
																<input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
																<span>Remember me</span>
															</label>
														</div>
														<a class="forget_pass" href="#">Lost your password?</a>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- End My Account Area -->
						<?php
					}
					else{
						$_SESSION['message'] = "Already Logged In";
						$_SESSION['type']    = "warning";
						header("location: index.php");
						exit();
					}
				}
				else if($action == "SignUp"){
					if(!isset($_SESSION['rev_user'])){
						?>
							<!-- Start Bradcaump area -->
							<div class="ht__bradcaump__area bg-image--6">
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
	
							<!-- Start My Account Area -->
							<section class="my_account_area pt--80 pb--55 bg--white">
								<div class="container">
									<div class="row">
										<div class="col-lg-10 m-auto col-12">
											<div class="my__account__wrapper">
												<form action="my-account.php?action=InsertUser" method="POST" enctype="multipart/form-data">
													<div class="account__form">
														<div class="row">
															<div class="col-md-6">
																<div class="input__box">
																	<label class="font-weight-bold">Name</label>
																	<input type="text" name="name" >
																</div>
																<div class="input__box">
																	<label class="font-weight-bold">Username or email address</label>
																	<input type="email" name="email" >
																</div>
																<div class="input__box">
																	<label class="font-weight-bold">Password</label>
																	<input type="password" name="password" >
																</div>
																<div class="input__box">
																	<label class="font-weight-bold">Profile Picture</label>
																	<input type="file" name="picture" class="form-control-file border-none">
																</div>
															</div>
															<div class="col-md-6">
																<div class="input__box">
																	<label class="font-weight-bold">Phone</label>
																	<input type="text" name="phone" >
																</div>
																<div class="input__box">
																	<label class="font-weight-bold">Address</label>
																	<input type="text" name="address" >
																</div>
																<div class="input__box">
																	<label class="font-weight-bold">Confirm Password</label>
																	<input type="password" name="repassword" >
																</div>
															</div>
															<div class="col-md-6 m-auto text-center">
																<div class="form__btn d-block">
																	<label class="label-for-checkbox mt-3 mb-3 align-items-center">
																		<input id="rememberme" class="input-checkbox" name="rememberme" value="forever" type="checkbox">
																		<span>I accept the term & policies of the library</span>
																	</label>
																	<br>
																	<button type="submit" name="signup" class="text-center">Sign Up</button>
																</div>
															</div>
														</div>
														
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</section>
							<!-- End My Account Area -->
						<?php
					}
					else{
						$_SESSION['message'] = "Already Logged In";
						$_SESSION['type']    = "warning";
						header("location: index.php");
						exit();
					}
				}
				else if($action == "Login"){
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						$email 		= $_POST['email'];
						$password 	= sha1($_POST['password']);
						$remember   = $_POST['rememberme'];
						$sql = "SELECT * FROM `users` WHERE email = '$email' AND password = '$password'";
						$result = mysqli_query($db ,$sql);
	
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_assoc($result)){
								if(isset($remember)){
									setcookie("email",$email,time() + (86400 * 30), "/");
									setcookie("password",$password,time() + (86400 * 30), "/");
								}
								else{
									if($row['status'] == 0){
										$_SESSION['message'] = "USER NOT AVAILABLE..." ;
										$_SESSION['type'] = "error";
										header("location: my-account.php?action=SignIn");
										exit();
										break;
									}
									else if($row['role'] == 2 && $row['status'] == 1){
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
										
										$_SESSION['message'] = "LOGIN SUCCESS";
										$_SESSION['type'] = "success";
										$full_url    = $_SERVER['REQUEST_URI'];
										$fullUrl_arr = explode('/',$full_url);
										$main_url    = end($fullUrl_arr);
										if(strpos($main_url,'Login')){
											$newUrl_arr		 = explode("?",$main_url);
											$newUrl      = $newUrl_arr[0];
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
				else if($action == "InsertUser"){
					if($_SERVER['REQUEST_METHOD'] == "POST"){
						if(isset($_POST['rememberme'])){
							$name         = $_POST['name'];
							$email        = $_POST['email'];
							$password     = $_POST['password'];
							$repassword   = $_POST['repassword'];
							$address      = $_POST['address'];
							$phone        = $_POST['phone'];
							$role         = 2;
							$status       = 0;

							// Preapre the Image
							$imageName    = $_FILES['picture']['name'];
							$imageSize    = $_FILES['picture']['size'];
							$imageTmp     = $_FILES['picture']['tmp_name'];

							$imageAllowedExtension = array("jpg", "jpeg", "png");
							$ext_arr = explode('.', $imageName);
							$imageExtension = strtolower( end( $ext_arr ) );
							
							$formErrors = array();

							if ( strlen($name) < 3 ){
								$formErrors[] = 'Username is too short!!!';
							}
							if ( $password != $repassword ){
								$formErrors[] = 'Password Doesn\'t match!!!';
							}
							if ( !empty($imageName) ){
								if ( !empty($imageName) && !in_array($imageExtension, $imageAllowedExtension) ){
									$formErrors[] = 'Invalid Image Format. Please Upload a JPG, JPEG or PNG image';
								}
								if ( !empty($imageSize) && $imageSize > 2097152 ){
									$formErrors[] = 'Image Size is Too Large! Allowed Image size Max is 2 MB.';
								}
							}

							// Print the Errors 
							foreach( $formErrors as $error ){
								echo '<div class="alert alert-warning">' . $error . '</div>';
							}

							if ( empty($formErrors) ){
								// Encrypted Password
								$hassedPass = sha1($password);

								if ( !empty( $imageName ) ){
									// Change the Image Name
									$image = rand(0, 999999) . '_' .$imageName;
									// Upload the Image to its own Folder Location
									move_uploaded_file($imageTmp, "admin/img/users/" . $image );

									$sql = "INSERT INTO users ( name, email, password, address, phone, role, status, image, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', '$image', now() )";

									$addUser = mysqli_query($db, $sql);

									if ( $addUser ){
										$_SESSION['message'] = "Registration Successfull. Please Wait For Verification..";
										$_SESSION['type']    = "success";
										header("location: my-account.php?action=SignIn");
										exit();
									}
									else{
										die("MySQLi Query Failed." . mysqli_error($db));
									}
								}
								else{
									$sql = "INSERT INTO users ( name, email, password, address, phone, role, status, join_date ) VALUES ('$name', '$email', '$hassedPass', '$address', '$phone', '$role', '$status', now() )";

									$addUser = mysqli_query($db, $sql);

									if ( $addUser ){
										$_SESSION['message'] = "Registration Successfull. Please Wait For Verification..";
										$_SESSION['type']    = "success";
										header("location: my-account.php?action=SignIn");
										exit();
									}
									else{
										die("MySQLi Query Failed." . mysqli_error($db));
									}

								}
								
							}
							else{
								$_SESSION['message_arr'] = $formErrors;
								$_SESSION['type']    = "error";
								header("location: my-account.php?action=SignUp");
								exit();
							}
						}
						else{
							$_SESSION['message'] = "Terms And Policies Not Accepted..";
							$_SESSION['type']    = "error";
							header("location: my-account.php?action=SignUp");
							exit();
						}
					}
				}
				else{
					$_SESSION['message'] = "Please Sign In To View Account..";
					$_SESSION['type']    = "error";
					header("location: my-account.php?action=SignIn");
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