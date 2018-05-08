<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Frontend_Controller {

    protected $user_detail ;

    public function __construct(){
     parent::__construct();
    }

    public function lupa_password(){
      $this->load->library('email');
      $data = array();
  		$post_detail = new stdClass();
  		$post_detail->post_title = 'Please input your email';

  		$post_detail->post_content = '<div class="row">
              <div class="col-md-6">
          <form class="form-horizontal" id="form-login" method="POST" action="'.set_url('login/lupa_password/kirim').'">

                    <div class="form-group">
                      <label class="control-label col-xs-3">Email</label>
                      <div class="col-xs-9">
                          <input type="text" class="form-control" id="email" name="email" value="'.set_value('email').'">
                        '.form_error('email', '<p class="help-block">', '</p>').'
                      </div>
                    </div>

            <div class="form-group">
              <div class="col-xs-offset-3 col-xs-9">
                  <button type="submit" class="btn btn-primary input-block-level"><span class="glyphicon glyphicon-ok"></span> Send password to email!</button>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6"></div>
      </div>
      ';
  		$post_detail->post_attribute = json_encode(array());
      	$this->post->post_detail = $post_detail;

      	$this->site->_isDetail = TRUE;
  		$this->site->view('halaman', $data);

      if($this->uri->segment(3) == 'kirim'){
        $post = $this->input->post(NULL,TRUE);
        $this->email->to($post['email']);
        $this->email->from('aynabaya.com','hayatul habirun');
        $this->email->subject('Forgot Password aynabaya.com');
        $this->email->message('test');
        $this->email->send();
      }

    }

}
