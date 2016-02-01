<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<script type="text/javascript">
	function pageredirect(data, id) {
	 	window.location = "<?php echo base_url().'administrator/affiliate/view/';?>"+id+'#'+data;
	}
</script>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title;?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if ($this->session->flashdata('su_message')) {
                            ?>
                            <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                            <?php } ?>
                        <a href="<?php echo site_url(ADMIN_PATH . 'affiliate/add'); ?>" class="btn btn-primary">Add New referrer</a>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>referrer Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Business<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Primary Contact<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Secondary Contact<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Email Address<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                     <th>T O <?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Payment Status<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Action</th>
                                </tr>
                            </thead>    
                            <tbody>
                            <?php
			                    if ($affiliateList != 0 && count($affiliateList) > 0) {
			                        $count = 1;
			                        foreach ($affiliateList as $values) {
			                            ?>
			                            <tr class="item">
			                                <td><?php echo $count; ?></td>
			                                <td><?php if (in_array('referrer_update', $allowed)) { ?>
			                                			<a href="<?php echo site_url(ADMIN_PATH . 'affiliate/view/' . $values -> user_id); ?>" title="Click to edit"> 
			                                				<?php echo $values -> affiliate_fname.' '.$values->affiliate_lname; ?>
			                                			</a>
			                               		<?php }else{ echo $values -> firstname.' '.$values->lastname; }?>		 			
			                                </td>
			                                <!-- <td><?php echo $values -> scn; ?></td> -->
			                                <td><?php echo $values -> affiliate_business; ?></td>
			                                <td><?php echo $values -> affiliate_primary_contact; ?></td>
			                                <td><?php echo $values -> affiliate_secondary_contact; ?></td>
			                                <td><?php echo $values -> affiliate_email; ?></td>
			                                  <td><?php echo $values -> nolineowner; ?></td>
			                                <td><?php echo $values -> affiliate_payment_status; ?></td>
			                              
			                                <td class="action">
			                                    <!-- <?php
			                                    if (in_array('client_update', $allowed)) {
			                                        ?>
			                                        <a href="<?php echo site_url(ADMIN_PATH . 'client/updateAction/' . $values -> id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
			                                        <?php } ?>
			                                    <?php
			                                    if (in_array('client_delete', $allowed)) {
			                                        ?>
			                                        <a href="<?php echo site_url(ADMIN_PATH . 'client/deleteAction/' . $values -> id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
			                                        <?php } ?>	 -->	
			                                     <!-- <select style="width:80px;" onchange="pageredirect(this.value, <?php echo $values->user_id;?>)">
													  <option value="">Select</option>
													  <option value="employment">Employment</option>
													  <option value="billing">Billing</option>
													  <option value="credit">Credit Credentials</option>
													  <option value="portal">Portal</option>
													  <option value="status">Status</option>
													  <option value="Monthly Instructions">Monthly Instructions</option>
													  <option value="Send Email">Send Email</option>
													  <option value="referrer Agent">referrer Agent</option>
													  <option value="Attachments">Attachments</option>
													  <option value="Comments">Comments</option> 
													</select>    -->  
										
	
<?php 
if(($values -> nolineowner) == 0 ) { ?>
    
    <a href="<?php echo site_url(ADMIN_PATH . 'affiliate/deleteAction/' .$values -> affiliate_id); ?>"  onclick="javascript:return confirm('Are you sure you want to delete this referrer?')" title="Click to delete"> <img src="<?php echo base_url(); ?>/style/img/delete.png" alt="Delete referrer"></a>

<?php  } else { ?>
    
    
  

  <a  onclick="javascript:return confirm('First Delete The line owners under this referrer.')" title="Delete the line owners first"> <img src="<?php echo base_url(); ?>/style/img/delete.png" "></a>
<?php }  ?>									
										
										
										
										
										
										
													
                            
			                                </td>    
			                            </tr>
			                            <?php
										$count++;
										}
										}
			                    ?>
                          </tbody>                        
                        </table>                     
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>
</div>
<hr>