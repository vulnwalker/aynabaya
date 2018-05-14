<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front extends Frontend_Controller {

	public function __construct(){
		parent::__construct();		
	}

	public function index(){
		$data = array();
		$this->site->_isHome = TRUE;
		$this->site->view('index', $data);
	}	

	public function komentar(){
		$serv = $_SERVER;
		$status = 'publish';
		$note = 'sudah ditampilkan';		
		$website_setting = $this->site->website_setting;

		if(array_key_exists('setting_komentar', $website_setting)){
			$this->load->model(array('Komentar_model'));
			$this->load->library(array('form_validation','user_agent'));						
			$rules = $this->Komentar_model->rules;
			$this->form_validation->set_rules($rules);
			if ($this->form_validation->run() == TRUE) {
				$post = $this->input->post(NULL,TRUE);	

				/* moderasi komentar status */				
				if(array_key_exists('moderasi_komentar', $website_setting)){
					$status = 'pending';	
					$note = 'segera dimoderasi';							
				}	

				$data = array(
					'comment_post_ID' 		=> $post['post_ID'], 
					'comment_author_name' 	=> $post['comment_author_name'], 
					'comment_author_email' 	=> $post['comment_author_email'], 
					'comment_author_url' 	=> $post['comment_author_url'], 
					'comment_author_IP' 	=> $serv['REMOTE_ADDR'],
					'comment_date' 			=> date('Y-m-d H:i:s'), 
					'comment_content' 		=> $post['comment_content'], 
					'comment_approved' 		=> $status, 
					'comment_agent' 		=> $this->agent->agent_string(), 	
				);

				if(!empty($post['post_ID'])){
					$insert_id = $this->Komentar_model->insert($data);
					if($insert_id){
						/* kirim email komentar baru */
						$this->load->library('email');
						$email_config['mailtype'] = 'html';
						$this->email->initialize($config);
						$this->email->from($website_setting['email'].'', $website_setting['judul']);
						$this->email->to($website_setting['email']);
						$this->email->subject('Ada Komentar Baru (#'.$insert_id.') di '.$website_setting['domain']);
						$this->email->message('Ada komentar Baru dari ... <br />' .
								'Nama : '. $post['comment_author_name'] .'<br />'.
								'Email : ' . $post['comment_author_email'] . '<br />'.
								'IP ' . $serv['REMOTE_ADDR'] . '<br />'.
								'URL : ' . $post['comment_author_url'] . '<br />'.
								'Isi komentar : <br />' . $post['comment_content']
							);

						$this->email->send();
					}
				}

				$notif = array('status' => 'success', 'message' => 'Terima kasih! Komentar Anda '.$note);
				$this->session->set_flashdata($notif);

			}
			else{
				$notif = array_merge(array('status' => 'error'), $this->form_validation->error_array()) ;	
				$this->session->set_flashdata($notif);
				$statusnya = $this->session->flashdata();
				
			}
		}

		//  $statusnya = $this->session->flashdata();
		//	print_r($statusnya);
		//  $this->session->set_flashdata('tes','value');
		redirect($serv['HTTP_REFERER'].'#form-komentar');
	}
}
