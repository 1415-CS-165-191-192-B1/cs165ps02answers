<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function get_db_settings() {
    $db_settings = array(array('Parameter', 'Value'),
             array('hostname', $this->db->hostname),
             array('port', $this->db->port),
             array('username', $this->db->username),
             array('database', $this->db->database),
             array('driver', $this->db->dbdriver),
    );
    return $db_settings;
  }

}
