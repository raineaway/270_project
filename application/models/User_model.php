<?php

class User_model extends CI_Model {
    private $table = "user";

    public function __construct() {
        parent::__construct($this->table);
    }
    
    public function create($data) {
        if (!isset($data['username']) || empty($data['username'])) {
            return array("status" => "fail", "error" => "username is required");
        }
        if (!isset($data['email_address']) || empty($data['email_address'])) {
            return array("status" => "fail", "error" => "email_address is required");
        }
        if (!isset($data['password']) || empty($data['password'])) {
            return array("status" => "fail", "error" => "password is required");
        }

        $user = $this->get_by_username($data['username']);
        if ($user !== NULL) {
            return array("status" => "fail", "error" => "username exists");
        }
        $user = $this->get_by_email($data['email_address']);
        if ($user !== NULL) {
            return array("status" => "fail", "error" => "email address exists");
        }

        $password = md5($data['username'] . ":Scheduler:" . $data['password']);

        $sql = "INSERT INTO `user` (lastname, firstname, username, email_address, password) "
            . "VALUES (" . $this->db->escape($data['lastname']) . ", "
            . $this->db->escape($data['firstname']) . ", "
            . $this->db->escape($data['username']) . ", "
            . $this->db->escape($data['email_address']) . ", "
            . $this->db->escape($password) . ")";

        $this->db->query($sql);
        $rows = $this->db->affected_rows();

        if ($rows > 0) {
            return array("status" => "success");
        }
        return array("status" => "fail", "error" => $this->db->_error_message());
    }

    public function update($data) {
        // update all fields
    }

    public function login($username, $password) {
        $pass = $username . ":Scheduler:" . $password;
        $sql = "SELECT * FROM `user` WHERE username = " . $this->db->escape($username) . " "
            . "AND password = " . $this->db->escape($password) . "";

        $query = $this->db->query($sql);
        $user = NULL;
        foreach ($query->result() as $row) {
            $user = $row;
        }
        return $user;
    }

    public function get_by_id($user_id) {
        // get user by user_id
    }

    public function get_by_username($username) {
        $sql = "SELECT * FROM `user` WHERE username = " . $this->db->escape($username);

        $query = $this->db->query($sql);

        $user = NULL;
        foreach ($query->result() as $row) {
            $user = $row->to_array();
        }

        return $user;
    }

    public function get_by_email($email) {
        // get user by email_address
    }

}

?>
