<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
		<link href="<?php echo get_template_directory(dirname(__FILE__), 'css');?>/bootstrap.min.css" rel="stylesheet">
		<style type="text/css">
			body{
				padding-top:70px;
				padding-bottom:70px;
			}

			#main-navbar{
				background: #0090c5 ;
				border: none;
			}
			
			#main-navbar a.navbar-brand{
				color: #fff;
			}

			div.form-group label{
				text-align: left !important;
			}

		</style>
		<title><?=title();?></title>
		<?=head();?>
	</head>
	<body>

		<header>
			<nav class="navbar navbar-inverse navbar-fixed-top" id="main-navbar" role="navigation">
				<div class="container">
					<div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
						<div class="navbar-header">						
							<a href="<?=base_url();?>" class="navbar-brand">IlmuWebSite</a>
						</div>
					</div>
					
				</div>
			</nav>
		</header>