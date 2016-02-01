<?php 
    $CI = &get_instance();
?>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>js/admin/editable/jquery.mockjax.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/backend/bootstrap-editable.css" media="all" />


<div id="content" class="span10">
	<!-- content starts -->
	
	<div class="sortable row-fluid ui-sortable">
	<?php foreach($cardList as $key => $val){?>	
		<div class="span3">	
    <a data-rel="tooltip" class="well top-block" href="<?php echo site_url(ADMIN_PATH.'lineowner/addClientToCard/'.$val->card_id)?>" data-original-title="<?php echo $val -> nocard; ?> new Client Need to be Added">
     <span class="icon32 icon-red icon-user"></span>
     <div><?php echo $val->card_name?></div>
     <div><?php echo $val->type_id?></div>
     <!-- <div><?php echo $val->card_auth_no?></div> -->
     <?php if($val->nocard !=0){?> <span class="notification red"><?php echo $val -> nocard; ?></span><?php }?>
    </a>
    
    <a href="<?php echo site_url(ADMIN_PATH.'lineowner/addedClients/'.$val->card_id)?>">
     
     
     <div class="well top-block">Total Added Client (10/<?php echo $val->card_auth_no?>)</div>
   
    </a>
   </div>
    <?php } ?>

   
   </div>
   
   
		
		
		<div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title?></h2>
                        
                        
                    </div>
                    <div class="box-content">
                       
                       <div class="left">
                       	
                       	<?php
		    if (validation_errors()) {
				echo form_error('cardsellid[]');
			}
			
		                            if ($this->session->flashdata('su_message')) {
		                                ?>
		                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
		                                <?php } ?>
		                          
		                        <?php $attributes = array('class' => 'formular', 'id' => 'form');
									echo form_open_multipart(ADMIN_PATH . 'lineowner/deleteMultipleAction', $attributes);
		                        ?>
                       	
		
							<?php 
							    
							
							$data = array('name' => 'send', 'onclick' => "return confirm('Are You Sure You Want To Delete This Record ?')" , 'id' => 'send', 'value' => 'Delete', 'class' => 'btn btn-primary', );
								echo form_submit($data);
								
							?>    
							</div>  
		
		        
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>SSN<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>DOB<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <!-- <th>Expired Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th> -->
                                    <th>Added Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Action</th>
                                  
                                   
                                </tr>
                            </thead>    
                            <tbody>
                            	  <?php if($clientlist!='' && count($clientlist)!=0){
							
							foreach($clientlist as $key=>$val){?>
							
							<tr class="<?php
							if ($key % 2 == 0) { echo 'even';
							} else {echo 'odd';
							}
							?>">
								<td class=""><input type="checkbox" name="cardsellid[]" value="<?php echo $val->card_sell_id?>"  <?php echo set_checkbox('cardsellid[]', $val -> card_sell_id); ?> /> </td>
								<td class=""><?php echo $val -> firstname . ' ' . $val -> lastname; ?></td>
								<td class="center sorting_1">
                                     <div class = "hideValue<?php echo $key?>">
                                                 <?php echo '********' ;?>
                                                 <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    <div class = "showValue<?php echo $key?>" >
                                    <?php echo $val->ssn_no?>
                                     <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    </td>
                                    
                                    <script>
                            
                         $('.showValue<?php echo $key?>').hide();
                        $('.hideValue<?php echo $key?>, .showValue<?php echo $key?>').on('click',
                                     function() 
                                               {
                                                   $('.hideValue<?php echo $key?>, .showValue<?php echo $key?>').toggle()
                                               }
                                               );
                            
                        </script>
                                         
                                    
                                <td class="">
                                     <div class = "hideValue1<?php echo $key?>">
                                                 <?php echo '********' ;?>
                                                 <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                     <div class = "showValue1<?php echo $key?>" >
                                    <?php echo $val->dob?>
                                    <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    
                                    </td>
                                    
                                     <script>
                            
                         $('.showValue1<?php echo $key?>').hide();
                        $('.hideValue1<?php echo $key?>, .showValue1<?php echo $key?>').on('click',
                                     function() 
                                               {
                                                   $('.hideValue1<?php echo $key?>, .showValue1<?php echo $key?>').toggle()
                                               }
                                               );
                            
                        </script>
								<td class="center sorting_1"><?php echo $val->maidenname?></td>
								
								
								<td class="center">
								    
								    <a href="#" class="edit labelProps editable editable-click editable" id="card_sell_com_date" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>postAddedDate"><?php echo date('F d, Y',strtotime($val->card_sell_com_date)); ?></a>
								    </td>
								    
							    
								    
								<td class="center sorting_1"><a href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction/' . $val->card_sell_id.'/'.$val->card_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a></td>
								<!-- <td class="center"><span class="label label-success">Active</span></td> -->
								<input type="hidden" name="cardid" value = "<?php echo $val -> card_id; ?>" >
								
							</tr>
							<?php }
								}
							?>
							
                          </tbody> 
                                                 
                        </table>  
                         <?php echo form_close();?>   
                    </div>
                </div><!--/span-->
  
		
		
	

	<!-- content ends -->
</div><!--/#content.span10-->
</div><!--/fluid-row-->

<script>
    jQuery( document ).ready(function( $ ) {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = true;
        $.fn.editable.defaults.url = '/postAddedDate';
        $.fn.editable.defaults.type = 'text';
        
        // make all items having class 'edit' editable
        //$('.edit').editable();
        
        // make editable
        $('.edit').editable({
            type: 'text',
            pk: <?php echo $CI->uri->segment(4);?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>postAddedDate',
            title: 'Enter username'
        });
        $('.edit').editable('option','validate', function (v) {
            if ($.trim(v) == '') { return 'Required field!'; }
        });
     
       
        
  
        $('.edit').on('save', function(e, params){
            var that = this;
            // persist the old value in the element to be restored when clicking reset
            var oldItemValue = $(that)[0].innerHTML;
            if (!$(that).attr('oldValue')) {
                console.log('persisting original value: ' + oldItemValue)
                $(that).attr('oldValue', oldItemValue);
            }
            setTimeout(function() {
                // first search the row
                var item = $(that).closest('td').next().find('.edit');
                console.log(item);
                if (item.length == 0) {
                    // check the next row
                    item = $(that).closest('tr').next().find('.edit');
                }
                item.editable('show');
            }, 200);
        });
   
    }); 
</script>
</div>
<hr>
