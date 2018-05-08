<?php get_template('header');?>


<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">

          <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> Statistik Website Bulan Ini</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
              <!-- /area-chart --> 
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->


          <!-- /widget -->
          <!-- /widget -->
          <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3> Komentar Terbaru</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="messages_layout" id="list-komentar-terbaru">
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget --> 
        </div>
        <!-- /span6 -->
        <div class="span6">

          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Statistik Hari Ini</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <p class="bigstats">Berikut ringkasan statistik hari ini mulai dari visitor, facebook like+share, twitter share, dan persentase interaksi visitor</p>
                  <div id="big_stats" class="cf">
                    <div class="stat"> <i class="icon-anchor"></i> <span class="value" id="visitor_total_hari_ini">0</span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-thumbs-up-alt"></i> <span class="value">0</span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-twitter-sign"></i> <span class="value">0</span> </div>
                    <!-- .stat -->
                    
                    <div class="stat"> <i class="icon-bullhorn"></i> <span class="value">0%</span> </div>
                    <!-- .stat --> 
                  </div>
                </div>
                <!-- /widget-content --> 
                
              </div>
            </div>
          </div>

          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Shortcuts</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"> 
                <a href="<?=set_url('artikel#tambah');?>" class="shortcut"><i class="shortcut-icon icon-file"></i><span class="shortcut-label">Tambah Artikel</span></a>
                <a href="<?=set_url('produk/pesanan');?>" class="shortcut"><i class="shortcut-icon icon-shopping-cart"></i><span class="shortcut-label">Pesanan</span></a>
                <a href="<?=set_url('statistik');?>" class="shortcut"><i class="shortcut-icon icon-signal"></i><span class="shortcut-label">Statistik</span></a>
                <a href="<?=set_url('komentar');?>" class="shortcut"><i class="shortcut-icon icon-comments-alt"></i><span class="shortcut-label">Komentar</span></a>
                <a href="<?=set_url('user');?>" class="shortcut"><i class="shortcut-icon icon-user"></i><span class="shortcut-label">User</span></a>
                <a href="<?=set_url('produk#tambah');?>" class="shortcut"><i class="shortcut-icon icon-gift"></i><span class="shortcut-label">Tambah Produk</span></a>
                <a href="<?=set_url('tampilan');?>" class="shortcut"><i class="shortcut-icon icon-list-alt"></i><span class="shortcut-label">Ganti Tampilan</span></a>
                <a href="<?=set_url('produk/konfirmasi');?>" class="shortcut"><i class="shortcut-icon icon-bell"></i><span class="shortcut-label">Konfirmasi</span> </a></div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
          
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> Recent News</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <ul class="news-items" id="list-recent-news">
                <li>
                  
                  <div class="news-item-date"> <span class="news-item-day">29</span> <span class="news-item-month">Aug</span> </div>
                  <div class="news-item-detail"> <a href="http://www.egrappler.com/thursday-roundup-40/" class="news-item-title" target="_blank">Thursday Roundup # 40</a>
                    <p class="news-item-preview"> This is our web design and development news series where we share our favorite design/development related articles, resources, tutorials and awesome freebies. </p>
                  </div>
                  
                </li>
              </ul>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->


<?php get_template('footer');?>