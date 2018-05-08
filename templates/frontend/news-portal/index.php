<?php get_template('header');?>

    <!-- Page Content -->
    <div class="container" id="big-card">
        
        <?php if(!_isHomePaging()):?>
        <div class="row no-gutter">

          <?php if(have_post($type='artikel',$category='featured',$limit='4')): ?>
            <?php $x=1; foreach(post() as $post): ?>
              <?php if($x == 1) :?>
                <div class="col-lg-7 nopadding">                                
                    <div class="big-featured " style="background-image:url(<?=resize_img(post_meta('image',$post),670,500,1);?>)">
                        <a href="#" class="anchor-block"></a>
                        <div class="bottom-align-text">
                            <?=post_category($post);?>
                            <a href="<?=permalink($post);?>" class="featured"><h3><?=post_title($post);?></h3></a>
                            <a  class="author"><?=post_meta('author',$post);?></a>
                        </div>                  
                    </div>                 
                </div>
              <?php post_except($post->post_ID); endif;?>
            <?php  $x++; endforeach;?>

              <div class="col-lg-5" >
                <?php $x=1; foreach(post() as $post): ?>
                  <?php if($x == 2): ?>
                    <div class="row">
                        <div class="side-featured" style="background-image:url(http://placehold.it/515x250)">                        
                            <a href="#" class="anchor-block"></a>
                            <div class="bottom-align-text">
                                <?=post_category($post);?>
                                <a href="<?=permalink($post);?>" class="featured"><h4><?=post_title($post);?></h4></a>                                
                            </div>                        
                        </div>
                    </div>
                  <?php post_except($post->post_ID); endif; ?>
                <?php $x++; endforeach;?>

               
                    <div class="row">
                      <?php $x=1;  foreach(post() as $post):  ?>
                        <?php if($x > 2 ):?>   
                          <div class="col-xs-6 nopadding" >
                              <div class="side-featured" style="background-image:url(http://placehold.it/257x250)">                        
                                  <a href="#" class="anchor-block"></a>
                                  <div class="bottom-align-text">
                                    <?=post_category($post);?>
                                    <a href="<?=permalink($post);?>" class="featured"><h5><?=post_title($post);?></h5></a>                                                        
                                  </div>                        
                              </div>
                          </div>
                        <?php post_except($post->post_ID);  endif; ?>
                      <?php $x++; endforeach;?>                          
                    </div>

              </div>            
          <?php endif;?>
           
        </div>  
        <?php endif;?>      
      
        <div class="row" id="content-list">
            <div class="col-md-8 nopadding" id="left-side">
                <?php if(!_isHomePaging()):?>
                  <h5 class="heading-list">Bisnis</h5><div class="hr-heading-list"></div>

                  <?php if(have_post($type='artikel',$category='bisnis',$limit='5')): ?>
                    <div class="row wrap-list nopadding">

                        <div class="col-xs-6 big-item no-gutter nopadding">
                          <?php $x=1; foreach(post() as $post): ?>
                            <?php if($x == 1 ):?>
                              <div class="thumbnail">
                                  <img src="http://placehold.it/525x350" alt="...">
                                  <div class="caption">
                                      <a href="<?=permalink($post);?>"><h4><h3><?=post_title($post);?></h4></a>
                                      <p><?=post_content($post,200);?></p>

                                  </div>
                              </div>
                            <?php post_except($post->post_ID); endif;?>
                          <?php $x++; endforeach;?>
                        </div>


                        <div class="col-xs-6 item no-gutter">
                            <ul class="media-list news-item">

                              <?php $x=1; foreach(post() as $post):  ?>
                                <?php if($x > 1  ): ?>
                                  <li class="media">
                                    <div class="media-left">
                                      <a href="<?=permalink($post);?>">
                                        <img class="media-object" src="http://placehold.it/150x100" alt="...">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <a href="<?=permalink($post);?>" class="media-heading"><?=post_title($post);?></a>
                                    </div>
                                  </li>
                                <?php post_except($post->post_ID); endif;?>
                              <?php $x++; endforeach;?>                                

                            </ul>
                        </div>
                    </div>
                  <?php endif;?>

                  <h5 class="heading-list">Komputer</h5><div class="hr-heading-list"></div>
                  <?php if(have_post($type='artikel',$category='komputer',$limit='5')): ?>
                    <div class="row wrap-list nopadding">

                        <div class="col-xs-6 big-item no-gutter nopadding">
                          <?php $x=1; foreach(post() as $post): ?>
                            <?php if($x == 1  ):?>
                              <div class="thumbnail">
                                  <img src="http://placehold.it/525x350" alt="...">
                                  <div class="caption">
                                      <a href="<?=permalink($post);?>"><h4><h3><?=post_title($post);?></h4></a>
                                      <p><?=post_content($post,200);?></p>

                                  </div>
                              </div>
                            <?php post_except($post->post_ID); endif;?>
                          <?php $x++; endforeach;?>
                        </div>


                        <div class="col-xs-6 item no-gutter">
                            <ul class="media-list news-item">

                              <?php $x=1; foreach(post() as $post):  ?>
                                <?php if($x > 1  ): ?>
                                  <li class="media">
                                    <div class="media-left">
                                      <a href="<?=permalink($post);?>">
                                        <img class="media-object" src="http://placehold.it/150x100" alt="...">
                                      </a>
                                    </div>
                                    <div class="media-body">
                                      <a href="<?=permalink($post);?>" class="media-heading"><?=post_title($post);?></a>
                                    </div>
                                  </li>
                                <?php post_except($post->post_ID); endif;?>
                              <?php $x++; endforeach;?>                                

                            </ul>
                        </div>
                    </div>
                  <?php endif;?>
                <?php endif;?>
                
                <h5 class="heading-list">Berita Terbaru</h5><div class="hr-heading-list"></div>
                <div class="row nopadding">
                    <ul class="media-list news-item" id="berita-terbaru">

                      <?php if(have_post($type='artikel')): ?>
                         <?php foreach(post() as $post): ?>
                          <li class="media">
                            <div class="media-left ">
                              <a href="<?=permalink($post);?>">
                                <img class="media-object" src="http://placehold.it/275x175" alt="...">
                              </a>
                            </div>
                            <div class="media-body ">
                              <a href="<?=permalink($post);?>"><h4><?=post_title($post);?></h4></a>
                              <p><?=post_content($post,200);?></p>
                            </div>
                          </li>
                        <?php endforeach;?>
                      <?php endif;?>
                      

                    </ul>

                    <?=post_pagination($type);?>

                </div>

            </div>
            
            <div class="col-md-4" id="right-side">
                
                <h5 class="heading-list">Berita Populer</h5><div class="hr-heading-list"></div>
                <ul class="media-list news-item">
                  <li class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object" src="http://placehold.it/120x80" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <a href="#" class="media-heading">Kewajiban Lapor Kartu Kredit Bikin Ekonomi Kian Lesu</a>
                    </div>
                  </li>
                  <li class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object" src="http://placehold.it/120x80" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <a href="#" class="media-heading">Wapres JK Kaji Masukan Mantan Presiden SBY</a>
                    </div>
                  </li>
                  <li class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object" src="http://placehold.it/120x80" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <a href="#" class="media-heading">Artha Graha Gelar Pasar Murah, Harga Daging Rp 75 Ribu Per Kilogram</a>
                    </div>
                  </li>
                  <li class="media">
                    <div class="media-left">
                      <a href="#">
                        <img class="media-object" src="http://placehold.it/120x80" alt="...">
                      </a>
                    </div>
                    <div class="media-body">
                      <a href="#" class="media-heading">Pendapatan Indofood Diprediksi Rp 70 Triliun pada 2016</a>
                    </div>
                  </li>
                </ul>


                <h5 class="heading-list">Komentar Terbaru</h5><div class="hr-heading-list"></div>
                <ul class="media-list comment-list">
                  <li class="media">
                    <div class="media-body">
                      <a href="#" class="media-heading">Investor Jepang Minati Sektor Ketenagalistrikan dan Gas</a>
                    </div>
                  </li>
                  <li class="media">
                    <div class="media-body">
                      <a href="#" class="media-heading">Menteri Susi Ancam Tenggelamkan Rumpon Liar di Laut Timor  </a>
                    </div>
                  </li>
                  <li class="media">
                    <div class="media-body">
                      <a href="#" class="media-heading">Kewajiban Lapor Kartu Kredit Bikin Ekonomi Kian Lesu</a>
                    </div>
                  </li>
                </ul>
            </div>
            
        </div>
        
    </div>
        
<?php get_template('footer');?>    
