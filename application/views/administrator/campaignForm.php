<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Add a Campaign
            <a class="btn btn-link" href="<?php echo base_url() . 'administrator/campaign'; ?>">Campaigns</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/role/roles'; ?>">roles</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <form action="<?php echo base_url() . 'administrator/campaign/addCampaign'; ?>" method="post" id="campaign"
                  class="campaign">
                <div class="col-md-4">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-user"></i></div>
                                    <?php echo form_dropdown('type', $campaignTypes, '', array('class' => 'form-control')) ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-bullhorn"></i></div>
                                    <input type="text" class="form-control" placeholder="Enter a Campaign Name"
                                           id="name" name="name"/>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon">%</span>
                                    <input id="percentage" class="form-control" type="text" name="percentage"
                                           placeholder="Enter Discount Percentage">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></div>
                                    <input type="text" class="form-control date-picker" placeholder="Campaign Start Date"
                                           id="start" name="start"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group ">
                                    <div class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></div>
                                    <input type="text" class="form-control date-picker" placeholder="Campaign End Date"
                                           id="end" name="end"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-arrows-h"></i></span>
                                    <input id="duration" class="form-control" type="text" name="duration"
                                           placeholder="Enter Duration in Days">
                                </div>
                            </div>
                            <div class="form-group ">
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

    $(".date-picker").datepicker();

    $(".date-picker").on("change", function () {
        var id = $(this).attr("id");
        var val = $("label[for='" + id + "']").text();
        $("#msg").text(val + " changed");
    });

    $('#percentage').blur(function () {
        if ($(this).val().length != 0) {
            $('#amount').attr('disabled', 'disabled');
        }
    });


    $('#amount').blur(function () {
        if ($(this).val().length != 0) {
            $('#percentage').attr('disabled', 'disabled');
        }
    });


    $("#campaign").formValidation({
        message: 'This value is not valid',
        fields: {
            type: {
                validators: {
                    notEmpty: {
                        message: 'Please choose a role'
                    }
                }

            }, name: {
                validators: {
                    notEmpty: {
                        message: 'Campaign Name is required'
                    }
                }
            },
            status: {
                validators: {
                    notEmpty: {
                        message: 'Please choose a status'
                    }
                }
            }
        }
    });

</script>



