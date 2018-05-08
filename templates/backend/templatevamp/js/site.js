var editor = '';
var path = window.location.pathname;
var host = window.location.hostname;

var delay = (function(){
  var timer = 0;
  return function(callback, ms){
    clearTimeout(timer);
    timer = setTimeout(callback,ms);
  };
})();

$(function(){   
  $(window).hashchange(function(){
    var hash = $.param.fragment();      

    if(hash == 'tambah'){
      /* MANAGEMENT TAMBAH KATEGORI ARTIKEL */
      if(path.search('admin/artikel/kategori') > 0){       
        var kategori_artikel = getJSON('http://'+host+path+'/ambil',{});
        
        /* kategori artikel */
        $('#category_parent option').remove();
        $('#category_parent').append('<option value="">Pilih Induk Kategori</option>');
        if(kategori_artikel.record){
          $.each(kategori_artikel.record, function(key, value) {
               $('#category_parent').append('<option value="'+value['category_ID']+'">'+value['category_name']+'</option>');
          });          
        }

        $('#myModal .modal-header #myModalLabel').text('Tambah Kategori Artikel');
        $('#myModal .modal-footer #submit-kategori-artikel').text('Tambah!');
        $('#myModal #form-kategori-artikel').attr('action', 'tambah');    
      }

      /* MANAGEMENT TAMBAH KATEGORI PRODUK */
      else if(path.search('admin/produk/kategori') > 0){
        var kategori_produk = getJSON('http://'+host+path+'/ambil',{});
        
        /* kategori produk */
        $('#category_parent option').remove();
        $('#category_parent').append('<option value="">Pilih Induk Kategori</option>');
        if(kategori_produk.record){
          $.each(kategori_produk.record, function(key, value) {
               $('#category_parent').append('<option value="'+value['category_ID']+'">'+value['category_name']+'</option>');
          });          
        }

        $('#myModal .modal-header #myModalLabel').text('Tambah Kategori produk');
        $('#myModal .modal-footer #submit-kategori-produk').text('Tambah!');
        $('#myModal #form-kategori-produk').attr('action', 'tambah');                
      }

      /* MANAGEMENT TAMBAH ARTIKEL */
      else if(path.search('admin/artikel') > 0){
        removeeditor();
        createeditor();

        /**************************************/
        /* UNTUK ATRIBUT ARTIKEL MULAI DISINI */
        /**************************************/

        ajax_upload('artikel');

        /* BAGIAN ATRIBUT KATEGORI ARTIKEL */
        var kategori_artikel = getJSON('http://'+host+path+'/kategori/ambil',{});
        var htmlStr = "";
        var printTree = function (node) {

          htmlStr = htmlStr + '<ul class="list-group check-list-group-kategori">';        
          
          for (var i = 0; i < node.length; i++){
            htmlStr = htmlStr + '<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="'+node[i]['category_slug']+'"> '+node[i]['category_name']+'</label></li>';                             
            
            if(node[i]['children']){
              printTree(node[i]['children'])
            }
            
            htmlStr = htmlStr + '</li>';         
          }
                       
          htmlStr = htmlStr + '</ul>';
          return htmlStr;
        }

        tree = unflatten( kategori_artikel.record );
        $('.tab-pane#kategori fieldset div.control-group').html(printTree(tree));
        
        /* BAGIAN ATRIBUT WAKTU ARTIKEL */
        var today = moment();
        $('#myModal .modal-body #date').val(today.format('D'));
        $('#myModal .modal-body #month option[value ="'+today.format('M')+'"]').prop('selected', true);
        $('#myModal .modal-body #year').val(today.format('YYYY'));
        $('#myModal .modal-body #hour').val(today.format('HH'));
        $('#myModal .modal-body #minute').val(today.format('mm'));

        /* BAGIAN ATRIBUT PENULIS ARTIKEL */
        var penulis = getJSON('http://'+host+path.replace('admin/artikel', 'admin/user')+'/action/ambil/ID,username',{});
        $('#post_author option').remove();
        
        for(var i in penulis.record){
          $('#post_author').append('<option value="'+penulis.record[i]['ID']+'">'+penulis.record[i]['username']+'</option>');
        } 


        /******************************************/
        /* UNTUK ATRIBUT ARTIKEL BERAKHIR DISINI */
        /******************************************/

        $('#myModal .modal-header #myModalLabel').text('Tambah Artikel');
        $('#myModal .modal-footer #submit-artikel').text('Tambah!');
        $('#myModal #form-artikel').attr('action','tambah');        
      }

      /* MANAGEMENT TAMBAH PRODUK */
      else if(path.search('admin/produk') > 0){
        removeeditor();
        createeditor(); 

        ajax_upload('produk');

        /* atribut kategori */
        var kategori_artikel = getJSON('http://'+host+path+'/kategori/ambil',{});
        var htmlStr = "";
        var printTree = function (node) {

            htmlStr = htmlStr + '<ul class="list-group check-list-group-kategori">';        
            
            for (var i = 0; i < node.length; i++){
              htmlStr = htmlStr + '<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="'+node[i]['category_slug']+'"> '+node[i]['category_name']+'</label></li>';                             
              
              if(node[i]['children']){
                printTree(node[i]['children'])
              }
              
              htmlStr = htmlStr + '</li>';         
            }
                         
            htmlStr = htmlStr + '</ul>';
            return htmlStr;
        }

        tree = unflatten( kategori_artikel.record );
        $('.tab-pane#kategori fieldset div.control-group').html(printTree(tree));        

        /* atribut waktu */
        var today = moment();
        $('#myModal .modal-body #date').val(today.format('D'));
        $('#myModal .modal-body #month option[value ="'+today.format('M')+'"]').prop('selected', true);
        $('#myModal .modal-body #year').val(today.format('YYYY'));
        $('#myModal .modal-body #hour').val(today.format('HH'));
        $('#myModal .modal-body #minute').val(today.format('mm'));        

        $('#myModal .modal-header #myModalLabel').text('Tambah Produk');
        $('#myModal .modal-footer #submit-produk').text('Tambah!');
        $('#myModal #form-produk').attr('action', 'tambah'); 
      }

      /* MANAGEMENT TAMBAH HALAMAN */
      else if(path.search('admin/halaman') > 0){
        var halaman = getJSON('http://'+host+path+'/action/ambil',{});
        $('#post_parent option').remove();
        $('#post_parent').append('<option value="">Pilih Induk Halaman</option>');
        if(halaman.record){
          $.each(halaman.record, function(key, value) {
               $('#post_parent').append('<option value="'+value['post_ID']+'">'+value['post_title']+'</option>');
          });          
        }

        removeeditor();
        createeditor();

        $('#myModal .modal-header #myModalLabel').text('Tambah Halaman');
        $('#myModal .modal-footer #submit-halaman').text('Tambah!');
        $('#myModal #form-halaman').attr('action', 'tambah');        
      }

      /* MANAGEMENT USER HALAMAN */
      else if(path.search('admin/user') > 0){
        $('#myModal .modal-header #myModalLabel').text('Tambah User');
        $('#myModal .modal-footer #submit-user').text('Tambah!');
        $('#myModal #form-user').attr('action', 'tambah');            
      }    
      
      $('#myModal').addClass('big-modal');
      $('#myModal').modal('show');
    }

    else if(hash.search('edit') == 0){

      /* MANAGEMENT EDIT KATEGORI ARTIKEL */
      if(path.search('admin/artikel/kategori') > 0){

        /* kategori artikel */
        var kategori_artikel = getJSON('http://'+host+path+'/ambil',{});          
        $('#category_parent option').remove();
        $('#category_parent').append('<option value="">Pilih Induk Kategori</option>');
        if(kategori_artikel.record){
          $.each(kategori_artikel.record, function(key, value) {
               $('#category_parent').append('<option value="'+value['category_ID']+'">'+value['category_name']+'</option>');
          });          
        }

        /* get value kategori */
        var cat_ID = getUrlVars()["id"];
        var kategori_detail = getJSON('http://'+host+path+'/ambil',{id: cat_ID});
        $('#myModal .modal-body #category_name').val(kategori_detail.data['category_name']);
        $('#myModal .modal-body #category_description').val(kategori_detail.data['category_description']);
        $('#myModal .modal-body #category_parent option[value ="'+kategori_detail.data['category_parent']+'"]').prop('selected', true);

        /* all atribut initialized */          
        $('#myModal .modal-body #category_id').val(cat_ID);

        $('#myModal .modal-header #myModalLabel').text('Edit Artikel');
        $('#myModal .modal-footer #submit-kategori-artikel').text('Update!');
        $('#myModal #form-kategori-artikel').attr('action', 'update');        
      }

      /* MANAGEMENT EDIT KATEGORI PRODUK */
      else if(path.search('admin/produk/kategori') > 0){

        /* kategori produk */
        var kategori_produk = getJSON('http://'+host+path+'/ambil',{});    

        $('#category_parent option').remove();
        $('#category_parent').append('<option value="">Pilih Induk Kategori</option>');
        if(kategori_produk.record){
          $.each(kategori_produk.record, function(key, value) {
               $('#category_parent').append('<option value="'+value['category_ID']+'">'+value['category_name']+'</option>');
          });          
        }

        /* get value kategori */
        var category_ID = getUrlVars()["id"];
        var kategori_detail = getJSON('http://'+host+path+'/ambil',{id: category_ID});
        $('#myModal .modal-body #category_name').val(kategori_detail.data['category_name']);
        $('#myModal .modal-body #category_description').val(kategori_detail.data['category_description']);
        $('#myModal .modal-body #category_parent option[value ="'+kategori_detail.data['category_parent']+'"]').prop('selected', true);
        // moment(element.post_date)     

        /* all atribut initialized */          
        $('#myModal .modal-body #category_id').val(category_ID);
        $('#myModal .modal-header #myModalLabel').text('Edit produk');
        $('#myModal .modal-footer #submit-kategori-produk').text('Update!');
        $('#myModal #form-kategori-produk').attr('action', 'update');        
      }        

      /* MANAGEMENT EDIT ARTIKEL */
      else if(path.search('admin/artikel') > 0){
        var post_ID = getUrlVars()['id'];
        var artikel_detail = getJSON('http://'+host+path+'/action/ambil', {id:post_ID});
        $('#myModal .modal-body #post_title').val(artikel_detail.data['post_title']);
        
        // $('#myModal .modal-body #post_content').val(artikel_detail.data['post_content']);
        removeeditor();
        createeditor(artikel_detail.data['post_content']);

        /**************************************/
        /* UNTUK ATRIBUT ARTIKEL MULAI DISINI */
        /**************************************/

        ajax_upload('artikel');

        /* BAGIAN ATRIBUT KATEGORI ARTIKEL */
        var kategori_artikel = getJSON('http://'+host+path+'/kategori/ambil',{});          
        var post_category = artikel_detail.data['post_category'].split(',');       

        var tree = unflatten( kategori_artikel.record );
        var htmlStr = "";
        var printTree = function (node) {

            htmlStr = htmlStr + '<ul class="list-group check-list-group-kategori">';        
            
            for (var i = 0; i < node.length; i++){
              htmlStr = htmlStr + '<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="'+node[i]['category_slug']+'"> '+node[i]['category_name']+'</label></li>';                             
              
              if(node[i]['children']){
                printTree(node[i]['children'])
              }
              
              htmlStr = htmlStr + '</li>';         
            }
                         
            htmlStr = htmlStr + '</ul>';
            return htmlStr;
        }
        
        $('.tab-pane#kategori fieldset div.control-group').html(printTree(tree));

        for (var i in post_category) {
          // alert(post_category[i]);
          $('ul.check-list-group-kategori li.list-group-item input[type=checkbox][value='+post_category[i]+']').prop("checked",true);
        }
        

        /* BAGIAN ATRIBUT WAKTU ARTIKEL */
        var postdate = moment(artikel_detail.data['post_date']);
        $('#myModal .modal-body #date').val(postdate.format('D'));
        $('#myModal .modal-body #month option[value ="'+postdate.format('M')+'"]').prop('selected', true);
        $('#myModal .modal-body #year').val(postdate.format('YYYY'));
        $('#myModal .modal-body #hour').val(postdate.format('HH'));
        $('#myModal .modal-body #minute').val(postdate.format('mm')); 
        
        /* BAGIAN ATRIBUT KOMENTAR ARTIKEL */
        if(artikel_detail.data['comment_status'] != ""){
          $('#comment_status').prop('checked', true);
        }

        /* BAGIAN ATRIBUT NOTIFIKASI KOMENTAR + SEO ARTIKEL */
        if(artikel_detail.data['post_attribute']){
          $.each(artikel_detail.data['post_attribute'], function(key, value) {             
            if(value != "") $('#'+key).attr('value', value).prop('checked', true);            
          });          
        }

        /* BAGIAN ATRIBUT FEATUED IMAGE ARTIKEL */
        $.each(artikel_detail.data['post_attribute'], function(key, value) {    
          if(key == 'featured_image' && value != ''){
            $('#userfile').before( 
                '<img src="" class="featured_image" />'  +
                '<input class="span7" type="text" id="featured_image" name="featured_image" value="" />' +
                '<input type="hidden" id="featured_image_thumbnail" name="featured_image_thumbnail" value="" />' +
                '<button class="btn btn-danger" id="remove_featured_image"><i class="icon-remove"></i>Hapus Featured Image</button>'
              );

            $('#userfile').hide();            
          }      

          if(value != "") $('#'+key).attr('value', value).prop('checked', true);
          
          if(key == 'featured_image_thumbnail' && value != ''){
            $('img.featured_image').attr('src', value);
          }
        });

        /* BAGIAN ATRIBUT PENULIS ARTIKEL */
        var penulis = getJSON('http://'+host+path.replace('admin/artikel', 'admin/user')+'/action/ambil/ID,username',{});
        $('#post_author option').remove();
        
        for(var i in penulis.record){
          $('#post_author').append('<option value="'+penulis.record[i]['ID']+'">'+penulis.record[i]['username']+'</option>');
        }   

        $('#post_author option[value ="'+artikel_detail.data['post_author']+'"]').prop('selected', true);


        /******************************************/
        /* UNTUK ATRIBUT ARTIKEL BERAKHIR DISINI */
        /******************************************/

        $('#myModal .modal-header #myModalLabel').text('Edit Artikel');
        $('#myModal .modal-footer #submit-artikel').text('Update!');
        $('#myModal #form-artikel').attr('action','update');  
        $('#myModal #form-artikel #post_id').val(post_ID);        
      }

      /* MANAGEMENT KONFIRMASI DAN PESANAN PRODUK */
      else if(path.search('admin/produk/konfirmasi') > 0){
        var confirmation_id = getUrlVars()["id"];
        var confirmation = getJSON('http://'+host+path+'/ambil',{confirmation_id: confirmation_id});

        $.each(confirmation.data, function(key, value) { 
          $('#form-konfirmasi #'+key).val(value);          
        });        

        $('#myModal .modal-header #myModalLabel').text('Edit Konfirmasi');
        $('#myModal .modal-footer #submit-konfirmasi').text('Update!');
        $('#myModal #form-konfirmasi #confirmation_id').val(confirmation_id);
        $('#myModal #form-konfirmasi').attr('action', 'update');  
      }
      
      else if(path.search('admin/produk/pesanan') > 0){
        var transaction_id = getUrlVars()["id"];
        var transaction = getJSON('http://'+host+path+'/ambil',{transaction_id: transaction_id});

        /* sampai sini besok lanjutin... */
        $.each(transaction.data, function(key, value) { 
          $('#form-pesanan #'+key).val(value);

          if(key == 'provinsi'){
            $('#form-pesanan #'+key+' option[value ="'+value+'"]').prop('selected', true);
            
            var kotanya = getJSON("../../assets/js/kota.json");;
            $('#form-pesanan #kota option').remove();
            $('#form-pesanan #kota').append('<option value="">Pilih Kota/Kabupatennya</option>');
            for(var x = 0; x < kotanya.length; x++){
              if(kotanya[x].province_id == transaction.data['provinsi']){                
                $('#form-pesanan #kota').append(
                    '<option value="'+kotanya[x].id+'">'+kotanya[x].name+'</option>'
                  );
              }
            } 

            var kecamatannya = getJSON("../../assets/js/kecamatan.json");
            $('#form-pesanan #kecamatan option').remove();
            $('#form-pesanan #kecamatan').append('<option value="">Pilih Kecamatannya</option>');
            for(var y = 0; y < kecamatannya.length; y++){
              if(kecamatannya[y].regency_id == transaction.data['kota']){                
                $('#form-pesanan #kecamatan').append(
                    '<option value="'+kecamatannya[y].id+'">'+kecamatannya[y].name+'</option>'
                  );
              }
            }             
          }

        });      
        
        $('#tbl-detil-pesanan tbody strong#total').text(formatNumber(transaction.data['total']));
        $('#tbl-detil-pesanan tbody strong#tipe_ongkos_kirim').text('(Rp '+transaction.data['tax']+'/kg - JNE '+transaction.data['tax_type']+')');
        $('#tbl-detil-pesanan tbody strong#ongkos_kirim').text(formatNumber(transaction.data['total_tax']));
        $('#tbl-detil-pesanan tbody strong#total_transfer').text(formatNumber(transaction.data['all_total']));

        $('#tbl-detil-pesanan tr.shop-item').remove();
        $.each(transaction.detil, function(detil_key,detil_value) {
          $('#tbl-detil-pesanan tbody').prepend(
            '<tr class="shop-item">'+
              '    <td class="col-sm-8 col-xs-6">'+                                
              '      <h4 class="media-heading">'+detil_value['name']+'</h4>'+ 
              '      <em>{ Warna: <strong id="colour">'+detil_value['option']['Color']+'</strong>'+ 
              '        / Ukuran: <strong id="size">'+detil_value['option']['Size']+'</strong>}'+
              '      </em>'+
              '    </td>'+
              '    <td class="text-center">'+detil_value['quantity']+'</td>'+
              '    <td class="text-center">Rp '+formatNumber(detil_value['price'])+'</td>'+
              '    <td class="text-right">Rp <strong>'+formatNumber(detil_value['sub_total'])+'</strong></td>'+                      
              '</tr>'
            );            
        });  
        
        $('#myModal .modal-header #myModalLabel').text('Edit Pesanan');
        $('#myModal .modal-footer #submit-pesanan').text('Update!');
        $('#myModal #form-pesanan #transaction_id').val(transaction_id);
        $('#myModal #form-pesanan').attr('action', 'update');        
      }

      /* MANAGEMENT EDIT PRODUK */
      else if(path.search('admin/produk') > 0){
        var post_ID = getUrlVars()["id"];
        var produk_detail = getJSON('http://'+host+path+'/action/ambil',{id: post_ID});
        $('#myModal .modal-body #post_title').val(produk_detail.data['post_title']);
        removeeditor();
        createeditor(produk_detail.data['post_content']);
        ajax_upload('produk');

        /* atribut produk */
        $('#myModal .modal-body #post_code').val(produk_detail.data['post_code']);
        $('#myModal .modal-body #post_price').val(produk_detail.data['post_price']);
        $('#myModal .modal-body #post_price_discount').val(produk_detail.data['post_discount']);
        $('#myModal .modal-body #post_stock').val(produk_detail.data['post_stock']);

        $.each(produk_detail.data['post_attribute'], function(key, value) {                
          if(value != "") $('#'+key).attr('value', value).prop('checked', true);

          if(key == 'post_image' && value != null){
            $.each(value, function(k, v) {   
              $('.image-list-wrap').append(
                  '<div class="image-single-item">'+
                  '  <a class="btn btn-primary remove-img-btn"><i class="icon-remove"></i></a>'+
                  '  <img src="'+v['tmb']+'" />'+
                  '  <input type="hidden" name="post_image[]" value="'+v['ori']+'" />'+
                  '</div>'
                );                            
            });  
          }      

        });

        /* atribut kategori */
        var kategori_produk = getJSON('http://'+host+path+'/kategori/ambil',{});          
        var post_category = produk_detail.data['post_category'].split(',');          
        var tree = unflatten( kategori_produk.record );
        var htmlStr = "";
        var printTree = function (node) {

            htmlStr = htmlStr + '<ul class="list-group check-list-group-kategori">';        
            
            for (var i = 0; i < node.length; i++){
              htmlStr = htmlStr + '<li class="list-group-item"><label class="checkbox inline"><input type="checkbox" name="category_slug[]" value="'+node[i]['category_slug']+'"> '+node[i]['category_name']+'</label></li>';                             
              
              if(node[i]['children']){
                printTree(node[i]['children'])
              }
              
              htmlStr = htmlStr + '</li>';         
            }
                         
            htmlStr = htmlStr + '</ul>';
            return htmlStr;
        }
        
        $('.tab-pane#kategori fieldset div.control-group').html(printTree(tree));

        for (var i in post_category) {
          // alert(post_category[i]);
          $('ul.check-list-group-kategori li.list-group-item input[type=checkbox][value='+post_category[i]+']').prop("checked",true);
        }

        /* atribut waktu */ 
        var postdate = moment(produk_detail.data['post_date']);
        $('#myModal .modal-body #date').val(postdate.format('D'));
        $('#myModal .modal-body #month option[value ="'+postdate.format('M')+'"]').prop('selected', true);
        $('#myModal .modal-body #year').val(postdate.format('YYYY'));
        $('#myModal .modal-body #hour').val(postdate.format('HH'));
        $('#myModal .modal-body #minute').val(postdate.format('mm')); 
        
        /* atribut komentar + atribut seo */
        if(produk_detail.data['comment_status'] != ""){
          $('#comment_status').prop('checked', true);
        }

        $('#myModal .modal-header #myModalLabel').text('Edit produk');
        $('#myModal .modal-footer #submit-produk').text('Update!');
        $('#myModal #form-produk').attr('action', 'update');
        $('#myModal #form-produk #post_id').val(post_ID);
      }       

      /* MANAGEMENT EDIT HALAMAN */
      else if(path.search('admin/halaman') > 0){
        var post_ID = getUrlVars()["id"];
        var halaman_detail = getJSON('http://'+host+path+'/action/ambil',{id: post_ID});

        // alert();

        var halaman = getJSON('http://'+host+path+'/action/ambil',{});
        $('#post_parent option').remove();
        $('#post_parent').append('<option value="">Pilih Induk Halaman</option>');
        if(halaman.record){
          $.each(halaman.record, function(key, value) {
               // if(value['post_ID' == halaman_detail.data['post_ID']]){}
               $('#post_parent').append('<option value="'+value['post_ID']+'">'+value['post_title']+'</option>');
          });          
        }

        $('#myModal .modal-body #post_parent option[value ="'+halaman_detail.data['post_parent']+'"]').prop('selected', true);
        
        removeeditor();
        createeditor(halaman_detail.data['post_content']);
        $('#myModal .modal-body #post_title').val(halaman_detail.data['post_title']);

        /* atribut komentar + atribut seo */
        if(halaman_detail.data['comment_status'] != ""){
          $('#comment_status').prop('checked', true);
        }

        $.each(halaman_detail.data['post_attribute'], function(key, value) {
          if(value != "") $('#'+key).attr('value', value).prop('checked', true);
        });

        $('#myModal .modal-header #myModalLabel').text('Edit Halaman');
        $('#myModal .modal-footer #submit-halaman').text('Update!');  
        $('#myModal #form-halaman').attr('action', 'update');        
        $('#myModal #form-halaman #post_id').val(post_ID);
      }        

      /* MANAGEMENT EDIT KOMENTAR */
      else if(path.search('admin/komentar') > 0){
        var comment_ID = getUrlVars()["id"];
        var comment_detail = getJSON('http://'+host+path+'/action/ambil',{id: comment_ID});

        $('#myModal .modal-body #comment_author_name').val(comment_detail.data['comment_author_name']);
        $('#myModal .modal-body #comment_author_email').val(comment_detail.data['comment_author_email']);
        $('#myModal .modal-body #comment_author_url').val(comment_detail.data['comment_author_url']);
        $('#myModal .modal-body #comment_content').val(comment_detail.data['comment_content']);
        $('#myModal .modal-body #comment_approved option[value ="'+comment_detail.data['comment_approved']+'"]').prop('selected', true);
        $('#myModal .modal-header #myModalLabel').text('Edit Komentar');
        $('#myModal .modal-footer #submit-komentar').text('Update!');  
        $('#myModal #form-komentar').attr('action', 'update');        
        $('#myModal #form-komentar #comment_ID').val(comment_detail.data['comment_ID']);        
      }      

      /* MANAGEMENT EDIT USER */
      else if(path.search('admin/user') > 0){
        var user_ID = getUrlVars()["id"];
        var user_detail = getJSON('http://'+host+path+'/action/ambil',{id: user_ID});
        
        for(var i in user_detail.data){
          
          if(i == 'group'){
            $('#form-user #'+i+' option[value ="'+user_detail.data[i]+'"]').prop('selected', true);
          }
          else if(i == 'password'){
            $('#form-user #'+i).val();            
            $('#form-user #'+i).after('<p class="help-block warning">kosongkan jika tidak ingin merubah password</p>');
          }
          else if(i == 'jenis_kelamin'){
            $('#form-user input[value="'+user_detail.data[i]+'"]').prop('checked', true);
          }
          else if(i == 'tanggal_lahir'){
            var tanggal_lahir = moment(user_detail.data[i]);
            $('#myModal .modal-body #date').val(tanggal_lahir.format('D'));
            $('#myModal .modal-body #month option[value ="'+tanggal_lahir.format('M')+'"]').prop('selected', true);
            $('#myModal .modal-body #year').val(tanggal_lahir.format('YYYY'));            
          }
          else if(i == 'provinsi'){
            $('#form-user #'+i+' option[value ="'+user_detail.data[i]+'"]').prop('selected', true);
            
            var kotanya = getJSON("../assets/js/kota.json");
            $('#kota option').remove();
            $('#kota').append('<option value="">Pilih Kota/Kabupatennya</option>');
            for(var x = 0; x < kotanya.length; x++){
              if(kotanya[x].province_id == user_detail.data[i]){                
                $('#kota').append(
                    '<option value="'+kotanya[x].id+'">'+kotanya[x].name+'</option>'
                  );
              }
            } 

            var kecamatannya = getJSON("../assets/js/kecamatan.json");
            $('#kecamatan option').remove();
            $('#kecamatan').append('<option value="">Pilih Kecamatannya</option>');
            for(var y = 0; y < kecamatannya.length; y++){
              if(kecamatannya[y].regency_id == user_detail.data['kota']){                
                $('#kecamatan').append(
                    '<option value="'+kecamatannya[y].id+'">'+kecamatannya[y].name+'</option>'
                  );
              }
            }             
          }

          else{
            $('#form-user #'+i).val(user_detail.data[i]);
          }

        }

        $('#form-user #kota option[value ="'+user_detail.data['kota']+'"]').prop('selected', true);
        $('#form-user #kecamatan option[value ="'+user_detail.data['kecamatan']+'"]').prop('selected', true);
        $('#myModal .modal-body #user_id').val(user_detail.data['ID']);
        $('#myModal .modal-header #myModalLabel').text('Edit User');
        $('#myModal .modal-footer #submit-user').text('Update!');  
        $('#myModal #form-user').attr('action', 'update');    
      }      
      
      $('#myModal').addClass('big-modal');
      $('#myModal').modal('show');      
    }

    else if(hash.search('hapus') == 0){

      /* MANAGEMENT HAPUS KATEGORI ARTIKEL */
      if(path.search('admin/artikel/kategori') > 0){
        var category_ID = getUrlVars()["id"];
        var kategori_detail = getJSON('http://'+host+path+'/ambil',{id: category_ID});          
        $('#myModal form').hide();  
        $('#myModal #form-kategori-artikel').attr('action', 'hapus');
        $('#myModal .modal-header #myModalLabel').text('Hapus Kategori Artikel');
        $('#myModal .modal-footer #submit-kategori-artikel').text('Ya Hapus Saja!');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"'+kategori_detail.data['category_name']+'"</b> ???</p>');
        $('#myModal #form-kategori-artikel #category_id').val(category_ID);      
      }

      /* MANAGEMENT HAPUS KATEGORI PRODUK */
      else if(path.search('admin/produk/kategori') > 0){
        var category_ID = getUrlVars()["id"];
        var kategori_detail = getJSON('http://'+host+path+'/ambil',{id: category_ID});          
        $('#myModal form').hide();  
        $('#myModal #form-kategori-produk').attr('action', 'hapus');
        $('#myModal .modal-header #myModalLabel').text('Hapus Kategori produk');
        $('#myModal .modal-footer #submit-kategori-produk').text('Ya Hapus Saja!');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"'+kategori_detail.data['category_name']+'"</b> ???</p>');
        $('#myModal #form-kategori-produk #category_id').val(category_ID);      
      }         

      /* MANAGEMENT HAPUS ARTIKEL */
      else if(path.search('admin/artikel') > 0){
        var post_ID = getUrlVars()['id'];
        var artikel_detail = getJSON('http://'+host+path+'/action/ambil', {id: post_ID});
        $('#myModal form').hide();
        $('#myModal .modal-header #myModalLabel').text('Hapus Artikel');
        $('#myModal .modal-footer #submit-artikel').text('Hapus Saja!');
        $('#myModal #form-artikel').attr('action','hapus');   
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : Artikel <b>'+artikel_detail.data['post_title']+'</b> ???</p>');
        $('#myModal #form-artikel #post_id').val(post_ID);
      }

      /* MANAGEMENT KONFIRMASI DAN PESANAN PRODUK */
      else if(path.search('admin/produk/pesanan') > 0){
        var transaction_id = getUrlVars()["id"];      
        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus Pesanan');
        $('#myModal .modal-footer #submit-pesanan').text('Ya Hapus Saja!');
        $('#myModal #form-pesanan').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"Invoice no. #'+transaction_id+'"</b> ???</p>');        
        $('#myModal #form-pesanan #transaction_id').val(transaction_id);
      }

      else if(path.search('admin/produk/konfirmasi') > 0){
        var confirmation_id = getUrlVars()["id"];  
        var confirmation = getJSON('http://'+host+path+'/ambil',{confirmation_id: confirmation_id});    
        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus Konfirmasi');
        $('#myModal .modal-footer #submit-konfirmasi').text('Ya Hapus Saja!');
        $('#myModal #form-konfirmasi').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"Konfirmasi dari. '+confirmation.data['nama_lengkap']+'"</b> ???</p>');        
        $('#myModal #form-konfirmasi #confirmation_id').val(confirmation_id);
      }

      /* MANAGEMENT HAPUS PORODUK */
      else if(path.search('admin/produk') > 0){
        var post_ID = getUrlVars()["id"];
        var produk_detail = getJSON('http://'+host+path+'/action/ambil',{id: post_ID});
        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus produk');
        $('#myModal .modal-footer #submit-produk').text('Ya Hapus Saja!');
        $('#myModal #form-produk').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"'+produk_detail.data['post_title']+'"</b> ???</p>');
        $('#myModal #form-produk #post_id').val(post_ID);
      } 

      /* MANAGEMENT HAPUS HALAMAN */
      else if(path.search('admin/halaman') > 0){
        var post_ID = getUrlVars()["id"];
        var halaman_detail = getJSON('http://'+host+path+'/action/ambil',{id: post_ID});

        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus Halaman');
        $('#myModal .modal-footer #submit-halaman').text('Ya Hapus Saja!');
        $('#myModal #form-halaman').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus : <b>"'+halaman_detail.data['post_title']+'"</b> ???</p>');
        $('#myModal #form-halaman #post_id').val(post_ID);
      }      
      
      /* MANAGEMENT HAPUS KOMENTAR */
      else if(path.search('admin/komentar') > 0){
        var comment_ID = getUrlVars()["id"];
        var komentar_detail = getJSON('http://'+host+path+'/action/ambil',{id: comment_ID});

        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus Komentar');
        $('#myModal .modal-footer #submit-komentar').text('Ya Hapus Saja!');
        $('#myModal #form-komentar').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus komentar dari : <b>"'+komentar_detail.data['comment_author_name']+'"</b> ???</p>');
        $('#myModal #form-komentar #comment_ID').val(comment_ID);
      }

      /* MANAGEMENT HAPUS USER */      
      else if(path.search('admin/user') > 0){
        var user_ID = getUrlVars()["id"];
        var user_detail = getJSON('http://'+host+path+'/action/ambil',{id: user_ID});

        $('#myModal form').hide();  
        $('#myModal .modal-header #myModalLabel').text('Hapus User');
        $('#myModal .modal-footer #submit-user').text('Ya Hapus Saja!');
        $('#myModal #form-user').attr('action', 'hapus');
        $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan menghapus user : <b>"'+user_detail.data['username']+'"</b> ???</p>');
        $('#myModal #form-user #user_id').val(user_ID);
      }
      
      $('#myModal').modal('show');  
    }

    else if(hash.search('ambil') == 0){

      /* MANAGEMENT AMBIL ARTIKEL */
      if(path.search('admin/artikel')  > 0){
        
        var hal_aktif, cari, kategori = null;
        var hash = getUrlVars();

        
        if(hash['kategori'] && hash['hal']){
          hal_aktif = hash['hal'];
          kategori = hash['kategori'];
          $('#lbl-filter-artikel').text(humanize(kategori));
          $('#search').val("");
        }

        else if(hash['cari'] && hash['hal']){
          hal_aktif = hash['hal'];
          cari = hash['cari'];
          $('#lbl-filter-artikel').text('Filter Kategori');
        }

        else if(hash['hal']){
          hal_aktif = hash['hal'];
        }

        ambil_artikel(hal_aktif,true,kategori,cari);
        $("ul#pagination-artikel li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');        
      }

      /* MANAGEMENT KONFIRMASI DAN PESANAN PRODUK */
      else if(path.search('admin/produk/pesanan') > 0){
        var hal_aktif, cari, status = null;        
        var hash = getUrlVars();
        if(hash['status'] && hash['hal']){
          hal_aktif = hash['hal'];
          status = hash['status'];
          $('#lbl-filter-pesanan').text(humanize(status));
          $('#search').val("");
        }
        else if(hash['cari'] && hash['hal']){
          hal_aktif = hash['hal'];
          cari = hash['cari'];
          $('#lbl-filter-pesanan').text('Filter Kategori');
        }
        else if(hash['hal']){
          hal_aktif = hash['hal'];          
        }        
        ambil_pesanan(hal_aktif,true,status,cari);
        $("ul#pagination-pesanan li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');          
      }

      else if(path.search('admin/produk/konfirmasi') > 0){
        var hal_aktif, cari = null;        
        var hash = getUrlVars();
        if(hash['cari'] && hash['hal']){
          hal_aktif = hash['hal'];
          cari = hash['cari'];
        }
        else if(hash['hal']){
          hal_aktif = hash['hal'];          
        }        
        ambil_konfirmasi(hal_aktif,true,cari);
        $("ul#pagination-konfirmasi li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');          
      }

      /* MANAGEMENT AMBIL PRODUK */
      else if(path.search('admin/produk') > 0){
        var hal_aktif, cari, kategori = null;        
        var hash = getUrlVars();
        if(hash['kategori'] && hash['hal']){
          hal_aktif = hash['hal'];
          kategori = hash['kategori'];
          $('#lbl-filter-produk').text(humanize(kategori));
          $('#search').val("");
        }
        else if(hash['cari'] && hash['hal']){
          hal_aktif = hash['hal'];
          cari = hash['cari'];
          $('#lbl-filter-produk').text('Filter Kategori');
        }
        else if(hash['hal']){
          hal_aktif = hash['hal'];          
        }        

        ambil_produk(hal_aktif,true,kategori,cari);
        $("ul#pagination-produk li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');          
      }

      /* MANAGEMENT AMBIL KOMENTAR */
      else if(path.search('admin/komentar') > 0){
        var hal_aktif, cari= null;      
        var hash = getUrlVars();
        if(hash['cari'] && hash['hal']){

          hal_aktif = hash['hal'];
          cari = hash['cari'];
        }
        else if(hash['hal']){
          hal_aktif = hash['hal'];          
        }        

        ambil_komentar(hal_aktif,true,cari);
        $("ul#pagination-komentar li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');  
      }     

      /* MANAGEMENT AMBIL STATISTIK */
      else if(path.search('admin/statistik') > 0){
        var visitor_ID = getUrlVars()["id"];
        var visitor_detail = getJSON('http://'+host+path+'/action/ambil',{id: visitor_ID});

        if(!visitor_detail[0].visitor_referer){
          visitor_detail[0].visitor_referer = '-';
        }

        $('#myModal .modal-body #visitor_date').text(moment(visitor_detail[0].visitor_date).format('LLLL'));
        $('#myModal .modal-body #visitor_isp').text(visitor_detail[0].visitor_isp);
        $('#myModal .modal-body #visitor_country').text(visitor_detail[0].visitor_country);
        $('#myModal .modal-body #visitor_region').text(visitor_detail[0].visitor_region);
        $('#myModal .modal-body #visitor_city').text(visitor_detail[0].visitor_city);
        $('#myModal .modal-body #visitor_referer').text(visitor_detail[0].visitor_referer);
        $('#myModal .modal-body #visitor_IP').text(visitor_detail[0].visitor_IP);
        $('#myModal .modal-body #visitor_browser').text(visitor_detail[0].visitor_browser);
        $('#myModal .modal-body #visitor_os').text(visitor_detail[0].visitor_os);
        $('#myModal').addClass('big-modal');
        $('#myModal').modal('show');
      }   

      /* MANAGEMENT AMBIL USER */
      else if(path.search('admin/user') > 0){
        var hal_aktif, cari= null;        
        var hash = getUrlVars();
        if(hash['cari'] && hash['hal']){
          hal_aktif = hash['hal'];
          cari = hash['cari'];
        }
        else if(hash['hal']){
          hal_aktif = hash['hal'];          
        }        

        ambil_user(hal_aktif,true,cari);
        $("ul#pagination-user li a:contains('"+hal_aktif+"')").parents().addClass('active').siblings().removeClass('active');      
      }         
    }

    else if(hash.search('mass') == 0){

      /* MANAGEMENT AKSI MASAL ARTIKEL */
      if(path.search('admin/artikel') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-artikel input:checkbox:checked').length; 
        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }
          else if(action == 'publish'){
            var note = 'mempublish';
          }
          else if(action == 'pending'){
            var note = 'mempending';
          }

          $('#myModal #form-artikel').attr('action', 'mass');
          $('#myModal #form-artikel #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi Artikel masal');
          $('#myModal .modal-footer #submit-artikel').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"artikel-artikel terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-artikel').hide();
          $('#myModal #form-artikel').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi artikel tidak bisa dilakukan karena tidak ada satupun artikel yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide(); 
      }

      /* MANAGEMENT AKSI MASAL KONFIRMASI DAN PESANAN PRODUK */
      else if(path.search('admin/produk/pesanan') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-pesanan input:checkbox:checked').length; 
        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }          
          else if(action == 'pending'){
            var note = 'mempending';
          }
          else if(action == 'sudah_transfer'){
            var note = 'merubah status jadi "sudah transfer"';
          }
          else if(action == 'sudah_dikirim'){
            var note = 'merubah status jadi "sudah dikirim"';
          }

          else if(action == 'cetak_alamat'){
            var note = '"mencetak alamat"';
          }

          $('#myModal #form-pesanan').attr('action', 'mass');
          $('#myModal #form-pesanan #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi pesanan masal');
          $('#myModal .modal-footer #submit-pesanan').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"pesanan terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-pesanan').hide();
          $('#myModal #form-pesanan').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi pesanan tidak bisa dilakukan karena tidak ada satupun pesanan yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide();         
      }

      else if(path.search('admin/produk/konfirmasi') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-konfirmasi input:checkbox:checked').length; 
        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }          
          else if(action == 'pending'){
            var note = 'mempending';
          }
          else if(action == 'sudah_transfer'){
            var note = 'merubah status jadi "sudah transfer"';
          }

          $('#myModal #form-konfirmasi').attr('action', 'mass');
          $('#myModal #form-konfirmasi #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi konfirmasi masal');
          $('#myModal .modal-footer #submit-konfirmasi').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"konfirmasi terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-konfirmasi').hide();
          $('#myModal #form-konfirmasi').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi konfirmasi tidak bisa dilakukan karena tidak ada satupun konfirmasi yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide();         
      } 

      /* MANAGEMENT AKSI MASAL PRODUK */
      else if(path.search('admin/produk') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-produk input:checkbox:checked').length; 

        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }
          else if(action == 'publish'){
            var note = 'mempublish';
          }
          else if(action == 'pending'){
            var note = 'mempending';
          }

          $('#myModal #form-produk').attr('action', 'mass');
          $('#myModal #form-produk #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi produk masal');
          $('#myModal .modal-footer #submit-produk').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"produk-produk terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-produk').hide();
          $('#myModal #form-produk').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi produk tidak bisa dilakukan karena tidak ada satupun produk yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide(); 
      } 

      /* MANAGEMENT AKSI MASAL KOMENTAR */
      else if(path.search('admin/komentar') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-komentar input:checkbox:checked').length; 
        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }
          else if(action == 'publish'){
            var note = 'mempublish';
          }
          else if(action == 'pending'){
            var note = 'mempending';
          }

          $('#myModal #form-komentar').attr('action', 'mass');
          $('#myModal #form-komentar #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi Artikel masal');
          $('#myModal .modal-footer #submit-komentar').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"komentar-komentar terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-komentar').hide();
          $('#myModal #form-komentar').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi komentar tidak bisa dilakukan karena tidak ada satupun komentar yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide();
      }     

      /* MANAGEMENT AKSI MASAL USER */ 
      else if(path.search('admin/user') > 0){
        var action = getUrlVars()['action'];
        var numberOfChecked = $('#tbl-user input:checkbox:checked').length; 
        if(numberOfChecked > 0){
          if(action == 'hapus'){
            var note = 'menghapus';
          }
          else if(action == 'aktifkan'){
            var note = 'mengaktifkan';
          }
          else if(action == 'non-aktifkan'){
            var note = 'menonaktifkan';
          }

          $('#myModal #form-user').attr('action', 'mass');
          $('#myModal #form-user #mass_action_type').val(action);
          $('#myModal .modal-header #myModalLabel').text('Aksi User masal');
          $('#myModal .modal-footer #submit-user').text('Ya Langsung Saja!').show();
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Apakah Anda yakin akan '+note+' : <b>"user terpilih"</b> ???</p>');
        }
        else{
          $('#myModal .modal-header #myModalLabel').text('Peringatan!!');
          $('#myModal .modal-footer #submit-user').hide();
          $('#myModal #form-user').attr('action', 'bulk');
          $('#myModal .modal-body').prepend('<p id="hapus-notif">Mohon maaf, aksi user tidak bisa dilakukan karena tidak ada satupun user yang di ceklis. Silahkan ceklis satu atau beberapa ...</p>');
        }
        $('#myModal form').hide();        
      }

      $('#myModal').modal('show');
    }

    /* KHUSUS MANAGEMENT TAMPILAN */
    if(path.search('admin/tampilan') > 0){
      
      $('#myModal').addClass('big-modal');

      if(hash.search('setting') == 0){
        var template_detail = getJSON('http://'+host+path+'/action/ambil',{option_name: 'template_setting'});
        
        $('#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group').empty();

        $.each(template_detail.template_setting['template_attribute'], function(index,element){
          if(template_detail.template_setting['template_attribute'][index].type == 'text'){            
            $('#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group').append(
            
              '<label class="control-label">'+humanize(index)+'</label>'+
              '<div class="controls">'+
              '<input type="text" name="'+index+'" id="'+index+'" class="form-control input-block-level" value="'+template_detail.template_setting['template_attribute'][index].value+'" /> '+
              '</div>'    
            );                   
          }    
        });

        $('#myModal .modal-body #form-tampilan fieldset.form-horizontal').show();
        $('#myModal .modal-body div.template_detail').remove();
        $('#myModal .modal-body #form-tampilan').attr('action', 'update');
        $('#myModal .modal-header #myModalLabel').text('Setting Tampilan');
        $('#myModal .modal-footer #submit-tampilan').text('Simpan!');
        $('#myModal').modal('show');
      }
      else if(hash.search('aktifkan') == 0){
        var template = getUrlVars()['template'];
        var template_detail = getJSON('http://'+host+path+'/action/ambil',{template: template});

        $('#myModal .modal-body div.template_detail').remove();
        $('#myModal .modal-body').append(
          '<div class="template_detail">'+
            '<div class="span4">'+
              '<img src="http://'+host+path.replace('admin/tampilan', 'templates/frontend/')+template_detail['data'].template_directory+'/screenshot.png" />'+
            '</div>'+
            '<div class="span5">'+
              '<h2>Template '+template_detail['data'].template_name+' '+template_detail['data'].template_version+'</h2>'+
              '<p>Dibuat oleh: <strong>'+template_detail['data'].template_author+'</strong></p>'+
              template_detail['data'].template_description+
            '</div>'+
          '</div>');

        $('#myModal .modal-body #form-tampilan').attr('action', 'update');
        $('#myModal .modal-body #form-tampilan #template_directory').val(template);
        $('#myModal .modal-body #form-tampilan fieldset.form-horizontal').hide();
        $('#myModal .modal-header #myModalLabel').text('Aktifkan Template '+humanize(template));
        $('#myModal .modal-footer #submit-tampilan').text('Aktifkan Template Ini!');
        $('#myModal').modal('show');
      }            
    }    

    /* KHUSUS MANAGEMENT KONFIGURASI */
    var arr_menu = ["konfigurasi-umum", "konfigurasi-komentar", "konfigurasi-konten", "konfigurasi-seo", "konfigurasi-toko-online"];
  
    if(jQuery.inArray(hash, arr_menu) != -1){
      $('.nav-tabs a[href="#' + hash + '"]').tab('show');
      $('body').scrollTop(0);
    }
  });

  $(window).trigger('hashchange');

  $('#myModal').on('hidden', function(){
    window.history.pushState(null,null,path);
    $('#myModal').removeClass('big-modal');
    $('#myModal #userfile').show();
    $('#myModal .featured_image').remove();
    $('#myModal #featured_image').remove();
    $('#myModal #remove_featured_image').remove();
    $('#myModal #featured_image_thumbnail').remove();
    $('#myModal .image-list-wrap .image-single-item').remove();

    $('#myModal #hapus-notif').remove();
    $('#myModal form').find("input[type=text], input[type=hidden], input[type=password], input[type=email], textarea").val("").attr('placeholder', '');   
    $('#myModal form').find("input[type=checkbox],input[type=radio]").removeAttr('checked'); 
    $('#myModal form').find("select").prop("selected", false); 
    $('#myModal form p.warning').remove();
    $('#myModal form').show(); 
  });

  $('#btn-check-all').toggle(function(){
      $('table input:checkbox').attr('checked','checked');
    }, function(){
      $('table input:checkbox').removeAttr('checked');
    }
  );

  $(document).on('keyup','#search', function(){
    delay(function(){
      var searchkey = $('#search').val();
      window.location.hash = "#ambil?cari="+searchkey+"&hal=1";
    }, 1000);
  });

  moment.locale('id');

  /* ******************************************************************** */
  /*                         BACKEND BAGIAN ARTIKEL                       */
  /* ******************************************************************** */

  $(document).on('click', '#submit-artikel', function(eve){
    eve.preventDefault();

    var action = $('#form-artikel').attr('action');
    var mass_action_type = $('#form-artikel #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-artikel input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-artikel').serialize() + '&post_content='+editor.getData();
    }
    

    $.ajax('http://'+host+path+'/action/'+action,{
      dataType:'json',
      type: 'POST', 
      data: datatosend,
      success: function(data){
        if(data.status == 'success'){
          ambil_artikel(null,false);
          $('#myModal').modal('hide');
          $('div.widget-content').prepend(
              '<div class="control-group"><div class="alert alert-info">'+
              '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
              '<strong>Berhasil!</strong> Artikel telah diperbaharui ... </div></div>'
            );          
        }
        else{
          $.each(data.errors, function(key, value){
            $('#'+key).attr('placeholder', value);
          });
        }
      }

    });
  });

  /* ******************************************************************** */
  /* Ambil Artikel (READ) */
  /* ******************************************************************** */
  // ambil_artikel(null,false);
  if(getUrlVars()["hal"]){ ambil_artikel(getUrlVars()["hal"],false); }
  else{ ambil_artikel(null,false);}

  remove_featured_image();

  /* ******************************************************************** */
  /* Tambah / Update Hapus Kategori Artikel (CREATE UPDATE DELETE)  */
  /* ******************************************************************** */
  $(document).on('click','#submit-kategori-artikel', function(eve){
    eve.preventDefault();
    var action = $('#form-kategori-artikel').attr('action');

    $.ajax('http://'+host+path+'/'+action, {
      dataType : 'json',
      type : 'POST',
      data: $('#form-kategori-artikel').serialize(),
      success: function(data){
        if(data.status == 'success'){
          ambil_kategori();
          $('#myModal').modal('hide');
        }
        else{
          $.each(data.errors, function(key, value) {
            $('#'+key).attr('placeholder', value);
          });
        }
         
      }

    });  
  });

  /* ************************************** */
  /* Ambil Kategori (READ) */
  /* ************************************** */    
  ambil_kategori();


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN HALAMAN                       */
  /* ******************************************************************** */
  $(document).on('click','#submit-halaman', function(eve){
    eve.preventDefault();
    var action = $('#form-halaman').attr('action');

    if(action == 'hapus'){
      var datatosend = $('#form-halaman').serialize();
    } 
    else{
      var datatosend = $('#form-halaman').serialize() + '&post_content='+editor.getData();
    }

    $.ajax('http://'+host+path+'/action/'+action, {
      dataType : 'json',
      type : 'POST',
      data: datatosend,
      success: function(data){
         
         if(data.status == 'success'){
            ambil_halaman();
            $('#form-halaman').find("input[type=text], textarea").val("");
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Halaman Telah Diperbaharui ...</div></div>'
              );
         }
         else{
            $.each(data.errors, function(key, value) {
                 $('#'+key).attr('placeholder', value);
            });
         }
         
      }

    });    
  });
  
  ambil_halaman();

  /* ******************************************************************** */
  /*                         BACKEND BAGIAN KOMENTAR                       */
  /* ******************************************************************** */  

  ambil_komentar();

  $(document).on('click','#submit-komentar', function(eve){
    eve.preventDefault();
    var action = $('#form-komentar').attr('action');
    var mass_action_type = $('#form-komentar #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-komentar input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-komentar').serialize();
    }

    

    $.ajax('http://'+host+path+'/action/'+action, {
      dataType : 'json',
      type : 'POST',
      data: datatosend,
      success: function(data){
         
         if(data.status == 'success'){
            ambil_komentar();
            $('#form-komentar').find("input[type=text], textarea").val("");
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Komentar Telah Diperbaharui ...</div></div>'
              );
         }
         
      }

    });    
  });


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN TAMPILAN                       */
  /* ******************************************************************** */  
  ambil_tampilan();

  $(document).on('click','#submit-tampilan', function(eve){
    var action = $('#form-tampilan').attr('action');
    
    $.ajax('http://'+host+path+'/action/'+action, {
      dataType : 'json',
      type : 'POST',
      data: $('#form-tampilan').serialize(),
      success: function(data){
         
         if(data.status == 'success'){
            ambil_tampilan();
            $('#form-tampilan').find("input[type=text], input[type=hidden]").val("");
            $('#myModal').modal('hide');
         }
         
      }

    });      
  });


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN STATISTIK                       */
  /* ******************************************************************** */  
  ambil_statistik();


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN KONFIGURASI                       */
  /* ******************************************************************** */  

  $('#tab-konfigurasi.nav-tabs a').on('shown.bs.tab', function (e) {
    window.location.hash = e.target.hash;
    $('body').scrollTop(0);
  });


  ambil_konfigurasi();

  /* FORM SUBMIT UNTUK KIRIM SEMUA KONFIGURASI */
  $(document).on('click','#submit-konfigurasi', function(eve){
    eve.preventDefault();
    $.ajax('http://'+host+path+'action/update', {
        dataType : 'json',
        type : 'POST',
        data: $('.form-konfigurasi').serialize(),
        success: function(data){
          if(data.status = 'success'){
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Konfigurasi Baru Telah Disimpan ...</div></div>'
              );
          }
        }

      });   
  });

  /* UNTUK KONFIGURASI TOKO ONLINE */
  $(document).on('click', '#tambah-rekening', function(eve){
    eve.preventDefault();

    var total_rekening = $('div.rekening-satuan').length ; 
    var rekening_baru = total_rekening + 1;

    $('div.wrap-rekening').append(
      '<div class="rekening-satuan">'+
      '  <h3 class="head-rekening">No. Rekening '+rekening_baru+'</h3> '+
      '  <a class="btn btn-danger" id="hapus-rekening"><i class="icon-remove"></i> Hapus Rekening Ini</a>'+
      '  <br />'+
      '  <label class="control-label" for="jenis_rekening">Jenis Rekening</label>'+
      '  <div class="controls">'+
      '    <select name="jenis_rekening[]" id="jenis_rekening_'+rekening_baru+'">'+                                  
      '      <option value="0">Pilih Rekening</option>'+          
      '      <option value="BCA">BCA</option>'+
      '      <option value="BNI">BNI</option>'+     
      '      <option value="BNI_Syariah">BNI Syariah</option>'+                             
      '      <option value="BRI">BRI</option>'+  
      '      <option value="BRI_Syariah">BRI Syariah</option>'+  
      '      <option value="Mandiri">Bank Mandiri</option>'+
      '      <option value="Syariah_Mandiri">Bank Syariah Mandiri</option>'+      
      '    </select>'+                           
      '  </div>'+
      '  <label class="control-label" for="nomor_rekening">Nomor Rekening</label>'+
      '  <div class="controls">'+
      '    <input type="text" class="span3" name="nomor_rekening[]" id="nomor_rekening_'+rekening_baru+'">'+                         
      '  </div>'+
      '  <label class="control-label" for="atas_nama">Atas Nama</label>'+
      '  <div class="controls">'+
      '    <input type="text" class="span3" name="atas_nama[]" id="atas_nama_'+rekening_baru+'">'+                         
      '  </div>'+
      '</div>'
      );
  });

  $(document).on('click', '#hapus-rekening', function(eve){
    eve.preventDefault();
    $(this).parents('div.rekening-satuan').remove();
  });

  $(document).on('change', '#provinsi', function(eve){
    eve.preventDefault();
    var idprovinsi = $(this).val();
    if((path.search('admin/produk/pesanan') > 0) || (path.search('admin/konfigurasi') > 0)){
      var kotanya = getJSON("../../assets/js/kota.json");
    }
    else{
      var kotanya = getJSON("../assets/js/kota.json");
    }
    
    $('#kota option').remove();
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

  $(document).on('change', '#kota', function(eve){
    eve.preventDefault();
    var idkota = $(this).val();

    if((path.search('admin/produk/pesanan') > 0) || (path.search('admin/konfigurasi') > 0)){
      var kecamatannya = getJSON("../../assets/js/kecamatan.json");
    }
    else{
      var kecamatannya = getJSON("../assets/js/kecamatan.json");
    }
    
    $('#kecamatan option').remove();
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


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN USER                       */
  /* ******************************************************************** */  

  ambil_user();

  $(document).on('click','#submit-user', function(eve){
    eve.preventDefault();
    var action = $('#form-user').attr('action');

    var mass_action_type = $('#form-user #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-user input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-user').serialize();
    }


    $.ajax('http://'+host+path+'/action/'+action, {
        dataType : 'json',
        type : 'POST',
        data: datatosend,
        success: function(data){
          if(data.status == 'success'){
            ambil_user();
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> User telah berhasil diperbaharui ...</div></div>'
              );
          }
          else{
            $.each(data.errors, function(key, value) {
                 $('#'+key).after('<p class="help-block warning">'+value+'</p>');
            });
         }

        }

      });  
  });


  /* ******************************************************************** */
  /*                         BACKEND BAGIAN DASHBOARD                       */
  /* ******************************************************************** */ 
  ambil_dashboard();



  /* ******************************************************************** */
  /*                         BACKEND BAGIAN PRODUK                       */
  /* ******************************************************************** */
  $(document).on('click','a.remove-img-btn', function(eve){
    eve.preventDefault();
    $(this).parents('div.image-single-item').remove();
  });

  $(document).on('click','#submit-produk', function(eve){
    eve.preventDefault();
    var action = $('#form-produk').attr('action');
    var mass_action_type = $('#form-produk #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-produk input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-produk').serialize() + '&post_content='+editor.getData();
    }

    $.ajax('http://'+host+path+'/action/'+action, {
      dataType : 'json',
      type : 'POST',
      data: datatosend,
      success: function(data){
         
         if(data.status == 'success'){
            ambil_produk(null,false);
            $('#form-produk').find("input[type=text], textarea").val("");
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Artikel Telah Diperbaharui ...</div></div>'
              );
         }
         else{
            $.each(data.errors, function(key, value) {
                 $('#'+key).attr('placeholder', value);
            });
         }
         
      }

    });    
  });

  $(document).on('click','#submit-pesanan', function(eve){

    eve.preventDefault();
    var action = $('#form-pesanan').attr('action');
    var mass_action_type = $('#form-pesanan #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-pesanan input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-pesanan').serialize() ;
    }


    $.ajax('http://'+host+path+'/'+action, {
      dataType : 'json',
      type : 'POST',
      data: datatosend,
      success: function(data){
         if(data.file){
          window.location = data.file;
         }
         else if(data.status == 'success'){
            ambil_pesanan(null,false);
            $('#form-pesanan').find("input[type=text], textarea").val("");
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Pesanan Telah Diperbaharui ...</div></div>'
              );
         }

         
      }

    });
  });
  
  $(document).on('click','#submit-konfirmasi', function(eve){
    eve.preventDefault();
    var action = $('#form-konfirmasi').attr('action');
    var mass_action_type = $('#form-konfirmasi #mass_action_type').val();

    if(action == 'mass'){
      var datatosend = $('#tbl-konfirmasi input').serialize() + '&mass_action_type='+mass_action_type;
    }
    else{
      var datatosend = $('#form-konfirmasi').serialize() ;
    }

    $.ajax('http://'+host+path+'/'+action, {
      dataType : 'json',
      type : 'POST',
      data: datatosend,
      success: function(data){
         if(data.file){
          window.location = data.file;
         }
         else if(data.status == 'success'){
            ambil_konfirmasi(null,false);
            $('#form-konfirmasi').find("input[type=text], textarea").val("");
            $('#myModal').modal('hide');
            $('div.widget-content').prepend(
                  '<div class="control-group"><div class="alert alert-info">'+
                  '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                  '<strong>Berhasil!</strong> Konfirmasi Telah Diperbaharui ...</div></div>'
              );
         }

         
      }

    });    
  });

  if(getUrlVars()["hal"]){ 
    ambil_produk(getUrlVars()["hal"],false); 
    ambil_pesanan(getUrlVars()["hal"],false);
    ambil_konfirmasi(getUrlVars()["hal"],false);
  }
  else{ 
    ambil_produk(null,false);
    ambil_pesanan(null,false);
    ambil_konfirmasi(null,false);
  }

  /* Tambah / Update Hapus Kategori PRODUK (CREATE UPDATE DELETE)  */
  $(document).on('click','#submit-kategori-produk', function(eve){
    eve.preventDefault();
    var action = $('#form-kategori-produk').attr('action');

    $.ajax('http://'+host+path+'/'+action, {
      dataType : 'json',
      type : 'POST',
      data: $('#form-kategori-produk').serialize(),
      success: function(data){
        if(data.status == 'success'){
          ambil_kategori();
          $('#myModal').modal('hide');
        }
        else{
          $.each(data.errors, function(key, value) {
            $('#'+key).attr('placeholder', value);
          });
        }
         
      }

    });  
  });


  /* MENCEGAH SUBMIT MENGGUNAKAN ENTER PADA INPUT */
  $(document).on('submit','#myModal form', function(eve){
    eve.preventDefault();
  });  

});


