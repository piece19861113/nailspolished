<div class="container-wrapper container-wrapper-faqs container-top">
      <div class="container container-top">
		<div class="row">
			<div class="col-md-12 center">
				<h1>Sign Up</h1>
			</div>
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end container wrapper -->
<div class="container">
<div class="row row-tiles">
	<div class="col-md-6">
 		<div class="tile tile-alt">
			<a class="tile-photo" style="background-image:url(<?php echo base_url(); ?>assets/images/users/client.jpg);background-position:center center;"></a>
			<div class="tile-details">
				<p><h2>Polished Client</h2></p>
				<p>Join the NailsPolished community today, create your account here!</p>
				<p><a href="<?php echo base_url(); ?>user/register/<?php echo element('name', element('customer', config_item('user_role'))); ?>" class="btn btn-cyan btn-lg">Customer User Sign Up <i class="fa fa-forward margin-left-10"></i></a></p>
			</div><!-- end tile details -->
		</div><!-- end tile -->
	</div><!-- end col -->
	
	<div class="col-md-6">
		<div class="tile tile-alt">
			<a class="tile-photo" style="background-image:url(<?php echo base_url(); ?>assets/images/users/salon.jpg);"></a>
			<div class="tile-details">
				<p><h2>Salon Owner</h2></p>
				<p>Add your Nail Salon to the NailsPolished  network today.</p>
	 			<p><a href="<?php echo base_url(); ?>user/register/<?php echo element('name', element('salon', config_item('user_role'))); ?>" class="btn btn-cyan btn-lg">Salon Owner Sign Up <i class="fa fa-forward margin-left-10"></i></a></p>
			</div><!-- end tile details -->
		</div><!-- end tile -->
	</div><!-- end col -->
</div><!-- end row -->
</div>