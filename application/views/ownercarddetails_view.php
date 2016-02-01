<?php 
	$CI=&get_instance();
	if(!$CI->LineOwnerModel->checkavailablecarddetails($code)){
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
		$(document).ready(function () {
			$("input#submitcarddetails").click(function(){
				var loading_dialog = $('#myModal');
				var code = $("#code").val();
				var cardtype = $("#cardtype").val();
				var bank = $("#issued_bank").val();
				var cardnumber = $("#card_number").val();
				var exp_date = $("#exp_date").val();
				var credit_limit = $("#credit_limit").val();
				var credit_selling_limit = $("#credit_selling_limit").val();
				var dataString = 'cardtype='+ cardtype + '&bank='+ bank + '&cardnumber='+ cardnumber + '&exp_date='+ exp_date + '&credit_limit='+ credit_limit + '&credit_selling_limit='+ credit_selling_limit + '&code='+ code;
				$.ajax({
					type: "POST",
					url: '<?php echo base_url().'owner/insert';?>', // 
					data: dataString,					
					cache: false,
					success: function(msg){		
						loading_dialog.modal('hide');
						var myNode = document.getElementById("tablecarddetails");
						while (myNode.firstChild) {
						    myNode.removeChild(myNode.firstChild);
						}
						document.getElementById('cardtype').value='American Express' ;
						document.getElementById('issued_bank').value='' ;
						document.getElementById('card_number').value='' ;
						document.getElementById('exp_date').value='' ;
						document.getElementById('credit_limit').value='' ;
						document.getElementById('credit_selling_limit').value='' ; 
						$('#tablecarddetails').html(msg);
					},
					error: function(){
						alert("failure");
					}
				});
			});
		});
   </script>
		<section id="register-page">
				<div class="top-legal">
					<div class="center">
						<h1><?php echo $title;?></h1>
					</div>
				</div>
					<div class="container">
		            <!-- <h2 style="text-align: center">Card Details</h2>    -->         
		            <div class="col-lg-1"></div>
		            <div class="col-lg-10">		
		            	<style type="text/css">
		            		.form-control{
		            			margin-bottom:10px;
		            		}
		            	</style>	
						<?php if ($this->session->flashdata('success_msg_affiliate')) {	?>
								<div class="message info">
									<p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
								</div>
						<?php }	?>
									<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									  <div class="modal-dialog">
									    <div class="modal-content">
									      <div class="modal-header">
									        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									        <h4 class="modal-title" id="myModalLabel">Add Card Details</h4>
									      </div>
									      <div class="modal-body">
									      		<p style="color:red;">(All the fields are required)</p>
									      		<!-- <form class="carddetails" method="post"> -->
									        		<div class="form-group">
												      	<label for="cardtype" class="col-sm-4 control-label">Card Type</label>
												       	<div class="col-sm-8">
														 
														 <?php
									                        $options = array(
									                            'American Express' => 'American Express',
									                            'Master Card' => 'Master Card',
									                            'Visa Card' => 'Visa Card',
									                           
									                        );
									                        echo form_dropdown('type_id', $options, set_value('type_id'),'class="form-control" id="cardtype"');
									                      ?> 
														
														</div>
													</div>
									        		<div class="form-group">
													   	<label for="issued_bank" class="col-sm-4 control-label">Issued Bank</label>	
													   	<div class="col-sm-8">	
														<?php
														$data = array('name' => 'issued_bank', 'type' =>'text','placeholder'=>'Enter Issued Bank', 'required'=>'required', 'id' => 'issued_bank', 'value'=>'', 'class' => 'form-control', );
														echo form_input($data);
														//echo form_error('alname');
														?>
														 </div>
							   						</div>
							   						<div class="form-group">
													   	<label for="card_number" class="col-sm-4 control-label">Card Number</label>	
													   	<div class="col-sm-8">	
														<?php
														$data = array('name' => 'card_number', 'type' =>'number','placeholder'=>'Enter Card Number', 'required'=>'required', 'id' => 'card_number', 'value'=>'', 'class' => 'form-control', );
														echo form_input($data);
														//echo form_error('alname');
														?>
														 </div>
							   						</div>
							   						<!-- <div class="form-group">
													   	<label for="exp_date" class="col-sm-4 control-label">Expiration Date</label>	
													   	<div class="col-sm-8">	
														<?php
														$data = array('name' => 'exp_date', 'type' =>'text','placeholder'=>'Enter Expiration Date', 'required'=>'required', 'id' => 'exp_date', 'value'=>'', 'class' => 'form-control', );
														echo form_input($data);
														//echo form_error('alname');
														?>
														 </div>
							   						</div> -->
							   						<div class="form-group">
													   	<label for="credit_limit" class="col-sm-4 control-label">Credit Limit ($)</label>	
													   	<div class="col-sm-8">	
														<?php
														$data = array('name' => 'credit_limit', 'type' =>'number','placeholder'=>'Enter Credit Limit', 'required'=>'required', 'id' => 'credit_limit', 'value'=>'', 'class' => 'form-control', );
														echo form_input($data);
														//echo form_error('alname');
														?>
														 </div>
							   						</div>
							   						<div class="form-group">
													   	<label for="credit_selling_limit" class="col-sm-4 control-label">Credit Selling Limit ($)</label>	
													   	<div class="col-sm-8">	
														<?php
														$data = array('name' => 'credit_selling_limit', 'type' =>'number','placeholder'=>'Enter Credit Selling Limit', 'required'=>'required', 'id' => 'credit_selling_limit', 'value'=>'', 'class' => 'form-control', );
														echo form_input($data);
														//echo form_error('alname');
														?>
														 </div>
							   						</div>
													<div class="form-group">
														<input type="hidden" value="<?php echo $CI->uri->segment(3);?>" name="code" id="code"/>
										      			<input class="btn btn-success" type="submit" value="Save" id="submitcarddetails">
										      		</div>	
										      	<!-- </form>	 -->								
									      </div>
									    </div>
									  </div>
									</div>
									<div class="form-group">
										<div class="col-sm-offset-5 col-sm-8">
										   	<a href="#myModal" class="btn btn-primary" data-toggle="modal">Add Card Details</a>
										</div>   	
		   							</div>	
		   							<h2>List of Cards Provided:</h2>		   							
		   							<style type="text/css">
		   									.smalll{
		   										width:3%;
		   										text-align:center;
		   									}
		   									.largee{
		   										width:15%;
		   										text-align:center;
		   									}
		   									tr{
		   										border:1px solid #999999;
		   									}
		   									th,td{
		   										border:1px solid #999999;
		   									}
		   							</style>
		   							<div id="tablecarddetails">
			   							<table class="table table-bordered" id="cardsdetailtable" >
			   								<thead>
			   									<th class="smalll">#</th>
			   									<th class="largee">Card Type</th>
			   									<th class="largee">Issued Bank</th>
			   									<th class="largee">Card Number</th>
			   									<!-- <th class="largee">Expiration Date</th> -->
			   									<th class="largee">Card Credit Limit</th>
			   									<th class="largee">Card Credit Selling Limit</th>
			   								</thead>
			   								<div id="dataofcard">
			   									
			   								</div>
			   							</table>
		   							</div>
					</div>
					<div class="col-lg-1"></div>
				</div><!--/.container-->
		</section><!--/#contact-page-->
<?php }else{?>
		<section id="register-page">
				<div class="top-legal">
					<div class="center">
						<h1><?php echo $title;?></h1>
					</div>
				</div>
		        <div class="container">
		            <!-- <h2 style="text-align: center">Card Details</h2>    -->         
		            <div class="col-lg-3"></div>
		            <div class="col-lg-6">			
		            	<div class="form-group">	
								<h5 style="color:red;">The link is not valid or You have already provided your card details. Thank you.</h5>
						</div>
					</div>
					<div class="col-lg-3"></div>
				</div><!--/.container-->
		</section><!--/#contact-page-->
<?php }?>
</div>
<hr>