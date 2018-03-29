<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_requests extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('requests'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'user_id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
				),
				'from' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'to' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'dep_date' => array(
					'type' => 'DATE',
					'null' => TRUE,
				),
				'dep_time' => array(
					'type' => 'TIME',
					'null' => TRUE,
				),
				'no_of_pass' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
				),
				'ret_date' => array(
					'type' => 'DATE',
					'null' => TRUE,
				),
				'ret_time' => array(
					'type' => 'TIME',
					'null' => TRUE,
				),
				'lat' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'long' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'status' => array(
					'type' => 'ENUM("active", "inactive", "deleted")',
					'constraint' => "",
					'default' => 'active',
					'null' => FALSE,
				)
			));
			$this->dbforge->add_field("`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
			$this->dbforge->add_key('id', TRUE);  
			$this->dbforge->create_table('requests');
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('requests');
	}
}
?>