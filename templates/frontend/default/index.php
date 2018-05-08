<?php get_template('header');?>
 
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
                
                <?php if(have_post($type='artikel')): ?>
                    <?php foreach(post() as $post): ?>

                        <div class="post-preview">
                            <a href="<?=permalink($post);?>">
                                <h2 class="post-title"><?=post_title($post);?></h2>
                            </a>
                            <p class="post-meta"><?=e_('posted_by');?> <?=post_meta('author',$post);?> <?=e_('on');?> <?=post_meta('time',$post);?> | <?=e_('category');?> <?=post_category($post);?></p>
                        </div>
                        <hr>

                    <?php endforeach; ?>
                <?php endif;?>


                <!-- Pager -->
                <?=post_pagination($type);?>
            </div>
        </div>
    </div>

<?php get_template('footer');?>