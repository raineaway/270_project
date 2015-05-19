<?php
class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
    }

    public function form(){
        $data['calendars'] = $this->get_calendars();
        $data['main_content'] = 'event_form';
        $this->load->view('includes/template', $data);
    }

    public function new_event(){
        $errors = array();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->form_validation->set_rules('name', 'Event Name', 'required');
            $this->form_validation->set_rules('date_start', 'Start Date', 'required');
            $this->form_validation->set_rules('date_end', 'End Date', 'required');

            if($this->form_validation->run() == TRUE) {
                $dates = $this->check_date($this->input->post('date_start'), $this->input->post('date_end'),
                    $this->input->post('time_start'), $this->input->post('time_end'));

                if ($dates === FALSE) {
                    $errors['date_start'] = "Start date must be less than End date.";
                } else {
                    $is_all_day = $this->input->post("is_all_day", TRUE) ? 1 : 0;
                    $data = array(
                        'name'            => $this->input->post("name", TRUE),
                        'is_all_day'      => $is_all_day,
                        'date_start'      => $dates['start'],
                        'date_end'        => $dates['end'],
                        'cal_id'          => $this->input->post("cal_id", TRUE),
                        'recurrence_type' => $this->input->post("recurrence_type", TRUE),
                        'date_created'    => date("Y-m-d H:i:s")
                    );

                    $this->load->model('event_model');
                    $result = $this->event_model->create($data);

                    if ($result['status'] == 'success') {
                        $this->session->set_flashdata("succcess", "You have successfully created an event!");
                        header("Location: " . site_url(array('calendar')));
                    } else {
                        $errors['warning'] = $result['error'];
                    }
                }
            }
        }
        $data = array(
            'errors'       => $errors,
            'main_content' => 'event_form.php',
            'calendars'    => $this->get_calendars()
        );

        $this->load->view("includes/template", $data);
        return;
    }

    private function get_calendars() {
        $this->load->model("calendar_model");
        $query = $this->calendar_model->get_all_calendars_by_user_id($this->session->userdata("user_id"));
        $calendars = array();
        foreach ($query->result_array() as $row) {
            $calendars[$row['cal_id']] = $row['name'];
        }
        return $calendars;
    }

    private function check_date($start_date, $end_date, $start_time=NULL, $end_time=NULL) {
        $start = $start_date . " " . ($start_time ? ($start_time . ":00") : "00:00:00");
        $end = $end_date . " " . ($end_time ? ($end_time . ":00") : "00:00:00");

        if (strtotime($end) < strtotime($start)) {
            return FALSE;
        }
        return array("start" => $start, "end" => $end);
    }
}
?>
