<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   * 		http://example.com/index.php/home
   *	- or -
   * 		http://example.com/index.php/home/index
   *	- or -
   * Since this controller is set as the default controller in
   * config/routes.php, it's displayed at http://example.com/
   *
   * So any other public methods not prefixed with an underscore will
   * map to /index.php/home/<method_name>
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function __construct() {
    parent::__construct();

    $this->load->model('Home_model');
  }

  public function index()
  {

    $data = array(
      'title' => 'NorthWind Database',
      'db_settings' => $this->table->generate(
        $this->Home_model->get_db_settings()),
    );
    $this->template->load('base','home_page',$data);
  }

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
