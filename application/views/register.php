sig<div class="main">
	<div class="wrap">
		<div class="section group">
			<div class="signup">
				<div class="cd-tabs">
					<nav>
						<ul class="cd-tabs-navigation">
							<li>
								<a data-content="client" <?php if (($this->session->flashdata('success_msg_affiliate')) || $test == 'affiliate') {
									echo '';
								} else {
									echo 'class="selected"';
								} ?> href="#">Client Registration</a></li>
							<li>
								<a data-content="affiliate" <?php if (($this->session->flashdata('success_msg_affiliate')) || $test == 'affiliate') {
									echo 'class="selected"';
								} ?> href="#">Partner Registration</a></li>

						</ul>
					</nav>

					<ul class="cd-tabs-content">
						<li data-content="client" <?php if (($this->session->flashdata('success_msg_affiliate')) || $test == 'affiliate') {
							echo '';
						} else {
							echo 'class="selected"';
						} ?>>
							<?php
								if (validation_errors() && $test != 'affiliate') {
									?>
									<div class="message error"><?php echo validation_errors(); ?></div>
									<?php
								}
							?>
							<?php
								if ($this->session->flashdata('su_message')) {
									?>
									<div class="message info">
										<p><?php echo $this->session->flashdata('su_message') ?></p>
									</div>
								<?php } ?>

							<?php $attributes = array('id' => 'login-form');
								echo form_open(base_url() . 'register/signup', $attributes);
							?>


							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('First Name:', 'firstname', $attributes);
								?>
								<?php
									$data = array('name' => 'firstname', 'id' => 'firstname', 'value' => set_value('firstname'), 'class' => 'inputbox',);
									echo form_input($data);
									//echo form_error('firstname');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Last Name:', 'lastname', $attributes);
								?>
								<?php
									$data = array('name' => 'lastname', 'id' => 'lastname', 'value' => set_value('lastname'), 'class' => 'inputbox',);
									echo form_input($data);
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Email Address:', 'email', $attributes);
								?>

								<?php
									$data = array('name' => 'email', 'id' => 'email', 'value' => set_value('email'), 'class' => 'inputbox',);
									echo form_input($data);
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Primary Contact No.:', 'mobile', $attributes);
								?>
								<?php
									$data = array('name' => 'mobile', 'id' => 'mobile', 'value' => set_value('mobile'), 'class' => 'inputbox',);
									echo form_input($data);
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Secondary Contact No.:', 'phone', $attributes);
								?>
								<?php
									$data = array('name' => 'phone', 'id' => 'phone', 'value' => set_value('phone'), 'class' => 'inputbox',);
									echo form_input($data);
								?>
							</p>

							<?php $attributes = array('class' => 'left',);
								echo form_label('SSN:', 'scn', $attributes);
							?>

							<?php
								$data = array('name' => 'scn', 'id' => 'scn', 'value' => set_value('scn'), 'class' => 'inputbox',);
								echo form_input($data);
								echo form_error('scn');
							?>
							</p>
							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('City:', 'city', $attributes);
								?>
								<?php
									$data = array('name' => 'city', 'id' => 'city', 'value' => set_value('city'), 'class' => 'inputbox',);
									echo form_input($data);
									echo form_error('city');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('State:', 'state', $attributes);
								?>
								<?php
									$data = array('name' => 'state', 'id' => 'state', 'value' => set_value('state'), 'class' => 'inputbox',);
									echo form_input($data);
									echo form_error('state');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Address:', 'address', $attributes);
								?>
								<?php
									$data = array('name' => 'address', 'id' => 'address', 'value' => set_value('address'), 'row' => '2', 'column' => '5', 'class' => 'inputbox',);
									echo form_textarea($data);
									echo form_error('address');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('DOB:', 'dob', $attributes);
								?>
								<?php
									$data = array('name' => 'dob', 'id' => 'dob', 'value' => set_value('dob'), 'class' => 'inputbox',);
									echo form_input($data);
									echo form_error('dob');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Zip:', 'zip', $attributes);
								?>
								<?php
									$data = array('name' => 'zip', 'id' => 'zip', 'value' => set_value('zip'), 'class' => 'inputbox',);
									echo form_input($data);
									echo form_error('zip');
								?>
							</p>


							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Password:', 'password', $attributes);
								?>

								<?php
									$data = array('name' => 'password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'inputbox',);
									echo form_password($data);
									echo form_error('password');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Confirm Password:', 'passconf', $attributes);
								?>

								<?php
									$data = array('name' => 'passconf', 'id' => 'passconf', 'value' => set_value('passconf'), 'class' => 'inputbox',);
									echo form_password($data);
									echo form_error('passconf');
								?>
							</p>

							<p id="login-form-username">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Comments:', 'comments', $attributes);
								?>

								<?php
									$data = array('name' => 'comments', 'id' => 'comments', 'value' => set_value('comments'), 'class' => 'inputbox',);
									echo form_textarea($data);
								?>
							</p> -->
							<p id="login-form-username">
								<?php
									$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'button',);
									echo form_submit($data);
								?>
							</p>

							<?php echo form_close(); ?>


						</li>

						<li data-content="affiliate" <?php if (($this->session->flashdata('success_msg_affiliate')) || $test == 'affiliate') {
							echo 'class="selected"';
						} ?>>

							<?php
								if (validation_errors() && $test == 'affiliate') {
									?>
									<div class="message error"><?php echo validation_errors(); ?></div>
									<?php
								}
							?>

							<?php
								if ($this->session->flashdata('success_msg_affiliate')) {
									?>
									<div class="message info">
										<p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
									</div>
								<?php } ?>
							<div id="loginbox" class="loginbox">
								<?php $attributes = array('id' => 'login-form');
									echo form_open(base_url() . 'register/signup_Affiliate', $attributes);
								?>


								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('First Name:', 'afname', $attributes);
									?>
									<?php
										$data = array('name' => 'afname', 'id' => 'afname', 'value' => set_value('afname'), 'class' => 'inputbox',);
										echo form_input($data);
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Last Name:', 'alname', $attributes);
									?>
									<?php
										$data = array('name' => 'alname', 'id' => 'alname', 'value' => set_value('alname'), 'class' => 'inputbox',);
										echo form_input($data);
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Email Address:', 'aemail', $attributes);
									?>

									<?php
										$data = array('name' => 'aemail', 'id' => 'aemail', 'value' => set_value('aemail'), 'class' => 'inputbox',);
										echo form_input($data);
										//echo form_error('aemail');
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Business Name:', 'abname', $attributes);
									?>
									<?php
										$data = array('name' => 'abname', 'id' => 'abname', 'value' => set_value('abname'), 'class' => 'inputbox',);
										echo form_input($data);
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Primary Contact No.:', 'apcon', $attributes);
									?>
									<?php
										$data = array('name' => 'apcon', 'id' => 'apcon', 'value' => set_value('apcon'), 'class' => 'inputbox',);
										echo form_input($data);
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Secondary Contact No.:', 'ascon', $attributes);
									?>
									<?php
										$data = array('name' => 'ascon', 'id' => 'ascon', 'value' => set_value('ascon'), 'class' => 'inputbox',);
										echo form_input($data);
									?>
								</p>

								<p id="login-form-username">
									<?php $attributes = array('class' => 'left',);
										echo form_label('Partner Type:', 'ascon', $attributes);
									?>

									<input type="radio" name="partner" value="referrer" class="inputradio"
										   checked="checked" style="margin-left: 100px;"/>referrer Partner
									<input type="radio" name="partner" value="branch" class="inputradio"/>Branch Partner

								</p>


								<p id="login-form-username">
									<?php
										$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'button',);
										echo form_submit($data);
									?>
								</p>

								<?php echo form_close(); ?>


							</div>

						</li>


					</ul>
				</div>
			</div>
		</div>
		<div class="clear"></div>
	</div>
</div>
</div>
<hr>