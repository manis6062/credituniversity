<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999",{placeholder:"MM/DD/YYYY"});
   $("#pcon").mask("(999) 999-9999",{placeholder:" "});
   $("#scon").mask("(999) 999-9999",{placeholder:" "});
   $("#zip").mask("99999",{placeholder:" "});
   $("#ssn_no").mask("999-99-9999",{placeholder:" "});
   $("#cpn_no").mask("999-99-9999",{placeholder:" "});
    $("#tax_no").mask("999-99-9999",{placeholder:" "});
    $("#transunion").mask("999",{placeholder:" "});
     $("#equifax").mask("999",{placeholder:" "});
     $("#experion").mask("999",{placeholder:" "});
     
      $("#cpn_transunion").mask("999",{placeholder:" "});
     $("#cpn_equifax").mask("999",{placeholder:" "});
     $("#cpn_experion").mask("999",{placeholder:" "});
     
      $("#tax_transunion").mask("999",{placeholder:" "});
     $("#tax_equifax").mask("999",{placeholder:" "});
     $("#tax_experion").mask("999",{placeholder:" "});
     
     
      $("#cpn_score").mask("999",{placeholder:" "});
});

// function showMe(it, box) {
  // var vis = (box.checked) ? "block" : "none";
  //document.getElementById(it).style.display = vis;
</script>
  <div id="content" class="span10"> 
  <div class="row-fluid">
    <div class="box span12">
      <div class="box-header well" data-original-title>
        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
      </div>
      <div class="box-content">
      <?php if ($this->session->flashdata('success_msg_affiliate')) {
					?>
      <div class="message info">
        <p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
      </div>
      <?php } ?>
      <?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal box1');
						echo form_open(ADMIN_PATH. 'client/addAction', $attributes);
						?>
      <?php // if(validation_errors())
								// {
								// echo validation_errors();
								// }

	?>
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
	    <!-- Load jQuery UI Main JS  -->
	    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  	
		 <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
	  yearRange: "-100:+0"
	  
    });
  });
  </script> 
		
