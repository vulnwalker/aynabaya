<?php get_template('header');

?>



    <!-- top slider -->

    <div class="container-fluid" id="slider-atas">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

          <li data-target="#myCarousel" data-slide-to="1"></li>

          <li data-target="#myCarousel" data-slide-to="2"></li>

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">

          <div class="item active">

            <img src="<?=base_url();?>assets/images/11.jpg" alt="1">

          </div>



          <div class="item">

            <img src="<?=base_url();?>assets/images/12.jpg" alt="2">

          </div>



          <div class="item">

            <img src="<?=base_url();?>assets/images/13.jpg" alt="3">

          </div>

        </div>



        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">

          <span class="glyphicon glyphicon-chevron-left"></span>

          <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">

          <span class="glyphicon glyphicon-chevron-right"></span>

          <span class="sr-only">Next</span>

        </a>

      </div>

    </div>

    <!-- end top slider -->



    <!-- top slider -->

    <div class="container-fluid" id="slider-atas-versimobile" style="display:none;">

      <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <!-- Indicators -->

        <ol class="carousel-indicators">

          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>

          <li data-target="#myCarousel" data-slide-to="1"></li>

          <li data-target="#myCarousel" data-slide-to="2"></li>

        </ol>



        <!-- Wrapper for slides -->

        <div class="carousel-inner">

          <div class="item active">

            <img src="<?=base_url();?>assets/images/1.jpg" alt="1">

          </div>



          <div class="item">

            <img src="<?=base_url();?>assets/images/2.jpg" alt="2">

          </div>



          <div class="item">

            <img src="<?=base_url();?>assets/images/3.jpg" alt="3">

          </div>

        </div>



        <!-- Left and right controls -->

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">

          <span class="glyphicon glyphicon-chevron-left"></span>

          <span class="sr-only">Previous</span>

        </a>

        <a class="right carousel-control" href="#myCarousel" data-slide="next">

          <span class="glyphicon glyphicon-chevron-right"></span>

          <span class="sr-only">Next</span>

        </a>

      </div>

    </div>

    <!-- end top slider -->





      <div class="row list-item">

          <div class="col-sm-12">

            <img src="<?=base_url();?>assets/images/banner.jpg" class="img-responsive">

          </div>

          <div class="col-sm-12">

            <h3 id="welcome-heading">List of the latest products</h3>

          </div>



          <?php if(have_post($type='produk')): ?>

            <?php foreach(post() as $post): ?>

            <div class="col-sm-4 col-lg-4 col-md-4">

                <div class="thumbnail">

                    <img class="img-responsive" src="<?=resize_img(post_meta('image',$post),430,350,1);?>" alt="">

                    <div class="caption">

                        <h4><a href="<?=permalink($post);?>"><?=post_title($post);?></a></h4>

                        <p><?=post_content($post,100);?></p>



                        <div class="btn-group btn-group-justified" >

                          <div class="btn-group" role="group" style="width:60%;">

                            <h4 class="pull-left"><?php
                            if($_COOKIE['usdCookie'] == 'usd'){
                              echo convertUSD(post_meta('hargaReal',$post));
                            }else{
                              echo post_meta('price',$post);
                            }

                            ?> </h4>

                          </div>

                          <div class="btn-group" role="group" style="width:40%;">

                            <form class="form-product" action="<?=base_url('produk/transaksi/tambah');?>">

                              <input type="hidden" name="post_ID" id="post_ID" value="<?=post_meta('ID',$post);?>" />

                              <a href="" type="button" class="button-beli button" style="width:55px; float:right; display:inline-block;"><i class="fa fa-shopping-cart"></i></a>

                            </form>

                          </div>

                        </div>

                    </div>

                </div>

            </div>

          <?php endforeach;?>

        <?php endif;?>



          <div class="col-xs-12">

            <?=post_pagination($type);?>

          </div>



      </div>



<?php get_template('footer');?>