/* ************************************** */
/*        ANEKA JAVASCRIPT FUNCTION       */
/* *************************w************* */

function ambil_artikel(hal_aktif,scrolltop,kategori,cari){
  if($('table#tbl-artikel').length > 0){
    // alert('ada tablenya');
    $.ajax('http://'+host+path+'/action/ambil',{
      dataType:'json',
      type: 'POST', 
      data:{hal_aktif:hal_aktif, kategori:kategori, cari:cari},
      success: function(data){
        $('table#tbl-artikel tbody tr').remove();
        $.each(data.record , function(index, element){
          var post_status = '';
          if(element.post_status == 'pending'){
            post_status = '(pending)';
          }
          
          $('table#tbl-artikel').find('tbody').append(
            '<tr>'+
            '  <td width="2%"><input type="checkbox" name="post_id[]" value="'+element.post_ID+'"></td>'+
            '  <td width="50%"><a class="link-edit" href="artikel#edit?id='+element.post_ID+'">'+element.post_title+'</a> <strong>'+post_status+'</strong></td>'+
            '  <td width="10%"><i class="icon-comment-alt"></i> <span class="value">'+element.comment_count+'</span></td>'+
            '  <td width="10%"><i class="icon-eye-open"></i> <span class="value">'+element.post_counter+'</span></td>'+
            '  <td width="12%"><i class="icon-time"></i> <span class="value">'+moment(element.post_date).fromNow()+'</span></td>'+
            '  <td width="16%" class="td-actions">'+
            '    <a href="artikel#edit?id='+element.post_ID+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a>'+
            '    <a href="artikel#hapus?id='+element.post_ID+'" class="btn btn-invert btn-small btn-info"><i class="btn-icon-only icon-remove" id="hapus_1"></i> Hapus</a>'+
            '  </td>'+
            '</tr>'                
          )
        });
        
        /* BAGIAN UNTUK PAGINATION DILETAKKAN DISINI */
        var pagination = '';
        var paging = Math.ceil(data.total_rows / data.perpage);

        if( (!hal_aktif) && ($('ul#pagination-artikel li').length == 0)){
          $('ul#pagination-artikel li').remove();
          for(i = 1; i <= paging ; i++){
            pagination = pagination + '<li><a href="artikel#ambil?hal='+i+'">'+i+'</a></li>';
          }
        }
        else if(hal_aktif && kategori){
          $('ul#pagination-artikel li').remove();
          for(i = 1; i <= paging ; i++){
            pagination = pagination + '<li><a href="artikel#ambil?kategori='+kategori+'&hal='+i+'">'+i+'</a></li>';
          }
        }
        else if(hal_aktif && cari){
          $('ul#pagination-artikel li').remove();
          for(i = 1; i <= paging ; i++){
            pagination = pagination + '<li><a href="artikel#ambil?cari='+kategori+'&hal='+i+'">'+i+'</a></li>';
          }
        }
        else if(hal_aktif){
          $('ul#pagination-artikel li').remove();
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="artikel#ambil?&hal='+i+'">'+i+'</a></li>';
          }               
        }
        

        $('ul#pagination-artikel').append(pagination);
        $("ul#pagination-artikel li:contains('"+hal_aktif+"')").addClass('active');

        /* UNTUK FILTER KATEGORI */
        $('#btn-filter-artikel li').remove();
        $('#btn-filter-artikel').append('<li><a href="artikel">Semua Kategori</a></li>');
        for(var i in data.all_category){

          $('#btn-filter-artikel').append('<li><a href="artikel#ambil?kategori='+data.all_category[i]['category_slug']+'&hal=1">'+data.all_category[i]['category_name']+'</a></li>');
        }

        if(scrolltop == true) {
          $('body').scrollTop(0);
        }
    
      }

    });
  }
}

