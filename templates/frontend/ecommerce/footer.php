    </div>

    <!-- /.container -->

    <div class="container-about-us">
      <div class="container-fluid" style="background-color:#F2F2F1; text-align:center; ">
        <h3 style="border-bottom:1px solid black;">About Us</h3>
<br>
        <p style="color:black;">AYN is here to bring you a highly curated experience from modesty to quality.
We cover everything from the basics, to the insanely avant-garde, and our mission is to tell it with finest minimalist muslimah wear.
Dedicated from the simpliest, the wonderful, the quirky ones, the extroverts, the introverts, the foodies, AYN is a house for all kind of honesty.</p>
<p style="color:black;">AYN isn't about that hour-long hype.
It's here for you, your ethereal basic needs.<p>
      </div>
    </div>

    <div class="container-botom-about-us">
      <div class="container-fluid" >
        <div class="row">
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <center><img src="<?= base_url();?>assets/images/aynabaya_footer.gif" alt="" width="330"></center>
          </div>
          <div class="col-sm-4"></div>
        </div>
      </div>
    </div>

    <div class="container" style="margin-top:20px; margin-bottom:20px; background-color:#fcfcfc; padding:20px; border-radius:10px; -webkit-border-radius:10px; -moz-border-radius:10px;">
      <div class="row">
          <div class="form-group col-sm-6">
              <label for="name" class="h4">Name</label>
              <input type="text" class="form-control" id="name" placeholder="Enter name" required>
          </div>
          <div class="form-group col-sm-6">
              <label for="email" class="h4">Email</label>
              <input type="email" class="form-control" id="email" placeholder="Enter email" required>
          </div>
          <div class="form-group col-sm-12">
              <label for="message" class="h4 ">Message</label>
              <textarea id="message" class="form-control" rows="5" placeholder="Enter your message" required></textarea>
          </div>
                 <button type="submit" id="form-submit" class="btn btn-primary btn-lg pull-right " style="margin-right:20px;">Submit</button>
      </div>
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                  <h4 class="foot" style="color:white;">Contact Us</h4>
                  <ul class="media-list foot-list">
                    <li class="media">
                      <div class="media-body">
                        <a href="#" class="media-heading" style="color:white;">Address</a>
                        <p style="color:white;">Bandung - Indonesia</p>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media">
                        <a href="http://s.id/iiY" class="media-heading" id="fontfooter" style="color:white;"><i class="fa fa-whatsapp"  style="color:white; font-size:24px; margin-right:5px;"></i></a>
                        <a href="http://s.id/ij2" id="fontfooter" style="color:white; display:inline-block;"><i class="fa fa-instagram" style="color:white; font-size:24px; margin-right:5px;" ></i></a>
                        <a href="#" id="fontfooter" style="color:white; display:inline-block;"><i class="fa fa-envelope-square" style="color:white; font-size:24px; margin-right:5px;"></i></a>
                        <a href="#" id="fontfooter" style="color:white; display:inline-block;"><i class="fa fa-facebook" style="color:white; font-size:24px;"></i></a>
                      </div>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                </div>
                <div class="col-sm-4">
                  <h4 class="foot" style="color:white;" style="text-align:center;">Currency</h4>
                    <button type="button" class="btn btn-default" style="float:center;margin-bottom:10px;" onclick="setCookieUSD();"><b>USD</b></button>
                    <button type="button" class="btn btn-default" style="float:center; margin-bottom:10px;" onclick="setCookieRupiah();"><b>IDR</b></button>
                </div>
            </div>
        </div>

        <div id="copyright">
            <div class="container">
                <div class="row nopadding">
                    <p class="text-muted" style="color:white;"><?=e_('copyright');?></p>
                </div>
            </div>
        </div>
    </footer>

    <div id="myModal" class="modal fade " role="dialog">
      <div class="modal-dialog modal-md">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <h2 class="text-center" id="head-note-beli"></h2>
            <p class="text-center" id="note-beli"></p>
          </div>
          <div class="modal-footer text-center">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-remove"></i> Close</button>
            <a href="<?=base_url('halaman/transaksi/keranjang');?>" class="btn btn-default" ><i class="fa fa-shopping-cart"></i> View Shopping Cart!</a>
          </div>
        </div>
      </div>
    </div>

    <!--Aplikasi chating talk.to-->
    <script type="text/javascript">
     function setCookieUSD(){
       document.cookie = "usdCookie=usd";
       window.location.reload();
     }
     function setCookieRupiah(){
       document.cookie = "usdCookie=rupiah";
       window.location.reload();
     }
     function gotToEMS(){
       window.location = "pembayaranEMS"
     }
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/5aad5f254b401e45400dd1db/default';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    <!--End Aplikasi chating talk.to-->

    <!-- jQuery -->
    <script src="<?php echo get_template_directory(dirname(__FILE__), 'js');?>/jquery.js"></script>
    <script src="<?=get_template_directory(dirname(__FILE__), 'js');?>/moment-with-locales.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo get_template_directory(dirname(__FILE__), 'js');?>/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory(dirname(__FILE__), 'js');?>/custom.js" type="text/javascript"></script>

</body>

</html>
