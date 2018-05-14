<?php get_template('header');?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      
      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-shopping-cart"></i><h3> Daftar Pesanan/Order</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">

              <div class="controls pull-right">
                <div class="btn-group">
                  <input type="text" class="form-control" autocomplete="off" id="search" name="search" placeholder="Cari Pesanan ... ">
                </div>
              </div>


              <div class="controls pull-left">
                  <a class="btn btn-default" id="btn-check-all"><i class="icon-check"></i></a>
              </div>

              <div class="controls pull-left">
                <div class="btn-group">
                  <a class="btn btn-default" href="#">Aksi Pesanan</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-action-pesanan">
                    <li><a href="<?=set_url('produk/pesanan#mass?action=hapus');?>" ><i class="icon-trash"></i> Hapus</a></li>
                    <li><a href="<?=set_url('produk/pesanan#mass?action=pending');?>"><i class="icon-ban-circle"></i> Pending</a></li>
                    <li><a href="<?=set_url('produk/pesanan#mass?action=sudah_transfer');?>" ><i class="icon-ok"></i> Sudah Transfer</a></li>
                    <li><a href="<?=set_url('produk/pesanan#mass?action=sudah_dikirim');?>" ><i class="icon-truck"></i> Sudah Dikirim</a></li>                    
                    <li><a href="<?=set_url('produk/pesanan#mass?action=cetak_alamat');?>" ><i class="icon-file"></i> Cetak Alamat</a></li>
                  </ul>
                </div>
              </div>  <!-- /controls -->  

              <div class="controls pull-right">
                <div class="btn-group">
                  <a class="btn btn-default" id="lbl-filter-pesanan">Filter Pesanan</a>
                  <a class="btn btn-default dropdown-toggle" data-toggle="dropdown" href="#"><span class="caret"></span></a>
                  <ul class="dropdown-menu" id="btn-filter-pesanan">
                    <li><a href="pesanan">Semua</a></li>
                    <li><a href="pesanan#ambil?status=pending&amp;hal=1">Pending</a></li>
                    <li><a href="pesanan#ambil?status=sudah_transfer&amp;hal=1">Sudah Transfer</a></li>
                    <li><a href="pesanan#ambil?status=sudah_dikirim&amp;hal=1">Sudah Dikirim</a></li>

                  </ul>
                </div>
              </div>  <!-- /controls -->

              <table id="tbl-pesanan" class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th></th>
                      <th>Invoice</th>
                      <th>Pembeli</th>
                      <th>Transaksi</th>
                      <th>Total</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody></tbody>
              </table>

              <div class="controls pull-right">
                  <ul id="pagination-pesanan" class="pagination"></ul>
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
    <h3 id="myModalLabel">Edit Pesanan</h3>
  </div>

  <div class="modal-body">
    <form id="form-pesanan" action="update">

        <fieldset class="form-horizontal">
            <div class="control-group">
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
                <input type="text" name="no_handphone" id="no_handphone" class="form-control input-block-level"> 
              </div>

              <label class="control-label">No. Telephone</label>
              <div class="controls">
                <input type="text" name="no_telepon" id="no_telepon" class="form-control input-block-level"> 
              </div>

              <label class="control-label" for="provinsi">Provinsi</label>
              <div class="controls">
                <?=form_dropdown_provinsi();?>
              </div>  

              <label class="control-label" for="kota">Kota</label>
              <div class="controls">
                <select name="kota" id="kota">
                  <option>Pilih Kotanya</option>
                </select>
              </div>  

              <label class="control-label" for="kecamatan">Kecamatan</label>
              <div class="controls">
                <select name="kecamatan" id="kecamatan">
                  <option>Pilih Kecamatannya</option>
                </select>
              </div>  

              <label class="control-label" for="alamat">Alamat</label>
              <div class="controls">
                <textarea name="alamat" id="alamat" class="input-block-level" rows="7"></textarea>
              </div>  

              <label class="control-label" for="detil_pesanan">Detil Pesanan</label>
              <div class="controls">
                <table id="tbl-detil-pesanan" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Produk</th>
                    <th class="text-center">Banyak</th>
                    <th class="text-center">Harga Satuan</th>
                    <th class="text-center">Total</th>
                  </tr>
                </thead>
                <tbody>
                  
                  <tr>
                      <td colspan="3">Total</td>
                      <td class="text-right">Rp <strong id="total">-</strong></td>
                  </tr>
                  <tr>
                      <td colspan="3">Ongkos Kirim <strong id="tipe_ongkos_kirim">-</strong></td>
                      <td class="text-right">Rp <strong id="ongkos_kirim">-</strong></td>
                  </tr>
                  <tr>
                      <td colspan="3">Total Transfer</td>
                      <td class="text-right">Rp <strong id="total_transfer">-</strong></td>
                  </tr>                  
                </tbody>
                </table>
                <br />
              </div>

              <label class="control-label" for="status_transaksi">Status Transaksi</label>
              <div class="controls">
                <?=form_transaction_status();?>
              </div>

              <label class="control-label" for="transfer_destination">Transfer Ke Rek.</label>
              <div class="controls">
                <?=form_dropdown_rekening_bank();?>
              </div>

              <label class="control-label">No. Resi</label>
              <div class="controls">
                <input type="text" name="tracking_number" id="tracking_number" class="form-control input-block-level"> 
              </div>

                
        </fieldset>
      <input type="hidden" name="mass_action_type" id="mass_action_type"  />
      <input type="hidden" name="transaction_id_hidden" id="transaction_id" value="0" />        
    </form>    
  </div>


  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
    <button class="btn btn-primary" id="submit-pesanan">Simpan!</button>
  </div>
</div>

<?php get_template('footer');?>              