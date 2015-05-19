<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Hello <?php echo $username;?>! You're logged in. <br />

		<?php	echo "Today is " . date("Y-m-d G:i A"); ?></p>
		<?php echo br(1);
		 		echo anchor(site_url(array('event/form')), 'Create New Event');
		 		//echo anchor(site_url(array('calendar/form')), 'Create New Calendar');
                echo anchor(site_url(array('calendar/list')), 'My Calendars');
                echo anchor(site_url(array('user/account')), 'My Account');
		 		echo br(3);

				echo form_dropdown('calendars', $calendar_list, 'all');

				echo $calendar; ?>
   </div>

	<div>
		<?php echo anchor(site_url(array('home/logout')), 'Logout')?>
		<br />
	</div>
<table>

</table>

</div>
