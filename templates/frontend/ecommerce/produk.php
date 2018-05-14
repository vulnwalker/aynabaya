<?php get_template('header');?>

        <div class="row wrap-content">

            <div class="col-md-9" >

                <?=breadcrumb();?>

                <div class="thumbnail single-product" style="padding:5px;">
                    <h2><?=post_title();?></h2>

                    <img class="img-responsive" src="<?=resize_img(post_meta('image'),820,675,1);?>" id="img-big">

                    <div class="caption-full">

                      <div class="row">
                        <div class="col-md-7" id="description">
                          <h4>Product Detail / Description</h4>
                          <?=post_content();?>
                        </div>
                        <div class="col-md-5" id="order-form">
                          <div class="choice">
                            <form class="form-product" action="<?=base_url('produk/transaksi/tambah');?>">
                              <div class="form-group">
                                <label>Price</label>
                                <h4><?=post_meta('price');?></h4>
                              </div>

                              <div class="form-group">
                                <label>Size</label>
                                <?=form_dropdown_product_size();?>
                              </div>

                              <div class="form-group">
                                <label >Color</label>
                                <?=form_dropdown_product_color();?>
                              </div>

                              <div class="form-group">
                                <label >Amount</label>
                                 <input type="input" name="qty" id="qty" class="form-control" value="1" placeholder="1">
                              </div>

                              <input type="hidden" name="post_ID" id="post_ID" value="<?=post_meta('ID');?>" />
                              <a href="" type="button" class="button-beli button"><i class="fa fa-shopping-cart"></i> Buy!</a>
                            </form>
                          </div>

                        </div>

                    </div>
                  </div>

                </div>
            </div>

            <div class="col-md-3">
                <h4 class="lead">Related Products</h4>
                <ul class="media-list news-item">

                  <?php if(have_post($type='produk',$category=post_category(NULL,FALSE),$limit='4')): ?>
                    <?php foreach(post() as $post): ?>
                      <li class="media">
                        <div class="media-left">
                          <a href="#">
                            <img class="media-object" src="<?=resize_img(post_meta('image',$post),110,70,1);?>" alt="...">
                          </a>
                        </div>
                        <div class="media-body">
                          <a href="<?=permalink($post);?>" class="media-heading"><?=post_title($post);?></a>
                          <p><?=post_meta('price',$post);?></p>
                        </div>
                      </li>
                    <?php endforeach;?>
                  <?php endif;?>

                </ul>
            </div>


        </div>

<?php get_template('footer');?>
