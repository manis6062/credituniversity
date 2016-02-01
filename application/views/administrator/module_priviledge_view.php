<div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
									echo form_open_multipart(ADMIN_PATH . 'module/priviledgeupdate', $attributes);
                           ?>
                    <table class="form">
                    	<input type="hidden" name="type" value="user">
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Grant Module Access:', 'access', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php 
                                if(!empty($moduleList)){
                                    //$allowed=$moduleList->modules;
                                    foreach($moduleList as $data){
                                        $allowedarray[] = $data->modules;
                                    }
                                }else{
                                    $allowedarray = array();   
                                }                                
                                foreach($list as $value){?>
                                    <div style="float: left; width: 17%; margin-right: 20px;">
                                        <input type="checkbox" name="module[]" value="<?php echo $value -> module; ?>" <?php
										if (in_array("$value->module", $allowedarray)) {echo 'checked="checked"';
										}
 ?>><?php echo $value -> module; ?>
                                    </div>
                                <?php } ?>   
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                                <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );

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
    <div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title1; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message1')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message1') ?><p></div> 
                                <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
									echo form_open_multipart(ADMIN_PATH . 'module/priviledgeupdate', $attributes);
                           ?>
                    <table class="form">
                    	<input type="hidden" name="type" value="client">
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Grant Module Access:', 'access', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php 
                                if(!empty($clientmoduleList)){
                                    //$allowed=$moduleList->modules;
                                    foreach($clientmoduleList as $data){
                                        $allowedarray1[] = $data->modules;
                                    }
                                }else{
                                    $allowedarray1 = array();   
                                }                                
                                foreach($list as $value){?>
                                    <div style="float: left; width: 17%; margin-right: 20px;">
                                        <input type="checkbox" name="module1[]" value="<?php echo $value -> module; ?>" <?php
										if (in_array("$value->module", $allowedarray1)) {echo 'checked="checked"';
										}
 ?>><?php echo $value -> module; ?>
                                    </div>
                                <?php } ?>   
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                                <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );

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
    <div id="content" class="span10">
            <!-- content starts -->
            <div class="row-fluid">
                <div class="box span12">
                    <div class="box-header well" data-original-title>
                        <h2><i class="icon-edit"></i><?php echo $title2; ?></h2>
                    </div>
                    <div class="box-content">
                        <?php
                            if ($this->session->flashdata('su_message3')) {
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message2') ?><p></div> 
                                <?php } ?>
                         <?php $attributes = array('class' => 'formular', 'id' => 'form');
									echo form_open_multipart(ADMIN_PATH . 'module/priviledgeupdate', $attributes);
                           ?>
                    <table class="form">
                    	<input type="hidden" name="type" value="referrer">
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
								echo form_label('Grant Module Access:', 'access', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php 
                                if(!empty($referrermoduleList)){
                                    //$allowed=$moduleList->modules;
                                    foreach($referrermoduleList as $data){
                                        $allowedarray2[] = $data->modules;
                                    }
                                }else{
                                    $allowedarray2 = array();   
                                }                                
                                foreach($list as $value){?>
                                    <div style="float: left; width: 17%; margin-right: 20px;">
                                        <input type="checkbox" name="module2[]" value="<?php echo $value -> module; ?>" <?php
										if (in_array("$value->module", $allowedarray2)) {echo 'checked="checked"';
										}
 ?>><?php echo $value -> module; ?>
                                    </div>
                                <?php } ?>   
                            </td>
                        </tr> 
                        <tr>
                            <td>
                                <label>
                                    &nbsp;</label>
                            </td>
                            <td>
                                <?php $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );

								echo form_submit($data);
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
    </div>
<hr>