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

        <!-- Start Bradcaump area -->
        <div class="ht__bradcaump__area bg-image--6">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Wishlist</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Wishlist</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- End Bradcaump area -->
		
        <!-- cart-main-area start -->
        <div class="wishlist-area section-padding--lg bg__white">
            <div class="container">
				<?php
					$action = isset( $_GET['action'] ) ? $_GET['action'] : "Manage";
					if($action == "Manage"){
						?>
							<div class="row">
								<div class="col-md-12 col-sm-12 col-xs-12">
									<div class="wishlist-content">
										<form action="#">
											<div class="wishlist-table wnro__table table-responsive">

											<?php
												if(isset($_SESSION['rev_user'])){
													$std_ids = $_SESSION['rev_user'];
													$sql = "SELECT * FROM wishlists WHERE std_id = $std_ids";
													$resWish = mysqli_query($db,$sql);
														?>
															<table>
																<thead>
																	<tr>
																		<th class="product-remove"></th>
																		<th class="product-thumbnail"></th>
																		<th class="product-name"><span class="nobr">Book Name</span></th>
																		<th class="product-price text-center"><span class="nobr"> Author Name </span></th>
																		<th class="product-stock-stauts text-center"><span class="nobr"> Book Status </span></th>
																		<th class="product-add-to-cart text-center"><span class="nobr">Action</span></th>
																	</tr>
																</thead>
																<tbody>
													<?php
														while($row = mysqli_fetch_assoc($resWish)){
															$wbk_id = $row['wbk_id'];
															$getBkInfo = "SELECT * FROM books INNER JOIN authors ON authors.a_id = books.author_id WHERE books.bk_id = $wbk_id";
															$resBookInfo = mysqli_query($db , $getBkInfo);
															while($rowInfo = mysqli_fetch_assoc($resBookInfo)){
																?>
																	<tr>
																		<td class="product-remove"><a href="#">×</a></td>
																		<td class="product-thumbnail"><a href="single-product.php?book_id=<?=$rowInfo['bk_id']?>"><img src="admin/img/books/<?=$rowInfo['bk_image']?>" width="90px" height="105px" alt=""></a></td>
																		<td class="product-name"><a href="single-product.php?book_id=<?=$rowInfo['bk_id']?>"><?=$rowInfo['bk_name']?></a></td>
																		<td class="product-price"><span class="amount"><?=$rowInfo['a_name']?></span></td>
																		<td class="product-stock-status">
																			<?php
																				if($rowInfo['bk_status'] == 1){
																					?>
																						<span class="wishlist-in-stock">Available</span>
																					<?php
																				}
																				else{
																					?>
																						<span class="wishlist-in-stock">Unavailable</span>
																					<?php
																				}
																			?>
																		</td>
																		<td class="product-add-to-cart"><a class="<?php if($rowInfo['bk_status'] == 0){echo "disabled-item";}?>" href="checkout.php?book_id=<?=$rowInfo['bk_id']?>">Borrow Book</a></td>
																	</tr>
																<?php
															}
														}
														?>
																</tbody>
															</table>
														<?php
													}
													else{
														$_SESSION['message'] = "please Login to view your wishlist...";
														$_SESSION['type']	 = "error";
														header("location: my-account.php?action=SignIn");
														exit();
													}
												?>
											</div>  
										</form>
									</div>
								</div>
							</div>
						<?php
					}
					else if($action == "Insert"){
						if(isset($_GET['book_id']) && isset($_SESSION['rev_user'])){
							$book_id = $_GET['book_id'];
							$std_id  = $_SESSION['rev_user'];
							$insSql  = "INSERT INTO `wishlists`(`wish_id`, `std_id`, `wbk_id`) 
										VALUES ('','$std_id','$book_id')";
							$insRes  = mysqli_query($db,$insSql);
							if($insRes){
								$_SESSION['message'] = "Book Added to Wishlist..";
								$_SESSION['type'] = "success";
								header("location: shop-grid.php");
								exit();
							}
						}
						else{
							$_SESSION['message'] = "Please Login First to Add Book in Wishlist..";
							$_SESSION['type'] = "warning";
							header("location: shop-grid.php");
							exit();
						}
					}
				?>
                
            </div>
        </div>
		<!-- cart-main-area end --> 
		
		<!-- Footer Area -->
		<?php include "inc/footer.php";?>
		<!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	<!-- JS Files -->
	<?php include "inc/scripts.php";?>


</body>
</html>