<?php
class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
   }

    public function form(){
      $this->load->model('event_model');
      $data['main_content'] = 'event_form';
      $this->load->view('includes/template', $data);
   }

   public function new_event(){
      
   }
}
?>
