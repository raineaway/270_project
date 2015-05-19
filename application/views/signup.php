<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">

            <?php
                echo heading('Create an account', 3);
                echo validation_errors();

                echo form_open('signup');
                echo form_input(array(
                    'name'        => 'username',
                    'placeholder' => 'Username',
                    'value'       => set_value('username')));
                echo form_input(array(
                    'name'        => 'email_address',
                    'placeholder' => 'Email Address',
                    'value'       => set_value('email_address')));
                echo form_input(array(
                    'name'        => 'firstname',
                    'placeholder' => 'First Name',
                    'value'       => set_value('firstname')));
                echo form_input(array(
                    'name'        => 'lastname',
                    'placeholder' => 'Last Name',
                    'value'       => set_value('lastname')));

                echo form_password(array('name' =>'password','placeholder' => 'Password'));
                echo form_password(array('name' =>'confirm_password','placeholder' => 'Confirm Password'));
                echo form_submit('submit', 'Sign Up');
                echo anchor('login', 'Log In')
            ?>

        </div>
    </div>
</div>
