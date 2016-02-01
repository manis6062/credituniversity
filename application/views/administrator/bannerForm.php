
<div class="content-wrapper bg-main">


    <section class="content-header">
        <h1>
            <?php echo $title;?>
            <small><?php echo ucfirst($action);?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/'.$title; ?>"><?php echo ucfirst($title);?>s</a></li>
            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/banner/addBanner'; ?>" method="post"
                  id="banner" enctype="multipart/form-data">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'slider_name', 'name' => 'slider_name','width' => '40'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Background Image:');
                                        echo form_upload(array('id' => 'path', 'name' => 'path'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Middle Image:');
                                        echo form_upload(array('id' => 'mimage', 'name' => 'mimage'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Right Image:');
                                        echo form_upload(array('id' => 'rimage', 'name' => 'rimage'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Description:');
                                        echo form_textarea(array('class' => 'form-control', 'id' => 'editor1', 'name' => 'description', 'rows'=>'10', 'cols' =>'80'));
                                        ?>

                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">add</button>
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
                        message: 'Required'
                    }
                }
            },
            path:{
                validators:{
                    notEmpty:{
                        message: 'Required'
                    }
                }
            },
            mimage:{
                validators:{
                    notEmpty:{
                        message: 'Required'
                    }
                }
            },
            rimage:{
                validators:{
                    notEmpty:{
                        message: 'Required'
                    }
                }
            },
            description:{
                validators:{
                    notEmpty:{
                        message: 'Required'
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


