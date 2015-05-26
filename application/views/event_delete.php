<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		 <div id="login_form" style="width: 90%; display: block">
			<p class="lead"> Delete Event </p>

            <p>Are you sure you want to delete event <strong><?php echo $event['name']; ?></strong>?</p>

			<?php
                echo form_open(site_url(array('event/delete_event/' . $event['event_id'] . '/' . $previous)));

                echo form_submit('submit', 'Delete Event');
                echo nbs(2);
                echo anchor(site_url(array('event/detail/' . $event['event_id']  . '/' . $previous)), 'Cancel');

			?>

       </div>
		<?php
		echo br(2);
		echo anchor(site_url(array('event/' . str_replace("-", "/", $previous))), 'Back to Events List');
		echo br(1);
		echo anchor(site_url(array('calendar')), 'Back to Dashboard') ;?>
	</div>
	<?php echo br(2);?>
<table>

</table>

</div>
