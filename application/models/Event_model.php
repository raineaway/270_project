<?php
class Event_model extends CI_Model {
    private $table = "event";
    public  function __construct() {
        parent::__construct($this->table);
    }

    public function create($data) {
        if (!isset($data['name']) || empty($data['name'])) {
            return array("status" => "fail", "error" => "event name is required");
        }
        $sql = "INSERT INTO `event` (name, is_all_day, date_start, date_end, recurrence_type, cal_id, date_created) "
            . "VALUES (" . $this->db->escape($data['name']) . ", "
            . $this->db->escape($data['is_all_day']) . ", "
            . $this->db->escape($data['date_start']) . ", "
            . $this->db->escape($data['date_end']) . ", "
            . $this->db->escape($data['recurrence_type']) . ", "
            . $this->db->escape($data['cal_id']) . ", "
            . $this->db->escape($data['date_created']) . ")";
        $this->db->query($sql);
        $rows = $this->db->affected_rows();
        if ($rows > 0) {
            return array("status" => "success");
        }
        return array("status" => "fail", "error" => $this->db->_error_message());
    }

    public function update($data) {
        if (!isset($data['event_id'])) {
            return array("status" => "fail", "error" => "event ID is required.");
        }
        $sql = "UPDATE `event` SET "
            . "name = " . $this->db->escape($data['name']) . ", "
            . "is_all_day = " . $this->db->escape($data['is_all_day']) . ", "
            . "date_start = " . $this->db->escape($data['date_start']) . ", "
            . "date_end = " . $this->db->escape($data['date_end']) . ", "
            . "recurrence_type = " . $this->db->escape($data['recurrence_type']) . ", "
            . "cal_id = " . $this->db->escape($data['cal_id'])
            . " WHERE event_id = " . $this->db->escape($data['event_id']);
        $this->db->query($sql);
        $rows = $this->db->affected_rows();
        if ($rows > 0) {
            return array("status" => "success");
        }
        return array("status" => "fail", "error" => $this->db->_error_message());
    }

    public function get_events_by_calendar($cal_id, $view, $date_start) {
        // $date_start must be a unix timestamp
        if ($view == "month") {
            $date_start = date("Y-m-01 00:00:00", $date_start);
            $date_end = date("Y-m-t 23:59:59", strtotime($date_start));
        } else if ($view == "week") {
            $date_temp = strtotime("last Sunday", date($date_start));
            $date_start = date("Y-m-d 00:00:00", $date_temp);
            $date_end = strtotime("+6 days", strtotime($date_start));
            $date_end = date("Y-m-d 23:59:59", $date_end);
        } else if ($view == "day") {
            $date_start = date("Y-m-d 00:00:00", $date_start);
            $date_end = date("Y-m-d 23:59:59", $date_start);
        }

        $sql = "SELECT * FROM event WHERE "
            . "cal_id = " . $this->db->escape($cal_id)
            . " AND (date_start >= " . $this->db->escape($date_start)   // OR end date, to accommodate events
            . " OR date_end <= " . $this->db->escape($date_end) . ")"   // ending within date range
            . " OR recurrence_type != 'never'";                         // Fetch recurring events
        $query = $this->db->query($sql);

        $events = $this->check_recurring($query->result_array(), $date_start, $date_end);
        return $events;
    }

    public function get_events_by_calendars($calendars, $view, $date_start) {
        // $calendars must be an array of calendar IDs
        $calendars = implode(", ", $calendars);

        if ($view == "week") {
            $date_temp = strtotime("last Sunday", date($date_start));
            $date_start = date("Y-m-d 00:00:00", $date_temp);
            $date_end = strtotime("+6 days", $date_start);
            $date_end = date("Y-m-d 23:59:59", $date_end);
        } else {
            $date_start = date("Y-m-01 00:00:00", $date_start);
            $date_end = date("Y-m-t 23:59:59", strtotime($date_start));
        }
        $sql = "SELECT * FROM event WHERE "
            . "cal_id IN (" . $calendars . ")"
            . " AND date_start >= " . $this->db->escape($date_start)
            . " AND date_end <= " . $this->db->escape($date_end);
        $query = $this->db->query($sql);
        $events = $this->check_recurring($query->result_array(), $date_start, $date_end);
        return $events;
    }

    public function get_by_id($event_id) {
        $sql = "SELECT * FROM `event` WHERE event_id = " . $this->db->escape($event_id);
        $query = $this->db->query($sql);
        foreach ($query->result_array() as $row) {
            return $row;
        }
        return NULL;
    }

    public function delete_by_id($event_id) {
        $sql = "DELETE FROM `event` WHERE event_id = " . $this->db->escape($event_id);
        $this->db->query($sql);
        if ($this->db->affected_rows() < 1) {
            return array("status" => "fail", "error" => $this->db->_error_message());
        }
        return TRUE;
    }

    private function check_recurring($events, $date_start, $date_end) {
        $final = array();
        foreach ($events as $row) {
            if ($row['date_start'] < $date_end) {
                if ($row['recurrence_type'] == 'never') {
                    $final[] = $row;
                } else if ($row['recurrence_type'] == 'yearly') {           // check if yearly event falls within date range
                    $this_year = date("Y");
                    $start = date("$this_year-m-d H:i:s", strtotime($row['date_start']));
                    $end = date("$this_year-m-d H:i:s", strtotime($row['date_end']));
                    if ($start >= $date_start || $end <= $date_end) {
                        $row['date_start'] = $start;
                        $row['date_end'] = $end;
                        $final[] = $row;
                    }
                } else if ($row['recurrence_type'] == 'monthly') {      // check if monthly event falls within date range
                    $this_month = date("m");
                    $this_year = date("Y");
                    $start = date("$this_year-$this_month-d H:i:s", strtotime($row['date_start']));
                    $end = date("$this_year-$this_month-d  H:i:s", strtotime($row['date_end']));
                    if ($start >= $date_start || $end <= $date_end) {
                        $row['date_start'] = $start;
                        $row['date_end'] = $end;
                        $final[] = $row;
                    }
                } else if ($row['recurrence_type'] == 'weekly') {       // check if weekly event falls within date range
                    while (TRUE) {
                        if (($row['date_start'] >= $date_start && $row['date_start'] <= $date_end)
                            || ($row['date_end'] <= $date_end && $row['date_end'] >= $date_start)) {

                            $final[] = $row;
                        }
                        $next_start = strtotime("+7 days", $row['date_start']);
                        $next_end = strtotime("+7 days", $row['date_end']);
                        $row['date_start'] = date("Y-m-d H:i:s", $next_start);
                        $row['date_end'] = date("Y-m-d H:i:s", $next_end);

                        if ($row['date_start'] > $date_end) {
                            break;
                        }
                    }
                } else if ($row['recurrence_type'] == 'daily') {
                    while (TRUE) {
                        if (($row['date_start'] >= $date_start && $row['date_start'] <= $date_end)
                            || ($row['date_end'] <= $date_end && $row['date_end'] >= $date_start)) {

                            $final[] = $row;
                        }
                        $next_start = strtotime("+1 day", $row['date_start']);
                        $next_end = strtotime("+1 day", $row['date_end']);
                        $row['date_start'] = date("Y-m-d H:i:s", $next_start);
                        $row['date_end'] = date("Y-m-d H:i:s", $next_end);

                        if ($row['date_start'] > $date_end) {
                            break;
                        }
                    }
                }
            }
        }
        return $final;
    }
}

?>
