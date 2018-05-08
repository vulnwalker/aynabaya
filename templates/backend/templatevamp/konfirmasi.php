<?php get_template('header');?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      
      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-shopping-cart"></i><h3> Daftar Konfirmasi</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">

              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari Konfirmasi ... ">
                </div>
              </div>
              
              <div class="controls pull-left">
                  <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" href="#">Aksi Konfirmasi</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-action-konfirmasi">
                    <li><a href="<?=set_url('produk/konfirmasi#mass?action=hapus');?>" ><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?=set_url('produk/konfirmasi#mass?action=pending');?>"><i class="icon-ban-circle"></i> Pending</a></li>
                    <li><a href="<?=set_url('produk/konfirmasi#mass?action=sudah_transfer');?>" ><i class="icon-ok"></i> Sudah Transfer</a></li>                  
                  </ul>
                </div>
              </div>  <!-- /controls -->  

              <table id="tbl-konfirmasi" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Invoice</th>
                      <th>Pembeli</th>
                      <th>Total</th>
                      <th>Transfer Ke</th>
                      <th>Dari Rek.</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>                      
                  </tbody>
              </table>

              <div class="controls pull-right">
                  <ul id="pagination-konfirmasi" class="pagination"></ul>
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
    <h3 id="myModalLabel">Edit Konfirmasi</h3>
  </div>

  <div class="modal-body">
    <form id="form-konfirmasi" action="update">

        <fieldset class="form-horizontal">
            <div class="control-group">
              <label class="control-label">No. INVOICE</label>
              <div class="controls">
                <input type="text" name="confirm_id" id="confirm_id" class="form-control input-block-level disabled" disabled> 
              </div>
              <label class="control-label">Nama Lengkap</label>
              <div class="controls">
                <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control input-block-level"> 
              </div>

              <label class="control-label">Email</label>
              <div class="controls">
                <input type="email" name="email" id="email" class="form-control input-block-level"> 
              </div>

              <label class="control-label">No. Handphone</label>
              <div class="controls">
                <input type="text" name="no_hp" id="no_hp" class="form-control input-block-level"> 
              </div>              
              
              <label class="control-label" for="status_transaksi">Status Konfirmasi</label>
              <div class="controls">
                <?=form_confirm_status();?>
              </div>

              <label class="control-label" for="transfer_destination">Transfer Ke Rek.</label>
              <div class="controls">
                <?=form_dropdown_rekening_bank();?>
              </div>

              <label class="control-label">Total Transfer</label>
              <div class="controls">
                <input type="text" name="total" id="total" class="form-control input-block-level"> 
              </div>               

              <label class="control-label">Bank Pengirim</label>
              <div class="controls">
                <input type="text" name="dari_rek_bank" id="dari_rek_bank" class="form-control input-block-level"> 
              </div> 

              <label class="control-label">Dari No.Rekening</label>
              <div class="controls">
                <input type="text" name="dari_rek_no" id="dari_rek_no" class="form-control input-block-level"> 
              </div> 

              <label class="control-label">Atas Nama</label>
              <div class="controls">
                <input type="text" name="dari_rek_atas_nama" id="dari_rek_atas_nama" class="form-control input-block-level"> 
              </div> 

                
        </fieldset>

      <input type="hidden" name="mass_action_type" id="mass_action_type"  />
      <input type="hidden" name="confirmation_id_hidden" id="confirmation_id" value="0" />           
    </form>    
  </div>


  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-konfirmasi">Simpan!</button>
  </div>
</div>

<?php get_template('footer');?>              