<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed.');


class Calendar_model extends CI_Model {
    private $table = 'calendar';
    var $prefs;

    public function __construct() {
        parent::__construct($this->table);
        $this->prefs = array(
                'show_next_prev'  => TRUE,
                'next_prev_url'   => site_url(array('calendar/show_calendar'))
                );
        $this->prefs['template'] = (
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
                <a href="http://localhost/270_project/index.php/event/{day}">{day}</a></span>
                </div>

                    <div class="content">{content}
                    </div>
                    {/cal_cell_content}
                {cal_cell_content_today}
                <div class="highlight">{day}</div>
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

    }

    public function generate_calendar($year = null, $month = null) {
        if (!$year) { $year = date('Y'); }
        if (!$month) { $month = date('m'); }

        $this->load->library('calendar', $this->prefs);
        $events = array();

        //get events from DB for month, year for 1 calendar Id
        $date = new DateTime(); $date->setDate($year, $month, 1); $date->setTime(00, 00, 00);
        $this->load->model('event_model');

        //get an array of calendar_ids
        $calendar_ids = $this->get_all_calendar_ids_by_user_id($this->session->userdata('user_id'));
        $events_all = $this->event_model->get_events_by_calendars($calendar_ids, 'month', $date->getTimestamp());

        $details_all = array();

        foreach($events_all as $row){
           //get date
           list($year, $month, $day, $h, $min) = array_values(date_parse($row['date_start']));
           $hour = date("g:iA", strtotime($row['date_start']));

           $day = (int)$day;
           $details = null;

           //multiple events, single events
           if (!$row['is_all_day']) {
             $details = $hour . "  ". $row['name'];
           } else {
             $details = $row['name'];
           }
           if (isset($details_all[$day])){
                $details_all[$day] .= "<br/>" . $details;
           } else {
                //$details_all += array($day => "<span style=\"color: " . $row['color'] . "\">" . $details . "<span>" );
                $details_all += array($day => $details);
           }
        }

        //get events of all calendar ids

        //get event per id
        /*$result = $this->event_model->get_events_by_calendar(2, 'month', $date->getTimestamp() );
        foreach( $result as $row ) {
          list($year, $month, $day, $hour) = array_values(date_parse($row['date_start']));
          $details = null;
          $day = (int)$day;

          //need help to convert the $hour to G:i A format
          if (!$row['is_all_day']) {
             $details = $hour . "  ". $row['name'];
          } else {
             $details = $row['name'];
          }

          if (isset($events[$day])){
             $events[$day] .= "<br/>" . $details;
           } else {
             $events += array($day => $details );
          }
       }*/

        return $this->calendar->generate($year, $month, $details_all);
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

    public function update($data) {
        if (!isset($data['cal_id']) || empty($data['cal_id'])) {
            return array("status" =>"fail", "error" => "calendar ID is required");
        }
        $sql = "UPDATE `calendar` SET "
            . "name = " . $this->db->escape($data['name']) . ", "
            . "color = " . $this->db->escape($data['color'])
            . " WHERE cal_id = " . $this->db->escape($data['cal_id']);
        $this->db->query($sql);
        $rows = $this->db->affected_rows();
        if ($rows > 0) {
            return array("status" => "success");
        }
        return array("status" => "fail", "error" => $this->db->_error_message());
    }

    public function get_by_id($cal_id) {
        $sql = "SELECT * FROM calendar WHERE cal_id = " . $this->db->escape($cal_id);
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            return $row;
        }
        return NULL;
    }

    public function get_all_calendars_by_user_id($user_id){
      $sql = "SELECT * FROM `calendar` WHERE user_id = " . $this->db->escape($user_id) . "";
      return $this->db->query($sql);
    }

   //returns an array of calendar ids for a certain user
    public function get_all_calendar_ids_by_user_id($user_id){
      $sql = "SELECT cal_id FROM `calendar` WHERE user_id = " . $this->db->escape($user_id) . "";
      $result = $this->db->query($sql);
      $calendar_ids = array();

      foreach($result->result_array() as $row){
         $calendar_ids[] = $row['cal_id'];
      }

      return $calendar_ids;
   }

    public function delete_by_id($cal_id) {
        $this->db->trans_begin();
        $sql = "DELETE FROM `event` WHERE cal_id = " . $this->db->escape($cal_id);

        $this->db->query($sql);
        $sql = "DELETE FROM `calendar` WHERE cal_id = " . $this->db->escape($cal_id);

        $this->db->query($sql);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollbak();
            return array("status" => "fail", "error" => $this->db->_error_message());
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }
}
?>
