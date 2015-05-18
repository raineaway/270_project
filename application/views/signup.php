<div id="container">
    <h1>Welcome to Skedjul!</h1>

    <div id="body">
        <div id="login_form">
            <p>Create an account

            <?php
                if (isset($errors['warning'])) {
                    echo $errors['warning'];
                }
                echo form_open('signup');
                echo form_input(array(
                    'name'        => 'username',
                    'placeholder' => 'Username',
                    'value'       => isset($username) ? $username : ''));
                echo form_input(array(
                    'name'        => 'email_address',
                    'placeholder' => 'Email Address',
                    'value'       => isset($email_address) ? $email_address : ''));
                echo form_input(array(
                    'name'        => 'firstname',
                    'placeholder' => 'First Name',
                    'value'       => isset($firstname) ? $firstname : ''));
                echo form_input(array(
                    'name'        => 'lastname',
                    'placeholder' => 'Last Name',
                    'value'       => isset($lastname) ? $lastname : ''));

                if (isset($errors['password'])) {
                    echo $errors['password'];
                }
                echo form_password(array('name' =>'password','placeholder' => 'Password'));
                echo form_password(array('name' =>'confirm_password','placeholder' => 'Confirm Password'));
                echo form_submit('submit', 'Sign Up');
                echo anchor('login', 'Log In')
            ?>

        </div>
    </div>
</div>
