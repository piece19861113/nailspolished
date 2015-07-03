<div class="container-wrapper container-wrapper-faqs container-top">
      <div class="container container-top">
		<div class="row">
			<div class="col-md-12 center">
				<h1>User Sign Up</h1>
				<div class="be-font-light-grey margin-top-20">Items marked with an asterisk (*) are required</div>
			</div>
		</div><!-- end row -->
	</div><!-- end container -->
</div><!-- end container wrapper -->

<div class="container">
	<?php if(!empty($message)) { ?>
	<div class="modal fade be-user-register-message" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	    <div class="modal-dialog">
	        <div class="modal-content">
		        <div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                  	<h3 class="modal-title" id="myModalLabel">Sign Up Confirmation</h3>
	            </div>
	            <div class="modal-body">
	            	<?php echo $message; ?>
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
	$hidden_inputs = array('group_id' => element('val', element('customer', config_item('user_role'))));
	echo form_open("user/register/" . $page_user_role, array('class' => 'form-horizontal be-user-form', 'id' => 'be-user-register-customer-form'), $hidden_inputs);
	?>
	<div class="col-md-8 col-md-offset-2 margin-top-20 text-left">
		<?php
		$this->be_model->form_group($first_name, 'First Name', 'John', true);
		$this->be_model->form_group($last_name, 'Last Name', 'Smith', false);
		$this->be_model->form_group($email, 'Email', 'johnsmith@nails.com', true);
		$this->be_model->form_group($password, 'Password', 'xxxxxxxx', true);
		$this->be_model->form_group($password_confirm, 'Password Confirm', 'xxxxxxxx', true);
		?>
	</div>
	<div class="clear"></div>
	<div class="col-md-12 margin-top-20">
		<a href="javascript:;" onclick="document.getElementById('be-user-register-customer-form').submit();" class="col-md-3 col-md-offset-3 btn btn-cyan btn-lg margin-right-20">Sign Up</button>
		<a href="<?php echo base_url(); ?>user/register" class="col-md-3 btn btn-cyan btn-lg margin-right-20">Go Back</a>
	</div>
	<button type="submit" style="display:none;">Submit</button>
	<div class="clear"></div>
	<div class="col-md-12 margin-top-30 center">
		<div class="controls">
			<p>Already have an account? <a href="<?php echo base_url(); ?>user/login">Login</a></p>
		</div><!-- end controls -->
	</div><!-- end form group -->
	<?php
	echo form_close();
	?>
</div>
</div>