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
                        <h2><i class="icon-edit"></i> <?php echo $title; ?></h2>
                    </div>
                    <div class="box-content">
            <?php
            if (validation_errors()) {
                ?>
                <div class="message error"><?php echo validation_errors(); ?></div> 
                <?php } ?>
            <?php $attributes = array('class' => 'formular');
            if (!empty($photoRecord)) {
                echo form_open(ADMIN_PATH . 'newsletter/update', $attributes);
            } else {
                echo form_open(ADMIN_PATH . 'newsletter/add', $attributes);
            }
            ?>
            <table class="form">
            	<p style="color:red;">(Fields marked with '*' are required.)</p>
            	<tr>
                    <td class="col1" >
                        <?php $attributes = array('class' => 'left', );
                        echo form_label('Newsletter Title (*):', 'name', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        if (!empty($photoRecord)) {
                            $data = array('name' => 'template_title', 'id' => 'template_title', 'required'=>'required', 'value' => set_value('template_title') == "" ? $photoRecord -> template_title : set_value('template_title'), 'class' => 'medium', );
                        } else {
                            $data = array('name' => 'template_title', 'id' => 'template_title', 'required'=>'required', 'value' => set_value('template_title'), 'class' => 'medium', );
                        }
                        echo form_input($data);
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td class="col1" >
                        <?php $attributes = array('class' => 'left', );
                        echo form_label('Template Code:', 'template_code', $attributes);
                        ?>
                    </td>
                    <td class="col2">
                        <?php
                        if (!empty($photoRecord)) {
                            $data = array('name' => 'template_code', 'class'=>'ckeditor','id' => 'description', 'value' => set_value('template_code') == "" ? $photoRecord -> details : set_value('template_code'),);
                        } else {
                            $data = array('name' => 'template_code','class'=>'ckeditor', 'id' => 'description', 'value' => set_value('template_code'),);
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
                        if (!empty($photoRecord)) {
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
    </div>
</div>
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
                        if($this->session->flashdata('su_message'))
                        {
                            
                            ?>
                             <div class="message info"><p><?php echo $this->session->flashdata('su_message')?><p></div> 
                            <?php } ?>
                     
                                <a href="<?php echo site_url(ADMIN_PATH . 'newsletter'); ?>" class="btn btn-primary">New</a>
                        
                    <table class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Newsletter Title</th>
                            <th>Newsletter Template</th>
                           
                          
                            <th>Action</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                         <?php
                        if( $chooseList !=0 && count($chooseList) > 0)
                        {
                            $count=1;
                            foreach($chooseList as  $values)
                            {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><?php echo $values -> template_title; ?></td>   
                                
                                <td><?php echo html_entity_decode($values -> template_code);?></td>
                                
                              
                                	<td class="action" style="width:100px">
		                               <!-- <a href="<?php echo site_url(ADMIN_PATH . 'chooseandcharge/updateAction/' . $values -> id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a>  -->
		                               <a href="<?php echo site_url(ADMIN_PATH . 'newsletter/deleteAction/' . $values -> template_id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
	                                </td>
                                  
                            </tr>
                            <?php
                            $count++;
                            }
                            }
                        ?>
                     </tbody>
                      </table>            
                    </div>
                </div><!--/span-->
            
            </div><!--/row-->
</div>
    </div>
<hr>