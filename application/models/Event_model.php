<?php

class Event_model extends CI_Model {
    private $table = "event";

    public  function __construct() {
        parent::__construct($this->table);
    }

    public function get_events_by_calendar($cal_id, $view, $date_start) {
        // $date_start must be a unix timestamp
        if ($view == "month") {
            $date_start = date("Y-m-01 00:00:00", $date_start);
            $date_end = date("Y-m-t 23:59:59", strtotime($date_start));
        } else {
            $date_temp = strtotime("last Sunday", date($date_start));
            $date_start = date("Y-m-d 00:00:00", $date_temp);
            $date_end = strtotime("+6 days", strtotime($date_start));
            $date_end = date("Y-m-d 23:59:59", $date_end);
        }

        $sql = "SELECT * FROM event WHERE "
            . "cal_id = " . $this->db->escape($cal_id)
            . " AND date_start >= " . $this->db->escape($date_start)
            . " AND date_end <= " . $this->db->escape($date_end);

        $query = $this->db->query($sql);

        $events = array();
        foreach ($query->result_array() as $row) {
            $events[] = $row;
        }

        return $events;
    }

    public function get_events_by_calendars($calendars, $view, $date_start) {
        // $calendars must be an array of calendar IDs
        $calendars = implode(", ", $calendars);

        if ($view == "month") {
            $date_start = date("Y-m-01 00:00:00", $date_start);
            $date_end = date("Y-m-t 23:59:59", strtotime($date_start));
        } else {
            $date_temp = strtotime("last Sunday", date($date_start));
            $date_start = date("Y-m-d 00:00:00", $date_temp);
            $date_end = strtotime("+6 days", $date_start);
            $date_end = date("Y-m-d 23:59:59", $date_end);
        }

        $sql = "SELECT * FROM event WHERE "
            . "cal_id IN (" . $calendars . ")"
            . " AND date_start >= " . $this->db->escape($date_start)
            . " AND date_end <= " . $this->db->escape($date_end);

        $query = $this->db->query($sql);

        $events = array();
        foreach ($query->result_array() as $row) {
            $events[] = $row;
        }

        return $events;
    }

}

?>
