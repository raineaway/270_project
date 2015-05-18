<div id="container">
	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		<p>Hello <?php echo $username;?>! You're logged in. <br />
		<?php	echo "Today is " . date("Y-m-01 00:00:00"); ?></p>

		<?php

		echo $this->calendar->generate($this->uri->segment(3), $this->uri->segment(4));

		?>
   </div>



	<div>
		<br />
		<?php echo anchor(site_url(array('home/logout')), 'Logout')?>
		<br />
	</div>

</div>
