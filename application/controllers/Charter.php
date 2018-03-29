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
		if (!$this->user_session) {
			redirect('login');
		}
	}

	public function dashboard(){
		if ($this->user_session['type']!='2') {
			$this->session->unset_userdata('user');
			redirect('login');
		}
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

	public function charter_maps($id=NULL){
		$data = [];
		$data['charter'] = '';
		/**
		 * Map
		 */
		$this->load->library('googlemaps');
		$config = array();
		$config['center'] = 'auto';
		$config['onboundschanged'] = "
		var centreGot = false;
		if (!centreGot) {
			var mapCentre = map.getCenter();
			marker_0.setOptions({
				position: new google.maps.LatLng(mapCentre.lat(), mapCentre.lng()) 
			});
		}
		centreGot = true;";
		$this->googlemaps->initialize($config);
		// set up the marker ready for positioning 
		// once we know the users location
		$marker = array();
		$marker['draggable'] = true;
		$marker['ondragend'] = "$('#lat').val(event.latLng.lat());$('#long').val(event.latLng.lng());";
		$this->googlemaps->add_marker($marker);
		$data['map'] = $this->googlemaps->create_map();
		/**
		 * Map
		 */
		if ($id) {
			extract($this->input->post());
			$required = $id == 'create-new' ? '|required' : '';
			$this->form_validation->set_rules('name', 'Charter Name', 'trim'.$required.'|strip_tags');
			$this->form_validation->set_rules('email', 'Email Address', 'trim'.$required.'|strip_tags|valid_email');
			$this->form_validation->set_rules('lat', 'Lattitude', 'trim'.$required.'|strip_tags');
			$this->form_validation->set_rules('long', 'Longitude', 'trim'.$required.'|strip_tags');
			$this->form_validation->set_rules('area', 'Service Area', 'trim'.$required.'|strip_tags');
			if (($this->input->server('REQUEST_METHOD') === 'POST' && $this->form_validation->run() == TRUE) && !empty($this->user_session)) {
				$data['charter'] = $this->charter->getAllCharters(NULL,['id'=>base64_decode($id)])[0];
				$charter_data = $this->input->post();
				if (!empty($id) && $id != 'create-new') {
					$charter_data['id'] = base64_decode($id);
					$this->charter->updateCharter($charter_data);
					$notification = ['title'=>'Success!', 'status'=>'success','message'=>'Charter updated successfully.'];
				}else if($data['charter']){
					$charter_data['user_id'] = 0;
					if ($this->charter->addCharter($charter_data)) {
						$notification = ['title'=>'Success!','status'=>'success','message'=>'Charter created successfully.'];
					}
				} else {
					echo_json(['status'=>'error','message'=>'Something went wrong.']);
				}
				$data['notification'] = 
				[
					'notify'		=>	'TRUE',
					'notify_obj'	=>	[
											'time'				=>	'1000',
											'notify_title'		=>	$notification['title'],
											'notify_message'	=>	$notification['message'],
											'notify_type'		=>	$notification['status'],
											'notify_placement'	=>	[
																		'from'=>'top',
																		'align'=>'right'
																	],
										]
				];
			}
			$data['charter'] = $this->charter->getAllCharters(NULL,['id'=>base64_decode($id)]);
			$data['charter'] = $data['charter'] ? $data['charter'][0] : [];
		}
		load_view('charter-maps',$data,'admin');
	}

}
