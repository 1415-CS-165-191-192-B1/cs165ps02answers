<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Products extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Products_model');
    $this->load->model('Partners_model');
  }

  public function index()
  {
    redirect('products/supplied');
  }

  # Item 2
  public function quota_sales() {
    $year = $this->input->get('year');
    $quota = $this->input->get('quota');
    $data = array('title' => 'Products');
    if ($year && $quota) {
      $data['caption'] =
        'Products Exceeding the '.$quota.' Quota for the year '.$year.'.';
      $data['result'] = $this->table->generate(
        $this->Products_model->get_quota_sales($year,$quota));
    }
    $this->template->load('base','products/quota_sales',$data);
  }

  # Item 14 and 15
  public function category_summary() {
    $data = array(
      'title' => 'Products',
      'result' => $this->table->generate(
        $this->Products_model->get_category_summary()),
    );
    $this->template->load('base','products/category_summary',$data);
  }

  # Item 16
  public function supplied() {
    $supplierid = $this->input->get('supplierid');

    $supplier_options = $this->Partners_model->get_supplier_options();
    $data = array(
      'title' => 'Products',
      'supplier_options' => $supplier_options,
    );

    if ($supplierid) {
      $data['caption'] =
        'Products Still Supplied by '
          .$supplier_options[$supplierid].'.';
      $data['result'] = $this->table->generate(
        $this->Products_model->get_products_still_supplied($supplierid));
      $data['selected'] = $supplierid;
    }

    $this->template->load('base','products/supplied_products',$data);
  }

  # Item 17 and 18
  public function below_reorder() {
    $data = array(
      'title' => 'Products',
      'result' => $this->table->generate(
        $this->Products_model->get_products_below_reorder_level()),
    );
    $this->template->load('base','products/below_reorder',$data);
  }

  # Item 19
  public function discontinued() {
    $data = array(
      'title' => 'Products',
      'result' => $this->table->generate(
        $this->Products_model->get_discontinued_products()),
    );
    $this->template->load('base','products/discontinued',$data);
  }

}

/* End of file products.php */
/* Location: ./application/controllers/products.php */
