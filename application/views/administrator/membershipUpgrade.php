
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title;
            echo '  (' . $user_name . ')' ;
            ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Membership Upgrade</li>
        </ol>
    </section>
    <section class="content col-md-8">

        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
            <form action="<?php echo base_url() . 'administrator/payment/membershipUpgrade/' . $this->uri->segment(4); ?>" id="upgrade" method="post">
                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <strong>Membership Role</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <strong>Membership Type</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <strong>Coupon Code</strong>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <strong>Client</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <?php foreach ($clientMembership as $val) { ?>
                                <th class="text-center">
                                    <input type="radio" name="membershipTypeClient"
                                           value="<?php echo $val->mtId ?>" <?php echo $val->mtId == $clientMembershipTypeId?'checked':''?> /><?php echo $val->value ?>
                                    <?php echo '$' . number_format($val->price, 0) ?>
                                </th>

                            <?php } if($clientMembershipTypeId) {?>
                             <input type="hidden" name="clientMembershipTypeId" value="<?php echo $clientMembershipTypeId;?>"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <input type="text" value="" id="clientCoupon" name="clientCoupon" style="width:70px;">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <strong>Owner</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <?php foreach ($ownerMembership as $val) { ?>
                                <th class="text-center">
                                    <input type="radio" name="membershipTypeOwner" onclick="ownerMembership()"
                                           value="<?php echo $val->mtId ?>" <?php echo $val->mtId == $ownerMembershipTypeId?'checked':''?> /><?php echo $val->value ?>
                                    <?php echo '$' . number_format($val->price, 0) ?>

                                </th>
                            <?php } if($ownerMembershipTypeId) {?>
                                <input type="hidden" name="ownerMembershipTypeId" value="<?php echo $ownerMembershipTypeId;?>"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <input type="text" value="" id="ownerCoupon" name="ownerCoupon"  style="width:70px;">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <strong>Broker</strong>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <div class="input-group">
                            <?php foreach ($brokerMembership as $val) { ?>
                                <th class="text-center">
                                    <input type="radio" id="member" name="membershipTypeBroker"
                                           value="<?php echo $val->mtId ?>" <?php echo $val->mtId == $brokerMembershipTypeId?'checked':''?>/><?php echo $val->value ?>
                                    <?php echo '$' . number_format($val->price, 0)?>

                                </th>
                            <?php } if($brokerMembershipTypeId) {?>
                                <input type="hidden" name="brokerMembershipTypeId" value="<?php echo $brokerMembershipTypeId;?>"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <div class="input-group">
                            <input type="text" value="" id="brokerCoupon" name="brokerCoupon"  style="width:70px;">
                        </div>
                    </div>

                </div>

                 <div class="row" id="payment_method">
                                <div class="form-group col-md-12">
                                    <label for="paymentType">Payment Method:</label>

                                    <div class="input-group">
                                        <input type="radio" name="paymentType" checked="true"  id="paypal" value="paypal"/> Paypal / Credit Card
                                         <input type="checkbox" name="recurring" id="recurring" value="1"/> Recurring Paypal
                                     <!--     <input type="radio" name="paymentType" id="check" value="check"/> Others-->
<!--                                        <input type="radio" name="paymentType" id="cash" value="cash"/> Cash-->
<!--                                        <input type="radio" name="paymentType" id="creditCard" value="creditCard"/>-->
<!--                                        Credit Card-->
                                    </div>
                                </div>
                                <div class="form-group col-md-12 paymentNote" style="display: none;">
                                    Please call this number (222)-222-2222 for further payment Process
                                </div>
                            </div>
<!--                <div class="row">-->
<!--                    <div class="form-group col-md-3">-->
<!--                        <div class="input-group">-->
<!--                            <strong>Buy Information:</strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!---->
<!--                <div class="row">-->
<!--                    <div class="form-group col-md-3">-->
<!--                        <div class="input-group">-->
<!--                            <strong>Membership Role</strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-4">-->
<!--                        <div class="input-group">-->
<!--                            <strong>Membership Type</strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-3">-->
<!--                        <div class="input-group">-->
<!--                            <strong>Discount %</strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                    <div class="form-group col-md-2">-->
<!--                        <div class="input-group">-->
<!--                            <strong>Price</strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                </div>-->




                <div class="row">
                    <div class="form-group col-md-3">
                        <div class="input-group">

                            <input type="submit" value="Upgrade" id="reminder" <?php echo !$this->session->userdata('popUp')?'disabled':''?> > &nbsp;
                            <input type="reset" value="Reset" name="Reset">
                        </div>
                    </div>
                </div>
            </form>


            </div>
        </div>

    </section>
</div>




    <!-- Trigger the modal with a button -->
<button type="button" hidden="hidden" id="modal_click" class="btn btn-info btn-lg" data-toggle="modal" data-target="#here"></button>
    <!-- Modal -->
    <div class="modal fade" id="here" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">The Membership Of The User Has Been Upgraded.</h4>
                </div>
                <div class="modal-body">
                    <p>Please Enter Password And Security Answers Of The User From The Profile. </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>







<script>
    <?php if(!$this->session->userdata('popUp')){?>
    $('form')
        .each(function(){
            $(this).data('serialized', $(this).serialize())
        })
        .on('change input', function(){
            $(this)
                .find('input:submit, button:submit')
                .prop('disabled', $(this).serialize() == $(this).data('serialized'))
            ;
        })
        .find('input:submit, button:submit')
        .prop('disabled', true)
    ;
    <?php }?>

    $(document).ready(function() {
        $('#upgrade')
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
                    clientCoupon: {
                        validators: {
                            optional: true,
                            blank: {}

                        }
                    },
                    ownerCoupon: {
                        validators: {
                            optional: true,
                            blank: {}

                        }
                    },
                    brokerCoupon: {
                        validators: {
                            optional: true,
                            blank: {}

                        }
                    }
                }
            });
    });

    $(document).ready(function () {
        $('#brokerCoupon').keyup(function () {
            $.post("<?php echo base_url() . 'register/checkCouponRole'; ?>", $(this).serialize() + '&' + $.param({
                'roleId': 5
            }))
                .done(function (data) {
                    var response = $.parseJSON(data);
                    serverValidationNoRedirect($("#upgrade"), data);
                });
            return false;

        });
    });
    $(document).ready(function () {
        $('#ownerCoupon').keyup(function () {
            $.post("<?php echo base_url() . 'register/checkCouponRole'; ?>", $(this).serialize() + '&' + $.param({
                'roleId': 3
            }))
                .done(function (data) {
                    var response = $.parseJSON(data);
                    serverValidationNoRedirect($("#upgrade"), data);
                });
            return false;

        });
    });
    $(document).ready(function () {
        $('#clientCoupon').keyup(function () {
            $.post("<?php echo base_url() . 'register/checkCouponRole'; ?>", $(this).serialize() + '&' + $.param({
                'roleId': 2
            }))
                .done(function (data) {
                    var response = $.parseJSON(data);
                    serverValidationNoRedirect($("#upgrade"), data);
                });
            return false;

        });
    });


$(document).ready(function () {
    $('#reminder').click(function () {
        $('#modal_click').click();
    });

});







</script>







