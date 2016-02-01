<?php $allowed = $this -> AuthModel -> getAuth();
$ts = $this -> uri -> total_segments();
$offset = (is_numeric($this -> uri -> segment($ts))) ? $this -> uri -> segment($ts) : 0;
$CI = &get_instance();
$category = $CI -> PortfolioCategoryModel -> getAll();
?>

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
                                ?>
                                <div class="message info"><p><?php echo $this->session->flashdata('su_message') ?><p></div> 
                                <?php } ?>
                            <?php if (in_array('portfolio_add', $allowed)) { ?>
                                <a href="<?php echo site_url(ADMIN_PATH . 'portfolio'); ?>" class="btn btn-primary">New</a>
                        <?php } ?>
                        <table class="table table-striped table-bordered bootstrap-datatable datatable">
                          <thead>
                              <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Portfolio Image</th>
                                <th style="width: 20%;">Title</th>
                                <th style="width: 20%;">Link</th>
                                <th style="width: 20%;">Category</th>
                                <th style="width: 20%;">Created Date</th>
                                <th style="width: 10%;">action</th>
                              </tr>
                          </thead>   
                          <tbody>
                            <?php
                    if ($portfolioList != 0 && count($portfolioList) > 0) {
                        $count = 1;
                        $path = PORTFOLIO_IMAGE_PATH;
                        foreach ($portfolioList as $values) {
                            ?>
                            <tr class="item">
                                <td><?php echo $count; ?></td>
                                <td><img width="200" src="<?php echo base_url() . $path . '/' . $values -> image; ?>"/></td>
                                <td><?php echo $values -> title; ?></td>
                                <td><?php echo $values -> link; ?></td>
                                <td><?php echo $values -> category_name; ?></td>
                                <td><?php echo $values -> crtd_dt; ?></td>
                                <td class="action">
                                    <?php
                                    if (in_array('portfolio_update', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'portfolio/updateAction/' . $values -> id); ?>"><img src="<?php echo base_url(); ?>/style/img/edit.png" alt="edit"></a> 
                                        <?php } ?>
                                    <?php
                                    if (in_array('portfolio_delete', $allowed)) {
                                        ?>
                                        <a href="<?php echo site_url(ADMIN_PATH . 'portfolio/deleteAction/' . $values -> id); ?>"  onclick="return confirm('Make Sure Before You Delete This Record');"><img src="<?php echo base_url(); ?>/style/img/delete.png" alt="delete"></a> 
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
                                if (!empty($photoRecord)) {
                                    echo form_open_multipart(ADMIN_PATH . 'portfolio/update', $attributes);
                                } else {
                                    echo form_open_multipart(ADMIN_PATH . 'portfolio/add', $attributes);
                                }
                           ?>
                    <table class="form">
                        <?php if(!empty($photoRecord)){?>
                        <input name="id" type="hidden" value="<?php echo $photoRecord->id?>"/>
                        <input name="old_image" type="hidden" value="<?php echo $photoRecord -> image; ?>"/>
                        <?php } ?>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Title:', 'title', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
                                if (!empty($photoRecord)) {
                                    $data = array('name' => 'title', 'id' => 'title', 'value' => set_value('title') == "" ? $photoRecord -> title : set_value('title'), 'class' => 'medium', );
                                } else {
                                    $data = array('name' => 'title', 'id' => 'title', 'value' => set_value('title'), 'class' => 'medium', );
                                }
                                echo form_input($data);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Link:', 'link', $attributes);
                                ?>
                            </td>
                            <td class="col2">
                                <?php
                                if (!empty($photoRecord)) {
                                    $data = array('name' => 'link', 'id' => 'link', 'value' => set_value('link') == "" ? $photoRecord -> link : set_value('link'), 'class' => 'medium', );
                                } else {
                                    $data = array('name' => 'link', 'id' => 'link', 'value' => set_value('link'), 'class' => 'medium', );
                                }
                                echo form_input($data);
                                ?>
                                (http://www.example.com)
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Category:</label>
                            </td>
                            <td>
                                <select name="category" id="category">
                                    <option value="">Select</option>
                                    <?php
                                        foreach($category as $value){?>
                                            <?php if(!empty($photoRecord)){?>
                                                <option value="<?php echo $value -> id; ?>" <?php if($value->id==$photoRecord->category){?>selected="selected"<?php } ?>>
                                                    <?php echo $value -> category_name; ?>
                                                </option>
                                            <?php }else{ ?>
                                                <option value="<?php echo $value -> id; ?>">
                                                    <?php echo $value -> category_name; ?>
                                                </option>                                                
                                    <?php }} ?>
                                 </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="col1">
                            
                                <?php $attributes = array('class' => 'left', );
                                echo form_label('Image:(660*251)', 'image', $attributes);
                                    ?>
                            </td>
                            <td class="col2">
                                <?php $data = array('name' => 'path', 'id' => 'path', 'class' => '', 'onchange' => 'readURL(this);');
                                echo form_upload($data);
                            ?> 
                            <br/><?php if(!empty($photoRecord)){ $path = '../../.'.PORTFOLIO_IMAGE_PATH.'/';?><img id="blah" src="<?php echo $path . $photoRecord -> image; ?>" alt="" width="50%"/><?php }else{ ?><img id="blah" src="#" alt="" width="50%"/><?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Description:</label>
                            </td>
                            <td>
                                <?php if(!empty($photoRecord)){?>
                                    <textarea class="ckeditor" id="description"  style="width:100%"  name="description" ><?php echo set_value('description') == "" ? $photoRecord -> description : set_value('description'); ?></textarea>
                                <?php }else{ ?>    
                                    <textarea class="ckeditor" id="description"  style="width:100%"  name="description" ><?php echo set_value('description'); ?></textarea>
                                <?php } ?>    
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
    </div>
<hr>