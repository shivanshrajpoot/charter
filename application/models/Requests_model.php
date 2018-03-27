<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Requests_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'requests';
    }

    public function getAll($column_name=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        return $this->db->get($this->table)->result_array();
    }

    public function add($request_data){
        $this->db->insert($this->table,$request_data);
        return $this->db->insert_id();
    }

    public function delete($id){
        return $this->db->delete($this->table,['id' => $id]);
    }

    public function update($request_data){
        $this->db->update($this->table,$request_data,['id'=>$request_data['id']]);
        return $this->db->affected_rows();
    }

    public function getAllRequests($column_name=NULL,$where=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        return $this->db->get($this->table)->result_array();
    }

}