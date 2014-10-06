<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function set_table_template() {
  $ci =& get_instance();
  $table_template = array(
    'table_open' => '<table class="ui celled table segment">',
  );
  $ci->table->set_template($table_template);
}
