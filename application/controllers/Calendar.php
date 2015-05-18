<?php
class Calendar extends CI_Controller {

   var $prefs;

    public function __construct() {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
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

                {cal_cell_content}<a href="{content}">{day}</a>{/cal_cell_content}
                {cal_cell_content_today}<div class="highlight"><a href="{content}">{day}</a></div>{/cal_cell_content_today}

                {cal_cell_no_content}{day}{/cal_cell_no_content}
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

    public function index($year=null, $month=null){
      $this->show_calendar($year, $month);
   }

    public function show_calendar($year=null, $month=null){
      $events = array(
         '1' => 'rent',
         '10' => 'trip to Cali',
         '25' => 'pay bills',
      );

      $this->load->library('calendar', $this->prefs);
      $data['calendar'] = $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4), $events);
      $data['username']     = $this->session->userdata('username');
      $data['main_content'] = 'logged_in_area';
      $this->load->view('includes/template', $data);
   }

}
?>
