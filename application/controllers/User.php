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
	}
	
	public function login() {
		$msg = NULL;
		$this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[25]|callback_isValidUser');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) {
			switch ($this->user_session['type']) {
				case '1':
					redirect('/dashboard');
					break;
				case '2':
					redirect('/charter/dashboard');
					break;
				case '3':
				default:
					redirect('/user/dashboard');
			}
			// $this->uri->segment(1) == 'admin' ? redirect('/dashboard') : load_view('test',$this->user_session);

		} else {
	    	$this->uri->segment(1) == 'admin' ? load_view('login',['msg'=>$msg],'admin') : load_view('login',['msg'=>$msg],'user',TRUE);
		}
	}

	function isValidUser() {
		$remember_me = NULL;
		extract($this->input->post());
		if(!empty($username) && !empty($password)){
			$user = $this->user->getUser($username);
			if ($username == 'admin' && $password == 'admin@123' && empty($user)) {
				$this->user->addUser([ 
					'first_name'=>'Admin',
					'last_name'=>'',
					'email'=>'admin',
				    'password'=>'$2y$10$8/3RU43xkEZH2E3dBfy9Du06xRWDHRjLSzE1w2sL1c3f05Uuk357e',
				    'contact'=>'1234567890',
				    'type'=>'1'
				]);
            	$this->session->set_userdata('user',$this->user->getUser($username));
            	$this->user_session = $this->session->userdata('user');
				return TRUE;
			}
			if (empty($user) || password_verify($password,$user['password'])) {
	            $this->form_validation->set_message('isValidUser', 'Invalid credentials.');
				return FALSE;
			} else {
            	$this->session->set_userdata('user',$user);
            	$this->user_session = $this->session->userdata('user');
				/*if ($remember_me == 'true') {
					$this->load->helper('cookie');
				}*/
				return TRUE;
			}
		}
	}

	public function facebook_login(){
		try_fb_login();
	}

	public function profile(){
		$userdata = $this->user_session;
		$data['userdata'] = $userdata;
		switch ($userdata['type']) {
			case '1':
				$data = $userdata;
				load_view('profile',$data,'admin');
				break;
			case '2':
				$data['charter'] = $this->charter->getAllCharters('',['user_id'=>$userdata['id']])[0];
				$data['userdata'] = $userdata;
				$data = array_merge($data,$userdata);
				load_view('profile',$data,'charter');
				break;
			case '1':
			default:
				$data['requests'] = $this->request->getAllRequests('',['user_id'=>$this->user_session['id']]);
				$data['count_info']['requests'] = count($data['requests']);
				load_view('profile',$data);
				break;
		}
	}

	public function dashboard(){
		$data['requests'] = $this->request->getAllRequests('',['user_id'=>$this->user_session['id']]);
		$data['count_info']['requests'] = count($data['requests']);
		$data['userdata'] = $this->user_session;
		load_view('dashboard',$data);
	}
}
