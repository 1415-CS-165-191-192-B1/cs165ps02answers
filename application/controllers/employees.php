<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Employees extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Employees_model');
  }

  public function index()
  {
    redirect('employees/all');
  }

  # item 7
  public function all() {
    $data = array(
      'title' => 'Employees',
      'result' => $this->table->generate(
        $this->Employees_model->get_all_employees())
    );
    $this->template->load('base','employees/all', $data);
  }

  # item 8
  public function biggest_sale() {
    $data = array(
      'title' => 'Employees',
      'result' => $this->table->generate(
        $this->Employees_model->get_biggest_sale())
    );
    $this->template->load('base','employees/biggest_sale', $data);
  }

  # item 9
  public function rank() {
    $year = $this->input->get('year');

    $data = array('title' => 'Employees');
    if ($year) {
      $data['caption'] =
        'Ranking of Employees by sales for the year '.$year.'.';
      $data['result'] = $this->table->generate(
        $this->Employees_model->get_rank_by_year($year));
    }

    $this->template->load('base','employees/rank', $data);
  }

}

/* End of file home.php */
/* Location: ./application/controllers/employees.php */
