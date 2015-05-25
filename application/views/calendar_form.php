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

         	$attributes = array( 'class' => 'btn btn-primary', 'role'  => 'button');
			?>

         <div class="form-control">

            <?php
                echo validation_errors();
                echo br();
                $form_attrib = array("id" => "event-form", "class"=>"form-horizontal");
                echo form_open($form_action, $form_attrib);
            ?>

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Name</label>
                <div class="col-sm-8">
                   <?php
                     echo form_input(array(
                       'name'        => 'name',
                       'placeholder' => 'Calendar Name',
                       'class'       => 'form-control',
                       'value'       => set_value('name', isset($calendar['name']) ? $calendar['name'] : '')));
                  ?>
                </div>
              </div>
              <div class="form-group">
                  <label for="color" class="col-sm-3 control-label">Color</label>
                  <div class="col-sm-8">
                     <?php
                     echo form_input(array(
                        'name'        => 'color',
                        'type'        => 'color',
                        'placeholder' => 'Color',
                        'value'       => set_value('color', isset($calendar['color']) ? $calendar['color'] : '')));
                    ?>
                  </div>
                </div>
            <?php
					 echo br();
                echo form_submit('submit', $submit_button, "class='btn btn-primary'");
            ?>
					<a class="btn btn-default" role="button" href="javascript:window.history.go(-1);">Cancel</a>
         </div>
		</div>
		<?php echo br(3);?>
	</div>
</div>
