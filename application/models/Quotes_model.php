<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotes_model extends CI_Model {
    private $table;
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->table = 'quotes';
    }

    public function getAll($column_name=NULL,$where=NULL){
        $column_name != NULL ? $this->db->select($column_name) : '';
        $where != NULL ? $this->db->where($where) : '';
        return $this->db->get($this->table)->result_array();
    }

    public function add($quote_data){
        $this->db->insert($this->table,$quote_data);
        return $this->db->insert_id();
    }

    public function delete($id){
        return $this->db->delete($this->table,['id' => $id]);
    }

    public function update($quote_data){
        $this->db->update($this->table,$request_data,['id'=>$quote_data['id']]);
        return $this->db->affected_rows();
    }

    public function getAllQuoteData($id=NULL,$where=NULL){
        $where != NULL ? $this->db->where($where) : ''; 
        $id != NULL ? $this->db->where(['quotes.id'=>$id]) : ''; 
        return $this->db->select('quotes.*, quotes.id AS quote_id,ac.*,us.first_name,us.last_name, rq.*')
                 ->where(['quotes.status'=>'active'])
                 ->join('aircrafts AS ac','ac.id=quotes.aircraft_id','left')
                 ->join('users AS us','us.id=quotes.user_id','left')
                 ->join('requests AS rq','rq.id=quotes.request_id','left')
                 ->get($this->table)
                 ->result_array();
    }

}