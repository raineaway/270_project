<?php
class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    public function show_calendar($year=null, $month=null){
      $data['main_content'] = 'logged_in_area';
      $data['username']     = $this->session->userdata('username');
      
      $prefs = array(
         'show_next_prev'  => TRUE,
         'next_prev_url'   => site_url(array('calendar/show_calendar')),
      );

      $this->load->library('calendar', $prefs);
      //add year&month params
      $data['year'] = $year;
      $data['month'] = $month;

      $this->load->view('includes/template', $data);
   }

}
?>
