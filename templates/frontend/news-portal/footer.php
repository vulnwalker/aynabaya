    <!-- /.container -->

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4><?=e_('tentang-kami');?></h4>
                    <p><?=e_('deskripsi-kami');?></p>

                    <ul class="list-inline">
                    <li><a href="<?=e_('facebook');?>" class="icoFacebook" title="Facebook"><i class="fa fa-2x fa-facebook"></i></a></li>
                    <li><a href="<?=e_('twitter');?>" class="icoTwitter" title="Twitter"><i class="fa fa-2x fa-twitter"></i></a></li>
                    <li><a href="<?=e_('google-plus');?>" class="icoGoogle" title="Google +"><i class="fa fa-2x fa-google-plus"></i></a></li>
                    <li><a href="<?=e_('linkedin');?>" class="icoLinkedin" title="Linkedin"><i class="fa fa-2x fa-linkedin"></i></a></li>
                    </ul>

                </div>

                <div class="col-md-4">
                    <h4><?=e_('pilihan-editor');?></h4>
                    <ul class="media-list foot-list">
                      <?php post_reset();?>
                      <?php if(have_post($type='artikel',$category='featured',$limit='4')): ?>
                        <?php foreach(post() as $post):  ?>
                          <li class="media">
                            <div class="media-left">
                              <a href="#">
                                <img class="media-object" src="<?=resize_img(post_meta('image',$post),80,60,1);?>" alt="...">
                              </a>
                            </div>
                            <div class="media-body">
                              <a href="<?=permalink($post);?>" class="media-heading"><?=post_title($post);?></a>
                            </div>
                          </li>
                        <?php endforeach;?>
                      <?php endif;?>
                    </ul>

                </div>
                <div class="col-md-4">
                    <h4><?=e_('menu-halaman');?></h4>
                    <ul class="menu-list"><?=post_menu('halaman', FALSE);?></ul>   
                </div>
            </div>

        </div>

        <div id="copyright">
            <div class="container">
                <div class="row nopadding">
                    <p class="text-muted"><?=e_('copyright');?></p>
                </div>
            </div>
        </div>
    </footer>
    <!-- jQuery -->
    <script src="<?php echo get_template_directory(dirname(__FILE__), 'js');?>/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_template_directory(dirname(__FILE__), 'js');?>/bootstrap.min.js"></script>

</body>

</html>
