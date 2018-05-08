<?php get_template('header');?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      
      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-shopping-cart"></i><h3> Daftar Produk</h3>
              <a class="btn btn-large btn-primary" href="<?=set_url('produk#tambah');?>">Tambah Produk</a>

            </div>
            <!-- /widget-header -->
            <div class="widget-content">

                            
              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari Produk ... ">
                </div>
              </div>


              <div class="controls pull-left">
                  <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" href="#">Aksi Produk</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-action-produk">
                    <li><a href="<?=set_url('produk#mass?action=hapus');?>" ><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?=set_url('produk#mass?action=pending');?>"><i class="icon-ban-circle"></i> Pending</a></li>
                    <li><a href="<?=set_url('produk#mass?action=publish');?>" ><i class="icon-ok"></i> Publish</a></li>
                  </ul>
                </div>
              </div>  <!-- /controls -->  

              <div class="controls pull-right">
                <div class="btn-group">
                  <a class="btn btn-default" id="lbl-filter-produk">Filter Produk</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-filter-produk">
                    <li><a href="#">Kategori ... </a></li>
                  </ul>
                </div>
              </div>  <!-- /controls -->

              <table id="tbl-produk" class="table table-striped table-bordered">
                  <tbody>

                  </tbody>
              </table>

              <div class="controls pull-right">
                  <ul id="pagination-produk" class="pagination"></ul>
              </div>

            </div>
            <!-- /widget-content --> 
          </div>

          
        </div>
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah Produk</h3>
  </div>

  <div class="modal-body">

    <form role="form" id="form-produk" action="tambah">
      
      <div class="form-group">
          <input class="input-block-level" type="text" id="post_title" name="post_title" placeholder="Tuliskan Judul Produk Disini" >

          <div class="tabbable onmodal">
              <ul class="nav nav-tabs">
                <li><a href="#info-produk" data-toggle="tab"><i class="icon-shopping-cart"></i> Info Produk</a></li>
                <li><a href="#kategori" data-toggle="tab"><i class="icon-folder-close"></i> Kategori</a></li>
                <li><a href="#waktu" data-toggle="tab"><i class="icon-time"></i> Waktu</a></li>
                <li><a href="#komentar" data-toggle="tab"><i class="icon-comment"></i> Komentar</a></li>
                <li><a href="#seo" data-toggle="tab"><i class="icon-search"></i> SEO</a></li>
              </ul>
              
              <div class="tab-content">

                <div class="tab-pane" id="info-produk">
                  <fieldset class="form-horizontal">
                    <div class="control-group">
                      <h3><span class="label label-info"><i class="icon-picture"></i> Gambar/Photo Produk</span></h3>

                      <label class="control-label">Photo Produk</label>
                      <div class="controls">

                        <div class="image-list-wrap">
                          <!--<div class="image-single-item">
                            <a class="btn btn-primary remove-img-btn"><i class="icon-remove"></i></a>
                            <img src="<?php //echo resize_img(base_url('assets/images/no_image.jpg'),100,100,1);?>" />
                          </div>
                          <div class="image-single-item">
                            <a class="btn btn-primary remove-img-btn"><i class="icon-remove"></i></a>
                            <img src="<?php //echo resize_img(base_url('assets/images/no_image.jpg'),100,100,1);?>" />
                          </div>-->
                        </div>

                        <input type="file" name="userfile" id="userfile"  />
                        <p class="help-block ">upload gambar/photo produk Anda dengan mengklik tombol diatas! (upload gambar bisa lebih dari satu)</p>                      
                      </div>


                      <h3><span class="label label-info"><i class="icon-tag"></i> Harga dan Ketersediaan</span></h3>
                      <label class="control-label" >Kode Produk</label>
                      <div class="controls">
                        <input type="text" name="post_code" id="post_code" value="" class="span7"> 
                        <p class="help-block">Kode Produk digunakan untuk memudahkan konsumen dalam melakukan transaksi (contoh penulisan : <strong>KI-0324</strong>)</p>
                      </div>

                      <label class="control-label">Harga Normal (Rp)</label>
                      <div class="controls">
                        <input type="text" name="post_price" id="post_price" value="" class="span7">                         
                      </div>

                      <label class="control-label">Harga Diskon (Rp)</label>
                      <div class="controls">
                        <input type="text" name="post_price_discount" id="post_price_discount" value="" class="span7">                         
                      </div>      

                      <label class="control-label">Stok</label>
                      <div class="controls">
                        <input type="text" name="post_stock" id="post_stock" value="" class="span7">
                        <p class="help-block">stok barang <b>tidak usah diisi jika stok selalu ada</b> , dan tuliskan <b>0</b> atau <b>-</b> jika barang kosong</p>                        
                      </div>     

                      <div class="row">
                        <div class="span4">
                          <h3><span class="label label-info"><i class="icon-list-alt"></i> Atribut Berat, Tinggi, Panjang</span></h3>
                          <label class="control-label">Berat</label>
                          <div class="controls">
                            <input type="text" name="post_weight" id="post_weight" value="" class="span1" >
                            <select name="weight_type" id="weight_type" class="span1"><option>gram</option></select>                            
                          </div>

                          <label class="control-label">Tinggi</label>
                          <div class="controls">
                            <input type="text" name="post_height" id="post_height" value="" class="span1" >
                            <select name="height_type" id="height_type" class="span1"><option>cm</option></select>
                            
                          </div>

                          <label class="control-label">Panjang</label>
                          <div class="controls">
                            <input type="text" name="post_length" id="post_length" value="" class="span1" >
                            <select name="length_type" id="length_type" class="span1"><option>cm</option></select>
                            
                          </div>

                          <label class="control-label">Lebar</label>
                          <div class="controls">
                            <input type="text" name="post_width" id="post_width" value="" class="span1" >
                            <select name="width_type" id="width_type" class="span1"><option>cm</option></select>
                            
                          </div>


                        </div> 
                        <div class="span4">
                          <h3><span class="label label-info"><i class="icon-move"></i> Atribut Warna dan Ukuran</span></h3>

                          <label class="control-label">Warna</label>
                          <div class="controls">
                            <input type="text" name="post_color" id="post_color" value="" class="span3" >  
                            <p class="help-block" class="span4">pisahkan dengan koma contoh: <b>kuning,hijau,merah</b></p>                        
                          </div>

                          <label class="control-label">Ukuran</label>
                          <div class="controls">
                            <input type="text" name="post_size" id="post_size" value="" class="span3" >  
                            <p class="help-block" class="span4">pisahkan dengan koma contoh: <b>S,M,L,XL</b></p>                        
                          </div>


                        </div>                                   
                      </div>      
                        


                    </div>
                  </fieldset>
                </div>

                <div class="tab-pane" id="kategori">
                  <fieldset>
                    <div class="control-group">
                      
                    </div>
                  </fieldset>
                </div>
                
                <div class="tab-pane" id="waktu">
                  
                    <fieldset class="form-horizontal">
                      <div class="control-group">       
                        
                          <label class="control-label" >Tanggal : dd/mm/yyyy </label>
                          <div class="controls">
                          <input type="input"  id="date" name="date" value="" class="short"> / 
                          <select name="month" id="month">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                          </select> / 
                          <input type="input"  id="year" name="year" value="" class="short">
                          </div>

                          <label class="control-label" >Pukul : hh/mm </label>
                          <div class="controls">
                          <input type="input"  id="hour" name="hour" value="" class="short"> / 
                          <input type="input"  id="minute" name="minute" value="" class="short">
                          </div>

                          <p class="help-block controls">Silahkan klik untuk mengganti waktunya ....</p>
                      </div> <!-- /controls -->       
                    </fieldset>  
                </div>

                <div class="tab-pane" id="komentar">
                  <fieldset class="form-horizontal">
                    <div class="control-group">                     
                        <label class="control-label" for="komentar">Komentar</label>
                        <div class="controls">
                          <label class="checkbox inline">
                            <input type="checkbox" id="comment_status" name="comment_status" value="open" /> Aktifkan Komentar pada Produk ini 
                          </label>
                        </div> <!-- /controls -->       

                        <label class="control-label" for="komentar">Notifikasi</label>
                        <div class="controls">
                          <label class="checkbox inline">
                            <input type="checkbox"  id="comment_notification" name="comment_notification" value="yes" /> Email Notifikasi Untuk User dan Admin  
                          </label>
                        </div> <!-- /controls -->    

                         <p class="help-block controls">(notifikasi ini akan dikirimkan ke user yang telah berkomentar, diskusi terbaru dikomentar tersebut, dan juga dikirimkan ke admin)</p>
                    </div> <!-- /control-group -->
                  </fieldset>
                </div>

                <div class="tab-pane" id="seo">
                  <fieldset class="form-horizontal">
                      <div class="control-group"> 
                        <label class="control-label" >Title</label>
                          <div class="controls">
                          <input type="text" name="meta_title" id="meta_title" value="" class="span7"> 
                        
                          </div>
                        <p class="help-block controls span7">Title ini adalah meta title yang berfungsi untuk SEO Maksimal, karena search engine sangat mengedepankan meta title ini</p>

                        <label class="control-label" >Meta Keyword</label>
                          <div class="controls">
                          <textarea class="span7" rows="5" name="meta_keyword" id="meta_keyword"></textarea> 
                          </div>
                        <p class="help-block controls span7">Keyword (kata kunci) apa yang akan Anda bidik, agar website Anda muncul di search engine setiap kali orang mencari kata tersebut di Search Engine</p>

                          <label class="control-label" >Meta Description</label>
                          <div class="controls">
                          <textarea class="span7" rows="5" name="meta_description" id="meta_description"></textarea> 
                          </div>
                        <p class="help-block controls span7">Silahkan isi, Meta Description agar produk ini memiliki SEO Score yang bagus dalam Search Engine. Dan website Anda memiliki peringkat yang bagus dalam search Engine, seperti Google maupun Bing. </p>
                      </div> <!-- /controls -->       
                  </fieldset> 
                </div>     
                           
              </div>
          </div>

          <div id="wrap_editor"></div>
          
      </div>
      
      
      <input type="hidden" name="mass_action_type" id="mass_action_type"  />
      <input type="hidden" name="post_id_hidden" id="post_id" value="0"/>
    </form>    
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-produk">Tambah!</button>
  </div>

</div>


<?php get_template('footer');?>