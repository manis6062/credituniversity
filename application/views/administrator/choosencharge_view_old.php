


<div class="content-wrapper bg-main">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Choose And Charge

        </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Title</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                Start creating your amazing application!
            </div><!-- /.box-body -->
            <div class="box-footer">
                Footer
            </div><!-- /.box-footer-->
        </div><!-- /.box -->

    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<!----------------------------------Old Code--------------------------------------------------------!>

<?php //$allowed = $this -> AuthMasterModel -> getAuth();
//$ts = $this -> uri -> total_segments();
//$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
//$CI = &get_instance();?>
<!--<div id="content" class="span10">-->
<?php //
//	if($usertype!=1){
//?>
<!--            <!-- content starts -->-->
<!--       <div class="row-fluid">-->
<!--                <div class="box span12">-->
<!--                    <div class="box-header well" data-original-title>-->
<!--                        <h2><i class="icon-edit"></i> --><?php //echo $title1; ?><!--</h2>-->
<!--                    </div>-->
<!--                    <div class="box-content">-->
<!--            --><?php
//            if (validation_errors()) {
//                ?>
<!--                <div class="message error">--><?php //echo validation_errors(); ?><!--</div> -->
<!--                --><?php //} ?>
<!--            --><?php //$attributes = array('class' => 'formular');
//            if (!empty($photoRecord)) {
//                echo form_open(ADMIN_PATH . 'chooseandcharge/update', $attributes);
//            } else {
//                echo form_open(ADMIN_PATH . 'chooseandcharge/add', $attributes);
//            }
//            ?>
<!--            <table class="form">-->
<!--            	<p style="color:red;">(Fields marked with '*' are required.)</p>-->
<!--            	<tr>-->
<!--                    <td class="col1" >-->
<!--                        --><?php //$attributes = array('class' => 'left', );
//                        echo form_label('Company Name (*):', 'name', $attributes);
//                        ?>
<!--                    </td>-->
<!--                    <td class="col2">-->
<!--                        --><?php
//                        if (!empty($photoRecord)) {
//                            $data = array('name' => 'name', 'id' => 'name', 'required'=>'required', 'value' => set_value('name') == "" ? $photoRecord -> company_name : set_value('name'), 'class' => 'medium', );
//                        } else {
//                            $data = array('name' => 'name', 'id' => 'name', 'required'=>'required', 'value' => set_value('name'), 'class' => 'medium', );
//                        }
//                        echo form_input($data);
//                        ?>
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    --><?php //if(!empty($photoRecord)){?>
<!--                        <input name="c_id" type="hidden" value="--><?php //echo $photoRecord->id?><!--"/>-->
<!--                        --><?php //} ?>
<!--                    <td class="col1" >-->
<!--                        --><?php //$attributes = array('class' => 'left', );
//                        echo form_label('Company Website:', 'website', $attributes);
//                        ?>
<!--                    </td>-->
<!--                    <td class="col2">-->
<!--                        --><?php
//                        if (!empty($photoRecord)) {
//                            $data = array('name' => 'website', 'id' => 'website', 'value' => set_value('website') == "" ? $photoRecord -> company_website : set_value('website'), 'class' => 'medium', );
//                        } else {
//                            $data = array('name' => 'website', 'id' => 'website', 'value' => set_value('website'), 'class' => 'medium', );
//                        }
//                        echo form_input($data); echo "(example:http://www.example.com)";
//                        ?>
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td class="col1" >-->
<!--                        --><?php //$attributes = array('class' => 'left', );
//                        echo form_label('State:', 'state', $attributes);
//                        ?>
<!--                    </td>-->
<!--                    <td class="col2">-->
<!--                    	--><?php
//                        if (!empty($photoRecord)) {?>
<!--	                    	<select name="state" id="state">-->
<!--	                    		<option value="">Select State</option>-->
<!--	                    		--><?php //foreach($states as $value){?>
<!--	                    			<option value="--><?php //echo $value->state_code?><!--" --><?php //if($value->state_code==$photoRecord->state){?><!--selected="selected"--><?php //}?><!-->--><?php //echo $value->state;?><!--</option>                    			-->
<!--	                    		--><?php //}?>
<!--	                    	</select>-->
<!--	                    --><?php //}else{?>
<!--	                    	<select name="state" id="state">-->
<!--	                    		<option value="">Select State</option>-->
<!--	                    		--><?php //foreach($states as $value){?>
<!--	                    			<option value="--><?php //echo $value->state_code?><!--">--><?php //echo $value->state;?><!--</option>                    			-->
<!--	                    		--><?php //}?>
<!--	                    	</select>-->
<!--	                    --><?php //}?><!--		-->
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td class="col1" >-->
<!--                        --><?php //$attributes = array('class' => 'left', );
//                        echo form_label('Company Address:', 'address', $attributes);
//                        ?>
<!--                    </td>-->
<!--                    <td class="col2">-->
<!--                        --><?php
//                        if (!empty($photoRecord)) {
//                            $data = array('name' => 'address', 'id' => 'address', 'value' => set_value('address') == "" ? $photoRecord -> address : set_value('address'), 'class' => 'medium', );
//                        } else {
//                            $data = array('name' => 'address', 'id' => 'address', 'value' => set_value('address'), 'class' => 'medium', );
//                        }
//                        echo form_input($data);
//                        ?>
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td class="col1" >-->
<!--                        --><?php //$attributes = array('class' => 'left', );
//                        echo form_label('Details:', 'details', $attributes);
//                        ?>
<!--                    </td>-->
<!--                    <td class="col2">-->
<!--                        --><?php
//                        if (!empty($photoRecord)) {
//                            $data = array('name' => 'details', 'class'=>'ckeditor', 'id' => 'description', 'value' => set_value('details') == "" ? $photoRecord -> details : set_value('details'),);
//                        } else {
//                            $data = array('name' => 'details', 'class'=>'ckeditor', 'id' => 'description', 'value' => set_value('details'),);
//                        }
//                        echo form_textarea($data);
//                        ?>
<!--                    </td>-->
<!--                </tr>-->
<!--                <tr>-->
<!--                    <td>-->
<!--                        <label>-->
<!--                            &nbsp;</label>-->
<!--                    </td>-->
<!--                    <td>-->
<!--                        --><?php
//                        if (!empty($photoRecord)) {
//                            $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Update', 'class' => 'btn btn-primary', );
//                        } else {
//                            $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Save', 'class' => 'btn btn-primary', );
//                        }
//                        echo form_submit($data);
//                        ?>
<!--                    </td>-->
<!--                </tr>-->
<!--            </table>-->
<!--            --><?php //echo form_close(); ?>
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<?php //}?>
<!--    <!-- content starts -->-->
<!--    <div class="row-fluid sortable">        -->
<!--                <div class="box span12">-->
<!--                    <div class="box-header well" data-original-title>-->
<!--                        <h2><i class="icon-user"></i> --><?php //echo $title; ?><!--</h2>-->
<!--                    </div>-->
<!--                    <div class="box-content">-->
<!--                        --><?php
//                        if($this->session->flashdata('su_message'))
//                        {
//
//                            ?>
<!--                             <div class="message info"><p>--><?php //echo $this->session->flashdata('su_message')?><!--<p></div> -->
<!--                            --><?php //} ?>
<!--                       --><?php //if ($usertype!=1) { ?>
<!--                                <a href="--><?php //echo site_url(ADMIN_PATH . 'chooseandcharge'); ?><!--" class="btn btn-primary">New</a>-->
<!--                        --><?php //} ?>
<!--                    <table class="table table-striped table-bordered bootstrap-datatable datatable">-->
<!--                    <thead>-->
<!--                        <tr>-->
<!--                            <th>&nbsp;</th>-->
<!--                            <th>Company Name</th>-->
<!--                            <th>Company Website</th>-->
<!--                            <th>Company Address</th>-->
<!--                            <th>State</th>-->
<!--                            <th>Details</th>-->
<!--                            --><?php //if($usertype!=1){
//                            	echo "<th>Action</th>";
//                            }?>
<!--                        </tr>-->
<!--                    </thead>-->
<!--                    <tbody>-->
<!--                         --><?php
//                        if( $chooseList !=0 && count($chooseList) > 0)
//                        {
//                            $count=1;
//                            foreach($chooseList as  $values)
//                            {
//                            ?>
<!--                            <tr class="item">-->
<!--                                <td>--><?php //echo $count; ?><!--</td>-->
<!--                                <td>--><?php //echo $values -> company_name; ?><!--</td>   -->
<!--                                <td><a href="--><?php //echo $values -> company_website; ?><!--" target="_blank">--><?php //echo $values -> company_website; ?><!--</a></td> -->
<!--                                <td>--><?php //echo $values -> address;?><!--</td>-->
<!--                                <td>--><?php //echo $values -> state_detail;?><!--</td>-->
<!--                                <td>--><?php //echo $values -> details;?><!--</td> -->
<!--                                --><?php // if($usertype!=1){?>
<!--                                	<td class="action" style="width:100px">-->
<!--		                               <a href="--><?php //echo site_url(ADMIN_PATH . 'chooseandcharge/updateAction/' . $values -> id); ?><!--"><img src="--><?php //echo base_url(); ?><!--/style/img/edit.png" alt="edit"></a> -->
<!--		                               <a href="--><?php //echo site_url(ADMIN_PATH . 'chooseandcharge/deleteAction/' . $values -> id); ?><!--"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="--><?php //echo base_url(); ?><!--/style/img/delete.png" alt="delete"></a> -->
<!--	                                </td>-->
<!--                                --><?php // }?><!--    -->
<!--                            </tr>-->
<!--                            --><?php
//                            $count++;
//                            }
//                            }
//                        ?>
<!--                     </tbody>-->
<!--                      </table>            -->
<!--                    </div>-->
<!--                </div><!--/span-->-->
<!--            -->
<!--            </div><!--/row-->-->
<!--</div>-->
<!--</div>-->
<!--<hr>-->