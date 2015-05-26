<div id="container">
	<div class="container">

      <?php
      if($form_action == 'signup'){ ?>
         <div class="jumbotron" style="margin-top: 40px">
            <h1>Welcome to Skedjul!</h1>
            <p>Login or signup for an account to get started.</p>
         </div>
         <div style="width:40%; margin: auto">
            <div id="body" style="width:100%">
      <?php } else { ?>
         <div class="page-header" style="margin-top: 40px">
            <h1>Welcome to Skedjul! <small>Hello <?php echo $this->session->userdata('username');?>! You're logged in. </small></h1>
         </div>
         <div id="body" style="width:50%">
            <p class="lead"> <?php echo $heading; ?> </p>
      <?php } ?>

         <?php
            if (isset($success)) {
               echo '<div class="alert alert-info">' . $success . '</div>';
            }
         ?>

         <div class="form-control">
            <?php echo heading($heading, 3); ?>
            <?php
               if(validation_errors()){
                  echo '<div class="alert alert-warning" role="alert">' . validation_errors() . '</div>'; }
               if (isset($errors['warning'])) {
                  echo '<div class="alert alert-danger" role="alert">' . $errors['warning'] . '</div>'; }

               $hidden = array();

               if ($form_action == 'user/update') {
                  $hidden['user_id'] = $user['user_id'];
               }

               echo br();
               $button_attrib = array( 'class' => 'btn btn-primary', 'role'  => 'button');
               $form_attrib = array("id" => "event-form", "class"=>"form-horizontal");

                echo form_open($form_action, $form_attrib, $hidden);
                echo form_fieldset('Information');
            ?>
            <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-8">
                   <?php
                     echo form_input(array(
                        'name'        => 'username',
                        'class'       => 'form-control',
                        'placeholder' => 'Username',
                        'value'       => set_value('username', isset($user['username']) ? $user['username'] : "")));
                  ?>
                </div>
              </div>
              <div class="form-group">
                  <label for="email_address" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-8">
                     <?php
                     echo form_input(array(
                         'name'        => 'email_address',
                         'class'       => 'form-control',
                         'placeholder' => 'Email Address',
                         'value'       => set_value('email_address', isset($user['email_address']) ? $user['email_address'] : "")));
                    ?>
                  </div>
                </div>
               <div class="form-group">
                   <label for="firstname" class="col-sm-3 control-label">First Name</label>
                   <div class="col-sm-8">
                      <?php
                      echo form_input(array(
                          'name'        => 'firstname',
                          'placeholder' => 'First Name',
                          'class'       => 'form-control',
                          'value'       => set_value('firstname', isset($user['firstname']) ? $user['firstname'] : "")));
                     ?>
                   </div>
                 </div>
               <div class="form-group">
                  <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-8">
                     <?php
                     echo form_input(array(
                         'name'        => 'lastname',
                         'class'       => 'form-control',
                         'placeholder' => 'Last Name',
                         'value'       => set_value('lastname', isset($user['lastname']) ? $user['lastname'] : "")));
                      ?>
                  </div>
               </div>

            <?php
                echo form_fieldset_close();

                //PASSWORD FIELDSET
                echo form_fieldset('Password');?>

                <div class="form-group">
                   <label for="password" class="col-sm-3 control-label">Password</label>
                   <div class="col-sm-8">
                      <?php echo form_password(array('name' =>'password','placeholder' => 'Password')); ?>
                   </div>
                </div>
                <div class="form-group">
                   <label for="confirm_password" class="col-sm-3 control-label">Confirm Password</label>
                   <div class="col-sm-8">
                      <?php echo form_password(array('name' =>'confirm_password','placeholder' => 'Confirm Password')); ?>
                   </div>
                </div>

            <?php
            echo form_submit('submit', $submit_button, "class='btn btn-primary'");

            if ($form_action == 'signup') {
                echo anchor('login', 'Log In', "class='btn btn-default'");
            }
            ?>
         </div>
		</div>
      <?php echo br(3);
      if($form_action == 'signup'){
         echo '</div>';
      }
      ?>
	</div>
</div>
