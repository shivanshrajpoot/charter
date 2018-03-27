<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct(){
		parent::__construct();
		__check_login_status('admin');
		$this->load->helper([
			'form', 
			'url',
			'function'
		]);
		$this->load->library([
			'session',
			'form_validation'
		]);
		$this->load->model([
								'User_model'	=>'user',
								'Charters_model'=>'charter',
								'Admin_model'	=>'admin',
								'Requests_model'=>'request',
								'Aircrafts_model'=>'aircraft',
							]);
		$this->user_session = $this->session->userdata('user');
	}

	public function dashboard(){
		$data['user'] = $this->user_session;
		load_view('dashboard',$data,'admin');
	}

	public function charters(){
		$data['charters'] = $this->charter->getAllCharters();
		$data['users'] = $this->user->getAllUsers(['type'=>'2']);
		load_view('charters',$data,'admin');
	}

	public function create_charter(){
		extract($this->input->post());
		$this->form_validation->set_rules('name', 'Charter Name', 'trim|required|strip_tags');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|strip_tags|valid_email');
		$this->form_validation->set_rules('lat', 'Lattitude', 'trim|required|strip_tags');
		$this->form_validation->set_rules('long', 'Longitude', 'trim|required|strip_tags');
		$this->form_validation->set_rules('area', 'Service Area', 'trim|required|strip_tags');
		if (($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) || !empty($this->user_session)) {
			$charter_data = $this->input->post();
			$charter_data['user_id'] = 0;
			if (!empty($charter_data['id'])) {
				$this->charter->updateCharter($charter_data);
				echo_json(['status'=>'success','saved'=>'true','message'=>'Charter updated successfully.','reload'=>'true']);
			}else if($this->charter->addCharter($charter_data)){
				echo_json(['status'=>'success','saved'=>'true','message'=>'Charter created successfully.','reload'=>'true']);
			} else {
				echo_json(['status'=>'failure']);
			}
		}
	}

	public function delete_charter(){
		extract($this->input->post());
		if ($this->charter->deleteCharter($id)) {
			echo_json(['status'=>'success','saved'=>'true','message'=>'Charter deleted successfully.']);
		}else{
			echo_json(['status'=>'failure']);
		}
	}
	public function delete_user(){
		extract($this->input->post());
		if ($this->user->deleteUser($id)) {
			echo_json(['status'=>'success','saved'=>'true','message'=>'User deleted successfully.']);
		}else{
			echo_json(['status'=>'failure']);
		}
	}

	public function list_users(){
		$data['_users'] 		= $this->user->getAllUsers(['type'=>'3']);
		$data['charters'] 	= $this->user->getAllUsers(['type'=>'2']);
		$data['users'] 		= array_merge_recursive($data['charters'],$data['_users']);
		load_view('users',$data,'admin');
	}

	public function configure(){
		$data['configuration'] = $this->admin->get_any_table('config');
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			foreach ($_POST as $key => $value) {
				$this->admin->update_any_table('config',['value'=>$value],['key'=>$key]);
			}
			$data['notification'] = 
			[
				'notify'		=>	'TRUE',
				'notify_obj'	=>	[
										'time'				=>	'1000',
										'notify_title'		=>	'Success!',
										'notify_message'	=>	'Configuration Updated Successfully',
										'notify_type'		=>	'success',
										'notify_placement'	=>	[
																	'from'=>'top',
																	'align'=>'right'
																],
									]
			];
		}else{
			$data['notification'] = FALSE;
		}
		load_view('configure',$data,'admin');
	}

	public function requests(){
		$data['requests'] = $this->request->getAll();
		array_walk($data['requests'], function(&$value,&$key){
			$value['is_requested'] = $this->db->select('q.*,CONCAT(first_name," ",last_name) as user_name')
					 ->from('quotes AS q')
					 ->where('q.request_id',$value['id'])
					 ->join('users as us','q.user_id = us.id','left')
					 ->get()->row_array()['user_name'];
			return $value;
		});
		load_view('requests',$data,'admin');
	}

	public function email_templates(){
		$data['templates'] = $this->admin->get_any_table('email_templates');
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			foreach ($_POST as $key => $value) {
				$this->admin->update_any_table('email_templates',$value,['template_key'=>$key]);
			}
		}
		load_view('email-templates',$data,'admin');
	}

	public function create_user(){
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
	    			echo_json(['status'=>'success','message'=>'User Added Successfully.','saved'=>'true']);
	    		}else{
	    			echo_json(['status'=>'failed','message'=>'Something went wrong.']);
	    		}
	    	}else{
	    		echo_json(['status'=>'failed','messages'=>validation_errors()]);
	    	}
		}
	}

	public function static_content(){
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			foreach ($_POST as $page_name => $value) {
				$this->admin->update_any_table('static_content',$value,['page_name'=>$page_name]);
			}
			$data['notification'] = 
			[
				'notify'		=>	'TRUE',
				'notify_obj'	=>	[
										'time'				=>	'1000',
										'notify_title'		=>	'Success!',
										'notify_message'	=>	'Static Content Updated Successfully',
										'notify_type'		=>	'success',
										'notify_placement'	=>	[
																	'from'=>'top',
																	'align'=>'right'
																],
									]
			];
		}else{
			$data['notification'] = FALSE;
		}
		$data['static_content'] = $this->admin->get_any_table('static_content');
		load_view('static-content',$data,'admin');
	}

	public function aircrafts(){
		$quotes['aircrafts'] = $this->aircraft->getAll('aircrafts.*,CONCAT(first_name," ",last_name) AS user_name, us.status AS user_status', ['aircrafts.status'=>'active'],['table_name'=>'users as us','clause'=>'us.id = aircrafts.user_id']);
		$data = array_merge($this->user_session,$quotes);
		load_view('aircrafts',$data,'admin');
	}
	public function assign_user(){
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
			$this->charter->updateCharter($_POST);
	    	echo_json(['status'=>'success','message'=>'User Assigned Successfully.','saved'=>'true','reload'=>'true']);
		}else{
	    	echo_json(['status'=>'failed','message'=>'Something went wrong.']);
		}
	}
}
