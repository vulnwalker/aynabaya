<?php get_template('header');?>

		<div class="row list-item">

		  	<div class="col-xs-12">
		    	<h3 id="welcome-heading"> <?=_isCategory();?> Category</h3>
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
                            <h4 class="pull-left"><?=post_meta('price',$post);?></h4>
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
