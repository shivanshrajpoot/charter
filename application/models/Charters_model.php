<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charters_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'charters';
    }

    public function getAllCharters($column_name=NULL,$where=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        return $this->db->get($this->table)->result_array();
    }

    public function addCharter($charter_data){
        $this->db->insert($this->table,$charter_data);
        return $this->db->insert_id();
    }

    public function deleteCharter($id){
        return $this->db->delete($this->table,['id' => $id]);
    }

    public function updateCharter($charter_data){
        $this->db->update($this->table,$charter_data,['id'=>$charter_data['id']]);
        return $this->db->affected_rows();
    }

    public function get_all_counts($id_user){
        $this->db->list_tables();
        $_empty = [];
        foreach ($this->db->list_tables() as $key => $value) {
            $value = explode('ch_',$value)[1];
            if (in_array($value, ['quotes','aircrafts'])) {
                $_empty[$value] = count($this->db->select('id')->from($value)->where(['user_id'=>$id_user,'status'=>'active'])->get()->result_array());
                $_empty['submitted_quotes'] = count($this->db->select('id')
                                                                     ->from('quotes AS q')
                                                                     ->where('q.user_id',$id_user)
                                                                     ->get()->row_array());
            }elseif ($value=='requests') {
                $_empty[$value] = count($this->db->select('id')->from($value)->get()->result_array());
            }
        }
        return $_empty;
    }
}