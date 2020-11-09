<?php
    include "admin/inc/db_config.php";
    ob_start();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<title>Home | Bookshop Responsive Bootstrap4 Template</title>
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Favicons -->
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link rel="apple-touch-icon" href="assets/images/icon.png">

	<!-- Google font (font-family: 'Roboto', sans-serif; Poppins ; Satisfy) -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet"> 
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,500,600,600i,700,700i,800" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet"> 

	<!-- Stylesheets -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="assets/css/plugins.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <!-- Select2 -->
    <link rel="stylesheet" href="admin/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="admin/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DATE PICKER  -->
    <link href="admin/plugins/air-datepicker-master/dist/css/datepicker.css" rel="stylesheet">

    <link rel="stylesheet" href="admin/plugins/sweetalert2/sweetalert2.min.css"> 
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <link href="admin/assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

	<!-- Cusom css -->
   <link rel="stylesheet" href="assets/css/custom.css">

	<!-- Modernizer js -->
	<script src="assets/js/vendor/modernizr-3.5.0.min.js"></script>

	<?php
		if(strpos($_SERVER['REQUEST_URI'],"shop-grid") == true){
			?>
				<style>
					.oth-page .mainmenu__nav .meninmenu li a {
						color: #fff;
					}
					.oth-page.header__area .header__sidebar__right > li.shop_search > a {
						background: rgba(0, 0, 0, 0) url("assets/images/icons/search_white.png") no-repeat scroll 0 center;
					}
					.oth-page.header__area .header__sidebar__right > li.wishlist > a {
						background: rgba(0, 0, 0, 0) url("assets/images/icons/button-wishlist_white.png") no-repeat scroll 0 center;
					}
					.oth-page.header__area .header__sidebar__right > li.setting__bar__icon > a {
						background: transparent url("assets/images/icons/icon_setting_white.png") no-repeat scroll left center;
					}
					.oth-page.header__area .header__sidebar__right > li.shopcart > a {
						background: rgba(0, 0, 0, 0) url("assets/images/icons/cart_white.png") no-repeat scroll 0 center;
					}
				</style>
			<?php
		}
	?>

	<style>
		.disabled-item{
			pointer-events: none!important;
			cursor: pointer;
		}
	</style>

</head>
<body>