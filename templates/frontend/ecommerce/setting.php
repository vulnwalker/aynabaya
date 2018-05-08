<?php get_template('header');?>

<form class="form-horizontal" id="form-order" method="POST" action="base_url('halaman/transaksi/tagihan_pembelian')" >
  <div class="form-group">
    <label class="control-label col-xs-3">Name</label>
    <div class="col-xs-9">
        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Fill in the full name here" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">Email</label>
    <div class="col-xs-9">
        <input type="email" class="form-control" id="email" name="email" placeholder="Email"  required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">Mobile Number</label>
    <div class="col-xs-9">
        <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="+xx-xxxx" required>
        <p class="help-block">Required for confirmation from the expedition</p>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">Phone Number</label>
    <div class="col-xs-9">
        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="+xx-xxxx" required>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">State</label>
    <div class="col-xs-9">
        <?php echo form_dropdown_provinsi();?>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">City</label>
    <div class="col-xs-9">
        <select name="kota" id="kota" class="form-control" required><option value="" selected="">Choose City</option></select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">District</label>
    <div class="col-xs-9">
        <select name="kecamatan" id="kecamatan" class="form-control" required><option value="" selected="">Choose District</option></select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">Full Address</label>
    <div class="col-xs-9">
        <textarea class="form-control" name="alamat_lengkap" rows="2" placeholder="Fill full address here..." required></textarea>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-xs-3">Username</label>
    <div class="col-xs-9">
        <input type="text" class="form-control" id="username" name="username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-xs-3">Password</label>
    <div class="col-xs-9">
        <input type="password" class="form-control" id="password" name="password">
    </div>
  </div>

  <div class="form-group">
    <div class="col-xs-offset-3 col-xs-9">
        <button type="submit" class="btn btn-primary input-block-level"><span class="glyphicon glyphicon-ok"></span> Setting!</button>
    </div>
  </div>

</form>


<?php get_template('footer');?>
