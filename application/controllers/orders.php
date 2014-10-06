<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Orders_model');
  }

  public function index() {
    redirect('orders/shipment_summary');
  }

  # Item 4
  public function not_yet_shipped() {
    $cutoff = $this->input->get('cutoff');

    $data = array('title' => 'Orders',);
    if ($cutoff) {
      $data['caption'] = 'Orders not yet shipped by '.$cutoff;
      $data['result'] = $this->table->generate(
        $this->Orders_model->get_not_yet_shipped($cutoff));
    }

    $this->template->load('base','orders/orders_not_yet_shipped',$data);
  }

  # Item 5
  public function freight_cost() {
    $data = array(
      'title' => 'Orders',
      'result' => $this->table->generate(
        $this->Orders_model->get_freight_cost())
    );
    $this->template->load('base','orders/freight_cost',$data);
  }

  # Item 6
  public function shipment_summary() {
    $data = array(
      'title' => 'Orders',
      'result' => $this->table->generate(
        $this->Orders_model->get_shipment_summary())
    );
    $this->template->load('base','orders/shipment_summary',$data);
  }

  # Item 11
  public function late_shipments() {
    $lastName = $this->input->get('lastName');
    $firstName = $this->input->get('firstName');

    $data = array('title' => 'Orders',);
    if ($lastName && $firstName) {
      $data['caption'] = 'Late Shipments of '.$lastName.', '.$firstName;
      $data['result'] = $this->table->generate(
        $this->Orders_model->get_late_shipments($lastName, $firstName));
    }

    $this->template->load('base','orders/late_shipments',$data);
  }

  # Item 13
  public function latest_orders() {
    $data = array(
      'title' => 'Orders',
      'result' => $this->table->generate(
        $this->Orders_model->get_latest_orders())
    );
    $this->template->load('base','orders/latest_orders',$data);
  }
}

/* End of file home.php */
/* Location: ./application/controllers/orders.php */