function ambil_kategori(){
  // jsfiddle.net/LkkwH/1/
  // http://jsfiddle.net/sw_lasse/9wpHa/
  var path = window.location.pathname;
  var host = window.location.hostname;  
  if($('#list-kategori').length > 0){
    $.ajax('http://'+host+path+'/ambil', {
      dataType : 'json',
      type : 'POST',
      success: function(data){
          
          var htmlStr = "";
          var printTree = function (node) {

              htmlStr = htmlStr + '<ul class="list-group hirarki kategori">';        
              
              for (var i = 0; i < node.length; i++){
                    if(node[i]['children']) var listyle = 'li-parent';
                    else listyle = '';
                    htmlStr = htmlStr + '<li id="ID_'+node[i]['category_ID']+'" class="list-group-item '+listyle+'">';          
                    htmlStr = htmlStr + '<a class="link-edit" href="kategori#edit?id='+node[i]['category_ID']+'">'+node[i]['category_name']+'</a>';
                    htmlStr = htmlStr + '<div class="pull-right">';
                    htmlStr = htmlStr + '<a href="kategori#edit?id='+node[i]['category_ID']+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ';
                    htmlStr = htmlStr + '<a href="kategori#hapus?id='+node[i]['category_ID']+'" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>';
                    htmlStr = htmlStr + '</div>'
                    
                    if(node[i]['children']){
                      printTree(node[i]['children'])
                    }
                    
                    htmlStr = htmlStr + '</li>';         
              }
              
             
              htmlStr = htmlStr + '</ul>';
              return htmlStr;
          }

          tree = unflatten( data.record );
          $('#list-kategori').html(printTree(tree));
          
          $('#list-kategori .list-group').sortable({
            opacity: 0.5,
            cursor: 'move',
            placeholder: 'ui-state-highlight',
            update: function() {
                  var orderAll = [];
                  $('.list-group li').each(function(){
                       orderAll.push($(this).attr('id').replace(/_/g, '[]='));
                  });
                  
                  // alert($(this).sortable('serialize'));
                  $.post( 'http://'+host+path+'/sortir', orderAll.join('&'));
              }
          });               
      }

    });
  }
}

