<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                        if(validation_errors())
                        {   
                            ?>
                             <div class="message error"><?php echo validation_errors(); ?></div> 
                            <?php } ?>
                            <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
                               echo form_open_multipart(ADMIN_PATH . 'client/sendEmails', $attributes);
                           ?>
                    <table class="form">
                    	<p style="color:red;">Fields marked with (*) are required.</p>
                    			<table class="form">
									<tr>
										<td class="col1">Subject (*):</td>
										<td class="col2"><input type="text" name="subject" required class="input-xlarge"></td>
									</tr>	
									<tr>
										<td class="col1">Message:</td>											
										<td class="col2"><textarea name="msg"  class="ckeditor" id="description" class="input-xlarge"></textarea></td>
										<input type="hidden"  name="user_type" value="referrer">
										<?php 
											$referrer = $CI->ClientModel->getreferrer($this->session->userdata(USER_ID));
											echo "<input type='hidden' name='referrer' value='$referrer'>";
										?>
									</tr>
									<tr>
			                            <td>
			                                <label>
			                                    &nbsp;</label>
			                            </td>
			                            <td>
			                               <?php
			                                  $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Send Emails', 'class' => 'btn btn-primary', );
			                                  echo form_submit($data);
			                               ?>
			                            </td>
			                        </tr> 
								</table>
                        <!-- <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                               <?php
                                  $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Send Emails', 'class' => 'btn btn-primary', );
                                  echo form_submit($data);
                               ?>
                            </td>
                        </tr> -->
                        
                    </table>
                   <?php echo form_close(); ?>
                   </div>
                </div><!--/span-->

            </div><!--/row-->  
    <!-- </div>
<div id="content" class="span10"> -->
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title2; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message1')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message1') ?><p></div> 
                                <?php } ?>
                        <?php
                            $attributes = array('class' => 'formular', 'id' => 'form'); 
                            echo form_open_multipart(ADMIN_PATH . 'client/remove_checked_received_emails', $attributes);
                        ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Email Sender Type</th>
                                <th style="width: 20%;">Email Sender</th>
                                <th style="width: 20%;">Email Subject</th>
                                 <!--<th>Index</th>-->        
                                <th style="width: 20%;">Email Message Details</th>
                                <th style="width: 20%;">Email Received Date</th>
                                <th style="width: 10%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($receivedemails != 0 && count($receivedemails) > 0) {
                        $count = 1;
                        foreach ($receivedemails as $values) {
                            ?>
                            <div id="form-contentreceiver<?php echo $values->email_id;?>" class="modal hide fade in" style="display: none;">
									<div class="modal-header">
										<a class="close" data-dismiss="modal">×</a>
										<h3>Email Details</h3>
									</div>
									<div class="modal-body">
										Sender: <?php echo $values->sender;?><br>
										Subject: <?php echo $values->email_subject;?><br>
										Message: <?php echo $values->email_msg;?><br>
									</div>
							</div>
                            <tr class="item">
                                <td><?php echo $count; ?><input type="checkbox" name="msg[]" value="<?php echo $values->email_id; ?>" /></td>
                                <td><?php echo $values->email_sender_type;?></td>
                                <td><?php echo $values->sender;?></td>
                                <td><?php echo $values -> email_subject; ?></td>
                                <td><?php echo $values -> email_msg; ?></td>
                                <td><?php echo $values -> email_date; ?></td>
                                <td class="action">
                                    <?php
                                    if (in_array('email_view', $allowed)) {
                                        ?>
                                        <a data-toggle="modal" href="#form-contentreceiver<?php $values->email_id;?>" class="btn btn-minimize btn-round"><img src="<?php echo base_url(); ?>/style/img/view_email.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('email_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'client/emailsreceiverdelete/' . $values -> email_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Email History');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                        <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $count++;
                            }
                            }
                    ?>
                          </tbody>
                      </table> 
                      <?php 
                            $data = array('name' => 'delete', 'id' => 'delete', 'value' => 'Delete', 'class' => 'btn btn-primary', );
                            echo form_submit($data); 
                            echo form_close();
                      ?>      
                       
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
<!-- </div>
<div id="content" class="span10"> -->
    <!-- content starts -->
    <div class="row-fluid sortable">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title3; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message2')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message2') ?><p></div> 
                                <?php } ?>
                        <?php
                            $attributes = array('class' => 'formular', 'id' => 'form'); 
                            echo form_open_multipart(ADMIN_PATH . 'client/remove_checked_sender_emails', $attributes);
                        ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Email Receiver Type</th>
                                <th style="width: 20%;">Email Receivers</th>
                                <th style="width: 20%;">Email Subject</th>
                                 <!--<th>Index</th>-->        
                                <th style="width: 20%;">Email Message Details</th>
                                <th style="width: 20%;">Email Sent Date</th>
                                <th style="width: 10%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($sentemails != 0 && count($sentemails) > 0) {
                        $count = 1;
                        foreach ($sentemails as $values) {
                        	$allreceivers = $CI->EmailModel->getaffiliate($values->email_receiver);
                            ?>
                            <div id="form-contentsender<?php echo $values->email_id;?>" class="modal hide fade in" style="display: none;">
									<div class="modal-header">
										<a class="close" data-dismiss="modal">×</a>
										<h3>Email Details</h3>
									</div>
									<div class="modal-body">
										Receiver: <?php echo $allreceivers;?><br>
										Subject: <?php echo $values->email_subject;?><br>
										Message: <?php echo $values->email_msg;?><br>
									</div>
							</div>
                            <tr class="item">
                                <td><?php echo $count; ?><input type="checkbox" name="msg[]" value="<?php echo $values->email_id; ?>" /></td>
                                <td><?php echo $values->email_receiver_type;?></td>
                                <td><?php echo $allreceivers;?></td>
                                <td><?php echo $values -> email_subject; ?></td>
                                <td><?php echo $values -> email_msg; ?></td>
                                <td><?php echo $values -> email_date; ?></td>
                                <td class="action">
                                    <?php
                                    if (in_array('email_view', $allowed)) {
                                        ?>
                                        <a data-toggle="modal" href="#form-contentsender<?php $values->email_id;?>" class="btn btn-minimize btn-round"><img src="<?php echo base_url(); ?>/style/img/view_email.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('email_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'client/emailssenderdelete/' . $values -> email_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Email History');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
                                        <?php } ?>
                                </td>
                            </tr>
                            <?php
                            $count++;
                            }
                            }
                    ?>
                          </tbody>
                      </table> 
                      <?php 
                            $data = array('name' => 'delete', 'id' => 'delete', 'value' => 'Delete', 'class' => 'btn btn-primary', );
                            echo form_submit($data); 
                            echo form_close();
                      ?>      
                       
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>
</div>
<hr>