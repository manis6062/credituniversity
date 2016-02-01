<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            referrer
            <small>Add</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/referrer'; ?>">referrer</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/referrer/addreferrer'; ?>" method="post"
                  id="line">
                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">referrers Information:</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-8">
                                    <?php
                                    echo form_label('Email Address:', 'email', array('class' => 'control-label'));
                                    echo '<div class="input-group">';
                                    echo '<div class="input-group-addon"><i class="fa fa-envelope"></i></div>';
                                    echo form_input(array('class' => 'form-control', 'id' => 'email', 'name' => 'email'));
                                    echo '</div>';
                                    ?>
                                </div>

                                <div class="form-group col-md-8">
                                    <?php
                                    echo form_label('Password:');
                                    echo form_input(array('class' => 'form-control', 'id' => 'password', 'name' => 'password', 'type' => "password"));
                                    ?>
                                </div>

                                <div class="form-group col-md-8">
                                    <?php
                                    echo form_label('Re-Password:');
                                    echo form_input(array('class' => 'form-control', 'id' => 'cpassword', 'name' => 'cpassword', 'type' => "password"));
                                    ?>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <?php
                                    echo form_label('First Name:');
                                    echo form_input(array('class' => 'form-control', 'id' => 'first_name', 'name' => 'first_name'));
                                    ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php
                                    echo form_label('Middle Name:');
                                    echo form_input(array('class' => 'form-control', 'id' => 'middle_initial', 'name' => 'middle_initial', 'type' => "middle_initial"));
                                    ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php
                                    echo form_label('Last Name:');
                                    echo form_input(array('class' => 'form-control', 'id' => 'last_name', 'name' => 'last_name', 'type' => "last_name"));
                                    ?>
                                </div>

                            </div>


                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-danger">
                        <div class="box-header">
                            <h3 class="box-title">referrers preferences:</h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="phone" class="control-label">Phone number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="text" class="form-control"
                                               id="phone" name="phone"
                                               data-inputmask='"mask": "(999) 999-9999"'
                                               data-mask/>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="phone" class="control-label">Fax number:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-fax"></i></div>
                                        <input type="text" class="form-control"
                                               id="fax" name="fax"
                                               data-inputmask='"mask": "(999) 999-9999"'
                                               data-mask/>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php
                                    echo form_label('Business Site :', 'text', array('class' => 'control-label'));
                                    echo '<div class="input-group">';
                                    echo '<div class="input-group-addon"><i class="fa  fa-globe"></i></div>';
                                    echo form_input(array('class' => 'form-control', 'id' => 'site', 'name' => 'Business Site'));
                                    echo '</div>';
                                    ?>
                                </div>

                                <div class="form-group col-md-6">
                                    <?php
                                    echo form_label('Broker Email :', 'email', array('class' => 'control-label'));
                                    echo '<div class="input-group">';
                                    echo '<div class="input-group-addon"><i class="fa fa-envelope"></i></div>';
                                    echo form_input(array('class' => 'form-control', 'id' => 'broker_email_id', 'name' => 'broker_email_id'));
                                    echo '</div>';
                                    ?>
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
                </div>


            </form>
        </div>
    </section>
</div>
<script>
    $(".select2").select2();
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    $("[data-mask]").inputmask();
    $("#user").bootstrapValidator({
        /*http://www.jqueryscript.net/form/Powerful-Form-Validation-Plugin-For-jQuery-Bootstrap-3.html*/
        message: 'This value is not valid',
        fields: {
            bank: {
                message: 'The username is not valid',
                validators: {
                    notEmpty: {
                        message: 'The username is required and can\'t be empty'
                    }
                }
            },
            url: {
                validators: {
                    stringLength: {
                        min: 0
                    },
                    uri: {
                        message: 'The url is required and can\'t be empty'
                    }
                }
            }
        }
    });

    $(function () {
        $("#broker_email_id").autocomplete({
            source: "<?php echo base_url('administrator/referrer/get_brokers')?>"
        });
    });

</script>


