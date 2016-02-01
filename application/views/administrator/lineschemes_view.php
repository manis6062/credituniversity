<?php
	$ts = $this->uri->total_segments();
	$offset = (is_numeric($this->uri->segment($ts))) ? $this->uri->segment($ts) : 0;
	$CI = &get_instance(); ?>
<div id="content" class="span10">
	<?php if ($usertype == 2 && $flag == 'scheme') { ?>
		<div class="row-fluid">
			<div class="box span12">
				<div class="box-header well" data-original-title>
					<h2><i class="icon-edit"></i><?php echo $title1; ?></h2>
				</div>
				<div class="box-content">
					<?php
						if (validation_errors()) {
							?>
							<div class="message error"><?php echo validation_errors(); ?></div>
						<?php } ?>
					<?php
						if ($error) {
							?>
							<div class="message error">
								<?php
									foreach ($error as $value) {
										echo $value;
									}
								?>
							</div>
						<?php } ?>
					<?php $attributes = array('class' => 'formular', 'id' => 'form');
						echo form_open_multipart(ADMIN_PATH . 'line/generatescheme', $attributes);
					?>
					<table class="form">
						<strong>Card Type</strong>: <?php echo $getdetailsofcard->type_id; ?><br/>
						<strong>Card Issued Bank</strong>: <?php echo $getdetailsofcard->card_issuing_bank; ?><br/>
						<strong>Card Number</strong>: <?php echo $getdetailsofcard->card_number; ?><br/>
						<!-- <strong>Card Expiration Date</strong>: <?php echo $getdetailsofcard->expiration_date; ?><br/> -->
						<strong>Card Limit</strong>: $<?php echo $getdetailsofcard->card_limit; ?><br/>
						<strong>Card Selling Limit</strong>: $<?php echo $getdetailsofcard->card_selling_limit; ?><br/>
						<strong>Available Limit for Scheme</strong>: $<?php echo $availableamountforscheme; ?><br/>

						<p style="color:red;">(Fields marked with '*' are required.)</p>
						<tr>
							<td class="col1">
								<?php $attributes = array('class' => 'left',);
									echo form_label('Schemes (*):', 'schemes', $attributes);
								?>
							</td>
							<td class="col2">
								<div id="addinputscheme">
									<p>&nbsp;&nbsp;<input type="number" id="p_new" size="20" name="amount[]" required
														  value="" placeholder="Scheme Amount"/><input type="number"
																									   id="p_new"
																									   size="20"
																									   name="charge[]"
																									   required value=""
																									   placeholder="Scheme Charge"/><a
											class="btn btn-default dynamic" href="#" id="addNewscheme">+</a></p>
								</div>
								<input type="hidden" id="card_detail_id" name="card_detail_id"
									   value="<?php echo $card_detail_id; ?>">
							</td>
						</tr>
						<tr>
							<td>
								<label>
									&nbsp;</label>
							</td>
							<td>
								<?php
									$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Generate', 'class' => 'btn btn-primary',);
									echo form_submit($data);
									// $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-primary', );
									// echo form_reset($data);
								?>
							</td>
						</tr>
					</table>
					<?php echo form_close(); ?>
					<a href="<?php echo base_url() . 'administrator/lineowner/carddetails/' . $owner_id . '/' . str_replace(" ", "_", $owner_name); ?>">Back
						To Card Details</a>
				</div>
			</div>
			<!--/span-->

		</div><!--/row-->
	<?php } ?>
	<!-- content starts -->
	<div class="row-fluid">
		<div class="box span12">
			<div class="box-header well" data-original-title>
				<h2><i class="icon-user"></i> <?php echo $title; ?></h2>
			</div>
			<div class="box-content">
				<?php
					if ($this->session->flashdata('su_message')) {

						?>
						<div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div>
					<?php } ?>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Card Type</th>
						<th>Card Issued Bank</th>
						<?php if ($usertype == 2) {
							echo "<th>Line Owner Name</th>";
							// echo "<th>Line Owner Address</th>";
							// echo "<th>Line Owner Email</th>";
							// echo "<th>Card Number</th>";
							echo "<th>Card Limit</th>";
							echo "<th>Card Selling Limit</th>";
						} ?>
						<th>Scheme Available Limit</th>
						<th>Scheme Charge</th>
						<!-- <?php if ($usertype == 1) {
							echo "<th>Action</th>";
						} ?> -->
					</tr>
					</thead>
					<tbody>
					<?php
						if ($schemeList != 0 && count($schemeList) > 0) {
							$count = 1;
							foreach ($schemeList as $values) {
								?>
								<tr class="item">
									<td><?php echo $count; ?></td>
									<td><?php echo $values->type_id; ?></td>
									<td><?php echo $values->card_issuing_bank; ?></td>
									<?php if ($usertype == 2) { ?>
										<td><?php echo $values->line_owner_name; ?></td>
										<!-- <td><?php echo $values->line_owner_address; ?></td>
                                	<td><?php echo $values->line_owner_email; ?></td>
                                	<td><?php echo $values->card_number; ?></td> -->
										<td>$<?php echo $values->card_limit; ?></td>
										<td>$<?php echo $values->card_selling_limit; ?></td>
									<?php } ?>
									<td>$<?php echo $values->scheme_limit; ?></td>
									<td>$<?php echo $values->scheme_charge; ?></td>
									<!-- <?php if ($usertype == 1){ ?>
                                	<td class="action" style="width:100px">
		                               <!-- <a href="<?php echo site_url(ADMIN_PATH . 'chooseandcharge/updateAction/' . $values->id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a>
		                               <a href="<?php echo site_url(ADMIN_PATH . 'chooseandcharge/deleteAction/' . $values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
		                               <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/view/' . $values->owner_id); ?>"><img src="<?php echo base_url(); ?>/style/img/view.png" alt="delete"></a> -->
									<!--</td>
                                <?php } ?>-->
								</tr>
								<?php
								$count++;
							}
						}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<!--/span-->

	</div>
	<!--/row-->
</div>
</div>
<hr>