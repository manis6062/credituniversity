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

            <li class="active"><?php echo $action;?></li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Header Option:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Title', 'Title'); ?>
                                <a href="#" id="title" data-type="text" data-emptytext="enter title "><?php echo $contact->title; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Caption', 'Caption'); ?>
                                <a href="#" id="caption" data-type="text" data-emptytext="enter caption "><?php echo $contact->caption; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Fav Icon', 'Fav Icon'); ?>
                                <a href="#" id="fav_icon" data-type="text" data-emptytext="enter fav icon "><?php echo $contact->fav_icon; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Background Color', 'Background Color'); ?>
                                <a href="#" id="head_color" data-type="text" data-emptytext="enter header color "><?php echo $contact->head_color; ?></a>
                            </div>

                        </div>

                    </div>


                    <div class="box-header">
                        <h3 class="box-title">Logo Option:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Logo', 'Logo'); ?>
                                <a href="#" id="logo" data-type="text" data-emptytext="enter logo "><?php echo $contact->logo; ?></a>
                            </div>


                        </div>

                    </div>


                    <div class="box-header">
                        <h3 class="box-title">Features Options:</h3>
                    </div>
                    <div class="box-body">
                        <h4>Feature 1</h4>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Title', 'Title'); ?>
                                <a href="#" id="feature_heading1" data-type="text" data-emptytext="enter title "><?php echo $contact->feature_heading1; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Tagline', 'Tagline'); ?>
                                <a href="#" id="feature_tagline1" data-type="text" data-emptytext="enter tagline "><?php echo $contact->feature_tagline1; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Description', 'Description'); ?>
                                <a href="#" id="feature_desc1" data-type="textarea" data-emptytext="enter description "><?php echo $contact->feature_desc1; ?></a>
                            </div>

                        </div>

                        <h4>Feature 2</h4>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Title', 'Title'); ?>
                                <a href="#" id="feature_heading2" data-type="text" data-emptytext="enter title "><?php echo $contact->feature_heading2; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Tagline', 'Tagline'); ?>
                                <a href="#" id="feature_tagline2" data-type="text" data-emptytext="enter tagline "><?php echo $contact->feature_tagline2; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Description', 'Description'); ?>
                                <a href="#" id="feature_desc2" data-type="textarea" data-emptytext="enter description "><?php echo $contact->feature_desc2; ?></a>
                            </div>

                        </div>

                        <h4>Feature 3</h4>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Title', 'Title'); ?>
                                <a href="#" id="feature_heading3" data-type="text" data-emptytext="enter title "><?php echo $contact->feature_heading3; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Tagline', 'Tagline'); ?>
                                <a href="#" id="feature_tagline3" data-type="text" data-emptytext="enter tagline "><?php echo $contact->feature_tagline3; ?></a>
                            </div>
                            <div class="form-group col-md-12">
                                <?php echo form_label('Description', 'Description'); ?>
                                <a href="#" id="feature_desc3" data-type="textarea" data-emptytext="enter description "><?php echo $contact->feature_desc3; ?></a>
                            </div>

                        </div>



                    </div>




                    <div class="box-header">
                        <h3 class="box-title">Video:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Youtube Iframe source', 'youtube'); ?>
                                <a href="#" id="theme_video" data-type="textarea" data-emptytext="enter video "><?php echo $contact->theme_video; ?></a>
                            </div>


                        </div>

                    </div>


                    <div class="box-header">
                        <h3 class="box-title">Footer Option:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Footer Background Color', 'footer'); ?>
                                <a href="#" id="footer_color" data-type="text" data-emptytext="enter footer color "><?php echo $contact->footer_color; ?></a>
                            </div>


                        </div>

                    </div>



                    <div class="box-header">
                        <h3 class="box-title">Custom CSS:</h3>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <?php echo form_label('Custom CSS', 'CSS'); ?>
                                <a href="#" id="custom_css" data-type="textarea" data-emptytext="enter custom css "><?php echo $contact->custom_css; ?></a>
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
    $('#title, #caption, #fav_icon, #head_color, #logo,#feature_heading1,#feature_heading2, #feature_heading3, #feature_tagline1, #feature_tagline2,#feature_tagline3, #feature_desc1, #feature_desc2, #feature_desc3, #theme_video, #custom_css, #footer_color').editable({
        pk: '<?php echo $contact->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'theme_option';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });


</script>

