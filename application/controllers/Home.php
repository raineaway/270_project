<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("session");
        $this->load->helper("url");
    }

    public function index() {
        $data = array(
            'title' => 'Scheduler'
        );
        if ($this->session->userdata('username')) {
            $this->load->view('home', $data);
        } else {
            header("Location: " . site_url(array('login')));
        }
    }

    public function login() {
        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $this->input->post("username", TRUE);
            $password = $this->input->post("password", TRUE);

            if (empty($username)) {
                $errors['username'] = "Username is required.";
            }
            if (empty($password)) {
                $errors['password'] = "Password is required.";
            }

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

        $data = array(
            'errors'       => $errors,
            'main_content' => 'login_form.php'
        );
        $this->load->view("includes/template", $data);
        return;
    }

    public function signup() {
        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = array(
                'username'         => $this->input->post("username", TRUE),
                'email_address'    => $this->input->post("email_address", TRUE),
                'lastname'         => $this->input->post("lastname", TRUE),
                'firstname'        => $this->input->post("firstname", TRUE),
                'password'         => $this->input->post("password", TRUE),
                'confirm_password' => $this->input->post("confirm_password", TRUE)
            );

            if ($data['password'] != $data['confirm_password']) {
                $errors['password'] = "Passwords do not match.";
            } else {
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

        $data = array(
            'errors'       => $errors,
            'main_content' => 'signup.php'
        );
        $this->load->view("includes/template", $data);
        return;
    }
}

?>
