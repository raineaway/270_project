<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		 <div id="login_form" style="width: 90%; display: block">
          <?php echo heading( 'Your event/s for ' . date( 'M d Y - l', strtotime($date)), 3); ?>

			<?php
			$list = array();
			foreach($events as $row) {
				if ($row['is_all_day'] == 0){
					$list[] = $row['name'] . " - " . date( 'g:i A', strtotime($row['date_start'])) . " to " . date( 'g:i A', strtotime($row['date_end']));
				}else {
					$list[] = $row['name'] . " - Whole day event";
				}

			}

			$attributes = array('class' => 'event_list', 'id' => 'event_list');
			echo ul($list, $attributes);
			?>


       </div>
	</div>


	<?php echo br(2);?>
<table>

</table>

</div>
