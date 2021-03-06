<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_contact_us extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('contact_us'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'message' => array(
					'type' => 'TEXT',
					'constraint' => '',
					'null' => TRUE,
				),
				'status' => array(
					'type' => 'ENUM("replied", "reply")',
					'constraint' => "",
					'default' => 'reply',
					'null' => FALSE,
				)
			));
			$this->dbforge->add_field("`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
			$this->dbforge->add_key('id', TRUE);  
			$this->dbforge->create_table('contact_us');
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('contact_us');
	}
}
?>