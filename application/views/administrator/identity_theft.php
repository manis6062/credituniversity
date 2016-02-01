<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <?php if (in_array(role(), array(BROKER))): ?>
    <section class="content-header">
        <h1>
            Identity Theft
        </h1>

    </section>
    <?php endif ?>

    <section class="content">
        <div id="row">
            <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/identitytheft/edit'; ?>" method="post" id="identity">
                <input hidden="hidden" id="id" name="id" value="<?php echo $identity->id ?>"/>

                <div class="col-md-12">

                    <div class="box-footer">
                        <div class="row">
                            <div class="form-group">
                                <div class="col-xs-12">


                                    <?php if (in_array(role(), array(BROKER))): ?>
                                    <div id="editor">
                                        <?php endif ?>
                                        <?php echo $identity->description ?>
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

    $('#subject*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'identity_theft';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;

            } else {
                window.location.reload();
            }
        }
    });

</script>

<script type="text/javascript">

    $(window).bind('beforeunload', function () {

        var $form = $('#identity'),
            formData = new FormData(),
            params = $form.serializeArray();
        code = CKEDITOR.instances.editor.getData();
        formData.append('description', code);
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