function unflatten( array, parent, tree ){
  tree = typeof tree !== 'undefined' ? tree : [];
  parent = typeof parent !== 'undefined' ? parent : { category_ID: 0 };
      
  var children = _.filter( array, function(child){ return child.category_parent == parent.category_ID; });
  
  if( !_.isEmpty( children )  ){
      if( parent.category_ID == 0 ){
         tree = children;   
      }else{
         parent['children'] = children;
      }
      _.each( children, function( child ){ unflatten( array, child ) } );                    
  }
  
  return tree;
}

function getJSON(url,data){
  return JSON.parse($.ajax({
    type: 'POST',
    url : url,
    data:data,
    dataType:'json',
    global: false,
    async: false,
    success:function(msg){

    }
  }).responseText);
}

function getUrlVars(){
  var vars = [], hash;
  var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
  for(var i = 0; i < hashes.length; i++)
  {
      hash = hashes[i].split('=');
      vars.push(hash[0]);
      vars[hash[0]] = hash[1];
  }
  return vars;
}

function createeditor(content){
  if ( editor ) return;
  editor = CKEDITOR.appendTo( 'wrap_editor', 
  {
    bodyId: 'post_content',
    entities: false,
    uiColor: '#fafafa', 
    height: '800px',
    toolbar: [
      '/',
      { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
      { name: 'tools', items: [ 'Maximize' ] },
      { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-' ] },
      { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ] },
      { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: ['Undo', 'Redo' ] },
      { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
      { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
      { name: 'styles', items: [ 'Styles', 'Format' ] }
      
    ]
  
  }, content );
}

function removeeditor() {
  if ( !editor )
    return;

  // Destroy the editor.
  editor.destroy();
  editor = null;
}

function humanize(str){
  str = str.replace(/-/g, ' ');
  str = str.replace(/_/g, ' ');
  return str.charAt(0).toUpperCase() + str.slice(1);
}

function ambil_halaman(){
  // jsfiddle.net/LkkwH/1/
  // http://jsfiddle.net/sw_lasse/9wpHa/
  if($('#list-halaman').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      success: function(data){
          
          var htmlStr = "";
          var printTree = function (node) {

              htmlStr = htmlStr + '<ul class="list-group hirarki halaman">';        
              
              for (var i = 0; i < node.length; i++){
                    if(node[i]['children']) var listyle = 'li-parent';
                    else listyle = '';

                    htmlStr = htmlStr + '<li id="ID_'+node[i]['post_ID']+'" class="list-group-item '+listyle+'">';          
                    htmlStr = htmlStr + '<a class="link-edit" href="halaman#edit?id='+node[i]['post_ID']+'">'+node[i]['post_title']+'</a>';
                    htmlStr = htmlStr + '<div class="pull-right">';
                    htmlStr = htmlStr + '<a href="halaman#edit?id='+node[i]['post_ID']+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> ';
                    htmlStr = htmlStr + '<a href="halaman#hapus?id='+node[i]['post_ID']+'" id="hapus_" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>';
                    htmlStr = htmlStr + '</div>'
                    
                    if(node[i]['children']){
                      printTree(node[i]['children'])
                    }
                    
                    htmlStr = htmlStr + '</li>';         
              }
              
             
              htmlStr = htmlStr + '</ul>';
              return htmlStr;
          }

          tree = unflattenHalaman( data.record );
          $('#list-halaman').html(printTree(tree));

          $('#list-halaman .list-group').sortable({
            opacity: 0.5,
            cursor: 'move',
            placeholder: 'ui-state-highlight',
            update: function() {
                  var orderAll = [];
                  $('.list-group li').each(function(){
                       orderAll.push($(this).attr('id').replace(/_/g, '[]='));
                  });
                  
                  // alert($(this).sortable('serialize'));
                  $.post( 'http://'+host+path+'/action/sortir', orderAll.join('&'));
              }
          });               
      }

    });
  }
}

function unflattenHalaman( array, parent, tree ){
  
  tree = typeof tree !== 'undefined' ? tree : [];
  parent = typeof parent !== 'undefined' ? parent : { post_ID: 0 };
      
  var children = _.filter( array, function(child){ return child.post_parent == parent.post_ID; });

  if( !_.isEmpty( children )  ){
      if( parent.post_ID == 0 ){
         tree = children;   
      }else{
         parent['children'] = children;
      }
      _.each( children, function( child ){ unflattenHalaman( array, child ) } );                    
  }
  
  return tree;
}

function ambil_komentar(hal_aktif,scrolltop,cari){
  if($('table#tbl-komentar').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      data:{hal_aktif:hal_aktif, cari:cari}, 
      success: function(data){
          /***********************/
          /* tampilkan datanya  */
          /**********************/
          $('table#tbl-komentar tbody tr').remove();
          $.each(data.record, function(index, element) {        
          var status = '';
          if(element.comment_approved == 'pending') status = ' <strong>(pending)</strong>';    

            $('table#tbl-komentar').find('tbody').append(
              
              '<tr>'+
              '    <td width="2%"><input type="checkbox" name="comment_ID[]" value="'+element.comment_ID+'"></td>'+
              '    <td width="20%">'+
              '      <span><strong>'+element.comment_author_name+'</strong></span>'+
              '      <span>'+
              '         <a href="'+element.comment_author_url+'">'+element.comment_author_url+'</a><br />'+
              '         <a href="mailto:'+element.comment_author_email+'">'+element.comment_author_email+'</a><br />'+
              '         <a href="#">'+element.comment_author_IP+'</a>'+
              '      </span>'+
              '    </td>'+
              '    <td width="30%">'+element.comment_content+status+'</td>'+
              '    <td width="20%"><i class="icon-file"></i> <span>'+humanize(element.post_type)+' : "<a href="'+element.post_type+'#edit?id='+element.post_ID+'">'+element.post_title+'</a>"</span></td>'+
              '    <td width="12%"><i class="icon-time"></i> <span class="value">'+moment(element.comment_date).fromNow()+'</span></td>'+
              '    <td width="16%" class="td-actions">'+
              '      <a href="komentar#edit?id='+element.comment_ID+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> '+
              '      <a href="komentar#hapus?id='+element.comment_ID+'" id="hapus_'+element.comment_ID+'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a>'+
              '    </td>'+
              '</tr>'        

            );
          }); 

          /********************/
          /*  buat pagination */
          /********************/
          var pagination = '';
          var paging =  Math.ceil(data.total_rows / data.perpage) ;  

          if((!hal_aktif) && ($('ul#pagination-komentar li').length == 0)){
            $('ul#pagination-komentar li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="komentar#ambil?hal='+i+'">'+i+'</a></li>';
            }                       
          }

          else if(hal_aktif && cari){
            $('ul#pagination-komentar li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="komentar#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
            }               
          }          

          $('ul#pagination-komentar').append(pagination);
          $("ul#pagination-komentar li:contains('"+hal_aktif+"')").addClass('active');   
          
          if(scrolltop == true){$('body').scrollTop(0);}                 
      }

    });
  }
}

