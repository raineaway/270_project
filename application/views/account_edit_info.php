<div id="container">
    <h1>Welcome to Skedjul!</h1>

	<div id="body">
        <div id="login_form">
        <?php
            echo heading('User account settings', 3);
            echo validation_errors();
            echo $this->session->flashdata('success_msg');
            if (isset($errors['warning'])) {
                echo $errors['warning'];
            }

            echo form_open('home/edit_account/info');
            echo form_fieldset('Information');
            echo form_input(array(
                'name'        => 'username',
                'value'       => $this->session->userdata('username')));
            echo form_input(array(
                'name'        => 'email_address',
                'value'       => $this->session->userdata('email_address')));
            echo form_input(array(
               'name'        => 'firstname',
               'value'       => $this->session->userdata('firstname')));
            echo form_input(array(
               'name'        => 'lastname',
               'value'       => $this->session->userdata('lastname')));
            echo form_submit('submit', 'Edit');
            echo anchor('home/account', 'Cancel');
            echo form_fieldset_close();

            echo form_open();
            echo form_fieldset('Password');
               echo form_password(array('name' =>'password','placeholder' => '**********', 'readonly' => true));
               echo anchor('home/account/password', 'Edit');
            echo form_fieldset_close();

            echo br(2);
            echo anchor('calendar', 'Back to Dashboard')
        ?>
        <br />
        </div>
	</div>
   <?php echo br(2); ?>
</div>
