<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add <?php echo $title;
            ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/user'; ?>">Users</a></li>
            <li class="active">Add</li>
        </ol>
    </section>
    <section class="content">
        <form action="#" method="post" id="user">
            <div class="row col-md-7">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-8">
                                <div class="input-group">
                                    <?php
                                    echo form_dropdown('type', $roles, '', array('class' => 'select2', 'data-width' => '270px', 'id' => 'type', 'name' => 'type[]')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type='text' class="form-control" id='email' name="email" autofocus/>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="phone">Phone number:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control"
                                           id="phone" name="phone"
                                           data-mask="(999) 999-9999" placeholder="(999) 999-9999"/>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="firstName">First Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>F</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'firstName', 'name' => 'firstName')); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>L</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'lastName', 'name' => 'lastName')); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="note">Note:</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-sticky-note"></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'note', 'name' => 'note')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-flat" value="Add">
                            <input type="button" class="btn btn-primary btn-flat" value="Cancel" onclick="window.history.back()"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<script>
    $(".select2").select2();
    $("#user").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            email: {
                validators: {
                    notEmpty: {
                        message: 'Valid email is required'
                    },
                    emailAddress: {
                        message: 'Enter valid email address'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'The value is not a valid email address'
                    },
                    blank: {}
                }
            }, firstName: {
                validators: {
                    notEmpty: {
                        message: 'First Name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The first name can consist of alphabetical characters and spaces only'
                    },
                    blank: {}
                }
            }, lastName: {
                validators: {
                    notEmpty: {
                        message: 'Last Name is required'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The last name can consist of alphabetical characters and spaces only'
                    },
                    blank: {}
                }
            }, phone: {
                validators: {
                    notEmpty: {
                        message: 'Phone no. is required'
                    },
                    blank: {}
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        $.post("<?php echo base_url() . 'administrator/prospect/addProspect'; ?>", $(this).serialize())
            .done(function (data) {
                serverValidation($("#user"), data, '<?php echo base_url() . 'administrator/prospect'?>');
            });
    });

</script>
