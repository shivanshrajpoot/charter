<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    /**
    * Admin Model using is related to general functions to fetch
    * the information from database.
    *
    *
    * @category 	model
    * @package 	application_models
    * @version 	0.0.1
    * @author 	Singsys Pte. Ltd. <info@singsys.com>
    * dated  	2015-08-07
    */

    private $table = 'users';
    private $column_order = array(null, 'first_name','last_name','email','mobile','id_status','id_user_type'); //set column field database for datatable orderable
    private $column_search = array('first_name','last_name','email','mobile','id_status','id_user_type'); //set column field database for datatable searchable 
    private $order = array('id_user' => 'asc'); // default order
   
    //class constructor
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    /*
    *this function is used for configuration email
    */
    public function _getConfigurationByKey($key = NULL) 
    {
        if($key !="") {
            $this->db->select('value');
            $query = $this->db->get_where('config',array('key'=>$key));
            $data_array = $query->row_array();
            return $data_array['value'];
        } else {
            $query = $this->db->get('config');
            $data_array = $query->result_array();
            return $data_array;
        }
    }

    /**
    *this function is used to get email content
    */
    public function _getMessage($opt) 
    {
        $this->db->select('*');
        $this->db->from('email_templates');
        $this->db->where('template_key', $opt);
        $result = $this->db->get()->row();
        return $result;
    }

    public function _getEmailById($id='')
    {
        $this->db->select('email');
        $this->db->from('users');
        if($id)
        {
            $this->db->where('id_user', $id);
        }

        $result = $this->db->get()->row_array();
        return $result;
    }

    public function _get_static_contect()
    {
        $this->db->select('*');
        $this->db->from('static_content');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function _get_static_content($id_content)
    {
        $this->db->select('*');
        $this->db->from('static_content');
        $this->db->where('id_static_content', $id_content);
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function _update_static_content($content_details, $content_id)
    {
        $this->db->where('id_static_content', $content_id);
        $this->db->update('static_content', $content_details);
    }

    public function _get_admin_data($email, $password)
    {

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->where('password', md5($password));
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function getSub_AdminCount()
    {
        $result = $this->db->query(" SELECT count(*) as total from qh_users WHERE `id_user_type`=5")->row_array();
       
        return $result;
    }


    /**
    *This function is used to save/update the system configurations
    *@param $configArray
    *@return int
    */
    public function save_configData($configArray) 
    {
        if(count($configArray) >0) 
        {
            foreach($configArray as $key=>$value) 
            {
                if($this->_checkConfigurationKeyExists($key) == TRUE) 
                {
                    $query = $this->db->update('config', array('value'=>$value) ,array('key'=>$key));
                } 
                else 
                {
                    $data= array('key'=>$key,'value'=>$value);
                    $this->db->insert('config', $data);
                    $config_id = $this->db->insert_id();
                }
            }
            return $config_id;
        }
    }

    /**
    *This function is used to check the configuration key exists
    */
    public function _checkConfigurationKeyExists($key) 
    {
        $query = $this->db->get_where('config',array('key'=>$key));
        $data_array = $query->num_rows();
        return $data_array > 0 ? TRUE : FALSE;
    }

    public function _get_faq_data()
    {
        $this->db->select('*');
        $this->db->from('faq');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function _save_faq_data($insertArr, $faq_id = "")
    {
        if (empty($faq_id)) {
            $this->db->insert('faq', $insertArr);
            $id = $this->db->insert_id();
            return $id;
        } else {
            $this->db->where('faq_id', $faq_id);
            $this->db->update('faq', $insertArr);
        }
    }

    public function _get_faq_byId($faq_id)
    {
        $this->db->select('*');
        $this->db->from('faq');
        $this->db->where('faq_id', $faq_id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    /**
    *this function is used to delete faq
    */
    public function deleteFAQ($faq)
    {
        $this->db->where('faq_id', $faq);
        $this->db->delete('faq');
    }

    /*
    *this function gets old password
    */
    public function getPasswordByAdminid($pass, $id) 
    {
        //echo $pass;die;
        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('password', md5($pass));
        $this->db->where('id_user', $id);
        $password = $this->db->get()->row_array();
        return $password;
    }


    public function updatePassword($newpassword, $user_id)
    {
        $this->db->where('id_user', $user_id);
        $this->db->update('users', array('password' =>$newpassword));
    }

/*this function is used to reset  password url valid or not*/
    public function checkUrl($reset_code)
    {
        return $this->db->where('reset_code', $reset_code)
                        ->get('users');
        //echo $this->db->last_query();die;
    }

/*this function is used to reset admin password */
    public function updateNewPassword($newpassword, $reset_code,$code)
    {
        $this->db->where('reset_code', $reset_code);
        $array = ['password' => $newpassword,
            'reset_code'=>$code
        ];
        $this->db->update('users', $array);
        //echo $this->db->last_query();die;
    }
     

    /**
    *this function is used to Check users type
    */
    public function CheckUserType($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id_user',$id);
        $query  = $this->db->get()->row_array();
        return $query;
    }

    /**
    *this function is used to delete users
    */
    public function deleteUser($id)
    {
        $this->db->where('id_user', $id);
        $this->db->delete('users');
    }

    /*this funcction is used to check email exists or not*/
    public function checkEmail_data($email)
    {
        $id=1;
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email',$email);
        $this->db->where('id_user_type',$id);
        $query  = $this->db->get()->row_array();
       // echo $this->db->last_query();
        return $query;
    }

    /*this function is used for update reset code column for reset password*/
    public function updateUserByEmail($id,$updatArr)
    {
        $this->db->where('id_user', $id);
        $query=$this->db->update('users',$updatArr);
        return $query;
    }

    /*this function is used for get user details by id*/
    public function _get_users_byId($user_id)
    {
        $this->db->select('*');
        $this->db->from('users '); 
        $this->db->join('user_address ', 'user_address.id_user=users.id_user', 'left');
        $this->db->where('users.id_user',$user_id);         
        $result = $this->db->get()->row_array();
        return $result;
    }

    public function getAllLanguages()
    {
        return $this->db->select('*')
                        ->from('language')
                        ->get()
                        ->result_array();
    }
   

    public function getUserDocument($user_id){
        $this->db->select('*');
        $this->db->from('user_document');
        $this->db->where('id_user', $user_id);
        $doc = $this->db->get()->result_array();
        return $doc;
    }

/*this function is used for update user data*/
    public function _update_user_data($insertArr, $user_id )
    {   
            $arr = array(
                'first_name' => $insertArr['first_name'], 
                'last_name' => $insertArr['last_name'], 
                'mobile_ext' => $insertArr['mobile_ext'], 
                'mobile' => $insertArr['mobile'], 
                'dob' => $insertArr['dob'], 
                'id_services' => $insertArr['id_services'], 
                'updated_on' => $insertArr['updated_on']
            );
            $this->db->where('id_user', $user_id);
            return $this->db->update('users', $arr);
            
    }

    public function updateuserdata($insertArr, $user_id)
    {   
        $this->db->where('id_user', $user_id);
        return $this->db->update('users', $insertArr);
    }

/*this function is used update user address*/
    public function _update_user_address_data($insertArr, $user_id )
    {
        $this->db->where('id_user', $user_id);
        return $this->db->update('user_address', $insertArr);
    }

    public function getUserLanguageId($id_user='')
    {
        return $this->db->select('user_id')
                        ->from('user_preferred_language')
                        ->where('user_id', $id_user)
                        ->get()
                        ->row_array();
    }

    /*this function is used for update user status*/
    public function UpdateUserStatus($status,$id,$password)
    {
        $this->db->where('id_user', $id);
        $query=$this->db->update('users', array('id_status' =>$status,'password' =>$password));
        return $query;
    }
/*this function is used for update user status*/
    public function UpdateUserPatientStatus($status,$id)
    {
        $this->db->where('id_user', $id);
        $query=$this->db->update('users', array('id_status' =>$status));
        return $query;
    }
/*this function is used to get data using of server site datatables*/ 

private function _get_datatables_query($id_user_type)
{
        $this->db->from($this->table); 
        
    $i = 0;
 
    foreach ($this->column_search as $item) // loop column 
    {
        if($_POST['search']['value']) // if datatable send POST for search
        {
             
            if($i===0) // first loop
            {
                $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                $this->db->like($item, $_POST['search']['value']);
            }
            else
            {
                $this->db->or_like($item, $_POST['search']['value']);
            }

            if(count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
        }
        $i++;
    }
     
    if(isset($_POST['order'])) // here order processing
    {
        $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order)]);
    }
}

function get_datatables($id_user_type)
{
    $this->_get_datatables_query($id_user_type);
    if($_POST['length'] != -1)
    $this->db->where('id_user_type',$id_user_type);
    $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
}

function count_filtered($id_user_type)
{
    $this->_get_datatables_query($id_user_type);
     $this->db->where('id_user_type',$id_user_type);
    $query = $this->db->get();
    return $query->num_rows();
}

public function count_all($id_user_type)
{
    $this->db->from('users');
    $this->db->where('id_user_type',$id_user_type);
    return $this->db->count_all_results();
}
 
/*this function is used to user */
public function insertDataUser($data)
{
        $this->db->insert('users', $data);
        //echo $this->db->last_query();die;
        $id = $this->db->insert_id();
        return $id;
}

public function insertUserAddress($dataAddress)
{
     return $this->db->insert('user_address', $dataAddress);
}

public function get_status_values()
{
    $this->db->where('user_type !=','Admin');
    $query= $this->db->get('user_type');
    return $query->result_array();
    echo $this->db->last_query();
}

/*get banner details by this function*/
public function _get_banner_contect()
{
    $this->db->select('*');
    $this->db->from('banner');
    $result = $this->db->get()->result_array();
    return $result;
}

/*this function is used to get banner details by id*/
public function _get_banner_content_byID($id_banner)
{
    $this->db->select('*');
    $this->db->from('banner');
    $this->db->where('id_banner', $id_banner);
    $result = $this->db->get()->row_array();
    return $result;
}

/*this content is used to update banner table data*/
public function _update_banner_content($banner_details, $banner_id)
    {
        $this->db->where('id_banner', $banner_id);
        $this->db->update('banner', $banner_details);
    }

/*this content is used to get service detail */
    public function _get_service_content()
    {
        $this->db->select('*');
        $this->db->from('our_services');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /*this function is  used to add service details*/
    public function _add_service_content($dataAddress)
    {
        $result = $this->db->insert('our_services', $dataAddress);
        // print_r($result);
        // echo $this->db->last_query(); die;
    }


    /*this function is used to get service  data by id*/
    public function _get_service_content_byID($id_service)
    {
        $this->db->select('*');
        $this->db->from('our_services');
        $this->db->where('id', $id_service);
        $result = $this->db->get()->row_array();
        return $result;
    }


     /*this function is used to update service table data*/
    public function _update_service_content($service_details, $service_id)
        {
            $this->db->where('id', $service_id);
            return $this->db->update('our_services', $service_details);
        }

        /**
        *this function is used to delete faq
        */
    public function deleteService($service_id)
    {
        $this->db->where('id', $service_id);
        return $this->db->delete('our_services');
    }
    public function deletedata($id,$tableName)
    {
        $this->db->where('id', $id);
        return $this->db->delete($tableName);
    }

    /*get work details by this function*/
    public function _get_work_content()
    {
        $this->db->select('*');
        $this->db->from('quickhealth_work');
        $result = $this->db->get()->result_array();
        return $result;
    }

    // /*this function is used to get work details by id*/
    // public function _get_work_content_byID($id_work)

    // {
    //     $this->db->select('*');
    //     $this->db->from('quickhealth_work');
    //     $result = $this->db->get()->result_array();
    //     return $result;
    // }

    /*this function is used to get work details by id*/
    public function _get_work_content_byID($id_work)
    {
        $this->db->select('*');
        $this->db->from('quickhealth_work');
        $this->db->where('id', $id_work);
        $result = $this->db->get()->row_array();
        return $result;
    }

    /*this function is used to update work table data*/
    public function _update_work_content($work_details, $work_id)
        {
            $this->db->where('id', $work_id);
            $this->db->update('quickhealth_work', $work_details);
        }


      /*get partners details by this function*/
    public function _get_partner_content()
    {
        $this->db->select('*');
        $this->db->from('partners');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /*this function is used to get partner details by id*/
    public function _get_partner_content_byID($partner_id)
    {
        $this->db->select('*');
        $this->db->from('partners');
        $this->db->where('id', $partner_id);
        $result = $this->db->get()->row_array();
        return $result;
    }


    /*this function is used to update partner  data*/
    public function _update_partner_content($partner_details, $partner_id)
        {
            $this->db->where('id', $partner_id);
            $this->db->update('partners', $partner_details);
        }

     /*get quickhealth for patient banner details by this function*/
    public function _get_patient_content()
    {
        $this->db->select('*');
        $this->db->from('quickhealth_patient');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /*this function is used to get uickhealth for patient banner  by id*/
    public function _get_patient_content_byID($id)
    {
        $this->db->select('*');
        $this->db->from('quickhealth_patient');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    /*this function is used to update uickhealth for patient banner  data*/
    public function _update_patient_content($details, $id)
        {
            $this->db->where('id', $id);
            $this->db->update('quickhealth_patient', $details);
        }

    /*this function is used to get all contact us details*/
    public function _get_contact_content()
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /*this function is used to get all Country code */
    public function getCountryCode()
    {
        $this->db->select('*');
        $this->db->from('country_code');
        $result = $this->db->get()->result_array();
        return $result;
    }

    public function update_qualifications($insertArr='', $id_qualification='')
    {
        return $this->db->update('user_qualification', $insertArr, array('id_qualification' => $id_qualification));
    }

    public function getIdByQualificationId($id_qualification='')
    {
        return $this->db->select('id_user')
                        ->from('user_qualification')
                        ->where('id_qualification', $id_qualification)
                        ->get()
                        ->row_array();
    }
    
    public function get_qualification_by_id($id_qualification='')
    {
        return $this->db->select('*')
                        ->from('user_qualification')
                        ->where('id_qualification', $id_qualification)
                        ->get()
                        ->row_array();
    }

    public function delete_qualification($id_qualification='')
    {
        return $this->db->delete('user_qualification', array('id_qualification' => $id_qualification));
    }

    /*this function is used to get Contact Us  by id*/
    public function _get_contact_content_byID($id)
    {
        $this->db->select('*');
        $this->db->from('contact_us');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }

    /**
    *this function is used to delete Contact
    */
    public function deleteContact($id)
    {
        $this->db->where('id', $id);
       return $this->db->delete('contact_us');
    }

    public function get_our_service()
    {   
        $this->db->select('*');
        $data['service'] = $this->db->get('our_services')->result_array();
        return $data;
    }

    public function get_our_service_id($id)
    {  
        
        $this->db->select('*');
        $this->db->from('our_services');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();
        return $data;
       
    }
     
     
    public function insert_qualification($data_qualification, $user_id)
     { 

        $this->db->where('id_doctor', $user_id);
        $this->db->delete('doctor_qualification');

        $this->db->insert_batch("doctor_qualification",$data_qualification);

     } 
    public function get_qualification($user_id)
    {
        $this->db->select('*');
        $this->db->where('id_user',$user_id);
        return $this->db->get('user_qualification')->result_array();
    }

    public function getLanguageById($user_id='')
    {
        return $this->db->select('language.*')
                        ->from('language')
                        ->join('user_preferred_language', 'user_preferred_language.language_id = language.language_id', 'left')
                        ->join('users', 'users.id_user = user_preferred_language.user_id', 'left')
                        ->where('users.id_user', $user_id)
                        ->get()
                        ->row_array();
    }

    public function getAllQualifications($user_id='')
    {
        return $this->db->select('*')
                        ->from('user_qualification')
                        ->where('id_user', $user_id)
                        ->get()
                        ->result_array();
    }

    public function getServiceTitle($id='')
    {
        $id=explode(',',$id);
        return $this->db->select('service_title')
                 ->from('our_services')
                 ->where_in('id', $id)
                 ->get()
                 ->result_array();
    }

    public function get_doctor_qualification($user_id)
    {   
        $this->db->select('*');
        $this->db->where('id_doctor',$user_id);
        $record = $this->db->get('doctor_qualification')->row_array();
        
        return $data;

    }

    public function _update_language($insertArr='', $user_id='')
    {
        if($user_id)
        {
            return $this->db->update('user_preferred_language', $insertArr, array('user_id' => $user_id));
        }
        else
        {
            return $this->db->insert('user_preferred_language', $insertArr);
        }
    }

    public function _addQualification($insertArr)
    {
        return $this->db->insert('user_qualification', $insertArr);
    }
    
     /*this content is used to add drug detail */ 
     public function insertDrugDetail($data)
    {   
        $result = $this->db->insert('drug_list', $data);
        
    }
    /*this content is used to get drug detail */
    public function _get_drug()
    {
        $this->db->select('*');
        $this->db->from('drug_list');
        $result = $this->db->get()->result_array();
        return $result;
    }
    /**
    *this function is used to delete drug
    */
    public function deleteDrug($drug_list_id)
    {
        $this->db->where('drug_list_id', $drug_list_id);
        return $this->db->delete('drug_list');
    }
    /*this function is used to update drug table data*/
    public function _update_drug_content($data, $drug_list_id)
    {
        $this->db->where('drug_list_id', $drug_list_id);
        return $this->db->update('drug_list', $data);
    }
    /*this function is used to get drug  data by id*/
    public function _get_drug_content_byID($drug_list_id)
    {
        $this->db->select('*');
        $this->db->from('drug_list');
        $this->db->where('drug_list_id', $drug_list_id);
        $result = $this->db->get()->row_array();
       
        return $result;
    }
    /*this function is used to get child  data by id*/
    public function _get_child_content_byID($parent_id)
    {
        $this->db->where('id_user', $parent_id);
        $result = $this->db->get('user_child')->result_array();
        return $result;
    }

    public function _get_child_byChildID($id_child)
    {
        return $this->db->select('*')
                        ->from('user_child')
                        ->where('id_child', $id_child)
                        ->get()
                        ->row_array();
    }

    /**
    *this function is used to delete drug
    */
    public function deleteChild($id_child)
    {
        $this->db->where('id_child', $id_child);
        return $this->db->delete('user_child');
    }

    /*this function is used to update child table data*/
    public function _update_child_content($data, $id_child)
    {
        $this->db->where('id_child', $id_child);
        return $this->db->update('user_child', $data);
    }

    public function getParentId($id_user)
    {
        return $this->db->select('id_user')
                        ->from('user_child')
                        ->where('id_child', $id_user)
                        ->get()
                        ->row_array();
    }

     /*this function is used to get drug category list table data*/
    public function get_drug_category()
    {   
        $this->db->select('*');
        $this->db->from('drug_category');
        $result = $this->db->get()->result_array();
        return $result;
    }

    /*this function is used to update child table data*/
    public function _get_drug_category_id($id)
    {  
        $this->db->select('*');
        $this->db->from('drug_category');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();
        return $result;
    }
    /**
    *this function is used to  show drug category
    */    
    public function get_drug($id)
    {   
        $this->db->select('*');
        $data['category'] = $this->db->get('drug_category')->result_array();
        return $data;
    } 

    /**
    *this function is used to delete drug category
    */
    public function Delete_drug_category($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('drug_category');
    }

     /**
    *this function is used to add drug category
    */
    public function add_drug_category($data)
    {
        $result = $this->db->insert('drug_category', $data);
    }

    /*this function is used to update drug category table data*/
    public function _update_drug_category($data, $id)
    {
       
        $this->db->where('id', $id);
        return $this->db->update('drug_category', $data);
    
    }


    /*this function is used to Management list   */
    public function _get_list_record($section)
    {   
        $this->db->select('*');
        $this->db->from('dropdown_items');
        $this->db->where('section', $section);
        $result = $this->db->get()->result_array();
        return $result;
    }
     // *this function is used to list drow down
    
    public function add_list_record($data)
    {
        $result = $this->db->insert('dropdown_items', $data);
    }
     /**
    *this function is used to delete family history
    */
    public function Delete_dropdown($id)
    {
    $this->db->where('id', $id);
    return $this->db->delete('dropdown_items');
    }

   
    /*this function is used to update Dropdown management data*/
    public function _update_dropdown($data,$id)
    { 

        $this->db->where('id', $id);
        return $this->db->update('dropdown_items', $data);
        

    }
     public function _dropdown($id)
    {   
        $this->db->select('*');
        $this->db->from('dropdown_items');
        $this->db->where('id', $id);
        $result = $this->db->get()->row_array();
        return $result;
        
    }
     /*this function is used to get appointment  data by id*/
   
      
    public function _appointment_data($status)
    {
        $this->db->select('appointment_detail.*, doctor_available_slot.*,doctor_slots.name,  CONCAT(doctor.first_name," ", ,doctor.last_name) AS doctor_name,CONCAT(patient.first_name," ", ,patient.last_name) AS patient_name,CONCAT(nurse.first_name," ", ,nurse.last_name) AS nurse_name');
        $this->db->from('appointment_detail');
        
        $this->db->where('appointment_detail.payment_status', 'confirmed');

        $this->db->join('users AS doctor','doctor.id_user = appointment_detail.id_doctor','left');
        $this->db->join('users AS patient','patient.id_user = appointment_detail.id_patient','left');
        $this->db->join('users AS nurse','nurse.id_user = appointment_detail.id_nurse','left');
        $this->db->join('doctor_available_slot', 'appointment_detail.id_availability_slot = doctor_available_slot.id_available_slot', 'left');
        $this->db->join('doctor_slots','doctor_available_slot.slot_id = doctor_slots.id_slot','left');
        $this->db->group_by('appointment_detail.id_appointment');
        $result=$this->db->get()->result_array();
        
        return $result;
    }
    /*this function is used to get appointment  data by id*/
    public function get_appointment_data($id_appointment)
    {
        $this->db->select('appointment_detail.*, CONCAT(doctor.first_name," ", ,doctor.last_name) AS doctor_name,CONCAT(patient.first_name," ", ,patient.last_name) AS patient_name,CONCAT(nurse.first_name," ", ,nurse.last_name) AS nurse_name');
        $this->db->from('appointment_detail');
        $this->db->where('appointment_detail.id_appointment', $id_appointment);
        $this->db->join('users AS doctor','doctor.id_user = appointment_detail.id_doctor','left');
        $this->db->join('users AS patient','patient.id_user = appointment_detail.id_patient','left');
        $this->db->join('users AS nurse','nurse.id_user = appointment_detail.id_nurse','left');
        $result=$this->db->get()->row_array();
        return $result;
    }

    /*this function is used to get Nurse data */
    public function _getNurse()
    {
        $this->db->select('users.*,CONCAT(first_name," ", ,last_name) AS nurse_name');
        $this->db->from('users');
        $this->db->where('user_type.user_type', 'Nurse');
        $this->db->join('user_type','users.id_user_type = user_type.id_user_type','left');
        $result = $this->db->get()->result_array();
        return $result;
    }

     /*this function is used to Assing Nurse   */
    public function assing_Nurse($data ,$id_appointment)
    {
        $id_appointment=(base64_decode($this->uri->segment(3)));
        $this->db->where('id_appointment', $id_appointment);
        return $this->db->update('appointment_detail', $data);
    }

    /*this function is used to show appointment slots  */
    public function get_appointment_slot()
    {   
        $user_id=(base64_decode($this->uri->segment(2)));
        $this->db->select('doctor_available_slot.*,name');
        $this->db->from('doctor_available_slot');
        $this->db->where('user_id', $user_id);
        $this->db->join('doctor_slots','doctor_available_slot.slot_id = doctor_slots.id_slot','left');
        $result = $this->db->get()->result_array();
        return $result;

    }
    public function _get_record_physical_stats($id_appointment)
    {  
        $this->db->where('id_appointment', $id_appointment);
        $result = $this->db->get('physical_stats')->row_array();

        return $result;
    }

    public function _get_record_medication($id_appointment)
    {  
        return $this->db->select('*')
                 ->from('medication')
                 ->where('id_appointment', $id_appointment)
                 ->get()
                 ->row_array();        
    }

    public function getCurrentMedication($id_medication)
    {
        return $this->db->select('*')
                 ->from('current_medication')
                 ->where('id_medication', $id_medication)
                 ->get()
                 ->result_array();
    }

    public function getSurgeryProcedure($id_medication)
    {
        return $this->db->select('*')
                 ->from('surgery_medical_procedure')
                 ->where('id_medication', $id_medication)
                 ->get()
                 ->result_array();
    }

    public function get_record_family_history($id_appointment)
    {   
        $this->db->where('id_appointment', $id_appointment);
        $result = $this->db->get('patient_family_history')->result_array();
        return $result;
    }
     public function add_Sub_Admin($data)
    {
        $result = $this->db->insert('users', $data);
    }
    
    public function getTransactionData()
    {
        return $this->db->select('paypal_transactions.*, users.*, paypal_transactions.added_on AS transaction_date')
                        ->from('paypal_transactions')
                        ->join('appointment_detail', 'appointment_detail.id_appointment = paypal_transactions.id_appointment','left')
                        ->join('users', 'users.id_user = appointment_detail.id_patient', 'left')
                        ->get()
                        ->result_array();
    }

    public function getTransactionDetailsById($id='')
    {
        return $this->db->select('*')
                        ->from('paypal_transactions')
                        ->join('appointment_detail', 'appointment_detail.id_appointment = paypal_transactions.id_appointment','left')
                        ->join('users', 'users.id_user = appointment_detail.id_patient', 'left')
                        ->where('id', $id)
                        ->get()
                        ->row_array();
    }

    public function getServices()
    {
        return $this->db->select('*')
                        ->from('our_services')
                        ->get()
                        ->result_array();
    }

    public function getOrderDetails()
    {
        return $this->db->select('orders.*, users.first_name, users.last_name')
                        ->from('orders')
                        ->join('users', 'users.id_user = orders.id_patient' )
                        ->get()
                        ->result_array();
    }

    public function getOrderDetailsById($id_orders)
    {
        return $this->db->select('users.first_name, users.last_name, order_detail.*, prescription.*, prescribed_drugs.*')
                        ->from('orders')
                        ->join('users', 'users.id_user = orders.id_patient' )
                        ->join('order_detail', 'order_detail.id_orders = orders.id_orders' )
                        ->join('prescription', 'prescription.id_appointment = orders.id_appointment')
                        ->join('prescribed_drugs', 'prescribed_drugs.id_prescription = prescription.id_prescription')
                        ->where('orders.id_orders', $id_orders)
                        ->get()
                        ->result_array();
    }

    public function getCallHistoryList()
    {
        return $this->db->select('qhc.*,
                                (SELECT CONCAT(first_name," ",last_name) from qh_users as qhu WHERE qhu.id_user = qhc.id_patient ) as patient_name,
                                (SELECT CONCAT(first_name," ",last_name) from qh_users as qhud WHERE qhud.id_user = qhc.id_doctor ) as doctor_name')
                        ->from('call as qhc')
                        ->get()
                        ->result_array();

    }

    public function getMedicalCondition($id_medication='')
    {
        return $this->db->select('*')
                 ->from('medical_condition')
                 ->where('id_medication', $id_medication)
                 ->get()
                 ->result_array();
    }

    public function getSlotByAppointmentId($id_appointment='')
    {
        return $this->db->select('doctor_slots.start_time, doctor_available_slot.slot_id')
                        ->from('appointment_detail')
                        ->join('doctor_available_slot', 'doctor_available_slot.id_available_slot = appointment_detail.id_availability_slot')
                        ->join('doctor_slots', 'doctor_slots.id_slot = doctor_available_slot.slot_id')
                        ->where('appointment_detail.id_appointment', $id_appointment)
                        ->get()
                        ->row_array();
    }

    public function get_any_table($table_name,$where=NULL){
        return $this->db->get_where($table_name,$where)->result_array();
    }

    public function update_any_table($table_name,$data,$where=NULL){
        return $this->db->update($table_name,$data,$where);
    }

    public function get_all_counts(){
        $this->db->list_tables();
        $_empty = [];
        foreach ($this->db->list_tables() as $key => $value) {
            $value = explode('ch_',$value)[1];
            if ($value != 'migrations') {
                $_empty[$value] = count($this->db->select('id')->from($value)->get()->result_array());
            }elseif ($value == 'contact_us') {
                $_empty[$value] = count($this->db->select('id')->from($value)->where(['status'=>'reply'])->get()->result_array());
            }
        }
        return $_empty;
    }
    
}
    
?>
