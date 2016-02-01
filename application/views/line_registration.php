<script type="text/javascript">
	jQuery(function ($) {
		$("#pcon").mask("(999) 999-9999", {placeholder: " "});
		// $("#cscore").mask("999",{placeholder:" "});
		$("#to_transunion").mask("999", {placeholder: " "});
		$("#to_equifax").mask("999", {placeholder: " "});
		$("#to_experion").mask("999", {placeholder: " "});
		$("#ssn_no").mask("999-999-9999", {placeholder: " "});
	});


	$(document).ready(function () {
		$('input[type="radio"]').click(function () {
			if ($(this).attr("value") == "paypal") {
				$(".box22").hide();
				$(".paypal").show();


			}
			if ($(this).attr("value") == "cash") {
				$(".box22").hide();
				//$(".green").show();
			}
			if ($(this).attr("value") == "cheque") {
				$(".box22").hide();
				//$(".blue").show();
			}


		});
	});


</script>

<style type="text/css">
	.box22 {
		float: right;
		display: none;
		width: 200px;
	}
</style>


<section id="register-page">
	<div class="container">

		<h2 style="text-align: center">Line Owner Registration</h2>

		<div class="col-lg-3">


		</div>
		<div class="col-lg-6">


			<?php
				if ($this->session->flashdata('success_msg_affiliate')) {
					?>
					<div class="message info">
						<p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
					</div>
				<?php } ?>


			<?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal box1');
				echo form_open(base_url() . 'line/line_reg', $attributes);
			?>
			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Username *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'uname', 'id' => 'uname', 'placeholder' => 'Enter Your Username', 'value' => set_value('uname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('uname');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Password *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('password');
					?>
					<p class="note">(Minumum 5 character and maximum 12 characters)</p>
				</div>
			</div>

			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Confirm Password *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'cpassword', 'type' => 'password', 'placeholder' => 'Re-enter Password', 'id' => 'cpassword', 'value' => set_value('cpassword'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('cpassword');
					?>
					<p class="note">(Minumum 5 character and maximum 12 characters)</p>
				</div>
			</div>

			<!-- <h3> <strong>General Information</strong></h3>
			 <p style="color: red">( Fields with * are required)</p>   -->
			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">First Name *</label>

				<div class="col-sm-8">
					<input type="hidden" name="code" value="<?php echo $code; ?>">
					<input type="hidden" name="ref_user" value="<?php echo $ref_user; ?>">
					<input type="hidden" name="ref_id" value="<?php echo $refinfo->affiliate_id; ?>">
					<?php
						$data = array('name' => 'fname', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'value' => set_value('fname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('fname');
					?>
				</div>
			</div>


			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Middle Name </label>

				<div class="col-sm-8">
					<?php
						$data = array('name' => 'mname', 'id' => 'mname', 'placeholder' => 'Enter Middle Name', 'value' => set_value('mname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('mname');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Last Name *</label>

				<div class="col-sm-8">
					<?php
						$data = array('name' => 'lname', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'value' => set_value('lname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('lname');
					?>
				</div>
			</div>


			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">E-mail *</label>

				<div class="col-sm-8">

					<?php
						$data = array('name' => 'email', 'readonly' => 'readonly', 'id' => 'email', 'value' => $email, 'class' => 'form-control',);
						echo form_input($data);
						//echo form_error('email');
					?>
				</div>
			</div>


			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label"> Contact No. </label>

				<div class="col-sm-8">
					<?php


						$data = array('name' => 'pcon', 'id' => 'pcon', 'placeholder' => 'Primary Contact No.', 'value' => set_value('pcon'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('pcon');
					?>
				</div>
			</div>

			<!-- <div class="form-group">
					      <label for="firstname" class="col-sm-4 control-label">Address *</label>
					      <div class="col-sm-8">
							 <?php $data = array('name' => 'address', 'id' => 'address', 'placeholder' => 'Street, Unit, State, Zip Code', 'value' => set_value('address'), 'class' => 'form-control',);
				echo form_input($data);
				echo form_error('address');
			?>
						</div>
						</div> -->

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Credit Score *</label>

				<div class="col-sm-8">

					<p>


					<h6>Transunion</h6>
					<?php $data = array('name' => 'to_transunion', 'id' => 'to_transunion', 'placeholder' => 'Transunion', 'value' => set_value('to_transunion'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('to_transunion');
					?>


					<h6>Equifax</h6>
					<?php $data = array('name' => 'to_equifax', 'id' => 'to_equifax', 'placeholder' => 'Equifax', 'value' => set_value('to_equifax'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('to_equifax');
					?>


					<h6>Experion</h6>
					<?php $data = array('name' => 'to_experion', 'id' => 'to_experion', 'placeholder' => 'Experion', 'value' => set_value('to_experion'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('to_experion');
						echo form_error('data_you_want_to_validate_together');
					?>

					</p>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Payment Type *</label>

				<div class="col-sm-8">
					<input type="radio" name="payment" <?php echo set_value('payment') == 'cash' ? 'checked' : ''; ?>
						   value="cash"/>Cash &nbsp; &nbsp; &nbsp;
					<input type="radio" name="payment" <?php echo set_value('payment') == 'cheque' ? 'checked' : ''; ?>
						   value="cheque"/>Cheque &nbsp; &nbsp; &nbsp;
					<input type="radio" name="payment" <?php echo set_value('payment') == 'paypal' ? 'checked' : ''; ?>
						   value="paypal"/>Paypal <br>

					<div class="paypal box22">
						<input type="text" name="paypal_id" placeholder="Paypal Account"
							   value="<?php echo set_value('paypal_id'); ?>"/>
						<?php echo form_error('paypal_id'); ?>
					</div>

					<?php if (set_value('payment') == 'paypal') { ?>
						<script>
							$(".paypal").show();
						</script>
					<?php } ?>





					<?php
						echo form_error('payment'); ?>

				</div>
			</div>


			<div class="form-group">
				<div class="col-sm-offset-4 col-sm-8">
					<?php
						$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default',);
						echo form_submit($data);
						echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp';
					?>
					<?php

						$data = array('value' => 'Cancel', 'class' => 'btn btn-default',);
						echo form_reset($data);
					?>
				</div>


			</div>

			<?php echo form_close(); ?>


		</div>
		<div class="col-lg-3"></div>

		<!--/.row-->
	</div>
	<!--/.container-->
</section><!--/#contact-page-->
</div>
<hr>