<div class="content-wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update NewsLetter
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Update</li>
        </ol>
    </section>
    <section class="content">
        <div id="row">
            <div class="col-md-12">
                <div class="box box-danger">
                    <div class="box-header">
                        <h3 class="box-title">Information:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <?php echo form_label('ID : ', 'id'); ?>
                                <a href="#" id="id" data-type="text">
                                    <?php echo $allTemplates->id; ?></a>
                            </div>
                            <div class="form-group col-md-6">
                                <?php echo form_label('Title : ', 'title'); ?>
                                <a href="#" id="title" data-type="text">
                                    <?php echo $allTemplates->title; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="row">
                        <div class="form-group">
                            <div class="col-xs-12">
                                <label>Template Code: </label>

                                <div id="editor2">
                                    <script>
                                        initSample();
                                    </script>
                                    <?php echo readUrl() ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript">
    $.fn.editable.defaults.mode = 'inline';
    $('#title , #code').editable({
        pk: '<?php echo $allTemplates->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'newsletter_template';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#editor2').change(function () {
        alert("I have changed");
    });

</script>
