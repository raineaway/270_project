<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Hello <?php echo $username;?>! You're logged in. <br />

		<?php	echo "Today is " . date("Y-m-d G:i A"); ?></p>
		<?php echo br(1);
		 		echo anchor(site_url(array('event/form')), 'Create New Event');
		 		echo anchor(site_url(array('calendar/new_calendar')), 'Create New Calendar');
				echo anchor(site_url(array('calendar/list_all')), 'My Calendars');
		 		echo br(3);?>


				<?php foreach($calendars as $cal) { ?>
					<div>
						<div style="float:left; width:75%; color:<?php echo $cal['color']; ?>">
							<input type="checkbox" name="calendar_list"
															value="<?php echo $cal['cal_id']; ?>">&nbsp;<?php echo $cal['name']; ?><br />
						</div>
					</div>
				<?php } ?>

				<?php	echo $calendar;
						echo br(3); ?>

			<?php echo anchor(site_url(array('home/account')), 'Account Settings') ;
		 	//echo anchor(site_url(array('calendar/form')), 'Create New Calendar');

			echo anchor(site_url(array('user/account')), 'Account Settings') ;
			echo anchor(site_url(array('home/logout')), 'Logout');
				?>
		<br />
	</div>

	<?php echo br(2);?>
<table>

</table>

</div>