function ambil_tampilan(){
  if($('#list-tampilan').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      success: function(data){
        $('#list-tampilan div.single-tampilan').remove();
        $('#myModal .modal-body #form-tampilan fieldset.form-horizontal div.control-group').empty();
        $.each(data.record, function(index, element) {
          // alert(element.template_name);
          $('#list-tampilan').append(
              '<div class="span3 single-tampilan">'+
              '  <img src="http://'+host+path.replace('admin/tampilan', 'templates/frontend/')+element.template_directory+'/screenshot.png" />'+
              '  <a href="#aktifkan?template='+element.template_directory+'" class="pull-right">Aktifkan!</a><h4 class="pull-left">'+element.template_name+' v.'+element.template_version+'</h4>'+                   
              '</div>'

            );
        });

        /* ini untuk bagian detail template edit */
        $('#template-now img').attr('src', 'http://'+host+path.replace('admin/tampilan', 'templates/frontend/')+data['template_setting'].template_directory+'/screenshot.png');
      
        $('body').scrollTop(0);
      }

    });
  }
}

function ambil_statistik(){

  if($('#area-chart').length > 0){
    var statistik = getJSON('http://'+host+path.replace('dashboard', 'statistik')+'/action/ambil',{});

    var lineChartData = {
      labels: statistik.date_statistik,
      datasets: [
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data: statistik.visit_statistik
        }
      ]
    }

    var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData); 

    

    /* statistik 30 */
    $.each(statistik.visitor_30, function(index, element) {    

      $('table#tbl-visitor-30').find('tbody').append(
        '<tr>'+
        '  <td>'+moment(element.visitor_date).fromNow()+'</td>'+
        '  <td><i class="flag pull-left '+element.visitor_country+'"></i> <a href="statistik#ambil?id='+element.visitor_ID+'">'+element.visitor_isp+'</td>'+
        '  <td>'+visitor_system(element.visitor_os, element.visitor_browser)+'</td>'+
        '  <td><a href="'+element.visitor_referer+'" target="_blank">'+url_limit_string(element.visitor_referer,30,'...')+'</a></td>'+
        '</tr>'

      );
    }); 

    /* statistik perjam */
    var total_per_hari = statistik.visitor_total_hari_ini;
    $.each(statistik.visitor_perjam, function(index, element) {  
      var persentase = (element.jumlah / total_per_hari) * 100 ; 
      $('table#tbl-visitor-jam').find('tbody').append(
        '<tr>'+
          '<td>'+element.jam+'</td>'+
          '<td>'+element.jumlah+'</td>'+
          '<td style="text-align:left"><div style="padding:5px; margin:4px 0 0 0 ; width:'+persentase+'%; -webkit-border-radius:2px ; background:#E01F1F; height:80%; display: inline-block; color:#fff; text-align:right">'+Math.ceil(persentase)+'%</div></td>'+                
        '</tr>'
      );
    });

    $('#visitor_total_hari_ini').text(total_per_hari);

    /* visitor perhari */
    var total_per_bulan = statistik.visitor_total_bulan_ini;
    $.each(statistik.visitor_perhari, function(index, element) {  
      var persentase = (element.jumlah / total_per_bulan) * 100 ; 
      $('table#tbl-visitor-hari').find('tbody').append(
        '<tr>'+
          '<td>'+ moment(element.hari).format('L')+'</td>'+
          '<td>'+element.jumlah+'</td>'+
          '<td style="text-align:left"><div style="padding:5px; margin:4px 0 0 0 ; width:'+persentase+'%; -webkit-border-radius:2px ; background:#E01F1F; height:80%; display: inline-block; color:#fff; text-align:right">'+Math.ceil(persentase)+'%</div></td>'+                
        '</tr>'
      );
    });         
  }  
}

