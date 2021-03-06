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
		
        <!-- Start Slider area -->
        <div class="slider-area brown__nav slider--15 slide__activation slide__arrow01 owl-carousel owl-theme">
        	<!-- Start Single Slide -->
	        <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-lg-12">
	            			<div class="slider__content">
		            			<div class="contentbox">
		            				<h2>Buy <span>your </span></h2>
		            				<h2>favourite <span>Book </span></h2>
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="shop-grid.php">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
            <!-- End Single Slide -->
        	<!-- Start Single Slide -->
	        <div class="slide animation__style10 bg-image--7 fullscreen align__center--left">
	            <div class="container">
	            	<div class="row">
	            		<div class="col-lg-12">
	            			<div class="slider__content">
		            			<div class="contentbox">
		            				<h2>Buy <span>your </span></h2>
		            				<h2>favourite <span>Book </span></h2>
		            				<h2>from <span>Here </span></h2>
				                   	<a class="shopbtn" href="#">shop now</a>
		            			</div>
	            			</div>
	            		</div>
	            	</div>
	            </div>
            </div>
            <!-- End Single Slide -->
        </div>
		<!-- End Slider area -->
		
		<!-- Start Available BOOKS Area -->
		<section class="wn__product__area brown--color pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">New <span class="color--theme">Products</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<!-- Start Single Tab Content -->
				<div class="furniture--4 border--round arrows_style owl-carousel owl-theme row mt--50">
					
					
					<?php
						$bookSql = "SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id ";
						$res_books = mysqli_query($db,$bookSql);
						$cn = 0;
						while($rowBk = mysqli_fetch_assoc($res_books)){
								$bk_name = $rowBk['bk_name'];
								$bk_image = $rowBk['bk_image'];
								$bk_status = $rowBk['bk_status'];
								$bk_id     = $rowBk['bk_id'];
							?>
								<!-- Start Single Product -->
								<div class="col-lg-3 col-md-4 col-sm-6 col-12">
									<div class="product product__style--3">
										<div class="product__thumb">
											<a class="first__img" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
											<a class="second__img animation1" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
											<div class="hot__box">
												<span class="hot-label">BEST SALLER</span>
											</div>
										</div>
										<div class="product__content content--center">
											<h4><a href="single-product.html"><?=$bk_name?></a></h4>
											<ul class="prize d-block">
												<li><?=$rowBk['a_name']?></li>
												<li class="prize">
													<?php
														if($bk_status == 1){
															echo "Available";
														}
														else{
															echo "Unavailable";
														}
													?>
												</li>
											</ul>
											<div class="action">
												<div class="actions_inner">
													<ul class="add_to_links">
														<li><a class="cart <?php if($bk_status == 0){echo "disabled-item";}?>" href="checkout.php?book_id=<?=$rowBk['bk_id']?>"><i class="bi bi-shopping-bag4"></i></a></li>
														<li><a class="wishlist" href="wishlist.php?action=Insert&book_id=<?=$rowBook['bk_id']?>"><i class="bi bi-shopping-cart-full"></i></a></li>
														<!-- <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li> -->
														<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal<?=$bk_id?>"><i class="bi bi-search"></i></a></li>
													</ul>
												</div>
											</div>
											<div class="product__hover--content">
												<ul class="rating d-flex">
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li class="on"><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
													<li><i class="fa fa-star-o"></i></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
								<!-- Start Single Product -->
							<?php
						}
					?>


				</div>
				<!-- End Single Tab Content -->
			</div>
		</section>
		<!-- Start Available BOOKS Area -->

		
		<!-- Start NEwsletter Area -->
		<section class="wn__newsletter__area bg-image--2">
			<div class="container">
				<div class="row">
					<div class="col-lg-7 offset-lg-5 col-md-12 col-12 ptb--150">
						<div class="section__title text-center">
							<h2>Stay With Us</h2>
						</div>
						<div class="newsletter__block text-center">
							<p>Subscribe to our newsletters now and stay up-to-date with new collections, the latest lookbooks and exclusive offers.</p>
							<form action="#">
								<div class="newsletter__box">
									<input type="email" placeholder="Enter your e-mail">
									<button>Subscribe</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End NEwsletter Area -->

		<!-- Start TAB CONTENT Area -->
		<section class="wn__bestseller__area bg--white pt--80  pb--30">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">All <span class="color--theme">Books</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<!-- CATEGORIES -->
				<div class="row mt--50">
					<div class="col-md-12 col-lg-12 col-sm-12">
						<div class="product__nav nav justify-content-center" role="tablist">
							<a class="nav-item nav-link active" data-toggle="tab" href="#nav-all" role="tab">ALL</a>
							<?php 
								$catSql = "SELECT * FROM category";
								$res_cat = mysqli_query($db,$catSql);
								while($cat = mysqli_fetch_assoc($res_cat)){
									$catId = $cat['cat_id'];
									$booksCount = $db->query("SELECT * FROM books WHERE bk_cat = $catId")->num_rows;
									if($booksCount > 0){
										?>
										<a class="nav-item nav-link" data-toggle="tab" href="#nav-<?=strtolower($cat['cat_name'])?>" role="tab"><?=$cat['cat_name']?></a>
										<?php
									}
								}
							?>
                        </div>
					</div>
				</div>
				<div class="tab__container mt--60">
					<!-- Start Single Tab Content -->
					<div class="row single__tab tab-pane fade show active" id="nav-all" role="tabpanel">
						<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
							<!-- <div class="single__product"> -->
							<?php
								$bookSql = "SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id ";
								$res_books = mysqli_query($db,$bookSql);
								$cn = 0;
								while($rowBk = mysqli_fetch_assoc($res_books)){
										$bk_name = $rowBk['bk_name'];
										$bk_image = $rowBk['bk_image'];
										$bk_status = $rowBk['bk_status'];
										$bk_id     = $rowBk['bk_id'];
									?>
									<div class="single__product">
										<!-- Start Single Product -->
										<div class="col-lg-3 col-md-4 col-sm-6 col-12">
											<div class="product product__style--3">
												<div class="product__thumb">
													<a class="first__img" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
													<a class="second__img animation1" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
													<div class="hot__box">
														<span class="hot-label">BEST SALLER</span>
													</div>
												</div>
												<div class="product__content content--center">
													<h4><a href="single-product.html"><?=$bk_name?></a></h4>
													<ul class="prize d-block">
														<li><?=$rowBk['a_name']?></li>
														<li class="prize">
															<?php
																if($bk_status == 1){
																	echo "Available";
																}
																else{
																	echo "Unavailable";
																}
															?>
														</li>
													</ul>
													<div class="action">
														<div class="actions_inner">
															<ul class="add_to_links">
																<li><a class="cart <?php if($bk_status == 0){echo "disabled-item";}?>" href="checkout.php?book_id=<?=$rowBk['bk_id']?>"><i class="bi bi-shopping-bag4"></i></a></li>
																<li><a class="wishlist" href="wishlist.php?action=Insert&book_id=<?=$rowBook['bk_id']?>"><i class="bi bi-shopping-cart-full"></i></a></li>
																<!-- <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li> -->
																<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal<?=$bk_id?>"><i class="bi bi-search"></i></a></li>
															</ul>
														</div>
													</div>
												</div>
											</div>
										</div>
										<!-- Start Single Product -->
									</div>
									<?php
								}
							?>
							<!-- </div> -->
						</div>
					</div>
					<!-- End Single Tab Content -->
					<?php 
						$catSqls = "SELECT * FROM category";
						$res_cats = mysqli_query($db,$catSqls);
						while($cats = mysqli_fetch_assoc($res_cats)){
							$catIds = $cats['cat_id'];
							$booksCounts = $db->query("SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id WHERE bk_cat = $catIds")->num_rows;
							// echo "<br>" . $booksCounts . "<br>";
							if($booksCounts > 0){
								?>
								<!-- Start Single Tab Content -->
								<div class="row single__tab tab-pane fade show" id="nav-<?=strtolower($cats['cat_name'])?>" role="tabpanel">
									<div class="product__indicator--4 arrows_style owl-carousel owl-theme">
										
								<?php
								$bookSql = "SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id WHERE bk_cat = $catIds";
								$res_books = mysqli_query($db,$bookSql);
								while($rowBook = mysqli_fetch_assoc($res_books)){
									$bk_name = $rowBook['bk_name'];
									$bk_image = $rowBook['bk_image'];
									$bk_status = $rowBook['bk_status'];
									$bk_id = $rowBook['bk_id'];
									?>
										<div class="single__product">
											<!-- Start Single Product -->
											<div class="col-lg-3 col-md-4 col-sm-6 col-12">
												<div class="product product__style--3">
													<div class="product__thumb">
														<a class="first__img" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
														<a class="second__img animation1" href="single-product.html"><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
														<div class="hot__box">
															<span class="hot-label">BEST SALLER</span>
														</div>
													</div>
													<div class="product__content content--center">
														<h4><a href="single-product.html"><?=$bk_name?></a></h4>
														<ul class="prize d-block">
															<li><?=$rowBook['a_name']?></li>
															<li class="prize">
																<?php
																	if($bk_status == 1){
																		echo "Available";
																	}
																	else{
																		echo "Unavailable";
																	}
																?>
															</li>
														</ul>
														<div class="action">
															<div class="actions_inner">
																<ul class="add_to_links">
																	<li><a class="cart <?php if($bk_status == 0){echo "disabled-item";}?>" href="checkout.php?book_id=<?=$bk_id?>"><i class="bi bi-shopping-bag4"></i></a></li>
																	<li><a class="wishlist" href="wishlist.php?action=Insert&book_id=<?=$rowBook['bk_id']?>"><i class="bi bi-shopping-cart-full"></i></a></li>
																	<!-- <li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li> -->
																	<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal<?=$bk_id?>"><i class="bi bi-search"></i></a></li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
											<!-- Start Single Product -->
										</div>

										
									<?php
								}
								?>

									</div>
								</div>
								<!-- End Single Tab Content -->

								<?php
							}
						}
					?>
				</div>
			</div>
		</section>
		<!-- END TAB CONTENT Area -->

		
		<!-- Start Recent Post Area -->
		<section class="wn__recent__post bg--gray ptb--80">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="section__title text-center">
							<h2 class="title__be--2">Our <span class="color--theme">Blog</span></h2>
							<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered lebmid alteration in some ledmid form</p>
						</div>
					</div>
				</div>
				<div class="row mt--50">
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">International activities of the Frankfurt Book </a></h3>
								<p>We are proud to announce the very first the edition of the frankfurt news.We are proud to announce the very first of  edition of the fault frankfurt news for us.</p>
								<div class="post__time">
									<span class="day">Dec 06, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">Reading has a signficant info  number of benefits</a></h3>
								<p>Find all the information you need to ensure your experience.Find all the information you need to ensure your experience . Find all the information you of.</p>
								<div class="post__time">
									<span class="day">Mar 08, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6 col-lg-4 col-sm-12">
						<div class="post__itam">
							<div class="content">
								<h3><a href="blog-details.html">The London Book Fair is to be packed with exciting </a></h3>
								<p>The London Book Fair is the global area inon marketplace for rights negotiation.The year  London Book Fair is the global area inon forg marketplace for rights.</p>
								<div class="post__time">
									<span class="day">Nov 11, 18</span>
									<div class="post-meta">
										<ul>
											<li><a href="#"><i class="bi bi-love"></i>72</a></li>
											<li><a href="#"><i class="bi bi-chat-bubble"></i>27</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End Recent Post Area -->
		
		<!-- QUICKVIEW PRODUCT -->
		<?php
			include "inc/quickview.php";
		?>
		<!-- END QUICKVIEW PRODUCT -->


		<!-- FOOTER -->
		<?php include "inc/footer.php";?>
		
		


	</div>
	<!-- //Main wrapper -->
	<?php include "inc/scripts.php";?>

</body>
</html>