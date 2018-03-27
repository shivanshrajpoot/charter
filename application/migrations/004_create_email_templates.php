<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_email_templates extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('email_templates'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'template_key' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'subject' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'body' => array(
					'type' => 'LONGTEXT',
					'null' => TRUE,
				),
				'display_status' => array(
					'type' => 'ENUM("active", "inactive")',
					'constraint' => "",
					'default' => 'active',
					'null' => FALSE,
				)
			));
			$this->dbforge->add_field("`created_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$this->dbforge->add_field("`updated_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
			$this->dbforge->add_key('id', TRUE);  
			$this->dbforge->create_table('email_templates');
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('email_templates');
	}
}
?>