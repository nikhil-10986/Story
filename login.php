<?php session_start(); 
if(isset($_GET['logout'])) unset($_SESSION['author_id']); ?>
<!DOCTYPE HTML>
<html ng-app="Biz2Credit">
	<head>
	<meta charset="utf-8">
	<title>Biz2Credit Stories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Biz2Credit Code Challenge" />
	<meta name="keywords" content="Biz2Credit Code Challenge" />
	<meta name="author" content="Nikhil Gupta" />
	<base href="http://localhost:9000/" />
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
	
	<!-- Animate.css -->
	<link type="text/css" rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link type="text/css" rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	
	<!-- Theme style  -->
	<link type="text/css" rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
    <script type="text/javascript" src="js/modernizr-2.6.2.min.js"></script>
    
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page" ng-controller="Login" ng-init="init(<?= (isset($_SESSION['author_id']) ? $_SESSION['author_id'] : 0) ?>)">
		<div id="fh5co-aside" style="background-image: url(images/image_1.jpg)">
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="index.php"><i class="icon-home"></i></a></li>
				</ul>
			</nav>
			<div class="featured">
				<span>Biz2Credit Stories</span>
				<h2>Read the latest stories of your interest from best of the authors.</h2>
			</div>
		</div>
		<div id="fh5co-main-content">
			<div class="fh5co-post"> 
				<div class="fh5co-entry padding">
                    <span class="text-center wd-50 fw-bold co-black fs-16">Please enter your login details</div>
                    <div>
                        <form ng-submit="login(username,password)">
                            <table style="width: 100%;">
                                <tbody>
                                    <tr>
                                        <td style="text-align: center;" rowspan="4"><img src="images/login.png" alt="Please enter your login details."></td>
                                    </tr>
                                    <tr>
                                        <td>Username:<br>
                                            <input type="text" ng-model="username" style="margin-top: 4px;" required><br><br>
                                            Password:<br>
                                            <input type="password" ng-model="password" value="" style="margin-top: 4px;" required>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left"><button class="button" type="submit">Login</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
				</div>
			</div>
		</div>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script type="text/javascript" src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script type="text/javascript" src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
    <script type="text/javascript" src="js/main.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
	<script type="text/javascript" src="js/ui-bootstrap-tpls-2.5.0.min.js?<?= time(); ?>"></script>
    <script type="text/javascript" src="js/angular.js"></script>

	</body>
</html>

