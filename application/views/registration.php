<script type="text/javascript">
	jQuery(function ($) {
		$("#date").mask("99/99/9999", {placeholder: "mm/dd/yyyy"});
		$("#pcon").mask("(999) 999-9999", {placeholder: " "});
		$("#scon").mask("(999) 999-9999", {placeholder: " "});
		$("#zip").mask("99999", {placeholder: " "});
		$("#ssn").mask("999-99-9999", {placeholder: " "});
		$("#fax").mask("999-999-9999", {placeholder: " "});
	});

</script>


<section id="register-page">
	<div class="container">

		<h2 style="text-align: center">referrer Registration</h2>

		<div class="col-lg-3"></div>
		<div class="col-lg-6">


			<?php
				if ($this->session->flashdata('success_msg_affiliate')) {
					?>
					<div class="message info">
						<p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
					</div>
				<?php } ?>


			<?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal box1');
				echo form_open(base_url() . 'register/signup_Affiliate', $attributes);
			?>

			<h3><strong>Login Information</strong></h3>

			<div class="form-group">
				<input type="hidden" name="code" value="<?php echo $code; ?>">
				<label for="username" class="col-sm-4 control-label">Username *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'uname', 'id' => 'uname', 'placeholder' => 'Enter Your Username', 'value' => set_value('uname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('uname');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="password" class="col-sm-4 control-label">Password *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('password');
					?>
					<p class="note">(Minumum 5 character and maximum 12 characters)</p>
				</div>
			</div>
			<div class="form-group">
				<label for="cpassword" class="col-sm-4 control-label">Confirm Password *</label>

				<div class="col-sm-8">

					<?php $data = array('name' => 'cpassword', 'type' => 'password', 'placeholder' => 'Re-enter Password', 'id' => 'cpassword', 'value' => set_value('cpassword'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('cpassword');
					?>
					<p class="note">(Minumum 5 character and maximum 12 characters)</p>
				</div>
			</div>


			<h3><strong>General Information</strong></h3>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">First Name *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'fname', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'value' => set_value('fname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('fname');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="lname" class="col-sm-4 control-label">Last Name *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'lname', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'value' => set_value('lname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('lname');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">E-mail *</label>

				<div class="col-sm-8">

					<?php $data = array('name' => 'email', 'readonly' => 'readonly', 'id' => 'email', 'value' => $email, 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('email');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Business Name </label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'bname', 'id' => 'bname', 'placeholder' => 'Enter Your Business Name', 'value' => set_value('bname'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('bname');
					?>
				</div>
			</div>

			<div class="form-group control-group">
				<label for="firstname" class="col-sm-4 control-label">Primary Contact No. *</label>

				<div class="col-sm-8 controls">
					<?php $data = array('name' => 'pcon', 'id' => 'pcon', 'placeholder' => 'Primary Contact No.', 'value' => set_value('pcon'), 'class' => 'form-control');
						echo form_input($data);
						echo form_error('pcon');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Secondary Contact No.</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'scon', 'id' => 'scon', 'placeholder' => 'Secondary Contact No.', 'value' => set_value('scon'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('scon');
					?>
					<p class="note">(Note: Contact number of referrer only.)</p>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Gender *</label>

				<div class="col-sm-4">

					<?php $options = array(
						// '' => 'Gender',
						'Male' => 'Male', 'Female' => 'Female',);
						echo form_dropdown('gender', $options, set_value('gender'), 'class="form-control"');
						echo form_error('gender');
					?>

				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Address *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'address', 'id' => 'address', 'placeholder' => 'Address', 'value' => set_value('address'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('address');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">City *</label>

				<div class="col-sm-8">

					<?php $data = array('name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'value' => set_value('city'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('city');
					?>
				</div>
			</div>

			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">State *</label>

				<div class="col-sm-4">
					<?php
						foreach ($states as $state) {
							$drop[$state->id] = $state->state;
						}
						$drop = array_merge(array('25' => 'Missouri'), $drop);
						echo form_dropdown('state', $drop, set_value('state'), 'class="form-control"');
						echo form_error('state');
					?>
				</div>
			</div>


			<div class="form-group">
				<label for="firstname" class="col-sm-4 control-label">Zip Code *</label>

				<div class="col-sm-8">
					<?php $data = array('name' => 'zip', 'id' => 'zip', 'placeholder' => 'Zip Code', 'value' => set_value('zip'), 'class' => 'form-control',);
						echo form_input($data);
						echo form_error('zip');
					?>
				</div>
			</div>


			<?php $data = array('name' => 'ssn', 'id' => 'ssn', 'placeholder' => 'Social Security Number', 'value' => set_value('ssn'), 'class' => 'form-control ssn',);
				echo form_input($data);
				echo form_error('ssn');
			?>
		</div>
	</div>


	<div class="form-group">
		<label for="firstname" class="col-sm-4 control-label">Date of Birth *</label>

		<div class="col-sm-8">
			<?php
				$data = array('name' => 'dob', 'id' => 'date', 'placeholder' => 'MM/DD/YYYY', 'value' => set_value('dob'), 'class' => 'form-control',);
				echo form_input($data);
				echo form_error('dob');
			?>

		</div>
	</div>


	<div class="form-group">
		<div class="col-sm-offset-4 col-sm-8">
			<?php
				$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default',);
				echo form_submit($data);
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