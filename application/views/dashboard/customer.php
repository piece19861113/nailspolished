	<div class="container-wrapper container-wrapper-faqs container-top">
      <div class="container container-top">
        <div class="row">
          <div class="col-md-12 center">
            <h1><?php echo $user['full_name']; ?></h1>
            <div class="clear"></div>
            <p class="lead margin-top-20">NailsPushed &middot; My Account &middot; Profile &middot; Dashboard</p>
          </div>
        </div><!-- end row -->
      </div><!-- end container -->
    </div><!-- end container wrapper -->
    
    
	<div class="container">
	<?php if($user['user_role_name'] == 'customer') { ?>
		<div class="row">
        	<div class="col-md-12">
		        <div class="alert alert-error">
		            <button type="button" class="close" data-dismiss="alert">×</button>
		            <strong>Warning!</strong><span class="margin-left-10">You need to get verified before any proceeding any payment.
		            Please proceed your verification step below.</span>
		        </div><!-- end alert -->
		        <div class="tile tile-horizontal">
		            <span class="fa fa-cc-mastercard"></span>
		            <div class="tile-details">
		              <h3>Verify your account for payment transactions</h3>
		              <p class="margin-top-5">Usu ut dicit melius accumsan, quo at dolore temporibus. Ut epicuri omittantur has. Duo id rebum invidunt laboramus. Errem quaestio vis no. Tale primis iconcilisis has ne. Nonumes habemus pri no, mucius aliquando eu sea. Te eum omnes volumus aliquando.</p>
		              <p>
		              	<a href="<?php echo base_url(); ?>user/register/<?php echo element('name', element('customer', config_item('user_role'))) . '_verify'; ?>" class="btn btn-cyan btn-lg">
		              		Verify Your Account
		              	</a>
		               </p>
		            </div><!-- end tile details -->
				</div><!-- end tile -->
			</div>
        </div>
	<?php } ?>
      <div class="row">
        <div class="col-md-6">
          <ul class="fa-ul">
            <li><i class="fa-li fa fa-envelope"></i> <a href="#none"><?php echo $user['email']; ?></a></li>
            <li><i class="fa-li fa fa-phone"></i> +64 9 123 4567</li>
            <li><i class="fa-li fa fa-mobile-phone"></i> +64 21 987 6543</li>
          </ul>
        </div><!-- end col-md-6 -->
        <div class="col-md-6">
          <ul class="fa-ul">
            <li><i class="fa-li fa fa-facebook"></i> <a href="#none">www.facebook.com/website</a></li>
            <li><i class="fa-li fa fa-twitter"></i> <a href="#none">www.twitter.com/website</a></li>
            <li><i class="fa-li fa fa-pinterest"></i> <a href="#none">www.pinterest.com/website</a></li>
          </ul>
        </div><!-- end col-md-6 -->
      </div><!-- end row -->
      <hr class="margin-top-10" />
      <div class="row">
        <div class="col-md-6">
          <h2>Employment</h2>
          <dl>
            <dt>Jun 2010 - Present<br />Friendly Leopard</dt>
            <dd>Senior Webdesigner including HTML &amp; CSS for a social media site where people discuss their unusual pets.</dd>
            <dt>Apr 2006 - Jun 2010<br />Flying Banana Labs</dt>
            <dd>Webdesigner for a digital agency.  Clients included Nike, Burton Snowboards, Just for Laughs Festival.</dd>
            <dt>Nov 2005 - Apr 2006<br />Golden Kangaroo Interactive</dt>
            <dd>Junior graphic/web designer at a small digital agency.  Clients included Aussiehair, Bet 365, and Nivea.</dd>
          </dl>
        </div><!-- end col -->
        <div class="col-md-6">
          <h2>Education</h2>
          <dl>
            <dt>2000 - 2004</dt>
            <dd>First Class BA (Hons) Graphic Design<br />
            London College of Communication</dd>
            <dt>2000 - 2004</dt>
            <dd>Maths, English, English Lit, Biology, German, Art, D&amp;T<br />
    DavidDavidson Old Grammar School (GCSE)</dd>
          </dl>
        </div><!-- end col -->
      </div><!-- end row -->
      <hr />
      <div class="row">
        <div class="col-md-6">
          <h2>Skills</h2>
          <dl>
            <dt>Software</dt>
            <dd>Photoshop, Illustrator, InDesign, Flash, Flexbuilder, Dreamweaver, Coda and Textmate. </dd>
            <dt>Languages</dt>
            <dd>Hand coded HTML &amp; CSS (compatible with standards compliant browsers), basic actionscript, basic javascript. Integration of styling into ruby on rails, ﬂex 3 and PHP.</dd>
          </dl>
        </div><!-- end col -->
        <div class="col-md-6">
          <h2>Hobbies &amp; Interests</h2>
          <dl>
            <dt></dt>
            <dd>Photography, surfing, windsurfing, fishing, diving, and video games.</dd>
          </dl>
        </div><!-- end col -->
      </div><!-- end row -->
    </div><!-- end container -->