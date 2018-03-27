<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Migrate extends CI_Controller {
  public function __construct() {
        parent::__construct(0);
        $this->load->library('migration');
    }

    public function index(){

      $this->migration->version(10);

      if ( ! $this->migration->latest()) {
          show_error($this->migration->error_string());
      }
      else{
        echo "Migrated";
      }
    }
}


?>