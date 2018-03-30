<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo WEBSITE_NAME; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<link rel="icon" href="<?php _url('assets/img/favicon.png'); ?>" type="image/x-icon" />
	<link rel="shortcut icon" href="<?php _url('assets/img/favicon.png'); ?>" type="image/x-icon"/>
  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="<?php _url('assets/css/animate.css');?>">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="<?php _url('assets/css/icomoon.css');?>">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="<?php _url('assets/css/themify-icons.css');?>">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="<?php _url('assets/css/bootstrap.css');?>">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php _url('assets/css/magnific-popup.css');?>">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="<?php _url('assets/css/bootstrap-datepicker.min.css');?>">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="<?php _url('assets/css/owl.carousel.min.css');?>">
	<link rel="stylesheet" href="<?php _url('assets/css/owl.theme.default.min.css');?>">

	<!-- Theme style  -->
	<link rel="stylesheet" href="<?php _url('assets/css/style.css');?>">

	<!-- Modernizr JS -->
	<script src="<?php _url('assets/js/modernizr-2.6.2.min.js');?>"></script>
	<!-- Datatable Style -->
	<link rel="stylesheet" href="<?php _url('assets/css/jquery.dataTables.min.css');?>">
	<!-- jQuery TimePicker Style -->
	<link rel="stylesheet" href="<?php _url('assets/css/wickedpicker.min.css');?>">
	<link rel="stylesheet" href="<?php _url('assets/css/ready.css');?>">
	</head>
	<body>
	<div id="loader_hel" style="display: none;">
		<div id="loader_text">
			<p>Submitting Your request to <?php echo @$count_info['charters']; ?> Charters accross the U.K.</p>
		</div>
		<div id="cont_to_quotes" style="display: none;">
			<button class="btn btn-lg btn-danger" type="button" onClick="window.location.assign('<?php _url(@$quotes_url) ?>')" >Continue to the quotes...</button>	
			<button class="btn btn-lg btn-secondary" type="button" onClick="$('#loader_hel').hide();" >Cancel</button>	
		</div>
	</div>
	<?php include_once('navbar.php');?>