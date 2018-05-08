   <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Frontend_Controller {

	protected $user_detail ;

	public function __construct(){
		parent::__construct();
	}

	public function login(){
		$data = array();
		$post_detail = new stdClass();

		if($this->uri->segment(3) == 'validasi'){
			$post = $this->input->post(NULL,TRUE);
			$this->load->library('form_validation');
			$rules = $this->User_model->rules;
			$this->form_validation->set_rules($rules);

			if ($this->form_validation->run() == FALSE){
				$post_detail->post_title = 'Login Member';
				$post_detail->post_content = '<div class="row">
		            <div class="col-md-6">
						<form class="form-horizontal" id="form-login" method="POST" action="'.set_url('user/login/validasi').'">

		                  <div class="form-group">
		                    <label class="control-label col-xs-3">Username</label>
		                    <div class="col-xs-9">
		                        <input type="text" class="form-control" id="username" name="username" value="'.set_value('username').'">
		                    	'.form_error('username', '<p class="help-block">', '</p>').'
		                    </div>
		                  </div>

							<div class="form-group">
								<label class="control-label col-xs-3">Password</label>
								<div class="col-xs-9">
								    <input type="password" class="form-control" id="password" name="password">
								    '.form_error('password', '<p class="help-block">', '</p>').'
								</div>
							</div>

							<div class="form-group">
								<div class="col-xs-offset-3 col-xs-9">
									<p class="help-block"><label><input type="checkbox" name="remember" id="remember" value="yes"> Simpan Password!</label>
									| <a href="'.set_url('login/lupa_password').'">Klik disini jika lupa password?</a></p>
								    <button type="submit" class="btn btn-primary input-block-level"><span class="glyphicon glyphicon-ok"></span> Login!</button>
								</div>
							</div>
						</form>
					</div>
					<div class="col-md-6"></div>
				</div>
				';
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
				redirect(set_url('user/index'));
			}
		}
		else{
			$post_detail->post_title = 'Login Member';
			$post_detail->post_content = '<div class="row">
	            <div class="col-md-6">
					<form class="form-horizontal" id="form-login" method="POST" action="'.set_url('user/login/validasi').'">

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
								<p class="help-block"><label><input type="checkbox" name="remember" id="remember" value="yes"> Saved password!</label>
								| <a href="'.set_url('login/lupa_password').'">forgot password?</a></p>
							    <button type="submit" class="btn btn-primary input-block-level"><span class="glyphicon glyphicon-ok"></span> Login!</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-6"></div>
			</div>
			';
		}

		$post_detail->post_attribute = json_encode(array());
    	$this->post->post_detail = $post_detail;

    	$this->site->_isDetail = TRUE;
		$this->site->view('halaman', $data);
	}

	public function index(){
		$this->site->is_logged_in();
		$data = array();
		$post_detail = new stdClass();
		$post_detail->post_title = 'Member Area';

		$session = $this->session->userdata;
		$post_detail->post_content = '<p>Welcome <strong>'.$session['username'].'</strong>, You can use member facilities "Menu User". <br /><br /></p>';
		$post_detail->post_attribute = json_encode(array());
    	$this->post->post_detail = $post_detail;

    	$this->site->_isDetail = TRUE;
		$this->site->view('halaman', $data);
	}

	public function setting($param=NULL){
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
			$user_exist = $this->User_detail_model->count(array('user_id' => get_user_info('ID')));
			if($param=='simpan'){
				$post = $this->input->post(NULL,FALSE);
				$post['tanggal_lahir'] = $post['year'].'-'.$post['month'].'-'.$post['date'];

				if(!empty($post['password'])){
					$password = bCrypt($post['password'],12);
					$this->User_model->update(array('password' => $password), array('ID' => get_user_info('ID')));
				}

				foreach($post as $key => $val){
					if($key == 'date' || $key == 'year' || $key == 'month' ||
						$key == 'email' || $key == 'username' || $key == 'password' )
						unset($post[$key]);
				}

				if($user_exist > 0){
					$this->User_detail_model->update($post, array('user_id' => get_user_info('ID')));
				}
				else{
					$post['user_id'] = get_user_info('ID');
					$this->User_detail_model->insert($post);
				}

				echo json_encode(array('status' => 'success'));
			}
			else if($param=='ambil'){
				if(get_user_info('ID')){

					if($user_exist > 0){
						echo json_encode(
							array(
								'status' => 'success',
								'data' => $this->User_model->get_user_detail(get_user_info('ID'), NULL,NULL,TRUE )
							)
						);
					}
					else{
						echo json_encode(
							array(
								'status' => 'failed'
							)
						);
					}

				}
			}
		}
		else{
			$this->site->is_logged_in();
			$data = array();
			$post_detail = new stdClass();
			$post_detail->post_title = 'Setting Member Account';
			$post_detail->post_content = '

			<div class="row">
			    <div class="col-md-8">

					<!--<div class="alert alert-success alert-dismissible" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>Telah Disimpan!</strong> Data Krudensial Anda telah disimpan.
					</div>-->

					<form class="form-horizontal" id="form-setting" method="POST" action="'.set_url('user/setting/simpan').'">
						<h4>Account</h4>
						<div class="form-group">
	                    	<label class="control-label col-xs-3">Email</label>
		                    <div class="col-xs-9">
		                        <input type="email" class="form-control disabled" id="email" name="email" disabled>

		                    </div>
	                    </div>
						<div class="form-group">
	                    	<label class="control-label col-xs-3">Username</label>
		                    <div class="col-xs-9">
		                        <input type="text" class="form-control disabled" id="username" name="username" disabled>
		                    </div>
	                    </div>
	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Password</label>
		                    <div class="col-xs-9">
		                        <input type="password" class="form-control" id="password" name="password" value="">

		                    	<p class="help-block"><strong>Kosongkan</strong> passwordnya jika tidak ingin merubah password</p>
		                    </div>
	                    </div>

	                    <h4>Profile</h4>
	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Firsname</label>
		                    <div class="col-xs-9">
		                        <input type="text" class="form-control" id="nama_depan" name="nama_depan" required>

		                    </div>
	                    </div>

	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Lastname</label>
		                    <div class="col-xs-9">
		                        <input type="text" class="form-control" id="nama_belakang" name="nama_belakang" required>

		                    </div>
	                    </div>

	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Gender</label>
		                    <div class="col-xs-9">
				              <div class="checkbox">
				                <label class="radio ">
				                  <input type="radio" value="pria" name="jenis_kelamin"> Male
				                </label>

				                <label class="radio ">
				                  <input type="radio" value="wanita" name="jenis_kelamin"> Female
				                </label>
				              </div>
		                    </div>
	                    </div>

	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Place of birth</label>
		                    <div class="col-xs-9">
		                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" required>
		                    </div>
	                    </div>

	                    <div class="form-group">
	                    	<label class="control-label col-xs-3">Date of birth</label>
		                    <div class="col-xs-9">
								<input type="text" name="date" id="date" class="form-control short" value="" placeholder="date" required />
								/
								<select name="month" id="month" required>
								<option value="0">Select month</option>
								<option value="1">January</option>
								<option value="2">February</option>
								<option value="3">March</option>
								<option value="4">April</option>
								<option value="5">May</option>
								<option value="6">June</option>
								<option value="7">July</option>
								<option value="8">August</option>
								<option value="9">September</option>
								<option value="10">October</option>
								<option value="11">November</option>
								<option value="12">December</option>
								</select>
								/
								<input type="text" name="year" id="year" class="form-control short" value="" placeholder="year" required />
		                    </div>
	                    </div>


	                    <h4>Contact</h4>
						<div class="form-group">
							<label class="control-label col-xs-3">State</label>
							<div class="col-xs-9">
							    '.form_dropdown_provinsi().'
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
							    <textarea class="form-control" name="alamat" id="alamat" rows="4" placeholder="Full address here..." required></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-xs-3">Postal Fee</label>
							<div class="col-xs-9">
							    <input type="text" class="form-control" id="kodepos" name="kodepos" required>
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-xs-3">Mobile Number</label>
							<div class="col-xs-9">
							    <input type="text" class="form-control" id="handphone" name="handphone" placeholder="08xxxx" required>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-offset-3 col-xs-9">
							<button type="button" class="btn btn-primary input-block-level" data-loading-text="Loading..." id="submit-setting" autocomplete="off"><span class="glyphicon glyphicon-ok"></span> Save </button>
							</div>
						</div>

					</form>
				</div>
				<div class="col-md-4">
				</div>
			</div>';
			$post_detail->post_attribute = json_encode(array());
	    	$this->post->post_detail = $post_detail;

	    	$this->site->_isDetail = TRUE;
			$this->site->view('halaman', $data);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect(set_url('user/login'));
	}

	function password_check($str){
		$post = $this->input->post(NULL,TRUE);
		$user_detail = $this->User_model->get_by(array('username' => $post['username']), 1, NULL, TRUE);
		$this->user_detail = $user_detail;

    	if (@$user_detail->password == crypt($str,@$user_detail->password)){
			return TRUE;
		}
		else{
			$this->form_validation->set_message('password_check', 'Passwordnya salah...');
			return FALSE;
		}
	}

}
