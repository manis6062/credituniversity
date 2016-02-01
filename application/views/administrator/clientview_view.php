<?php 
	$CI = &get_instance();
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
                        <h2><i class="icon-edit"></i><?php echo $title; ?> <?php echo $client->firstname.' '.$client->lastname;?></h2>
                    </div>
                    <div class="box-content">
                    	<?php
						if (!empty($client)) {?>
							<div class="topic" id="basicinfo">
								<h3 class="btn btn-minimize btn-round">Basic Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								
								
								<div class="forclientlabels">
									<div class="span3">
										First Name: <a href="#" class="textarea labelProps editable editable-click editable" id="firstname" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->firstname==''?'':$client->firstname;?></a>
									</div>
									<div class="span3">
									    
                                        Middle Name: <a href="#" class="textarea labelProps editable editable-click editable" id="middlename" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->middlename==''?'':$client->middlename;?></a>
                        
                                    </div>
									<div class="span3">
										Last Name: <a href="#" class="textarea labelProps editable editable-click editable" id="lastname" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->lastname==''?'':$client->lastname;?></a>
									</div>
									
									
									<div class="span3">
                                        Mothers Maiden Name: <a href="#" class="textarea labelProps editable editable-click editable" id="maidenname" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->maidenname==''?'':$client->maidenname;?></a>
                                    </div>
                                    
                                    
                                    
                                     
                                    
                                </div>
                                
                            <div class="forclientlabels">
                                
                                
                                
                                <div class="span3">
                                       Gender: <a href="#" class="textarea labelProps editable editable-click editable" id="gender" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->gender==''?'':$client->gender;?></a>
                                         
                                    </div>
                                    <div class="span3">
                                          Email: <a href="#" class="textarea labelProps editable editable-click editable" id="email" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->email==''?'':$client->email;?></a>
                                    </div>
                                   
                                    <div class="span3">
                                        Mobile: <a href="#" class="textarea labelProps editable editable-click editable" id="mobile" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->mobile==''?'':$client->mobile;?></a>
                                    </div>
                                   
                            </div>
                            
                            
                            <div class="forclientlabels">
                             <div class="span3">
                                        Address: <a href="#" class="textarea labelProps editable editable-click editable" id="address" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->address==''?'':$client->address;?></a>
                                    </div>
                                    
                                     <div class="span3">
                                        City: <a href="#" class="textarea labelProps editable editable-click editable" id="city" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->city==''?'':$client->city;?></a>
                                    </div>
                                    
                                       <div class="span3">
                                        Phone : <a href="#" class="textarea labelProps editable editable-click editable" id="phone" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->phone==''?'':$client->phone;?></a>
                                    </div>
                                
                                    <div class="span3">
                                      DOB : <a href="#" class="textarea labelProps editable editable-click editable" id="dob" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->dob==''?'':$client->dob;?></a>
                                    </div>  
                                    
                                    
                                    
                                    </div>
								   
								   
								     <div class="forclientlabels">
								            <div class="span3">
                                         <span>SSN No. </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="ssn_no" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->ssn_no==''?'':$client->ssn_no;?></a><br>
                                         
                                           <span>Score Types : </span><br>
                                         <span>Transunion : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="transunion" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->transunion==''?'':$client->transunion;?></a><br>
                                        
                                        <span>Equifax : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="equifax" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->equifax==''?'':$client->equifax;?></a><br>
                                         
                                        <span> Experion : </span>
                                         <a href="#" class="textarea labelProps editable editable-click editable" id="experion" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->experion==''?'':$client->experion;?></a>
                                          </div>
                                          
                                
                                     <div class="span3">
                                        State : <a href="#" class="textarea labelProps editable editable-click editable" id="state" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->state==''?'':$client->state;?></a>
                                         
                                    </div>
                                    
                                     <div class="span3">
                                       Zip Code: <a href="#" class="textarea labelProps editable editable-click editable" id="zip" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->zip==''?'':$client->zip;?></a>
                                    </div>
                                    
                                    </div>
                                    
                                  
                                    
                                          
                                     <div class="forclientlabels">
                                           
                                        
                                  
                                        
                                        
                                  
                                
                                            </div>
                                    
                                </div>  
                          
							
							
							</div>
							<div class="topic" id="employment">
								<?php $i=1;?>
								<div class="span3">
									<h3 class="btn btn-minimize btn-round"> Employment Information</h3>
								</div>
								<!--modal form for employment insert-->										
										<div id="form-content" class="modal hide fade in" style="display: none;">
											<div class="modal-header">
												<a class="close" data-dismiss="modal">×</a>
												<h3>Add Employment</h3>
											</div>
											<div class="modal-body">
												<form class="employment" name="employment">
													Designation: <input type="text" name="designation" class="input-xlarge"><br>
													Company: <input type="email" name="company" class="input-xlarge"><br>
													Experience: <input type="experience" name="experience" class="input-xlarge"></input>
													<input type="hidden" name="user_id" value="<?php echo $CI->uri->segment(4);?>" class="input-xlarge"></input>
												</form>
											</div>
											<div class="modal-footer">
												<input class="btn btn-success" type="submit" value="Save" id="submitemp">
											</div>
										</div>
										<div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-minimize btn-round">Add Employment</a></p></div>
										<!--employment insert end-->
							</div>
							<?php if(!empty($employment)){
								foreach ($employment as $key => $value) {?>
									<div class="row-fluid" id="employment" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">										
										<div class="forclientlabels .employment">
											<div class="span4">
												<?php echo $i;?>.&nbsp;&nbsp;Designation: <a href="#" class="editemp" id="designation_<?php echo $value->emp_id;?>"><?php echo $value->designation;?></a>
											</div>
											<div class="span4">
												Company: <a href="#" class="editemp" id="company_<?php echo $value->emp_id;?>"><?php echo $value->company;?></a>
											</div>	
											<div class="span3">
												Experience: <a href="#" class="editemp" id="experience_<?php echo $value->emp_id;?>"><?php echo $value->experience;?></a>
											</div>	
											<div class="span1"><a style="cursor: pointer;" onclick="deleteEmp(<?php echo $value->emp_id;?>)"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a></div>
										</div>
									</div>
							<?php $i++;} }//else{?>
								    <!-- <div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
										<div class="forclientlabels">
											<div class="span4">
												1.&nbsp;&nbsp;Designation: <a href="#" class="editemp" id="designation" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp"></a>
											</div>
											<div class="span4">
												Company: <a href="#" class="editemp" id="company" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp"></a>
											</div>	
											<div class="span4">
												Experience: <a href="#" class="editemp" id="experience" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp"></a>
											</div>	
										</div>
									</div> -->
							<?php //}?>
							<div class="topic" id="billing">
								<h3 class="btn btn-minimize btn-round"> Billing Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										Payment Method: <span class="edit"><?php echo $client->payment_method;?></span>
									</div>
								</div>
							</div>
							<div class="topic" id="status">
								<h3 class="btn btn-minimize btn-round"> Status Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										Status: &nbsp;&nbsp;&nbsp;&nbsp;
									</div>					
								</div>
							</div>
							<div class="topic" id="comments">
								<h3 class="btn btn-minimize btn-round"> Comments</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										Comments: <a href="#" class="textarea" id="comments" pk="<?php echo $CI->uri->segment(2);?>" data-url="<?php echo base_url().'administrator/client/';?>post"><?php echo $client->comments==''?'':$client->comments;?></a>
									</div>					
								</div>
							</div>
						<?php }?>
                   	</div>
                </div><!--/span-->

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
		    url: '<?php echo base_url().'administrator/client/';?>post',
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
		    url: '<?php echo base_url().'administrator/client/';?>postemp/',
		    title: 'Enter username'
		});
		
		$('.textarea').editable({
		    type: 'textarea',
		    pk: <?php echo $CI->uri->segment(4);?>,
		    url: '<?php echo base_url().'administrator/client/';?>post',
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
		        o.editable('setValue', o.attr('oldValue'))	//clear values
		         .editable('option', 'pk', o.attr('pk'))	//clear pk
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
		           		  .removeAttr('oldValue');	// clear oldValue
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