function visitor_system(os,browser){
  var display = '';
  if(os.search('Windows 7') >= 0){
    display = '<i class="flag pull-left windows-7"></i>';
  }

  if(browser.search('Chrome') >= 0){
    display = display + ' <i class="flag pull-left chrome"></i>';
  }
  else if(browser.search('Firefox') >= 0){
    display = display + ' <i class="flag pull-left firefox"></i>';
  }

  return display;
}

function url_limit_string(string,limit,separator){
  var print = '';
  if(string){
    print = string.replace('http://', '').substr(0,limit)+separator; 
  }
  
  return print;
}

function ambil_konfigurasi(){

  if($('.form-konfigurasi').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      success: function(data){
        //alert(data.website_setting['judul']);
        var provinsi_id = data.website_setting['provinsi'];
        var kota_id = data.website_setting['kota'];
        var kotanya = getJSON("../../assets/js/kota.json");
        $('#kota option').remove();
        $('#kota').append('<option value="" selected>Pilih Kota/Kabupatennya</option>');
        for(var x = 0; x < kotanya.length; x++){
          if(kotanya[x].province_id == provinsi_id){                
            $('#kota').append(
                '<option value="'+kotanya[x].id+'">'+kotanya[x].name+'</option>'
              );
          }
        } 

        var kecamatannya = getJSON("../../assets/js/kecamatan.json");
        $('#kecamatan option').remove();
        $('#kecamatan').append('<option value="" selected>Pilih Kecamatannya</option>');
        for(var y = 0; y < kecamatannya.length; y++){
          if(kecamatannya[y].regency_id == kota_id){                
            $('#kecamatan').append(
                '<option value="'+kecamatannya[y].id+'">'+kecamatannya[y].name+'</option>'
              );
          }
        }          

        for(var i in data.website_setting){
          if(data.website_setting[i] == 'yes'){
            $('#'+i).prop('checked', true);
          }
          else{
            $('#'+i).val(data.website_setting[i]);
          }          
        }

        /* untuk rekening */
        for(var x=0;x<data.website_setting['jenis_rekening'].length;x++){
          var nomor = x + 1;
          $('div.wrap-rekening').append(
            '<div class="rekening-satuan">'+
            '  <h3 class="head-rekening">No. Rekening '+nomor+'</h3> '+
            '  <a class="btn btn-danger" id="hapus-rekening"><i class="icon-remove"></i> Hapus Rekening Ini</a>'+
            '  <br />'+
            '  <label class="control-label" for="jenis_rekening">Jenis Rekening</label>'+
            '  <div class="controls">'+
            '    <select name="jenis_rekening[]" id="jenis_rekening_'+nomor+'">'+                                  
            '      <option value="0">Pilih Rekening</option>'+          
            '      <option value="BCA">BCA</option>'+
            '      <option value="BNI">BNI</option>'+     
            '      <option value="BNI_Syariah">BNI Syariah</option>'+                             
            '      <option value="BRI">BRI</option>'+  
            '      <option value="BRI_Syariah">BRI Syariah</option>'+  
            '      <option value="Mandiri">Bank Mandiri</option>'+
            '      <option value="Syariah_Mandiri">Bank Syariah Mandiri</option>'+      
            '    </select>'+                           
            '  </div>'+
            '  <label class="control-label" for="nomor_rekening">Nomor Rekening</label>'+
            '  <div class="controls">'+
            '    <input type="text" class="span3" name="nomor_rekening[]" id="nomor_rekening_'+nomor+'">'+                         
            '  </div>'+
            '  <label class="control-label" for="atas_nama">Atas Nama</label>'+
            '  <div class="controls">'+
            '    <input type="text" class="span3" name="atas_nama[]" id="atas_nama_'+nomor+'">'+                         
            '  </div>'+
            '</div>'
            );          

            /* entry */
            $('#jenis_rekening_'+nomor+' option[value ="'+data.website_setting['jenis_rekening'][x]+'"]').prop('selected', true);
            $('#nomor_rekening_'+nomor).val(data.website_setting['nomor_rekening'][x]);
            $('#atas_nama_'+nomor).val(data.website_setting['atas_nama'][x]);
        }

      }
    });
  } 
}

