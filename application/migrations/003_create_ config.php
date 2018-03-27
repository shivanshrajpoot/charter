<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_config extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('config'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'key' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'value' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'name' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				)
			));
			$this->dbforge->add_field("`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
			$this->dbforge->add_key('id', TRUE);  
			$this->dbforge->create_table('config');
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('config');
	}
}
?>