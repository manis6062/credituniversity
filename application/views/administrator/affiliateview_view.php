<?php 
	$CI = &get_instance();
	$user_id = $CI->uri->segment(4);
	$affiliate_id = $CI->AffiliateModel->getaffiliateid($user_id);
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
					url: '<?php echo base_url().'administrator/affiliate/';?>insertemp/referrer', //
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
					url: '<?php echo base_url().'administrator/affiliate/';?>deleteEmp/'+emp_id, // 
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
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?> <?php echo $affiliate->affiliate_fname.' '.$affiliate->affiliate_lname;?></h2>
                    </div>
                    <div class="box-content">
                    	<?php
						if (!empty($affiliate)) {
							if(checkUserType()=='2' || checkUserType()=='3'){
							?>
							<div class="topic" id="basicinfo">
								<h3 class="btn btn-minimize btn-round">Basic Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										First Name: <a href="#" class="edit" id="affiliate_fname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_fname;?></a>
									</div>
									<div class="span3">
										Last Name: <a href="#" class="edit" id="affiliate_lname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_lname;?></a>
									</div>
									<div class="span3">
										Email: <a href="#" class="edit" id="affiliate_email" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_email;?></a>
									</div>	
									<div class="span3">
										Business: <a href="#" class="edit" id="affiliate_business" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_business;?></a>
									</div>	
								</div>
								<div class="forclientlabels">
									<div class="span3">
										Gender: <a href="#" class="detail" id="affiliate_detail_gender" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_gender;?></a>
									</div>
									<div class="span3">
										City: <a href="#" class="detail" id="affiliate_detail_city" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_city;?></a>
									</div>
									<div class="span3">
										Zip: <a href="#" class="detail" id="affiliate_detail_zip" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_zip;?></a>
									</div>
									<div class="span3">
										State: <a href="#" class="detail" id="affiliate_detail_state" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_state;?></a>
									</div>	
								</div>	
								<div class="forclientlabels">
									<div class="span3">
										Address: <a href="#" class="detail" id="affiliate_detail_address" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_address;?></a>
									</div>
									<div class="span3">
										SSN: <a href="#" class="detail" id="affiliate_detail_ssn" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_ssn;?></a>
									</div>
									<div class="span3">
										DOB: <a href="#" class="detail" id="affiliate_detail_dob" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>postdetail"><?php echo $affiliate->affiliate_detail_dob;?></a>
									</div>	
									<div class="span3">
										Primary Contact: <a href="#" class="edit" id="affiliate_primary_contact" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_primary_contact;?></a>
									</div>
								</div>							
								<div class="forclientlabels">									
									<div class="span3">
										Secondary Contact: <a href="#" class="edit" id="affiliate_secondary_contact" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_secondary_contact;?></a>
									</div>
									<div class="span3">
										Paypal Merchant ID: <a href="#" class="edit" id="affiliate_paypal_account" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_paypal_account;?></a>
									</div>
									<div class="span3">
										Client Registration Charge: <a href="#" class="edit" id="affiliate_client_reg_charge" pk="<?php echo $affiliate_id;?>" data-url="<?php echo base_url().'administrator/affiliate/';?>post"><?php echo $affiliate->affiliate_client_reg_charge;?></a>
									</div>
									<div class="span3">
										Payment Status: <?php echo $affiliate->affiliate_payment_status;?>
									</div>	
									<div class="span3">
										Registered Date: <?php echo $affiliate->affiliate_registered_date;?>
									</div>	
								</div>
							</div>
							<div class="topic" id="employment">
								<?php $i=1;?>
								<div class="span3">
									<h3 class="btn btn-minimize btn-round"> Business Information</h3>
								</div>
								<!--modal form for employment insert-->										
										<div id="form-content" class="modal hide fade in" style="display: none;">
											<div class="modal-header">
												<a class="close" data-dismiss="modal">×</a>
												<h3>Add Business</h3>
											</div>
											<div class="modal-body">
												<form class="employment" name="employment">
													<div class="col-lg-2">Business Name:</div><div class="col-lg-10"><input type="email" name="company" class="input-xlarge"></div>
													<div class="col-lg-2">Designation:</div><div class="col-lg-10"><input type="text" name="designation" class="input-xlarge"></div>
													<div class="col-lg-2">Running Years:</div><div class="col-lg-10"><input type="text" name="experience" class="input-xlarge"></input></div>
													<input type="hidden" name="user_id" value="<?php echo $CI->uri->segment(4);?>" class="input-xlarge"></input>
												</form>
											</div>
											<div class="modal-footer">
												<input class="btn btn-success" type="submit" value="Save" id="submitemp">
											</div>
										</div>
										<div id="thanks"><p><a data-toggle="modal" href="#form-content" class="btn btn-minimize btn-round">Add Business</a></p></div>
										<!--employment insert end-->
							</div>
							<?php if(!empty($employment)){
								foreach ($employment as $key => $value) {?>
									<div class="row-fluid" id="employment" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">										
										<div class="forclientlabels .employment">
											<div class="span4">
												<?php echo $i;?>.&nbsp;&nbsp;Business Name: <a href="#" class="editemp" id="company_<?php echo $value->emp_id;?>"><?php echo $value->company;?></a>
											</div>
											<div class="span4">
												Designation: <a href="#" class="editemp" id="designation_<?php echo $value->emp_id;?>"><?php echo $value->designation;?></a>
											</div>	
											<div class="span3">
												Running Years: <a href="#" class="editemp" id="experience_<?php echo $value->emp_id;?>"><?php echo $value->experience;?></a>
											</div>	
											<div class="span1"><a style="cursor: pointer;" onclick="deleteEmp(<?php echo $value->emp_id;?>)"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a></div>
										</div>
									</div>
							<?php $i++;} }//else{?>
								    <!-- <div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
										<div class="forclientlabels">
											<div class="span4">
												1.&nbsp;&nbsp;Designation: <a href="#" class="editemp" id="designation" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
											</div>
											<div class="span4">
												Company: <a href="#" class="editemp" id="company" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
											</div>	
											<div class="span4">
												Experience: <a href="#" class="editemp" id="experience" pk="0" data-url="<?php echo base_url().'administrator/client/';?>postemp">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
											</div>	
										</div>
									</div> -->
							<?php //}?>							
						<?php } elseif(checkUserType()=='1'){?>
							<div class="topic" id="basicinfo">
								<h3 class="btn btn-minimize btn-round">Basic Information</h3>
							</div>
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										First Name: <?php echo $affiliate->affiliate_fname;?>
									</div>
									<div class="span3">
										Last Name: <?php echo $affiliate->affiliate_lname;?>
									</div>
									<div class="span3">
										Email: <?php echo $affiliate->affiliate_email;?>
									</div>	
									<div class="span3">
										Business: <?php echo $affiliate->affiliate_business;?>
									</div>	
								</div>
								<div class="forclientlabels">
									<div class="span3">
										Gender: <?php echo $affiliate->affiliate_detail_gender;?>
									</div>
									<div class="span3">
										City: <?php echo $affiliate->affiliate_detail_city;?>
									</div>
									<div class="span3">
										Zip: <?php echo $affiliate->affiliate_detail_zip;?>
									</div>	
									<div class="span3">
										State: <?php echo $affiliate->affiliate_detail_state;?>
									</div>	
								</div>	
								<div class="forclientlabels">
									<div class="span3">
										Address: <?php echo $affiliate->affiliate_detail_address;?>
									</div>
									<div class="span3">
										SSN: <?php echo $affiliate->affiliate_detail_ssn;?>
									</div>
									<div class="span3">
										DOB: <?php echo $affiliate->affiliate_detail_dob;?>
									</div>	
									<div class="span3">
										Primary Contact: <?php echo $affiliate->affiliate_primary_contact;?>
									</div>
								</div>							
								<div class="forclientlabels">									
									<div class="span3">
										Secondary Contact: <?php echo $affiliate->affiliate_secondary_contact;?>
									</div>
									<div class="span3">
										Payment Status: <?php echo $affiliate->affiliate_payment_status;?>
									</div>	
									<div class="span3">
										Registered Date: <?php echo $affiliate->affiliate_registered_date;?>
									</div>	
								</div>
							</div>
							<div class="topic" id="employment">
								<?php $i=1;?>
								<div class="span3">
									<h3 class="btn btn-minimize btn-round"> Business Information</h3>
								</div>
							</div>
							<?php if(!empty($employment)){
								foreach ($employment as $key => $value) {?>
									<div class="row-fluid" id="employment" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">										
										<div class="forclientlabels .employment">
											<div class="span4">
												<?php echo $i;?>.&nbsp;&nbsp;Business Name: <?php echo $value->company;?>
											</div>	
											<div class="span4">
												Designation: <?php echo $value->designation;?>
											</div>
											<div class="span3">
												Running Years: <?php echo $value->experience;?>
											</div>	
										</div>
									</div>
							<?php $i++;} }//else{?>							
						<?php }}?>
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
		$.fn.editable.defaults.type = 'text';
		
		// make all items having class 'edit' editable
		//$('.edit').editable();
		
		// make editable
		$('.edit').editable({
		    type: 'text',
		    pk: <?php echo $user_id;?>,
		    url: '<?php echo base_url().'administrator/affiliate/post';?>',
		    title: 'Enter username'
		});
		$('.edit').editable('option','validate', function (v) {
            if ($.trim(v) == '') { return 'Required field!'; }
        });
		$('.detail').editable({
		    type: 'text',
		    pk: <?php echo $affiliate_id;?>,
		    url: '<?php echo base_url().'administrator/affiliate/postdetail';?>',
		    title: 'Enter username'
		});
		
		$('.editemp').editable({
			// id: document.getElementById("number").value,
			//ck: document.getElementById("emp_id" + document.getElementById("number").value).value,
		    type: 'text',
		    pk: <?php echo $CI->uri->segment(4);?>,
		    url: '<?php echo base_url().'administrator/affiliate/';?>postemp/',
		    title: 'Enter username'
		});
		
		$('.textarea').editable({
		    type: 'textarea',
		    pk: <?php echo $CI->uri->segment(4);?>,
		    url: '<?php echo base_url().'administrator/affiliate/';?>post',
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