function ambil_user(hal_aktif,scrolltop,cari){
  var path = window.location.pathname;
  var host = window.location.hostname;  
  if($('table#tbl-user').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      data:{hal_aktif:hal_aktif, cari:cari}, 
      success: function(data){
          /***********************/
          /* tampilkan datanya  */
          /**********************/
          $('table#tbl-user tbody tr').remove();
          
          $.each(data.record, function(index, element) {
            if(element.active == 0){
              var status = '(tidak aktif)';
            }
            else{
              var status = '';
            }

            $('table#tbl-user').find('tbody').append(
              '<tr>'+
              '  <td width="2%"><input type="checkbox" name="user_id[]" value="'+element.ID+'"></td>'+
              '  <td width="30%"><img src="http://'+host+path.replace('admin/user','assets/images/')+'user.png" /> <a class="link-edit" href="user#edit?id='+element.ID+'">'+element.username+'</a> <strong>'+status+'</strong></td>'+
              '  <td width="30%"><i class="icon-envelope"></i> <span class="value">'+element.email+'</span></td>'+
              '  <td width="13%"><i class="icon-group"></i> <span class="value">'+element.group+'</span></td>'+
              '  <td width="9%"><i class="icon-file"></i> <span class="value">'+element.jumlah_post+'</span></td>'+
              '  <td width="16%" class="td-actions"><a href="user#edit?id='+element.ID+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="user#hapus?id='+element.ID+'" id="hapus_'+element.ID+'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></td>'+
              '</tr>'
            );
          }); 
          
          /********************/
          /*  buat pagination */
          /********************/
          var pagination = '';
          var paging =  Math.ceil(data.total_rows / data.perpage) ;

          if((!hal_aktif) && ($('ul#pagination-user li').length == 0)){
            $('ul#pagination-user li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="user#ambil?hal='+i+'">'+i+'</a></li>';
            }                       
          }    
          else if(hal_aktif && cari){
            $('ul#pagination-user li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="user#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
            }               
          }

          $('ul#pagination-user').append(pagination);
          $("ul#pagination-user li:contains('"+hal_aktif+"')").addClass('active'); 


        if(scrolltop == true){$('body').scrollTop(0);}
      }

    });
  }  
}

function ambil_dashboard(){
  if($('#list-komentar-terbaru').length > 0 && $('#list-recent-news').length > 0){
    var dashboard = getJSON('http://'+host+path+'/action/ambil',{});

    $('#list-komentar-terbaru li').remove();
    $.each(dashboard.record_komentar, function(index, element) {
      $('#list-komentar-terbaru').append(
          '<li class="from_user left"> <a href="#" class="avatar"><img src="http://'+host+path.replace('admin/dashboard','assets/images/')+'user-lrg.png"/></a>'+
          '  <div class="message_wrap"> <span class="arrow"></span>'+
          '    <div class="info"> <a class="name">'+element.comment_author_name+'</a> <span class="time">'+moment(element.comment_date).fromNow()+'</span>'+
          '      <div class="options_arrow">'+
          '        <div class="dropdown pull-right"> <a class="dropdown-toggle " id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="#"> <i class=" icon-caret-down"></i> </a>'+
          '          <ul class="dropdown-menu " role="menu" aria-labelledby="dLabel">'+
          '            <li><a href="http://'+host+path.replace('admin/dashboard','admin/komentar')+'#edit?id='+element.comment_ID+'"><i class=" icon-pencil icon-large"></i> Edit Komentar Ini</a></li>'+
          '            <li><a href="http://'+host+path.replace('admin/dashboard','admin/komentar')+'#hapus?id='+element.comment_ID+'"><i class=" icon-trash icon-large"></i> Hapus Komentar Ini</a></li>'+
          '          </ul>'+
          '        </div>'+
          '      </div>'+
          '    </div>'+
          '    <div class="text">'+url_limit_string(element.comment_content, 120, '...')+'</div>'+
          '  </div>'+
          '</li>'
        );
    });

    $('#list-recent-news li').remove();
    $.each(dashboard.record_artikel, function(index, element) {
      $('#list-recent-news').append(
          '<li>'+            
            '<div class="news-item-date"> <span class="news-item-day">'+ moment(element.post_date).format('DD')+'</span> <span class="news-item-month">'+ moment(element.post_date).format('MMM')+'</span> </div>'+
            '<div class="news-item-detail"> <a href="http://'+host+path.replace('admin/dashboard','admin/artikel')+'#edit?id='+element.post_ID+'" class="news-item-title" >'+element.post_title+'</a>'+
            '  <p class="news-item-preview">'+url_limit_string(element.post_content,100, '...')+'</p>'+
            '</div>'+          
          '</li>'
        );
    });
  }
}

