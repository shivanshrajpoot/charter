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
			'Popular_destination_model'=>'popular_destination',
		]);
		$this->user_session = $this->session->userdata('user');
	}
	
	public function index() {
		$data = [];
		$data['popular_destinations'] = $this->popular_destination->getAll();
		if ($this->user_session) {
			$data['quotes_url'] = 'all-quotes/'.base64_encode($this->user_session['id']);
		}
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			if ($this->input->post('contact_us') == 'contact_us') {
		    	$post_data = stripKeyValues($this->input->post());
			    $post_data = stripKeyValues($this->input->post());
				if ($this->input->post('contact_us') == 'contact_us') {
					extract(array_filter($post_data));
					if (!empty($email) && !empty($message)) {
						__send_email($email,'contact_reply',['message'=>$message,'link'=>base_url()],'');
						__send_email(ADMIN_EMAIL,'contact_us',['message'=>$message,'link'=>base_url()],'');
						$success_data['title'] = 'Success'; 
						$success_data['message'] = 'Thank You For Contacting Us.We will get back to you soon...'; 
						$success_data['type'] = 'success'; 
						$this->session->set_flashdata('success_page',$success_data);
						redirect('success');
					}
				}else{
					$this->form_validation->set_rules('from', 'From ', 'trim|required|strip_tags');
					$this->form_validation->set_rules('to', 'To', 'trim|required|strip_tags');
					$this->form_validation->set_rules('dep_date', 'Departure Date', 'trim|required|strip_tags');
					$this->form_validation->set_rules('dep_time', 'Departure Time', 'trim|required|strip_tags');
					$this->form_validation->set_rules('no_of_pass', 'No. of Passengers', 'trim|required|strip_tags');
					$this->form_validation->set_rules('no_of_pass', 'No. of Passengers', 'trim|required|strip_tags');
					if (!$this->user_session) {
						$msg = 'Please login to see available quotes...';
						$this->session->set_flashdata('msg',$msg);
						redirect('login');
					}
					if ($this->form_validation->run() == TRUE) {
						unset($post_data['return']);
						$temp_id = $this->request->add($post_data);
						foreach ($this->charter->getAllCharters('email,name') as $key => $charter) {
							__send_email($charter['email'],'charter_notify',$charter,stripKeyValues($post_data));
						}
						$this->session->set_flashdata('temp_id',$temp_id);
						$data['show_loader'] = 'true';
					}
				}
			}
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
	    		$userdata = stripKeyValues($this->input->post());
	    		unset($userdata['password_conf']);
	    		$userdata['uuid'] = guid();
	    		$userdata['type'] = '3';
	    		$userdata['password'] = __hash_password($userdata['password']);
	    		if ($this->user->addUser($userdata)) {
	    			__send_email($_POST['email'],'user_creation',$_POST);
	    			$this->session->set_flashdata('msg','Your account was created successfuly, We also sent you an e-mail with your details. ');
	    			redirect('login');
	    		}else{
	    			$msg = 'Something went wrong.';
	    		}
	    	}
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

	public function all_quotes($id){
		$data['popular_destinations'] = $this->popular_destination->getAll();
		if ($id) {
			$data['quotes'] = $this->quote->getAllQuoteData(base64_decode($id));
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
