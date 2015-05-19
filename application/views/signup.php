<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">

            <?php
                echo heading($heading, 3);
                echo validation_errors();
                if (isset($errors['warning'])) {
                    echo 'Warning: ' . $errors['warning'];
                }

                $hidden = array();
                if ($form_action == 'user/update') {
                    $hidden['user_id'] = $user['user_id'];
                }
                echo form_open($form_action, '', $hidden);
                echo form_input(array(
                    'name'        => 'username',
                    'placeholder' => 'Username',
                    'value'       => set_value('username', isset($user['username']) ? $user['username'] : "")));
                echo form_input(array(
                    'name'        => 'email_address',
                    'placeholder' => 'Email Address',
                    'value'       => set_value('email_address', isset($user['email_address']) ? $user['email_address'] : "")));
                echo form_input(array(
                    'name'        => 'firstname',
                    'placeholder' => 'First Name',
                    'value'       => set_value('firstname', isset($user['firstname']) ? $user['firstname'] : "")));
                echo form_input(array(
                    'name'        => 'lastname',
                    'placeholder' => 'Last Name',
                    'value'       => set_value('lastname', isset($user['lastname']) ? $user['lastname'] : "")));

                echo form_password(array('name' =>'password','placeholder' => 'Password'));
                echo form_password(array('name' =>'confirm_password','placeholder' => 'Confirm Password'));

                echo form_submit('submit', $submit_button);

                if ($form_action == 'signup') {
                    echo anchor('login', 'Log In');
                }
            ?>

        </div>
        <?php echo br(2);?>
    </div>
</div>
