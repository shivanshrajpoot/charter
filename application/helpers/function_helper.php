<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
include('system/helpers/file_helper.php');

	/**
	*this function is used to print array
	*/

	function echo_json($data){
		echo json_encode($data);
	}

	function pp($arr, $die="true")
	{
		echo '<pre>';
		print_r($arr);
		echo '</pre>';
		if($die == 'true')
		{
			die();
		}
	}

	function __hash_password($password){
		$options = [];
		return password_hash($password, PASSWORD_DEFAULT, $options);
	}

	function guid() {
		if (function_exists('com_create_guid') === true)
		    return trim(com_create_guid(), '{}');

		$data = openssl_random_pseudo_bytes(16);
		$data[6] = chr(ord($data[6]) & 0x0f | 0x40);
		$data[8] = chr(ord($data[8]) & 0x3f | 0x80);
		return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
	}

	function load_view($template,$data=null,$folder='user',$switch_header=FALSE){
		$CI = &get_instance();
		$CI->load->model(['Admin_model'=>'admin','Charters_model'=>'charter']);
		$app_info = $CI->admin->get_any_table('config');
		$data['static_content'] = $CI->admin->get_any_table('static_content');
		$_empty = [];
		foreach ($app_info as $key => $value) {
			$_empty[$value['key']] = $value['value'];
			$_constant = strtoupper($value['key']);
			!defined($_constant) ? define($_constant,$value['value']) : '';
		}
		if ($folder == 'charter') {
			$data['count_info'] = $CI->charter->get_all_counts($CI->user_session['id']);
		}elseif ($folder == 'admin') {
				$data['user'] = $CI->user_session;
				$data['count_info'] = $CI->admin->get_all_counts();
		}
		if ($folder == 'user' && $switch_header == FALSE) {
			$CI->load->view($folder.'/templates/header1',$data);
			$CI->load->view($folder.'/'.$template,$data);
			$CI->load->view($folder.'/templates/footer1',$data);
		}else{
			$CI->load->view($folder.'/templates/header',$data);
			$CI->load->view($folder.'/'.$template,$data);
			$CI->load->view($folder.'/templates/footer',$data);
		}
	}

	function _print_r($array)
	{
	   echo '<pre>';
	   print_r($array);
	   echo '</pre>';
	}

	/**
	*this function is used change date format
	*/
	function date_formatter($date)
	{
		$new_format = date('d M, Y', strtotime($date));
		return $new_format;
	}

	function ___encrypt($record_id) {
        return sprintf('%s%s',md5('singsys'),$record_id);
    }

    function ___decrypt($encrypted_id) {
        $encryption = md5('singsys');
        return str_replace($encryption,'', $encrypted_id);
    }

	/**
	*method - ___nullreplacer
	*developer id - 00338
	*this function is used to replace null values
	*/
	function ___nullreplacer(&$array)
	{
	   	array_walk_recursive($array, function(&$item){
	       	if($item == '' || $item == null) 
	       	{
	           	$item = '';
	       	}
	   	});
	   	return $array;
	}

	function __check_login_status($user_type){
		$CI = &get_instance();
		$CI->load->library('session');
		if (empty($CI->session->userdata('user'))) {
			redirect($user_type=='admin' || $user_type=='charter' ? 'admin' : 'login');
		}
	}

	/**
	*this function is used to generate refrence number
	*/
	function random_string($length = 10)
	{
	   	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	   	$charactersLength = strlen($characters);
	   	$randomString = '';
	   	for ($i = 0; $i < $length; $i++)
	   	{
		   	$randomString .= $characters[rand(0, $charactersLength - 1)];
	   	}
	   	return $randomString;
	}

	/**
	*this function is used to generate refrence number
	*/
	function random_number()
	{
		$length = 5;
	   	$characters = '0123456789';
	   	$charactersLength = strlen($characters);
	   	$randomString = '';
	   	for ($i = 0; $i < $length; $i++)
	   	{
		   	$randomString .= $characters[rand(0, $charactersLength - 1)];
	   	}
	   	return $randomString;
	}

  	/**
  	*@Description : This function is made to generate & digit code for the OTP
  	*@Method      : _get_NumcouponCode
  	*@Dated       : 01-12-2016
    *@Developer   : 344
  	*@param       : $code_len
  	*@return      : $code
  	*/
	function _generateOTP($code_len = '4') {
    	$chars = "0123456789";
    	$code = "";
    	for ($i = 0; $i < $code_len; $i++) {
        	$code .= $chars[mt_rand(0, strlen($chars) - 1)];
    	}
    	return $code;
	}

	/**
  	*@Description : This function is made to generate oauth access token
  	*@Method      : _get_access_token
  	*@Dated       : 18-01-2018
    *@Developer   : 426
  	*@param       : $url
  	*@return      : $post_array
  	*/

  	function _url($url = "",$folder = "",$echo = true) {
	    if(preg_match( '/^(http|https):\\/\\/[a-z0-9]+([\\-\\.]{1}[a-z0-9]+)*\\.[a-z]{2,5}'.'((:[0-9]{1,5})?\\/.*)?$/i' ,$url)){
	        if($echo == true){
	        	echo $url;
	        }else{
	        	return $url;
	        }
	    }else{
	    	if($echo == true){
	        	echo base_url($url);
	        }else{
	        	return base_url($url);
	        }
	    }
	}

	function _get_access_token($url,$post_array=['client_id'=>'api@quickhealth.com', 'client_secret'=>'b37201a0a2bc7bcbc69e454afa56f2e60b054e9711b855725c1daec15223aaa5','grant_type'=>'client_credentials']){
		$build_http_query = build_http_query($post_array);
		$curl = curl_init();
		$curlconfig = array(
		  	CURLOPT_URL => $url,
		  	CURLOPT_RETURNTRANSFER => true,
		  	CURLOPT_ENCODING => "",
		  	CURLOPT_MAXREDIRS => 10,
		  	CURLOPT_TIMEOUT => 30,
		  	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  	CURLOPT_CUSTOMREQUEST => "POST",
		  	CURLOPT_POSTFIELDS => ($build_http_query),
		  	CURLOPT_SSL_VERIFYPEER => false,
		  	CURLOPT_SSL_VERIFYHOST => 0,
			CURLOPT_VERBOSE        => 1,    
		  	CURLOPT_HTTPHEADER => array(
		    	"cache-control: no-cache",
		    	"content-type: application/x-www-form-urlencoded",
		  	),
		);

		curl_setopt_array($curl,$curlconfig);

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  	return "Unable to fetch access token #:" . $err;
		} else {
		  	return $response;
		}
	}

	function build_http_query( $query ){
	    $query_array = array();
	    foreach( $query as $key => $key_value ){
	        $query_array[] = urlencode( $key ) . '=' . urlencode( $key_value );
	    }
	    return implode( '&', $query_array );
	}

	
	/**
  	*@Description : This function is made to send msg to the client regarding the OTP
  	*@Method      : Service_Twilio
  	*@Dated       : 01-12-2016
    *@Developer   : 344
  	*@param       : $toNumber,$msgBody
  	*@return      : 
  	*/
	function Service_Twilio($toNumber,$msgBody){
  		include APPPATH.'third_party/twilio/Services/Twilio.php';
  		$CI = & get_instance(); 
  		$CI->load->model('Admin_model','admin_model');
  		$AccountSid = $CI->admin_model->_getConfigurationByKey('TWILIO_ACC_SID');
  		$AuthToken = $CI->admin_model->_getConfigurationByKey('TWILIO_AUTH_TOKEN');
  		$client = new Services_Twilio($AccountSid, $AuthToken);


  		try {

	      	$message = $client->account->messages->create(array(
	       		"From" => $CI->admin_model->_getConfigurationByKey('TWILIO_NUMBER'), //From a valid Twilio number
	       		"To" => $toNumber, //Text this number
	       		"Body" => $msgBody,
	    	));

    	return 'success';
  		} catch (Services_Twilio_RestException $e) {
  			
     		return $e->getMessage();
  		}
	}


	function __send_email($email,$mailShortCode="",$email_data,$data=NULL) {
	   	$CI = & get_instance();
	   	$CI->load->model('Admin_model','admin_model');
	   	$CI->load->library('phpmailer');
	   	$CI->load->library('smtp');

	    switch($mailShortCode) {
	    	case "charter_notify":
			    
			    $msg = $CI->admin_model->_getMessage('charter_notify');
			    
			    $message  	= html_entity_decode($msg->body);
			    $subject 	= html_entity_decode($msg->subject);
			    	
			    $patternFind1[0] 	= '/{NAME}/';
			    $replaceFind1[0] 	= $email_data['name'];
			    
			    $patternFind1[1] 	= '/{CH_FROM}/';
			    $replaceFind1[1] 	= $data['from'];

			    $patternFind1[2] 	= '/{CH_TO}/';
			    $replaceFind1[2] 	= $data['to'];

			    $patternFind1[3] 	= '/{CH_DATE}/';
			    $replaceFind1[3] 	= $data['dep_date'];

			    $patternFind1[2] 	= '/{CH_TIME}/';
			    $replaceFind1[2] 	= $data['dep_time'];

			    $patternFind1[3] 	= '/{CH_PASSENGERS}/';
			    $replaceFind1[3] 	= $data['no_of_pass'];

			    $patternFind1[4] 	= '/{CH_RET_DATE}/';
			    $replaceFind1[4] 	= $data['ret_date'];

			    $patternFind1[2] 	= '/{CH_RET_TIME}/';
			    $replaceFind1[2] 	= $data['ret_time'];


			    $message = nl2br($message);
			    $txtdesc_contact	= stripslashes($message);
			    $contact_sub      	= stripslashes($subject);
			    $contact_sub      	= preg_replace($patternFind1, $replaceFind1, $contact_sub);
			    $ebody_contact 		= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			break;	

			case "user_creation":
			    
			    $msg = $CI->admin_model->_getMessage('user_creation');
			    
			    $message  	= html_entity_decode($msg->body);
			    $subject 	= html_entity_decode($msg->subject);
			    	
			    $patternFind1[0] 	= '/{name}/';
			    $patternFind1[1] 	= '/{email}/';
			    $patternFind1[2] 	= '/{password}/';
			    $patternFind1[3] 	= '/{mobile_number}/';
			    
			    $replaceFind1[0] 	= $email_data['name'];
			    $replaceFind1[1] 	= $email_data['email'];
			    $replaceFind1[2] 	= $email_data['password'];
			    $replaceFind1[3] 	= $email_data['mobile'];
			    $message = nl2br($message);
			    $txtdesc_contact	= stripslashes($message);
			    $contact_sub      = stripslashes($subject);
			    $contact_sub      = preg_replace($patternFind1, $replaceFind1, $contact_sub);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			break;			

			case "reset_password":
			    $adminEmail = $CI->admin_model->_getConfigurationByKey('signup_email');
			    $msg = $CI->admin_model->_getMessage('reset_password');
			    
			    $message  	= html_entity_decode($msg->body);
			    $subject 	= html_entity_decode($msg->subject);
			    	
			    $patternFind1[0] 	= '/{NAME}/';
			    $patternFind1[1] 	= '/{SITELINK}/';
		       	
			    $replaceFind1[0] 	= $email_data['name'];
			    $replaceFind1[1] 	= $email_data['link'];
			    
			    $message = nl2br($message);
			    $txtdesc_contact	= stripslashes($message);
			    $contact_sub      = stripslashes($subject);
			    $contact_sub      = preg_replace($patternFind1, $replaceFind1, $contact_sub);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			break;

			case "contact_reply":
			    $adminEmail = $CI->admin_model->_getConfigurationByKey('signup_email');
			    $msg = $CI->admin_model->_getMessage('contact_reply');

			    $message  	= html_entity_decode($msg->body);
			    $subject 	= html_entity_decode($msg->subject);

			    $patternFind1[0] 	= '/{REPLY}/';
			    $patternFind1[1] 	= '/{SITENAME}/';

			    $replaceFind1[0] 	= $email_data['message'];
			    $replaceFind1[1] 	= $email_data['link'];

			    $message = nl2br($message);
			    $txtdesc_contact	= stripslashes($message);
			    $contact_sub      = stripslashes($subject);
			    $contact_sub      = preg_replace($patternFind1, $replaceFind1, $contact_sub);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			break;

			case "contact_us":
			    $adminEmail = $CI->admin_model->_getConfigurationByKey('signup_email');
			    $msg = $CI->admin_model->_getMessage('contact_us');

			    $message  	= html_entity_decode($msg->body);
			    $subject 	= html_entity_decode($msg->subject);

			    $patternFind1[0] 	= '/{REPLY}/';
			    $patternFind1[1] 	= '/{SITENAME}/';

			    $replaceFind1[0] 	= $email_data['message'];
			    $replaceFind1[1] 	= $email_data['link'];

			    $message = nl2br($message);
			    $txtdesc_contact	= stripslashes($message);
			    $contact_sub      = stripslashes($subject);
			    $contact_sub      = preg_replace($patternFind1, $replaceFind1, $contact_sub);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			    $ebody_contact 	= preg_replace($patternFind1,$replaceFind1,$txtdesc_contact);
			break;
	    }

		$ebody_contact = nl2br($ebody_contact);
	    $CI->phpmailer->isSMTP();
	    // $CI->phpmailer->SMTPDebug = 2;
	    $CI->phpmailer->SMTPAuth = true;
	    $CI->phpmailer->SMTPSecure = 'ssl';
	    $CI->phpmailer->Host = $CI->admin_model->_getConfigurationByKey('smtp_server_host');
	    $CI->phpmailer->Port = $CI->admin_model->_getConfigurationByKey('smtp_port_number');
	    $CI->phpmailer->Username = $CI->admin_model->_getConfigurationByKey('smtp_uName');
	    $CI->phpmailer->Password = $CI->admin_model->_getConfigurationByKey('smtp_uPass');
	    $CI->phpmailer->FromName = 'Charters';
	    $mail_from = $CI->admin_model->_getConfigurationByKey('signup_email');
	    $CI->phpmailer->addAddress($email);
	    $CI->phpmailer->isHTML(true);
	    $CI->phpmailer->Subject = $contact_sub;
	    $CI->phpmailer->Body    = $ebody_contact;

	    if(!$CI->phpmailer->send()) {
	    	
	    	return 0;
	    // echo 'Mailer Error: ' . $CI->phpmailer->ErrorInfo;
	    } else {

	      return 1;
	      // echo 'Message has been sent 1';
	    }
	       //==========================================================
	}




	/**
	*this function is used to validate email
	*/
	function valid_email($str)
	{
	    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}


    function upload_service_image($folder)
    {

    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
        {
            mkdir(FCPATH . './uploads/'.$folder.'/thumb', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        $fileName = $_FILES['service_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        //echo "newFileName: " . $newFileName;
        $config['upload_path'] = './uploads/'.$folder.'/';

        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;

        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload('service_image'))
        {
            return $CI->upload->display_errors();
           //_loadAdminView('add_services', $data);
        }
        else
        {
            $NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
           $config_upload['new_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
            $config_upload['width'] = 375;
            $config_upload['height'] = 260;

            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
    }
/*this function is used to upload quickhealth work*/

    function upload_work_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
        {
            mkdir(FCPATH . './uploads/'.$folder.'/thumb', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }

        $fileName = $_FILES['work_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        //echo "newFileName: " . $newFileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload('work_image'))
        {
            return $CI->upload->display_errors();
        }
        else
        {
            $NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
           $config_upload['new_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
            $config_upload['width'] = 120;
            $config_upload['height'] = 110;

            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
    }

/*this function is used to upload  partner*/

    function upload_partner_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
        {
            mkdir(FCPATH . './uploads/'.$folder.'/thumb', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }

        $fileName = $_FILES['partner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        //echo "newFileName: " . $newFileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload('partner_image'))
        {
            return $CI->upload->display_errors();
        }
        else
        {
            $NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
           	$config_upload['new_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
            $config_upload['width'] = 154;
            $config_upload['height'] = 120;

            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
    }

/*this folder is used to upload banners*/
    function upload_banner_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }

        $fileName = $_FILES['banner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('banner_image'))
        {
        	$NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
            $config_upload['width'] = 740;
            $config_upload['height'] = 580;
            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
        else
        {
             return $CI->upload->display_errors();
        }
    }

    /*this folder is used to upload backgound banners*/
    function upload_banner_background_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }

        $fileName = $_FILES['banner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('banner_image'))
        {
        	$NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
            $config_upload['width'] = 1360;
            $config_upload['height'] = 768;
            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
        else
        {
             return $CI->upload->display_errors();
        }
    }

    /*this folder is used to upload backgound service banners*/
    function upload_banner_background_Service_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }

        $fileName = $_FILES['banner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('banner_image'))
        {
        	$NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
            $config_upload['width'] = 1360;
            $config_upload['height'] = 550;
            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
        else
        {
             return $CI->upload->display_errors();
        }
    }
/*this function is used to upload video*/
function upload_banner_video($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }

        $fileName = $_FILES['banner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'mp4';
        $config['max_size'] = 5120;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if ($CI->upload->do_upload('banner_image'))
        {
        	$NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';

            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
        else
        {
             return $CI->upload->display_errors();
        }
    }

    /*this fucntion is used to upload patient banner*/
    function upload_patient_banner_image($folder)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
        {
            mkdir(FCPATH . './uploads/'.$folder.'/thumb', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }


        $fileName = $_FILES['p_banner_image']['name'];
        $fileName = str_replace(' ', '_', $fileName);
        $newFileName = date('YmdHis').'_'.strtotime(date('Y-m-d H:i:s')).'_'.$fileName;
        $config['upload_path'] = './uploads/'.$folder.'/';
        $config['allowed_types'] = 'gif|GIF|jpg|JPEG|jpeg|JPG|png|PNG';
        $config['max_size'] = 2048;
        $config['file_name'] = $newFileName;
        $CI->load->library('upload');
        $CI->upload->initialize($config);

        if (!$CI->upload->do_upload('p_banner_image'))
        {
            return $CI->upload->display_errors();
        }
        else
        {
            $NewImageName = $newFileName;
            $config_upload = array();
            $config_upload['image_library'] = 'gd2';
            $config_upload['source_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
            $config_upload['maintain_ratio'] = TRUE;
            $config_upload['quality'] = '100%';
            $config_upload['width'] = 1360;
            $config_upload['height'] = 600;
            // CROP CONFIGURATION
            $CI->load->library('image_lib');
            $CI->image_lib->clear();
            $CI->image_lib->initialize($config_upload);
            if(!$CI->image_lib->resize())
            {
                $CI->message = strip_tags($CI->image_lib->display_errors());
                $CI->isError = TRUE;
            }
            else
            {
                $CI->practiceImg = $NewImageName;
            }
        }
    }

	function form_ckeditor($data)
	{
	  $script =  '  <script type="text/javascript">
	            $(function() {
	               var editor =  CKEDITOR.replace(\''.$data['id'].'\',{
		fullPage: false,	
		extraPlugins: \'wysiwygarea\',
		uiColor: \'#357CA5\'
	});
		        CKFinder.setupCKEditor( editor, \''.base_url().'lib/admin/js/plugins/ckfinder\' ) ;
			
	            });
	        </script>';
	    return $script;
	}

	function form_ckeditor_with_html($data)
	{
	  $script =  '  <script type="text/javascript">
	            $(function() {
	               var editor =  CKEDITOR.replace(\''.$data['id'].'\',{
		fullPage: true,	
		extraPlugins: \'wysiwygarea\',
		uiColor: \'#357CA5\'
	});
		        CKFinder.setupCKEditor( editor, \''.base_url().'lib/admin/js/plugins/ckfinder\' ) ;
			
	            });
	        </script>';
	    return $script;
	}

function _showMessage($message,$status)
{
	
	$CI =& get_instance();
	if($status == 'warning')
	{
		return $CI->session->set_flashdata('msg', '<div class="alert alert-warning alert-dismissable" id="alert-success-div"><b>Warning! </b>'.$message.'</div>');
	}
	if($status == 'success')
	{
		return $CI->session->set_flashdata('msg', '<div class="alert alert-success alert-dismissable" id="alert-success-div"><b>Success! </b>'.$message.'</div>');
	}
	if($status == 'error')
	{
		return $CI->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissable" id="alert-success-div">'.$message.'</div>');
	}
}

function upload_document($file){
	$status = false;
	$response = [];

	if(!is_dir(FCPATH . './uploads'))
    {
        mkdir(FCPATH . './uploads', 0777, true);
        chmod(FCPATH . './uploads', 0777);
    }
    else
    {
        chmod(FCPATH . './uploads', 0777);
    }
    if(!is_dir(FCPATH . './uploads/'.$folder.''))
    {
        mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
        chmod(FCPATH . './uploads/'.$folder.'', 0777);
    }
    else
    {
        chmod(FCPATH . './uploads/'.$folder.'', 0777);
    }

    $file_name = $_FILES[$file]['name'];
    if(empty($file_name))
    {
		$response = [
			'message' => 'File is required',
			'status' => 0,
		];
    }
    else
    {
    	if(isset($_FILES[$file]["type"]))
    	{
    		$validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "pdf", "PDF");
            $temporary = explode(".", $_FILES[$file]["name"]);
            $file_extension = end($temporary);

            if ($_FILES[$file]["error"] == 0 && in_array($file_extension, $validextensions))
            {
                $imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y"))."_".@$_FILES[$file]["name"];
                $sourcePath = $_FILES[$file]['tmp_name'];
                $targetPath = "uploads/document/".$imgName;
                move_uploaded_file($sourcePath,$targetPath);
                $doc[] = $imgName;

                if($file_extension == 'PDF' || $file_extension == 'pdf')
                {
                	$delete_url = site_url('delete-files-url');
                	$pdfIcon = base_url('lib/images/pdf-logo.png');
                	$html = '<div class="doc-pre">
                	<div class="remove-item" data-document_name="'.$imgName.'" style="cursor: pointer;">X</div><img src="'.$pdfIcon.'" /><input type="hidden" name="document_name[]"  value="'.$imgName.'" /><input type="hidden" name="image-delete-url" id="image-delete-url"  value="'.$delete_url.'" />
                	</div>';
                }
                else
                {
                	$delete_url = site_url('delete-files-url');
                	$imgIcon = base_url('uploads/document/' . $imgName);
                	$html = '<div class="doc-pre">
                	<div class="remove-item" data-document_name="'.$imgName.'" style="cursor: pointer;">X</div><img src="'.$imgIcon.'" /><input type="hidden" name="document_name[]" value="'.$imgName.'" /><input type="hidden" name="image-delete-url" id="image-delete-url"  value="'.$delete_url.'" />
                	</div>';
                }

                $response = [
					'message' => 'Upload File',
					'document_name' => $imgName,
					'document_url' => '',
					'document_preview' => $html,
					'status' => 1,
				];
            }
            else
            {
            	$response = [
					'message' => 'Invalid File',
					'status' => 0,
				];
            }
    	}
    }

    return json_encode($response);
}

function _getAllSurgeries()
{
	$CI = & get_instance();
	$CI->db->select('*');
	$CI->db->from('surgeries_procedures');
	$CI->db->where('type','surgeries');
	$data = $CI->db->get()->result_array();
	return $data;
}

function _long_term_medical_condition()
{
	$CI = & get_instance();
	$CI->db->select('*');
	$CI->db->from('surgeries_procedures');
	$CI->db->where('type','general_Symptoms');
	$data = $CI->db->get()->result_array();
	return $data;
}

function _getDuration($duration_id)
{
	$CI = & get_instance();
	$CI->db->select('*');
	$CI->db->from('duration');
	$CI->db->where('id_duration',$duration_id);
	$data = $CI->db->get()->row_array();
	return $data['duration'];	
}

function ipInfo($ip) {
	$default = 'UNKNOWN';

        if (!is_string($ip) || strlen($ip) < 1 || $ip == '127.0.0.1' || $ip == 'localhost')
            $ip = '8.8.8.8';

        $curlopt_useragent = 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.2) Gecko/20100115 Firefox/3.6 (.NET CLR 3.5.30729)';

        $url = 'http://ipinfodb.com/ip_locator.php?ip=' . urlencode($ip);
        $ch = curl_init();

        $curl_opt = array(
            CURLOPT_FOLLOWLOCATION  => 1,
            CURLOPT_HEADER      => 0,
            CURLOPT_RETURNTRANSFER  => 1,
            CURLOPT_USERAGENT   => $curlopt_useragent,
            CURLOPT_URL       => $url,
            CURLOPT_TIMEOUT         => 1,
            CURLOPT_REFERER         => 'http://' . $_SERVER['HTTP_HOST'],
        );

        curl_setopt_array($ch, $curl_opt);

        $content = curl_exec($ch);

        if (!is_null($curl_info)) {
            $curl_info = curl_getinfo($ch);
        }

        curl_close($ch);

        if ( preg_match('{<li>City : ([^<]*)</li>}i', $content, $regs) )  {
            $city = $regs[1];
        }
        if ( preg_match('{<li>State/Province : ([^<]*)</li>}i', $content, $regs) )  {
            $state = $regs[1];
        }

        if( $city!='' && $state!='' ){
          $location = $city . ', ' . $state;
          return $location;
        }else{
          return $default;
        }
}

function upload_document_file($folder,$variable)
{
    $CI =& get_instance();
    if(!is_dir(FCPATH . './uploads'))
    {
        mkdir(FCPATH . './uploads', 0777, true);
        chmod(FCPATH . './uploads', 0777);
    }
    else
    {
        chmod(FCPATH . './uploads', 0777);
    }
    if(!is_dir(FCPATH . './uploads/'.$folder.''))
    {
        mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
        chmod(FCPATH . './uploads/'.$folder.'', 0777);
    }
    else
    {
        chmod(FCPATH . './uploads/'.$folder.'', 0777);
    }

    if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
    {
        mkdir(FCPATH . './uploads/'.$folder.'/thumb', 0777, true);
        chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
    }
    else
    {
        chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
    }

    $count = count($_FILES[$variable]["name"]);

    $doc = array();
    for ($i=0; $i < $count; $i++) { 
        if(isset($_FILES[$variable]["type"][$i]))
        {

            $validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "pdf", "PDF");
            $temporary = explode(".", $_FILES[$variable]["name"][$i]);
        
            $file_extension = end($temporary);
            
            if ($_FILES[$variable]["error"][$i] == 0 && in_array($file_extension, $validextensions))
            {
		        $fileName = str_replace(' ', '_', $_FILES[$variable]["name"][$i]);
                $imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y"))."_".@$fileName;
                // $imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y")).$i;
                $sourcePath = $_FILES[$variable]['tmp_name'][$i];
                $targetPath = "uploads/".$folder."/".$imgName;

                move_uploaded_file($sourcePath,$targetPath);
                $doc[] = $imgName;
            }

            if($file_extension != "pdf" || $file_extension != "PDF"){
            	$NewImageName = $imgName;
		        $config_upload = array();
		        $config_upload['image_library'] = 'gd2';
		        $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
		        $config_upload['maintain_ratio'] = TRUE;
		        $config_upload['quality'] = '100%';
		        $config_upload['new_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
		        $config_upload['width'] = 358;
		        $config_upload['height'] = 358;

		        // CROP CONFIGURATION
		        $CI->load->library('image_lib');
		        $CI->image_lib->clear();
		        $CI->image_lib->initialize($config_upload);
		        if(!$CI->image_lib->resize())
		        {
		            $CI->message = strip_tags($CI->image_lib->display_errors());
		            $CI->isError = TRUE;
		        }
            }
        }
    }
    return $doc;
}

	/*
     * Developer id: 00338
     * this function is to upload profile image.
     * function name: upload_user_image
     * @return [JSON]
     */
    function upload_user_image($folder,$variable)
    {
    	$CI =& get_instance();
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.'/thumb'))
        {
            mkdir(FCPATH . './uploads/'.$folder.'/thumb', true);
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'/thumb', 0777);
        }

        if(isset($_FILES[$variable]["type"]))
        {
            $validextensions = array("jpeg","jpg","png","JPEG","JPG","PNG");
        	$tempname = str_replace(' ', '_', $_FILES[$variable]["name"]);
            $temporary = explode(".", $_FILES[$variable]["name"]);
            $file_extension = end($temporary);
            
            if ($_FILES[$variable]["error"] == 0 && in_array($file_extension, $validextensions))
            {
                $imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y"))."_".@$tempname;
                $sourcePath = $_FILES[$variable]['tmp_name'];
                $targetPath = "uploads/".$folder."/".$imgName;
                move_uploaded_file($sourcePath,$targetPath);
            }
        }
        
        $NewImageName = $imgName;
        $config_upload = array();
        $config_upload['image_library'] = 'gd2';
        $config_upload['source_image'] = './uploads/'.$folder.'/'.$NewImageName;
        $config_upload['maintain_ratio'] = TRUE;
        $config_upload['quality'] = '100%';
        $config_upload['new_image'] = './uploads/'.$folder.'/thumb/'.$NewImageName;
        $config_upload['width'] = 358;
        $config_upload['height'] = 358;

        // CROP CONFIGURATION
        $CI->load->library('image_lib');
        $CI->image_lib->clear();
        $CI->image_lib->initialize($config_upload);
        if(!$CI->image_lib->resize())
        {
            $CI->message = strip_tags($CI->image_lib->display_errors());
            $CI->isError = TRUE;
            echo $CI->message;
        }
        else
        {
            $practiceImg = $NewImageName;
        	return $practiceImg;
        }
    }

    /*
     * Developer id: 00338
     * this function is to upload user documents.
     * function name: upload_user_document
     * @return [JSON]
     */
    function upload_user_document($folder,$document_name)
    {
        if(!is_dir(FCPATH . './uploads'))
        {
            mkdir(FCPATH . './uploads', 0777, true);
            chmod(FCPATH . './uploads', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads', 0777);
        }
        if(!is_dir(FCPATH . './uploads/'.$folder.''))
        {
            mkdir(FCPATH . './uploads/'.$folder.'', 0777, true);
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }
        else
        {
            chmod(FCPATH . './uploads/'.$folder.'', 0777);
        }

        $count = count($_FILES[$document_name]["name"]);
        $doc = array();
        for ($i=0; $i < $count; $i++) { 
            if(isset($_FILES[$document_name]["type"][$i]))
            {
                $validextensions = array("jpeg", "jpg", "png", "JPEG", "JPG", "PNG", "pdf", "PDF");
                $temporary = explode(".", $_FILES[$document_name]["name"][$i]);
                $file_extension = end($temporary);
                
                if ($_FILES[$document_name]["error"][$i] == 0 && in_array($file_extension, $validextensions))
                {
                    $imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y"))."_".@$_FILES[$document_name]["name"][$i];
                    $sourcePath = $_FILES[$document_name]['tmp_name'][$i];
                    $targetPath = "uploads/document/".$imgName;
                    move_uploaded_file($sourcePath,$targetPath);
                    $doc[] = $imgName;
                }
            }
        }
        return $doc;
    }

    /*
	* Developer id: 00429
	* This function is to get the access token regarding the webservices function.
	* Function name: _get_access_token
    */

    function check_login_status($account_type=""){
		$CI = & get_instance();

		$data = $CI->session->userdata("templogin");
		$loginData = $CI->session->userdata();
		if(empty($data)){
			redirect('admin-temp');
		}elseif (empty($loginData['doctor']) && empty($loginData['patient']) && empty($loginData['nurse'])) {
			if(!empty($loginData['doctor']) && ($account_type == 'patient' || $account_type == 'nurse')){
				redirect('doctor/profile');
			}
			elseif(!empty($loginData['patient']) && ($account_type == 'doctor' || $account_type == 'nurse')){
				redirect('patient/profile');
			}
			elseif(!empty($loginData['nurse']) && ($account_type == 'patient' || $account_type == 'doctor')){
				redirect('nurse/profile');
			}
		}
	}

	function check_login_status_website(){
		$CI 		= & get_instance();
		$data 		= $CI->session->userdata("templogin");
		$loginData 	= $CI->session->userdata();

		if(empty($data)){
			redirect('admin-temp');
		}
		elseif (empty($loginData['doctor']) && empty($loginData['patient']) && empty($loginData['nurse'])) {
			if(!empty($loginData['doctor'])){
				redirect('doctor/profile');
			}
			elseif(!empty($loginData['patient'])){
				redirect('patient/profile');
			}
			elseif(!empty($loginData['nurse'])){
				redirect('nurse/profile');
			}
		}
	}

	function check_temp_login_status(){
		$CI 		= & get_instance();
		$data 		= $CI->session->userdata("templogin");
		if(!empty($data)){
			redirect('/');
		}
	}

	function check_null_value($value){
		return is_null($value) ? '' : $value;
	}

	function setAppointmentDetails($key,$value){
		$CI 		= & get_instance();
    	$appointment_details = $CI->session->userdata('appointment_details');
    	$CI->session->unset_userdata('appointment_details');
    	$appointment_details[$key] = $value;
    	$CI->session->set_userdata('appointment_details',$appointment_details);
    }

    function stripKeyValues($arr){
    	return 	array_map(function($val){
    		return _stripTags_trim($val);
    	}, $arr);
    }

    function _stripTags_trim($string){
        return  is_array($string) ? $string : strip_tags(trim($string));
    }

    function uploadImage($image_arr, $folder_name, $thumbSize =''){
	    $original_name = $image_arr['name'];
	    $tmp_name = $image_arr['tmp_name'];
		if (!empty($original_name)) {
		//$tmp_path = @$_FILES['image']['tmp_name'];

		$targetPath =  'uploads/'.$folder_name.'/';

		$imgName = mktime(date("h"),date("i"),date("s"),date("m"),date("d"),date("y"))."_".@$original_name;
		$targetFile = str_replace('//','/',$targetPath).$imgName;
		$image_name = move_uploaded_file($tmp_name, $targetFile); 

		if(!file_exists($targetPath))

		mkdir(str_replace('//','/',$targetPath), 0777, true);

		move_uploaded_file($tmp_name, $targetFile);
			    
		$arr = explode('/',$targetPath);
		$arr = array_reverse($arr);

		$info = pathinfo($targetPath.$imgName);
		$getimg = getimagesize($targetPath.$imgName);

		$width 		= $getimg[0];
		$height 	= $getimg[1];
		$type 		= $getimg[2];
		$attr 		= $getimg[3];

		if( $info['extension'] == 'jpg' ||  $info['extension'] == 'jpeg' ||  $info['extension'] == 'JPG' ||  $info['extension'] == 'JPEG')
		$img = imagecreatefromjpeg( "{$targetFile}" );
		if( $info['extension'] == 'gif' || $info['extension'] == 'GIF' )
		$img = imagecreatefromgif( "{$targetFile}" );    
		if( $info['extension'] == 'png' ||  $info['extension'] == 'PNG' )
		$img = imagecreatefrompng( "{$targetFile}" );

		if($thumbSize)
		$thumbWidth = $thumbSize;
		else
		$thumbWidth = 60;

		if( $thumbWidth ) {	
			
		if($width < $thumbWidth)    
		$thumbWidth = $width;

		$width = imagesx( $img );
		$height = imagesy( $img );
		$new_height = floor( $height * ( $thumbWidth / $width ) );
		$new_width = $thumbWidth;

		$tmp_img = imagecreatetruecolor( 650, 600 );
		imagealphablending($tmp_img, false);
		imagesavealpha($tmp_img,true);
		$transparent = imagecolorallocatealpha($tmp_img, 255, 255, 255, 127);
		imagecopyresized( $tmp_img, $img, 0, 0, 0, 0, 650, 600, $width, $height);
		$targetFile1 =  str_replace('//','/',$targetPath). 'thumb_' . $imgName;

		if( $info['extension'] == 'jpg' ||  $info['extension'] == 'jpeg' ||  $info['extension'] == 'JPG' ||  $info['extension'] == 'JPEG' )
		imagejpeg( $tmp_img, "{$targetFile1}" );                    
		if( $info['extension'] == 'gif' || $info['extension'] == 'GIF' )
		imagegif( $tmp_img, "{$targetFile1}" );                    
		if( $info['extension'] == 'png' ||  $info['extension'] == 'PNG' )
		imagepng( $tmp_img, "{$targetFile1}" );
		}
		return $imgName;
		}
       return false;
    }
?>
