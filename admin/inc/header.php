<?php
    include "db_config.php";
    session_start();
    ob_start();
    // To check the User if Session Data found
    if ( empty( $_SESSION['email'] ) || empty( $_SESSION['password'] ) ){
        header("Location: index.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admincast bootstrap 4 &amp; angular 5 admin template, Шаблон админки | Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="./assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="./assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="./assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="./assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="assets/css/main.min.css" rel="stylesheet" />

    <!-- SWEET ALERT 2 -->
    <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css"> 
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- DATE PICKER  -->
    <link href="plugins/air-datepicker-master/dist/css/datepicker.css" rel="stylesheet">

    <!-- PAGE LEVEL STYLES-->
    <style>
        .visitors-table tbody tr td:last-child {
            display: flex;
            align-items: center;
        }

        .visitors-table .progress {
            flex: 1;
        }

        .visitors-table .progress-parcent {
            text-align: right;
            margin-left: 10px;
        }
        .breadcrumb::after {
            content: none!important;
        }
        .table tr th,td{
            text-align: center!important;
        }
        .dash-text{
            text-align: left!important;
        }
        .preview{
            height: 60px;
            width: 60px;
            border: 1px solid black;
            display: block;
        }
        .ibox-desc .form-control {
            border: 0;
            padding: 0.65rem 1.25rem 0.65rem 40px;
            /* -webkit-border-radius: 200px !important; */
            /* border-radius: 200px !important; */
            background-color: #f4f5f9;
            border-color: #f4f5f9;
            font-size: 13px;
        }
        .ibox-desc .search-icon {
            position: absolute;
            top: 0;
            height: 100%;
            width: 40px;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            color: #6d7c85;
        }
        .ibox-desc .dropdown-menu{
            min-width: 11rem!important;
            margin-top: 5px!important;
        }
    </style>
</head>

<body class="fixed-navbar" onload="get_allBooking()">
    <div class="page-wrapper">