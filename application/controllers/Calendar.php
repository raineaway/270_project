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

        $this->load->model('calendar_model');
        $data['calendar'] = $this->calendar_model->generate_calendar($year, $month);
        $data['username'] = $this->session->userdata('username');
        $data['calendar_list'] = array();

        $query = $this->calendar_model->get_all_calendars_by_user_id($this->session->userdata('user_id'));

        foreach($query->result() as $row){
            $data['calendar_list'] += array($row->cal_id => $row->name);
        }

        $data['main_content'] = 'logged_in_area';
        $this->load->view('includes/template', $data);
    }

    public function form(){
        $this->check_session();

        $data['main_content'] = 'calendar_form';
        $this->load->view('includes/template', $data);
    }

    public function new_calendar(){
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
                    header("Location: " . site_url(array('calendar')));
                } else {
                    $errors['warning'] = $result['error'];
                }

            } else {
                $data = array(
                        'errors'       => $errors,
                        'main_content' => 'calendar_form.php'
                        );
                $this->load->view("includes/template", $data);
                return;
            }
        }
    }

    private function check_session() {
        if (!$this->session->userdata('username')) {
            header("Location: " . site_url(array('login')));
        }
    }
}
?>
