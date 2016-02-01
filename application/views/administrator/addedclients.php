<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>

<div id="content" class="span10">

    <!-- content starts -->
    <div class="row-fluid">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                       
                             <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
                           
                     
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Line Owner<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                             <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                               <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Added Date <?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Action<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php 
                            $count = 1;
                             foreach ($totalAddedClients as $key => $values) { ?>
                                 <tr class="item">
                                 
                                <td><?php 
                                echo $count++; ?></td>
                                  <td><?php echo $values -> to_fname . " " . $values -> to_mname . " " . $values -> to_lname; ?></td>
                                     <td><?php echo $values -> firstname . " " . $values -> lastname; ?></td>
                                   <td><?php echo $values -> type_id; ?></td>
                                    <td><a href="<?php echo site_url(ADMIN_PATH .'creditcard/creditCardClients/' . $values->to_id . '/' . $values->card_id .'/'. $values->to_fname );?>" ><?php echo $values -> card_name; ?> </a></td>
                                     <td><?php echo $values -> card_sell_added_date; ?></td>
                                        <td class="center sorting_1">
<?php  if ($values->verify_status == 'verify_ref' && $values->card_sell_status != "process")
{ ?>
<a href="<?php echo site_url(ADMIN_PATH .'client/verifyActionFromAddedClients/'.$values->card_sell_id );?>" class="btn btn-danger">Verify</a>
<a href="<?php echo site_url(ADMIN_PATH .'client/changeStatusToVerifiedFromAddedClients/'. $values->card_sell_id );?>" onclick = "return confirm('Are you sure to confirm ?')"class="btn btn-success">Confirm Verified</a>
<?php  } ?>

<?php  if ($values->verify_status == 'confirm_verify')
{ ?>
<a href="<?php echo site_url(ADMIN_PATH .'client/changeStatusToVerifiedFromAddedClients/'. $values->card_sell_id );?>" class="btn btn-success">Confirm Verified</a>
<?php  } ?>
    
   
   <?php 
if ($values->verify_status == 'verified')
{ ?>
<a href="#" class="btn btn-success">Verified</a>
        
        
   <?php  }  ?>
                                       
                                       
                                        
                                       <?php  if($values->card_sell_status == "process"){
                                                 echo "Pending From TO";                                             
                                        } 
                                       elseif ($values->verify_status == "verify_to") {
                                            echo "verifying From TO";
                                       }
                                        ?>
                                    
                                     </td>
                            </tr>
                                
                      <?php  } ?>
                                  
                           
                     </tbody>
                      </table>            
                    </div>

                </div><!--/span-->
            
            </div><!--/row-->
</div>
</div>
<hr>