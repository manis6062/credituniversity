<style>

    .editable-container.editable-inline .control-group.form-group .editable-input textarea,

    .editable-container.editable-inline .control-group.form-group .editable-input input:not([type=radio]):not([type=checkbox]):not([type=submit])
    {
        width: 700px;
    }
</style>
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
            <form action="<?php echo base_url() . 'administrator/content/updateAction'; ?>" method="post"
                  id="content" enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="box box-primary">
                    <input type="hidden" name="contentId" value="<?php echo $content->content_id;?>">
                    <div class="box-header">
                        <h3 class="box-title">update question no.: <?php echo $content->content_id;?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('question', 'Question');
                                echo form_input(array('value'=>$content->content_title,'class' => 'form-control', 'id' => 'content_title', 'name' => 'question', 'rows'=>'10', 'cols' =>'80'));?>

                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('answer', 'Answer');
                                echo form_textarea(array('value'=>$content->content_description,'class' => 'form-control', 'id' => 'editor1', 'name' => 'answer', 'rows'=>'10', 'cols' =>'80'));
                                ?>
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
            </div>
                </form>

        </div>
    </section>
</div>

<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>
<script>

    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
    });

</script>

