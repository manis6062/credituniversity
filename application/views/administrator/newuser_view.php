<style>
	.controls1 {
		width: 30%;
		float: left;
		margin-right: 17px;
		padding-top: 5px;
	}

	.form-horizontal .controls {
		margin-left: 100px;
	}

	.form-horizontal .controls2 {
		margin-left: 50px;
	}

	.controls1:last-child {
		margin: 0px;
	}

	.controls1 lavel {
		width: 95px;
	}

	.form-horizontal .control-label {
		width: 95px;
	}

	.box-content {
		padding-top: 25px;
	}

	.controls input,
	.controls textarea {
		width: 94%;
	}

	select {
		width: 98%;
		border-radius: 3px;
	}

	.form-horizontal .control-group {
		margin-bottom: 20px;
	}
</style>
<div id="content" class="span10">
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
			</div>
			<div class="box-content">
				<?php
					if (validation_errors()) {
						?>
						<div class="message error"><?php echo validation_errors(); ?></div>
						<?php
					}
				?>
				<?php
					$attributes = array('name' => 'userupdate', 'class' => 'form-horizontal box1 formular', 'id' => 'form');
					echo form_open(ADMIN_PATH . 'user/add', $attributes);
				?>
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">
								<?php
									$attributes = array(
										'class' => 'left',);
									echo form_label('Name (*):', 'username', $attributes);
								?>
							</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'user_name',
										'id' => 'user_name',
										'value' => set_value('user_name'),
										'class' => 'medium',
									);
									echo form_input($data);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Login Name (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'login_name',
										'id' => 'login_name',
										'value' => set_value('login_name'),
										'class' => 'medium',
									);
									echo form_input($data);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Password (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'login_pwd',
										'id' => 'login_pwd',
										'value' => '',
										'autocomplete' => 'off',
										'class' => 'medium',
									);
									echo form_password($data);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Confirm Password2 (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'passconf',
										'id' => 'passconf',
										'value' => '',
										'autocomplete' => 'off',
										'class' => 'medium',
									);
									echo form_password($data);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Status:</label>

							<div class="controls">
								<?php
									$extra = 'class="chzn-select medium select"';
									$options = array(
										'yes' => 'Yes',
										'no' => 'No',
									);
									echo form_dropdown('status', $options, set_value('status'), $extra);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType"> Type (*):</label>

							<div class="controls">
								<?php
									$extra = 'class="chzn-select medium select"';
									if ($this->session->userdata('role_id_session') == 5) {
										$options = array(
											'super-admin' => 'Super Admin',
											'admin' => 'Admin',
											'user' => 'User',
										);
									} else {
										$options = array(
											'super-admin' => 'Super Admin',
											'admin' => 'Admin',
											'user' => 'User',
										);
									}
									echo form_dropdown('user_type', $options, set_value('user_type'), $extra);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Phone (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'phone',
										'id' => 'phone',
										'value' => set_value('phone'),
										'class' => 'medium',
									);
									echo form_input($data);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType">Mobile (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'cell',
										'id' => 'cell',
										'value' => set_value('cell'),
										'class' => 'medium',
									);
									echo form_input($data);
								?>
							</div>
						</div>
					</div>
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType"> Email (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'email',
										'id' => 'email',
										'value' => set_value('email'),
										'class' => 'medium',
									);
									echo form_input($data);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span4">
						<div class="control-group">
							<label class="control-label" for="inputType"> Address (*):</label>

							<div class="controls">
								<?php
									$data = array(
										'name' => 'address',
										'id' => 'address',
										'value' => set_value('address'),
										'class' => 'medium',
										'rows' => '1',
									);
									echo form_textarea($data);
								?>
							</div>
						</div>
					</div>
				</div>
				<div class="row-fluid">
					<div class="span12">
						<div class="control-group">
							<label class="control-label" for="inputType">
								<?php
									$attributes = array(
										'class' => 'left',
									);
									echo form_label('Grant Access:', 'access', $attributes);
								?>
							</label>

							<div class="controls">
								<div>
									<input type="checkbox" id="selectall" name="selectall"
										   onclick="checkuncheckAll(this)"/>Select All
								</div>
								<?php foreach ($mas_auth as $value) { ?>
									<div style="float: left; width: 17%; margin-right: 20px;">
										<input type="checkbox" class="case" id="checkbox" name="auth_id[]"
											   value="<?php echo $value->auth_id; ?>"><?php echo $value->auth_label; ?>
									</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
				<table class="form">
					<tr>
						<td style="width: 95px">
							<label>
								&nbsp;</label>
						</td>
						<td>
							<?php
								$data = array(
									'name' => 'submit',
									'id' => 'submit',
									'value' => 'Save',
									'class' => 'btn btn-primary',
								);

								echo form_submit($data);
							?>
							<a href="<?php echo site_url(ADMIN_PATH . 'user'); ?>">
								<input type="button" class="btn btn-primary" value="Clear"/>
							</a>
						</td>
					</tr>

				</table>
				<?php
					echo form_close();
				?>


			</div>
		</div>

	</div>
</div>
</div>
<hr>