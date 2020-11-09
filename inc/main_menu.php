<div class="col-lg-8 d-none d-lg-block">
    <nav class="mainmenu__nav">
        <ul class="meninmenu d-flex justify-content-start">
            <li class="drop with--one--item"><a href="index.php">Home</a></li>
            
            <li class="drop"><a href="shop-grid.php">Books</a>
                <div class="megamenu mega01" style="width: 180px!important;">
                    <ul class="item item03">
                        <li class="title">Categories</li>
                        <?php
                            $sql = "SELECT * FROM category WHERE sub_category = 0";
                            $cat_res = mysqli_query($db,$sql);
                            while($rowCAT = mysqli_fetch_assoc($cat_res)){
                                $subSql = "SELECT * FROM category WHERE sub_category = '{$rowCAT['cat_id']}'";
                                $res_subCat = mysqli_query($db,$subSql);
                                $countRow = mysqli_num_rows($res_subCat);
                                ?>
                                    
                                    <li <?php if($countRow > 0){echo "class='label2'";}?> >
                                        <a class="d-block" href="shop-grid.php?cat_id=<?=$rowCAT['cat_id']?>"><?=$rowCAT['cat_name']?></a>
                                        <?php
                                            
                                            if(mysqli_num_rows($res_subCat) > 0){
                                                ?>
                                                    <ul class="item item01">
                                                <?php
                                                while($rowSUB = mysqli_fetch_assoc($res_subCat)){
                                                    ?>
                                                        <li>
                                                            <a href="shop-grid.php?cat_id=<?=$rowSUB['cat_id']?>"><?=$rowSUB['cat_name']?></a>
                                                        </li>
                                                    <?php
                                                }
                                                ?>
                                                    </ul>
                                                <?php
                                            }
                                        ?>
                                    </li>
                                <?php
                            }
                        ?>
                    </ul>
                </div>
            </li>
            <li class="drop"><a href="shop-grid.html">Kids</a>
                <div class="megamenu mega02">
                    <ul class="item item02">
                        <li class="title">Top Collections</li>
                        <li><a href="shop-grid.html">American Girl</a></li>
                        <li><a href="shop-grid.html">Diary Wimpy Kid</a></li>
                        <li><a href="shop-grid.html">Finding Dory</a></li>
                        <li><a href="shop-grid.html">Harry Potter</a></li>
                        <li><a href="shop-grid.html">Land of Stories</a></li>
                    </ul>
                    <ul class="item item02">
                        <li class="title">More For Kids</li>
                        <li><a href="shop-grid.html">B&N Educators</a></li>
                        <li><a href="shop-grid.html">B&N Kids' Club</a></li>
                        <li><a href="shop-grid.html">Kids' Music</a></li>
                        <li><a href="shop-grid.html">Toys & Games</a></li>
                        <li><a href="shop-grid.html">Hoodies</a></li>
                    </ul>
                </div>
            </li>

            <li class="drop"><a href="blog.html">Blog</a>
                <div class="megamenu dropdown">
                    <ul class="item item01">
                        <li><a href="blog.html">Blog Page</a></li>
                        <li><a href="blog-details.html">Blog Details</a></li>
                    </ul>
                </div>
            </li>

            <li><a href="contact.php">Contact</a></li>
        </ul>
    </nav>
</div>