<div id="container">
	<div class="container">
      <div class="page-header" style="margin-top: 40px">
         <h1>Welcome to Skedjul! <small>Hello <?php echo $this->session->userdata('username');?>! You're logged in. </small></h1>
      </div>
		<div id="body">

			<p class="lead"> Your Calendars </p>

            <?php
                if (isset($success)) {
                    echo '<div class="alert alert-info" role="alert">' . $success . '</div>';
                }
                if (isset($fail)) {
                    echo '<div class="alert alert-danger" role="alert">' . $fail . '</div>';
                }
            ?>

			<div class="panel panel-default" style="width:40%">
			  <div class="panel-body">
             <div class="row">
                <?php foreach($calendars as $calendar) { ?>
                <div class="col-sm-7" style="color:<?php echo $calendar['color']; ?>">
                   <?php echo $calendar['name']; ?>
                </div>
                <div class="col-sm-5">
                   <a href="<?php echo site_url(array('calendar/update', $calendar['cal_id'])); ?>"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                   <?=nbs(3); ?>
                   <a href="<?php echo site_url(array('calendar/delete', $calendar['cal_id'])); ?>"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </div>
                <?php } ?>
              </div>
			  </div>
			</div>

				<?php
				echo br(2);
				echo anchor(site_url(array('home')), 'Dashboard', "class='btn btn-primary'") ;
				echo br(3);
				?>
		</div>
	</div>
</div>
