<?php get_template('header');?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      
      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-user"></i><h3> Daftar User</h3>
              <a class="btn btn-large btn-primary" href="<?=set_url('user#tambah');?>">Tambah User</a>

            </div>

            <div class="widget-content">
              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari User ... ">
                </div>
              </div>

              <div class="controls pull-left">
                  <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" href="#">Aksi User</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-action-user">
                    <li><a href="<?=set_url('user#mass?action=hapus');?>" ><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?=set_url('user#mass?action=aktifkan');?>"><i class="icon-ok"></i> Aktifkan</a></li>
                    <li><a href="<?=set_url('user#mass?action=non-aktifkan');?>" ><i class="icon-ban-circle"></i> Non Aktifkan</a></li>
                  </ul>
                </div>
              </div>  <!-- /controls -->  



              <table id="tbl-user" class="table table-striped table-bordered">
                  <tbody>                      
                  </tbody>
              </table>

              <div class="controls pull-right">
                  <ul id="pagination-user" class="pagination"></ul>          
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
    <h3 id="myModalLabel"><i class="icon-plus"></i> Tambah User</h3>
  </div>

  <div class="modal-body">
    <form role="form" id="form-user" action="tambah">
        <fieldset class="form-horizontal">
          <h4>Data Akun</h4><br />
          <div class="control-group">
            <label class="control-label" for="email">Email</label>
            <div class="controls">
              <input type="email" name="email" id="email" class="form-control input-block-level" value="" />
            </div>  


            <label class="control-label" for="username">Username</label>
            <div class="controls">
              <input type="text" name="username" id="username" class="form-control input-block-level" value="" />
            </div>  

            <label class="control-label" for="password">Password</label>
            <div class="controls">
              <input type="password" name="password" id="password" class="form-control input-block-level" value="" />
            </div> 

            <label class="control-label" for="group">Group</label>
            <div class="controls">
              <?=form_dropdown_group();?>
            </div> 

          </div>


          <h4>Data Profil</h4><br />
          <div class="control-group">

            <label class="control-label" for="nama_depan">Nama Depan</label>
            <div class="controls">
              <input type="text" name="nama_depan" id="nama_depan" class="form-control input-block-level" value="" />
            </div>  

            <label class="control-label" for="nama_belakang">Nama Belakang</label>
            <div class="controls">
              <input type="text" name="nama_belakang" id="nama_belakang" class="form-control input-block-level" value="" />
            </div>  


            <label class="control-label" for="jenis_kelamin">Jenis Kelamin</label>
            <div class="controls">
              <label class="radio inline">
                <input type="radio" value="pria" name="jenis_kelamin" checked="checked"> Pria
              </label>

              <label class="radio inline">
                <input type="radio" value="wanita" name="jenis_kelamin"> Wanita
              </label>
            </div>

            <label class="control-label" for="tempat_lahir">Tempat Lahir</label>
            <div class="controls">
              <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control input-block-level" value="" />
            </div>  

            <label class="control-label" for="tanggal_lahir">Tanggal Lahir (d/m/y)</label>
            <div class="controls">
              <input type="text" name="date" id="date" class="form-control short" value="" />
              /
              <select name="month" id="month">
                <option value="0">Pilih Bulan</option>
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
              </select>
              / 
              <input type="text" name="year" id="year" class="form-control short" value="" />
            </div>  
          </div>

          <h4>Data Kontak</h4><br />
          <div class="control-group">

            <label class="control-label" for="provinsi">Provinsi</label>
            <div class="controls">
              <?=form_dropdown_provinsi();?>
            </div>  

            <label class="control-label" for="kota">Kota</label>
            <div class="controls">
              <select name="kota" id="kota"></select>
            </div>  

            <label class="control-label" for="kecamatan">Kecamatan</label>
            <div class="controls">
              <select name="kecamatan" id="kecamatan"></select>
            </div>  

            <label class="control-label" for="alamat">Alamat</label>
            <div class="controls">
              <textarea name="alamat" id="alamat" class="input-block-level" rows="7"></textarea>
            </div>  

            <label class="control-label" for="kodepos">Kode Pos</label>
            <div class="controls">
              <input type="text" name="kodepos" id="kodepos" class="form-control short" value="" />            
            </div>  

            <label class="control-label" for="telephone">Telephone</label>
            <div class="controls">
              <input type="text" name="telephone" id="telephone" class="form-control short" value="" />
            </div> 

            <label class="control-label" for="handphone">Handphone</label>
            <div class="controls">
              <input type="text" name="handphone" id="handphone" class="form-control short" value="" />
            </div> 

          </div>


        </fieldset>

        <input type="hidden" name="user_id" id="user_id" />
        <input type="hidden" name="mass_action_type" id="mass_action_type" />
    </form>    
  </div>

  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-user">Tambah!</button>
  </div>
</div>

<?php get_template('footer');?>