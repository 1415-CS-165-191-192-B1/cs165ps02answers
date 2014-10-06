<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Partners extends CI_Controller {

  public function __construct() {
    parent::__construct();

    $this->load->model('Partners_model');
  }

  public function index()
  {
    redirect('partners/summary');
  }

  # Item 12
  public function customer_rank() {
    $year = $this->input->get('year');

    $data = array('title' => 'Partners');
    if ($year) {
      $data['caption'] =
        'Ranking of Customers by orders for the year '.$year.'.';
      $data['result'] = $this->table->generate(
        $this->Partners_model->get_customer_ranking($year));
    }

    $this->template->load('base','partners/customer_rank',$data);
  }

  # Item 20
  public function summary() {
    $country = $this->input->get('country');

    $data = array(
      'title' => 'Partners',
      'country_options' => $this->Partners_model->get_country_options());

    if ($country) {
      $data['caption'] =
        'List of Customers and Suppliers based on '.$country.'.';
      $data['result'] = $this->table->generate(
        $this->Partners_model->get_all_partners($country));
      $data['selected'] = $country;
    }
    $this->template->load('base','partners/summary',$data);
  }

}

/* End of file partners.php */
/* Location: ./application/controllers/partners.php */
