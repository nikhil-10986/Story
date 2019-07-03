<?php session_start(); ?>
<!DOCTYPE HTML>
<html ng-app="Biz2Credit">
	<head>
	<meta charset="utf-8">
	<title>Create/Edit Stories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Biz2Credit Code Challenge" />
	<meta name="keywords" content="Biz2Credit Code Challenge" />
	<meta name="author" content="Nikhil Gupta" />
	<base href="http://localhost/Biz2Credit/" />
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
	
    <div id="page" ng-controller="EditStories" ng-init="init(<?= (isset($_SESSION['author_id']) ? $_SESSION['author_id'] : 0) ?>)">
        <div id="fh5co-aside" style="background-image: url(images/image_1.jpg)">
			<div class="overlay"></div>
			<nav role="navigation">
				<ul>
					<li><a href="index.php"><i class="icon-home"></i></a></li>
				</ul>
				<?php if(isset($_SESSION['author_id'])) { ?>
					<a href="login.php?logout=true">Logout</a>
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
        <h1 class="pa-10 text-center">Create or Edit Stories</h1>
			<div class="fh5co-post"> 
				<div class="fh5co-entry">
                    <button class="button pull-right" ng-click="addNew({})" type="button">Add New</button>
				</div>
            </div>
            <div ng-show="stories">
                <table class="list">
                    <thead><tr><td>Story Title</td><td>Status</td><td>Date Added</td><td>Date Modified</td><td>Action</td></tr></thead>
                    <tbody>
                        <tr ng-repeat="(k,v) in stories">
                            <td>{{v['heading']}}</td>
                            <td>{{v['status'] == 0 ? "DRAFT" : "PUBLISHED"}}</td>
                            <td>{{v['date_added']}}</td>
                            <td>{{v['date_modified']}}</td>                            
                            <td>
                                <a ng-click="addNew(v)" class="cu-pointer">Edit</a>
                                <a ng-click="deleteStory(v)" class="cu-pointer">Delete</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
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
    <script type="text/ng-template" id="addEditStories.html">
        <form ng-submit="saveStories(story,uib)">
            <div class="modal-header" ></div>
            <div class="modal-body text-left">
                <div class="form-group">
                    <label for="heading">Story Title</label>
                    <input type="text" class="form-control" id="heading" ng-trim="false" ng-model="story.heading" name="heading" required/>
                </div>
                <div class="form-group">
                    <label for="description">Story Content</label>
                    <textarea class="form-control" id="description" ng-trim="false" ng-model="story.description" name="description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" ng-model="story.status" ng-options="k as v for (k,v) in ['DRAFT','PUBLISH']"></select>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button class="button" type="submit">Save</button>
                <button class="button" type="button" ng-click="uib.close(false)">Close</button>
            </div>
        </form>
    </script>

	</body>
</html>

