<style>
    .col-md-8{
        width: 54.667%;
    }
</style>

<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add Client
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/user'; ?>">Users</a></li>
            <li class="active">add</li>
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
                                <label for="dob">Membership :</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <?php
                                    echo form_dropdown('membership_type', array('' => 'Membership Type') + $memberships, '', array('id' => 'membership_type', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="ssn">Start Date:</label>

                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                           data-mask="00-00-0000" placeholder="MM-DD-YYYY"/>
                                </div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="cpn">End Date:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar "></i></div>
                                    <input type='text' class="form-control" id='end_date' name="end_date"
                                           data-mask="00-00-0000" placeholder="MM-DD-YYYY"/>
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="ssn">SSN:</label>

                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                    <input type="text" class="form-control" id="ssn" name="ssn" data-mask="000-00-0000"
                                           placeholder="___-__-____"/>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="dob">Date Of Birth:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type='text' class="form-control" id='dob' name="dob" data-mask="00-00-0000"
                                           placeholder="MM-DD-YYYY" "/>
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="site">Website:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                    <input type='text' class="form-control" id='site' name="site""/>
                                </div>
                            </div>

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
                                           data-mask="(999)-999-9999" placeholder="(999)999-9999"/>
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
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Question1"> Security Question:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>Q</strong></i></div>
                                    <?php
                                    $options1 = array();
                                    foreach ($questions as $key => $question) {
                                        if ($key <= 9) {
                                            $options1[$question->id] = $question->question;
                                        }
                                    }
                                    echo form_dropdown('question1',array(""=>"Please select your first question")+ $options1, '', array('id' => 'question1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Answer1">Answer:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>A</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'answer1', 'name' => 'answer1', 'type' => "text")); ?>
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Question2">Security Question:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>Q</strong></i></div>
                                    <?php

                                    $options2 = array();
                                    foreach ($questions as $key => $question) {
                                        if ($key > 9) {
                                            $options2[$question->id] = $question->question;
                                        }

                                    }


                                    echo form_dropdown('question2', array(""=>"Please select your second question")+ $options2, '', array('id' => 'question', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Answer2">Answer:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>A</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'answer2', 'name' => 'answer2', 'type' => "text")); ?>
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
                roleId: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        blank: {}
                    }
                }, mi: {
                    validators: {
                        regexp: {
                            regexp: /^[a-z\s]+$/i,
                            message: 'The middle initial can consist of alphabetical characters and spaces only'
                        }
                    }
                }, email: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        callback: {
                            callback: function (value, validator, $field) {
                                $('#email').val(value.trim());
                                return true;
                            }
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
                }, password: {
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
                }, site: {
                    validators: {
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
                            message: 'Required'
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
                            message: 'Required'
                        },
                        blank: {}
                    }
                }, ssn: {
                    validators: {
                        notEmpty: {
                            message: 'SSN is required'
                        },
                        regexp: {
                            regexp: /^\d{3}-?\d{2}-?\d{4}$/,
                            message: 'SSN format (222-22-2222)'
                        },
                        stringLength: {
                            max: 30
                        },
                        blank: {}
                    }
                }, dob: {
                    validators: {
                        notEmpty: {
                            message: 'Required'
                        },
                        blank: {},
                        date: {
                            format: 'MM-DD-YYYY',
                            max: '01-01-1994',
                            message: 'You should be at 21 yrs'
                        }
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
            $.post("<?php echo base_url() . 'administrator/user/addUser'; ?>", $(this).serialize())
                .done(function (data) {
                    serverValidationNew($("#user"), data, '<?php echo base_url() . 'administrator/user'?>');
                });
        }).on('click', '[name="roleId"]', function () {
            if ($('#Client').is(':checked')) {
                disableValidators.apply(null, ['#user', 'password', 'rePassword', 'phone', 'email']);
            } else if ($('#Broker').is(':checked')) {
                disableValidators.apply(null, ['#user', 'ssn', 'dob', 'phone', 'brokerId']);
            } else if ($('#Owner').is(':checked')) {
                disableValidators.apply(null, ['#user', 'ssn', 'dob']);
            }
        });
    });

</script>
