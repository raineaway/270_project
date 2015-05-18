<div id="container">
	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Hello <?php echo $username;?>! You're logged in. <br />
		<?php	echo "Today is " . date("Y-m-d G:i A"); ?></p>
		<?php echo $calendar; ?>
   </div>

	<div>
		<br />
		<?php echo anchor(site_url(array('home/logout')), 'Logout')?>
		<br />
	</div>
<table>

</table>

</div>
