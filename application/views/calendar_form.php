<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">

            <?php
                echo heading($heading, 3);
                echo validation_errors();

                echo form_open($form_action);

                echo form_input(array(
                    'name'        => 'name',
                    'placeholder' => 'Calendar Name',
                    'value'       => set_value('name', isset($calendar['name']) ? $calendar['name'] : '')));
                echo form_input(array(
                    'name'        => 'color',
                    'type'        => 'color',
                    'placeholder' => 'Color',
                    'value'       => set_value('color', isset($calendar['color']) ? $calendar['color'] : '')));


               echo form_submit('submit', $submit_button);
               echo anchor('calendar/list_all', 'Cancel')
            ?>

        </div>
    </div>
    <?php echo br(2);?>
</div>
