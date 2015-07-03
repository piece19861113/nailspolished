<div class="container-wrapper container-wrapper-faqs container-top">
      <div class="container container-top">
		<div class="row">
			<div class="col-md-12 center">
				<h1>Log In</h1>
			</div>
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end container wrapper -->

<div class="container">
	<?php if(!empty($message)) { ?>
	<div class="modal fade be-user-register-message">
	    <div class="modal-dialog">
	        <div class="modal-content">
		        <div class="modal-header">
	                <h4>Sign Up Confirmation</h4>
	            </div>
	            <div class="modal-body">
	            	<div class="be-font-red"><?php echo $message; ?></div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-cyan" data-dismiss="modal">Close</button>
	            </div>
	        </div>
	    </div>
	</div>
	<script type="text/javascript">
		$(function() {
			$("div.be-user-register-message").modal('toggle');
		});
	</script>
	<?php } ?>
	
	<?php
	echo form_open("user/login", array('class' => 'form-horizontal be-user-form', 'id' => 'be-user-login-form'));
	?>
	<div class="col-md-8 col-md-offset-2 margin-top-20 text-left">
		<?php
		$this->be_model->form_group($email, 'Email');
		$this->be_model->form_group($password, 'Password');
		?>
		<div class="clear"></div>
		<div class="col-md-4 col-md-offset-4 margin-top-10">
			<a href="javascript:;" onclick="document.getElementById('be-user-login-form').submit();" class="col-xs-12 btn btn-cyan btn-lg">Log In</a>
		</div>
		<button type="submit" style="display:none;">Submit</button>
	</div>
	<div class="clear"></div>
	<div class="col-md-8 col-md-offset-2 margin-top-30 center">
		<div class="controls">
			<p>Don't you have account? Please <a href="<?php echo base_url(); ?>user/register">Sign Up</a></p>
		</div><!-- end controls -->
	</div><!-- end form group -->
	<?php
	echo form_close();
	?>
</div>

<div class="clear"></div>

<div class="container-wrapper container-wrapper-light-black">
	<div class="container">
	<div class="row">
		<div class="col-md-12 center">
			<h2 class="white">DISCOVER GREAT PLACES TO BE BEAUTIFUL AROUND YOU</h2>
		</div>
		<div class="space-30"></div>
		<div class="col-md-4 col-md-offset-4 center">
			<a href="<?php echo base_url(); ?>"><img style="max-width:80%; margin:0 auto;" src="<?php echo base_url(); ?>assets/images/logo_home.png" alt="" /></a>
		</div>
	</div>
	</div>
</div>