<div id="quickview-wrapper">
    <?php
        $bookSql = "SELECT * FROM books INNER JOIN authors ON books.author_id = authors.a_id";
        $res_books = mysqli_query($db,$bookSql);
        while($rowBook = mysqli_fetch_assoc($res_books)){
                $bk_name = $rowBook['bk_name'];
                $bk_image = $rowBook['bk_image'];
                $bk_status = $rowBook['bk_status'];
                $bk_id = $rowBook['bk_id'];
            ?>
            
                <!-- Modal -->
                <div class="modal fade" id="productmodal<?=$bk_id?>" tabindex="-1" role="dialog">
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
                                            <img src="admin/img/books/<?=$bk_image?>" width="250px" alt="product image">
                                        </div>
                                    </div>
                                    <!-- end product images -->
                                    <div class="product-info">
                                        <h1><?=$bk_name?></h1>
                                        <p class="mb-2">
                                            Author : <?=$rowBook['a_name']?>
                                        </p>
                                        <div class="price-box-3">
                                            <div class="s-price-box">
                                                <?php
                                                    if($bk_status == 1){
                                                        ?>
                                                            <span class="new-price">Available</span>
                                                        <?php
                                                    }
                                                    else{
                                                        ?>
                                                            <span class="old-price">Unavailable</span>
                                                        <?php
                                                    }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="quick-desc">
                                            <?=$rowBook['bk_desc']?>
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
                                            <a href="checkout.php?book_id=<?=$bk_id?>">Borrow Book</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php
        }
    ?>
</div>