<?php session_start(); ?>
<!DOCTYPE HTML>
<html ng-app="Biz2Credit">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Biz2Credit Stories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Biz2Credit Code Challenge" />
	<meta name="keywords" content="Biz2Credit Code Challenge" />
	<meta name="author" content="Nikhil Gupta" />
	<base href="http://localhost:9000/" />
	<link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	
	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body class="single" ng-controller="single" ng-init="init(<?= (isset($_GET['id']) ? $_GET['id'] : 0) ?>)">
		
	<div class="fh5co-loader"></div>	
	<div id="page">
		<div id="fh5co-aside" style="background-image: url(images/image_2.jpg);height:400px !important" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="index.php"><i class="icon-home"></i></a></li>
				</ul>
				<?php if(isset($_SESSION['author_id'])) { ?>
					<a class="pull-left" href="login.php?logout=true">Logout</a><br>
					<a class="pull-left" href="edit_stories.php">Edit Stories</a>
				<?php } else { ?>
					<a class="pull-left cu-pointer" href="login.php">Login</a>
				<?php } ?>
			</nav>
			<div class="page-title">
				<span>{{data.date_modified}}</span>
				<h2>{{data.heading}}</h2>
				<span>{{data.author_name}}</span>
			</div>
		</div>
		<div id="fh5co-main-content">
			<div class="fh5co-post"> 
				<div class="fh5co-entry padding">
					<div>
						<p>{{data.description}}</p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<footer></footer>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/angularjs/1.7.8/angular.min.js"></script>
	<script type="text/javascript" src="js/ui-bootstrap-tpls-2.5.0.min.js?<?= time(); ?>"></script>
	<script type="text/javascript" src="js/angular.js?<?= time(); ?>"></script>

	</body>
</html>

