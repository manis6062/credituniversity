<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
                       </div>
                    <div class="box-content">
                    	
                    	<?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                        <?php } ?>
                    	
                        <?php
                        if(validation_errors())
                        {                            
                            ?>
                             <div class="message error"><?php echo validation_errors();  ?></div> 
                            <?php
                        }
                       ?>
                         <?php
                           $attributes = array('class' => 'formular');
                           echo form_open(ADMIN_PATH.'user/updateprofile', $attributes);
                           ?>
                    <table class="form">
                        <tr>
                            <td class="col1">
                                <?php
                                    $attributes = array(
                                    'class' => 'left',
                                );
                                echo form_label('Name:', 'username', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                 <input type="text" name="user_name" value="<?php if(set_value('user_name')==""){echo $usersTypes->user_name;}else{ echo set_value('user_name');} ?>" class="medium"> 
                                  <input type="hidden" name="user_type" value="<?php echo $usersTypes->user_type; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Phone:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="phone" value="<?php if(set_value('phone')==""){echo $usersTypes->phone;}else{ echo set_value('phone');} ?>"> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                  Mobile:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="cell" value="<?php if(set_value('cell')==""){echo $usersTypes->cell;}else{ echo set_value('cell');} ?>"> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Address:</label>
                            </td>
                            <td>
                                <input type="text" class="medium" name="address" value="<?php echo $usersTypes->address; ?>"> 
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Email:</label>
                            </td>
                            <td>
                               <input type="text" class="medium" name="email" value="<?php echo $usersTypes->email; ?>"> 
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>
                                    Paypal Merchant ID:</label>
                            </td>
                            <td>
                               <input type="text" class="medium" name="pa" value="<?php echo $usersTypes->paypal_account; ?>"> 
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>
                                    referrer Registration Charge:</label>
                            </td>
                            <td>
                               <input type="text" class="medium" name="rrc" value="<?php echo $usersTypes->referrer_reg_charge; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                             <input type="hidden" name="user_id" value="<?php echo $usersTypes->user_id; ?>">
                        <input type="hidden" name="updt_cnt" value="<?php echo $usersTypes->updt_cnt; ?>">
                               <?php 
                            $data = array(
                              'name'        => 'submit',
                              'id'          => 'submit',
                              'value'       => 'Update',
                              'class'        => 'btn btn-primary',
                            );
                            
                            echo form_submit($data); 
                            // $data = array(
                              // 'name'        => 'reset',
                              // 'id'          => 'reset',
                              // 'value'       => 'Clear',
                              // 'class'        => 'btn btn-primary',
                            // );
                            // echo form_reset($data); 
                            ?>
                            </td>
                        </tr>
                        
                    </table>
                   <?php
               echo form_close();
               ?>
                    
                    
                </div>
            </div>
            
        </div>
        
    </div>
    </div>
<hr>