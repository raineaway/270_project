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
				$recurrence = array(
						'never' => 'Never',
						'daily' => 'Daily',
						'weekly' => 'Weekly',
						'monthly' => 'Monthly',
						'yearly' => 'Yearly'
					);
			?>

         <div class="form-control">

            <?php
                echo validation_errors();
                if (isset($errors['date_start'])) {
                    echo $errors['date_start'];
                    echo br(2);
                }
					 echo br();
                $form_attrib = array("id" => "event-form", "class"=>"form-horizontal");
                echo form_open($form_action, $form_attrib);
            ?>

            <div class="form-group">
                <label for="name" class="col-sm-3 control-label">Event</label>
                <div class="col-sm-8">
                   <?php echo form_input(array(
                     'name'        => 'name',
                     'placeholder' => 'Event Name',
                     'class'       => 'form-control',
                     'value'       => set_value('name', isset($event['name']) ? $event['name'] : '')));
                  ?>
                </div>
					<div class="col-sm-offset-3 col-sm-3">
						<?php
							echo form_checkbox(array(
								'name'      => 'is_all_day',
								'value'     => 1,
								'checked'   => (isset($event['is_all_day']) === 1) ?  TRUE : FALSE));
								echo form_label('All Day Event', 'is_all_day');
							?>
					</div>
              </div>

            <div class="form-group">
                  <label for="calendar" class="col-sm-3 control-label">Calendar</label>
                  <div class="col-sm-3">
                     <?php echo form_dropdown('cal_id', $calendars, (isset($event['cal_id'])) ? $event['cal_id'] : '', 'class="form-control dropdown"'); ?>
                  </div>
                </div>

            <div class="form-group">
						<label for="date_start" class="col-sm-3 control-label">Start Date</label>
                  <div class="col-sm-8">
                      <?php
								echo form_input(array(
									'name'   => 'date_start',
									'type'   => 'date',
									'value'  => set_value('date_start', (isset($event['date_start'])) ? date('Y-m-d', strtotime($event['date_start'])) : '')));

								echo form_input(array(
									'name'   => 'time_start',
									'type'   => 'time',
									'value'  => set_value('time_start', (isset($event['date_start'])) ? strftime('%H:%M:%S', strtotime($event['date_start'])) : '')));
								?>
                   </div>
                </div>

				<div class="form-group">
						<label for="date_end" class="col-sm-3 control-label">End Date</label>
	               <div class="col-sm-8">
	               	<?php
								echo form_input(array(
									'name'   => 'date_end',
									'type'   => 'date',
									'value'  => set_value('date_end', (isset($event['date_end'])) ? date('Y-m-d', strtotime($event['date_end'])) : '')));

								echo form_input(array(
									'name'   => 'time_end',
									'type'   => 'time',
									'value'  => set_value('time_end', (isset($event['date_end'])) ? strftime('%H:%M:%S', strtotime($event['date_end'])) : '')));
							?>
	                </div>
	             </div>

				<div class="form-group">
	              	<label for="recurrence" class="col-sm-3 control-label">Repeat</label>
	               <div class="col-sm-3">
	               	<?php
								echo form_dropdown('recurrence_type', $recurrence, (isset($event['recurrence_type'])) ?  $event['recurrence_type'] : 'never', 'class="form-control dropdown"');
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
