<style>
    .ui-datepicker-calendar {
        display: none;
    }
    #myselect-container {
        position:relative;
        height:10px;
        width:100px;
        /*for contain our absoulte select tag */
    }
    #myselect-container select {
        position:absolute;
        /*for put our list on other tag */

    }
        }
</style>
<script type="text/javascript">
jQuery(function($){
   $("#card_exp_date").mask("99/9999",{placeholder:"MM/YYYY"});
   $("#card_open_date").mask("99/9999",{placeholder:"MM/YYYY"});
    $("#card_close_date").mask("99",{placeholder:"DD"});

  //    $("#card_score").mask("999",{placeholder:" "});
      $("#cphone").mask("(999) 999-9999",{placeholder:" "});
      
      
      $(document).ready(function() {
    $("#balance , #credit_limit , #no_auth_user , #charge").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
});
      
});



  </script>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<!-- Load jQuery UI Main JS  -->
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>

<script>
    $(function() {
        $('#datepicker').datepicker(
            {
                dateFormat: "mm/yy",
                changeMonth: true,
                changeYear: true,
                yearRange: "-100:+0",
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1)).trigger('change');
                },
                beforeShow : function(input, inst) {
                    if ((datestr = $(this).val()).length > 0) {
                        year = datestr.substring(datestr.length-4, datestr.length);
                        month = datestr.substring(0, 2);
                        $(this).datepicker('option', 'defaultDate', new Date(year, month-1, 1));
                        $(this).datepicker('setDate', new Date(year, month-1, 1));
                    }
                }
            }).focus(function () {
                $(".ui-datepicker-calendar").hide();
                $("#ui-datepicker-div").position({
                    my: "center top",
                    at: "center bottom",
                    of: $(this)
                });
            });
    });
</script>

