<?php get_template('header');?>



<div class="main">
  <div class="main-inner">
    <div class="container">

      <div class="row">
        <div class="span12">

          <div class="widget">
            <div class="widget-header">
              <i class="icon-cog"></i><h3> Konfigurasi</h3>
              <a class="btn btn-large btn-primary" id="submit-konfigurasi">Update Konfigurasi!</a>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">

              <div class="tabbable">
                <ul class="nav nav-tabs" id="tab-konfigurasi">
                  <li  class="active"><a href="#konfigurasi-umum" data-toggle="tab">Umum</a></li>
                  <li><a href="#konfigurasi-konten" data-toggle="tab">Konten</a></li>
                  <li><a href="#konfigurasi-komentar" data-toggle="tab">Komentar</a></li>
                  <li><a href="#konfigurasi-seo" data-toggle="tab">SEO/Webmaster</a></li>
                  <li><a href="#konfigurasi-toko-online" data-toggle="tab">Toko Online</a></li>
                </ul>


                <div class="tab-content">

                  <div class="tab-pane active" id="konfigurasi-umum">
                    <form class="form-horizontal form-konfigurasi">
                     <fieldset>
                        <div class="control-group">
                          <label class="control-label" for="judul">Judul</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="judul" id="judul">
                          </div> <!-- /controls -->

                          <label class="control-label" for="tagline">Tagline</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="tagline" id="tagline">
                            <p class="help-block">Tag Line itu semacam moto dari Toko Anda</p>
                          </div> <!-- /controls -->

                          <label class="control-label" for="domain">Domain Website</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="domain" id="domain">
                            <p class="help-block">Anda bisa mengganti alamat website, dengan nama domain Anda sendiri atau dengan sub domain website Anda.</p>
                          </div> <!-- /controls -->

                          <label class="control-label" for="email">Email</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="email" id="email">
                            <p class="help-block">Digunakan sebagai pengirim pada pengiriman email kepada member, setiap ada user baru yang mendaftar, atau konfirmasi terkait update news dari website</p>
                          </div> <!-- /controls -->
                        </div>


                      </fieldset>


                    </form>
                  </div>

                  <div class="tab-pane" id="konfigurasi-konten">
                    <form class="form-horizontal form-konfigurasi">
                      <fieldset>
                        <div class="control-group">
                          <label class="control-label" for="artikel_index">Artikel Di Index</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="artikel_index" id="artikel_index">
                            <p class="help-block">jumlah artikel yang akan dimunculkan disetiap halaman depan website</p>
                          </div> <!-- /controls -->

                          <label class="control-label" for="artikel_perkategori">Artikel Per Kategori</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="artikel_perkategori" id="artikel_perkategori">
                            <p class="help-block">jumlah artikel yang akan dimunculkan disetiap kategori website</p>
                          </div> <!-- /controls -->



                          <label class="control-label" for="pencarian">Tampil Di Pencarian</label>
                          <div class="controls">
                            <input type="text" class="input-block-level" name="pencarian" id="pencarian">
                            <p class="help-block">jumlah post yang dimunculkan pada hasil pencarian</p>
                          </div> <!-- /controls -->

                        </div>
                      </fieldset>
                    </form>
                  </div>

                  <div class="tab-pane" id="konfigurasi-komentar">
                    <form class="form-horizontal form-konfigurasi">
                      <fieldset>
                        <div class="control-group">
                          <label class="control-label" for="setting_komentar">Settingan Komentar</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="setting_komentar" id="setting_komentar" value="yes"> Semua orang boleh mengomentari baik itu artikel / halaman / produk
                            </label>
                          </div> <!-- /controls -->

                          <label class="control-label" for="moderasi_komentar">Moderasi Komentar</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="moderasi_komentar" id="moderasi_komentar" value="yes"> Semua komentar harus di moderasi dahulu sebelum di tampilkan
                            </label>
                          </div> <!-- /controls -->

                          <label class="control-label" for="kirim_email_komentar">Kirim Email</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="kirim_email_komentar" id="kirim_email_komentar" value="yes"> Jika ada komentar baru
                            </label>
                          </div> <!-- /controls -->

                        </div>
                      </fieldset>
                    </form>
                  </div>

                  <div class="tab-pane" id="konfigurasi-seo">

                    <form class="form-horizontal form-konfigurasi">
                      <fieldset>
                        <br />
                        <h4>Anti Konten Ganda (Duplicate Content)</h4>
                        <div class="control-group">
                          <label class="control-label" for="url_canonical">URL Canonical</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="url_canonical" id="url_canonical" value="yes"> Aktifkan URL Canonical (Mengatasi Duplicate Content)
                            </label>
                          </div> <!-- /controls -->
                        </div>

                        <h4>SEO Untuk Halaman Home / Index / Beranda</h4>
                        <div class="control-group">
                          <label class="control-label" for="home_title">Home Title</label>
                          <div class="controls">
                            <label class=" inline">
                              <textarea  class="span7" rows="5" id="home_title" name="home_title"></textarea>
                            </label>
                          </div> <!-- /controls -->

                          <label class="control-label" for="home_meta_keyword">Home Meta Keyword</label>
                          <div class="controls">
                            <label class=" inline">
                              <textarea  class="span7" rows="5" name="home_meta_keyword" id="home_meta_keyword"></textarea>
                            </label>
                          </div> <!-- /controls -->

                          <label class="control-label" for="home_meta_description">Home Meta Description</label>
                          <div class="controls">
                            <label class=" inline">
                              <textarea  class="span7" rows="5" name="home_meta_description" id="home_meta_description"></textarea>
                            </label>
                          </div> <!-- /controls -->
                        </div>

                        <h4>SEO Untuk Kategori</h4>
                        <div class="control-group">
                          <label class="control-label" for="auto_meta">Keyword &amp; Description</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="auto_meta" id="auto_meta" value="yes"> Aktifkan otomatis Meta Keyword dan Meta Description Tiap Halaman, Artikel, dan Produk
                            </label>
                          </div> <!-- /controls -->
                        </div>

                        <h4>SEO Menggunakan Pihak Ke Tiga</h4>
                        <div class="control-group">
                          <label class="control-label" for="google_webmaster">Google Webmaster (Meta)</label>
                          <div class="controls">
                            <label class=" inline">
                              <textarea  class="span7" rows="5" id="google_webmaster" name="google_webmaster"></textarea>
                              <p class="help-block">Silahkan Daftar di webmaster google kemudian lakukan verifikasi, dan ambil metode alternatif menggunakan meta</p>
                            </label>
                          </div> <!-- /controls -->

                          <label class="control-label" for="google_analytic">Google Analytic ID</label>
                          <div class="controls">
                            <input type="text" class="span3" name="google_analytic" id="google_analytic">

                          </div> <!-- /controls -->

                          <label class="control-label" for="alexa_verification">Alexa Verification</label>
                          <div class="controls">
                            <label class=" inline">
                              <textarea  class="span7" rows="5" id="alexa_verification" name="alexa_verification"></textarea>
                            </label>
                          </div> <!-- /controls -->
                        </div>


                      </fieldset>
                    </form>
                  </div>

                  <div class="tab-pane" id="konfigurasi-toko-online">
                    <form class="form-horizontal form-konfigurasi">
                      <fieldset>
                        <h3><span class="label label-info">Alamat Asli Toko</span></h3>
                        <p class="help-block">Dapat menggunakan alamat rumah jika tidak Ada (Mohon diisi selengkap mungkin)</p>
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

                          <label class="control-label" for="telephone">Telephone</label>
                          <div class="controls">
                            <input type="text" name="telephone" id="telephone" class="span3" value="" />
                          </div>

                          <label class="control-label" for="handphone">Handphone</label>
                          <div class="controls">
                            <input type="text" name="handphone" id="handphone" class="span3" value="" />
                          </div>

                          <label class="control-label" for="alamat">Alamat</label>
                          <div class="controls">
                            <textarea name="alamat" id="alamat" class="input-block-level" rows="7"></textarea>
                          </div>

                        </div>


                        <h3><span class="label label-info">Daftar No.Rekening / Media Pembayaran</span></h3>
                        <p class="help-block">No.rekening berfungsi sebagai alat pembayaran pada transaksi di toko online milik Anda. <br /><strong>Klik +tambah rekening</strong> untuk menambahkan daftar rekening Anda</p>
                        <div class="control-group">

                          <div class="wrap-rekening">
                            <!--
                            <div class="rekening-satuan">
                              <h3 class="head-rekening">No. Rekening 1</h3>
                              <a class="btn btn-danger" id="hapus-rekening"><i class="icon-remove"></i> Hapus Rekening Ini</a>
                              <br />
                              <label class="control-label" for="jenis_rekening">Jenis Rekening</label>
                              <div class="controls">
                                <select name="jenis_rekening[]" id="jenis_rekening_1" >
                                  <option value="0">Pilih Rekening</option>

                                  <option value="BCA">BCA</option>
                                  <option value="BNI">BNI</option>
                                  <option value="BNI_Syariah">BNI Syariah</option>
                                  <option value="BRI">BRI</option>
                                  <option value="BRI_Syariah">BRI Syariah</option>
                                  <option value="Mandiri">Bank Mandiri</option>
                                  <option value="Syariah_Mandiri">Bank Syariah Mandiri</option>

                                </select>
                              </div>


                              <label class="control-label" for="nomor_rekening">Nomor Rekening</label>
                              <div class="controls">
                                <input type="text" class="span3" name="nomor_rekening[]" id="nomor_rekening_1">
                              </div>

                              <label class="control-label" for="atas_nama">Atas Nama</label>
                              <div class="controls">
                                <input type="text" class="span3" name="atas_nama[]" id="atas_nama_1">
                              </div>
                            </div>
                            -->

                          </div>




                           <a class="btn btn-default" id="tambah-rekening"><i class="icon-plus"></i> Tambah Rekening</a>
                        </div>

                        <h3><span class="label label-info">Pemeriksaan / Checkout</span></h3>
                        <div class="control-group">
                          <label class="control-label" for="modul_jne">Modul OngKir JNE</label>
                          <div class="controls">
                            <label class="checkbox inline">
                              <input type="checkbox" name="modul_jne" id="modul_jne" value="yes"> Aktifkan Modul JNE untuk ongkos kirim.
                            </label>
                          </div> <!-- /controls -->

                        </div>

                        <h3><span class="label label-info">Konfirmasi Pembayaran</span></h3>
                        <div class="control-group">
                          <label class="control-label" for="halaman_konfirmasi">Halaman Konfirmasi</label>
                          <div class="controls">
                            <?=form_dropdown_halaman_konfirmasi();?>
                            <p class="help-block"><i>Jika tidak Ada di bagian pilih halaman, silahkan menuliskannya di bawah ini (halaman lain)</i></p>
                          </div>

                          <label class="control-label" for="halaman_konfirmasi_lain">Halaman Lain</label>
                          <div class="controls">
                            <input type="text" class="span3" name="halaman_konfirmasi_lain" id="halaman_konfirmasi_lain">
                          </div>

                          <label class="control-label" for="isi_halaman_konfirmasi">Isi Hal. Konfirmasi</label>
                          <div class="controls">
                            <textarea name="isi_halaman_konfirmasi" id="isi_halaman_konfirmasi" class="input-block-level" rows="7"></textarea>
                          </div>


                        </div>

                      </fieldset>
                    </form>
                  </div>
                </div>


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

<?php get_template('footer');?>
