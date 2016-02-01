<script type="text/javascript">
    jQuery(function ($) {
        $("#date").mask("99/99/9999", {placeholder: "mm/dd/yyyy"});
        $("#pcon").mask("(999) 999-9999", {placeholder: " "});
        $("#scon").mask("(999) 999-9999", {placeholder: " "});
        $("#zip").mask("99999", {placeholder: " "});
        $("#ssn").mask("999-99-9999", {placeholder: " "});
        $("#ssn_no").mask("999-99-9999", {placeholder: " "});
        $("#cpn_no").mask("999-99-9999", {placeholder: " "});
        $("#tax_no").mask("999-99-9999", {placeholder: " "});
        $("#transunion").mask("999", {placeholder: " "});
        $("#equifax").mask("999", {placeholder: " "});
        $("#experion").mask("999", {placeholder: " "});
        $("#cpn_score").mask("999", {placeholder: " "});
    });


</script>


<section id="register-page">
    <div class="container">

        <h2 style="text-align: center">Client Registration</h2>

        <div class="col-lg-3">


        </div>
        <div class="col-lg-6">


            <?php
            if ($this->session->flashdata('success_msg_affiliate')) {
                ?>
                <div class="message info">
                    <p><?php echo $this->session->flashdata('success_msg_affiliate') ?></p>
                </div>
            <?php } ?>


            <?php $attributes = array('id' => 'login-form', 'class' => 'form-horizontal box1');
            echo form_open(base_url() . 'referrer/client_reg', $attributes);
            ?>
            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Username *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'uname', 'id' => 'uname', 'placeholder' => 'Enter Your Username', 'value' => set_value('uname'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('uname');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Password *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'password', 'type' => 'password', 'placeholder' => 'Enter Password', 'id' => 'password', 'value' => set_value('password'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('password');
                    ?>
                    <p class="note">(Minumum 5 character and maximum 12 characters)</p>
                </div>
            </div>

            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Confirm Password *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'cpassword', 'type' => 'password', 'placeholder' => 'Re-enter Password', 'id' => 'cpassword', 'value' => set_value('cpassword'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('cpassword');
                    ?>
                    <p class="note">(Minumum 5 character and maximum 12 characters)</p>
                </div>
            </div>
            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">First Name *</label>

                <div class="col-sm-8">
                    <input type="hidden" name="code" value="<?php echo $code; ?>">
                    <input type="hidden" name="ref_user" value="<?php echo $ref_user; ?>">
                    <input type="hidden" name="ref_id" value="<?php echo $refinfo->affiliate_id; ?>">
                    <?php
                    $data = array('name' => 'fname', 'id' => 'fname', 'placeholder' => 'Enter First Name', 'value' => set_value('fname'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('fname');
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Middle Name </label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'mname', 'id' => 'mname', 'placeholder' => 'Enter Middle Name', 'value' => set_value('mname'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('mname');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Last Name *</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'lname', 'id' => 'lname', 'placeholder' => 'Enter Last Name', 'value' => set_value('lname'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('lname');
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="lname" class="col-sm-4 control-label">Mothers Maiden Name*</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'mmname', 'id' => 'mmname', 'placeholder' => 'Enter Mothers Maiden Name', 'value' => set_value('mmname'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('mmname');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">E-mail *</label>

                <div class="col-sm-8">

                    <?php
                    $data = array('name' => 'email', 'readonly' => 'readonly', 'id' => 'email', 'value' => $email, 'class' => 'form-control',);
                    echo form_input($data);
                    //echo form_error('email');
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Primary Contact No. *</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'pcon', 'id' => 'pcon', 'placeholder' => 'Primary Contact No.', 'value' => set_value('pcon'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('pcon');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Secondary Contact No.</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'scon', 'id' => 'scon', 'placeholder' => 'Secondary Contact No.', 'value' => set_value('scon'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('scon');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Gender *</label>

                <div class="col-sm-4">

                    <?php
                    $options = array(
                        // '' => 'Gender',
                        '' => 'Select Gender',
                        'Male' => 'Male',
                        'Female' => 'Female',

                    );
                    echo form_dropdown('gender', $options, set_value('gender'), 'class="form-control"');
                    echo form_error('gender');
                    ?>

                </div>
            </div>


            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">State *</label>

                <div class="col-sm-4">
                    <?php
                    foreach ($states as $state) {
                        $drop[$state->id] = $state->state;
                    }
                    $drop = array_merge(array('' => 'Select Your State'), $drop);
                    echo form_dropdown('state', $drop, set_value('state'), 'class="form-control"');
                    echo form_error('state');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">City *</label>

                <div class="col-sm-8">

                    <?php
                    $data = array('name' => 'city', 'id' => 'city', 'placeholder' => 'City', 'value' => set_value('city'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('city');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Zip Code *</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'zip', 'id' => 'zip', 'placeholder' => 'Zip Code', 'value' => set_value('zip'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('zip');
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Address *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'address', 'id' => 'address', 'placeholder' => 'Street, Unit, State', 'value' => set_value('address'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('address');
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label for="firstname" class="col-sm-4 control-label">Date of Birth *</label>

                <div class="col-sm-8">
                    <?php
                    $data = array('name' => 'dob', 'id' => 'date', 'placeholder' => 'MM/DD/YYYY', 'value' => set_value('dob'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('dob');
                    ?>

                </div>
            </div>


            <div class="form-group">

                <label for="firstname" class="col-sm-4 control-label">SSN No. *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'ssn_no.', 'id' => 'ssn_no', 'placeholder' => 'SSN Number', 'value' => set_value('ssn_no'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('ssn_no');
                    ?>


                    <h6>Transunion</h6>
                    <?php $data = array('name' => 'transunion', 'id' => 'transunion', 'placeholder' => 'Transunion', 'value' => set_value('transunion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('transunion');
                    ?>


                    <h6>Equifax</h6>
                    <?php $data = array('name' => 'equifax', 'id' => 'equifax', 'placeholder' => 'Equifax', 'value' => set_value('equifax'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('equifax');
                    ?>


                    <h6>Experion</h6>
                    <?php $data = array('name' => 'experion', 'id' => 'experion', 'placeholder' => 'Experion', 'value' => set_value('experion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('experion');
                    ?>

                </div>


            </div>

            <div class="form-group">

                <label for="firstname" class="col-sm-4 control-label">CPN No. *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'cpn_no.', 'id' => 'cpn_no', 'placeholder' => 'CPN Number', 'value' => set_value('cpn_no'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('cpn_no');
                    ?>


                    <h6>Transunion</h6>
                    <?php $data = array('name' => 'cpn_transunion', 'id' => 'cpn_transunion', 'placeholder' => 'CPN Transunion', 'value' => set_value('cpn_transunion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('cpn_transunion');
                    ?>


                    <h6>Equifax</h6>
                    <?php $data = array('name' => 'cpn_equifax', 'id' => 'cpn_equifax', 'placeholder' => 'CPN Equifax', 'value' => set_value('cpn_equifax'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('cpn_equifax');
                    ?>


                    <h6>Experion</h6>
                    <?php $data = array('name' => 'cpn_experion', 'id' => 'cpn_experion', 'placeholder' => 'CPN Experion', 'value' => set_value('cpn_experion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('cpn_experion');
                    ?>

                </div>


            </div>


            <div class="form-group">

                <label for="firstname" class="col-sm-4 control-label">Tax No. *</label>

                <div class="col-sm-8">
                    <?php $data = array('name' => 'tax_no.', 'id' => 'tax_no', 'placeholder' => 'Tax ID Number', 'value' => set_value('tax_no'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('tax_no');
                    ?>

                    <h6>Transunion</h6>
                    <?php $data = array('name' => 'tax_transunion', 'id' => 'tax_transunion', 'placeholder' => 'Tax Transunion', 'value' => set_value('tax_transunion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('tax_transunion');
                    ?>


                    <h6>Equifax</h6>
                    <?php $data = array('name' => 'tax_equifax', 'id' => 'tax_equifax', 'placeholder' => 'Tax Equifax', 'value' => set_value('tax_equifax'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('tax_equifax');
                    ?>


                    <h6>Experion</h6>
                    <?php $data = array('name' => 'tax_experion', 'id' => 'tax_experion', 'placeholder' => 'Tax Experion', 'value' => set_value('tax_experion'), 'class' => 'form-control',);
                    echo form_input($data);
                    echo form_error('experion');
                    ?>

                </div>

            </div>


            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <?php
                    $data = array('name' => 'submit', 'id' => 'submit', 'value' => 'Register', 'class' => 'btn btn-default',);
                    echo form_submit($data);
                    echo '&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp';
                    ?>
                    <?php

                    $data = array('value' => 'Reset', 'class' => 'btn btn-default',);
                    echo form_reset($data);

                    ?>
                </div>


            </div>

            <?php echo form_close(); ?>


        </div>
        <div class="col-lg-3"></div>

        <!--/.row-->
    </div>
    <!--/.container-->
</section><!--/#contact-page-->
</div>
<hr>