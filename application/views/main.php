<div class="navbar-wrapper">
	<div class="navbar navbar-static-top" role="navigation">
	<div class="col-md-12">
		<a class="brand" href="<?php echo base_url(); ?>"><span class="logo"></span></a>
		<div class="nav-user pull-right">
			<ul class="nav nav-user-options nav-pills1">
				<?php
				if($logged_in) {
				?>
					<li><a href="<?php echo base_url(); ?>dashboard/page" class="btn btn-cyan-link">Welcome, <?php echo $user['full_name']; ?>!</a></li>
					<li><a href="<?php echo base_url(); ?>user/logout" class="btn btn-cyan-transparent width-100">LOG OUT</a></li>
				<?php
				} else {
				?>
					<li><a href="<?php echo base_url(); ?>user/login" class="btn btn-cyan-transparent width-100">LOG IN</a></li>
					<li><a href="<?php echo base_url(); ?>user/register" class="btn btn-cyan-transparent width-100">SIGN UP</a></li>
				<?php
				}
				?>
				<!-- <li class="signup"><a href="user-signup.html" class="btn btn-purple">Sign Up</a></li>
				<li class="login"><a href="user-login.html" class="btn btn-light">Login</a></li> -->
		
				<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<span class="fa fa-bars"></span>
						<span class="btn-navbar-text">MENU</span>
					</a>
	                <ul class="dropdown-menu">
	                    <li class="active"><a href="<?php echo base_url(); ?>">Home</a></li>
						<?php
						foreach(config_item('static_pages') as $page_link => $page_data) { 
						?>
						<li><a href="<?php echo base_url(); ?>pages/<?php echo $page_link; ?>"><?php echo $page_data['title']; ?></a></li>
						<?php } ?>
	                </ul>
                </li>
			</ul>
		</div>
	</div>
	</div>
</div>
	
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		<?php
		$captions = array(
				1 => array('STAY POLISHED', 'STAY POLISHED'),
				2 => array('AT YOUR CONVIENCE', 'FIND IT, BOOK IT & STAY POLISHED'),
				3 => array('READY TO RELAX', 'MIND BODY AND BEAUTY'),
				4 => array('BY THE PUSH OF A BUTTON', 'AVAILABLE IN ALL CITIES'),
				5 => array('STARTS RIGHT HERE', 'YOUR TIME TO BE PAMPERED'),
				6 => array('THE VALUE OF BEING PREPARED', 'DON’T UNDERESTIMATE'),
				7 => array('MANICURED FOR MEETING', 'MANICURED FOR MEETING'),
				8 => array('A NIGHT OUT', 'BE POLISHED FOR THAT BIG NIGHT OUT ON THE TOWN')
			);
		for($i=0;$i<count($captions);$i++) {
		?>
			<li data-target="#myCarousel" data-slide-to="<?php echo $i; ?>"<?php if(!$i) echo ' class="active"'; ?>></li>
		<?php
		}
		?>
	</ol>
	<div class="carousel-inner">
		<?php
		for($i=1;$i<=count($captions);$i++) {
		?>
		<div class="item bg bg<?php echo $i; ?><?php if($i == 1) echo ' active';?>">
			<div class="carousel-caption">
				<h1><?php echo $captions[$i][0]; ?></h1>
				<div>
					<span class="be-home-carousel-text-bottom"><?php echo $captions[$i][1]; ?></span>
				</div>
				<p class="col-xs-12" style="margin-top:50px;">
					<a href="<?php echo base_url(); ?>" class="col-xs-10 col-xs-offset-1 btn btn-cyan-transparent btn-lg">LEARN MORE</a>
					<a href="<?php echo base_url(); ?>user/register" class="col-xs-10 col-xs-offset-1 btn btn-cyan-transparent btn-lg">SIGN UP TODAY</a>
				</p>
			</div>
		</div>
		<?php } ?>
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	<div class="carousel-down-arrow">
		<a href="#be-home-main-area">
		<i class="fa fa-angle-down"></i>
		</a>
	</div>
</div>

<div id="be-home-main-area"></div>
<div class="container-wrapper container-wrapper-tile1">
	<div class="container">
		<div class="col-sm-6 col-sm-offset-3 center">
			<div class="be-title">FIND NEAREST NAIL SALON</div>
		</div>
		<div class="space-20"></div>
		<div class="col-sm-12 center">
			<img class="be-home-search-icon" src="<?php echo base_url(); ?>assets/images/utils/search_icon_big.png" alt="" />
		</div>
		<div class="space-25"></div>
		<div class="col-xs-12 col-md-10 col-md-offset-1 center be-home-search-form">
			<form class="form-search" role="form">
				<input type="text" class="pull-left form-control be-home-search-form-text" placeholder="Enter your location" value="" />
				<button type="submit" class="pull-right btn btn-pink btn-lg be-home-search-form-button">SEARCH</button>
			</form>
		</div>
		<div class="clear"></div>
	</div>
