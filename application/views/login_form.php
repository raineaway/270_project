<div id="container">
   <div class="container">
      <div class="jumbotron" style="margin-top: 40px">
         <h1>Welcome to Skedjul!</h1>
         <p>Login or signup for an account to get started.</p>
      </div>
<div id="body" style="width:100%">

	<div style="width:28%; margin: auto">


        <div class="form-control">
        <?php
            echo heading('Login', 3);
            echo validation_errors();
            if (isset($errors['warning'])) {
                echo $errors['warning'];
            }
            $attribute = array('class' => 'form-control');
            echo form_open('login');
            echo form_input(array('name' =>'username','placeholder' => 'Username'));
            echo form_password(array('name' =>'password','placeholder' => 'Password'));

            $attributes = array(
               'class' => 'btn btn-primary',
               'role'  => 'button'
            );
            echo form_submit('submit', 'Login', "class='btn btn-primary'");

            $attributes = array(
               'class' => 'btn btn-default',
               'role'  => 'button'
            );
            echo anchor('signup', 'Signup for an account', $attributes);
        ?>
        </div>
     </div>

</div>
        <?php echo br(2);?>
	</div>
</div>
</div>
