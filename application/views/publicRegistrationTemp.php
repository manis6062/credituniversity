<style>
    #bottom {
        margin-top: 740px;
    }

    #send_message_modal {
        margin-top: 150px;
    }
</style>

<div class="content-wrapper bg23">
    <section class="content-header">
        <h1>
            Member
            <small>Registration</small>
        </h1>
    </section>
    <section class="content col-md-7">
        <form action="#" method="post" id="user">
            <div class="box box-danger">
                <div class="box-body">

                    <div class="row">
                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <?php
                                foreach ($roles as $key => $value) {
                                    echo form_radio(array('name' => 'roleId', 'id' => $value), $key, FALSE);
                                    echo form_label($value);
                                } ?>
                            </div>
                        </div>

                        <div class="form-group col-md-8">
                            <div class="input-group">
                                <?php echo form_dropdown('brokerId', array('' => 'Choose your broker') + $brokers, '', array('class' => 'select2', 'data-width' => '370px', 'id' => 'brokerId', 'name' => 'brokerId[]')); ?>
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
                                       data-mask="(999)-999-9999" placeholder="(999)-999-9999"/>
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
                        <div class="form-group col-md-9">
                            <label for="Question1">Question1:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><strong>Q</strong></i></div>
                                <?php
                                $options1 = array();
                                foreach ($questions as $key => $question) {
                                    if ($key <= 9) {
                                        $options1[$question->id] = $question->question;
                                    }
                                }
                                echo form_dropdown('question1', $options1, '', array('id' => 'question1', 'class' => 'form-control')); ?>
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
                        <div class="form-group col-md-9">
                            <label for="Question2">Question2:</label>

                            <div class="input-group">
                                <div class="input-group-addon"><strong>Q</strong></i></div>
                                <?php

                                $options2 = array();
                                foreach ($questions as $key => $question) {
                                    if ($key > 9) {
                                        $options2[$question->id] = $question->question;
                                    }

                                }
                                echo form_dropdown('question2', $options2, '', array('id' => 'question', 'class' => 'form-control')); ?>
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

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="coupon">Membership Level :</label>

                            <div class="input-group">
                                <input type="radio" name="membership_level" id="membership_level" value="silver"
                                       style="margin:10px"/>
                                <label for="membership_level[]">Silver</label>
                                <input type="radio" name="membership_level" id="membership_level" value="gold"
                                       style="margin:10px"/>
                                <label for="membership_level[]">Gold</label>
                                <input type="radio" name="membership_level" id="membership_level" value="platinum"
                                       style="margin:10px"/>
                                <label for="membership_level[]">Platinum</label>
                            </div>

                        </div>

                        <div class="form-group col-md-6">
                            <label for="coupon">Coupon Code :</label>

                            <div class="input-group">
                                <div class="input-group-addon"><strong>A</strong></i></div>
                                <?php echo form_input(array('class' => 'form-control', 'id' => 'campaign', 'name' => 'campaign', 'type' => "text")); ?>
                            </div>

                        </div>
                    </div>


                    <div class="form-group col-md-12">
                        <div class="g-recaptcha" id="g-recaptcha-response"
                             data-sitekey="6LekdQsTAAAAABH0G4p2wr_mL9zdAdM-3stoyhzu"></div>
                        <span id="captcha" style="color:red"/>
                    </div>


                </div>

                <div class="box-footer">
                    <div class="input-group">
            <span class="input-group-btn">
            <button type="submit" id='butoonID' class="btn btn-default">Sign Up</button>
            </span>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>


<script src="https://www.google.com/recaptcha/api.js"></script>

<script>
    $("#butoonID").click(function () {
        if ($("#g-recaptcha-response").val()) {
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('register/verifyRecaptcha') ?>",
                dataType: 'html',
                async: true,
                data: {
                    captchaResponse: $("#g-recaptcha-response").val()
                },
                success: function (data) {
                    console.log("everything looks ok");
                },
                error: function (XMLHttpRequest, textStatus, errorThrown) {
                    console.log("You're a bot");
                }
            });
        } else {
            document.getElementById('captcha').innerHTML = "Captcha field is required";
        }
    });
</script>


<script>

    $(document).ready(function () {
        $('input').keypress(function (e) {
            var s = String.fromCharCode(e.which);

            if ((s.toUpperCase() === s && s.toLowerCase() !== s && !e.shiftKey) ||
                (s.toUpperCase() !== s && s.toLowerCase() === s && e.shiftKey)) {
                if ($('#capsalert').length < 1) $(this).after('<b id="capsalert" style="color:red ;">CapsLock is on!</b>');
            } else {
                if ($('#capsalert').length > 0) $('#capsalert').remove();
            }
        });
    });


    $(".select2").select2();


    $("#user").on('init.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.addClass(options.icon.required).show();
        }
    }).formValidation({
        message: 'This value is not valid',
        framework: 'bootstrap',
        icon: {
            required: 'fa fa-asterisk',
            valid: 'fa fa-check',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            password: {
                validators: {
                    notEmpty: {
                        message: 'The password is required and can\'t be empty'

                    },
                    securePassword: {
                        message: 'The password is not valid'
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
            }, site: {
                validators: {
                    blank: {}
                }
            }, brokerId: {
                validators: {
                    notEmpty: {
                        message: 'Please choose the broker'
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
            }, mi: {
                validators: {
                    stringLength: {
                        min: 1,
                        max: 1,
                        message: 'Invalid Length'
                    },
                    regexp: {
                        regexp: /^[a-z\s]+$/i,
                        message: 'The middle initial can consist of alphabetical characters and spaces only'
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
            }, rePassword: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    identical: {
                        field: 'password',
                        message: 'Passwords do not match!'
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
                        message: 'DOB is required'
                    },
                    blank: {},
                    date: {
                        format: 'MM-DD-YYYY'
                    }
                }
            }, answer1: {
                validators: {
                    notEmpty: {
                        message: 'Answer is required'
                    },
                    blank: {}
                }
            }, answer2: {
                validators: {
                    notEmpty: {
                        message: 'Answer is required'
                    },
                    blank: {}
                }
            }, membership_level: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    }).on('success.form.bv', function (e) {
        e.preventDefault();
        $.post("<?php echo base_url() . 'register/addUser'; ?>", $(this).serialize())
            .done(function (data) {
                var response = $.parseJSON(data);
                serverValidation($("#user"), data, '<?php echo base_url() . 'member/registrationCharge/'?>' + response.userId + '/' + response.campaign + '/' + response.role);
            });
    }).on('click', '[name="roleId"]', function () {
        if ($('#Client').is(':checked')) {
            disableValidators.apply(null, ['#user', 'phone']);
        } else if ($('#Broker').is(':checked')) {
            disableValidators.apply(null, ['#user', 'ssn', 'dob', 'phone', 'brokerId']);
        } else if ($('#Owner').is(':checked')) {
            disableValidators.apply(null, ['#user', 'ssn', 'dob']);
        }
    });


</script>


