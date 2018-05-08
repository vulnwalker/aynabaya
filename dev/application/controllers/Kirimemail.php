<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kirimemail extends Frontend_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->library('email');
	}

  public function kirim(){

		if($action = 'tagihan_pembeli'){
			$this->email->from('contact@aynabaya.com');
			$this->email->to('hayatul@getnada.com');
			$this->email->subject('test');
			$this->email->message('halo ini dengan saya hayatul habirun.. ini adalah tes');
			$this->email->set_mailtype('html');

			$this->email->send()
		}


  }



}
