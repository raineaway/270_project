<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">
            <p>Create new event

            <?php
                echo validation_errors();

                echo form_open('event/new_event');

                echo form_input(array(
                    'name'        => 'name',
                    'placeholder' => 'Event Name',
                    'value'       => set_value('name')));




               echo form_checkbox(array(
                  'name'      => 'is_all_day',
                  'value'     => 'All day',
                  'checked'   => FALSE
               ));

               echo form_label('All day event', 'is_all_day');
               echo br(1);


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
