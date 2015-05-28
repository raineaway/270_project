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
        $this->check_session();
        if (!$year) { $year = date('Y'); }
        if (!$month) { $month = date('m'); }
        $cal_id = $this->input->get('cal_id') ? $this->input->get('cal_id') : NULL;

        $this->load->model('calendar_model');
        $details = $this->calendar_model->generate_calendar($year, $month, $cal_id);

        $base_url = $this->config->site_url();
        $prefs = array(
            'show_next_prev' => TRUE,
            'next_prev_url'  => site_url(array('calendar/show_calendar/')),
            'template' =>
            '{table_open}<table border="0" cellpadding="0" cellspacing="0" class="calendar">{/table_open}

            {heading_row_start}<tr>{/heading_row_start}

            {heading_previous_cell}<th class="prev_class"><a href="{previous_url}">&lt;&lt;</a></th>{/heading_previous_cell}
            {heading_title_cell}<th class="title" colspan="{colspan}">{heading}</th>{/heading_title_cell}
            {heading_next_cell}<th class="next_class"><a href="{next_url}">&gt;&gt;</a></th>{/heading_next_cell}

            {heading_row_end}</tr>{/heading_row_end}

            {week_row_start}<tr>{/week_row_start}
            {week_day_cell}<td class="weekdays">{week_day}</td>{/week_day_cell}
            {week_row_end}</tr>{/week_row_end}

            {cal_row_start}<tr class="days">{/cal_row_start}
            {cal_cell_start}<td>{/cal_cell_start}

            {cal_cell_start_today}<td>{/cal_cell_start_today}
            {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

            {cal_cell_content}
            <div class="day_num">
                <span>
                <a href="' . $base_url . '/event/'. $year.'/'.$month.'/{day}">{day}</a></span>
            </div>
            <div class="content">{content}
            </div>
            {/cal_cell_content}
            {cal_cell_content_today}
            <a href="' . $base_url . '/event/'. $year.'/'.$month.'/{day}">{day}</a></span>
            <div class="content">{content}</div>
            {/cal_cell_content_today}

            {cal_cell_no_content}<div class="day_num"><span>{day}</span></div>{/cal_cell_no_content}
            {cal_cell_no_content_today}<div class="highlight">{day}</div>{/cal_cell_no_content_today}

            {cal_cell_blank}&nbsp;{/cal_cell_blank}

            {cal_cell_other}{day}{cal_cel_other}

            {cal_cell_end}</td>{/cal_cell_end}
            {cal_cell_end_today}</td>{/cal_cell_end_today}
            {cal_cell_end_other}</td>{/cal_cell_end_other}
            {cal_row_end}</tr>{/cal_row_end}

            {table_close}</table>{/table_close}'
        );
        $this->load->library('calendar', $prefs);
        $data['calendar'] = $this->calendar->generate($year, $month, $details);
        //die();

        //$data['calendar'] = $this->calendar_model->generate_calendar($year, $month);
        $data['username'] = $this->session->userdata('username');
        $data['calendars'] = $this->get_list();

        $data['main_content'] = 'logged_in_area';

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

    public function list_all() {
        $this->check_session();

        if ($this->session->flashdata('success')) {
            $data['success'] = $this->session->flashdata('success');
        }
        $data['calendars'] = $this->get_list();
        $data['main_content'] = 'calendar_list';
        $this->load->view('includes/template', $data);
    }

    public function get_list() {
        $this->check_session();

        $this->load->model('calendar_model');
        $query = $this->calendar_model->get_all_calendars_by_user_id($this->session->userdata('user_id'));
        $calendars = array();

        foreach ($query->result_array() as $row) {
             $calendars[] = $row;
         }

         return $calendars;
    }

    public function form(){
        $this->check_session();

        $data['main_content'] = 'calendar_form';
        $this->load->view('includes/template', $data);
    }

    public function new_calendar() {
        $this->check_session();

        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('name', 'Calendar Name', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');

            if($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id'        => $this->session->userdata('user_id'),
                    'name'           => $this->input->post("name", TRUE),
                    'color'          => $this->input->post("color", TRUE),
                    'date_created'   => date("Y-m-01 00:00:00")
                );

                $this->load->model('calendar_model');
                $result = $this->calendar_model->create($data);

                if ($result['status'] == 'success') {
                    $this->session->set_flashdata('success', 'Successfully created calendar');
                    header("Location: " . site_url(array('calendar/list_all')));
                } else {
                    $errors['warning'] = $result['error'];
                }
            }
        }
        $data = array(
            'heading'       => 'Create Calendar',
            'form_action'   => 'calendar/new_calendar',
            'submit_button' => 'Create',
            'errors'        => $errors,
            'main_content'  => 'calendar_form.php'
        );
        $this->load->view("includes/template", $data);
        return;
    }

    public function update($cal_id) {
        $this->check_session();

        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->form_validation->set_rules('name', 'Calendar Name', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');

            if($this->form_validation->run() == TRUE) {
                $data = array(
                    'cal_id'       => $cal_id,
                    'name'         => $this->input->post("name", TRUE),
                    'color'        => $this->input->post("color", TRUE),
                );

                $this->load->model('calendar_model');
                $result = $this->calendar_model->update($data);

                if ($result['status'] == 'success') {
                    $this->session->set_flashdata("success", "Successfully modified calendar " . $data['name']);
                    header("Location: " . site_url(array('calendar/list_all')));
                } else {
                    $errors['warning'] = $result['error'];
                }
            }
        }

        $this->load->model('calendar_model');
        $calendar = $this->calendar_model->get_by_id($cal_id);
        $data = array(
            'heading'       => 'Update Calendar',
            'form_action'   => 'calendar/update/' . $cal_id,
            'submit_button' => 'Update',
            'calendar'      => $calendar,
            'errors'        => $errors,
            'main_content'  => 'calendar_form.php'
        );
        $this->load->view("includes/template", $data);
        return;
    }

    private function check_session() {
        if (!$this->session->userdata('username')) {
            header("Location: " . site_url(array('login')));
        }
    }

    public function delete($cal_id) {
        $this->load->model('calendar_model');
        $result = $this->calendar_model->delete_by_id($cal_id);
        if ($result === TRUE) {
            $this->session->set_flashdata('success', 'Successfully deleted calendar.');
        } else {
            $this->session->set_flashdata('fail', $result['error']);
        }
        redirect('calendar/list_all');
    }
}
?>
