<div class="container-wrapper container-wrapper-faqs container-top">
      <div class="container container-top">
		<div class="row">
			<div class="col-md-12 center">
				<h1>Salon Owner Sign Up</h1>
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
	$hidden_inputs = array('group_id' => element('val', element('salon', config_item('user_role'))));
	echo form_open("user/register/" . $page_user_role, array('class' => 'form-horizontal be-user-form', 'id' => 'be-user-register-salon-form'), $hidden_inputs);
	?>
	
	<div class="col-md-6">
	<h3 class="margin-bottom-20">Account Settings</h3>
	<?php
	$this->be_model->form_group($first_name, 'First Name', 'John', true);
	$this->be_model->form_group($last_name, 'Last Name', 'Smith', true);
	$this->be_model->form_group($email, 'Email', 'john@nails.com', true);
	$this->be_model->form_group($password, 'Password', 'xxxxxxxx', true);
	$this->be_model->form_group($password_confirm, 'Password Confirm', 'xxxxxxxx', true);
	$this->be_model->form_group($ownership, 'Type Ownership', '', true, 'select');
	$this->be_model->form_group($tax_id, 'Fed Tax ID', '123456789', true);
	$this->be_model->form_group($user_type, 'User Type', '', true, 'select');
	$this->be_model->form_group($phone, 'Cell or Contact Number', '123-456-7890', true);
	?>
	<div class="space-30"></div>
	<h3 class="margin-bottom-20">Bank Account (ACH) Information</h3>
	<?php
	$this->be_model->form_group($bank_name, 'Name of Bank', '', true);
	$this->be_model->form_group($account_nickname, 'Account Nickname', '', true);
	$this->be_model->form_group($account_type, 'Account Type', '', true, 'select');
	$this->be_model->form_group($bank_routing_number, 'Bank Routing Number', '', true, false, 'Must be 9 digits');
	$this->be_model->form_group($account_number, 'Account Number', '', true);
	?>
	</div>
	
	<div class="col-md-6">
	
	<h3 class="margin-bottom-20">DBA Profile</h3>
	<?php
	$this->be_model->form_group($dba_name, 'Business DBA Name', '', true);
	$this->be_model->form_group($dba_phone, 'DBA Phone', '', true);
	?>
	<!--
	<div class="col-md-offset-4 margin-bottom-10 padding-left-10"><h4>Billing Address</h4>
		<div class="clear"></div>
	    <label class="checkbox margin-top-10" style="padding:0;">
			<input type="checkbox" onChange="be_dba_address_clone(this)">
			<span></span>
			 Check here to duplicate address
		</label>
	</div>
	<div class="clear"></div>
	<?php
	/* $this->be_model->form_group($dba_address, 'Street', '', true);
	$this->be_model->form_group($dba_address2, 'Street 2', '', false);
	$this->be_model->form_group($dba_city, 'City', '', true);
	$this->be_model->form_group($dba_state, 'State', '', true);
	$this->be_model->form_group($dba_zip, 'Zip', '', true); */
	?>
	-->
	
	<div class="space-30"></div>
	
	<h3 class="margin-bottom-20">Business Profile</h3>
	<?php
	$this->be_model->form_group($business_name, 'Business Name', '', true);
	$this->be_model->form_group($business_phone, 'Corporate Phone', '', true);
	$this->be_model->form_group($business_email, 'Business Email', '', true);
	?>
	<h4 class="col-md-offset-4 margin-bottom-10 padding-left-10">Mailing Address</h4>
	<div class="clear"></div>
	<?php
	$this->be_model->form_group($mailing_address, 'Street', '', true);
	$this->be_model->form_group($mailing_city, 'City', '', true);
	$this->be_model->form_group($mailing_state, 'State', '', true);
	$this->be_model->form_group($mailing_zip, 'Zip', '', true);
	?>
	<div class="col-md-offset-4 margin-bottom-10 padding-left-10"><h4>Billing Address</h4>
	<label class="checkbox margin-top-10" style="padding:0;">
			<input type="checkbox" onChange="be_dba_address_clone(this)">
			<span></span>
			 Check here to duplicate address
		</label>
		</div>
	<div class="clear"></div>
	<?php
	$this->be_model->form_group($billing_address, 'Street', '', true);
	$this->be_model->form_group($billing_city, 'City', '', true);
	$this->be_model->form_group($billing_state, 'State', '', true);
	$this->be_model->form_group($billing_zip, 'Zip', '', true);
	?>
	</div>
	<div class="clear"></div>
	<div class="col-md-12 margin-top-20">
		<a href="javascript:;" onclick="document.getElementById('be-user-register-salon-form').submit();" class="col-md-3 col-md-offset-3 btn btn-cyan btn-lg margin-right-20">Sign Up</button>
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