<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">
            <?php
                echo heading('Create new event', 3);
                echo validation_errors();

                if (isset($errors['date_start'])) {
                    echo $errors['date_start'];
                    echo br(2);
                }

                echo form_open('event/new_event');

                echo form_input(array(
                    'name'        => 'name',
                    'placeholder' => 'Event Name',
                    'value'       => set_value('name')));

                echo form_label('Calendar', 'calendar');
                echo nbs(2);
                echo form_dropdown('cal_id', $calendars);
                echo br(1);

                echo form_label('All day event', 'is_all_day');
                echo nbs(2);
                echo form_checkbox(array(
                    'name'      => 'is_all_day',
                    'value'     => 1,
                    'checked'   => FALSE));
                echo br(1);

                echo form_label('Start Date', 'date_start');
                echo nbs(3);
                echo form_input(array(
                     'name'   => 'date_start',
                     'type'   => 'date',
                     'value'  => set_value('date_start')));
                echo form_input(array(
                     'name'   => 'time_start',
                     'type'   => 'time',
                     'value'  => set_value('time_start')));
                echo br(1);

                echo form_label('End Date', 'date_end');
                echo nbs(4);
                echo form_input(array(
                     'name'   => 'date_end',
                     'type'   => 'date',
                     'value'  => set_value('date_end')));
                echo form_input(array(
                     'name'   => 'time_end',
                     'type'   => 'time',
                     'value'  => set_value('time_end')));
                echo br(2);
               
                $recurrence = array(
                    'never' => 'Never',
                    'daily' => 'Daily',
                    'weekly' => 'Weekly',
                    'monthly' => 'Monthly',
                    'yearly' => 'Yearly'
                );
                echo form_label('Repeat', 'recurrence');
                echo nbs(2);
                echo form_dropdown('recurrence_type', $recurrence, 'never');
                echo br(3);
                echo form_submit('submit', 'Create Event');
                echo anchor('calendar', 'Cancel')
            ?>

        </div>
    </div>
    <?php echo br(2);?>
</div>
