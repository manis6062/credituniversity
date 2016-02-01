<?php $allowed = $this->AuthModel->getAuth();
	$ts = $this->uri->total_segments();
	$offset = (is_numeric($this->uri->segment($ts))) ? $this->uri->segment($ts) : 0;
?>
<script type="text/javascript">
	function pageredirect(data, id) {
		window.location = "<?php echo base_url().'administrator/lineowner/view/';?>" + id + '#' + data;
	}
</script>
<div id="content" class="span10">

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
				<?php if ($usertype != 1 && $usertype != 3) { ?>
					<a href="<?php echo site_url(ADMIN_PATH . 'lineowner/add'); ?>" class="btn btn-primary">Add New
						Line Owner</a>
				<?php } ?>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
					<thead>
					<br/>
					<tr>
						<th>S.No.</th>
						<th>Line Owner<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Total Cards<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Receivable Amount<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Collectable Amount<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Payable Amount<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Email<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<th>Phone<?php echo '&nbsp;&nbsp;&nbsp'; ?><img
								src="<?php echo base_url(); ?>/style/img/sort.png"></th>
						<?php if ($usertype != 1) {
							echo "<th>Action</th>";
						} ?>
					</tr>
					</thead>

					<tfoot>
					<tr>
						<th colspan="3" style="text-align:center">Total:</th>
						<th>$ <?php echo $sumOfReceivableAmount[0]['card_sell_cost'] * 0.1; ?></th>
						<th>$ <?php echo $sumOfCollectableAmount[0]['card_sell_cost'] * 0.1; ?></th>
						<th>$ <?php echo $sumOfReceivableAmount[0]['card_sell_cost'] * 0.8; ?></th>
						<th colspan="3"></th>

					</tr>
					</tfoot>

					<tbody>
					<?php
						if ($ownerList != 0 && count($ownerList) > 0) {
							$count = 1;
							foreach ($ownerList as $values) {
								?>

								<tr class="item">
									<td><?php echo $count; ?></td>
									<td>
										<a href="<?php echo site_url(ADMIN_PATH . 'lineowner/view/' . $values->user_id); ?>"><?php echo $values->to_fname . ' ' . $values->to_mname . ' ' . $values->to_lname; ?></a>
									</td>

									<td><a title="Card Details"
										   href="<?php echo base_url() . 'administrator/lineowner/carddetails/' . $values->to_id . '/' . $values->to_fname . '_' . $values->to_lname; ?>"><?php echo $values->totalnumberofcards; ?></a>
									</td>
									<td>$ <?php echo $values->card_sell_cost * 0.1; ?></td>


									<?php
										if (!empty($values->verify_status)) { ?>
											<td>$ <?php echo $values->verify_status * 0.1; ?></td>
										<?php } else { ?>
											<td></td><?php

										} ?>


									<td>$ <?php echo $values->card_sell_cost * 0.8; ?></td>
									<td><?php echo $values->to_email; ?></td>
									<td><?php echo $values->to_pcon; ?></td>


									<?php if ($usertype != 1) { ?>
										<td class="action" style="width:100px">

											<?php echo '&nbsp';
												'&nbsp';
												'&nbsp';
												'&nbsp';
												'&nbsp';
												'&nbsp'; ?>
											<?php if (($values->totalnumberofcards) == 0) { ?>
												<a href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteLineowner/' . $values->to_id); ?>"
												   onclick="javascript:return confirm('Are you sure you want to delete this Line Owner?')"
												   title="Click to delete"> <img
														src="<?php echo base_url(); ?>/style/img/delete.png"
														alt="Delete Line Owner Details"></a>
											<?php } else { ?>
												<a onclick="javascript:return confirm('Delete the Cards Before Deleting Line Owner')"
												   title="Click to delete"> <img
														src="<?php echo base_url(); ?>/style/img/delete.png"
														alt="Delete Line Owner Details"></a>
											<?php } ?>


										</td>


									<?php } ?>
								</tr>
								<?php
								$count++;
							}
						}
					?>
					</tbody>
				</table>
			</div>

			<?php include 'newuser_view.php' ?>

		</div>
		<!--/span-->

	</div>
	<!--/row-->

</div>
</div>
<hr>