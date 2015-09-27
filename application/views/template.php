<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="Download MP3 Gratis, Download Lagu Gratis, MP3, Download Lagu Sunda Gratis">
		<meta name="author" content="Saha we">
		<title>Sistem Pakar Penyakit Sapi</title>

		<!-- Bootstrap core CSS -->
		<link href="<?php echo base_url();?>assets/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			h1.navbar-brand {
				margin:0px !important;
			}
			.navbar-inverse h1.navbar-brand, .navbar-inverse h1.navbar-brand a {
				color:#FFF !important;
			}
		</style>
		<script src="<?php echo base_url();?>assets/jquery.min.js"></script>
		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url();?>assets/bootstrap.min.js"></script>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body style="padding-top: 50px;">
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<h1  class="navbar-brand"><a href="<?php echo base_url();?>">Sistem Pakar Penyakit Sapi</a></h1>
					</div>
					<?php $this->load->view('menu');?>
			</div>
		</nav>
		<div class="container">
			<div class="starter-template row">
				<div class="col-md-9">
					<?php echo @$data;?>
				</div>
				<div class="col-md-3">
					<?php echo @$this->load->view('left', '', TRUE);?>
				</div>
				
			</div>
		</div><!-- /.container -->

	</body>
</html>
