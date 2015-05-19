<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Hello <?php echo $username;?>! You're logged in. <br />

		<?php	echo "Today is " . date("Y-m-d G:i A"); ?></p>
		<?php echo br(1); ?>
		<?php echo anchor(site_url(array('event/form')), 'Create New Event')?>
		<?php echo anchor(site_url(array('calendar/form')), 'Create New Calendar')?>
		<?php echo br(3); ?>
		<?php echo $calendar; ?>
   </div>

	<div>
		<?php echo anchor(site_url(array('home/logout')), 'Logout')?>
		<br />
	</div>
<table>

</table>

</div>
