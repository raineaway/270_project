<div id="container">
    <h1>Welcome to Skedjul!</h1>

	<div id="body">
        <div id="login_form">
        <?php
            echo heading('User account settings', 3);
            echo validation_errors();
            if (isset($errors['warning'])) {
                echo $errors['warning'];
            }

            echo form_open();
            echo form_fieldset('Information');
            echo form_input(array(
                'name'        => 'username',
                'placeholder'       => $this->session->userdata('username'),
                'readonly'    => true ));
            echo form_input(array(
                'name'        => 'email_address',
                'placeholder'       => $this->session->userdata('email_address'),
                'readonly'    => true ));
            echo form_input(array(
               'name'        => 'firstname',
               'placeholder'       => $this->session->userdata('firstname'),
               'readonly'    => true ));
            echo form_input(array(
               'name'        => 'lastname',
               'placeholder'       => $this->session->userdata('lastname'),
               'readonly'    => true ));
            echo anchor('home/account/info', 'Edit');
            echo form_fieldset_close();

            echo form_open('home/edit_account/password');
            echo form_fieldset('Password');
               echo form_password(array('name' =>'old_password','placeholder' => 'Enter old Password'));
               echo form_password(array('name' =>'new_password','placeholder' => 'Enter new password'));
               echo form_password(array('name' =>'confirm_password','placeholder' => 'Confirm new Password'));
               echo form_submit('submit', 'Edit');
               echo anchor('home/account', 'Cancel');
            echo form_fieldset_close();
            echo br(2);
            echo anchor('calendar', 'Back to Dashboard')
        ?>
        <br />
        </div>
	</div>
   <?php echo br(2); ?>
</div>
