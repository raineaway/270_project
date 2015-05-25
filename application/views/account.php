<div id="container">
	<div class="container">
      <div class="page-header" style="margin-top: 40px">
         <h1>Welcome to Skedjul! <small>Hello <?php echo $this->session->userdata('username');?>! You're logged in. </small></h1>
      </div>

		<div id="body" style="width:50%">
         <p class="lead"> <?php echo $heading; ?> </p>

         <?php
				if (isset($success)) {
            	echo '<div class="success">' . $success . '</div>';
         	}
			?>

         <div class="form-control">

            <?php
                echo validation_errors();
                echo br();
                $form_attrib = array("id" => "event-form", "class"=>"form-horizontal");
                $attributes = array( 'class' => 'btn btn-primary', 'role'  => 'button');

                //INFO FIELDSET
                echo form_open('user/account/edit', $form_attrib);
                echo form_fieldset('Information');
            ?>
            <div class="form-group">
                <label for="username" class="col-sm-3 control-label">Username</label>
                <div class="col-sm-8">
                   <?php
                   echo form_input(array(
                       'name'          => 'username',
                       'class'         => 'form-control',
                       'placeholder'   => $this->session->userdata('username'),
                       'readonly'      => true ));
                  ?>
                </div>
              </div>
              <div class="form-group">
                  <label for="email_address" class="col-sm-3 control-label">Email</label>
                  <div class="col-sm-8">
                     <?php
                     echo form_input(array(
                         'name'           => 'email_address',
                         'class'          => 'form-control',
                         'placeholder'    => $this->session->userdata('email_address'),
                         'readonly'       => true ));
                    ?>
                  </div>
                </div>
               <div class="form-group">
                   <label for="firstname" class="col-sm-3 control-label">First Name</label>
                   <div class="col-sm-8">
                      <?php
                      echo form_input(array(
                        'name'            => 'firstname',
                        'class'           => 'form-control',
                        'placeholder'     => $this->session->userdata('firstname'),
                        'readonly'        => true ));
                     ?>
                   </div>
                 </div>
               <div class="form-group">
                  <label for="lastname" class="col-sm-3 control-label">Last Name</label>
                  <div class="col-sm-8">
                     <?php
                     echo form_input(array(
                        'name'         => 'lastname',
                        'class'        => 'form-control',
                        'placeholder'  => $this->session->userdata('lastname'),
                        'readonly'    => true ));
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
                      <?php echo form_password(array('name' =>'password','placeholder' => '*************', 'readonly' => true)); ?>
                   </div>
                </div>

               <?php echo anchor(site_url(array('user/update')), '<span class="glyphicon glyphicon-pencil"></span> Edit', $attributes) ; ?>
               <a class="btn btn-default" role="button" href="javascript:window.history.go(-1);">Cancel</a>
         </div>
		</div>
      <?php
      echo br(2);
      echo anchor(site_url(array('home')), 'Dashboard', "class='btn btn-primary'") ;
      echo br(3);
      ?>
	</div>
</div>
