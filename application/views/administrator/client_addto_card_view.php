<?php
    $CI = &get_instance();
?>






<script src="<?php echo base_url();?>js/admin/editable/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>js/admin/editable/jquery.mockjax.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/backend/bootstrap-editable.css" media="all" />




<div id="content" class="span10">
    
   
        <div class="box span8">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title?></h2>
                        
                        
                    </div>
                    <div class="box-content">
                       
                       <div class="left">
                         <div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">     
                          <div class="forclientlabels">
                                    
                                     <div class="span3">
                                        Card Type : 
                                        <a href="#" class="textarea labelProps editable editable-click editable" id="card_name" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_name==''?'':$single_card->card_name;?></a>
                                    </div> 
                                    
                                    <div class="span3">
                                        Card Name : <a href="#" class="textarea labelProps editable editable-click editable" id="type_id" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->type_id==''?'':$single_card->type_id;?></a>

                                    </div> 
                                    
                                    <div class="span3">
                                     Bank Name : <a href="#" class="textarea labelProps editable editable-click editable" id="card_bank_name" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_bank_name==''?'':$single_card->card_bank_name;?></a>

                                    </div> 
                                    
                                    <div class="span3">
                                         Bank Phone No. :  <a href="#" class="textarea labelProps editable editable-click editable" id="card_bank_pcon" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_bank_pcon==''?'':$single_card->card_bank_pcon;?></a>

                                    </div> 
                                    
                          </div>
                       
                         <div class="forclientlabels">
                         	 <div class="span3">
                                        Bank Url :  <a href="#" class="textarea labelProps editable editable-click editable" id="bank_url" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->bank_url==''?'':$single_card->bank_url;?></a>

                                    </div> 
                         	
                              <div class="span3">
                                        Balance : $ <a href="#" class="textarea labelProps editable editable-click editable" id="card_balance" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_balance==''?'':$single_card->card_balance;?></a>

                                    </div> 
                                    
                                    <div class="span3">
                                         Credit Limit :  $  <a href="#" class="textarea labelProps editable editable-click editable" id="card_limit" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_limit==''?'':$single_card->card_limit;?></a>

                                    </div> 
                                    
                                     <div class="span3">
                                       Closing Day: <a href="#" class="textarea labelProps editable editable-click editable" id="card_close_date" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_close_date==''?'':$single_card->card_close_date;?></a>

                                    </div> 
                                    
                                     <!-- <div class="span3">
                                       Expired Date : <a href="#" class="textarea labelProps editable editable-click editable" id="card_exp_date" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPost"><?php echo $single_card->card_exp_date==''?'':$single_card->card_exp_date;?></a>

                                    </div>  -->
                                    
                                    
                                  
                           
                           </div>
                           
                           <div class="forclientlabels">
                               
                           </div>
                           
                           </div>
                           
                           <br><br>
        
          
        </div>  
        
        
        <?php
    if (validation_errors()) {
        echo form_error('clientid');
    }
    
                            if ($this->session->flashdata('su_message1')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message1') ?><p></div> 
                                <?php } ?>
                          
                        <?php $attributes = array('class' => 'formular', 'id' => 'form');
                            echo form_open_multipart(ADMIN_PATH . 'lineowner/addCheckedClientToCard', $attributes);
                        ?>
                          <?php $data = array('name' => 'send', 'id' => 'send', 'value' => 'Add to Line', 'class' => 'btn btn-primary line', );
            echo form_submit($data);
        
        ?> 
                        
                        
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                    <th><input type="checkbox"></th>
                                    <th>SN.</th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>SSN<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>DOB<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Maiden Name<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Receivable Amount<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Action</th>
                                  
                                   
                                </tr>
                            </thead>    
                            <tbody>
                                  <?php if($clientlist!='' && count($clientlist)!=0){
                            $count=1;
                            foreach($clientlist as $key=>$val){?>
                            
                            <tr class="<?php
                            if ($key % 2 == 0) { echo 'even';
                            } else {echo 'odd';
                            }
                            ?>">
                                
                                <td class=""><input class="chkboxes1" type="checkbox" name="cardsellid[]" value="<?php echo $val->card_sell_id?>"  <?php echo set_checkbox('cardsellid[<?php echo $key?>]', $val -> card_sell_id); ?> /> </td>
                                <td class=""><?php echo $count; ?></td>
                                <td class=""><?php echo $val -> firstname . ' ' . $val -> lastname; ?></td>
                                <td class="center sorting_1">
                                     <div class = "hideValue<?php echo $key?>">
                                                 <?php echo '********'; ?>
                                               <a>  <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    <div class = "showValue<?php echo $key?>" >
                                    <?php echo $val->ssn_no?>
                                     <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    </td>
                                    
        
                                         
                                    
                                <td class="center sorting_1">
                                     <div class = "hideValue1<?php echo $key?>">
                                                 <?php echo '********'; ?>
                                             <a> <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                     <div class = "showValue1<?php echo $key?>" >
                                    <?php echo $val->dob?>
                                    <img src="<?php echo base_url(); ?>/style/img/eye.png" /></a>
                                            </div>
                                    
                                    
                                    </td>
                                    
                                     <script>
                                     
                                       $('.showValue<?php echo $key?>').hide();
                                            $('.hideValue<?php echo $key?>, .showValue<?php echo $key?>').on('click',
                                        function(){
                                            $('.hideValue<?php echo $key?>, .showValue<?php echo $key?>').toggle()
                                        }
                                    );
                            
                                        $('.showValue1<?php echo $key?>').hide();
                                                $('.hideValue1<?php echo $key?>, .showValue1<?php echo $key?>').on('click',
                                            function(){
                                                $('.hideValue1<?php echo $key?>, .showValue1<?php echo $key?>').toggle()
                                            }
                                        );
                
                                        </script>
                                    
                                    
                                    
                                <td class="center sorting_1"><?php echo $val->maidenname?></td>
                                <td class="center sorting_1">$<?php echo $val->card_sell_cost*0.8;?></td>                               <!-- <td><a href="#" class="edit labelProps editable editable-click editable" id="card_sell_com_date" data-pk="<?php echo $val->card_sell_id?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPostDate"><?php if($val->card_sell_com_date){ echo date('F d, Y',strtotime($val->card_sell_com_date));}?></a></td> -->
                                <td class="center sorting_1">
                                    <?php if($val->card_sell_status == 'process'){?>
                                    <a href="<?php echo site_url(ADMIN_PATH . 'lineowner/addSingleCardAction/' . $val -> card_sell_id) . '/' . $val -> card_id; ?>" ><div class="btn btn-primary">ADD</div></a>
                                    <?php }?>
                                    <button class="btn btn-primary" onclick="return declineConfirmation('<?php echo $val->firstname?>' ,'<?php echo $val->lastname?>' ,'<?php echo $val->card_sell_id?>' ,'<?php echo $val->card_id?>' , '<?php echo $val->id?>');" />Not Added</button>
                             
                                    <!-- <a class="btn btn-primary" href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction/' . $val->card_sell_id.'/'.$val->card_id); ?>"  onclick="return confirm('Are you sure you do not want to add <?php echo $val -> firstname . ' ' . $val -> lastname; ?>?');">Not Added</a> -->

                                </td>
                                
                                <!-- <td class="center"><span class="label label-success">Active</span></td> -->
                                <input type="hidden" name="cardid" value = "<?php echo $val -> card_id; ?>" >
                                
                            </tr>
                            <?php 
                                    $count++;
                                }
                                }
                            ?>
                            
                          </tbody> 
                                                 
                        </table>  
                        
      
        
        <?php //    $data = array('name' => 'send', 'id' => 'send', 'value' => 'Added to Line', 'class' => 'btn btn-primary', );
        //  echo form_submit($data);
        echo form_close();
        ?>    
                       
                    </div>
                </div><!--/span-->
                
                
                
