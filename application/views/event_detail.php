<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		 <div id="login_form" style="width: 90%; display: block">
			<p class="lead"> Event Details </p>

			<?php
				$this->table->set_heading( 'Fields', 'Details' );
				$this->table->add_row('Event', $row['name']);

				$this->table->add_row('Is All Day', $row['is_all_day'] ? 'Yes' : 'No');

				$this->table->add_row('Start Date', date('Y-m-d', strtotime($row['date_start'])));
				$this->table->add_row('End Date', date('Y-m-d', strtotime($row['date_end'])));
                if (!$row['is_all_day']) {
					$this->table->add_row('Start Time', date( 'g:i A', strtotime($row['date_start'])));
					$this->table->add_row('End Time', date( 'g:i A', strtotime($row['date_end'])));
				}
				$this->table->add_row('Recurrence', ucfirst($row['recurrence_type']));
				echo $this->table->generate();

				echo br(2);
				echo anchor(site_url(array('event/update/'.$row['event_id'])), 'Edit Event') ;
				echo br(2);
			?>

       </div>
		<?php
		echo br(2);
		echo anchor(site_url(array('calendar')), 'Back to Dashboard') ;?>
	</div>
	<?php echo br(2);?>
<table>

</table>

</div>
