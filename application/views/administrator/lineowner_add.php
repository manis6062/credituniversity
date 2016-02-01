<script type="text/javascript">
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
			if ($(this).attr("value") == "square_cash") {
				$(".box22").hide();
				//$(".blue").show();
			}


		});
	});


	jQuery(function ($) {
		$("#pcon").mask("(999) 999-9999", {placeholder: " "});
		// $("#cscore").mask("999",{placeholder:" "});
		$("#to_transunion").mask("999", {placeholder: " "});
		$("#to_equifax").mask("999", {placeholder: " "});
		$("#to_experion").mask("999", {placeholder: " "});
		$("#to_ssn_no").mask("999-999-9999", {placeholder: " "});
	});


</script>

<style type="text/css">
	.box22 {
		float: right;
		display: none;
		width: 200px;
	}
</style>


<div id="content" class="span10">
	<?php
		if ($usertype != 1 && $usertype != 3) {
			?>

			<!-- content starts -->
			<div class="row-fluid">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
					</div>
					<div class="box-content">
						<?php
							if (validation_errors()) {
								?>
								<div class="message error"></div>
							<?php } ?>
						<?php $attributes = array('class' => 'formular');
							if (!empty($photoRecord)) {
								echo form_open(ADMIN_PATH . 'lineowner/update', $attributes);
							} else {
								echo form_open(ADMIN_PATH . 'lineowner/addAction', $attributes);
							}
						?>
						<table class="form">
							<!-- <p style="color:red;">(Fields marked with '*' are required.)</p> -->

							<!-- <tr>
										<td class="col1" colspan="2">
										 <h2>Login Information</h2>

										</td>

									</tr>

							<tr> -->
							<td class="col1">
								<label>Username <strong class="red">*</strong></label>
							</td>
							<td class="col2">
								<input type="hidden" name="ref_id" value="<?php echo $ref_id ?>">
								<?php $data = array('name' => 'uname', 'id' => 'uname', 'placeholder' => 'Enter Your Username', 'value' => set_value('uname'), 'class' => 'form-control',);
									echo form_input($data);
									echo form_error('uname');
								?>
								<p></p>
							</td>
							</tr>


							<tr>
								<td class="col1">
									<label>Password <strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control');
										echo form_input($data);
										echo form_error('password');
									?>
									<p class="note">(Minumum 5 character and maximum 12 characters)</p>
								</td>
							</tr>


							<tr>
								<td class="col1">
									<label>Confirm Password<strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'cpassword', 'type' => 'password', 'placeholder' => 'Re-enter Password', 'id' => 'cpassword', 'value' => set_value('cpassword'), 'class' => 'form-control');
										echo form_input($data);
										echo form_error('cpassword');
									?>
									<p class="note">(Minumum 5 character and maximum 12 characters)</p>
								</td>
							</tr>

							<!-- <tr>
								<td class="col1" colspan="2">
								 <h2>General Information</h2>
								</td>

							</tr> -->

							<tr>
								<td class="col1">
									<label>First Name <strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'fname', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'value' => set_value('fname'), 'class' => 'form-control',);
										echo form_input($data);
										echo form_error('fname');
									?>
									<p></p>
								</td>
							</tr>

							<tr>
								<td class="col1">
									<label>Middle Name </label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'mname', 'id' => 'mname', 'placeholder' => 'Enter Middle Name', 'value' => set_value('mname'), 'class' => 'form-control',);
										echo form_input($data);
										echo form_error('mname');
									?>
									<p></p>


							<tr>
								<td class="col1">
									<label>Last Name <strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'lname', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'value' => set_value('lname'), 'class' => 'form-control',);
										echo form_input($data);
										echo form_error('lname');
									?>
									<p></p>
								</td>
							</tr>

							<tr>
								<td class="col1">
									<label>E-mail <strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'email', 'placeholder' => 'Enter Email Address', 'id' => 'email', 'value' => set_value('email'), 'class' => 'form-control',);
										echo form_input($data);
										echo form_error('email');
									?>
									<p></p>
								</td>
							</tr>

							<!-- <tr>
		                    <td class="col1">
		                     <label>Business Name </label> 
		                    </td>
		                    <td class="col2">
		                    <?php $data = array('name' => 'bname', 'id' => 'bname', 'placeholder' => 'Enter Your Business Name', 'value' => set_value('bname'), 'class' => 'form-control',);
								echo form_input($data);
								echo form_error('bname');
							?>
							<p></p>
		                    </td>
		                </tr> -->

							<tr>
								<td class="col1">
									<label>Contact No. </label>
								</td>
								<td class="col2">
									<?php $data = array('name' => 'pcon', 'id' => 'pcon', 'placeholder' => 'Primary Contact No.', 'value' => set_value('pcon'), 'class' => 'form-control');
										echo form_input($data);
										echo form_error('pcon');
									?>
									<p></p>
								</td>
							</tr>


							<!-- <tr>
		                    <td class="col1">
		                     <label>Address * </label> 
		                    </td>
		                    <td class="col2">
		                   <?php $data = array('name' => 'address', 'id' => 'address', 'placeholder' => 'Street, Unit, State, Zip Code', 'value' => set_value('address'), 'class' => 'form-control',);
								echo form_input($data);
								echo form_error('address');
							?>
							<p></p>
		                    </td>
		                </tr> -->


							<tr>
								<td class="col1" align="">
									<label>Credit Score</label>
								</td>
								<td class="col2">
									<p>
										<!-- <?php $data = array('name' => 'to_ssn_no', 'id' => 'to_ssn_no', 'placeholder' => 'SSN No.', 'value' => set_value('to_ssn_no'), 'class' => 'form-control',);
											echo form_input($data);
											echo form_error('to_ssn_no');
										?> -->


										<label>Transunion</label>
										<?php $data = array('name' => 'to_transunion', 'id' => 'to_transunion', 'placeholder' => 'Transunion', 'value' => set_value('to_transunion'), 'class' => 'form-control',);
											echo form_input($data);
											echo form_error('to_transunion');
										?>

										<label>Equifax</label>
										<?php $data = array('name' => 'to_equifax', 'id' => 'to_equifax', 'placeholder' => 'Equifax', 'value' => set_value('to_equifax'), 'class' => 'form-control',);
											echo form_input($data);
											echo form_error('to_equifax');
										?>


										<label>Experion</label>
										<?php $data = array('name' => 'to_experion', 'id' => 'to_experion', 'placeholder' => 'Experion', 'value' => set_value('to_experion'), 'class' => 'form-control',);
											echo form_input($data);
											echo form_error('to_experion');
											echo form_error('data_you_want_to_validate_together');
										?>

									</p>
								</td>
							</tr>


							<!--	<tr>
		                    <td class="col1">
		                     <label>Credit Score *</label> 
		                    </td>
		                    <td class="col2">
		                   	<?php $data = array('name' => 'cscore', 'id' => 'cscore', 'placeholder' => 'Credit Score', 'value' => set_value('cscore'), 'class' => 'form-control',);
								echo form_input($data);
								echo form_error('cscore');
							?>
							<p></p>
		                   	</td>
		                </tr>
		                      -->
							<tr>
								<td class="col1">
									<label>Payment Type <strong class="red">*</strong></label>
								</td>
								<td class="col2">
									<input type="radio"
										   name="payment" <?php echo set_value('payment') == 'cash' ? 'checked' : ''; ?>
										   value="cash"/>Cash &nbsp; &nbsp; &nbsp;
									<input type="radio"
										   name="payment" <?php echo set_value('payment') == 'cheque' ? 'checked' : ''; ?>
										   value="cheque"/>Cheque &nbsp; &nbsp; &nbsp;
									<input type="radio"
										   name="payment" <?php echo set_value('payment') == 'paypal' ? 'checked' : ''; ?>
										   value="paypal"/>Paypal &nbsp; &nbsp; &nbsp;
									<input type="radio"
										   name="payment" <?php echo set_value('payment') == 'square_cash'; ?> checked
										   value="square_cash"/>Square Cash <br>

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


									<p></p>
								</td>
							</tr>

							<!-- <tr>
		                    <td class="col1">
		                     <label>Note </label> 
		                    </td>
		                    <td >
		                   	<?php $data = array('name' => 'note', 'id' => 'note', 'placeholder' => 'Note', 'value' => set_value('note'), 'class' => 'form-control',);
								echo form_textarea($data);
								echo form_error('note');
							?>
							<p></p>
		                   	</td>
		                </tr> -->


							<tr>
								<td class="col1">
									<label></label>
								</td>
								<td class="col2">
									<?php
										$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default',);
										echo form_submit($data);
										echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp';
									?>

									<a href="<?php echo site_url(ADMIN_PATH . 'lineowner'); ?>"
									   class="btn btn-default">Cancel</a>
								</td>
							</tr>


							<!-- <tr>
                    <td class="col1" >
                        <?php $attributes = array('class' => 'left',);
								echo form_label('Payment Type (*):', 'payment', $attributes);
							?>
                    </td>
                    <td class="col2">
                        <?php
								if (!empty($photoRecord)) {
									$data = array('name' => 'phone', 'class' => 'medium', 'required' => 'required', 'id' => 'phone', 'value' => set_value('phone') == "" ? $photoRecord->line_owner_phone : set_value('phone'),);
								} else {
									$data = array('name' => 'phone', 'class' => 'medium', 'required' => 'required', 'id' => 'phone', 'value' => set_value('phone'),);
								}
								echo form_input($data);
							?>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <label>
                            &nbsp;</label>
                    </td>
                    <td>
                        <?php
								if (!empty($photoRecord)) {
									$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary',);
								} else {
									$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary',);
								}
								echo form_submit($data);
							?>
                    </td>
                </tr> -->
						</table>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		<?php } ?>
</div>
</div>
<hr>