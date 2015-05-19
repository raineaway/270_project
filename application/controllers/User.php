<?php

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        redirect('user/account');
    }

    public function account() {
        $this->check_session();

        $this->load->model("user_model");
        $user = $this->user_model->get_by_username($this->session->userdata("username"));

        $data['user'] = $user;
        $data['main_content'] = "";
        $this->load->view('includes/template', $data);
    }

    private function check_session() {
        if (!$this->session->userdata('username')) {
            header("Location: " . site_url(array('login')));
        }
    }

}

?>
