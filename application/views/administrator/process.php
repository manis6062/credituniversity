<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small><?php echo $action; ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/' . $title; ?>"><?php echo $title; ?>es</a></li>
            <li class="active"><?php echo $action; ?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Update Id.: <?php echo $process->process_id; ?></h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('title', 'Title'); ?>
                                <a href="#" id="process_title" data-type="text"
                                   data-emptytext="enter title "><?php echo $process->process_title; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('caption', 'Caption'); ?>
                                <a href="#" id="process_caption" data-type="text"
                                   data-emptytext="enter caption "><?php echo $process->process_caption; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('description', 'Description'); ?>
                                <a href="#" id="process_description" data-type="textarea"
                                   data-emptytext="enter description "><?php echo $process->process_description; ?></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>
</div>

<!--<script src="https://cdn.ckeditor.com/4.4.3/standard/ckeditor.js" type="text/javascript"></script>-->
<script>
    //CKEDITOR.inline( 'process_description' );
    $.fn.editable.defaults.mode = 'inline';
    $('#process_title,#process_caption, #process_description').editable({
        pk: '<?php echo $process->process_id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<textarea class="wy" id="editor1"></textarea>',
        params: function (params) {
            params.table = 'process';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("click", ".wy", function () {
        $(this).wysihtml5({
            toolbar: {
                fa: true
            }
        });
    });


</script>

