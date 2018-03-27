<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_aircrafts extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('aircrafts'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'id_user' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
				),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'image' => array(
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
			$this->dbforge->create_table('aircrafts');
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('aircrafts');
	}
}
?>