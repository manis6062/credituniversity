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
    $(document).ready(function() {
        $('.textarea').keydown(function(event) {
            if (event.keyCode == 13) {
                this.form.submit();
                return false;
            }
        });
    });
</script>

<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid sortable">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?> <?php echo $referrers_details->ref_fname.' '.$referrers_details->ref_lname;?></h2>
                    </div>
                    <div class="box-content">
                    	<?php
						if (!empty($referrers_details)) {
							if(checkUserType()=='4' || checkUserType()=='2' || checkUserType()=='3'){
							?>
							<!-- <div class="topic" id="basicinfo">
								<h3 class="btn btn-minimize btn-round">Basic Information</h3>
							</div> -->
							<div class="row-fluid" style="background-color: #f5f5f5; border-top: 1px solid #e5e5e5; border-radius: 10px;">
								<div class="forclientlabels">
									<div class="span3">
										First Name: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_fname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_fname==''?'':$referrers_details->ref_fname;?></a>
									</div>
									<div class="span3">
										Last Name: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_lname" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_lname==''?'':$referrers_details->ref_lname;?></a>
									</div>
									<div class="span3">
										Email: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_email" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_email==''?'':$referrers_details->ref_email;?></a>
									</div>	
									<div class="span3">
										Gender: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_gender" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_gender==''?'':$referrers_details->ref_gender;?></a>
									</div>
								
								</div>
								<div class="forclientlabels">
									
									<div class="span3">
										City: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_city" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_city==''?'':$referrers_details->ref_city;?></a>
									</div>
									<div class="span3">
										Zip: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_zip" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_zip==''?'':$referrers_details->ref_zip;?></a>
									</div>	
									<div class="span3">
										State: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_state" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_state==''?'':$referrers_details->ref_state;?></a>
									</div>	
									
									<div class="span3">
										Address: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_address" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_address==''?'':$referrers_details->ref_address;?></a>
									</div>
								</div>	
								<div class="forclientlabels">
									
									<div class="span3">
										SSN: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_ssn"pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_ssn==''?'':$referrers_details->ref_ssn;?></a>
									</div>
									<div class="span3">
										DOB: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_dob" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_dob==''?'':$referrers_details->ref_dob;?></a>
									</div>	
									<div class="span3">
										Primary Contact: <a href="#" class="textarea labelProps editable editable-click editable" id="ref_primary_contact" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_primary_contact==''?'':$referrers_details->ref_primary_contact;?></a>
									</div>
									<div class="span3">
										Secondary Contact: <a href="#" class="edit labelProps editable editable-click editable" id="ref_secondary_contact" pk="<?php echo $user_id;?>" data-url="<?php echo base_url().'administrator/referrer/';?>post"><?php echo $referrers_details->ref_secondary_contact==''?'       ':$referrers_details->ref_secondary_contact;?></a>
									</div>
								</div>							
							
							</div>
				<?php }} ?>
                   	</div>
                </div><!--/span-->

            </div><!--/row-->
            
             <a href="<?php echo site_url(ADMIN_PATH . 'referrer/referrerList'); ?>" class="btn btn-primary">Back To referrer Lists</a>
              
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
		    url: '<?php echo base_url().'administrator/referrer/';?>post',
		    title: 'Enter username'
		});

		$('.editemp').editable({
			// id: document.getElementById("number").value,
			//ck: document.getElementById("emp_id" + document.getElementById("number").value).value,
		    type: 'text',
		    pk: <?php echo $CI->uri->segment(4);?>,
		    url: '<?php echo base_url().'administrator/referrer/';?>postemp/',
		    title: 'Enter username'
		});
		
		$('.textarea').editable({
		    type: 'textarea',
		    pk: <?php echo $user_id;?>,
		    url: '<?php echo base_url().'administrator/referrer/';?>post',
		    title: 'Enter username'


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
                   if (event.keyCode == 13) {
                       this.form.submit();
                       return false;
                   }
		       }
		   });
		});
	}); 
</script>
</div>
<hr>