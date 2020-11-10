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
        <div class="ht__bradcaump__area bg-image--4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="bradcaump__inner text-center">
                        	<h2 class="bradcaump-title">Book Information</h2>
                            <nav class="bradcaump-content">
                              <a class="breadcrumb_item" href="index.html">Home</a>
                              <span class="brd-separetor">/</span>
                              <span class="breadcrumb_item active">Book Information</span>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		<!-- End Bradcaump area -->
		

        <!-- Start main Content -->
        <div class="maincontent bg--white pt--80 pb--55">
        	<div class="container">
        		<div class="row">
        			<div class="col-lg-9 col-12">
        				<div class="wn__single__product">
							<?php
								if(isset($_GET['action']) && $_GET['action'] == "View"){
									if(isset($_GET['view_id'])){
										$view_id = $_GET['view_id'];
										$getData = "SELECT * FROM books INNER JOIN authors ON authors.a_id = books.author_id 
													INNER JOIN category ON books.bk_cat = category.cat_id WHERE bk_id = '$view_id'";
										$resDetails = mysqli_query($db,$getData);
										while($rowData = mysqli_fetch_assoc($resDetails)){
											$bk_image 	= $rowData['bk_image'];
											$bk_id 		= $rowData['bk_id'];
											$bk_name 	= $rowData['bk_name'];
											$bk_author 	= $rowData['author_id'];
											$bk_image 	= $rowData['bk_image'];
											$cat_id     = $rowData['bk_cat'];
											$cat_name   = $rowData['cat_name'];
											$publisher  = $rowData['publisher'];
											$ISBN       = $rowData['ISBN'];
											$edition    = $rowData['edition'];
											$country    = $rowData['country'];
											$language   = $rowData['language'];

											$a_name     = $rowData['a_name'];
											$a_desc     = $rowData['a_desc'];
											$a_dob		= $rowData['a_dob'];
											$a_dod      = $rowData['a_dod'];
											$a_image    = $rowData['a_image'];
											$a_status   = $rowData['a_status'];
										}
									}
								}
							?>
        					<div class="row">
        						<div class="col-lg-6 col-12">
        							<div class="wn__fotorama__wrapper">
										<img class="w-100" width="100%" src="admin/img/books/<?=$bk_image?>" alt="">
        							</div>
        						</div>
        						<div class="col-lg-6 col-12">
        							<div class="product__info__main">
        								<h1><?=$bk_name?></h1>
        								<div class="price-box">
        									<span></span>
        								</div>
										<div class="product__overview">
        									<p>Ideal for cold-weather training or work outdoors, the Chaz Hoodie promises superior warmth with every wear. Thick material blocks out the wind as ribbed cuffs and bottom band seal in body heat.</p>
        								</div>
        								<div class="box-tocart d-flex">
        									<div class="addtocart__actions">
        										<a href="checkout.php?book_id=<?=$bk_id?>" class="tocart" type="submit" title="Borrow Book">Borrow Book</a>
        									</div>
											<div class="product-addto-links clearfix">
												<a class="wishlist" href="#"></a>
												<a class="compare" href="#"></a>
											</div>
        								</div>
										<div class="product_meta">
											<span class="posted_in">Categories: 
												<a href="shop-grid.php?action=Category&cat_id=<?=$cat_id?>"><?=$cat_name?></a>
											</span>
										</div>
										<div class="product-share">
											<ul>
												<li class="categories-title">Share :</li>
												<li>
													<a href="#">
														<i class="icon-social-twitter icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-tumblr icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-facebook icons"></i>
													</a>
												</li>
												<li>
													<a href="#">
														<i class="icon-social-linkedin icons"></i>
													</a>
												</li>
											</ul>
										</div>
        							</div>
        						</div>
        					</div>
						</div>
						
        				<div class="product__info__detailed">
							<div class="pro_details_nav nav justify-content-start" role="tablist">
	                            <a class="nav-item nav-link active" data-toggle="tab" href="#nav-details" role="tab">Book Information</a>
	                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-review" role="tab"> Author Information</a>
	                        </div>
	                        <div class="tab__container">

	                        	<!-- Start Single Tab Content -->
	                        	<div class="pro__tab_label tab-pane fade show active" id="nav-details" role="tabpanel">
									<div class="description__attribute">
										<table class="table table-striped">
                                          <tbody>
                                              <tr>
                                                  <th width="30%">Book Name</th>
                                                  <td><?=$bk_name?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Book Publisher</th>
                                                  <td><?=$publisher?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">ISBN</th>
                                                  <td><?=$ISBN?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Edition</th>
                                                  <td><?=$edition?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Category</th>
                                                  <td><?=$cat_name?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Country</th>
                                                  <td><?=$country?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Language</th>
                                                  <td><?=$language?></td>
                                              </tr>
                                              <tr>
                                                  <th width="30%">Author</th>
                                                  <td><a class="" href="#nav-review" data-toggle="tab" aria-expanded="false"><?=$a_name?></a></td>
                                              </tr>
                                          </tbody>
                                      </table>
									</div>
	                        	</div>
								<!-- End Single Tab Content -->
								
	                        	<!-- Start Single Tab Content -->
	                        	<div class="pro__tab_label tab-pane fade" id="nav-review" role="tabpanel">
									<div class="review__attribute">
										<table class="table table-striped">
											<tbody>
												<tr>
													<td colspan="2" class="text-center w-100"><img src="admin/img/authors/<?=$a_image?>" class="w-25 table-img" alt="Author Image"></td>
												</tr>
												<tr>
													<th width="30%">Author</th>
													<td><?=$a_name?></td>
												</tr>
												<tr>
													<th width="30%">Author Info</th>
													<td><?=$a_desc?></td>
												</tr>
												<tr>
													<th width="30%">Date of Birth</th>
													<td><?=date("d M, Y",strtotime($a_dob))?></td>
												</tr>
												<tr>
													<th width="30%">Date of Death</th>
													<td><?=date("d M, Y",strtotime($a_dod))?></td>
												</tr>
											</tbody>
										</table>
									</div>
	                        	</div>
	                        	<!-- End Single Tab Content -->
	                        </div>
						</div>
						
						<div class="wn__related__product pt--80 pb--50">
							<div class="section__title text-center">
								<h2 class="title__be--2">Related Products</h2>
							</div>
							<div class="row mt--60">
								<div class="productcategory__slide--2 arrows_style owl-carousel owl-theme">
									<?php
										$sqlCats = "SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id WHERE bk_cat = '$cat_id'";
										$catBooks = mysqli_query($db,$sqlCats);
										while($bks = mysqli_fetch_assoc($catBooks)){
											?>
												<!-- Start Single Product -->
												<div class="product product__style--3 col-lg-4 col-md-4 col-sm-6 col-12">
													<div class="product__thumb">

														<a class="first__img" href="single-product.php?action=View&view_id=<?=$bks['bk_id']?>"><img src="admin/img/books/<?=$bks['bk_image']?>" alt="product image"></a>
														<a class="second__img animation1" href="single-product.php?action=View&view_id=<?=$bks['bk_id']?>"><img src="admin/img/books/<?=$bks['bk_image']?>" alt="product image"></a>
														
													</div>
													<div class="product__content content--center">
														<h4><a href="single-product.php?action=View&view_id=<?=$bk_id?>"><?=$bk_name?></a></h4>
														<ul class="prize d-block">
															<li><?=$bks['a_name']?></li>
															<li class="prize">
																<?php
																	if($bks['bk_status'] == 1){
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
												<!-- Start Single Product -->
											<?php
										}
									?>
								</div>
							</div>
						</div>
						
					</div>
					
					<!-- SIDEBAR START -->
        			<div class="col-lg-3 col-12 md-mt-40 sm-mt-40">

						<?php include "inc/sidebarMain.php";?>
						
					</div>
					
					<!-- SIDEBAR END -->
        		</div>
        	</div>
        </div>
		<!-- End main Content -->
		
		<!-- Start Search Popup -->
		<div class="box-search-content search_active block-bg close__top">
			<form id="search_mini_form--2" class="minisearch" action="#">
				<div class="field__search">
					<input type="text" placeholder="Search entire store here...">
					<div class="action">
						<a href="#"><i class="zmdi zmdi-search"></i></a>
					</div>
				</div>
			</form>
			<div class="close__wrap">
				<span>close</span>
			</div>
		</div>
		<!-- End Search Popup -->

		<!-- Footer Area -->
		<?php include "inc/footer.php";?>
		<!-- //Footer Area -->

	</div>
	<!-- //Main wrapper -->

	

	<!-- JS Files -->
	<?php include "inc/scripts.php";?>
	
</body>
</html>