<script>
		function showClient(data) {
			
			window.location = "<?php echo base_url().'administrator/creditcard/addClientToCard/';?>"+data.value;
		// var dataString = 'cardid=' + data.value;
		// var controller = 'creditcard';
		// var base_url = '<?php echo base_url(); ?>';
			// $.ajax({
// 				
				// headers: {'Cookie': document.cookie},
				// type: "POST",
				// url: base_url+'administrator/' + controller + '/alreadyAddedClient',
				// data: dataString,
				// cache: true,
				// success: function(result) {
				// $('#addedclient').html(result);
				// }
			// });
			
			// $.ajax({
// 				
				// headers: {'Cookie': document.cookie},
				// type: "POST",
				// url: base_url+'administrator/' + controller + '/notAddedClient',
				// data: dataString,
				// cache: true,
				// success: function(result) {
				// $('#clientlist').html(result);
				// }
			// });
			
		}
</script>

<div id="content" class="span10">
	<div class="row-fluid ui-sortable">
		
		<?php          
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                            <?php
                            if (in_array('user_add', $authorities)) {
                                ?>
                                <a href="<?php echo site_url(ADMIN_PATH . ' /addAction'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <?php
                            $attributes = array('class' => 'formular', 'id' => 'form'); 
                            echo form_open_multipart(ADMIN_PATH . 'creditcard/addCheckedClientToCard', $attributes);
                        ?>
		
		
		
		
		<div class="box span8">
                    <div class="box-header well" data-original-title>
                        <h2><i class= "icon-user"></i> Lines</h2>
                        
                        
                    </div>
                    <div class="box-content">
                       <?php echo form_error('cardid[]'); ?>
                        
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Owner Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                   	<th> AU Added<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th> AU Pending<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                   
                                    <th>Type<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Card Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th> Card Age<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Closing Day<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>

                                    <th>Charge<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                   
                                </tr>
                            </thead>    
                            <tbody>
                                
                          <?php if($linecard!='' && count($linecard)!=0){
							
							foreach($linecard as $key=>$val){?>
							
							<tr class="<?php if($key%2 == 0){ echo 'even';}else{echo 'odd';}?>">
								<?php if(!empty($cardid)){?>
								<td><input type="radio" name="cardid[<?php echo $key?>]" value="<?php echo $val->card_id; ?>" <?php if($cardid == $val->card_id){echo 'checked="checked"';}?> onclick="showClient(this)" /></td>
								<?php } else{ ?>
									<td><input type="radio"  name="cardid[]" value="<?php echo $val->card_id; ?>"  onclick="showClient(this)" /></td>
								
								<?php } ?>
								<!-- <td class=""><input type="checkbox" name="cardid[<?php echo $key?>]" value="<?php echo $val->card_id?>"  <?php echo set_checkbox('cardid[<?php echo $key?>]', $val->card_id); ?> /> </td> -->
								<td class=""><?php echo $val->to_fname.' '.$val->to_lname;?></td>
								<td class="center sorting_1"><?php echo $val->card_sell_com;?></td>
            					<td class="center sorting_1"><?php echo $val->card_sell_pro;?></td>
								<td class=""><?php echo $val->card_name?></td>

								<td class="center sorting_1"><?php echo $val->type_id?></td>
								<!-- <td>
									<?php if(!empty($val->card_open_date)){
									$date2 = $val->card_open_date;
									$date1 = date('Y');
									$years = $date1 - $date2;
									echo $years.' years';
									}?>
								</td> -->
								<td class="">
								<?php if(!empty($val->card_open_date)){
								
									
									$date22 = date('d/m/Y', strtotime('01/'.$val->card_open_date));
									$date222 = date('m/d/Y', strtotime($date22));
									
					               	$date1 = date_create(date('m/d/Y'));
					               	$date2 = date_create($date222);
					               	$diff = date_diff($date2, $date1);
									$years = $diff->y;
									if($years!=0)
										echo $years.' years<br>';
									$months = $diff->m;
									if($months != 0)
										echo $months.' months';
								
								//echo $days = $diff12->d.'<br>';
								
								}?>
								</td>
								<td class="center"><?php echo $val->card_close_date;?></td>
								<td class=""> $ <input style="width: 30px;" type="text"  name="card_sell_cost[<?php echo $key?>]" value="<?php echo set_value('card_sell_cost[<?php echo $key?>]')?set_value('card_sell_cost[<?php echo $key?>]'):'100'; ?>"> <?php echo form_error('card_sell_cost[<?php echo $key?>]'); ?></td>

								<!-- <td class="center"><span class="label label-success">Active</span></td> -->
								<input type="hidden" name="to_id[<?php echo $key?>]" value = "<?php echo $val->to_id; ?>" >
								<input type="hidden" name="ref_id[<?php echo $key?>]" value = "<?php echo $val->referrer_id; ?>" >
                                <input type="hidden" name="broker_id" value = "<?php echo $broker_id; ?>" >

							</tr>
							<?php }
							}
							?>
							
                          </tbody>                        
                        </table>                     
                    </div>
                </div><!--/span-->
		
		
		
		<div class="box span4">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> Clients</h2>
                        
                    </div>
                   
                    <div class="box-content">
                       <?php echo form_error('clientid[]');?>
                       
                       
                        <table class="table table-striped table-bordered bootstrap-datatable datatable" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    
                                    <th>No. of Lines<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                </tr>
                            </thead> 
                               
                            <tbody>
                            <?php if($referrerClients !='' && count($referrerClients) != 0){
							
							foreach($referrerClients as $key=>$val){?>
								
					
							
							<tr class="<?php if($key%2 == 0){ echo 'even';}else{echo 'odd';}?>">
								<td class=""><input type="checkbox" name="clientid[]" value="<?php echo $val->id;?>"<?php echo set_checkbox('clientid[]', $val->id); ?> /> </td>
								<td class=""><?php echo $val->firstname.' '.$val->lastname?></td>
								<td class="center sorting_1"> <?php if ($val->noline != 0){ ?>

<button type="button" data-toggle="popover<?php echo $key;?>" data-placement="top" title="Line Lists" data-trigger="focus"
	data-content=" <ul><?php 
    foreach($cardinfo as $val1){
        if($val->id == $val1->client_id){
          ?><li><?php echo $val1->card_name ;if($val1->type_id){echo ' | '.$val1->type_id; }?></li>
          <?php 
        } 
    }
    ?>
</ul>" role="button" ><?php echo $val->noline; ?></button>  <?php }  ?>
    </td>
								
								
								
    
<script>
  $(function () {
  $('[data-toggle="popover<?php echo $key;?>"]').popover()
})

</script>
								
								
								
								
								
								
								
								<!-- <td class="center">Member</td>
								<td class="center"><span class="label label-success">Active</span></td> -->
							</tr>
							<?php }
							}
							?>
							
                          </tbody>     
                           
                        </table>                     
                    </div>
                    
                </div><!--/span-->
               
               <?php if(!empty($addedclientname)):
               	?>
               <div class="box span4" style="float:right;">
			
                                    <div class="box-header well" data-original-title>
                                        <h2><i class="icon-user"></i> Client Already in the Credit Card</h2>

                                    </div>
            <?php foreach($addedclientname as $val):                        
			
				
				echo '<div>' .$val->firstname.' '.$val->lastname.'</div>';
				
				endforeach
                ?>
               </div>
               <?php endif ?>
                	
                	
              
                
		
		<div class="clear"></div>
		<br>
		<div class="center">
		
		<?php 
                            $data = array('name' => 'send', 'id' => 'send', 'value' => 'Send Request to Line Owner', 'class' => 'btn btn-primary', );
                            echo form_submit($data); 
                            echo form_close();?>    
		</div>
	</div>
</div>
</div>
<hr>


