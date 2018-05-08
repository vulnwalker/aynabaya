<div class="col-md-4" id="right-side">
    
    <h5 class="heading-list">Berita Populer</h5><div class="hr-heading-list"></div>
    <ul class="media-list news-item">
    
    <?php if(post_popular(array('post_type' => 'artikel'),$limit='4')): ?>
      <?php $x=1; foreach(post() as $post): ?>

      <li class="media">
        <div class="media-left">
          <a href="#">
            <img class="media-object" src="<?=resize_img(post_meta('image',$post),120,80,1);?>" alt="...">
          </a>
        </div>
        <div class="media-body">
          <a href="<?=permalink($post);?>" class="media-heading"><?=post_title($post);?></a>
        </div>
      </li>

      <?php endforeach;?>
    <?php endif;?>

    </ul>


    <h5 class="heading-list">Komentar Terbaru</h5><div class="hr-heading-list"></div>
    <ul class="media-list comment-list">
      <?php $comment_list = comment_list(4); if(count( $comment_list) > 0): ?>
        <?php foreach($comment_list as $comment):?>
          <li class="media">
            <div class="media-body">
              <?=$comment->comment_author_name;?> <i>mengomentari</i> 
              <a href="<?=permalink($comment);?>" class="media-heading"><?=post_title($comment);?></a>
            </div>
          </li>
        <?php endforeach;?>
      <?php endif;?>

    </ul>
</div>