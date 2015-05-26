<div id="container">
	<div class="container">
      <div class="page-header" style="margin-top: 40px">
         <h1>Welcome to Skedjul! <small>Hello <?php echo $username;?>! You're logged in. </small></h1>
      </div>
		<div id="body">

			<p class="lead"> <?= $heading ?></p>

			<div class="panel panel-default">
			  <div class="panel-body">
				<?php
                    if (isset($success)) {
                        echo '<div class="bg-success">' . $success . '</div>';
                    }
                    if (isset($fail)) {
                        echo '<div class="bg-danger">' . $fail . '</div>';
                    }

				    $attributes = array('class' => 'event_list', 'id' => 'event_list');
				    echo ul($list, $attributes);
				?>
			  </div>
			</div>

			<?php
				$attributes = array(
                    'class' => 'btn btn-primary',
                    'role'  => 'button'
                );
				echo br(2);
				echo anchor(site_url(array('home')), 'Dashboard', $attributes) ;
				echo br(3);
			?>
		</div>
	</div>
</div>
