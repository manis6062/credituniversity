<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add System User
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
                                    foreach ($roles as $key => $value) {
                                        echo form_radio(array('name' => 'roleId', 'id' => $value), $key, false);
                                        echo form_label($value);
                                    } ?>
                                </div>
                            </div>

                            <div class="form-group col-md-8">
                                <div class="input-group">
                                    <?php
                                    echo form_dropdown('brokerId', array('' => 'Choose your broker') + $brokers, set_value('brokerId', ($this->session->userdata(ROLE_NAME) == 'broker')) ? $this->session->userdata(BROKER_ID) ? $this->session->userdata(BROKER_ID) : $this->session->userdata(USER_ID) : '', array('class' => 'select2', $this->session->userdata(ROLE_NAME) == 'broker' ? 'disabled' : 'enabled' => $this->session->userdata(ROLE_NAME) == 'broker' ? 'disabled' : 'enabled', 'data-width' => '270px', 'id' => 'brokerId', 'name' => 'brokerId[]')); ?>
                                </div>
                            </div>
                            <?php if ($this->session->userdata(ROLE_NAME) == 'broker'): ?>
                                <input type="hidden" name="brokerId"
                                       value="<?php echo $this->session->userdata(BROKER_ID) ? $this->session->userdata(BROKER_ID) : $this->session->userdata(USER_ID) ?>">
                            <?php endif ?>

                        </div>


                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type='text' class="form-control" id='email' name="email""/>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="password">Password:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'password', 'name' => 'password', 'type' => "password")); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="rePassword">Re-Password:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'rePassword', 'name' => 'rePassword', 'type' => "password")); ?>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="firstName">First Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>F</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'firstName', 'name' => 'firstName')); ?>
                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="mi">M.I:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>M</strong></i></div>
                                    <input class="form-control" id="mi" name="mi" data-mask="A">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>L</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'lastName', 'name' => 'lastName')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="phone">Phone number:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="text" class="form-control"
                                           id="phone" name="phone"
                                           data-mask="(999)999-9999" placeholder="(999)999-9999"/>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="fax">Fax number:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-fax"></i></div>
                                    <input type="text" class="form-control" data-mask="000-00-0000"
                                           placeholder="___-__-____"
                                           id="fax" name="fax"/>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                            <input type="submit" class="btn btn-primary btn-flat" value="Add">
                            <input type="button" class="btn btn-primary btn-flat" value="Cancel"
                                   onclick="window.history.back()"/>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<script>
    $(document).ready(function () {

        $(".select2").select2();
        $("#user").on('init.field.fv', function (e, data) {
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
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        securePassword: {
                            message: 'The password is not valid'
                        }
                    }
                }, rePassword: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        identical: {
                            field: 'password',
                            message: 'The confirm password must be the same as original one'
                        }
                    }
                }, roleId: {
                    validators: {
                        notEmpty: {
                            message: 'Please select one of the role '
                        },
                        blank: {}
                    }
                }, email: {
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

                }, brokerId: {
                    validators: {
                        notEmpty: {
                            message: 'Please choose the broker '
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
                        phone: {
                            country: 'US',
                            message: 'The value is not valid %s phone number'
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
            e.preventDefault();
            $.post("<?php echo base_url() . 'administrator/user/addSystemUser'; ?>", $(this).serialize())
                .done(function (data) {
                    serverValidation($("#user"), data, '<?php echo base_url() . 'administrator/user/systemUsers'?>');
                });
        });
    });
</script>
