<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">
            <?php
                echo heading('Create new event', 3);
                echo validation_errors();

                echo form_open('event/new_event');

                echo form_input(array(
                    'name'        => 'name',
                    'placeholder' => 'Event Name',
                    'value'       => set_value('name')));

               echo form_label('Start Date', 'start_date');
               echo nbs(3);
               echo form_input(array(
                     'name'   => 'start_date',
                     'type'   => 'date',
                     'value'  => set_value('start_date')));
               echo form_input(array(
                     'name'   => 'start_time',
                     'type'   => 'time',
                     'value'  => set_value('start_time')));
               echo br(1);

               echo form_label('End Date', 'end_date');
               echo nbs(4);
               echo form_input(array(
                     'name'   => 'end_date',
                     'type'   => 'date',
                     'value'  => set_value('end_date')));
               echo form_input(array(
                     'name'   => 'end_time',
                     'type'   => 'time',
                     'value'  => set_value('end_time')));
               echo br(2);

               echo form_checkbox(array(
                  'name'      => 'is_all_day',
                  'value'     => 'All day',
                  'checked'   => FALSE));

               echo form_label('All day event', 'is_all_day');
               $recurrence = array(
                  'never' => 'Never',
                  'daily' => 'Daily',
                  'weekly' => 'Weekly',
                  'monthly' => 'Monthly',
                  'yearly' => 'Yearly'
               );
               echo form_label('Repeat', 'recurrence');
               echo nbs(3);
               echo form_dropdown('recurrence', $recurrence, 'never');
               echo br(3);
               echo form_submit('submit', 'Create Event');
               echo anchor('calendar', 'Cancel')
            ?>

        </div>
    </div>
</div>
