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
                        	<h2 class="bradcaump-title">Library Books</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.php">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Books List</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Bradcaump area -->
        <!-- Start Shop Page -->
        <div class="page-shop-sidebar left--sidebar bg--white section-padding--lg">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-3 col-12 order-2 order-lg-1 md-mt-40 sm-mt-40">
						<?php
						 	include "inc/sidebarMain.php"; 
						?>
        			</div>
        			<div class="col-lg-9 col-12 order-1 order-lg-2">
						<?php
							$total_rows = $db->query("SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id")->num_rows;

							$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

							$rows_per_page = 20;

							if($statement = $db->prepare("SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id LIMIT ?,?") ){
								$cal_page = ($current_page - 1) * $rows_per_page;
								$statement->bind_param("ii",$cal_page,$rows_per_page);
								$statement->execute();
								$allbooks = $statement->get_result();
							}
						?>
        				<div class="row">
        					<div class="col-lg-12">
								<div class="shop__list__wrapper d-flex flex-wrap flex-md-nowrap justify-content-between">
									<div class="shop__list nav justify-content-center" role="tablist">
			                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-grid" role="tab"><i class="fa fa-th"></i></a>
			                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-list" role="tab"><i class="fa fa-list"></i></a>
			                        </div>
			                        <p>Showing <?=($cal_page+1)?>–<?php if($rows_per_page > $total_rows){echo $total_rows;}else{echo $rows_per_page;}?> of <?=$total_rows?> results</p>
			                        <div class="orderby__wrapper">
			                        	<span>Sort By</span>
			                        	<select class="shot__byselect">
			                        		<option value="bk_id ASC">Default sorting</option>
			                        		<option value="bk_cat DESC">Category (Last - First)</option>
			                        		<option value="bk_cat ASC">Category (First - Last)</option>
			                        		<option value="booking_count DESC">Mosty Bookings</option>
			                        	</select>
			                        </div>
		                        </div>
        					</div>
        				</div>
        				<div class="tab__container">
	        				<div class="shop-grid tab-pane fade show active" id="nav-grid" role="tabpanel">
								
	        					<div class="row">
									<?php
										while($rowBk = mysqli_fetch_assoc($allbooks)){
											$bk_name = $rowBk['bk_name'];
											$bk_image = $rowBk['bk_image'];
											$bk_status = $rowBk['bk_status'];
											$bk_id     = $rowBk['bk_id'];
											?>

												<!-- Start Single Product -->
												<div class="col-lg-3 col-md-4 col-sm-6 col-12">
													<div class="product product__style--3">
														<div class="product__thumb">
															<a class="first__img" href=""><img src="admin/img/books/<?=$bk_image?>" alt="product image"></a>
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
																		<li><a class="cart" href="cart.html"><i class="bi bi-shopping-bag4"></i></a></li>
																		<li><a class="wishlist" href="wishlist.html"><i class="bi bi-shopping-cart-full"></i></a></li>
																		<li><a class="compare" href="#"><i class="bi bi-heart-beat"></i></a></li>
																		<li><a data-toggle="modal" title="Quick View" class="quickview modal-view detail-link" href="#productmodal"><i class="bi bi-search"></i></a></li>
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
								
								<!-- PAGINATION START -->
								<?php if( ceil($total_rows / $rows_per_page) > 0) : ?>
                                        <ul class="wn__pagination">

                                            <!-- PREVIOUS BUTTON -->
                                            <?php if($current_page > 1) : ?>
                                                <li class="">
                                                    <a class="" href="shop-grid.php?page=<?=($current_page-1)?>" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-left"></i></a>
                                                </li>
                                            <?php else : ?>
                                                <li class="">
                                                    <a class="disabled-item" href="" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-left"></i></a>
                                                </li>
                                            <?php endif;?>

                                            <?php if($current_page - 2 > 0) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_page - 2 )?>"><?=($current_page - 2 )?></a></li>
                                            <?php endif;?>

                                            <?php if($current_page - 1 > 0) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_page - 1 )?>"><?=($current_page - 1 )?></a></li>
                                            <?php endif;?>

                                            <li class="active"><a class="" href="shop-grid.php?page=<?=$current_page?>"><?=$current_page?></a></li>

                                            <?php if($current_page + 1 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_page + 1 )?>"><?=($current_page + 1 )?></a></li>
                                            <?php endif;?>

                                            <?php if($current_page + 2 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_page + 2 )?>"><?=($current_page + 2 )?></a></li>
                                            <?php endif;?>
                                            
                                            <!-- NEXT BUTTON -->
                                            <?php if($current_page < ceil($total_rows / $rows_per_page)) : ?>
                                                <li class="">
                                                    <a class="" href="shop-grid.php?page=<?=($current_page + 1 )?>" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-right"></i></a>
                                                </li>
                                            <?php else : ?>
                                                <li class="">
                                                    <a class="disabled-item" href="" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-right"></i></a>
                                                </li>
                                            <?php endif;?>
                                        </ul>
                                    </nav>
								<?php endif;?>
								<!-- PAGINATION END -->

	        				</div>
	        				<div class="shop-grid tab-pane fade" id="nav-list" role="tabpanel">
	        					<div class="list__view__wrapper">
									<?php
										$total_rowsNew = $db->query("SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id")->num_rows;

										$current_pages = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

										$rows_per_pages = 20;

										if($statements = $db->prepare("SELECT DISTINCT books.bk_id, books.* , authors.*  FROM books INNER JOIN authors ON books.author_id = authors.a_id LIMIT ?,?") ){
											$cal_pages = ($current_pages - 1) * $rows_per_pages;
											$statements->bind_param("ii",$cal_page,$rows_per_pages);
											$statements->execute();
											$allbooksList = $statements->get_result();
										}

										while($rowBks = mysqli_fetch_assoc($allbooksList)){
											$bk_name = $rowBks['bk_name'];
											$bk_image = $rowBks['bk_image'];
											$bk_status = $rowBks['bk_status'];
											$bk_id     = $rowBks['bk_id'];
											?>
												<!-- Start Single Product -->
												<div class="list__view mt--40">
													<div class="thumb">
														<a class="first__img" href="single-product.php?action=View&view_id=<?=$bk_id?>"><img src="admin/img/books/<?=$bk_image?>" alt="product images"></a>
														<a class="second__img animation1" href="single-product.html"><img src="images/product/4.jpg" alt="product images"></a>
													</div>
													<div class="content">
														<h2><a href="single-product.html"><?=$bk_name?></a></h2>
														<ul class="rating d-flex">
															<li class="on"><i class="fa fa-star-o"></i></li>
															<li class="on"><i class="fa fa-star-o"></i></li>
															<li class="on"><i class="fa fa-star-o"></i></li>
															<li class="on"><i class="fa fa-star-o"></i></li>
															<li><i class="fa fa-star-o"></i></li>
															<li><i class="fa fa-star-o"></i></li>
														</ul>
														<ul class="prize__box">
															<li><?=$rowBks['a_name']?></li>
															<li class="prize">
																<?php
																	if($bk_status == 1){
																		?>
																			<p class="m-0">Available</p>
																		<?php
																	}
																	else{
																		?>
																			<p class="m-0">Unavailable</p>
																		<?php
																	}
																?>
															</li>
														</ul>
														<p><?=substr($rowBks['a_desc'],0,150)?></p>
														<ul class="cart__action d-flex">
															<li class="cart"><a href="cart.php">Borrow Book</a></li>
															<li class="wishlist"><a href="cart.html"></a></li>
															<li class="compare"><a href="cart.html"></a></li>
														</ul>

													</div>
												</div>
												<!-- End Single Product -->

											<?php
										}
									?>
									
								</div>
								<!-- PAGINATION START -->
								<?php if( ceil($total_rowsNew / $rows_per_pages) > 0) : ?>
                                        <ul class="wn__pagination">

                                            <!-- PREVIOUS BUTTON -->
                                            <?php if($current_pages > 1) : ?>
                                                <li class="">
                                                    <a class="" href="shop-grid.php?page=<?=($current_pages-1)?>" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-left"></i></a>
                                                </li>
                                            <?php else : ?>
                                                <li class="">
                                                    <a class="disabled-item" href="" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-left"></i></a>
                                                </li>
                                            <?php endif;?>

                                            <?php if($current_pages - 2 > 0) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_pages - 2 )?>"><?=($current_pages - 2 )?></a></li>
                                            <?php endif;?>

                                            <?php if($current_pages - 1 > 0) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_pages - 1 )?>"><?=($current_pages - 1 )?></a></li>
                                            <?php endif;?>

                                            <li class="active"><a class="" href="shop-grid.php?page=<?=$current_pages?>"><?=$current_pages?></a></li>

                                            <?php if($current_pages + 1 < ceil($total_rows / $rows_per_page) + 1 ) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_pages + 1 )?>"><?=($current_pages + 1 )?></a></li>
                                            <?php endif;?>

                                            <?php if($current_pages + 2 < ceil($total_rowsNew / $rows_per_pages) + 1 ) : ?>
                                                <li class=""><a class="" href="shop-grid.php?page=<?=($current_pages + 2 )?>"><?=($current_pages + 2 )?></a></li>
                                            <?php endif;?>
                                            
                                            <!-- NEXT BUTTON -->
                                            <?php if($current_pages < ceil($total_rowsNew / $rows_per_pages)) : ?>
                                                <li class="">
                                                    <a class="" href="shop-grid.php?page=<?=($current_pages + 1 )?>" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-right"></i></a>
                                                </li>
                                            <?php else : ?>
                                                <li class="">
                                                    <a class="disabled-item" href="" tabindex="-1" aria-disabled="true"><i class="zmdi zmdi-chevron-right"></i></a>
                                                </li>
                                            <?php endif;?>
                                        </ul>
                                    </nav>
								<?php endif;?>
								<!-- PAGINATION END -->
	        				</div>
        				</div>
        			</div>
        		</div>
        	</div>
        </div>
		<!-- End Shop Page -->
		

		<!-- Footer Area -->
		<?php include "inc/footer.php";?>
		<!-- //Footer Area -->

		<!-- QUICKVIEW PRODUCT -->
		<div id="quickview-wrapper">
		    <!-- Modal -->
		    <div class="modal fade" id="productmodal" tabindex="-1" role="dialog">
		        <div class="modal-dialog modal__container" role="document">
		            <div class="modal-content">
		                <div class="modal-header modal__header">
		                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                </div>
		                <div class="modal-body">
		                    <div class="modal-product">
		                        <!-- Start product images -->
		                        <div class="product-images">
		                            <div class="main-image images">
		                                <img alt="big images" src="images/product/big-img/1.jpg">
		                            </div>
		                        </div>
		                        <!-- end product images -->
		                        <div class="product-info">
		                            <h1>Simple Fabric Bags</h1>
		                            <div class="rating__and__review">
		                                <ul class="rating">
		                                    <li><span class="ti-star"></span></li>
		                                    <li><span class="ti-star"></span></li>
		                                    <li><span class="ti-star"></span></li>
		                                    <li><span class="ti-star"></span></li>
		                                    <li><span class="ti-star"></span></li>
		                                </ul>
		                                <div class="review">
		                                    <a href="#">4 customer reviews</a>
		                                </div>
		                            </div>
		                            <div class="price-box-3">
		                                <div class="s-price-box">
		                                    <span class="new-price">$17.20</span>
		                                    <span class="old-price">$45.00</span>
		                                </div>
		                            </div>
		                            <div class="quick-desc">
		                                Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
		                            </div>
		                            <div class="select__color">
		                                <h2>Select color</h2>
		                                <ul class="color__list">
		                                    <li class="red"><a title="Red" href="#">Red</a></li>
		                                    <li class="gold"><a title="Gold" href="#">Gold</a></li>
		                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
		                                    <li class="orange"><a title="Orange" href="#">Orange</a></li>
		                                </ul>
		                            </div>
		                            <div class="select__size">
		                                <h2>Select size</h2>
		                                <ul class="color__list">
		                                    <li class="l__size"><a title="L" href="#">L</a></li>
		                                    <li class="m__size"><a title="M" href="#">M</a></li>
		                                    <li class="s__size"><a title="S" href="#">S</a></li>
		                                    <li class="xl__size"><a title="XL" href="#">XL</a></li>
		                                    <li class="xxl__size"><a title="XXL" href="#">XXL</a></li>
		                                </ul>
		                            </div>
		                            <div class="social-sharing">
		                                <div class="widget widget_socialsharing_widget">
		                                    <h3 class="widget-title-modal">Share this product</h3>
		                                    <ul class="social__net social__net--2 d-flex justify-content-start">
		                                        <li class="facebook"><a href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
		                                        <li class="linkedin"><a href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
		                                        <li class="pinterest"><a href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
		                                        <li class="tumblr"><a href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
		                                    </ul>
		                                </div>
		                            </div>
		                            <div class="addtocart-btn">
		                                <a href="#">Add to cart</a>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		            </div>
		        </div>
		    </div>
		</div>
		<!-- END QUICKVIEW PRODUCT -->
	</div>
	<!-- //Main wrapper -->

		<!-- JS Files -->
		<?php include "inc/scripts.php";?>
		
	</body>
	</html>