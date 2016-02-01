<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<!-- <script type="text/javascript">
    function pageredirect(data, id) {
        window.location = "<?php echo base_url().'administrator/lineowner/view/';?>"+id+'#'+data;
    }
</script> -->
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
                             <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
                            <?php } ?>
                      
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>

                        <tr>
                            <th>S.No.</th>
                            <th>Line Owner<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Client<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Returned Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                             <th>Note<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>

                            <?php if($user_type_role!=1){
                            	echo "<th>Action</th>";
                            }?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if( $returned_client_list !=0 && count($returned_client_list) > 0)
                        {
                            $count=1;
                            foreach($returned_client_list as  $values)
                            {
                            ?>
                            
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $values -> to_fname ." " .$values -> to_mname ." ".$values -> to_lname ;?></td>
                                <td><?php echo $values -> card_name ;?></td>
                                <td><?php echo $values -> type_id ;?></td>
                                <td><?php echo $values -> firstname ." " .$values -> lastname ;?></td>
                                 <td><?php echo $values -> return_date;?></td>
                                  <td><?php echo $values -> return_note;?></td>

                         <td>   <?php  if($user_type_role!=1){?>
   <a  class="btn btn-success" href ="<?php echo site_url(ADMIN_PATH . 'creditcard/returned')?>"  onclick="javascript:return confirm('Do You Want To Add This Client?')" title="Click to ADD">ADD</a>
	                                </td> 
	                              
	                                
	                                
	                                
                                <?php  }?>    
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