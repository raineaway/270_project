<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">

            <?php
                echo heading('Create new calendar', 3);
                echo validation_errors();

                echo form_open('calendar/new_calendar');

                echo form_input(array(
                    'name'        => 'name',
                    'placeholder' => 'Calendar Name',
                    'value'       => set_value('name')));
                echo form_input(array(
                    'name'        => 'color',
                    'type'        => 'color',
                    'placeholder' => 'Color',
                    'value'       => set_value('color')));


               echo form_submit('submit', 'Create Calendar');
               echo anchor('calendar', 'Cancel')
            ?>

        </div>
    </div>
</div>
