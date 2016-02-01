<?php
$allowed = $this->AuthModel->getAuth();
$ts = $this->uri->total_segments();
$offset = (is_numeric($this->uri->segment($ts))) ? $this->uri->segment($ts) : 0;
$CI = &get_instance();
?>

<script src="<?php echo base_url();?>js/admin/editable/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>js/admin/editable/jquery.mockjax.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/backend/bootstrap-editable.css" media="all" />

<style>
  	input{
  		width:93%;
  	}
   	 .row-fluid .span4 label{
    width:90px;
    float:left
  	  </style>

<div id="content" class="span10">
<?php if ($usertype == 2) { ?>
        <div class="row-fluid">
            <div class="box span12">
                <div class="box-header well" data-original-title>
                    <h2><i class="icon-edit"></i><?php echo $title1; ?></h2>
                </div>
                <div class="box-content">
                    <?php
                    if (validation_errors()) {
                        ?>
                        <div class="message error"></div> 
                    <?php } ?>
                    <?php
                    if ($error) {
                        ?>
                        <div class="message error">
                            <?php
                            foreach ($error as $value) {
                                echo $value;
                            }
                            ?>
                        </div> 
                    <?php } ?>
                    <?php
                    $attributes = array('class' => 'formular', 'id' => 'form');
                    echo form_open_multipart(ADMIN_PATH . 'creditcard/addClientsToCreditCard', $attributes);
                    ?>
                    <div class="row-fluid">
                    	<div class="span4">
                    		<?php
                                $attributes = array('class' => 'left',);
                                echo form_label('Add Client (*):', 'client', $attributes);
                            ?>
                            <select name="client_id">
                                <?php foreach($referrerClients as $key => $values){?>
                                <option value="<?php echo $values->id?>"><?php echo $values->firstname.' '.$values->lastname;?></option>
                                <?php } ?>
                            </select>
                           
                    	</div>
                    	
                    	<div class="span4">
                    		<?php  echo form_error('no_month'); ?>
                                         <?php $options = array(
                                // '' => 'Gender',
                                            '' => 'Select No. of months' ,
                                            '1' => '1', 
                                            '2' => '2',
                                             '3' => '3',
                                              '4' => '4',
                                               '5' => '5',
                                            '6' => '6',
                                             '7' => '7',
                                              '8' => '8',
                                               '9' => '9',
                                            '10' => '10',
                                            '11' => '11',
                                            '12' => '12' );
                                echo form_dropdown('no_month', $options,2, set_value('no_month') );
                          
                                
                                
                              ?> 
                                      
                    		
                    	</div>
                    	<div class="span4">
                    			<input type="text"  size="20" name="charge" value="100" placeholder="Charge" />
                                <?php echo form_error('charge');?>
                                <input type="hidden" id="card_id" name="card_id" value="<?php echo $card_id; ?>">
                                <input type="hidden" id="to_id" name="to_id" value="<?php echo $to_id; ?>">
                                <input type="hidden" id="ref_id" name="ref_id" value="<?php echo $ref_id; ?>">
                                <input type="hidden" id="to_name" name="to_name" value="<?php echo $to_name; ?>">
                    	</div>
                    	 <input type="submit" value = "Submit" class="btn btn-primary" />
                    	
                    </div>
                    
                   
                    
    <?php echo form_close(); ?>
                    
                    <a href="<?php echo base_url() . 'administrator/lineowner/carddetails/' . $to_id . '/' . str_replace(" ", "_", $to_name); ?>">Back To Card Details</a>
                </div>
                
                
              <div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
                                
                           
                                <div class="forclientlabels">
                                    <div class="span3">
                                       Card Type: <a href="#" class="text labelProps editable editable-click editable" id="card_name" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_name==''?'':$getdetailsofcard->card_name;?></a>
                                    </div>
                                    <div class="span3">
                                        Card Name: <a href="#" class="text labelProps editable editable-click editable" id="type_id" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->type_id==''?'':$getdetailsofcard->type_id;?></a>
                                    </div>
                                    <div class="span3">
                                    Score: <a href="#" class="text labelProps editable editable-click editable" id="card_score" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_score==''?'':$getdetailsofcard->card_score;?></a>
                                    </div>
                                    <div class="span3">
                                   Bank Name: <a href="#" class="text labelProps editable editable-click editable" id="card_bank_name" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_bank_name==''?'':$getdetailsofcard->card_bank_name;?></a>
                                    </div>
                                    </div>
                                
                                 <div class="forclientlabels">
                                    
                                    <div class="span3">
                                    Phone: <a href="#" class="text labelProps editable editable-click editable" id="card_bank_pcon" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_bank_pcon==''?'':$getdetailsofcard->card_bank_pcon;?></a>

                                    </div>
                                    <div class="span3">
                                   Balance: <a href="#" class="text labelProps editable editable-click editable" id="card_balance" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_balance==''?'':$getdetailsofcard->card_balance;?></a>

                                    </div>
                                    <div class="span3">
                                 Credit Limit: <a href="#" class="text labelProps editable editable-click editable" id="card_limit" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_limit==''?'':$getdetailsofcard->card_limit;?></a>

                                    </div>
                                    <!-- <div class="span3">
                                        Expiration Date : <?php echo $getdetailsofcard->card_exp_date ;?>
                                    </div> -->
                                    
                                   
                                </div>
                                 <div class="forclientlabels">
                                 <div class="span3">
                                      Member Since: <a href="#" class="text labelProps editable editable-click editable" id="card_open_date" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_open_date==''?'':$getdetailsofcard->card_open_date;?></a>

                                    </div>
                                     <div class="span3">

 Closing Day:<a href="#" class="text labelProps editable editable-click editable" id="card_close_date" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_close_date==''?'':$getdetailsofcard->card_close_date;?></a>                                    </div>
                                     <div class="span3">
  Card Cost: <a href="#" class="text labelProps editable editable-click editable" id="card_cost" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_cost==''?'':$getdetailsofcard->card_cost;?></a>

                                    </div>
                                     <div class="span3">
                                   Created Date: <a href="#" class="text labelProps editable editable-click editable" id="card_crtd_date" pk="<?php echo $CI->uri->segment(5);?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post1"><?php echo $getdetailsofcard->card_crtd_date==''?'':$getdetailsofcard->card_crtd_date;?></a>

                                    </div>
                                    </div>
                       
              </div>
              
              
            </div><!--/span-->

        </div><!--/row-->  
<?php } ?>
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
                <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Charge<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Receivable Amount<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Collectable Amount<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Payable Amount<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                             <th>Added Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Closing Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <th>Status<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                            <!--<th>Action</th>-->
                           
                        </tr>
                    </thead>

                    <tfoot>
                    <tr>
                        <th colspan="3" style="text-align:center">Total:</th>
                        <th>$ <?php echo  $sumOfReceivableAmount[0]['card_sell_cost'] * 0.1;?></th>
                        <th>$ <?php echo  $sumOfCollectableAmount[0]['card_sell_cost'] * 0.1;?></th>
                        <th>$ <?php echo  $sumOfReceivableAmount[0]['card_sell_cost'] * 0.8;?></th>
                        <th colspan="3"></th>

                    </tr>
                    </tfoot>


                    <tbody>
                        <?php 
                        if ($clientList != 0 && count($clientList) > 0) {
                            $count = 1;
                            foreach ($clientList as $values) {
                                ?>
                                <tr class="item">
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $values->client_name?></td>  
                                    
                                  <td>
              	 <?php
if ($values->verify_status != 'verified') { ?>
 $ <a href="#" class="textarea labelProps editable editable-click editable" id="card_sell_cost" data-pk="<?php echo $values->card_sell_id?>" data-url="<?php echo base_url().'administrator/creditcard/';?>post"><?php echo $values->card_sell_cost==''?'':$values->card_sell_cost;?></a>
 <?php } else {
 	echo  '$' . $values->card_sell_cost==''?'':'$' .$values->card_sell_cost;
 }?> </td>
                                    <td>$ <?php echo $values->card_sell_cost * 0.1 ;?></td>

                                    <?php if($values->verify_status == 'verified'){ ?>
                                        <td>$ <?php echo $values->card_sell_cost * 0.1 ?></td>
                                    <?php      } else { ?><td></td>
                                    <?php } ?>


                                    <td>$ <?php echo $values->card_sell_cost * 0.8 ?></td>



                                  <td><?php if($values->card_sell_added_date){ echo ($values->card_sell_added_date); } ?></td>
                                   <td><?php echo $values->card_sell_end_date ?></td> 
                                    <td>
                                        
<?php  if ($values->verify_status == 'verify_ref' && $values->card_sell_status != "process")
{ ?>
<a href="<?php echo site_url(ADMIN_PATH .'creditcard/verifyAction/'.$to_id .'/'. $card_id .'/'. $to_name.'/'. $values->card_sell_id );?>" class="btn btn-danger">Verify</a>
<a href="<?php echo site_url(ADMIN_PATH .'lineowner/changeStatusToVerifiedFromRef/'. $values->card_sell_id .'/' . $values->card_id . "/" . $to_id ."/" . $to_name );?>"
	onclick = "<?php if($values->card_sell_cost != 0)
	                   {echo "return confirm('Are you sure to confirm it')";}
	                   else
                       {echo "alert('Please verify the charge amount');return false;";}?>" class="btn btn-success">Confirm Verified</a>
<?php  } ?>

<?php  if ($values->verify_status == 'confirm_verify')
{ ?>
<a href="<?php echo site_url(ADMIN_PATH .'lineowner/changeStatusToVerifiedFromRef/'. $values->card_sell_id .'/' . $values->card_id . "/" . $to_id ."/" . $to_name );?>" class="btn btn-success">Confirm Verified</a>
<?php  } ?>
    
   
   <?php 
if ($values->verify_status == 'verified')
{ ?>
<a href="#" class="btn btn-success">Verified</a>
        
        
   <?php  }  ?>
                                       
                                       
                                        
                                       <?php  if($values->card_sell_status == "process"){
                                                 echo "Request Pending";
                                        } 
                                       elseif ($values->verify_status == "verify_to") {
                                            echo "Verification On Process";
                                       }
                                        ?>
                                        
                                        
                                       
                                        </td> 
                                    <!-- <?php if ($usertype == 2) { ?>
                                                <td class="action" style="width:100px">
                                                       <!-- <a href="<?php echo site_url(ADMIN_PATH . 'chooseandcharge/updateAction/' . $values->id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                                       <a href="<?php echo site_url(ADMIN_PATH . 'chooseandcharge/deleteAction/' . $values->id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
                                                       <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/view/' . $values->owner_id); ?>"><img src="<?php echo base_url(); ?>/style/img/view.png" alt="delete"></a> -->
                                        <!--</td>
                                <?php } ?>-->    
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
<hr>
</div>


<script>
    jQuery( document ).ready(function( $ ) {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = true;
        // $.fn.editable.defaults.url = '/post';
         // $.fn.editable.defaults.url = '/post1';
       
        $.fn.editable.defaults.type = 'textarea';
        
        
        // make all items having class 'edit' editable
        //$('.edit').editable();
        
        // make editable
       
       
        $('.textarea').editable({
            type: 'textarea',
            pk: $(this).data('pk'),
            url: '<?php echo base_url().'administrator/creditcard/';?>post',
            title: 'Enter username'
        });
        
        $('.text').editable({
            type: 'textarea',
            pk: <?php echo $CI->uri->segment(5);?>,
            url: '<?php echo base_url().'administrator/creditcard/';?>post1',
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