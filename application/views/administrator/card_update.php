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
            <div class="row-fluid">
                
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                       
                        <h2><i class="icon-edit"></i><?php echo $to_name .' '. $title; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if (!empty($card_details))
                 
                        
                       {?>
                            <div class="topic" id="basicinfo">
                                <h3 class="btn btn-minimize btn-round">Basic Information</h3>
                            </div>
                            <div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
                                
                                
                                <div class="forclientlabels">
                                    <div class="span3">
                                        Card Type:<a href="#" class="textarea labelProps editable editable-click editable" id="card_name"  data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_name==''?'':$card_details->card_name;?></a>
                                    </div>
                                    <div class="span3">
                                        Card Name: <a href="#" class="textarea labelProps editable editable-click editable" id="type_id" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->type_id==''?'':$card_details->type_id;?></a>
                                    </div>
                                    <!-- <div class="span3">
                                        Credit Score: <a href="#" class="textarea labelProps editable editable-click editable" id="card_score" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_score==''?'':$card_details->card_score;?></a>
                                    </div> -->
                                    
                                     <div class="span3">
                                        Issued Bank: <a href="#" class="textarea labelProps editable editable-click editable" id="card_bank_name" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_bank_name==''?'':$card_details->card_bank_name;?></a>
                                    </div>
                                    
                                    <div class="span3">
                                         Bank Website : <a href="#" class="textarea labelProps editable editable-click editable" id="bank_url" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->bank_url==''?'':$card_details->bank_url;?></a>
                                    </div>
                                    
                                    
                                      
                                </div>
                                
                            <div class="forclientlabels">
                                
                                 <!-- <div class="span3">
                                      No. of Authorized Users : <a href="#" class="textarea labelProps editable editable-click editable" id="card_auth_no"  data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_auth_no==''?'':$card_details->card_auth_no;?></a>
                                    </div> -->
                                    
                                    <div class="span3">
                                       Balance : $ <a href="#" class="textarea labelProps editable editable-click editable" id="card_balance" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo number_format($card_details->card_balance)==''?'':number_format($card_details->card_balance);?></a>
                                    </div>
                                   
                                    <div class="span3">
                                       Credit Limit : $ <a href="#" class="textarea labelProps editable editable-click editable" id="card_limit" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo number_format($card_details->card_limit)==''?'':number_format($card_details->card_limit);?></a>
                                    </div>
                                    
                                    <div class="span3">
                                       Credit Limit Changed Date : <a href="#" class="textarea labelProps editable editable-click editable" id="credit_limit_date" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->credit_limit_date==''?'':$card_details->credit_limit_date;?></a>
                                    </div>
                                    
                                     <div class="span3">
                                   Closing Date : <a href="#" class="textarea labelProps editable editable-click editable" id="card_close_date"  data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_close_date==''?'':$card_details->card_close_date;?></a>
                                    </div>
                                    <!-- <div class="span3">
                                 Expired Date : <a href="#" class="textarea labelProps editable editable-click editable" id="card_exp_date" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_exp_date==''?'':$card_details->card_exp_date;?></a>
                                    </div> -->
                                    
                                    
                                    
                                   
                                    
                           
                            </div>
                            
                                <div class="forclientlabels">
                                   
                                    
                                    <div class="span3">
                                    Bank Phone number : <a href="#" class="textarea labelProps editable editable-click editable" id="card_bank_pcon"  data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_bank_pcon==''?'':$card_details->card_bank_pcon;?></a>
                                    </div>
                                    
                                     <div class="span3">
                                   Member Since : <a href="#" class="textarea labelProps editable editable-click editable" id="card_open_date" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_open_date==''?'':$card_details->card_open_date;?></a>
                                    </div>
                                    
                                  <div class="span3">
                                   Cost : $ <a href="#" class="textarea labelProps editable editable-click editable" id="card_cost" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_cost==''?'':$card_details->card_cost;?></a>
                                    </div>  
                                    
                                     <div class="span3">
                                  Note : <a href="#" class="textarea labelProps editable editable-click editable" id="card_note" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $card_details->card_note==''?'':$card_details->card_note;?></a>
                                    </div>  
                                </div>
                            
                            
                                

                                        <!--employment insert end-->
                            </div>
                            
                    
                            
                        
                        
                        
                        
                        <?php }?>
                    </div>
                </div><!--/span-->

            </div><!--/row-->  
            
            <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/carddetails/' .$to_id.'/'.$to_name); ?>" class="btn btn-primary">Back To Card Lists</a>

            <!-- <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/delete_card/' .$to_id .'/' .$card_id .'/'. $to_name ); ?>" class="btn btn-primary">Delete Card</a>
<a  onclick="javascript:return confirm('Delete the Authorized Users Before Deleting Cards')" title="Click to delete"> <img src="<?php echo base_url(); ?>/style/img/delete.png" alt="Delete Line Owner Details"></a> -->

     
   <!-- <?php if (($card_details -> card_auth_no) == 0)  { ?> 
   <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/delete_card/' .$to_id .'/' .$card_id .'/'. $to_name ); ?>"  class="btn btn-primary" onclick="javascript:return confirm('Are you sure you want to delete this Card?')" title="Click to delete" >Delete Card</a>
                                      <?php } else { ?>
                                          <a  class="btn btn-primary" onclick="javascript:return confirm('Delete the Authorized Users Before Deleting Cards')" title="Click to delete">Delete Card</a>
                                      <?php } ?> -->
                                      
                                      
                                   
                                    </td>






</div>



<script>
    jQuery( document ).ready(function( $ ) {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = true;
        $.fn.editable.defaults.url = '/cardPost';
        $.fn.editable.defaults.type = 'textarea';
        
        // make all items having class 'edit' editable
        //$('.edit').editable();
        
        // make editable
        $('.edit').editable({
            type: 'text',
            pk: <?php echo $CI->uri->segment(5);?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>cardPost',
            title: 'Enter username'
        });
        $('.edit').editable('option','validate', function (v) {
            if ($.trim(v) == '') { return 'Required field!'; }
        });
       
        
        $('.textarea').editable({
            type: 'textarea',
            pk: <?php echo $CI->uri->segment(5);?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>cardPost',
            title: 'Enter username'
        });
        
        //ajax emulation
        // $.mockjax({
            // url: '/post',
            // responseTime: 200,
            // response: function(settings) {
                // console.log('done!');
            // }
        // }); 
        
        // this is to automatically make the next item in the table editable
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
        
        $('#resetbtn').click(function() {
            $('.edit').each(function() {
                var o = $(this);
                o.editable('setValue', o.attr('oldValue'))  //clear values
                 .editable('option', 'pk', o.attr('pk'))    //clear pk
                 .removeClass('editable-unsaved')
                 .removeAttr('oldValue');
            });
        });
        
        $('#savebtn').click(function() {
           $('.edit').editable('submit', { 
               url: '/post', 
               //ajaxOptions: { dataType: 'json' },           
               success: function(data, config) {
                   $(this).removeClass('editable-unsaved') //remove unsaved class
                          .removeAttr('oldValue');  // clear oldValue
               },
               error: function(errors) {
                   console.log('error');
                   var msg = '';
                   if(errors && errors.responseText) { //ajax error, errors = xhr object
                       msg = errors.responseText;
                   } else { //validation error (client-side or server-side)
                       $.each(errors, function(k, v) { msg += k+": "+v+"<br>"; });
                   } 
               }
           });
        });
    }); 
</script>
</div>
<hr>