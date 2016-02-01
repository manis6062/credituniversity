<style>
    #g-recaptcha-response {
        transform: scale(0.85);
        -webkit-transform: scale(0.85);
        transform-origin: 0 0;
        -webkit-transform-origin: 0 0;
    }

    @media screen and (max-height: 575px) {
        #g-recaptcha-response, .g-recaptcha {
            transform: scale(0.85);
            -webkit-transform: scale(0.85);
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

        <div class="box box-danger col-sm-7">
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-12 ">
                        <form action="" method="post" class="registration-form">
                            <fieldset>
                                <div class="form-bottom">
                                    <div class="row">

                                        <div class="form-group col-md-12">
                                            <label for="firstName">Username / E-mail Address:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><strong>@</strong></div>
                                                <input type='text' class="form-control" id='email'
                                                       placeholder="E-mail Address"
                                                       name="email"
                                                       value=""/>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="password">Password:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-key"> </i></div>
                                                <input type='password' class="form-control" id='password'
                                                       placeholder="Password"
                                                       name="password"
                                                       value=""/>

                                            </div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="rePassword">Re-Password:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-key"> </i></div>
                                                <input type='password' class="form-control" id='rePassword'
                                                       placeholder="Repeat Password"
                                                       name="rePassword"
                                                       value=""/>

                                            </div>
                                        </div>

                                    </div>

                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>

                                <div class="form-bottom">
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
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="site">Broker:</label>

                                            <div class="input-group">
                                                <?php echo form_dropdown('brokerId', array('' => 'Choose your broker') + $brokers, '', array('class' => 'form-control', 'data-width' => '370px', 'id' => 'brokerId', 'name' => 'brokerId[]')); ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-6 conditional" data-cond-option="roleId"
                                             data-cond-value="5">
                                            <label for="site">Website:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-globe"></i></div>
                                                <input type='text' class="form-control" id='site' name="site""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">

                                        <div class="form-group col-md-6 conditional" data-cond-option="roleId"
                                             data-cond-value="2">
                                            <label for="ssn">SSN:</label>

                                            <div class="input-group ">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" class="form-control" id="ssn" name="ssn"
                                                       data-mask="000-00-0000"
                                                       placeholder="___-__-____"/>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 conditional" data-cond-option="roleId"
                                             data-cond-value="2">
                                            <label for="dob">Date Of Birth:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                                <input type='text' class="form-control" id='dob' name="dob"
                                                       data-mask="00-00-0000"
                                                       placeholder="MM-DD-YYYY" "/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label for="firstName">First Name:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><strong>F</strong></i></div>
                                                <input type='text' class="form-control" id='firstName'
                                                       name="firstName"
                                                       value="<?php echo $user->first_name ?>"/>

                                            </div>
                                        </div>

                                        <div class="form-group col-md-2">
                                            <label for="firstName">MI:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><strong>M</strong></i></div>
                                                <input type='text' class="form-control" id='mi'
                                                       name="mi"
                                                       value="<?php echo $user->middle_initial ?>"/>

                                            </div>


                                        </div>

                                        <div class="form-group col-md-5">
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
                                        <div class="form-group col-md-6">
                                            <label for="Question1">Security Question 1:</label>

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
                                            <label for="Answer1">Answer:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><strong>A</strong></i></div>
                                                <?php echo form_input(array('class' => 'form-control', 'id' => 'answer1', 'name' => 'answer1', 'type' => "text")); ?>
                                            </div>

                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="Question2">Security Question 2:</label>

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
                                        <div class="form-group col-md-6">
                                            <label for="Answer2">Answer:</label>

                                            <div class="input-group">
                                                <div class="input-group-addon"><strong>A</strong></div>
                                                <?php echo form_input(array('class' => 'form-control', 'id' => 'answer2', 'name' => 'answer2', 'type' => "text")); ?>
                                            </div>
                                        </div>


                                    </div>


                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="button" class="btn btn-next">Next</button>
                                </div>
                            </fieldset>

                            <fieldset>

                                <div class="form-bottom">
                                    <div class="row">
                                        <div class="form-group col-md- conditional" data-cond-option="roleId"
                                             data-cond-value="2">
                                            <div class="input-group">
                                                <?php
                                                foreach ($clientMembership as $key => $value) { ?>
                                                    <input type="radio" name="clientMember"
                                                           value="<?php echo $value->mlId ?>"
                                                       <label><strong><?php echo $value->memberType ?></strong></label>
                                                  <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 conditional" data-cond-option="clientMember"
                                             data-cond-value="1">
                                            <div class="input-group">
                                                <h6>Client Silver Membership</h6>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 conditional" data-cond-option="clientMember"
                                             data-cond-value="2">
                                            <div class="input-group">
                                                <h6>Client Gold Membership</h6>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 conditional" data-cond-option="clientMember"
                                             data-cond-value="3">
                                            <div class="input-group">
                                                <h6>Client Platinum Membership</h6>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>
                                            </div>
                                        </div>

                                        <!--                                            <div class="form-group col-md- conditional"  data-cond-option="roleId"  data-cond-value="3">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    --><?php
                                        //                                                    foreach ($ownerMembership as $key => $value) {
                                        //                                                        echo form_radio(array('name' => 'ownerMember', 'id' => $value), $value->mlId, FALSE);
                                        //                                                        echo form_label($value->memberType);
                                        //                                                    } ?>
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="ownerMember"-->
                                        <!--                                                 data-cond-value="1">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h1>Silver Owner Membership</h1>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!---->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="ownerMember"-->
                                        <!--                                                 data-cond-value="2">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h6>Gold Owner Membership</h6>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!---->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="ownerMember"-->
                                        <!--                                                 data-cond-value="3">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h1>Platinum Owner Membership</h1>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!---->
                                        <!---->
                                        <!--                                            <div class="form-group col-md- conditional"  data-cond-option="roleId"  data-cond-value="4">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    --><?php
                                        //                                                    foreach ($referralMembership as $key => $value) {
                                        //                                                        echo form_radio(array('name' => 'referralMember', 'id' => $value), $value->mlId, FALSE);
                                        //                                                        echo form_label($value->memberType);
                                        //                                                    } ?>
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="referralMember"-->
                                        <!--                                                 data-cond-value="1">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h1>Silver Referral Membership</h1>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                    <p>THis is test Silver</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!---->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="referralMember"-->
                                        <!--                                                 data-cond-value="2">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h6>Gold Referral Membership</h6>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                    <p>THis is test Gold</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->
                                        <!---->
                                        <!--                                            <div class="form-group col-md-12 conditional"  data-cond-option="referralMember"-->
                                        <!--                                                 data-cond-value="3">-->
                                        <!--                                                <div class="input-group">-->
                                        <!--                                                    <h1>Platinum Referral Membership</h1>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                    <p>THis is test Platinum</p>-->
                                        <!--                                                </div>-->
                                        <!--                                            </div>-->

                                        <div class="form-group col-md- conditional" data-cond-option="roleId"
                                             data-cond-value="5">
                                            <div class="input-group">
                                                <?php
                                                foreach ($brokerMembership as $key => $value) { ?>
                                                    <input type="radio" name="brokerMember"
                                                           value="<?php echo $value->mlId ?>"
                                                       <label><strong><?php echo $value->memberType ?></strong></label>
                                                  <?php  } ?>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12 conditional" data-cond-option="brokerMember"
                                             data-cond-value="1">
                                            <div class="input-group">
                                                <h6>Broker Silver Membership</h6>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>

                                                <p>THis is test Silver</p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 conditional" data-cond-option="brokerMember"
                                             data-cond-value="2">
                                            <div class="input-group">
                                                <h6>Broker Gold Membership</h6>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>

                                                <p>THis is test Gold</p>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 conditional" data-cond-option="brokerMember"
                                             data-cond-value="3">
                                            <div class="input-group">
                                                <h6>Broker Platinum Membership</h6>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>

                                                <p>THis is test Platinum</p>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">

                                        <div class="form-group col-md-6">
                                            <label for="coupon">Coupon:</label>

                                            <div class="input-group">

                                                <?php if (!empty($coupon)) { ?>
                                                    <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                                                    <input type='text' class="form-control" id='coupon'
                                                           name="coupon"
                                                           value="<?php echo $coupon ?>" disabled/>
                                                <?php } else { ?>
                                                    <div class="input-group-addon"><i class="fa fa-tags"></i></div>
                                                    <input type='text' class="form-control" id='coupon'
                                                           name="coupon" value=""/>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <div class="g-recaptcha" id="g-recaptcha-response"
                                                 data-sitekey="6LekdQsTAAAAABH0G4p2wr_mL9zdAdM-3stoyhzu"></div>
                                            <span id="captcha" style="color:red"/>
                                        </div>

                                    </div>


                                    <button type="button" class="btn btn-previous">Previous</button>
                                    <button type="submit" class="btn">Sign me up!</button>
                                </div>
                            </fieldset>

                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
    </section>


</div>

<script>
    $('.conditional').conditionize();
</script>

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


    $('.registration-form').on('submit', function (e) {
        e.preventDefault();
        $.post("<?php echo base_url() . 'register/addUser'; ?>", $(this).serialize())
            .done(function (data) {
                var response = $.parseJSON(data);
                serverValidation($(".registration-form"), data, '<?php echo base_url() . 'member/registrationPay/'?>' + response.userId + '/' + response.campaign + '/' + response.membershipTypeId);
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