<div class="content-wrapper bg-main">
    <section class="content-header">


        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active"><?php echo $title ?></li>
        </ol>
    </section>
    <section class="content">
        <h3>
            <small><?php echo ucfirst($action); ?></small>
            <?php echo $title; ?>

        </h3>
        <div class="row">
            <form enctype="multipart/form-data"
                  action="<?php echo base_url() . 'administrator/content/addMonthlyTips'; ?>" method="post"
                  id="content">
                <div class="col-md-10">
                    <div class="box box-danger">
                        <div class="box-header">
                            <div class="box-body">

                                <div class="row">

                                    <div class="form-group col-md-3">
                                        <?php
                                        echo form_label('Short Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'short_content_title', 'name' => 'short_content_title', 'width' => '10' ,'maxlength' => '25'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-5">
                                        <?php
                                        echo form_label('Title:');
                                        echo form_input(array('class' => 'form-control', 'id' => 'content_title', 'name' => 'content_title', 'width' => '40'));
                                        ?>
                                    </div>



                                    <div class="form-group col-md-4">
                                        <?php echo form_label('Content Type:', 'monthly_tips', array('class' => 'control-label'));
                                        echo form_dropdown('module', array('monthly_tips' => 'Monthly Tips', 'pdf' => 'PDF', 'fund' => 'Funding', 'what_are_tradelines' => 'What Are Tradelines?', 'tradeline_benefits' => 'Tradeline Benefits'), '', array('class' => 'form-control ', 'name' => 'module', 'id' => 'module'))
                                        ?>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="form-group col-md-3" id="value">
                                        <label>Publish Date</label>
                                        <input id="date-picker"
                                               type="text"
                                               class="date-picker form-control"
                                               name="value"
                                               placeholder="MM/DD/YYYY"/>
                                    </div>

                                    <div class="form-group col-md-3"  id="sub_module">
                                        <?php
                                        echo form_label('Sub Type:');
                                        echo form_dropdown('sub_module', array('business_credit' => 'Business Credit', 'credit_repair' => 'Credit Repair', 'real_estate' => 'Real Estate', 'financial' => 'Financial', 'cpn' => 'CPN'), '', array('class' => 'form-control', 'id' => 'sub_module', 'name' => 'sub_module', 'width' => '100'));
                                        ?>
                                    </div>

                                    <div class="form-group col-md-3" style=" display: none" id="sub_type">
                                        <?php
                                        echo form_label('Sub Type:');
                                        echo form_dropdown('sub_type', array('broker' => 'Broker', 'owner' => 'Owner', 'client' => 'Client'), '', array('class' => 'form-control', 'id' => 'sub_type', 'name' => 'sub_type', 'width' => '100'));
                                        ?>
                                    </div>


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
                        <div class="box-footer">
                            <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" class="btn btn-primary btn-flat">Add</button>
                                              </span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>

<script>

    jQuery('#module').change(function () {
        if ($(this).val() == 'monthly_tips') {
            $('#value').show();
            $('#sub_module').show();
            $('#sub_type').hide();
        }
        else {
            $('#value').hide();
            $('#content').formValidation('enableFieldValidators', 'value', false);
            $('#content').formValidation('validateField', 'value');
            $('#sub_module').hide();

        }

        if ($(this).val() == 'pdf') {
            $('#sub_type').show();
        }


        if ($(this).val() == 'what_are_tradelines') {
            $('#content_title').val("What are Tradelines?")
        }
        if ($(this).val() == 'tradeline_benefits') {
            $('#content_title').val("Tradeline Benefits")
        }
    });

    $("#content").on('init.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.addClass(options.icon.required).show();
        }
    }).formValidation({
        framework: 'bootstrap',
        icon: {
            required: 'fa fa-asterisk',
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        excluded: ':disabled',
        fields: {
            content_title: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            short_content_title: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    stringLength: {
                        max: 20,
                        message: 'The field  must be short'
                    },
                    blank: {}
                }
            },
            file: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            value: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    }).on('status.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.removeClass(options.icon.required).addClass('fa');
        }
    }).on('success.form.fv', function (e) {
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false
        }).done(function (data) {
            serverValidationNew($("#content"), data, '<?php echo base_url() . 'administrator/content/pdfContents'?>');
        });
        e.preventDefault();
    });

    $(".date-picker").on('changeDate', function (e) {
        $('#content').formValidation('revalidateField', 'value');
    });


</script>


