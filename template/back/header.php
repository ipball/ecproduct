<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="language" content="en" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>/css/defaults.css" />
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/jquery.1.11.1.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo $baseUrl; ?>/js/loading.js"></script>
        <title><?php echo $title; ?></title>
    </head>

    <body>
        <div id="warpper">
            <nav class="navbar navbar-default navbar-fixed-top" style="margin-bottom: 0;" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="<?php echo $baseUrl; ?>/back">ecProduct</a>
                </div>
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown">
                        <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-user"></i> <span class="caret"></span>
                        </a>
                        <ul class="dropdown dropdown-menu">
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/user/profile"><i class="glyphicon glyphicon-user"></i>
                                    User Profile 
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/user/changepassword"><i class="glyphicon glyphicon-pencil"></i>
                                    Change Password
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/user/logout"><i class="glyphicon glyphicon-log-out"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <div class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul id="side-menu" class="nav">
                            <li>
                                <a href="<?php echo $baseUrl; ?>/itoffside-admin"><i class="glyphicon glyphicon-home"></i> หน้าแรก</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/user"><i class="glyphicon glyphicon-user"></i> ผู้ใช้(ลูกค้า)</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/productcategorie"><i class="glyphicon glyphicon-list-alt"></i> หมวดหมู่สินค้า</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/product"><i class="glyphicon glyphicon-book"></i> สินค้า</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/order"><i class="glyphicon glyphicon-align-justify"></i> รายการสั่งซื้อ</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/howtopay"><i class="glyphicon glyphicon-folder-open"></i> วิธีการสั่งซื้อ</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>/back/aboutus"><i class="glyphicon glyphicon-hdd"></i> เกี่ยวกับเรา</a>
                            </li>
                            <li>
                                <a href="<?php echo $baseUrl; ?>"><i class="glyphicon glyphicon-share-alt"></i> กลับไปเว็บไซต์</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
