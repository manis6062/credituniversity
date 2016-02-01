<?php 
    $CI = &get_instance();
?>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>js/admin/editable/jquery.mockjax.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/backend/bootstrap-editable.css" media="all" />




<div id="content" class="span10">

		<div class="box span6">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title?></h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                               
                                    <th>SN.</th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>No. of Lines<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <!-- <th>Action</th> -->
                                  
                                   
                                </tr>
                            </thead>    
                            <tbody>
                                <?php
                                if(!empty($addedClientList)){
                                     $count = 1;
                                 foreach ($addedClientList as $key => $values) { ?>
                      
                                   <tr class="item">
                            <td class="center sorting_1"><?php echo $count++; ?></td>
                            <td class="center sorting_1"><?php echo $values->firstname ."" . $values->lastname ;?></td>
                            <td class="center sorting_1"> 
                                <?php 
                         
                                if ($values -> countcard != 0){ ?>

<button type="button" data-toggle="popover<?php echo $key;?>" data-placement="top" title="Line Lists" data-trigger="focus"
    data-content="<ul><?php foreach($cardinfocom as $val)
    {
    if($values->id == $val->client_id){?>
    <li><?php echo $val->card_name ;if($val->type_id){echo ' | '.$val->type_id; }?></li>
          <?php } }
    ?>
</ul>" role="button" ><?php echo $values -> countcard; ?></button>  <?php } ?>
    
<script>
  $(function () {
  $('[data-toggle="popover<?php echo $key;?>"]').popover()
})
</script>
</td>
                            
<!-- <td class="center sorting_1">
  <?php 
  if ($values -> countcard == 0){ ?>
 <a onclick="return confirm("Make Sure Before You Delete This Record")" href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction1/' . $val->card_sell_id.'/'.$val->card_id); ?>" class="btn btn-danger" >Remove</a>
  <?php } ?>
 <a class="btn btn-primary" href="<?php echo site_url(ADMIN_PATH . 'lineowner/notAddedClients1/' . $val->card_sell_id.'/'.$val->card_id . '/' . $val->client_id); ?>"  onclick="return confirm('Are you sure you do not want to add ?')">Not Added</a>
  
  <?php  if ($values->verify_status == 'verify_to') { ?>
  
  <input type="button" class="btn btn-primary"  value="Verify"  />
   <?php } ?>
  </td> -->
                               
                                      
                                       
                          
                             
                             </tr> 
                             <?php  } } ?>
                                 
                          </tbody> 
                        </table>  
                        
                    </div>
                </div><!--/span-->
                
                    <div class="box span6">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title1?></h2>
                    </div>
                    <div class="box-content">
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                               
                                    <th>SN.</th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>No. of Lines<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <!-- <th>Action</th> -->
                                  
                                   
                                </tr>
                            </thead>    
                            <tbody>
                                <?php
                                if(!empty($pendingClientList)){
                                     $count = 1;
                                 foreach ($pendingClientList as $key => $val) { ?>
                      
                                   <tr class="item">
                            <td class="center sorting_1"><?php echo $count++; ?></td>
                            <td class="center sorting_1"><?php echo $val->firstname ."" . $val->lastname ;?></td>
                            <td class="center sorting_1"> 
                                <?php 
                         
                                if ($val -> countcard != 0){ ?>

<button type="button" data-toggle="popover1<?php echo $key;?>" data-placement="top" title="Line Lists" data-trigger="focus"
    data-content="<ul><?php foreach($cardinfopro as $values)
    {
    if($val->id == $values->client_id){?>
    <li><?php echo $values->card_name ;if($values->type_id){echo ' | '.$values->type_id; }?></li>
          <?php } }
    ?>
</ul>" role="button" ><?php echo $val -> countcard; ?></button>  <?php } ?>
    
<script>
  $(function () {
  $('[data-toggle="popover1<?php echo $key;?>"]').popover()
})
</script>
</td>
                            
<!-- <td class="center sorting_1">
  <?php 
  if ($values -> countcard == 0){ ?>
 <a onclick="return confirm("Make Sure Before You Delete This Record")" href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction1/' . $val->card_sell_id.'/'.$val->card_id); ?>" class="btn btn-danger" >Remove</a>
  <?php } ?>
 <a class="btn btn-primary" href="<?php echo site_url(ADMIN_PATH . 'lineowner/notAddedClients1/' . $val->card_sell_id.'/'.$val->card_id . '/' . $val->client_id); ?>"  onclick="return confirm('Are you sure you do not want to add ?')">Not Added</a>
  
  <?php  if ($values->verify_status == 'verify_to') { ?>
  
  <input type="button" class="btn btn-primary"  value="Verify"  />
   <?php } ?>
  </td> -->
                    <!-- <?php if ($val -> countcard == 0) { ?>
                                <a class="btn btn-danger" href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction1/' . $val->card_sell_id.'/'.$val->card_id . '/' . $val->id); ?>"  onclick="return confirm('Are you sure you do not want to remove  ?');">Remove</a></td> -->
                            <!-- <?php } ?>    -->         
                                 
                                       
                          
                             
                             </tr> 
                             <?php  } } ?>
                                 
                          </tbody> 
                        </table>  
                        
                    </div>
                </div><!--/span-->
  
	
</div><!--/#content.span10-->
</div>
<hr>




