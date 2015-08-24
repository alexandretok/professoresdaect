<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Professores da ECT</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->baseUrl; ?>/css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
		  rel="stylesheet">
	<link href="<?php echo Yii::app()->baseUrl; ?>/css/font-awesome.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->baseUrl; ?>/css/style.css" rel="stylesheet">
	<link href="<?php echo Yii::app()->baseUrl; ?>/css/pages/dashboard.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo Yii::app()->baseUrl; ?>/js/rating/jquery.rating.css">
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">

	<script src="<?php echo Yii::app()->baseUrl; ?>/js/jquery-1.7.2.min.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap.js"></script>
	<script src="<?php echo Yii::app()->baseUrl; ?>/js/rating/jquery.rating.js"></script>
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-51901217-1', 'professoresdaect.info');
		ga('send', 'pageview');

	</script>
</head>
<body>
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="<?php echo Yii::app()->baseUrl; ?>/">Professores da ECT</a>

			<!--/.nav-collapse -->
		</div>
		<!-- /container -->
	</div>
	<!-- /navbar-inner -->
</div>
<!-- /navbar -->
<div class="subnavbar">
	<div class="subnavbar-inner">
		<div class="container">
			<ul class="mainnav">
				<li class="active"><a href="<?php echo Yii::app()->baseUrl; ?>/"><i class="icon-user"></i><span>Professores</span> </a></li>
				<!--<li><a href="<?php echo Yii::app()->baseUrl; ?>/"><i class="icon-book"></i><span>Disciplinas</span> </a></li>
				<li><a href="<?php echo Yii::app()->baseUrl; ?>/"><i class="icon-envelope"></i><span>Contato</span> </a></li>-->
			</ul>
		</div>
		<!-- /container -->
	</div>
	<!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->
<div class="main">
	<div class="main-inner">
		<div class="container">
			<?php echo $content; ?>
		</div>
		<!-- /container -->
	</div>
	<!-- /main-inner -->
</div>
<!-- /main -->
<div class="extra">
	<div class="extra-inner">
		<div class="container">
			<div class="row">
				<div class="span3">
					<h4><a href="<?php echo Yii::app()->baseUrl; ?>/">ProfessoresDaECT.info</a></h4>
				</div>
				<!-- /span3 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /extra-inner -->
</div>
<!-- /extra -->
<div class="footer">
	<div class="footer-inner">
		<div class="container">
			<div class="row">
				<div class="span12"> &copy; 2013 <a href="http://www.egrappler.com/">Bootstrap Responsive Admin
						Template</a>.
				</div>
				<!-- /span12 -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /footer-inner -->
</div>
<!-- /footer -->

<!-- /Calendar -->
</body>
</html>
