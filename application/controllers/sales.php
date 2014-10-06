<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sales extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Sales_model');
  }

  public function index() {
    redirect('sales/summary');
  }

  # item 1
  public function summary() {
    $start = $this->input->get('start');
    $end = $this->input->get('end');

    $data = array('title' => 'Sales');
    if ($end && $start) {
      $data['caption'] = 'Summary of product sales from '.$start.' to '.$end;
      $data['result'] = $this->table->generate(
        $this->Sales_model->get_product_sales($start, $end));
    }

    $this->template->load('base','sales/summary',$data);
  }

  # item 3
  public function monthly() {
    $data = array(
      'title' => 'Sales',
      'result' => $this->table->generate(
        $this->Sales_model->get_monthly_sales()),
    );
    $this->template->load('base','sales/monthly_sales',$data);
  }

  # item 10
  public function view_sales() {
    $data = array(
      'title' => 'Sales',
      'result' => $this->table->generate(
        $this->Sales_model->get_sales_by_employee()),
    );
    $this->template->load('base','sales/sales_by_employee', $data);
  }
}

/* End of file sales.php */
/* Location: ./application/controllers/sales.php */
