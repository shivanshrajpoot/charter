<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_users extends CI_Migration {

	public function up()
	{
		if ( ! $this->db->table_exists('users'))
		{
			$this->load->dbforge();
			$this->dbforge->add_field(array(
				'id' => array(
					'type' => 'INT',
					'constraint' => 11,
					'unsigned' => FALSE,
					'auto_increment' => TRUE
				),
				'uuid' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'first_name' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'last_name' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'email' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'password' => array(
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => TRUE,
				),
				'contact' => array(
					'type' => 'VARCHAR',
					'constraint' => '20',
					'null' => TRUE,
				),
				'type' => array(
					'type' => 'ENUM("1", "2","3")',
					'default' => 	'3',
					'null' => FALSE,
				),
				'gender' => array(
					'type' => 'ENUM("m", "f","o")',
					'default' => 'm',
					'null' => FALSE,
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
			$this->dbforge->create_table('users');
			$query = "
			INSERT INTO `ch_users` 
			(`id`, `uuid`, `first_name`, `last_name`, `email`, `password`, `contact`, `type`, `gender`, `status`) 
			VALUES 
			(NULL, 'f65241bb-2d90-4ac7-8334-d1551e7862c1', 'Admin', '', 'admin', '$2y$10$8/3RU43xkEZH2E3dBfy9Du06xRWDHRjLSzE1w2sL1c3f05Uuk357e', '1234567890', '1', 'm', 'active')";
			$this->db->query($query);
		}
	}

	public function down()
	{
		$this->load->dbforge();
		$this->dbforge->drop_table('users');
	}
}
?>