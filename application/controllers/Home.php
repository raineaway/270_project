<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data = array(
            'title' => 'Scheduler'
        );
        if ($this->session->userdata('username')) {
            $data['main_content'] = 'logged_in_area';
            $data['username']     = $this->session->userdata('username');
            $this->load->view('includes/template', $data);
        } else {
            header("Location: " . site_url(array('login')));
        }
    }

    public function login() {
        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $username = $this->input->post("username", TRUE);
                $password = $this->input->post("password", TRUE);
                if (count($errors) == 0) {
                    $this->load->model('User_model', 'user_model');
                    $result = $this->user_model->login($username, $password);
                    if ($result === NULL) {
                        $errors['warning'] = 'Invalid username/password.';
                    } else {
                        $this->session->set_userdata($result);
                        header("Location: " . site_url(array('home')));
                    }
                }
            }
        }

        $data = array(
            'errors'       => $errors,
            'main_content' => 'login_form.php'
        );
        $this->load->view("includes/template", $data);
        return;
    }

    public function signup() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[user.username]');
            $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|is_unique[user.email_address]');
            $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

            if ($this->form_validation->run() == TRUE) {

                $data = array(
                    'username'         => $this->input->post("username", TRUE),
                    'email_address'    => $this->input->post("email_address", TRUE),
                    'lastname'         => $this->input->post("lastname", TRUE),
                    'firstname'        => $this->input->post("firstname", TRUE),
                    'password'         => $this->input->post("password", TRUE),
                    'confirm_password' => $this->input->post("confirm_password", TRUE)
                );

                $this->load->model('User_model', 'user_model');
                $result = $this->user_model->create($data);

                if ($result['status'] == 'success') {
                    $user = $this->user_model->get_by_username($data['username']);
                    $this->session->set_userdata($user);
                    header("Location: " . site_url(array('home')));
                } else {
                    $errors['warning'] = $result['error'];
                }
            }
        }

        $data['main_content'] = 'signup.php';
        $this->load->view("includes/template", $data);
        return;
    }
}

?>
