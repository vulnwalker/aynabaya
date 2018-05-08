<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Backend_Controller {

	// http://stackoverflow.com/questions/19706046/how-to-read-an-external-local-json-file-in-javascript

	protected $user_detail;

	public function __construct(){
		parent::__construct();
		$this->load->model(array('User_model', 'User_detail_model'));
	}

	public function index(){
		$data = array();
		$this->site->view('user', $data);
	}

	public function login(){

		/* tahap 3 finishing */
		$post = $this->input->post(NULL, TRUE);

		if(isset($post['username']) ){
			$this->user_detail = $this->User_model->get_by(array('username' => $post['username'], 'group' => 'admin'), 1, NULL, TRUE);
		}

		$this->form_validation->set_message('required', '%s kosong, tolong diisi!');

		$rules = $this->User_model->rules;
		$this->form_validation->set_rules($rules);

		if ($this->form_validation->run() == FALSE){
			$this->site->view('login');
        }
        else{
			$login_data = array(
					'ID' => $this->user_detail->ID,
			        'username'  => $post['username'],
			        'logged_in' => TRUE,
			        'active' => $this->user_detail->active,
			        'last_login' => $this->user_detail->last_login,
			        'group' => $this->user_detail->group,
			        'email' => $this->user_detail->email,
			);

			$this->session->set_userdata($login_data);

			if(isset($post['remember']) ){
				$expire = time() + (86400 * 7);
				set_cookie('username', $post['username'], $expire , "/");
				set_cookie('password', $post['password'], $expire , "/" );
			}

			redirect(set_url('dashboard'));
        }
    }

	public function logout(){
		$this->session->sess_destroy();;
		redirect(set_url('login'));
	}

	public function password_check($str){
    	$user_detail =  $this->user_detail;
    	if (@$user_detail->password == crypt($str,@$user_detail->password)){
			return TRUE;
		}
		else if(@$user_detail->password){
			$this->form_validation->set_message('password_check', 'Passwordnya Anda salah...');
			return FALSE;
		}
		else{
			$this->form_validation->set_message('password_check', 'Anda tidak punya akses Admin...');
			return FALSE;
		}
	}

	public function action($param){
		global $SConfig;
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){

			if($param == 'ambil'){
				$post = $this->input->post();

				if(!empty($post['id'])){
					$record = $this->User_model->get_user_detail($post['id']);
					echo json_encode(array('status' => 'success', 'data' => $record));
				}
				else{
					$offset = NULL;

					if(!empty($post['hal_aktif']) && $post['hal_aktif'] > 1){
						$offset = ($post['hal_aktif'] - 1) * $SConfig->_backend_perpage ;
					}

					if(!empty($post['cari']) && ($post['cari'] != 'null')){
						$cari = $post['cari'];
						$total_rows = $this->User_model->count(array("username LIKE" => "%$cari%"));
						@$record = $this->User_model->get_user(array("username LIKE" => "%$cari%"),$SConfig->_backend_perpage, $offset, FALSE, "count(post_ID) as jumlah_post, ID, username, group, email, active");
					}
					else{
						$record = $this->User_model->get_user(NULL,$SConfig->_backend_perpage,$offset,FALSE, "count(post_ID) as jumlah_post, ID, username, group, email, active");
						$total_rows = $this->User_model->count();
					}

					echo json_encode(array(
						'record' => $record,
						'total_rows' => $total_rows,
						'perpage' => $SConfig->_backend_perpage,
					) );
				}
			}
			else if($param == 'tambah' || $param == 'update'){

				if($param == 'update'){
					$rules = $this->User_model->rules_update;
				}
				else{
					$rules = $this->User_model->rules_register;
				}

				$this->form_validation->set_rules($rules);

				if ($this->form_validation->run() == TRUE) {
					$group = 'user';
					$post = $this->input->post();
					$data = array(
							'username' => $post['username'],
							'password' => bCrypt($post['password'],12),
							'group' => (!empty($post['group'])) ? $group = $post['group'] : $group = '',
							'email' => $post['email'],
							'active' => 1
						);

					unset($data['active']);

					if($param == 'update'){
						unset($data['username']);
						unset($data['email']);

						if(!empty($post['password'])) {
							$data['password'] = bCrypt($post['password'],12);
						}
						else{
							unset($data['password']);
						}

						$this->User_model->update($data, array('ID' => $post['user_id']));
						$getID = $post['user_id'];
					}
					else{
						$getID = $this->User_model->insert($data);
					}

					if(!empty($getID)){
						$data_detail = array(
								'nama_depan' => $post['nama_depan'],
								'nama_belakang' => $post['nama_belakang'],
								'jenis_kelamin' => $post['jenis_kelamin'] ,
								'tempat_lahir' =>  $post['tempat_lahir'],
								'tanggal_lahir' =>  $post['year'].'/'.$post['month'].'/'.$post['date'],
								'handphone' =>  $post['handphone'],
								'telephone' =>  $post['telephone'],
								'alamat' =>  $post['alamat'],
								'kota' =>  $post['kota'],
								'kecamatan' =>  $post['kecamatan'],
								'provinsi' =>  $post['provinsi'],
								'kodepos' =>  	$post['kodepos']
							);


						if($param == 'update'){
							$this->User_detail_model->update($data_detail, array('user_id' => $getID));
						}
						else{
							$data_detail['user_id'] = $getID;
							$this->User_detail_model->insert($data_detail);
						}
					}

					$result = array('status' => 'success');
				}
				else{
					$result = array('status' => 'failed', 'errors' => $this->form_validation->error_array());
				}

				echo json_encode($result);
			}

			else if($param == 'hapus'){
				$post = $this->input->post();
				if(!empty($post['user_id'])){
					$this->User_model->delete($post['user_id']);
					$result = array('status' => 'success');
				}

				echo json_encode($result);
			}

			else if($param == 'mass'){
				$post = $this->input->post(NULL,TRUE);
				if($post['mass_action_type'] == 'hapus'){
					if(count($post['user_id']) > 0){
						foreach($post['user_id'] as $id)
						$this->User_model->delete($id);
						$result = array('status' => 'success');
						echo json_encode($result);
					}
				}
				else if($post['mass_action_type'] == 'non-aktifkan' || $post['mass_action_type'] == 'aktifkan'){
					if(count(@$post['user_id']) > 0){
						if($post['mass_action_type'] == 'aktifkan'){
							$active = 1;
						}
						else{
							$active = 0;
						}
						foreach($post['user_id'] as $id)
						$this->User_model->update(array('active' => $active),array('ID' => $id));
						$result = array('status' => 'success');
						echo json_encode($result);
					}
				}
			}

		}
	}

	public function email_check($str){
		/* bisa digunakan untuk mengecek ke dalam database nantinya */
		if ($this->User_model->count(array('email' => $str)) > 0){
            $this->form_validation->set_message('email_check', 'Email sudah digunakan, mohon diganti yang lain...');
            return FALSE;
        }
        else{
            return TRUE;
        }
	}

	public function username_check($str){
		/* bisa digunakan untuk mengecek ke dalam database nantinya */
		if ($this->User_model->count(array('username' => $str)) > 0){
            $this->form_validation->set_message('username_check', 'Username sudah digunakan, mohon diganti yang lain...');
            return FALSE;
        }
        else{
            return TRUE;
        }
	}
}