function ajax_upload(type){
  new AjaxUpload('userfile', {
      action: '../admin/media/action/tambah/'+type,
      name: 'userfile',
      responseType: "json",
      onSubmit: function(file, extension) {      
        alert('Mohon menunggu sebentar...'); 
      },
      onComplete: function(file, response) {
        if(response.success == 'TRUE'){
          if(type == 'artikel') {
            $('#userfile').before( 
                '<img src='+response.img+' class="featured_image" />'  +
                '<input class="span7" type="text" id="featured_image" name="featured_image" value="'+response.img_original+'" />' +
                '<input type="hidden" id="featured_image_thumbnail" name="featured_image_thumbnail" value="'+response.img+'" />' +
                '<button class="btn btn-danger" id="remove_featured_image"><i class="icon-remove"></i>Hapus Featured Image</button>'
              );
            $('#userfile').hide();
          }
          else if(type == 'produk'){
            $('.image-list-wrap').append(
                '<div class="image-single-item">'+
                '  <a class="btn btn-primary remove-img-btn"><i class="icon-remove"></i></a>'+
                '  <img src="'+response.img+'" />'+
                '  <input type="hidden" name="post_image[]" value="'+response.img_original+'" />'+
                '</div>'
              );
          }
        }      
      }
    }); 
}

function remove_featured_image(){
  $(document).on('click', '#remove_featured_image', function(eve){
    eve.preventDefault();
    $('#userfile').show();
    $('.featured_image').remove();
    $('#featured_image').remove();
    $('#featured_image_thumbnail').remove();
    $(this).remove();
  });
}

function ambil_produk(hal_aktif,scrolltop,kategori,cari){
  if($('table#tbl-produk').length > 0){
    $.ajax('http://'+host+path+'/action/ambil', {
      dataType : 'json',
      type : 'POST',
      data:{hal_aktif:hal_aktif, kategori:kategori, cari:cari}, 
      success: function(data){
          /***********************/
          /* tampilkan datanya  */
          /**********************/
          $('table#tbl-produk tbody tr').remove();
          $.each(data.record, function(index, element) {
            var post_status = '';
            if(element.post_status == 'pending'){
              post_status = '(pending)';
            }

            $('table#tbl-produk').find('tbody').append(
              '<tr>'+
              '    <td width="2%"><input type="checkbox" name="post_id[]" value="'+element.post_ID+'"></td>'+
              '    <td width="50%" class="produk-item">'+
              '<div class="media">'+
              '  <div class="media-left">'+
              '    <a href="produk#edit?id='+element.post_ID+'">'+
              '      <img class="media-object" src="'+element.post_image+'" >'+
              '    </a>'+
              '  </div>'+
              '  <div class="media-body">'+
              '    <h3 class="media-heading"><a class="link-edit" href="produk#edit?id='+element.post_ID+'">'+element.post_title+'</a> <strong>'+post_status+'</strong></h3>'+
              '    <em><i class="icon-search"></i> Kode : <strong>'+element.post_code+'</strong></em>'+
              '    <em><i class="icon-tag"></i> Harga : <strong>Rp '+element.post_price+'</strong></em>'+
              '    <em><i class="icon-briefcase"></i> Stock : <strong>'+element.post_stock+'pcs</strong></em>'+
              '  </div>'+
              '</div>'+
              '    </td>'+
              '     <td width="10%"><i class="icon-comment-alt"></i> <span class="value">'+element.comment_count+'</span></td>'+
              '     <td width="10%"><i class="icon-eye-open"></i> <span class="value">'+element.post_counter+'</span></td>'+
              '     <td width="12%"><i class="icon-time"></i> <span class="value">'+moment(element.post_date).fromNow()+'</span></td>'+
              '    <td width="16%" class="td-actions"><a href="produk#edit?id='+element.post_ID+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="produk#hapus?id='+element.post_ID+'" id="hapus_'+element.post_ID+'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></td>'+
              '</tr>'
            );
          }); 
          
          /********************/
          /*  buat pagination */
          /********************/
          var pagination = '';
          var paging =  Math.ceil(data.total_rows / data.perpage) ;

          if((!hal_aktif) && ($('ul#pagination-produk li').length == 0)){
            $('ul#pagination-produk li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="produk#ambil?hal='+i+'">'+i+'</a></li>';
            }                       
          }    
          else if(hal_aktif && kategori){
            $('ul#pagination-produk li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="produk#ambil?kategori='+kategori+'&hal='+i+'">'+i+'</a></li>';
            }               
          }
          else if(hal_aktif && cari){
            $('ul#pagination-produk li').remove();
            for (i = 1; i <= paging; i++) {
              pagination = pagination + '<li><a href="produk#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
            }               
          }

          $('ul#pagination-produk').append(pagination);
          $("ul#pagination-produk li:contains('"+hal_aktif+"')").addClass('active'); 

          /*************************/
          /* untuk filter kategori */
          /*************************/
          $('#btn-filter-produk li').remove();
          $('#btn-filter-produk').append('<li><a href="produk">Semua kategori</a></li>');
          for(var i in data.all_category){
            $('#btn-filter-produk').append('<li><a href="produk#ambil?kategori='+data.all_category[i]['category_slug']+'&hal=1">'+data.all_category[i]['category_name']+'</a></li>');
          }          
        if(scrolltop == true){$('body').scrollTop(0);}
      }

    });
  }  
}

function ambil_pesanan(hal_aktif,scrolltop,status,cari){
  var path = window.location.pathname;
  var host = window.location.hostname;  
  if($('table#tbl-pesanan').length > 0){
    $.ajax('http://'+host+path+'/ambil', {
      dataType : 'json',
      type : 'POST',
      data:{hal_aktif:hal_aktif, status:status, cari:cari}, 
      success: function(data){
        $('table#tbl-pesanan tbody tr').remove();

        if(data.record.length > 0){

          $.each(data.record, function(index, element) {
            
            var status = element.transaction_status; 
            
            if(element.transaction_status == 'sudah_transfer'){
              status = formatString(element.transaction_status+' ke '+element.transfer_destination);
            }


            $('table#tbl-pesanan').find('tbody').append(
              '<tr id="transaction_id_'+element.transaction_id+'">'+
              '    <td width="2%"><input type="checkbox" name="transaction_id[]" value="'+element.transaction_id+'"></td>'+
              '    <td width="4%">#'+element.transaction_id+'</td>'+
              '    <td width="25%" class="produk-item">'+
              '      <div class="media">'+
              '        <div class="media-body">'+
              '          <h3 class="media-heading"><a class="link-edit" href="pesanan#edit?id='+element.transaction_id+'">'+element.nama_lengkap+'</a> <strong></strong></h3>'+
              '          <em><i class="icon-time"></i> <strong>'+moment(element.transaction_time).format('L')+'</strong></em>'+
              '          <em><i class="icon-envelope-alt"></i> '+element.email+'</em>'+
              '          <em><i class="icon-phone"></i> '+element.no_handphone+'</em>'+
              '          <em><i class="icon-home"></i> <strong>'+element.kota+', '+element.provinsi+'</strong></em>'+
              '        </div>'+
              '      </div>'+
              '    </td>'+
              '    <td width="32%">'+
              '      <ol class="ol-transaksi">'+
              '        <li>Corsair KATAR Gaming Mouse x <strong>1</strong></li>'+
              '      </ol>'+
              '    </td>'+
              '    <td width="7%"><span class="value">'+formatNumber(element.all_total)+'</span></td>'+
              '    <td width="10%"><span class="value">'+status+'</span></td>'+
              '    <td width="20%" class="td-actions"><a href="pesanan#edit?id='+element.transaction_id+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="pesanan#hapus?id='+element.transaction_id+'" id="hapus_'+element.transaction_id+'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></td>'+
              '</tr>'
            );
          });

          $('table#tbl-pesanan tbody tr td ol li').remove();
          $.each(data.detil, function(index, element) {        
            $('table#tbl-pesanan tbody tr#transaction_id_'+element.transaction_id+' td ol.ol-transaksi').append(
              '<li>'+element.name+' <strong>x '+element.quantity+' = Rp '+formatNumber(element.price)+'</strong></li>'
            );
          });
        }




        /*********************/
        /*  buat pagination  */
        /*********************/
        var pagination = '';
        var paging =  Math.ceil(data.total_rows / data.perpage) ;

        

        if((!hal_aktif) && ($('ul#pagination-pesanan li').length == 0) ){
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="pesanan#ambil?hal='+i+'">'+i+'</a></li>';
          }                       
        }    
        else if(hal_aktif && status){
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="pesanan#ambil?status='+status+'&hal='+i+'">'+i+'</a></li>';
          }               
        }
        else if(hal_aktif && cari){
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="pesanan#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
          }               
        }
        else{
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="pesanan#ambil?hal='+i+'">'+i+'</a></li>';
          }   
        }

        $('ul#pagination-pesanan li').remove();
        if(paging){
          $('ul#pagination-pesanan').append(pagination);
          $("ul#pagination-pesanan li:contains('"+hal_aktif+"')").addClass('active');  
        }
       
        if(scrolltop == true){$('body').scrollTop(0);}

      }

    });
  }   
}

function ambil_konfirmasi(hal_aktif,scrolltop,cari){
  var path = window.location.pathname;
  var host = window.location.hostname;  
  if($('table#tbl-konfirmasi').length > 0){
    $.ajax('http://'+host+path+'/ambil', {
      dataType : 'json',
      type : 'POST',
      data:{hal_aktif:hal_aktif, cari:cari}, 
      success: function(data){
        $('table#tbl-konfirmasi tbody tr').remove();

        if(data.record.length > 0){
          $.each(data.record, function(index, element) {
            $('table#tbl-konfirmasi tbody').append(
                '<tr id="confirmation_id_'+element.confirm_id+'">'+
                '    <td width="2%"><input type="checkbox" name="confirmation_id[]" value="'+element.confirm_id+'"></td>'+
                '    <td width="4%">'+element.transaction_id+'</td>'+
                '    <td width="25%" class="produk-item">'+
                '      <div class="media">'+
                '        <div class="media-body">'+
                '          <h3 class="media-heading"><a class="link-edit" href="konfirmasi#edit?id='+element.confirm_id+'">'+element.nama_lengkap+'</a> <strong></strong></h3>'+                
                '          <em><i class="icon-envelope-alt"></i> '+element.email+'</em>'+
                '          <em><i class="icon-phone"></i> '+element.no_hp+'</em>'+
                '        </div>'+
                '      </div>'+
                '    </td>'+
                '    <td width="7%"><span class="value">'+formatNumber(element.total)+'</span></td>'+
                '    <td width="16%"><span class="value">'+formatString(element.tujuan)+'</span></td>'+
                '    <td width="16%"><span class="value">'+element.dari_rek_bank+' / '+element.dari_rek_no+' / '+element.dari_rek_atas_nama+'</span></td>'+
                '    <td width="10%"><span class="value">'+formatString(element.confirm_status)+'</span></td>'+
                '    <td width="20%" class="td-actions"><a href="konfirmasi#edit?id='+element.confirm_id+'" class="link-edit btn btn-small btn-info"><i class="btn-icon-only icon-pencil"></i> Edit</a> <a href="konfirmasi#hapus?id='+element.confirm_id+'" id="hapus_'+element.confirm_id+'" class="btn btn-invert btn-small"><i class="btn-icon-only icon-remove"></i> Hapus</a></td>'+
                '</tr>');
          });
        }


        /*********************/
        /*  buat pagination  */
        /*********************/
        var pagination = '';
        var paging =  Math.ceil(data.total_rows / data.perpage) ;

        if((!hal_aktif) && ($('ul#pagination-konfirmasi li').length == 0) ){
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="konfirmasi#ambil?hal='+i+'">'+i+'</a></li>';
          }                       
        }    
        else if(hal_aktif && cari){
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="konfirmasi#ambil?cari='+cari+'&hal='+i+'">'+i+'</a></li>';
          }               
        }
        else{
          for (i = 1; i <= paging; i++) {
            pagination = pagination + '<li><a href="konfirmasi#ambil?hal='+i+'">'+i+'</a></li>';
          }   
        }

        $('ul#pagination-konfirmasi li').remove();
        if(paging){
          $('ul#pagination-konfirmasi').append(pagination);
          $("ul#pagination-konfirmasi li:contains('"+hal_aktif+"')").addClass('active');  
        }
       
        if(scrolltop == true){$('body').scrollTop(0);}

      }

    });
  }   
}

function formatString(string){
  return string.replace(/_/g, " ");
}

function formatNumber(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
}