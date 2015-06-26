<body>
<div class="scroll-top-wrapper">
    <span class="scroll-top-inner">
        <i class="fa fa-arrow-up"></i>
    </span>
</div>
<?php if(!isset($is_home)) { ?>
	<div class="navbar navbar-inverse navbar-fixed-top" id="navbar">
      <div class="navbar-inner">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              
              <a href="<?php echo base_url(); ?>" class="brand">
             	 <span class="logo"></span>
             	 <span class="logo-text"></span>
              </a>
              <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
              <!-- <a href="#none" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="fa fa-bars"></span>
                <span class="btn-navbar-text">Menu</span>
              </a> -->
              
                <!-- 
                <div class="nav-menu pull-left">
                  <ul class="nav nav-pills">
                    <li><a href="<?php echo base_url(); ?>pages/about">About Us</a></li>
                    <li><a href="<?php echo base_url(); ?>pages/salons">Salon Owners</a></li>
                    <li class="dropdown">
                      <a href="#none" class="dropdown-toggle" data-toggle="dropdown">Support <b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="<?php echo base_url(); ?>pages/features">App Features</a></li>
                        <li><a href="<?php echo base_url(); ?>pages/contact">Contact Us</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>pages/faqs">FAQs</a></li>
						<li><a href="<?php echo base_url(); ?>pages/return_policy">Return Policy</a></li>
						<li><a href="<?php echo base_url(); ?>pages/privacy_policy">Privacy Policy</a></li>
                      </ul>
                    </li>
                  </ul>
                </div> -->
                <div class="nav-user pull-right">
                  <ul class="nav nav-user-options nav-pills1">
                  	<?php
					if($logged_in) {
					?>
						<li><a href="<?php echo base_url(); ?>dashboard/page" class="btn btn-cyan-link">MY DASHBOARD</a></li>
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
                </div><!-- end nav-user -->
                
            </div><!-- end col-md-12 -->
          </div><!-- end row fluid -->
        </div><!-- end container -->
        
      </div><!-- end navbar-inner -->
      
	</div><!-- end navbar -->
	<div class="clear"></div>
	
<?php } ?>
<!--
<div id="be-header">
	<div class="pull-left">
		<a href="<?php echo base_url(); ?>"><h1 style="color:#000;">Nails Mockup</h1></a>
	</div>
	<div class="pull-right">
<?php
if($logged_in) {
?>
	
	<span>Welcome, <?php echo $user['username']; ?>!</span>
	<span class="be-margin-left10"><a href="<?php echo base_url(); ?>dashboard/page" class="btn btn-primary">My Dashboard</a></span>
	<span class="be-margin-left10"><a href="<?php echo base_url(); ?>user/logout" class="btn btn-primary">Log Out</a></span>
	
<?php
} else {
?>
	<a href="<?php echo base_url(); ?>user/register" class="btn btn-primary">Sign Up</a>
	<a href="<?php echo base_url(); ?>user/login" class="btn btn-primary">Login</a>
<?php
}
?>
	</div>
	<div class="be-clear"></div>
</div>
<div id="be-main"><div class="container-fluid">
-->