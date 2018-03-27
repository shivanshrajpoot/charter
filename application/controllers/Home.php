<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	private $user_session;
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
		$this->load->model([
			'User_model'		=>	'user',
			'Charters_model'	=>	'charter',
			'Requests_model'	=>	'request',
			'Admin_model'		=>	'admin',
			'Quotes_model'		=>	'quote',
		]);
		$this->user_session = $this->session->userdata('user');
	}
	
	public function index() {
		$data['csrf'] = [
	        'name' => $this->security->get_csrf_token_name(),
	        'hash' => $this->security->get_csrf_hash()
	    ];
	    $post_data = stripKeyValues($this->input->post());
		$this->form_validation->set_rules('from', 'From ', 'trim|required|strip_tags');
		$this->form_validation->set_rules('to', 'To', 'trim|required|strip_tags');
		$this->form_validation->set_rules('dep_date', 'Departure Date', 'trim|required|strip_tags');
		$this->form_validation->set_rules('dep_time', 'Departure Time', 'trim|required|strip_tags');
		$this->form_validation->set_rules('no_of_pass', 'No. of Passengers', 'trim|required|strip_tags');
		$this->form_validation->set_rules('no_of_pass', 'No. of Passengers', 'trim|required|strip_tags');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) {
			unset($post_data['return']);
			$temp_id = $this->request->add($post_data);
			foreach ($this->charter->getAllCharters('email,name') as $key => $charter) {
				__send_email($charter['email'],'charter_notify',$charter,stripKeyValues($post_data));
			}
			$this->session->set_flashdata('temp_id',$temp_id);
			$data['show_loader'] = 'true';
		}
		load_view('home',$data,'user',TRUE);
	}

	public function register() {
		$msg = NULL;
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|strip_tags|is_unique[users.email]');
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|strip_tags|max_length[25]');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|strip_tags|max_length[25]');
			$this->form_validation->set_rules('gender', 'Gender', 'trim|required|strip_tags');
			$this->form_validation->set_rules('contact', 'Contact', 'trim|strip_tags|min_length[8]|max_length[12]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|strip_tags|min_length[8]|max_length[25]');
			$this->form_validation->set_rules('password_conf', 'Password Confirmation', 'trim|required|strip_tags|min_length[8]|max_length[25]|matches[password]');
	    	if($this->form_validation->run() == TRUE) {
	    		$userdata = array_map('_stripTags_trim',$this->input->post());
	    		unset($userdata['password_conf']);
	    		$userdata['uuid'] = guid();
	    		$userdata['password'] = __hash_password($userdata['password']);
	    		if ($this->user->addUser($userdata)) {
	    			redirect('login');
	    		}else{
	    			$msg = 'Something went wrong.';
	    		}
	    	}
		}
		if ($_POST['user_id']) {

			redirect('my-profile');
		}
		load_view('register',['msg'=>$msg],'user',TRUE);
	}

	public function privacy_policy(){
		$data['content'] = $this->admin->get_any_table('static_content',['page_name'=>'privacy_policy'])[0];
		load_view('static-content',$data,'user',TRUE);
	}

	public function terms_and_conditions(){
		$data['content'] = $this->admin->get_any_table('static_content',['page_name'=>'terms_and_conditions'])[0];
		load_view('static-content',$data,'user',TRUE);
	}

	public function about_us(){
		$data['content'] = $this->admin->get_any_table('static_content',['page_name'=>'about_us'])[0];
		load_view('static-content',$data,'user',TRUE);
	}

	public function all_quotes(){
		if ($this->session->flashdata('temp_id')) {
			$data['quotes'] = $this->quote->getAllQuoteData();
			load_view('all-quotes',$data,'user',TRUE);
		}else{
			redirect();
		}
	}

	public function view_quote($id){
		$data['quote'] = $this->quote->getAllQuoteData(base64_decode($id))[0];
		if ($data['quote']) {
			load_view('view-quote',$data,'user',TRUE);
		}else{
			redirect();
		}
	}
}
