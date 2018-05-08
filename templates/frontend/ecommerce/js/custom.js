var path = window.location.pathname;
var host = window.location.hostname;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

$(document).on('ready', function() {

  /* close button untuk daftar list item top header menu */
  $('#closebtn').on("click", function(eve){
    eve.preventDefault();
    $('#cart').click();
  });

  /* untuk bagian pembelian produk dengan mengklik button  beli */
  $('.form-product .button-beli').on("click", function(eve){
  	eve.preventDefault();
  	$(this).parents('.form-product').submit();
  });

  /* ketika diform submit */
  $('.form-product').on("submit", function(eve){
    eve.preventDefault();
  	var url = $(this).attr('action');
    $.ajax(url, {
      dataType : 'json',
      type : 'POST',
      data: $(this).serialize(),
      success: function(data){
        if(data.status == 'success'){
          $('#myModal #head-note-beli').html('<i class="fa fa-check"></i>');
          $('#myModal #note-beli').html('You have successfully added <br/><h5 class="text-center"><strong id="item-beli">'+
            '"' + data.qty + ' buah '+ data.post_detail['post_title'] + '"'+'</strong></h5>');
          $("#myModal").modal();
        }
        else if(data.status == 'empty'){
          $('#myModal #head-note-beli').html('<i class="fa fa-remove"></i>');
          $('#myModal #note-beli').html('<h5 class="text-center">Sorry, the stock is empty!</h5>');
          $("#myModal").modal();
        }
      }
    });
  });

  /* update keranjang belanja */
  $('.cart-qty').keyup(function(eve){
    eve.preventDefault();
    var qty = this.value;
    var rowid = $(this).parents('tr.shop-item').attr('id').replace('rowid_','');
    var subtotal = $(this).parents('tr.shop-item').children('td').children('strong.cart-subtotal');
    var total = $('#cart-total');
    delay(function(){
      $.ajax('../../produk/transaksi/update', {
        dataType : 'json',
        type : 'POST',
        data: {qty:qty,rowid:rowid},
        success: function(data){
          subtotal.text(data.subtotal).fadeOut('fast').fadeIn('fast');
          total.text(data.total).fadeOut('fast').fadeIn('fast');
        }
      });
    }, 1000 );
  });

  /* delete item keranjang belanja */
  $('.cart-remove').on("click", function(eve){
    eve.preventDefault();
    var qty = 0;
    var row = $(this).parents('tr.shop-item');
    var rowid = $(this).parents('tr.shop-item').attr('id').replace('rowid_','');
    var total = $('#cart-total');
    $.ajax('../../produk/transaksi/update', {
      dataType : 'json',
      type : 'POST',
      data: {qty:qty,rowid:rowid},
      success: function(data){
        row.remove();
        total.text(data.total).fadeOut('fast').fadeIn('fast');
      }
    });
  });

  /* BUTTON PROVINSI */
  $(document).on('change', '#provinsi', function(eve){
    eve.preventDefault();
    var idprovinsi = $(this).val();
    if(path.search('user/setting') > 0){
      var kotanya = getJSON("../assets/js/kota.json");
    }
    else{
      var kotanya = getJSON("../../assets/js/kota.json");
    }
    $('#kota option').remove();
    $('#select_tarif_jne option').remove();
    $('#kota').append('<option value="" selected>Pilih Kota/Kabupatennya</option>');
    for(var i = 0; i < kotanya.length; i++){
      if(kotanya[i].province_id == idprovinsi){
        // alert(kotanya[i].name);
        $('#kota').append(
            '<option value="'+kotanya[i].id+'">'+kotanya[i].name+'</option>'
          );
      }
    }
  });

  /* BUTTON KOTA */
  $(document).on('change', '#kota', function(eve){
    eve.preventDefault();
    var idkota = $(this).val();
    if(path.search('user/setting') > 0){
     var kecamatannya = getJSON("../assets/js/kecamatan.json");
    }
    else{
      var kecamatannya = getJSON("../../assets/js/kecamatan.json");
    }

    $('#kecamatan option').remove();
    $('#select_tarif_jne option').remove();
    $('#kecamatan').append('<option value="" selected>Pilih Kecamatannya</option>');
    for(var i = 0; i < kecamatannya.length; i++){
      if(kecamatannya[i].regency_id == idkota){
        // alert(kotanya[i].name);
        $('#kecamatan').append(
            '<option value="'+kecamatannya[i].id+'">'+kecamatannya[i].name+'</option>'
          );
      }
    }
  });

  $(document).on('change', '#kecamatan', function(eve){
    eve.preventDefault();

      var kota = $('#kota option:selected').text();
      var kecamatan = $('#kecamatan option:selected').text();
      $('#select_tarif_jne option').remove();

      $.ajax('../../produk/transaksi/tarif_jne', {
        dataType : 'json',
        type : 'POST',
        data: {kota:kota,kecamatan:kecamatan},
        success: function(data){
          $('#select_tarif_jne option').remove();
          $('#select_tarif_jne').append(
              '<option>Pilih Jenis Ongkir</option>'+
              '<option value="reg_'+data.reg+'">Rp '+data.reg+'/kg - JNE Reguler ('+data.estimasi_reg+' hari) </option>'  +
              '<option value="oke_'+data.oke+'">Rp '+data.oke+'/kg - JNE OKE ('+data.estimasi_oke+' hari) </option>'
            );


          if(data.yes > 0){
            $('#select_tarif_jne').append('<option value="yes_'+data.yes+'">Rp '+data.yes+' - JNE YES (Yakin Esok Sampai)</option>');
          }

        }
      });
  });

  /* ketika ongkos kirim dipilih */
  $(document).on('change', '#select_tarif_jne', function(eve){
    eve.preventDefault();
    var ongkir = $(this).val();

    $.ajax('../../produk/transaksi/update_ongkir', {
      dataType : 'json',
      type : 'POST',
      data: {ongkir:ongkir},
      success: function(data){
        $('#ongkos-kirim').text(data.total_ongkir).fadeOut().fadeIn();
        $('#total-bayar').text(data.total_transfer).fadeOut().fadeIn();
      }
    });
  });

  /* lihat detil transaksi saat ini yang sudah fix dan akan transfer */
  $('a#btn-fix-order').on("click", function(eve){
    eve.preventDefault();
    $('#list-fix-order-invoice').slideToggle();
  });

  /* ketika ada form setting akun */
  if($('#form-setting').length > 0){
    if(path.search('user/setting') > 0){
      var setting = getJSON("../user/setting/ambil");
      if(setting.status == 'success'){
        if(setting.data){

          $.each(setting.data, function(key, value) {
              if(key == 'jenis_kelamin'){
                $('#form-setting input[value="'+value+'"]').prop('checked', true);
              }
              else if(key == 'provinsi'){
                $('#form-setting #provinsi option[value ="'+value+'"]').prop('selected', true);
              }
              else if(key == 'kota'){
                var kotanya = getJSON("../assets/js/kota.json");
                $('#kota option').remove();
                $('#kota').append('<option value="">Pilih Kota/Kabupatennya</option>');
                for(var x = 0; x < kotanya.length; x++){
                  if(kotanya[x].province_id == setting.data['provinsi']){
                    $('#kota').append(
                        '<option value="'+kotanya[x].id+'">'+kotanya[x].name+'</option>'
                      );
                  }
                }

                $('#form-setting #kota option[value ="'+value+'"]').prop('selected', true);
              }
              else if(key == 'kecamatan'){
                var kecamatannya = getJSON("../assets/js/kecamatan.json");
                $('#kecamatan option').remove();
                $('#kecamatan').append('<option value="">Pilih Kecamatannya</option>');
                for(var y = 0; y < kecamatannya.length; y++){
                  if(kecamatannya[y].regency_id == setting.data['kota']){
                    $('#kecamatan').append(
                        '<option value="'+kecamatannya[y].id+'">'+kecamatannya[y].name+'</option>'
                      );
                  }
                }

                $('#form-setting #kecamatan option[value ="'+value+'"]').prop('selected', true);
              }
              else if(key == 'tanggal_lahir'){
                var tanggal_lahir = moment(value);
                $('#form-setting #date').val(tanggal_lahir.format('D'));
                $('#form-setting #month option[value ="'+tanggal_lahir.format('M')+'"]').prop('selected', true);
                $('#form-setting #year').val(tanggal_lahir.format('YYYY'));
              }
              else{
                $('#form-setting #'+key).val(value);
              }

          });
        }
      }
    }
  }

  /* untuk simpan setting akun user */
  $('#form-setting #submit-setting').on("click", function(eve){
    eve.preventDefault();
    $(this).parents('#form-setting').submit();
  });

  /* ketika form simpan setting di submit */
  $('#form-setting').on("submit", function(eve){
    eve.preventDefault();
    var url = $(this).attr('action');
    $.ajax(url, {
      dataType : 'json',
      type : 'POST',
      data: $(this).serialize(),
      success: function(data){
        if(data.status == 'success'){
          $('#form-setting').before('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong>Saved!</strong> Your data has been saved. '+
          '</div>');

          $('body').scrollTop(0);
        }
      }
    });
  });

  /* ini digunakan untuk menampilkan transaksi */
  if($('#table-transaksi').length > 0){
    var transaksi = getJSON("../../produk/transaksi/daftar");
    moment.locale('id');
    if(transaksi.status = 'success'){
      $('#table-transaksi tbody tr').remove();
      $.each(transaksi.data_transaksi, function(transaksi_key, transaksi_value) {
        $('#table-transaksi tbody').append(
            '<tr class="tr-transaksi" id="transaksi_id_'+transaksi_value['transaction_id']+'" >'+
                '<td class="text-center"><h6><strong>#'+transaksi_value['transaction_id']+'</strong></h6></td>'+
                '<td>'+
                '    <ol>'+
                '    <li>Corsair KATAR Gaming Mouse <strong>x 1 = Rp 495.000</strong></li>'+
                '    <li>Samsung DVDRW SE-208GB <strong>x 1 = Rp 295.000</strong></li>'+
                '    </ol>'+
                '    <a class="detail-popover btn btn-default" title="Detil Transaksi Invoce No. #'+transaksi_value['transaction_id']+'">Detil Transaksi</a>'+
                '    <div class="div-hidden">'+
                '        <ul class="ul-transaksi">'+
                '          <li>Corsair KATAR Gaming Mouse <strong>x 1 = Rp 495.000</strong></li>'+
                '          <li>Samsung DVDRW SE-208GB <strong>x 1 = Rp 295.000</strong></li>'+
                '        </ul>'+
                '        <br>Jumlah : <strong>'+formatNumber(transaksi_value['total'])+'</strong>'+
                '        <br>Ongkos Kirim : <strong>'+formatNumber(transaksi_value['total_tax'])+'</strong> (JNE '+formatString(transaksi_value['tax_type'])+')'+
                '        <br>Angka Unik : <strong>'+formatNumber(transaksi_value['random'])+'</strong>'+
                '        <br>Total pembayaran : <strong>'+formatNumber(transaksi_value['all_total'])+'</strong>'+
                '        <br>Waktu Transaksi : <strong>'+moment(transaksi_value['transaction_time']).format('L')+'</strong>'+
                '        <br>Status : <strong>'+transaksi_value['transaction_status']+'</strong>'+
                '    </div>'+
                '</td>'+
                '<td class="text-center"><h6>Rp '+formatNumber(transaksi_value['all_total'])+'</h6></td>'+
                '<td class="text-center"><h6><span class="label label-danger">'+formatString(transaksi_value['transaction_status'])+'</span></h6></td>'+
            '</tr>'
          );
      });

      $('tr.tr-transaksi td ol li').remove();
      $('tr.tr-transaksi td div.div-hidden ul.ul-transaksi li').remove();
      $.each(transaksi.data_transaksi_detil, function(detil_key, detil_value) {
        $('tr#transaksi_id_'+detil_value['transaction_id']+' td ol').append(
          '<li>'+detil_value['name']+' <strong>x '+detil_value['quantity']+' = Rp '+formatNumber(detil_value['price'])+'</strong></li>'
        );

        $('tr#transaksi_id_'+detil_value['transaction_id']+' td div.div-hidden ul.ul-transaksi').append(
          '<li>'+detil_value['name']+' <strong>x '+detil_value['quantity']+' = Rp '+formatNumber(detil_value['price'])+'</strong></li>'
        );
      });
    }
  }

  /* untuk melihat detil transaksi */
  $('a.detail-popover').click(function() {
    $(this).popover({
        trigger: 'manual',
        placement: 'right',
        title:  $(this).attr('title'),
        content: function() {
           var message = $(this).siblings('div.div-hidden').html();
             return message;
        },
        html: true
    });

    $(this).popover("toggle");
  });

  /* digunakan untuk kirim konfirmasi */
  $('#form-konfirmasi').on("submit", function(eve){
    eve.preventDefault();
    var url = $(this).attr('action');
    $.ajax(url, {
      dataType : 'json',
      type : 'POST',
      data: $(this).serialize(),
      success: function(data){
        if(data.status == 'success'){
          $('#form-konfirmasi').before('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong>Konfirmasi Telah Dikirim!</strong> Terima kasih telah melakukan pembelian di toko kami. Kami segera memprosesnya!. '+
          '</div>');
          $('#form-konfirmasi').remove();
          $('body').scrollTop(0);
        }
      }
    });
  });

});

function getJSON(url,data){
  return JSON.parse($.ajax({
   type: 'POST',
   url: url,
   data:data,
   dataType: 'json',
   global: false,
   async:false,
   success: function(msg) {
   }
  }).responseText);
}

function formatString(string){
  return string.replace(/_/g, " ");
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}
