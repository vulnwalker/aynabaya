<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend_Controller extends MY_Controller{

	function __construct(){
		parent::__construct();
		$this->load->helper(array('form', 'date', 'inflector', 'text'));
		$this->load->library(array('Post','cart'));
		$this->load->model(array('User_model','User_detail_model','Halaman_model','Artikel_model','Produk_model','Kategori_model','Konfigurasi_model','Komentar_model'));

		$this->site->side = 'frontend';

		/* bagian template setting database */
		$get_template_setting_db = $this->Konfigurasi_model->get_by(array('option_name' => 'template_setting'),NULL,NULL,TRUE,'option_value');
		$template_setting = @unserialize($get_template_setting_db->option_value);
		
		if(!empty($template_setting['template_directory']))
			$this->site->template = $template_setting['template_directory'];		
		else
			$this->site->template = 'default';
		
		$this->site->template_setting = unserialize($template_setting['template_attribute']);

		/* bagian website setting database */
		$get_website_setting_db = $this->Konfigurasi_model->get_by(array('option_name' => 'website_setting'),NULL,NULL,TRUE,'option_value');
		$website_setting = unserialize($get_website_setting_db->option_value);
		$this->site->website_setting = $website_setting;
		
		/* log visitor */
		$this->site->visitor_log();
		
	}

}