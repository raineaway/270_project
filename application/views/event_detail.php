<div id="container">
	<div class="container">
      <div class="page-header" style="margin-top: 40px">
         <h1>Welcome to Skedjul! <small>Hello <?php echo $this->session->userdata('username');?>! You're logged in. </small></h1>
      </div>

		<div id="body" style="width:50%">
			<div style="float:left; display: inline">	<p class="lead">Event Details </p></div>
			<div style="float:left; display: inline">
				<?php
				    echo nbs(3);
				    $attributes = array(
					    'class' => 'btn btn-primary',
					    'role'  => 'button'
				    );
				    echo anchor(site_url(array('event/update/'.$row['event_id'])),
                        '<span class="glyphicon glyphicon-pencil"></span>', $attributes) ;
					echo nbs(2);
					echo anchor(site_url(array('event/delete_event/' . $row['event_id'])),
                        '<span class="glyphicon glyphicon-trash"></span> ', $attributes);
				?>
			</div>

				<?php
	                if (isset($success)) {
	                    echo '<div class="success">' . $success . '</div>';
	                }
                    if (isset($fail)) {
                        echo '<div class="bg-danger">' . $fail . '</div>';
                    }

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

					$tmpl = array ( 'table_open'  => '<table class="table table-bordered">' );
					$this->table->set_template($tmpl);
					echo $this->table->generate();

					$attributes = array(
						'class' => 'btn btn-primary',
						'role'  => 'button'
					);

				?>
		</div>

		<a class="btn btn-primary" role="button" href="javascript:window.history.go(-1);">Back</a>

		<?php
		echo nbs(2);
		echo anchor(site_url(array('home')), 'Dashboard', $attributes) ;
		echo br(3);
		?>
	</div>
</div>
