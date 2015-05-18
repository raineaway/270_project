<?php
class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

   public function index($year=null, $month=null){
      $this->show_calendar($year, $month);
   }

    public function show_calendar($year=null, $month=null){
      $this->load->model('calendar_model');
      $data['calendar'] = $this->calendar_model->generate_calendar($year, $month);
      $data['username']     = $this->session->userdata('username');
      $data['main_content'] = 'logged_in_area';
      $this->load->view('includes/template', $data);
   }

   public function form(){
     $data['main_content'] = 'calendar_form';
     $this->load->view('includes/template', $data);
  }

  public function new_calendar(){

  }
}
?>
