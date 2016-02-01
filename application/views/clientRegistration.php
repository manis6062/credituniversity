<style>
    #bottom {
        margin-top: 520px;
    }

    /*#g-recaptcha-response {*/
    /*transform: scale(0.90);*/
    /*-webkit-transform: scale(0.90);*/
    /*transform-origin: 0 0;*/
    /*-webkit-transform-origin: 0 0;*/
    /*}*/

    @media screen and (max-height: 575px) {
        #g-recaptcha-response, .g-recaptcha {
            transform: scale(0.90);
            -webkit-transform: scale(0.90);
            transform-origin: 0 0;
            -webkit-transform-origin: 0 0;
        }
</style>


<div class="content-wrapper bg23">
    <section class="content-header">
        <h1>
            Member
            <small>Registration</small>
        </h1>
    </section>
    <section class="content">
        <form action="#" method="post" id="user">

            <div class="row col-md-7">
                <div class="box box-info">
                    <div class="box-body">

                        <div class="row">
                            <input type="text" hidden="hidden" name="roleId" value="2">
                            <input type="text" hidden="hidden" name="campaign" value="<?php echo $campaignId ?>">
                            <input type="text" hidden="hidden" name="email" value="<?php echo $user->email ?>">

                            <div class="form-group col-md-6">
                                <label for="email">Email:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>

                                    <?php if (!empty($user)) { ?>
                                        <input type='text' class="form-control" id='email' name="email"
                                               value="<?php echo $user->email ?>" disabled/>
                                    <?php } else { ?>
                                        <input type='text' class="form-control" id='email' name="email" value=""/>
                                    <?php } ?>
                                </div>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="phone">Phone number:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type='text' class="form-control" id='phone' name="phone"
                                           value="<?php echo $user->phone ?>" data-mask="(999)-999-9999"
                                           placeholder="(999)-999-9999" autofocus/>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="firstName">First Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>F</strong></i></div>
                                    <input type='text' class="form-control" id='firstName' name="firstName"
                                           value="<?php echo $user->first_name ?>"/>

                                </div>
                            </div>

                            <div class="form-group col-md-2">
                                <label for="mi">M.I:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>M</strong></i></div>
                                    <input type='text' class="form-control" id='mi' name="mi"
                                           value="<?php echo $user->middle_initial ?>"/>

                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="lastName">Last Name:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>L</strong></i></div>
                                    <input type='text' class="form-control" id='email' name="lastName"
                                           value="<?php echo $user->last_name ?>"/>

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
                            <div class="form-group col-md-6">
                                <label for="Question1">Security Question:</label>

                                <div class="input-group">
                                    <?php
                                    $options1 = array();
                                    foreach ($questions as $key => $question) {
                                        if ($key <= 9) {
                                            $options1[$question->id] = $question->question;
                                        }
                                    }
                                    echo form_dropdown('question1', $options1, '', array('id' => 'question1', 'class' => 'form-control ')); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="Question2">Security Question:</label>

                                <div class="input-group">
                                    <?php
                                    $options2 = array();
                                    foreach ($questions as $key => $question) {
                                        if ($key > 9) {
                                            $options2[$question->id] = $question->question;
                                        }
                                    }
                                    echo form_dropdown('question2', $options2, '', array('id' => 'question', 'class' => 'form-control ')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="Answer1">Answer:</label>

                                <div class="input-group">
                                    <div class="input-group-addon"><strong>A</strong></i></div>
                                    <?php echo form_input(array('class' => 'form-control', 'id' => 'answer1', 'name' => 'answer1', 'type' => "text")); ?>
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
                                <label for="coupon">Coupon:</label>

                                <div class="input-group">

                                    <?php if (!empty($coupon)) { ?>
                                        <input type='text' class="form-control" id='coupon' name="coupon"
                                               value="<?php echo $coupon ?>" disabled/>
                                    <?php } else { ?>
                                        <input type='text' class="form-control" id='coupon' name="coupon" value=""/>
                                    <?php } ?>
                                </div>
                            </div>

                            <!--                            <div class="form-group col-md-6">-->
                            <!--                                <div class="g-recaptcha" id="g-recaptcha-response"-->
                            <!--                                     data-sitekey="6LekdQsTAAAAABH0G4p2wr_mL9zdAdM-3stoyhzu"></div>-->
                            <!--                                <span id="captcha" style="color:red"/>-->
                            <!--                            </div>-->

                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="input-group">
                                              <span class="input-group-btn">
                                                <button type="submit" id='butoonID' class="btn btn-info btn-flat">
                                                    Submit
                                                </button>
                                              </span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
<!--<script src="https://www.google.com/recaptcha/api.js"></script>-->

<!--<script>-->
<!--    $("#butoonID").click(function () {-->
<!--        if ($("#g-recaptcha-response").val()) {-->
<!--            $.ajax({-->
<!--                type: 'POST',-->
<!--                url: "--><?php //echo base_url('register/verifyRecaptcha') ?><!--",-->
<!--                dataType: 'html',-->
<!--                async: true,-->
<!--                data: {-->
<!--                    captchaResponse: $("#g-recaptcha-response").val()-->
<!--                },-->
<!--                success: function (data) {-->
<!--                    console.log("everything looks ok");-->
<!--                },-->
<!--                error: function (XMLHttpRequest, textStatus, errorThrown) {-->
<!--                    console.log("You're a bot");-->
<!--                }-->
<!--            });-->
<!--        } else {-->
<!--            document.getElementById('captcha').innerHTML = "Captcha field is required";-->
<!--        }-->
<!--    });-->
<!--</script>-->

<script>

    $(".select2").select2();
    $("#user").formValidation({
        message: 'This value is not valid',
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
                    blank: {}
                }
            }, mi: {
                validators: {
                    stringLength: {
                        min: 1,
                        max: 1,
                        message: 'Invalid Length'
                    },
                    blank: {}
                }
            }, lastName: {
                validators: {
                    notEmpty: {
                        message: 'Last Name is required'
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
