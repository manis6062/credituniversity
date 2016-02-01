<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?></h2>
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
								if (!empty($client)) {
									echo form_open_multipart(ADMIN_PATH . 'client/update', $attributes);
								} else {
									echo form_open_multipart(ADMIN_PATH . 'client/add', $attributes);
								}
                           ?>
                    <table class="form">
                    	<p style="color:red;">(Fields marked with '*' are required.)</p>
                        <?php if(!empty($client)){?>
                        <input name="client_id" type="hidden" value="<?php echo $client->id?>"/>
                        <?php } ?>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Firstname (*):', 'firstname', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'firstname', 'id' => 'firstname', 'value' => set_value('firstname') == "" ? $client -> firstname : set_value('firstname'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'firstname', 'id' => 'firstname', 'value' => set_value('firstname'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Lastname (*):', 'lastname', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'lastname', 'id' => 'lastname', 'value' => set_value('lastname') == "" ? $client -> lastname : set_value('lastname'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'lastname', 'id' => 'lastname', 'value' => set_value('lastname'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Email Address (*):', 'email', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'email', 'id' => 'email', 'value' => set_value('email') == "" ? $client -> email : set_value('email'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'email', 'id' => 'email', 'value' => set_value('email'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('SSN:', 'scn', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'scn', 'id' => 'scn', 'value' => set_value('scn') == "" ? $client -> scn : set_value('scn'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'scn', 'id' => 'scn', 'value' => set_value('scn'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('City:', 'city', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'city', 'id' => 'city', 'value' => set_value('city') == "" ? $client -> city : set_value('city'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'city', 'id' => 'city', 'value' => set_value('city'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('State:', 'state', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'state', 'id' => 'state', 'value' => set_value('state') == "" ? $client -> state : set_value('state'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'state', 'id' => 'state', 'value' => set_value('state'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Address:', 'address', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'address', 'id' => 'address', 'rows' => '5', 'value' => set_value('address') == "" ? $client -> address : set_value('address'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'address', 'id' => 'address', 'rows' => '5', 'value' => set_value('address'), 'class' => 'medium', );
								}
								echo form_textarea($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('DOB:', 'dob', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'dob', 'id' => 'dob', 'value' => set_value('dob') == "" ? $client -> dob : set_value('dob'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'dob', 'id' => 'dob', 'value' => set_value('dob'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Zip:', 'zip', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'zip', 'id' => 'zip', 'value' => set_value('zip') == "" ? $client -> zip : set_value('zip'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'zip', 'id' => 'zip', 'value' => set_value('zip'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Phone(Home):', 'phone', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'phone', 'id' => 'phone', 'value' => set_value('phone') == "" ? $client -> phone : set_value('phone'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'phone', 'id' => 'phone', 'value' => set_value('phone'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Cell Phone:', 'mobile', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'mobile', 'id' => 'mobile', 'value' => set_value('mobile') == "" ? $client -> mobile : set_value('mobile'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'mobile', 'id' => 'mobile', 'value' => set_value('mobile'), 'class' => 'medium', );
								}
								echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Comments:', 'comments', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
								if (!empty($client)) {
									$data = array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'value' => set_value('comments') == "" ? $client -> comments : set_value('comments'), 'class' => 'medium', );
								} else {
									$data = array('name' => 'comments', 'id' => 'comments', 'rows' => '5', 'value' => set_value('comments'), 'class' => 'medium', );
								}
								echo form_textarea($data);
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
							if (!empty($client)) {
								$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );
							} else {
								$data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );
							}
							echo form_submit($data);
                            ?>
                            </td>
                        </tr>
                    </table>
                   <?php echo form_close(); ?>
                   </div>
                </div><!--/span-->

            </div><!--/row-->  
    </div>
    </div>
<hr>