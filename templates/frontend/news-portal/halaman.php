<?php get_template('header');?>

    <!-- Page Content -->
    <div class="container" id="big-card">
         

        <div class="row" id="content-list">


            <div class="col-md-8 nopadding" id="left-side">

                <h2><?=post_title();?></h2>
                
                <div class="col-xs-12  no-gutter nopadding">
                    

                    <?=post_content();?>
                </div>

                
            </div>
            
            <?php get_template('sidebar');?>
            
        </div>
        
    </div>

<?php get_template('footer');?>