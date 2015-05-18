<div id="container">
	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Login or signup for an account to get started.</p>

      <div id="login_form">
		<p>Login</p>
      <?php
         echo form_open('login/validate_credentials');
         echo form_input('username', 'Username');
         echo form_password('password', 'Password'); echo '<br />';
         echo form_submit('submit', 'Login');
         echo anchor('login/signup', 'Signup for an account')
      ?>
      <br />
      </div>
	</div>
</div>
