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
                            <th>Line Owner<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                             <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                               <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                           
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            <?php
                            $count = 1;
                             foreach ($totalPendingClients as $key => $values) { ?>
                                 <tr class="item">
                                <td><?php echo $count++;?></td>
                                  <td><?php echo $values->to_fname ." " .$values->to_mname ." ".$values->to_lname;?></td>
                                     <td><?php echo $values->firstname ." ". $values->lastname;?></td>
                                   <td><?php echo $values->type_id;?></td>
                                    <td><?php echo $values->card_name;?></td>
                                  
                            </tr>
                                
                      <?php      } ?>
                           
                           
                     </tbody>
                      </table>            
                    </div>

                </div><!--/span-->
            
            </div><!--/row-->
</div>
</div>
<hr>