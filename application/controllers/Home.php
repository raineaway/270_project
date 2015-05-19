<?php

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
    }

    public function index() {
        $data = array(
            'title' => 'Scheduler'
        );
        if ($this->session->userdata('username')) {
            redirect('calendar/show_calendar');
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

                   //create default calendar for user
                   $data = array(
                      'user_id'        =>  $this->session->userdata('user_id'),
                      'name'           => 'Default',
                      'color'          => '#000099', //blue
                      'date_created'   => date("Y-m-d H:i:s")
                   );

                   $this->load->model('calendar_model');
                   $calresult = $this->calendar_model->create($data);

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

    public function account( $edit=null ){
      if( $edit == 'info' ){
         $data['main_content'] = 'account_edit_info.php';
         $edit = null;
      } else if ( $edit == 'password' ){
         $data['main_content'] = 'account_edit_password.php';
         $edit = null;
      } else {
         $data['main_content'] = 'account.php';
      }

      $this->load->view("includes/template", $data);
   }

   public function edit_account( $edit=null ) {
      if( $edit == 'info' ){
         $edit = null;
      } else if ( $edit == 'password' ){
         echo $edit;
         $edit = null;
      } else {

      }

      $data['main_content'] = 'account.php';
      $this->load->view("includes/template", $data);
   }

    public function logout(){
      $this->session->sess_destroy();
      header("Location: " . site_url(array('home')));
   }
}

?>
