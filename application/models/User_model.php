<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'users';
    }

    public function getUser($email){
        $data = $this->db->get_where($this->table,['email'=>$email])->result_array();
        return $data ? $data[0] : FALSE;
    }

    public function addUser($userdata){
        $this->db->insert($this->table,$userdata);
        return $this->db->insert_id();
    }

    public function getAllUsers($where=NULL){
        return $this->db->get_where($this->table,$where)->result_array();
    }

    public function deleteUser($id){
        return $this->db->update($this->table,['status'=>'deleted'],['id'=>$id]);
    }

    public function updateUser($id,$userdata){
        $where = ['id'=>$id];
        $this->db->update($this->table,$userdata,['id'=>$id]);
        return $this->getAllUsers($where);
    }
}