<?php
    $CI = &get_instance();
$user_id = $CI->uri->segment(4);
?>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap.min.js"></script>

<script src="<?php echo base_url();?>js/admin/editable/jquery.mockjax.js"></script>
<script src="http://code.jquery.com/jquery-2.1.0.js"></script>
<script src="<?php echo base_url();?>js/admin/editable/bootstrap-editable.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>style/backend/bootstrap-editable.css" media="all" />
<script>
        $(document).ready(function () {
            $("input#submitemp").click(function(){
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url().'administrator/client/';?>insertemp/client', // 
                    data: $('form.employment').serialize(),
                    success: function(msg){     
                        location.reload();      
                        // $("#employment").append(msg);    
                        // $("#form-content").modal('hide');    
                    },
                    error: function(){
                        alert("failure");
                    }
                });
            });
        });
   </script>
   <script>
        function deleteEmp(emp_id){
            var r = confirm("Are you sure you want to delete this employment detail?");
            if (r == true) {
                $.ajax({
                    type: "POST",
                    url: '<?php echo base_url().'administrator/client/';?>deleteEmp/'+emp_id, // 
                    data: $('form.employment').serialize(),
                    success: function(msg){         
                        location.reload();  
                    },
                    error: function(){
                        alert("failure");
                    }
                });
            }
        }       
    </script>

<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?> <?php  echo $lineowner->to_fname.' '.$lineowner->to_lname;?></h2>
                    </div>
                    <div class="box-content">
                    	<?php
						if (!empty($lineowner)) {?>
							<div class="topic" id="basicinfo">
								<h3 class="btn btn-minimize btn-round">Basic Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								
								
								<div class="forclientlabels">
									<div class="span3">
										First Name: <a href="#" class="textarea labelProps editable editable-click editable" id="to_fname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_fname==''?'':$lineowner->to_fname;?></a>
									</div>
									<div class="span3">
                                        Middle Name: <a href="#" class="textarea labelProps editable editable-click editable" id="to_mname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_mname==''?'':$lineowner->to_mname;?></a>
                                    </div>
									<div class="span3">
										Last Name: <a href="#" class="textarea labelProps editable editable-click editable" id="to_lname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_lname==''?'':$lineowner->to_lname;?></a>
									</div>
									
									 <div class="span3">
                                        Address: <a href="#" class="textarea labelProps editable editable-click editable" id="to_address" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_address==''?'':$lineowner->to_address;?></a>
                                    </div>
									  
                                </div>
                                
                            <div class="forclientlabels">
                               
                                    <div class="span3">
                                      <span>Score Types :-</span><br>
                                         <span>Transunion : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="to_transunion" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_transunion==''?'':$lineowner->to_transunion;?></a><br>
                                        <span>Equifax : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="to_equifax" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_equifax==''?'':$lineowner->to_equifax;?></a><br>
                                        <span>Experion : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="to_experion" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_experion==''?'':$lineowner->to_experion;?></a>
                                    </div>
                                    
                                    <div class="span3">
                                        Email: <a href="#" class="textarea labelProps editable editable-click editable" id="to_email" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_email==''?'':$lineowner->to_email;?></a>
                                    </div>
                                   
                                    <div class="span3">
                                        Mobile: <a href="#" class="textarea labelProps editable editable-click editable" id="to_pcon" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_pcon==''?'':$lineowner->to_pcon;?></a>
                                    </div>
                                    
                                    
                                   
                              
                               <?php  if (!empty($lineowner->to_payment_type))
                                      { ?>
                                          <span>Payment Type : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="to_payment_type" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_payment_type==''?'':$lineowner->to_payment_type;?></a><br>
                                            
                                        <?php } 
                                        
                                         if (($lineowner->to_payment_type) == 'paypal')
                                      { ?>
                                          <span>Paypal ID : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="to_paypal_id" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_paypal_id==''?'':$lineowner->to_paypal_id;?></a><br>
                                            
                                        <?php } 
                                        
                                        
                                        ?>
                              
                              
                                <!--    <div class="span3">
                                        
                                      <?php  if (!empty($lineowner->to_credit_score))
                                      { ?>
                                          <span>Credit Score.</span>
                                         <a href="#" class="edit labelProps editable editable-click editable" id="to_credit_score" pk="pk="<?php echo $user_id;?>"" data-url="<?php echo base_url().'administrator/lineowner/';?>post"><?php echo $lineowner->to_credit_score==''?'':$lineowner->to_credit_score;?></a><br>
                                            
                                        <?php } ?>
                                      
                                    </div>   -->
                                    
                                
                            </div>
                                
                            
								     <div class="forclientlabels">
                                   
                                    
                                      
                                 
                                    
                                </div>  
                                
                      
							
							
							</div>
							
							
								

										<!--employment insert end-->
							</div>
							
					
							
						
						
						
						
						<?php }?>
                   	</div>
                </div><!--/span-->
  <a href="<?php echo site_url(ADMIN_PATH . 'lineowner'); ?>" class="btn btn-primary">Back To Line Owner Lists</a>
            </div><!--/row-->  
            
  
            
</div>
<script>
    jQuery( document ).ready(function( $ ) {
        // setting defaults for the editable
        $.fn.editable.defaults.mode = 'inline';
        $.fn.editable.defaults.showbuttons = true;
        $.fn.editable.defaults.url = '/post';
        $.fn.editable.defaults.type = 'textarea';
        
        // make all items having class 'edit' editable
        //$('.edit').editable();
        
        // make editable
        $('.edit').editable({
            type: 'text',
            pk: <?php echo $CI->uri->segment(4);?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>post',
            title: 'Enter username'
        });
        $('.edit').editable('option','validate', function (v) {
            if ($.trim(v) == '') { return 'Required field!'; }
        });
        $('.editemp').editable({
            // id: document.getElementById("number").value,
            //ck: document.getElementById("emp_id" + document.getElementById("number").value).value,
            type: 'text',
            pk: <?php echo $CI->uri->segment(4);?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>postemp/',
            title: 'Enter username'
        });
        
        $('.textarea').editable({
            type: 'textarea',
            pk: <?php echo $user_id;?>,
            url: '<?php echo base_url().'administrator/lineowner/';?>post',
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