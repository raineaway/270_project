<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		 <div id="login_form" style="width: 90%; display: block">
			<p class="lead">
          <?php echo 'Your event/s for ' . date( 'M d Y - l', strtotime($date)); ?> </p>

			<?php

			$attributes = array('class' => 'event_list', 'id' => 'event_list');
			echo ul($list, $attributes);
			?>


       </div>
	</div>


	<?php echo br(2);?>
<table>

</table>

</div>
