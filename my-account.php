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
										<div class="col-lg-6 col-12">
											<div class="my__account__wrapper">
												<h3 class="account__title">Register</h3>
												<form action="#">
													<div class="account__form">
														<div class="input__box">
															<label>Email address <span>*</span></label>
															<input type="email">
														</div>
														<div class="input__box">
															<label>Password<span>*</span></label>
															<input type="password">
														</div>
														<div class="form__btn">
															<button>Register</button>
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
									if($row['role'] == 2 && $row['status'] == 1){
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
									else {
										$_SESSION['message'] = "USER NOT AVAILABLE..." ;
										$_SESSION['type'] = "error";
										header("location: index.php?error");
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