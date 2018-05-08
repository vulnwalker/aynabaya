<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
    <style type="text/css">
    .preloader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background-color: #000000;
    }
    .preloader .loading {
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%,-50%);
      font: 14px arial;
    }
    </style>

<script>
    $(document).ready(function(){
      $(".preloader").fadeOut();
    })
    </script>
  </head>


    <title><?=title();?></title>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans">
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/favicon.png">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css');?>/bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css');?>/style.css" rel="stylesheet">
    <?=head();?>
</head>

<body>

    <div class="preloader">
      <div class="loading">
        <img src="<?= base_url();?>assets/images/preloader.jpg">
      </div>
    </div>
    <div class="container" id="header_atas">
      <div class="row">
        <div class="col-sm-12">
          <center><a href="<?= base_url();?>"><img id="logo" class="aynabaya-animation-down" width="200" src="<?= base_url();?>assets/images/aynabayalogo.jpg"></a></center>
          <center><img src="<?= base_url();?>assets/images/headerlogo1.jpg" alt="" class="img-responsive" style="display:block; height:50px;"><center>
        </div>
      </div>
    </div>
    <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="125" role="navigation">
      <div class="container">
        <div class="navbar-header" >
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar" </span>
            <span class="icon-bar" </span>
            <span class="icon-bar" </span>
          </button>
         <a class="navbar-brand" href="<?=base_url();?>">
           <!-- <?=e_('logo');?> --> </a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav"><li><a href="<?= base_url();?>">HOME</a></li></ul>
          <ul class="nav navbar-nav"><?=post_menu('produk', TRUE);?><?=post_menu('halaman', TRUE);?></ul>

          <ul class="nav navbar-nav navbar-right">

            <li><a href="<?=set_url('halaman/transaksi/keranjang');?>"  id="cart"><i class="fa fa-shopping-cart" style="font-size:20px;"></i></a></li>
            <?=user_menu(TRUE);?>
          </ul>

           <form class="navbar-form navbar-left navbar-right" action="<?=set_url('produk/hal/');?>" role="search">

            <div class="form-group has-feedback">
              <label class="control-label" ></label>
              <input type="text" class="form-control" name="pencarian" id="pencarian" placeholder="SEARCH...">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>

          </form>

        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">
