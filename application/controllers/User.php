<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->helper([
			'form', 
			'url',
			'facebook'
		]);
		$this->load->library([
			'session',
			'form_validation'
		]);
		$this->load->model(['User_model'=>'user','Charters_model'=>'charter','Requests_model'=>'request']);
		$this->user_session = $this->session->userdata('user');
	}

	public function logout(){
		$this->session->unset_userdata('user');
		echo_json(['status'=>'success','location'=>base_url()]);
		redirect();
	}
	
	public function login() {
		$msg = NULL;
		$this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[25]|callback_isValidUser');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) {
			switch ($this->user_session['type']) {
				case '1':
					$url = '/dashboard';
					$this->session->set_userdata('dashboard_url',$url);
					redirect($url);
					break;
				case '2':
					$url = '/charter/dashboard';
					$this->session->set_userdata('dashboard_url',$url);
					redirect($url);
					break;
				case '3':
					$url = '/user/dashboard';
					$this->session->set_userdata('dashboard_url',$url);
					redirect($url);
				default:
					redirect();
			}
		} else {
	    	$this->uri->segment(1) == 'admin' ? load_view('login',['msg'=>$msg],'admin') : load_view('login',['msg'=>$msg],'user',TRUE);
		}
	}

	function isValidUser() {
		extract($this->input->post());
		if(!empty($username) && !empty($password)){
			$user = $this->user->getUser($username);
			if (empty($user) || password_verify($password,$user['password']) === FALSE) {
	            $this->form_validation->set_message('isValidUser', 'Invalid credentials.');
				return FALSE;
			} else {
				if ($username == 'admin' && $this->uri->segment(1) != 'admin') {
					return FALSE;
				}else{
					if ($user['status'] == 'deleted' || $user['status'] == 'inactive') {
						$this->form_validation->set_message('isValidUser', 'Your account is '.$user['status'].'.Please contact admin.');
						return FALSE;
					}
	            	$this->session->set_userdata('user',$user);
	            	$this->user_session = $this->session->userdata('user');
					return TRUE;
				}
			}
		}
	}

	public function facebook_login(){
		try_fb_login();
	}

	public function profile(){
		if (!$this->user_session) {
			redirect('login');
		}
		$userdata = $this->user_session;
		$data['userdata'] = $userdata;
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags');
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|strip_tags|max_length[25]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|strip_tags|max_length[25]');
		$this->form_validation->set_rules('contact', 'Contact', 'trim|strip_tags|min_length[8]|max_length[12]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[25]');
		$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|strip_tags|min_length[8]|max_length[25]|matches[password]');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && !$this->session->flashdata('submitted')) {
	    	if($this->form_validation->run() == TRUE) {
	    		$user_data = stripKeyValues($this->input->post());
	    		unset($user_data['password_conf']);
	    		$user_data['password'] = __hash_password($user_data['password']);
	    		$id = $user_data['user_id'];
	    		unset($user_data['user_id']);
	    		$new_userdata = $this->user->updateUser($id,$user_data)[0];
	    		if ($new_userdata) {
	    			$this->session->set_userdata('user',$new_userdata);
	    			$this->session->set_flashdata('submitted','TRUE');
	    			$status = 'Success';
	    			$msg = 'Profile Updated Successfully';
	    			$type = 'success';
	    		}else{
	    			$status = 'Failed';
	    			$msg = 'Something went wrong.';
	    			$type = 'error';
	    		}
	    	}else{
	    		$status = 'Failed';
	    		$msg = 'Please Check for errors.';
	    		$type = 'danger';
	    	}
			$data['notification'] = 
						[
							'notify'		=>	'TRUE',
							'notify_obj'	=>	[
													'time'				=>	'1000',
													'notify_title'		=>	$status,
													'notify_message'	=>	$msg,
													'notify_type'		=>	$type,
													'notify_placement'	=>	[
																				'from'=>'top',
																				'align'=>'right'
																			],
												]
						];  	
		}
		switch ($userdata['type']) {
			case '1':
				$data = $userdata;
				$data['userdata'] = $userdata;
				load_view('profile',$data,'admin');
				break;
			case '2':
				$data['charter'] = $this->charter->getAllCharters('',['user_id'=>$userdata['id']])[0];
				$data = array_merge($data,$userdata);
				load_view('profile',$data,'charter');
				break;
			case '3':
			default:
				$data['requests'] = $this->request->getAllRequests('',['user_id'=>$this->user_session['id']]);
				$data['count_info']['requests'] = count($data['requests']);
				load_view('profile',$data,'user');
				break;
		}
	}

	public function dashboard(){
		if (!$this->user_session && $user_session != 3) {
			redirect('login');
		}
		$data['requests'] = $this->request->getAllRequests('',['user_id'=>$this->user_session['id']]);
		$data['count_info']['requests'] = count($data['requests']);
		$data['userdata'] = $this->user_session;
		load_view('dashboard',$data,'user');
	}

	public function forgot_password(){
		$data = [];
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags');
		if ($this->input->server('REQUEST_METHOD') == 'POST' && $this->form_validation->run() == TRUE) {
			$user = $this->user->getUser($this->input->post('email'));
			if (!empty($user) && $user['status'] == 'active') {
				$code = md5(microtime().'-'.rand(4,10));
				/*update password reset code*/
				$this->db->where('id', $user['id']);
				$this->db->update('users', array('reset_code' => $code));
				/*update password reset code*/

				/*******this is used for sending email********/
				$email_data['name'] = $user['first_name'].' '.$user['last_name'];
				$email_data['link'] = base_url('reset-password'.'/'.$code.'/'.base64_encode($user['type']));
				$mail_send = __send_email($user['email'],"reset_password",$email_data);
				$this->session->set_flashdata('msg','We sent you an e-mail with password reset link, please check your e-mail to update your password.');
				redirect('login');
			}else{
				$this->session->set_flashdata('msg','Sorry, We could not find any account related with the provided e-mail...');
			}
		}
		load_view('forgot-password',$data,'user',TRUE);
	}

	public function reset_password($code,$user_type){
		$user_type = base64_decode($user_type);
		if (!$user_type || !$code) {
			redirect();
		}else{
			$user = $this->db->get_where('users',['reset_code'=>$code])->row_array();
			if ($this->input->server('REQUEST_METHOD') == 'POST' && !empty($user)) {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[25]');
				$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|strip_tags|min_length[8]|max_length[25]|matches[password]');
				if ($this->form_validation->run() == TRUE) {
					$upated = $this->db->update('users',['password'=>__hash_password($this->input->post('password')),'reset_code'=>''],['id'=>$user['id']]);
					if ($upated) {
						$msg = 'Your password has been reset successfully.Please login to continue...';
					}else{
						$msg = 'Something went wrong, Please try again...';
					}
					$this->session->set_flashdata('msg',$msg);
					redirect('login');
				}
			}else{
				$is_valid = 'Invalid request, please try again...';
				$this->session->set_flashdata('is_valid',$is_valid);
			}
		}
		$data = [];
		load_view('reset-password',$data,'user',TRUE);
	}

	public function success_page(){
		$data = [];
		if ($this->session->flashdata('success_page')) {
			load_view('blank',$data,'user',TRUE);
		}else{
			redirect();
		}
	}
}
