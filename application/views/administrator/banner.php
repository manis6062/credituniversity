
<div class="content-wrapper bg-main">


    <section class="content-header">
        <h1>
            <?php echo $title;?>
            <small><?php echo $action;?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/'.$title; ?>"><?php echo $title;?>s</a></li>
            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/banner/updateBanner'; ?>" method="post"
                  id="banner" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <input type="hidden" name="old_image" value="<?php echo $banner->path; ?>">
                                    <input type="hidden" name="old_mimage" value="<?php echo $banner->mimage; ?>">
                                    <input type="hidden" name="old_rimage" value="<?php echo $banner->rimage; ?>">
                                    <input type="hidden" name="slider_id" value="<?php echo $banner->slider_id; ?>">
                                    <input type="hidden" name="publish" value="<?php echo $banner->publish; ?>">
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array( 'value'=>$banner->slider_name,'class' => 'form-control', 'id' => 'slider_name', 'name' => 'slider_name','width' => '40'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Background Image:');
                                        if($banner->path){
                                            echo '<img src="'.base_url(BANNER_IMAGE_PATH.$banner->path).'" width=100>';
                                        }
                                        echo form_upload(array('id' => 'path', 'name' => 'path'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Middle Image:');
                                        if($banner->mimage){
                                            echo '<img src="'.base_url(BANNER_IMAGE_PATH.$banner->mimage).'" width=100>';
                                        }
                                        echo form_upload(array('id' => 'mimage', 'name' => 'mimage'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Right Image:');
                                        if($banner->rimage){
                                            echo '<img src="'.base_url(BANNER_IMAGE_PATH.$banner->rimage).'" width=100>';
                                        }
                                        echo form_upload(array('id' => 'rimage', 'name' => 'rimage'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Description:');
                                        echo form_textarea(array('value'=>$banner->description,'class' => 'form-control', 'id' => 'editor1', 'name' => 'description', 'rows'=>'10', 'cols' =>'80'));
                                        ?>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">update</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>


<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>

<script>

    $("#banner").bootstrapValidator({
        /*http://www.jqueryscript.net/form/Powerful-Form-Validation-Plugin-For-jQuery-Bootstrap-3.html*/
        message: 'This value is not valid',
        fields: {
            slider_name: {
                validators: {
                    notEmpty: {
                        message: 'The question is required and can\'t be empty'
                    }
                }
            },

            description:{
                validators:{
                    notEmpty:{
                        message: 'The description is required and can\'t be empty'
                    }
                }
            }
        }
    });

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });


</script>


