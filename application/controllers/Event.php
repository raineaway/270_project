<?php
class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    public function index(){
        redirect('calendar/show_calendar');
    }

    public function event_day($year, $month, $day){
        $this->check_session();
        $user_id = $this->session->userdata('user_id');
        $date_start = date('Y-m-d 00:00:00', mktime(0, 0, 0, $month, $day, $year));
        $date_end = date('Y-m-d 23:59:59', mktime(0, 0, 0, $month, $day, $year));

        //get calendar ids for user
        $this->load->model('calendar_model');
        $calendar_ids = $this->calendar_model->get_all_calendar_ids_by_user_id($user_id);

        //get event for a certain day for all calendars of user
        $this->load->model('event_model');
        //$events = $this->event_model->get_events_by_date($calendar_ids, $date_start, $date_end);
        $events = $this->event_model->get_events_by_calendars($calendar_ids, "day", strtotime($date_start));

        $list = $this->prepare_list($events, "$year-$month-$day");

        $data = array(
            'username'     => $this->session->userdata('username'),
            'date'         => $date_start,
            'list'         => $list,
            'type'         => 'day',
            'heading'      => 'Your event/s for ' . date( 'M d Y - l', strtotime($date_start)),
            'main_content' => 'event'
        );
        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }
        if ($this->session->userdata('fail')) {
            $data['fail'] = $this->session->userdata('fail');
            $this->session->unset_userdata('fail');
        }
        $this->load->view('includes/template', $data);
    }


    public function event_detail($event_id){
        $this->check_session();

        //get event detail for a certain event_id
        $this->load->model('event_model');
        $event = $this->event_model->get_by_id($event_id);

        $data['row'] = $event;
        $data['main_content'] = 'event_detail';
        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }
        if ($this->session->userdata('fail')) {
            $data['fail'] = $this->session->userdata('fail');
            $this->session->unset_userdata('fail');
        }
        $this->load->view('includes/template', $data);

    }
    public function form(){
        $this->check_session();
        $data['calendars'] = $this->get_calendars();
        $data['main_content'] = 'event_form';
        $this->load->view('includes/template', $data);
    }

    public function new_event(){
        $this->check_session();

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
                        $this->session->set_userdata("success", "You have successfully created an event!");
                        header("Location: " . site_url(array('calendar')));
                    } else {
                        $errors['warning'] = $result['error'];
                    }
                }
            }
        }
        var_dump($errors);
        $data = array(
            'errors'        => $errors,
            'main_content'  => 'event_form.php',
            'calendars'     => $this->get_calendars(),
            'heading'       => 'Create new event',
            'form_action'   => 'event/new_event',
            'submit_button' => 'Create Event'
        );

        $this->load->view("includes/template", $data);
        return;
    }

    public function update($event_id, $previous="") {
        $this->check_session();
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
                        'event_id'        => $event_id,
                        'name'            => $this->input->post("name", TRUE),
                        'is_all_day'      => $is_all_day,
                        'date_start'      => $dates['start'],
                        'date_end'        => $dates['end'],
                        'cal_id'          => $this->input->post("cal_id", TRUE),
                        'recurrence_type' => $this->input->post("recurrence_type", TRUE),
                        'date_created'    => date("Y-m-d H:i:s")
                    );

                    $this->load->model('event_model');
                    $result = $this->event_model->update($data);

                    if ($result['status'] == 'success') {
                        $this->session->set_userdata("success", "You have successfully modified your event.");
                        header("Location: " . site_url(array('event/detail/' . $event_id . "/$previous")));
                    } else {
                        $errors['warning'] = $result['error'];
                    }
                }
            }
        }
        $this->load->model('event_model');
        $event = $this->event_model->get_by_id($event_id);
        $data = array(
            'errors'        => $errors,
            'main_content'  => 'event_form.php',
            'calendars'     => $this->get_calendars(),
            'heading'       => 'Update event',
            'form_action'   => 'event/update/'.$event_id. "/$previous",
            'submit_button' => 'Update Event',
            'event'         => $event
        );

        $this->load->view("includes/template", $data);
        return;
    }

    public function list_all() {
        $this->check_session();
        $errors = array();
        $calendars = $this->get_calendars(TRUE);
        $this->load->model("event_model");

        if ($this->input->get("date_start", TRUE)) {
            $date_start = strtotime($this->input->get("date_start", TRUE));
        } else {
            $date_start = time();
        }

        $view = $this->input->get("view", TRUE) ? $this->input->get("view", TRUE) : "month";
        $events = $this->event_model->get_events_by_calendars($calendars, $view, $date_start);

        $list = $this->prepare_list($events);

        $data = array(
            'errors'       => $errors,
            'main_content' => 'event',
            'calendars'    => $calendars,
            'heading'      => 'All events',
            'list'         => $list,
            'type'         => 'all'
        );
        if ($this->session->userdata('success')) {
            $data['success'] = $this->session->userdata('success');
            $this->session->unset_userdata('success');
        }
        if ($this->session->userdata('fail')) {
            $data['fail'] = $this->session->userdata('fail');
            $this->session->unset_userdata('fail');
        }

        $this->load->view("includes/template", $data);
        return;

    }

    public function delete_event($event_id, $previous="") {
        $this->check_session();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $previous = str_replace("-", "/", $previous);
            $this->load->model('event_model');
            $result = $this->event_model->delete_by_id($event_id);
            if ($result) {
                $this->session->set_userdata("success", "Successfully deleted event.");
                if (!empty($previous)) {
                    header("Location: " . site_url(array('event/' . $previous)));
                } else {
                    header("Location: " . site_url(array('calendar')));
                }
            } else {
                $this->session->set_userdata("fail", "Unable to delete event.");
                header("Location: " . site_url(array('event/detail/' . $event_id . "/" . $previous)));
            }
        }

        $this->load->model('event_model');
        $event = $this->event_model->get_by_id($event_id);
        $data = array(
            'event'        => $event,
            'previous'     => $previous,
            'main_content' => 'event_delete',
        );
        $this->load->view('includes/template', $data);
    }


    private function prepare_list($events, $previous) {
        $list = array();
        foreach($events as $row) {
            if ($row['is_all_day'] == 0){
                $list[] = anchor(site_url(array('event/detail/' . $row['event_id'] . "/$previous")),
                    $row['name']) . " - " . date( 'g:i A', strtotime($row['date_start']))
                    . " to " . date( 'g:i A', strtotime($row['date_end']));
            }else {
                $list[] = anchor(site_url(array('event/detail/' . $row['event_id'] . "/$previous")),
                    $row['name']) . " - Whole day event";
            }

        }
        return $list;

    }

    private function get_calendars($id_only=FALSE) {
        $this->load->model("calendar_model");
        $query = $this->calendar_model->get_all_calendars_by_user_id($this->session->userdata("user_id"));
        $calendars = array();
        foreach ($query->result_array() as $row) {
            $calendars[$row['cal_id']] = $id_only ? $row['cal_id'] : $row['name'];
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

    private function check_session() {
        if (!$this->session->userdata('username')) {
            header("Location: " . site_url(array('login')));
        }
    }

}
?>
