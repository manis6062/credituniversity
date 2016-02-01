


<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
?>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
                    </div>


<div class="box-content">
				<?php
                        if($this->session->flashdata('su_message'))
                        {
				?>
				<div class="message info">
					<p><?php echo $this->session->flashdata('su_message')?><
					p>
				</div>
				<?php }
				?>
				<table class="table table-striped table-bordered bootstrap-datatable datatable">

                            <thead>
                                <tr>
                                    
                                    <th>SN.</th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Receivable Amount<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Collectable Amount <?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Receivable Amount Date <?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Payment Status <?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Paid Date<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    
                                    
                                    
                                  
                                   
                                </tr>
                            </thead>    
                            <tfoot>
                            <tr>
                                <th colspan="4" style="text-align:center">Total:</th>
                                <th>$ <?php echo  $sumOfReceivableAmountLineOwner[0]['card_sell_cost'] * 0.8;?></th>
                                <th>$ <?php echo  $sumOfCollectableAmountLineOwner[0]['card_sell_cost'] * 0.8;?></th>
                                <th colspan="3"></th>

                            </tr>
                            </tfoot>
                            <tbody>
                            	  <?php if($clientlist!='' && count($clientlist)!=0){
							$count=1;
							foreach($clientlist as $key=>$val){?>
							
							<tr class="<?php
							if ($key % 2 == 0) {
								echo 'even';
							} else {
								echo 'odd';
							}
							?>">
								
								
								<td class=""><?php echo $count; ?></td>
								<td class=""><?php echo $val -> firstname . ' ' . $val -> lastname; ?></td>
								<td class""><?php echo $val -> type_id; ?></td>
								<td class""><?php echo $val -> card_name; ?></td>	
								<td class"">$ <?php echo $val -> card_sell_cost * 0.8; ?></td>
                                <?php if ($val->verify_status == 'verified') { ?>
                                    <td class"">$ <?php echo $val -> card_sell_cost * 0.8; ?></td> <?php } else { ?>
                                    <td class""></td> <?php } ?>
								<td class""><?php if($val -> card_sell_added_date){
									echo date('m/d/Y',strtotime($val -> card_sell_added_date));}
									?>
									
									</td>
								 <td>
								 <?php if($val->payment_status=="Unpaid")
								 {?>
								 	<a href="<?php echo site_url(ADMIN_PATH . 'lineowner/PaymentStatus/'  .$val->card_sell_id); ?>"  onclick="return confirm ('Are you sure <?php echo $val -> firstname . ' ' . $val -> lastname; ?> paid for this card?') "; title="Paid"> <?php echo $val -> payment_status;?></a>
								
								 <?php }
							else {
								echo "Paid";
							}
								 ?>
								</td>
								 <td class""><?php echo $val -> payment_paid_date_lineowner; ?></td>
								
								
													    
								    
								
								
							</tr>
							
							<?php
							$count++;
							}
							}
							?>
							
                          </tbody> 
                                                 
                        </table>  
    
                        </div>
                        </div> </div>
                  </div></div>
<hr>
                       