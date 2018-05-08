<?php get_template('header');?>

    <!-- Page Content -->
    <div class="container" id="big-card">
         

        <div class="row" id="content-list">


            <div class="col-md-8 nopadding" id="left-side">

                <?=breadcrumb();?>

                <h2><?=post_title();?></h2>
                <p class="post-meta">Posted by <?=post_meta('author');?> on <?=post_meta('time');?> | Category : <?=post_category();?></p>
                <div class="col-xs-12  no-gutter nopadding">
                    
                    <img class="img-responsive" src="<?=resize_img(post_meta('image'),650,350,1);?>" alt="...">

                    <?=post_content();?>
                </div>

                <div class="row" id="related-news">
                    <div class="col-xs-12">
                        <h4>Berita Terkait</h4>
                        
                        <?php if(have_post($type='artikel',$category=post_category(NULL,FALSE),$limit='4')): ?>
                          <?php foreach(post() as $post): ?>
                          <div class="col-xs-6 col-md-6 col-lg-6" >
                              <div class="thumbnail">
                                <img src="<?=resize_img(post_meta('image',$post),350,180,1);?>" alt="...">
                                <div class="caption">
                                  <h5><a href="<?=permalink($post);?>" class="featured"><?=post_title($post);?></a></h5>                                  
                                </div>
                              </div>
                          </div>
                          <?php endforeach;?>
                        <?php endif;?>
                        
                    </div>
                </div>

                <?php if(comment_feature()):?>
                    <?php $comment_list = comment_list(); if(count( $comment_list) > 0): ?>
                        <div class="comment-list">
                            <div class="page-header">
                                <h4><small class="pull-right"><?php echo count($comment_list);?> komentar</small> Daftar Komentar</h4>
                            </div> 
                            <div class="comments-list">
                                <?php foreach($comment_list as $comment):?>
                                    <div class="media">
                                       <p class="pull-right"><small><?=$comment->comment_date;?></small></p>
                                        <a class="media-left" href="#">
                                          <img src="http://lorempixel.com/40/40/people/7/">
                                        </a>
                                        <div class="media-body">
                                          <h5 class="media-heading user_name"><?=$comment->comment_author_name;?></h5>
                                          <p><?=$comment->comment_content;?></p>
                                          <p><small><a href=""><i class="glyphicon glyphicon-thumbs-up"></i> Like</a> <a href=""><i class="glyphicon glyphicon-share-alt"></i> Share</a> </small></p>
                                        </div>
                                    </div>
                                <?php endforeach;?>
                            </div>
                        </div>
                    <?php endif;?>
                                
                    <div class="comment-form">
                        <div class="page-header">
                            <a name="form-komentar"></a>
                            <h4>Form Komentar</h4>

                            <?=comment_message('<p class="help-block alert alert-success">','message','</p>');?>
                        </div> 
                        <form id="form-komentar" class="form-horizontal" action="<?=set_url('komentar/kirim');?>" role="form" method="post">
                            <div class="form-group">
                                <label for="comment_author_name" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="comment_author_name" name="comment_author_name" placeholder="Nama Lengkap" value="">                                     
                                    <?=comment_message('<p class="help-block alert alert-danger" role="alert">','comment_author_name','</p>');?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="comment_author_email" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="comment_author_email" name="comment_author_email" placeholder="email@website.com" value="">
                                    <?=comment_message('<p class="help-block alert alert-danger" role="alert">','comment_author_email','</p>');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment_author_url" class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="comment_author_url" name="comment_author_url" placeholder="http://" value="">
                                    
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="comment_content" class="col-sm-2 control-label">Komentar</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" rows="4" name="comment_content"></textarea>
                                    <?=comment_message('<p class="help-block alert alert-danger" role="alert">','comment_content','</p>');?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                    <input type="hidden" name="post_ID" id="post_ID" value="<?=post_detail(NULL,'post_ID');?>" />
                                    <input id="submit" name="submit" type="submit" value="Kirim Komentar!" class="btn btn-primary input-block">
                                </div>
                            </div>
                        </form>
                    </div>            
                <?php endif;?>   
            </div>

            <?php get_template('sidebar');?>

        </div>
        
    </div>
 
<?php get_template('footer');?>