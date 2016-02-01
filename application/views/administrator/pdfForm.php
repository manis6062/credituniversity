<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small><?php echo ucfirst($action); ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?></li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/content/addPdf'; ?>" method="post" id="content">
                <div class="col-md-8">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'content_title', 'name' => 'content_title', 'width' => '40'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <?php
                                        echo form_label('Description:');
                                        echo form_textarea(array('class' => 'form-control', 'id' => 'description', 'name' => 'description', 'rows' => '10', 'cols' => '80'));
                                        ?>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo form_label('Upload:'); ?>
                                        <input type="file" name="file" id="file">
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
    $("#content").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            content_title: {
                validators: {
                    notEmpty: {
                        message: 'The question is required and can\'t be empty'
                    }
                }
            },
            content_description: {
                validators: {
                    notEmpty: {
                        message: 'The Answer is required and can\'t be empty'
                    }
                }
            }
        }
    }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target),
                formData = new FormData(),
                params = $form.serializeArray(),
                files = $form.find('[name="file"]')[0].files;
            formData.append('file', files[0]);
            $.each(params, function (i, val) {
                formData.append(val.name, val.value);
            });

            $.ajax({
                url: $form.attr('action'),
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                success: function (data) {
                    serverValidation($("#content"), data, '<?php echo base_url() . 'administrator/content/monthlyTips'?>');
                }
            });
        });
    $(function () {
        CKEDITOR.replace('editor1');
        $(".textarea").wysihtml5();
    });
</script>