</div>


<div class="clear"></div>


<div class="container-wrapper container-wrapper-black">
	<div class="container"> 
	<div class="row">
	<?php
	$descriptions = array(
			1 => array('icon_url' => 'icon_dollar.png', 'link' => '#none', 'description' => '100% FREE TO USE'),
			2 => array('icon_url' => 'icon_salon.png', 'link' => '#none', 'description' => '22996+ NAIL SALONS'),
			3 => array('icon_url' => 'icon_sms.png', 'link' => '#none', 'description' => 'INSTANT SMS CONFIRMATION'),
			4 => array('icon_url' => 'icon_superior_service.png', 'link' => '#none', 'description' => 'EXPERIENCE A SUPERIOR SERVICE')
		);
	for($i=1;$i<=count($descriptions);$i++) {
	?>
		<div class="col-xs-6 col-sm-3 center margin-top-10">
			<p><img class="be-home-description-icon be-icon-dollar" src="<?php echo base_url(); ?>assets/images/utils/<?php echo $descriptions[$i]['icon_url']; ?>" alt="" /></p>
			<p class="margin-top-10"><?php echo $descriptions[$i]['description']; ?></p>
		</div>
	<?php } ?>
	</div>
	</div>
</div>

<div class="clear"></div>

<div class="container-wrapper container-wrapper-tile2">
	<div class="container">
		<div class="col-sm-6 col-sm-offset-3 center">
			<div class="be-title">FEATURES</div>
		</div>
		<div class="space-10"></div>
		<div class="col-md-12 center margin-top-20">
		<?php
		$features = array(
				1 => array('link' => '#none', 'description' => 'TAP AND BOOK YOUR NEXT NAIL APPOINTMENT 24 HOURS A DAY', 'pink' => true),
				2 => array('link' => '#none', 'description' => 'CASHLESS & CONVENIENT', 'pink' => true),
				3 => array('link' => '#none', 'description' => 'POLISHED REVIEWS', 'pink' => true),
				4 => array('link' => '#none', 'description' => 'POLISHED POINTS', 'pink' => true),
				5 => array('link' => '#none', 'description' => 'POLISHED GIFTS CARDS', 'pink' => true)
			);
		for($i=1;$i<=count($features);$i++) {
		?>
			<div class="col-xs-6 col-sm-4<?php if($i==5) echo ' col-xs-offset-3 col-sm-offset-0'; if($i==4) echo ' col-sm-offset-2 col-xs-offset-0'; ?> center">
			<div class="be-home-features-item<?php if(isset($features[$i]['pink'])) echo ' be-home-features-item-pink'; else if(isset($features[$i]['combine'])) echo ' be-home-features-item-combine'; ?> margin-left-10 margin-right-10">
				<p class="be-home-features-item-inner"><?php echo $features[$i]['description']; ?></p>
			</div>
			</div>
		<?php } ?>
		</div>
	</div>
</div>

<div class="clear"></div>

<div class="container-wrapper container-wrapper-light-black">
	<div class="container">
	<div class="col-sm-8 col-sm-offset-2 center">
		<div class="be-title">22996+ SALONS AVAILABLE IN THE US</div>
	</div>
	<div class="space-30"></div>
	<div class="col-sm-8 col-sm-offset-2 center">
		<img src="<?php echo base_url(); ?>assets/images/utils/home_map.png" alt="" />
	</div>
	</div>
</div>
	
<div class="clear"></div>
	
<div class="container-wrapper container-wrapper-white">
	<div class="container" style="padding-bottom:0;">
	<div class="col-sm-4 col-sm-offset-4 center">
		<div class="be-title">FOLLOW US</div>
	</div>
	<div class="space-30"></div>
	<div class="col-md-12 be-home-follow">
		<a href="#none" class="col-xs-3 be-home-follow-item be-home-follow-item-cyan"><span class="fa fa-facebook"></span></a>
		<a href="#none" class="col-xs-3 be-home-follow-item be-home-follow-item-grey"><span class="fa fa-pinterest"></span></a>
		<a href="#none" class="col-xs-3 be-home-follow-item be-home-follow-item-pink"><span class="fa fa-twitter"></span></a>
		<a href="#none" class="col-xs-3 be-home-follow-item be-home-follow-item-black"><span class="fa fa-youtube"></span></a>
	</div>
	</div>
</div>

<div class="clear"></div>

<div class="container-wrapper container-wrapper-light-black">
	<div class="container">
	<div class="row">
		<div class="col-md-12 center">
			<h2 class="white">Find it Book it Stay Polished</h2>
		</div>
		<div class="space-30"></div>
		<div class="col-md-4 col-md-offset-4 center">
			<a href="<?php echo base_url(); ?>"><img style="max-width:80%; margin:0 auto;" src="<?php echo base_url(); ?>assets/images/logo_home.png" alt="" /></a>
		</div>
	</div>
	</div>
</div>