<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'contact_us';
    }
    
    public function add($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function delete($id){
        return $this->db->delete($this->table,['id' => $id]);
    }

    public function update($data){
        $this->db->update($this->table,$data,['id'=>$data['id']]);
        return $this->db->affected_rows();
    }

    public function getAll($column_name=NULL,$where=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        return $this->db->get($this->table)->result_array();
    }

}