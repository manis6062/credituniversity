<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update NewsLetter
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/newsletter'; ?>">Newletter Templates</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/campaign/campaignForm'; ?>">Add a Campaign</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/newsletter'; ?>"><i class="fa fa-newspaper-o"></i>Newsletters</a></li>
            <li class="active">Update NewsLetter</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/newsletter/update'; ?>" method="post" id="newsletter">
                <input hidden="hidden" id="id" name="id" value="<?php echo $template->id ?>"/>

                <div class="col-md-12">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">Information:</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <?php echo form_label('ID', 'id'); ?><br/>
                                    <a href="#" id="id" name="id" data-type="text"> <?php echo $template->id; ?></a>
                                </div>
                                <div class="form-group col-md-3">
                                    <?php echo form_label('Title', 'title'); ?><br/>
                                    <a href="#" id="title" data-type="text"> <?php echo $template->title; ?></a>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="campaign">Campaign</label><br/>
                                    <a href="#" id="campaign_id" data-type="select" data-source="<?php echo singleQuote($campaigns); ?>" data-value="<?php echo $template->campaign_id; ?>"> <?php echo $template->campaign_name; ?></a>
                                </div>
                                <div class="form-group col-md-3">
                                    <a href="<?php echo base_url() . 'administrator/newsletter/sendNewsletterForm/' . $template->id; ?>"><i class="fa fa-paper-plane"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <label>Template Html: </label>

                                    <div id="editor">
                                        <?php echo $template->code ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $('#title , #code, #campaign_id').editable({
        pk: '<?php echo $template->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'newsletter_template';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(window).bind('beforeunload', function () {

        var $form = $('#newsletter'),
            formData = new FormData(),
            params = $form.serializeArray();
        code = CKEDITOR.instances.editor.getData();
        formData.append('code', code);
        $.each(params, function (i, val) {
            formData.append(val.name, val.value);
        });
        $.ajax({
            url: $form.attr('action'),
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            async: false,
            type: 'POST',
            success: function (data) {
            }
        });


    });

    initSample();


</script>
