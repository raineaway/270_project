<div id="container">
	<div class="container">
      <div class="page-header" style="margin-top: 40px">
         <h1>Welcome to Skedjul! <small>Hello <?php echo $username;?>! You're logged in. </small></h1>
      </div>
		<div id="body">

		<div class="page-header" style="margin-top: 0; padding-top: 0">
			<div class="pull-right form-inline">
				<?php echo br(1);
				$attribute = array(
					'class' => 'btn btn-primary',
					'role'  => 'button'
				);
			 		echo anchor(site_url(array('event/new_event')), 'Create New Event', $attribute); echo nbs();
			 		echo anchor(site_url(array('calendar/new_calendar')), 'Create New Calendar', $attribute); echo nbs();
					echo anchor(site_url(array('calendar/list_all')), 'My Calendars', $attribute); echo nbs();
					echo anchor(site_url(array('event/list_all')), 'My Events', $attribute);
			 		echo br(3);?>
			</div>
			<h3>Dashboard</h3>
			<p> <?php	echo "Today is " . date("Y-m-d g:i A"); ?> </p>
		</div>

        <?php
            if (isset($success)) {
                echo '<div class="bg-success">' . $success . '</div>';
            }
            if (isset($fail)) {
                echo '<div class="bg-danger">' . $fail . '</div>';
            }
        ?>

		<div class="row" style="width: 100%">
			<div style="width: 100px; float: left">
				<div class="btn-group-horizontal" role="group">
				<?php foreach($calendars as $cal) { ?>
						<?php
							$attributes = array(
								'class' 	=> 'btn btn-default',
								'role' 	=> 'button',
								'style' 	=> 'color: ' . $cal['color'] . '; width: 100%'
							);
							echo anchor(site_url(array('calendar/show/'. $cal['cal_id'])), $cal['name'], $attributes); ?>
				 <?php } ?>
				</div>
			</div>
			<div style="width: 1010px; float: left">
				<?php	echo $calendar;
						echo br(3); ?>

			</div>
		</div>



			<?php
			//echo anchor(site_url(array('home/account')), 'Account Settings', $attributes) ;
		 	//echo anchor(site_url(array('calendar/form')), 'Create New Calendar');

			echo anchor(site_url(array('user/account')), 'Account Settings', $attribute) ;echo nbs();
			echo anchor(site_url(array('home/logout')), 'Logout', $attribute);
				?>
		<br />






		</div>
		<?php echo br(2);?>
	</div>
</div>
