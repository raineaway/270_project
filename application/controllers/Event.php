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
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
         $this->form_validation->set_rules('name', 'Event Name', 'required');
         $this->form_validation->set_rules('start_date', 'Start Date', 'required');
         $this->form_validation->set_rules('end_date', 'End Date', 'required');


         if($this->form_validation->run() == TRUE) {
            $data = array(
              'name'             => $this->session->userdata('name'),
              'is_all_day'       => $this->input->post("is_all_day", TRUE),
             // 'date_start'       => date($this->input->post("date_start", TRUE), $this->input->post("time_start", TRUE)); ,
              //'date_end'         => $this->input->post("date_end", TRUE),
              'recurrence_type'  => $this->input->post("recurrence_type", TRUE),
             // 'cal_id'           => $this->input->post("cal_id", TRUE),
              'date_created'             => date("Y-m-d H:i:s")
            );

            $this->load->model('event_model');
            $result = $this->event_model->create($data);

            if ($result['status'] == 'success') {
                header("Location: " . site_url(array('calendar')));
            } else {
                $errors['warning'] = $result['error'];
            }

         }*/
      }

   }
}
?>
