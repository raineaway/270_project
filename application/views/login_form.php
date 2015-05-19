<div id="container">
    <h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Login or signup for an account to get started.</p>

        <div id="login_form">
        <?php
            echo heading('Login', 3);
            echo validation_errors();
            if (isset($errors['warning'])) {
                echo $errors['warning'];
            }
            echo form_open('login');
            echo form_input(array('name' =>'username','placeholder' => 'Username'));
            echo form_password(array('name' =>'password','placeholder' => 'Password'));
            echo form_submit('submit', 'Login');
            echo anchor('signup', 'Signup for an account');
        ?>
        </div>
        <?php echo br(2);?>
	</div>
</div>
