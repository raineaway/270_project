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

        $data = array(
           'user'          => $user,
           'main_content'  => 'account',
           'heading'       => 'Your User Account Settings',
        );

        $this->load->view('includes/template', $data);
    }

    public function update() {
        $this->check_session();

        $errors = array();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->load->library('form_validation');

            $is_unique_username = '';
            if ($this->input->post("username") != $this->session->userdata("username")) {
                $is_unique_username = '|is_unique[user.username]';
            }
            $is_unique_email = '';
            if ($this->input->post("email_address") != $this->session->userdata("email_address")) {
                $is_unique_email_address = '|is_unique[user.email_address]';
            }

            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]' . $is_unique_username);
            $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email' . $is_unique_email);
            $this->form_validation->set_rules('firstname', 'First Name', 'required|min_length[2]');
            $this->form_validation->set_rules('lastname', 'Last Name', 'required|min_length[2]');
            $this->form_validation->set_rules('password', 'Password', 'required|matches[confirm_password]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required');

            if ($this->form_validation->run() == TRUE) {
                $data = array(
                    'user_id'          => $this->input->post("user_id", TRUE),
                    'username'         => $this->input->post("username", TRUE),
                    'email_address'    => $this->input->post("email_address", TRUE),
                    'lastname'         => $this->input->post("lastname", TRUE),
                    'firstname'        => $this->input->post("firstname", TRUE),
                    'password'         => $this->input->post("password", TRUE),
                    'confirm_password' => $this->input->post("confirm_password", TRUE)
                );

                $this->load->model('User_model', 'user_model');
                $result = $this->user_model->update($data);

                if ($result['status'] == 'success') {
                    $user = $this->user_model->get_by_username($data['username']);
                    $this->session->set_userdata($user);
                    $this->session->flashdata('success', 'Successfully updated account.');
                    redirect('user/account');
                } else {
                    $errors['warning'] = $result['error'];
                }
            }
        }

        $this->load->model('User_model', 'user_model');
        $user = $this->user_model->get_by_username($this->session->userdata('username'));
        $data['user'] = $user;
        $data['heading'] = 'Edit Account';
        $data['form_action'] = 'user/update';
        $data['submit_button'] = 'Update';
        $data['main_content'] = "account_form.php";
        $data['errors'] = $errors;
        $this->load->view('includes/template', $data);
    }

    private function check_session() {
        if (!$this->session->userdata('username')) {
            header("Location: " . site_url(array('login')));
        }
    }

}

?>
