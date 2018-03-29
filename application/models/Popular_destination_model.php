<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Popular_destination_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'popular_destinations';
    }

    public function getAll($column_name=NULL,$where=NULL,$join=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        $join != NULL ? $this->db->join($join['table_name'],$join['clause']) : '';
        return $this->db->get($this->table)->result_array();
    }

    public function add($data){
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }

    public function delete($id){
        $this->db->update($this->table,['status'=>'deleted'],['id'=>$id]);
        return $this->db->affected_rows();
    }

    public function update($data){
        $this->db->update($this->table,$data,['id'=>$data['id']]);
        return $this->db->affected_rows();
    }

}