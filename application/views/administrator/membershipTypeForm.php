<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add a Membership Type
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership/membershipTypes'; ?>">Membership
                Types</a>
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/membership'; ?>">Members</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/role/roles'; ?>">roles</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <?php
    if ($this->session->flashdata('message')) {
        ?>
        <div class="message info">
            <div id="message" style="color: red;"></div>
            <p><?php echo $this->session->flashdata('message') ?></p>
        </div>
    <?php } ?>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/membership/addMembershipType'; ?>" method="post"
                  id="membership" class="membership">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                                    <?php echo form_dropdown('role', $roles, 0, array('class' => 'form-control', 'id' => 'rolemode')) ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-gift"></i></div>
                                    <?php echo form_dropdown('level', $levels, 0, array('class' => 'form-control')) ?>
                                </div>
                            </div>

                            <div class="form-group" id="sysusers" style="display: none;">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <input name="system_users" placeholder="No. of System Users Allowed"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id="clientusers" style="display: none;">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <input name="client_users" placeholder="No. of Clients Allowed"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id="brokerusers" style="display: none;">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <input name="broker_users" placeholder="No. of Brokers Allowed"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group" id="ownerusers" style="display: none;">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <input name="owner_users" placeholder="No. of Line Owners Allowed"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="form-group" id="prospectusers" style="display: none;">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="fa fa-users"></i></div>
                                    <input name="prospect_users" placeholder="No. of Prospects Allowed"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></div>
                                    <input name="price" placeholder="Enter Membership Price" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group  ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-check"></i></div>
                                    <?php echo form_dropdown('status', array(1 => 'Activate', 0 => 'Activate Later'), 1, array('class' => 'form-control')) ?>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="input-group">
                                <button type="submit" class="btn btn-primary btn-flat">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script>
    jQuery('#rolemode').change(function () {
        if ($(this).val() == 5) {
            $('#sysusers').show();
            $('#clientusers').show();
            $('#brokerusers').show();
            $('#ownerusers').show();
            $('#prospectusers').show();

        }
        else {
            $('#sysusers').hide();
            $('#clientusers').hide();
            $('#brokerusers').hide();
            $('#ownerusers').hide();
            $('#prospectusers').hide();
        }
    });
    $("#membership").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            role: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, level: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            cycle: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            price: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    });


</script>







