<style>

    .editable-container.editable-inline .control-group.form-group .editable-input textarea,

    .editable-container.editable-inline .control-group.form-group .editable-input input:not([type=radio]):not([type=checkbox]):not([type=submit])
    {
        width: 400px;
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
<!--            <li><a href="--><?php //echo base_url() . 'administrator/'.$title; ?><!--">--><?php //echo $title;?><!--s</a></li>-->
            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Google Map:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Google Map (Hint : Embed URL ) : ', 'Google Map Iframe Source'); ?>
                                <a href="#" id="source" data-type="textarea" data-emptytext="enter source "><?php echo $contact->source; ?></a>
                            </div>

                        </div>

                    </div>

                    <div class="box-header">
                        <h3 class="box-title">Contact Us Form:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Contact Us : ', 'Address'); ?>
                                <a href="#" id="address" data-type="text" data-emptytext="enter address "><?php echo $contact->address; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Phone : ', 'Phone:'); ?>
                                <a href="#" id="tel" data-type="text" data-emptytext="enter tel "><?php echo $contact->tel; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Website : ', 'Website:'); ?>
                                <a href="#" id="site" data-type="text" data-emptytext="enter site "><?php echo $contact->site; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Email : ', 'Email Address: '); ?>
                                <a href="#" id="email" data-type="text" data-emptytext="enter email "><?php echo $contact->email; ?></a>
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
    //CKEDITOR.inline( 'faq_answer' );
    $.fn.editable.defaults.mode = 'inline';
    $('#source, #address, #email, #tel, #site').editable({
        pk: '<?php echo $contact->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'contact';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


</script>

