<div id="container">

	<h1>Welcome to Skedjul!</h1>

	<div id="body">
		 <div id="login_form" style="width: 90%; display: block">
			<p class="lead"> <?= $heading ?></p>

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
		<?php
		echo br(2);
		echo anchor(site_url(array('home')), 'Dashboard') ;
		?>
	</div>


	<?php echo br(2);?>
<table>

</table>

</div>
