<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i> <?php echo $title.' of '.$userinfo->user_name; ?></h2>
                    </div>
                    <div class="box-content">
                		<?php
                        if ($this->session->flashdata('update_message')) {
                            ?>
                            <div class="message info"><p><?php echo $this->session->flashdata('update_message') ?><p></div> 
                            <?php
                        }
                        ?>
                		 <?php $attributes = array('class' => 'formular');
                        echo form_open(ADMIN_PATH . 'user/updateRole/', $attributes);
						   ?>
                    <table class="form">
                    	<?php 
                    	foreach($allroles as $key => $value){
                    	?>
	                       	<div style="float: left; width: 17%; margin-right: 20px;">
	                        	<input type="checkbox" name="role_privilege[]" value="<?php echo $value->role_id;?>" <?php if(in_array("$value->role_id",$authorities)){echo 'checked="checked"';} ?>><?php echo $value->role_type;?>
	                        </div>
                        <?php } ?>
                        <input type="hidden" name="old_privilege" value="<?php echo $old_roles ?>" />
                        <input type="hidden" name="user_id" value="<?php echo $userinfo->user_id?>"
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                           
                               <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );
	                            echo form_submit($data).'&nbsp;&nbsp;&nbsp;&nbsp;';
	                            // $data = array('name' => 'reset', 'id' => 'reset', 'value' => 'Clear', 'class' => 'btn btn-primary', );
	                            // echo form_reset($data);
								?>
                            </td>
                        </tr>
                        
                    </table>
                   <?php
                echo form_close();
			   ?> 
                     

                    </div>
                </div><!--/span-->

            </div><!--/row-->  
    </div>