<div id="content" class="span10">


            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
            <?php
            if (validation_errors()) {
                ?>
                <div class="message error"></div> 
                <?php } ?>
            <?php $attributes = array('class' => 'formular');
           
                echo form_open(ADMIN_PATH . 'lineowner/addCardAction/'.$owner_id.'/'.$owner_name, $attributes);
           
            ?>
            <table class="form">
            	<!-- <p style="color:red;">(Fields marked with '*' are required.)</p> -->
            			<tr>
            	        <td class="col1">
		                     <label>Card Type <strong class="red">*</strong></label> 
		                    </td>
		                    <td class="col2">
		                   
		                   <div id = "dropdown">
                               <input type="hidden" name="referrer_id" value="<?php echo $ref_id;?>">
		                     <?php
                            foreach($card_lists as $cards){
                                $drop[$cards->card_name] = $cards->card_name;
                                }
                            $dropped = array_merge(array('' => 'Select Your Card Type'), $drop,  array('Others' => 'Others')); 
                                
								echo form_dropdown('card_name', $dropped, set_value('card_name'), 'class="form-control"');
								echo form_error('card_name');
                                
		                      ?> 
		                      </div>
		                       <td>
                            <div id ="Card" style="display: none">
                                 <?php $data = array('name' => 'new_card',  'placeholder' => 'Enter Credit Card Type', 'value' => set_value('new_card'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('new_card');
                                 ?>
                            </div>
                            
                            
                            <p ></p>
                            </td>
							<p>
							    
							</p>
		                    </td>
		                   
		                  
		                    
		                </tr>
		            
		          
		                
		                
		                <script>
		  $('#dropdown select[name = card_name]').change(function(e){
  if ($('#dropdown select[name = card_name]').val() == 'Others'){
    $('#Card').show();
  }else{
    $('#Card').hide();
  }
});
              </script>
		                
		                
		                
		                <tr>
		                    <td class="col1">
		                     <label>Card Name </label> 
		                    </td>
		                    <td class="col2">
		                        
		                        <?php $data = array('name' => 'type_id',  'placeholder' => 'Enter Credit Card Name', 'id' => 'type_id', 'value' => set_value('type_id'), 'class' => 'form-control', );
								echo form_input($data);
                                
								
							?>
							<p ></p>
		                    </td>
		                </tr>
		                
		                
		                
		                <tr>
		                    <td class="col1">
		                     <label>Issued Bank <!-- <strong class="red">*</strong> --></label> 
		                    </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'bank',  'placeholder' => 'Enter Bank Name', 'id' => 'bank', 'value' => set_value('bank'), 'class' => 'form-control', );
								echo form_input($data);
								echo form_error('bank');
							?>
							<p ></p>
		                    </td>
		                </tr>
		                
		                <tr>
                            <td class="col1">
                             <label>Bank Website <!-- <strong class="red">*</strong> --></label> 
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'bank_url',  'placeholder' => 'Enter Bank Address Link', 'id' => 'bank_url', 'value' => set_value('bank_url'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('bank_url');echo "(example:www.example.com)";
                            ?>
                            <p ></p>
                            </td>
                        </tr>
		                
		                  <tr>
                            <td class="col1">
                             <label>Credit Limit <!-- <strong class="red">*</strong> --></label> 
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'credit_limit',  'placeholder' => 'Enter Credit Limit', 'id' => 'credit_limit', 'value' => set_value('credit_limit'), 'class' => 'form-control', );
                                echo form_input($data);
                                echo form_error('credit_limit');
                            ?>
                            <p></p>
                            </td>
                        </tr> 
                        
                        
		                
		                
		                
		                <tr>
		                    <td class="col1">
		                     <label>Balance <!-- <strong class="red">*</strong> --></label> 
		                    </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'balance',  'placeholder' => 'Enter Balance', 'id' => 'balance', 'value' => set_value('balance'), 'class' => 'form-control', );
								echo form_input($data);
								echo form_error('balance');
							?>
							<p ></p>
		                    </td>
		                </tr>
	
					
		                
		                 <!-- <tr>
		                    <td class="col1">
		                     <label>No. of Authorized Users <!-- <strong class="red">*</strong> --></label> 
		                    <!-- </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'no_auth_user', 'placeholder' => 'Enter no. of authorized users', 'id' => 'no_auth_user', 'value' => set_value('no_auth_user'), 'class' => 'form-control', );
								echo form_input($data);
								echo form_error('no_auth_user');
							?>
							<p></p>
		                    </td>
		                </tr> -->
		              
		                <!-- <tr>
		                    <td class="col1">
		                     <label> </label> 
		                    </td>
		                    <td class="col2">
		                   	<?php
							$data = array('name' => 'card_exp_date', 'id' => 'card_exp_date', 'placeholder' => 'MM/YYYY', 'value' => set_value('card_exp_date'), 'class' => 'form-control', );
							echo form_input($data);
							echo form_error('card_exp_date');
							?>
							<p></p>
		                   	</td>
		               </tr> -->
		                   
		                   
		                <tr>
		                    <td class="col1">
		                     <label>Member Since <!-- <strong class="red">*</strong> --></label> 
		                    </td>
		                    <td class="col2">
		                   	<?php
							$data = array('name' => 'card_open_date', 'id' => 'datepicker', 'placeholder' => 'MM/YYYY', 'value' => set_value('card_open_date'), 'class' => 'form-control', );
							echo form_input($data);
							echo form_error('card_open_date');
							?>
							<p></p>
		                   	</td>
		               </tr>



                <tr>
                    <td class="col1">
                        <label>Closing Day <strong class="red">*</strong></label>
                    </td>
                    <td class="col2">
                        <?php $options = array(
                            '' => 'Select Closing Day' ,
                            '1' => '1', '2' => '2','3' => '3' ,'4' => '4','5' => '5', '6' => '6', '7' => '7','8' => '8' ,'9' => '9','10' => '10',
                            '11' => '11', '12' => '12','13' => '13' ,'14' => '14','15' => '15', '16' => '16', '17' => '17','18' => '18' ,'19' => '19','20' => '20',
                            '21' => '21', '22' => '22','23' => '23' ,'24' => '24','25' => '25', '26' => '26', '27' => '27','28' => '28' ,'29' => '29','30' => '30','31' => '31');
                        echo form_dropdown('card_close_date', $options, set_value('card_close_date'), 'onmousedown="if(this.options.length>4){this.size=4;}" onchange="this.size=0;" onblur="this.size=0;" onmousehover="this.bgColor=black;"');

                        echo form_error('card_close_date');
                        ?>
                        <p></p>
                </tr>
		               
		                
		                
		                
		               
						
						<tr>
		                    <td class="col1">
		                     <label>Bank Phone number </label> 
		                    </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'cphone',  'placeholder' => 'Enter Bank Phone No.', 'id' => 'cphone', 'value' => set_value('cphone'), 'class' => 'form-control', );
								echo form_input($data);
								echo form_error('cphone');
							?>
							<p ></p>
		                    </td>
		                </tr>
		                
		                
		                
		                
		            
		           <!--     <tr>
		                    <td class="col1">
		                     <label>Charge per 2 months *</label> 
		                    </td>
		                    <td class="col2">
		                        <?php $data = array('name' => 'charge',  'placeholder' => 'Enter charge amount', 'id' => 'cphone', 'value' => set_value('charge'), 'class' => 'form-control', );
								echo form_input($data);
								echo form_error('charge');
							?>
							<p ></p>
		                    </td>
		            </tr>   -->
		               
						
						<tr>
		                    <td class="col1">
		                     <label></label> 
		                    </td>
		                    <td class="col2">
		                   	<?php
							$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default', );
							echo form_submit($data);
                             echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp';
							?>
							
							<?php
                            
                            $data = array( 'value' => 'Cancel', 'class' => 'btn btn-default', );
                            echo form_reset($data);
                            ?>
		                   	</td>
		                </tr>
                
                
                <!-- <tr>
                    <td class="col1" >
                        <?php $attributes = array('class' => 'left', );
                        echo form_label('Payment Type (*):', 'payment', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        if (!empty($photoRecord)) {
                            $data = array('name' => 'phone', 'class'=>'medium', 'required'=>'required', 'id' => 'phone', 'value' => set_value('phone') == "" ? $photoRecord -> line_owner_phone : set_value('phone'),);
                        } else {
                            $data = array('name' => 'phone', 'class'=>'medium', 'required'=>'required', 'id' => 'phone', 'value' => set_value('phone'),);
                        }
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                
                
                <tr>
                    <td>
                        <label>
                            &nbsp;</label>
                    </td>
                    <td>
                        <?php
                        if (!empty($photoRecord)) {
                            $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );
                        } else {
                            $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );
                        }
                        echo form_submit($data);
                        ?>
                    </td>
                </tr> -->
            </table>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

</div>
</div>
<hr>