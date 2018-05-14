<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=title();?></title>

    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css');?>/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo get_template_directory(dirname(__FILE__), 'css');?>/style.css" rel="stylesheet">
    <?=head();?>
</head>

<body>
    <nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">

        
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?=base_url();?>"><?=e_('logo');?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav"><?=post_menu('artikel', TRUE);?><?=post_menu('halaman', TRUE);?></ul>          

          <form class="navbar-form navbar-left navbar-right" action="<?=set_url('artikel/hal/');?>" role="search">
            
            <div class="form-group has-feedback">
              <label class="control-label" ></label>
              <input type="text" class="form-control" name="pencarian" id="pencarian" placeholder="Pencarian...">
              <span class="glyphicon glyphicon-search form-control-feedback"></span>
            </div>

          </form>
        </div>
      </div>
    </nav>