<?php get_template('header');?>
    <!-- Page Content -->
    <div class="container">
         

        <div class="row" id="content-list">


            <div class="col-md-8 nopadding" id="left-side">
            
                <h3 class="cat-heading">Kategori <?=_isCategory();?></h3>
                <div class="col-xs-12  no-gutter nopadding">
                    <ul class="media-list news-item">


                      <?php if(have_post($type='artikel')):?>

                        <?php foreach(post() as $post):?>
                          <li class="media">
                            <div class="media-left">
                              <a href="#">
                                <img class="media-object" src="http://placehold.it/275x175" alt="...">
                              </a>
                            </div>
                            <div class="media-body">
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
            
            <?php get_template('sidebar');?>

        </div>
        
    </div>
 
<?php get_template('footer');?>