<script type="text/javascript">
    function declineConfirmation(firstname , lastname , card_sell_id , card_id , id){
   var retVal =  confirm('Are you sure you do not want to add ' + firstname + lastname);
  if(retVal == true){
     var message =  prompt("Please leave a message why" +  " " + firstname + " "  + lastname  + " " + "is declined ?");
     var x = message;
  window.location = "<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction')?>" + '/' + card_sell_id + '/' + card_id + '/' + x + '/' + id;
         } 
         else
   {
   return false;
       }
   return false;
}

            


                    
                    
                </script>
    
    
		<div class="box span4">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title1; ?></h2>
                    </div>
                    <div class="box-content">
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Card Type<?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"> </th>
							<th>Card Name<?php echo '&nbsp;&nbsp;'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
							<!--<th>Issued Bank<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
							
							<th>Auth User<img src="<?php echo base_url();?>/style/img/sort.png"></th>
							 <th>Opening<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
							<th>Closing<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
							<th>Balance %<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
							<th>Cost<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th> -->
                            
                        </tr>
                    </thead>
                        <?php
                        if( $cardList !=0 && count($cardList) > 0)
                        {
                            $count=1;
                            foreach($cardList as  $values)
                            {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><a href="<?php echo site_url(ADMIN_PATH.'lineowner/addClientToCard/'.$values->card_id)?>" title="<?php echo $values -> nocard; ?> new Client Need to be Added"><?php echo $values -> card_name; ?>   &nbsp; <strong class="red"> <?php if($values->nocard !=0){ echo $values -> nocard; } ?></strong></a></td>
                                <td><?php echo($values -> type_id); ?></td>
                                <!--  <td><?php echo $values -> card_bank_name; ?></td> 
                                
                                <td><?php echo $values -> card_auth_no;?></td>
                               <td><?php echo $values -> card_open_date;?></td>
                                <td><?php echo $values -> card_close_date;?></td>
                                <td><?php echo ceil((($values -> card_balance * 100)/$values->card_limit)).'%';?></td> 
                                <td>
                                  <?php  echo $values -> card_cost;?>
                                    </td>-->
                               
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
                
                
                
                <!--end of right table-->
  
 <div id="content">
     
     <div class="box span8">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title2?></h2>
                        
                        
                    </div>
                
             <div class="box-content">
   
      
                          
                        <?php $attributes = array('class' => 'formular', 'id' => 'form');
                            echo form_open_multipart(ADMIN_PATH . 'lineowner/deleteMultipleAction', $attributes);
                        ?>
                          <?php $data = array('name' => 'send', 'id' => 'send', 'value' => 'Remove', 'class' => 'btn btn-primary delbtn', );
            echo form_submit($data);
        
        ?> 
                        
                        
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                            <thead>
                                <tr>
                                     <th><input type="checkbox"></th>
                                    <th>Client Name<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>SSN<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>DOB<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Added Date<?php echo '&nbsp;&nbsp;&nbsp' ; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Receivable Amount <?php echo '&nbsp;&nbsp;&nbsp'; ?><img src="<?php echo base_url(); ?>/style/img/sort.png"></th>
                                    <th>Action</th>
                                   <th>Verify</th>
                                   
                                </tr>
                            </thead>    
                            <tfoot>
                            <tr>
                                <th colspan="5" style="text-align:center">Total:</th>
                                <th > $ <?php echo  $sumOfReceivableAmountLineOwnerWithCardId[0]['card_sell_cost'] * 0.8;?> </th>
                                <th colspan="3"></th>
                            
                            </tr>
                            </tfoot>

                                  <?php if($clientlistcom!='' && count($clientlistcom)!=0){
?>                                  <tbody>
                            <?php
                            foreach($clientlistcom as $key=>$val){?>
                            
                            <tr class="<?php
                            if ($key % 2 == 0) { echo 'even';
                            } else {echo 'odd';
                            }
                            ?>">
                            
<td class=""><input class="chkboxes" type="checkbox" name="cardsellid[]" value="<?php echo $val->card_sell_id?>"  <?php echo set_checkbox('cardsellid[]', $val -> card_sell_id); ?> /> </td>
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
                                
                                

<td><a href="#" class="edit labelProps editable editable-click editable" id="card_sell_added_date" data-pk="<?php echo $val->card_sell_id?>" data-url="<?php echo base_url().'administrator/lineowner/';?>cardPostDate"><?php if($val->card_sell_added_date){ echo date('F d, Y',strtotime($val->card_sell_added_date));}?></a></td>
<td class="center sorting_1">$<?php echo $val->card_sell_cost*0.8;?></td> 

<td class="center sorting_1"> <?php
                                $endDate = $val->card_sell_end_date ;
                                $Date = $val->card_sell_added_date ;
                                $today = date("m/d/Y");
                                if($endDate < $today) { ?> <a onclick="return confirm('Make Sure Before You Delete This Record')" href="<?php echo site_url(ADMIN_PATH . 'lineowner/deleteSingleAction1/' . $val->card_sell_id.'/'.$val->card_id); ?>" class="btn btn-danger" >Remove</a>  <?php }  ?>


<?php 
 if ($val->verify_status != 'verified'){ ?>
<a class="btn btn-primary" href="<?php echo site_url(ADMIN_PATH . 'lineowner/notAddedClients/' . $val->card_sell_id.'/'.$val->card_id . '/' . $val->id); ?>"  onclick="return declineConfirmation('<?php echo $val->firstname?>' ,'<?php echo $val->lastname?>' ,'<?php echo $val->card_sell_id?>' ,'<?php echo $val->card_id?>' , '<?php echo $val->id?>');">Not Added</a> </td>
<?php }?>

<td class="center sorting_1"> 
     <?php  if ($val->verify_status == 'verify_to'){ ?>
   <button class="btn btn-danger" onclick="return getConfirmation(<?php echo $val->card_sell_id?> , <?php echo $val->card_id?>);" />Verify</button>


 <?php }?>
 
 <?php 
 $endDate = $val->card_sell_end_date ;
  $Date = $val->card_sell_added_date ;
  $today = date("m/d/Y");
  if (($val->verify_status == 'verified') && ($endDate > $today)){ ?>
   <a href = "#"><button class="btn btn-success"  />Verified</button></a> 


 <?php }?>
</td>
                                                  <input type="hidden" name="cardid" value = "<?php echo $val -> card_id; ?>" >
                                                    </tr><?php }} ?>
                          </tbody>
                                                 
                        </table>  
                        
      
        
        <?php //    $data = array('name' => 'send', 'id' => 'send', 'value' => 'Added to Line', 'class' => 'btn btn-primary', );
        //  echo form_submit($data);
        echo form_close();
        ?>    
                       
                    </div>
      
            </div>
                
  <hr>
    <!-- content ends -->
</div><!--/#content.span10-->

  <hr>
<script>
$(document).ready(function() {
    $('.delbtn').prop('disabled', true);
    $('.line').prop('disabled', true);

    $('.chkboxes').change(function(){
        $('.delbtn').prop('disabled', $('.chkboxes:checked').length == 0);
       
    });
    
    $('.chkboxes1').change(function(){
        
        $('.line').prop('disabled', $('.chkboxes1:checked').length == 0);
    });
    
});
</script>


<script type="text/javascript">
function getConfirmation(data , data1){
var retVal =  confirm('It is ok to verify <?php echo $val -> firstname . ' ' . $val -> lastname; ?>?');

   if(retVal == true){
              window.location = "<?php echo site_url(ADMIN_PATH .'lineowner/verifiedWithoutErrors')?>" + '/' + data + '/' + data1;
 
       

   }else{
        window.location = "<?php echo site_url(ADMIN_PATH .'lineowner/verifiedWithoutErrors')?>" + '/' + data + '/' + data1;
   
   
   }
   return false;
}
</script>




<script>
    jQuery( document ).ready(function( $ ) {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = true;
        //$.fn.editable.defaults.url = '/cardPost';
        $.fn.editable.defaults.type = 'text';
        
        // make all items having class 'edit' editable
        //$('.edit').editable();
        
        // make editable
        $('.edit').editable({
            type: 'text',
            pk: $(this).data('pk'),
            url: '<?php echo base_url().'administrator/lineowner/';?>cardPostDate',
            title: 'Enter username'
            
            
        });
       
        $('.edit').editable('option','validate', function (v) {
            if ($.trim(v) == '') { return 'Required field!'; }
        });
        
        
        
        $('.textarea').editable({
            type: 'textarea',
            pk: <?php echo $CI->uri->segment(4);?>,
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
                                      
                                        
                          
                                          
                                 



