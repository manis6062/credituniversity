<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
?>
<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title1; ?></h2>
                    </div>
                    <div class="box-content">
                    <?php
                        if(validation_errors())
                        {
                            
                            ?>
                             <div class="message error"><?php echo validation_errors(); ?></div> 
                            <?php } ?>
                        <?php
                        if($error)
                        {
                            ?>
                             <div class="message error">
                             <?php
							foreach ($error as $value) {
								echo $value;
							}
                             ?>
                             </div> 
                            <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
								echo form_open_multipart(ADMIN_PATH . 'lineowner_request/add', $attributes);
                           ?>
                    <table class="form">
                    	<p style="color:red;">(Fields marked with '*' are required.)</p>
                        <tr>
		                    <td class="col1" >
		                        <?php $attributes = array('class' => 'left', );
								echo form_label('Email Address (*):', 'email', $attributes);
		                        ?>
		                    </td>
		                    <td class="col2">
		                    	<div id="addinput">
									<p>&nbsp;&nbsp;<input type="email" id="p_new" size="20" name="email[]" required value="" placeholder="Email" /><a class="btn btn-default dynamic" href="#" id="addNew">+</a></p>
								</div>
		                    </td>
		                </tr>
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                            <?php
								$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Send Request', 'class' => 'btn btn-primary', );
								echo form_submit($data);
								// $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-primary', );
								// echo form_reset($data);
                            ?>
                            </td>
                        </tr>
                        
                    </table>
                   <?php echo form_close(); ?>
                   </div>
                </div><!--/span-->

            </div><!--/row-->  
    </div>
<div id="content" class="span10">
    <!-- content starts -->
    <div class="row-fluid">        
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-user"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                echo $this->session->flashdata('su_message'); } ?>
                            <?php if (in_array('request', $allowed)) { ?>
                                <a href="<?php echo site_url(ADMIN_PATH.'lineowner/add'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <?php $attributes = array('class' => 'formular', 'id' => 'form');
						echo form_open_multipart(ADMIN_PATH.'lineowner_request/remove_checked', $attributes);
                        ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Emails</th>
                                <th style="width: 20%;">Email Date</th>
                                <th style="width: 10%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($list != 0 && count($list) > 0) {
                        $count = 1;
                        foreach ($list as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?><input type="checkbox" name="msg[]" value="<?php echo $values -> request_id; ?>" />         
                                </td>
                                <td><?php echo $values -> request_to_emails; ?></td>
                                <td><?php echo $values -> request_send_dt; ?></td>
                                <td class="action">
                                    <a href="<?php echo site_url(ADMIN_PATH.'lineowner_request/deleteAction/' . $values -> request_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a>
                                </td>
                            </tr>
                            <?php $count++;
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