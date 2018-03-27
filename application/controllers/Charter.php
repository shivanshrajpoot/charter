<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Charter extends CI_Controller {

	public function __construct(){
		parent::__construct();
		__check_login_status('charter');
		$this->load->helper([
			'form', 
			'url'
		]);
		$this->load->library([
			'session',
			'form_validation'
		]);
		$this->load->model([
			'User_model'=>'user',
			'Charters_model'=>'charter',
			'Requests_model'=>'request',
			'Quotes_model'=>'quote',
			'Aircrafts_model'=>'aircraft',
		]);
		$this->user_session = $this->session->userdata('user');
	}

	public function dashboard(){
		load_view('dashboard',$this->user_session,'charter');
	}

	public function requests(){
		$requests['requests'] = $this->request->getAll();
		array_walk($requests['requests'], function(&$value,&$key){
			$value['is_requested'] = $this->db->select('id')
					 ->from('quotes AS q')
					 ->where('q.request_id',$value['id'])
					 ->get()->row_array()['id'];
			return $value;
		});
		$requests['aircrafts'] = $this->aircraft->getAll();
		$data = array_merge($this->user_session,$requests);
		load_view('requests',$data,'charter');
	}

	public function quotes(){
		$quotes['quotes'] = $this->quote->getAll('',['user_id'=>$this->user_session['id']]);
		$data = array_merge($this->user_session,$quotes);
		load_view('quotes',$data,'charter');
	}

	public function submit_price(){
		$quote = stripKeyValues($this->input->post());
		$quote['user_id'] = $this->user_session['id'];
		$this->form_validation->set_rules('aircraft_id', 'Aircraft', 'trim|required|strip_tags');
		$this->form_validation->set_rules('flight_time', 'Flight Time', 'trim|required|strip_tags');
		$this->form_validation->set_rules('price', 'Price', 'trim|required|strip_tags');
		$this->form_validation->set_rules('origin', 'Origin', 'trim|required|strip_tags');
		$this->form_validation->set_rules('destination', 'Desitnation', 'trim|required|strip_tags');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) {
			if ($this->quote->add($quote)) {
				echo_json(['status'=>'success','saved'=>'true','message'=>'Quote Submitted successfully.','reload'=>'true']);
			}else{
				echo_json(['status'=>'failure']);
			}
		}else{
			echo_json(['errors'=>explode('.',strip_tags(validation_errors())),'status'=>'failure']);
		}
	}

	public function aircrafts(){
		$quotes['aircrafts'] = $this->aircraft->getAll('',['user_id'=>$this->user_session['id'],'status'=>'active']);
		$data = array_merge($this->user_session,$quotes);
		load_view('aircrafts',$data,'charter');
	}

	public function create_aircraft(){
		$aircraft = stripKeyValues($this->input->post());
		$aircraft['user_id'] = $this->user_session['id'];
		$this->form_validation->set_rules('name', 'Aircraft Name', 'trim|required|strip_tags');
		$aircraft['image'] = uploadImage($_FILES['image'],'aircrafts');
		if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) {
			if (!empty($aircraft['id'])) {
				$this->aircraft->update($aircraft);
				echo_json(['status'=>'success','saved'=>'true','message'=>'Aircraft updated successfully.','reload'=>'true']);
			}else if ($this->aircraft->add($aircraft)) {
				echo_json(['status'=>'success','saved'=>'true','message'=>'Aircraft Submitted successfully.','reload'=>'true']);
			}else{
				echo_json(['status'=>'failure','message'=>'Something went wrong.']);
			}
		}else{
			echo_json(['messages'=>validation_errors(),'status'=>'failure']);
		}
	}

	public function delete_aircraft(){
		extract($this->input->post());
		if ($this->aircraft->delete($id)) {
			echo_json(['status'=>'success','saved'=>'true','message'=>'Aircraft deleted successfully.']);
		}else{
			echo_json(['status'=>'failure']);
		}
	}

	public function delete_quote(){
		extract($this->input->post());
		if ($this->quote->delete($id)) {
			echo_json(['status'=>'success','saved'=>'true','message'=>'Quote deleted successfully.']);
		}else{
			echo_json(['status'=>'failure']);
		}	
	}

}
