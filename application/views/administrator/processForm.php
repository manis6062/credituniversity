
<div class="content-wrapper bg-main">


    <section class="content-header">
        <h1>
            <?php echo $title;?>
            <small><?php echo ucfirst($action);?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/'.$title; ?>"><?php echo ucfirst($title);?>es</a></li>
            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/process/addProcess'; ?>" method="post"
                  id="process">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'process_title', 'name' => 'process_title','width' => '40'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Caption:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'process_caption', 'name' => 'process_caption','width' => '40'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Description:');
                                        echo form_textarea(array('class' => 'form-control', 'id' => 'editor1', 'name' => 'process_description', 'rows'=>'10', 'cols' =>'80'));
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

    $("#process").bootstrapValidator({
        /*http://www.jqueryscript.net/form/Powerful-Form-Validation-Plugin-For-jQuery-Bootstrap-3.html*/
        message: 'This value is not valid',
        fields: {
            process_title: {
                validators: {
                    notEmpty: {
                        message: 'The title is required and can\'t be empty'
                    }
                }
            },
            process_description:{
                validators:{
                    notEmpty:{
                        message: 'The Answer is required and can\'t be empty'
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