<style>
.controls1{
	width:30%;
	float: left;
	margin-right: 17px;
	padding-top:5px;
}
.form-horizontal .controls {
margin-left: 100px;}
.form-horizontal .controls2 {
margin-left: 50px;}
.controls1:last-child{
	margin:0px;
}
.controls1 lavel{
	width:90px;
}
.form-horizontal .control-label {
width: 90px;
}
.box-content{
	padding-top:25px;
}
.controls input{
	width:94%;
}
select{
	width:98%;
	border-radius:3px;
}
.form-horizontal .control-group{
	margin-bottom:20px;
}
</style>    
		<input type="hidden"name="ref_id" value="<?php echo $ref_id?>" />
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">First Name*</label>
        			<div class="controls">
              		<?php $data = array('name' => 'fname', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'value' => set_value('fname'), 'class' => 'form-control', );

							echo form_input($data);
							echo form_error('fname');
							?>
        			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">Middle Name</label>
        			<div class="controls">
              		<?php $data = array('name' => 'mname', 'id' => 'mname', 'placeholder' => 'Enter Middle Name', 'value' => set_value('mname'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('mname');
                            ?>
        			</div>
    			</div>
			</div>							
		</div>
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">Last Name *</label>
        			<div class="controls">
              		<?php $data = array('name' => 'lname', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'value' => set_value('lname'), 'class' => 'form-control', );
							echo form_input($data);
							echo form_error('lname');
							?>
        			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Date of Birth *</label>
        				<div class="controls">
              	      <?php
                            $data = array('name' => 'dob', 'id' => 'datepicker', 'placeholder' => 'MM/DD/YYYY', 'value' => set_value('dob'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('dob');
                            ?>
    			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">SSN No*</label>
        			<div class="controls">
              		<?php $data = array('name' => 'ssn_no', 'id' => 'ssn_no', 'placeholder' => 'SSN No', 'value' => set_value('ssn_no'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('ssn_no');
                            ?>
        			</div>
    			</div>
			</div>					
		</div>
		
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Transunion</label>
        				<div class="controls">
              		<?php $data = array('name' => 'transunion', 'id' => 'transunion', 'placeholder' => 'SSN Transunion', 'value' => set_value('transunion'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('transunion');  ?>
    			</div>
    			</div>
			</div>	
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Equifax</label>
        				<div class="controls">
	              	<?php $data = array('name' => 'experion', 'id' => 'equifax', 'placeholder' => 'SSN Equifax', 'value' => set_value('equifax'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('equifax');
                            ?>
    			</div>
    			</div>
			</div>	
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Experion</label>
        				<div class="controls">
              		<?php $data = array('name' => 'experion', 'id' => 'experion', 'placeholder' => 'SSN Experion', 'value' => set_value('experion'), 'class' => 'form-control', );
                            echo form_input($data);
                            echo form_error('experion');
                            ?>
    			</div>
    			</div>
			</div>	
				
		</div>
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">State</label>
        			<div class="controls">
              		<?php
                            foreach($states as $state){
                                $drop[$state->id] = $state->state;
                                }
                            $drop = array_merge(array('' => 'Select Your State'), $drop); 
                            echo form_dropdown('state', $drop,set_value('state'), 'class="form-control"');
                            echo form_error('state');
                            ?>
    			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
        			<label class="control-label" for="inputType">Gender</label>
        			<div class="controls">
              		<?php $options = array(
								// '' => 'Gender',
								'' => 'Select Your Gender' ,
								'Male' => 'Male', 'Female' => 'Female', );
								echo form_dropdown('gender', $options, set_value('gender'), 'class="form-control"');
								echo form_error('gender');
		                      ?>
        			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Zip Code</label>
        			<div class="controls">
              		<?php $data = array('name' => 'zip', 'id' => 'zip', 'placeholder' => 'Zip Code', 'value' => set_value('zip'), 'class' => 'form-control', );
							echo form_input($data);
							echo form_error('zip');
							?>
        			</div>        			
			</div>		
		</div>
		</div>
		<div class="row-fluid">
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Contact No.</label>
        				<div class="controls">
              		<?php $data = array('name' => 'pcon', 'id' => 'pcon', 'placeholder' => 'Primary Contact No.', 'value' => set_value('pcon'), 'class'=>'form-control' );
							echo form_input($data);
							echo form_error('pcon');
							?>
    			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Email</label>
        				<div class="controls">
              		<?php $data = array('name' => 'email','placeholder' => 'Enter Email Address', 'id' => 'email', 'value' => set_value('email'), 'class' => 'form-control', );
								echo form_input($data);
							echo form_error('email');
							?>
    			</div>
    			</div>
			</div>
		
			
		</div>		
		<div class="row-fluid even">
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Username</label>
        				<div class="controls">
              		<?php $data = array('name' => 'uname', 'id' => 'uname', 'placeholder' => 'Enter Your Username', 'value' => set_value('uname'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('uname');
                            ?>
    			</div>
    			</div>
			</div>
			<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Password</label>
        				<div class="controls">
              		<?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('password');
                            ?>
            		<p class="note">(Minumum 5 character and maximum 12 characters)</p>
    			</div>
    			</div>
			</div>
					<div class="span4">
				<div class="control-group">
					<label class="control-label" for="inputType">Confirm Password</label>
        				<div class="controls">
              	<?php $data = array('name' => 'cpassword', 'type' => 'password', 'placeholder' => 'Re-enter Password', 'id' => 'cpassword', 'value' => set_value('cpassword'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('cpassword');
                            ?>
            <p class="note">(Minumum 5 character and maximum 12 characters)</p>
    			</div>
    			</div>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span4"></div>
			<div class="span6">
				<div class="control-group">
					        			<div class="controls1">
              		<?php
		                   	$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default', );

							echo form_submit($data);
							?>
            		<a href="<?php echo site_url(ADMIN_PATH . 'client'); ?>" class="btn btn-default">Cancel</a>
        			</div>
        		</div>
			</div>
		</div>
		    <?php echo form_close(); ?> 
	</div>
    </div>
  </div>
</div>
</div>
<hr>

