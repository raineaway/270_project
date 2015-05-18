<?php

class Calendar_model extends CI_Model {
   private $table = 'calendar';

   public function __construct() {
      parent::__construct($this->table);
   }

   public function create($data) {
      if (!isset($data['name']) || empty($data['name'])) {
           return array("status" => "fail", "error" => "calendar name is required");
      }
      if (!isset($data['color']) || empty($data['color'])) {
           return array("status" => "fail", "error" => "calendar color is required");
      }

      $sql = "INSERT INTO `calendar` (user_id, name, color, date_created) "
           . "VALUES (" . $this->db->escape($data['user_id']) . ", "
           . $this->db->escape($data['name']) . ", "
           . $this->db->escape($data['color']) . ", "
           . $this->db->escape($data['date_created']) . ")";

      $this->db->query($sql);
      $rows = $this->db->affected_rows();

      if ($rows > 0) {
           return array("status" => "success");
      }
      return array("status" => "fail", "error" => $this->db->_error_message());
   }

}
?>
