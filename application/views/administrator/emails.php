<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper bg-main">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			<i class="icon-edit"></i><?php echo $title; ?>
			<small>(Admin)</small>
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="box-body">
			<?php $attributes = array('class' => 'formular', 'id' => 'form');
			echo form_open_multipart(ADMIN_PATH . 'user/sendEmails', $attributes);
			?>
			<div class="form">

				<!-------------------------------- Select Roles --------------------------------->

					<label class="col-sm-2 control-label">Send Email To : </label>
					<div class="form-group">

						<?php
						if(!empty($roles)):

							foreach($roles as $key=>$val):?>
								<div class="col-sm-12">

									<?php
									$data = array(
										'name'        => 'roleid[]',
										'id'          => $val->value,
										'value'       => $val->id,

									);
									echo form_radio($data); ?>
									<label for="User" class=""><?php echo $val->label;?></label>
								</div>

								<script >
									$('input[id^="<?php echo $val->value ;?>"]').not('#checkbox_all').click(function () {
										$('#checkbox_all').prop('checked', false);
										var roleid = $(this).val();
										var location_url = '<?php echo base_url('administrator/user/emails') ?>' + '/' + roleid;

										$.ajax ({
											type: "POST",
											url: location_url,
											data: ({role_id:roleid}),
											success: function(roleid) {
												$('#changes').html($(roleid).find('#changes *'));
												console.log(roleid);
											}

										});

									});

								</script>

							<?php
							endforeach;


						endif;
						?>
					</div>


				<!-------------------------------- To Email --------------------------------->

					<div class="form-group">

						<div class="col-xs-4">
							<label class="">To (*):</label>
							<select id = "changes" name="toemails[]" class="form-control"  placeholder="Select Email IDs" multiple data-rel="chosen">
								<?php
								if(!empty($users)){
									foreach ($users as $key => $values) {?>
										<option value="<?php echo $values->email;?>"><?php echo $values->first_name;?> </option>
									<?php
									}
								}
								?>
							</select>
						</div>

					</div>

				<!-------------------------------- Subject --------------------------------->

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Subject (*):</label>
                            <input type="text" class="form-control"
                                   name="subject" required >
                        </div>
                    </div>

				<!-------------------------------- Cke Editor --------------------------------->

                    <div class="form-group">
                        <div class="col-xs-12">
                            <label>Message:</label>
                            <div class='box-body pad'>
                                <form>
                                    <textarea id="editor1" name="msg"
                                              rows="10" cols="80">
                                        This is my textarea to be replaced
                                        with CKEditor.
                                    </textarea>
                                </form>
                            </div>
                        </div>
                    </div>

				<?php
				$data = array('name' => 'submit', 'id' => 'submit', 'value' =>
					'Send Emails', 'class' => 'btn btn-primary', );
				echo form_submit($data);
				?>

                </div>
			<?php echo form_close(); ?>


      </div>

		<div class="box">
			<div class="box-header">
				<h4>
				   <small><?php echo $title2 ;?></small>
				</h4>


			</div><!-- /.box-header -->
			<div class="box-body">
				<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr role="row">
						<th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">#</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Receiver Type</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 194px;" aria-label="Platform(s): activate to sort column ascending"> Receivers</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Subject</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending"> Details</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending"> Sent Date</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending">Action</th>

					</tr>
					</thead>
					<tbody>
					<?php
					if ($sentemails != 0 && count($sentemails) > 0) {
						$count = 1;
						foreach ($sentemails as $key=> $values) {
							?>
							<tr role="row" class="odd">


								<td><?php echo $count; ?><input type="checkbox" name="msg[]" value="<?php echo $values->email_id; ?>" /></td>
								<td><?php echo $values->email_receiver_type;?></td>
								<td><?php echo $allreceivers;?></td>
								<td><?php echo $values -> email_subject; ?></td>
								<td><?php echo $values -> email_msg; ?></td>
								<td><?php echo $values -> email_date; ?></td>
								<td class="action">
									<?php
									if (in_array('email_view', $allowed)) {
										?>
										<a data-toggle="modal" href="#form-contentsender<?php echo $values->email_id;?>"><img src="<?php echo base_url(); ?>/style/img/email_view.png" alt="edit"></a>
									<?php } ?>
									<?php
									if (in_array('email_delete', $allowed)) {
										?>
										<a href="<?php echo site_url(ADMIN_PATH . 'affiliate/emailssenderdelete/' . $values -> email_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Email History');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
									<?php } ?>
								</td>
							</tr>
						<?php }} ?>
					</tbody>

				</table>


			</div><!-- /.box-body -->



		</div>



		<div class="box">
			<div class="box-header">
				<h4>
					<small><?php echo $title3 ;?></small>
				</h4>


			</div><!-- /.box-header -->
			<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
					<tr role="row" class="odd">
						<th class="sorting_desc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 180px;" aria-label="Rendering engine: activate to sort column ascending" aria-sort="descending">#</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 229px;" aria-label="Browser: activate to sort column ascending">Sender Type</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 194px;" aria-label="Platform(s): activate to sort column ascending">Sender</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 154px;" aria-label="Engine version: activate to sort column ascending">Subject</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending"> Details</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending">Date</th>
						<th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 111px;" aria-label="CSS grade: activate to sort column ascending">Action</th>

					</tr>
					</thead>
					<tbody>
					<?php
					if ($sentemails != 0 && count($sentemails) > 0) {
						$count = 1;
						foreach ($sentemails as $key=> $values) {
							?>
							<tr role="row" class="odd">
								<td><?php echo $count; ?><input type="checkbox" name="msg[]" value="<?php echo $values->email_id; ?>" /></td>
								<td><?php echo $values->email_receiver_type;?></td>
								<td><?php echo $allreceivers;?></td>
								<td><?php echo $values -> email_subject; ?></td>
								<td><?php echo $values -> email_msg; ?></td>
								<td><?php echo $values -> email_date; ?></td>
								<td class="action">
									<?php
									if (in_array('email_view', $allowed)) {
										?>
										<a data-toggle="modal" href="#form-contentsender<?php echo $values->email_id;?>"><img src="<?php echo base_url(); ?>/style/img/email_view.png" alt="edit"></a>
									<?php } ?>
									<?php
									if (in_array('email_delete', $allowed)) {
										?>
										<a href="<?php echo site_url(ADMIN_PATH . 'affiliate/emailssenderdelete/' . $values -> email_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Email History');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
									<?php } ?>
								</td>
							</tr>
						<?php }} ?>
					</tbody>

				</table>
			</div><!-- /.box-body -->
			</div>
		<!-- Your Page Content Here -->


	</section><!-- /.content -->




</div><!-- /.content-wrapper -->
<!-- CK Editor -->
<script
    src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="../../plugins/bootstrap-wysihtml5/bootstrap3-
wysihtml5.all.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });
</script>



</body>
</html>

