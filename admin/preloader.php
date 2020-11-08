<?php
  include "inc/header.php";
?>
        <!-- START HEADER-->
        <?php
            include "inc/topbar.php";
        ?>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <?php
            include "inc/side_menu.php";
        ?>
        <!-- END SIDEBAR-->
        <div class="content-wrapper">
            <!-- START PAGE CONTENT-->
            <div class="page-content fade-in-up">
                <!-- BEGIN PAGA BACKDROPS-->
                <div class="sidenav-backdrop backdrop"></div>
                <div class="preloader-backdrop">
                    <div class="page-preloader">Loading</div>
                </div>
                <!-- END PAGA BACKDROPS -->
            </div>
            <!-- END PAGE CONTENT-->
            <?php include "inc/footer.php";?>
        </div>
    </div>

    <!-- SCRIPTS -->
    <?php
        include "inc/scripts.php";
    ?>
</body>
</html>