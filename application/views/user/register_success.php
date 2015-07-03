<div class="container-wrapper container-wrapper-faqs container-top">
	<div class="container container-top">
		<div class="row">
			<div class="col-md-12 center">
				<h1 class="margin-bottom-20">Sign Up</h1>
	<?php
	switch($user_role) {
		case element('name', element('salon', config_item('user_role'))):
	?>
	<h4>You have successfully registered as salon user.</h4>
	<h4>Please login with your email and password.</h4>
	<?php
			break;
		case element('name', element('customer', config_item('user_role'))):
	?>
	<h4>You have successfully registered as customer user.</h4>
	<h4>Please login with your email and password.</h4>
	<?php
			break;
		case element('name', element('admin', config_item('user_role'))):
	?>
	<h4>You have successfully registered as admin user.</h4>
	<h4>Please login with your email and password.</h4>
	<?php
			break;
		default:
	?>
	<h4>Signup Error!</h4>
	<?php
			break;
	}
	?>
	</div>
</div>
</div>
</div><!-- end container wrapper -->


<div class="container-wrapper container-wrapper-tile1">
	<div class="container">
		<div class="col-sm-6 col-sm-offset-3 center">
			<div class="be-title">FEATURES</div>
		</div>
		<div class="space-10"></div>
		<div class="col-md-12 center margin-top-20">
		<?php
		$features = array(
				1 => array('link' => '#none', 'description' => 'TAP AND BOOK YOUR NEXT NAIL APPOINTMENT 24 HOURS A DAY'),
				2 => array('link' => '#none', 'description' => 'CASHLESS & CONVENIENT'),
				3 => array('link' => '#none', 'description' => 'POLISHED REVIEWS'),
				4 => array('link' => '#none', 'description' => 'POLISHED POINTS'),
				5 => array('link' => '#none', 'description' => 'POLISHED GIFTS CARDS')
			);
		for($i=1;$i<=count($features);$i++) {
		?>
			<div class="col-xs-6 col-sm-4<?php if($i==5) echo ' col-xs-offset-3 col-sm-offset-0'; if($i==4) echo ' col-sm-offset-2 col-xs-offset-0'; ?> center">
			<div class="be-home-features-item margin-left-10 margin-right-10">
		<p class="be-home-features-item-inner"><?php echo $features[$i]['description']; ?></p>
	</div>
	</div>
		<?php } ?>
		</div>
	</div>
</div>
<div class="clear"></div>