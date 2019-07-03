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
	<body ng-controller="index" ng-init="init()">
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
		<div id="fh5co-aside" style="background-image: url(images/image_1.jpg)">
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="index.php"><i class="icon-home"></i></a></li>
				</ul>
				<?php if(isset($_SESSION['author_id'])) { ?>
					<a href="login.php?logout=true">Logout</a><br>
					<a href="edit_stories.php">Edit Stories</a>
				<?php } else { ?>
					<a class="pull-right" href="login.php">Login</a>
				<?php } ?>
			</nav>
			<div class="featured">
				<span>Biz2Credit Stories</span>
				<h2>Read the latest stories of your interest from best of the authors.</h2>
			</div>
		</div>
		<div id="fh5co-main-content">
			<div class="fh5co-post"> 
				<div class="">
					<div class="col-lg-6">
						<input type="text" class="form-control" placeholder="Search..." ng-model="search" ng-change="setFilterStories(search)">
					</div>
					<div class="col-lg-6">
						<select ng-model="sorting" class="form-control" ng-options="v as k for (k,v) in sortings"></select>
					</div>
				</div>
				<div class="fh5co-entry padding" ng-repeat="story in filterStories | orderBy:sorting.orderBy:sorting.reserve">
					<div>
						<span class="fh5co-post-date">{{story.date_modified}}</span>
						<h2><a href="single.php?id={{story.id}}">{{story.heading}}</a></h2>
						<p>{{story.author_name}}</p>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12">
							<ul class="pagination" ng-show="totalPages > 1">
								<li class="page-item" ng-class="{true:'disabled'}[pageNo==1]"><a class="page-link cu-pointer" ng-click="pageNo = 1">Start</a></li>
								<li class="page-item" ng-class="{true:'disabled'}[pageNo < 2]"><a class="page-link  cu-pointer" ng-click="prevPage(pageNo)">Previous</a></li>
								<li class="page-item"><a class="page-link">{{pageNo}}</a></li>
								<li class="page-item" ng-class="{true:'disabled'}[pageNo==totalPages]"><a class="page-link  cu-pointer" ng-click="nextPage(pageNo)" >Next</a></li>
								<li class="page-item" ng-class="{true:'disabled'}[pageNo==totalPages]"><a class="page-link  cu-pointer" ng-click="pageNo = totalPages">Last ({{totalPages}})</a></li>
							</ul>
					</div>
				</div>
				<footer>
				</footer>
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
	<script type="text/javascript" src="js/angular.js?<?= time(); ?>"></script>
	</body>
</html>

