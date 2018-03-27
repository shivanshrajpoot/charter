<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Aircrafts_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'aircrafts';
    }

    public function getAll($column_name=NULL,$where=NULL,$join=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        $join != NULL ? $this->db->join($join['table_name'],$join['clause']) : '';
        return $this->db->get($this->table)->result_array();
    }

    public function add($aircraft_data){
        $this->db->insert($this->table,$aircraft_data);
        return $this->db->insert_id();
    }

    public function delete($id){
        $this->db->update($this->table,['status'=>'deleted'],['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function update($aircraft_data){
        $this->db->update($this->table,$aircraft_data,['id'=>$aircraft_data['id']]);
        return $this->db->affected_rows();
    }

}