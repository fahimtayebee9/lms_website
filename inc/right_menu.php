<div class="col-md-6 col-sm-6 col-6 col-lg-2">
    <ul class="header__sidebar__right d-flex justify-content-end align-items-center">
        <li class="shop_search"><a class="search__active" href="#"></a></li>
        <li class="wishlist"><a href="wishlist.php"></a></li>
        <li class="setting__bar__icon"><a class="setting__active" href="#"></a>
            <div class="searchbar__content setting__block">
                <div class="content-inner">
                    <div class="switcher-currency">
                        <strong class="label switcher-label">
                            <span>My Account</span>
                        </strong>
                        <div class="switcher-options">
                            <div class="switcher-currency-trigger">
                                <div class="setting__menu">
                                    <?php
                                        if(isset($_SESSION['rev_user'])){
                                            ?>
                                                <span><a href="my-account.php">My Account</a></span>
                                                <span><a href="wishlist.php">My Wishlist</a></span>
                                                <span><a href="my-account.php?action=BorrowList">My Borrow List</a></span>
                                                <span><a href="inc/signout.php">Sign Out</a></span>
                                            <?php
                                        }
                                        else{
                                            ?>
                                                    <span><a href="my-account.php?action=SignIn">Sign In</a></span>
                                                    <span><a href="my-account.php?action=SignUp">Create An Account</a></span>
                                            <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</div>