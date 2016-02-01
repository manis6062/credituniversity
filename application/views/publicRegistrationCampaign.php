<script>
    jQuery(function ($) {
        $("#ssn").mask("999-99-9999");
        $("#dob").mask("99/99/9999");
        $("#phone").mask("(999)-999-9999");
        $("#fax").mask("(999)-999-9999");

    });
</script>

<style type="text/css">
    /*Font Loded*/
    @import url(http://fonts.googleapis.com/css?family=Roboto:400,700);

    #registration .content {
        min-height: 50px;
        font-family: "Droid Sans", sans-serif;
    }

    #registration .content > .body {
        width: 100%;
        padding: 15px;
        position: relative;
    }

    #registration i.form-control-feedback {
        position: absolute;
        top: 35px;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
    }

    #radio i.form-control-feedback {
        top: 78%;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
        color: red;
    }

    #radio i {
        display: none !important;

    }

    body, .content-wrapper, .content {
        background: darkgray none repeat scroll 0 0;
        font-family: "Droid Sans", sans-serif;
        margin: 50 50 0 0;
        z-index: 800;
        transition: transform 0.3s ease-in-out 0s, margin 0.3s ease-in-out 0s;
        box-sizing: border-box;
    }

    .dropshadow {
        height: auto;
        -webkit-box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
        -moz-box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
        box-shadow: -15px 13px 20px 3px rgba(0, 0, 0, 0.91);
    }

    .gradient {
        background: -webkit-linear-gradient(dodgerblue, cornflowerblue); /* For Safari 5.1 to 6.0 */
        background: -o-linear-gradient(dodgerblue, cornflowerblue); /* For Opera 11.1 to 12.0 */
        background: -moz-linear-gradient(dodgerblue, cornflowerblue); /* For Firefox 3.6 to 15 */
        background: linear-gradient(dodgerblue, cornflowerblue); /* Standard syntax */
    }

    .center {
        margin: auto;
        width: 60%;
        border: 3px solid #8AC007;
        padding: 10px;
    }

    .customCenter {
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-custom {
        color: #bdc3c7;
        font-size: 18px;
        border: 1px solid #bdc3c7;
    }

    .btn-custom:hover {
        color: #ffffff;
        border: 1px solid #ffffff;
    }

    /*Font Loded*/

    .btn-custom {
        color: #bdc3c7;
        font-size: 18px;
        border: 1px solid #bdc3c7;
    }

    .btn-custom:hover {
        color: #ffffff;
        border: 1px solid #ffffff;
    }

    body {
        font-family: 'Droid Sans', sans-serif;
        font-weight: 400;
        font-size: 17px;
        line-height: 28px
    }

    p {
        margin-bottom: 20px
    }

    h1, h2, h3, h4, h5, h6 {
        font-family: 'Droid Sans', sans-serif;
        font-weight: 700;
        color: #000
    }

    .btn {
        border-radius: 4px;
        text-transform: uppercase
    }

    .btn-primary {
        background: #659f48;
        border: none;
        border-radius: 4px;
        font-size: 22px;
        text-shadow: 0 1px 0 #578a40;
        color: #fff;
        box-shadow: 0 2px 0 #578a40
    }

    .btn-primary:hover {
        background: #77ae50
    }

    .btn-lg {
        padding: 15px 20px
    }

    .normal {
        font-weight: 400 !important;
        font-weight: 400 !important
    }

    .main-navigation {
        background: #4b6eb2;
        padding: 10px 0;
        border-top: 5px solid #314c7b
    }

    .nav-bar {
        min-height: 59px
    }

    .navbar-default {
        background: #4b6eb2;
        border: none;
        border-radius: 0;
        box-shadow: none;
        margin: 0
    }

    .navbar-brand {
        padding: 0;
        height: 59px
    }

    .navbar-nav {
        margin-top: 10px
    }

    .navbar-default .navbar-nav > li > a {
        color: #fff;
        text-transform: uppercase;
        padding: 7px 15px;
        font-weight: 400
    }

    .navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus {
        color: rgba(255, 255, 255, 0.8)
    }

    .navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus {
        background: #659f48;
        color: #fff;
        border-radius: 4px;
        box-shadow: 0 2px 0 #578a40
    }

    .navbar-default .navbar-nav > .active > a:hover {
        background: #77ae50
    }

    .navbar-default .navbar-collapse, .navbar-default .navbar-form {
        border: none;
        box-shadow: none
    }

    .navbar-default .navbar-toggle {
        border: none;
        margin-top: 15px;
        margin-right: 0
    }

    .navbar-default .navbar-toggle .icon-bar {
        background: #fff
    }

    .navbar-default .navbar-toggle:hover, .navbar-default .navbar-toggle:focus {
        background: none
    }

    .heading {
        text-align: center;
        margin-bottom: 40px
    }

    .jumbotron {
        background: #fff;
        background: url(images/home-background3.jpg) no-repeat center 100%;
        background-size: contain;
        height: 800px;
        margin: 0
    }

    .jumbotron h1 {
        font-size: 46px
    }

    .jumbotron span {
        background: url(images/524.png) no-repeat;
        background-size: contain;
        color: transparent
    }

    .jumbotron .lead {
        color: #737373;
        font-size: 20px
    }

    .video-area {
        padding: 40px 0
    }

    .check {
        list-style: none;
        margin-bottom: 30px
    }

    .check li {
        margin-bottom: 15px
    }

    .check li i {
        color: #659f48;
        margin-right: 10px
    }

    .force {
        display: table;
        margin: 0 auto
    }

    .counter ul {
        list-style: none;
        width: 100%;
        padding: 0;
        margin-bottom: 20px
    }

    .counter ul li {
        display: inline;
        color: #000;
        font-size: 82px;
        float: left;
        margin-left: 10px;
        padding: 40px 15px;
        border-radius: 4px;
        background: #eee;
        display: inline-block;
        font-weight: 700;
        border: 2px solid #ddd;
        background: rgba(242, 242, 242, 1);
        background: -moz-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(242, 242, 242, 1)), color-stop(50%, rgba(227, 227, 227, 1)), color-stop(51%, rgba(255, 255, 255, 1)), color-stop(100%, rgba(242, 242, 242, 1)));
        background: -webkit-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -o-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: -ms-linear-gradient(top, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        background: linear-gradient(to bottom, rgba(242, 242, 242, 1) 0%, rgba(227, 227, 227, 1) 50%, rgba(255, 255, 255, 1) 51%, rgba(242, 242, 242, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#f2f2f2', endColorstr='#f2f2f2', GradientType=0)
    }

    .customer {
        background: #f2f2f2;
        padding: 40px 0
    }

    .customer img {
        margin-bottom: 20px
    }

    .how-it-works {
        padding: 40px 0
    }

    .install, .customise, .grow {
        margin-bottom: 20px
    }

    .steps {
        padding-top: 20px
    }

    .steps img {
        margin-bottom: 15px
    }

    .support {
        padding: 60px 0
    }

    .support a:hover img {
        cursor: pointer
    }

    .install a:hover img, .customise a:hover img, .grow a:hover img {
        cursor: pointer
    }

    .features {
        background: #fff9da;
        padding: 40px 0
    }

    hr {
        border-color: rgba(0, 0, 0, 0.2)
    }

    .features img {
        margin-bottom: 15px
    }

    .trusted {
        padding: 40px 0
    }

    .trusted img:first-child {
        margin-bottom: 40px
    }

    .pricing {
        padding: 40px 0
    }

    .table {
        margin-bottom: 40px
    }

    tbody tr:nth-child(odd) {
        background: #f2f2f2
    }

    tbody a:hover {
        text-decoration: none;
        cursor: pointer
    }

    tbody data-content {
        text-transform: lowercase
    }

    thead {
        border: none;
        -webkit-border-top-left-radius: 4px;
        -webkit-border-top-right-radius: 4px;
        -moz-border-radius-topleft: 4px;
        -moz-border-radius-topright: 4px;
        border-top-left-radius: 4px;
        border-top-right-radius: 4px
    }

    thead th:first-child {
        background: transparent
    }

    thead th {
        background: #4b6eb2;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 400
    }

    .table > thead > tr > th {
        border-bottom: none
    }

    .table > thead > tr > th > small {
        display: block;
        margin-bottom: 10px
    }

    .table > thead > tr > th > .btn-primary {
        font-size: 13px
    }

    .table > thead > tr > th {
        padding: 30px 0 35px
    }

    .table > thead > tr > th:nth-child(3) {
        background: #41619E
    }

    thead th h2 {
        color: #fff;
        margin: 0;
        padding: 10px 0
    }

    .table > tbody > tr > td {
        padding: 15px;
        border-left: 1px solid #ddd
    }

    .table > tbody > tr {
        border-right: 1px solid #ddd
    }

    .table > tbody > tr > td {
        border-bottom: 1px solid #ddd
    }

    .table > tbody > tr > td:first-child {
        font-size: 13px;
        line-height: 25px
    }

    .table > tbody > tr > td > i.fa {
        color: #659f48;
        font-size: 24px
    }

    .table > tbody > tr > td:first-child > i.fa {
        font-size: 16px;
        line-height: 25px;
        margin-right: 10px;
        color: #444
    }

    .table > tbody > tr:last-child > td:first-child {
        border: none
    }

    .guarantee {
        border-radius: 4px;
        padding: 20px 20px 10px;
        background: rgba(255, 255, 255, 1);
        background: -moz-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(255, 255, 255, 1)), color-stop(47%, rgba(246, 246, 246, 1)), color-stop(100%, rgba(227, 227, 227, 1)));
        background: -webkit-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -o-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: -ms-linear-gradient(top, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        background: linear-gradient(to bottom, rgba(255, 255, 255, 1) 0%, rgba(246, 246, 246, 1) 47%, rgba(227, 227, 227, 1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#ffffff', endColorstr='#e3e3e3', GradientType=0);
        box-shadow: 0 1px 5px rgba(0, 0, 0, .4)
    }

    footer {
        background: #496DAB;
        color: #fff;
        font-size: 14px;
        padding: 20px 0;
        border-top: 5px solid #314c7b
    }

    footer a {
        color: #fff;
        margin-left: 20px
    }

    footer ul {
        width: 100%;
        margin: 0;
        list-style: none;
        padding: 20px 0 0
    }

    footer ul li {
        display: inline
    }

    footer ul li a {
        text-transform: uppercase;
        font-size: 17px;
        color: #fff
    }

    footer a:hover {
        color: #fff;
        text-decoration: none
    }

    footer.copyright {
        background: #41619E;
        padding-top: 20px;
        border: none
    }

    @media only screen and (min-width: 480px) {
        .jumbotron {
            height: 840px
        }
    }

    @media only screen and (min-width: 768px) {
        .jumbotron {
            height: 900px
        }

        .navbar-nav {
            float: right
        }
    }

    @media only screen and (min-width: 992px) {
        .jumbotron {
            height: 950px
        }
    }

    .retro {
        text-shadow: 3px 3px 0px #2c2e38, 5px 5px 0px #5c5f72;
        font: 40px 'BazarMedium';
        letter-spacing: 5px;
    }

    .embossed {
        text-shadow: -1px -1px 1px #fff, 1px 1px 1px #000;
        color: #9c8468;
        opacity: 0.3;
        font: 30px 'Museo700';
    }

    .has-feedback .form-control-feedback {
        position: absolute;
        top: 3px;
        right: 15px;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
    }

    .wizard > .actions > ul > li.disabled {
        display: none;
    }
    .modal{
        height: 100%;
    }
    .modal .modal-dialog{
        padding-top: 15%;
    }
</style>


<div class="content-wrapper bg23">

    <section class="content col-md-10 col-sm-12 customCenter">

        <div class="box no-border">

            <div class="box-body dropshadow">
                <div class="row col-md-12">

                    <form id="registration" method="post">
                        <h2>Login Details</h2>
                        <?php
                        if ($this->session->flashdata('invalidCoupon')) {
                            ?><script>
                                $('#warningModal').modal('show');
                            </script>
                        <?php } ?>
                        <section data-step="0">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="email">Coupon Code:</label>                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-tag"></i> </div>
                                            <input type='text' class="form-control" id='coupon' name="coupon"
                                                   placeholder="Enter Coupon Code" value="<?php echo $this->session->flashdata('invalidCoupon')?'':$coupon;?>"/>

                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Username:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>@</strong></div>

                                        <?php if (!empty($user)) { ?>
                                            <input type='text' class="form-control" id='email' name="email"
                                                   value="<?php echo $user->email ?>" disabled/>
                                            <input type="hidden" name="email" value="<?php echo $user->email ?>">
                                        <?php } else { ?>
                                            <input type='text' class="form-control" id='email' name="email"
                                                   placeholder="Enter Your Email Address" value=""/>
                                        <?php } ?>

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
                                <div class="form-group col-md-6" style="padding-left: 20px;">
                                    <label for="rePassword">Confirm Password:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"> </i></div>
                                        <input type='password' class="form-control" id='rePassword'
                                               placeholder="Enter Your Password Again"
                                               name="rePassword"
                                               value=""/>

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
                                        echo form_dropdown('question1', array('' => 'Please select your 1st security question') + $options1, '', array('id' => 'question1', 'class' => 'form-control ')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Answer1">Answer:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>A</strong></i></div>
                                        <input type="password" class="form-control" id="answer1" name="answer1">
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
                                        echo form_dropdown('question2', array('' => 'Please select your 2nd security question') + $options2, '', array('id' => 'question2', 'class' => 'form-control ')); ?>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="Answer2">Answer:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><strong>A</strong></div>
                                        <input class="form-control" id="answer2" name="answer2" type="password">
                                    </div>
                                </div>

                                <input type='hidden' class="form-control" id='paymentType'
                                       name="paymentType" value="others"/>
                                <input type='hidden' class="form-control" id='roleId'
                                       name="roleId" value="<?php echo $roleId;?>"/>
                                <input type='hidden' class="form-control" id='membershipType'
                                       name="membershipType" value="<?php echo $membershipTypeId;?>"/>
                                   <input type='hidden' class="form-control" id='broker_id'
                                       name="broker_id" value="<?php echo $brokerId;?>"/>




                            </div>




                        </section>


                    </form>
                </div>
            </div>
        </div>
    </section>

</div>

<div class="modal fade" id="warningModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Warning !!!</h4>
            </div>
            <div class="modal-body">
                <p>This coupon code is no longer valid. Please contact your broker to provide you another link. Thank you for stopping by!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Ok</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->



<script>


$('#registration').on('keyup keypress', function(e) {
    var code = e.keyCode || e.which;
    if (code == 13) {
        e.preventDefault();
        return false;
    }
});


    $(document).ready(function () {

        function adjustIframeHeight() {
            var $body = $('body'),
                $iframe = $body.data('iframe.fv');
            if ($iframe) {
                $iframe.height($body.height());
            }
            $('html, body').animate({scrollTop: 0}, 'slow');
        }


        $('#registration')
            .steps({
                headerTag: 'h2',
                bodyTag: 'section',
                onStepChanged: function (e, currentIndex, priorIndex) {
                    adjustIframeHeight();
                },
                onStepChanging: function (e, currentIndex, newIndex) {
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    if (newIndex == 3) {
                        var fv = $('#registration').data('formValidation'), // FormValidation instance
                            $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                        fv.validateContainer($container);
                        var isValidStep = fv.isValidContainer($container);
                        if (isValidStep === false || isValidStep === null) {
                            return false;
                        }
                        e.preventDefault();
                        async:false;
                        $.post("<?php echo base_url() . 'register/checkMembership'; ?>", $(this).serialize() + '&' + $.param({
                                'roleId': $("input:radio[name=roleId]:checked").val(),
                                'membershipType': $("input:radio[name=membershipType]:checked").val(),
                                'paymentType': $("input:radio[name=paymentType]:checked").val(),
                                'coupon': $("#coupon").val(),
                                 'broker_id': $("#broker_id").val()
                            }))
                            .done(function (data) {
                                var response = $.parseJSON(data); 
                                serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPayOthers/'?>' + response.userId + '/' + response.role + '/' + response.campaign + '/' + response.membershipTypeId + '/' + response.paymentType+ '/'  + response.broker_id);

                            });
                        return true;
                    }
                    else {
                        var fv = $('#registration').data('formValidation'), // FormValidation instance
                            $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                        fv.validateContainer($container);
                        var isValidStep = fv.isValidContainer($container);
                        if (isValidStep === false || isValidStep === null) {
                            return false;
                        }
                        return true;
                    }


                },

                onFinishing: function (e, currentIndex) {
                    var fv = $('#registration').data('formValidation'),
                        $container = $('#registration').find('section[data-step="' + currentIndex + '"]');
                    fv.validateContainer($container);
                    var isValidStep = fv.isValidContainer($container);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }
                    return true;
                },
                onFinished: function (e, currentIndex) {
                    e.preventDefault();

                    async:false;
                    $.post("<?php echo base_url() . 'register/checkMembership'; ?>", $(this).serialize() + '&' + $.param({
                            'roleId': $("#roleId").val(),
                            'membershipType': $("#membershipType").val(),
                            'paymentType': $("#paymentType").val(),
                            'coupon': $("#coupon").val(),
                             'broker_id': $("#broker_id").val()
                        }))
                        .done(function (data) {
                            var response = $.parseJSON(data); 
                            serverValidationNew($("#registration"), data, '<?php echo base_url() . 'member/registrationPayOthers/'?>' + response.userId + '/' + response.role + '/' + response.campaign + '/' + response.membershipTypeId + '/' + response.paymentType+ '/'  + response.broker_id);

                        });
                }
            }).on('init.field.fv', function (e, data) {
                var $icon = data.element.data('fv.icon'),
                    options = data.fv.getOptions(),
                    validators = data.fv.getOptions(data.field).validators;
                if (validators.notEmpty && options.icon && options.icon.required) {
                    $icon.addClass(options.icon.required).show();
                }
            })
            .formValidation({
                framework: 'bootstrap',
                icon: {
                    required: 'fa fa-asterisk',
                    valid: 'fa fa-check',
                    invalid: 'fa fa-times',
                    validating: 'fa fa-refresh'
                },
                excluded: ':disabled',
                fields: {

                    email: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            regexp: {
                                regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                                message: 'The value is not a valid email address'
                            }, blank: {}
                        }
                    },
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
                    },

                    question1: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, question2: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, answer1: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, answer2: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}
                        }
                    }, coupon: {
                        validators: {
                            notEmpty: {
                                message: 'Required'
                            },
                            blank: {}

                        }
                    }
                }

            });
    }).on('status.field.fv', function (e, data) {
        var $icon = data.element.data('fv.icon'),
            options = data.fv.getOptions(),
            validators = data.fv.getOptions(data.field).validators;
        if (validators.notEmpty && options.icon && options.icon.required) {
            $icon.removeClass(options.icon.required).addClass('fa');
        }

    });

    $(document).ready(function () {
        $('#email').focusout(function () {
            $.post("<?php echo base_url() . 'register/checkMembershipExist'; ?>", $(this).serialize())
                .done(function (data) {
                    var response = $.parseJSON(data);
                    serverValidationNoRedirect($("#registration"), data);
                });
            return false;

        });
    });

    $(document).ready(function () {
        $('#coupon').keyup(function () {
            $.post("<?php echo base_url() . 'register/checkCouponGetRole'; ?>", $.param({
                'coupon': $("#coupon").val()
            }))
                .done(function (data) {
                    var response = $.parseJSON(data);
                    $('#roleId').val(response.roleId);
                    $('#membershipType').val(response.membershipTypeId);
                    serverValidationNoRedirect($("#registration"), data);
                });
            return false;

        });
    });



    $(document).ready(sizing);
    $(window).resize(sizing);
</script>