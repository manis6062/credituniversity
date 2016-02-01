<style>
    #applied1 {
        z-index: 1051 !important;
    }

    #due1 {
        z-index: 1051 !important;
    }
</style>


<div class="content-wrapper bg-main">

    <section class="content-header">
        <h1>
            <?php echo $title; ?>
            <small>list <a style="padding-left: 5em" id="addcredit"
                <a href="#">add a
                    new credit application details</a></small>
        </h1>

        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">appilication</li>
        </ol>
    </section>
    <section class="content">
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped" id="emplyee">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Creditor</th>
                        <th>Type</th>
                        <th>Application Date</th>
                        <th>Line Of Credit</th>
                        <th>Status</th>
                        <th>Due Day</th>
                        <th>Comment</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($credit as $credit) { ?>
                        <tr class="item">
                            <td><?php echo $credit->id; ?></td>

                            <td><a href="#" id="creditor"
                                   data-value="<?php echo $credit->creditor ?>"
                                   data-pk=<?php echo $credit->id; ?><?php echo $credit->creditor; ?></a></td>
                            <td><a href="#" id="application_type" data-type="select"
                                   data-value="<?php echo $credit->application_type ?>"
                                   data-pk=<?php echo $credit->id; ?>
                                   data-source="<?php echo '[{value:\'credit_card\',text:\'Credit card\'},{value:\'auto\',text:\'Auto\'}, {value:\'mortgage\',text:\'Mortgage\'},{value:\'furniture\',text:\'Furniture\'},{value:\'others\',text:\'Others\'}]' ?>"
                                   data-emptytext="Select Credit Type"><?php if ($credit->application_type == 'credit_card') echo 'Credit Card';
                                    elseif ($credit->application_type == 'auto') echo 'Auto';
                                    elseif ($credit->application_type == 'mortgage') echo 'Mortgage';
                                    elseif ($credit->application_type == 'furniture') echo 'Furniture';
                                    elseif ($credit->application_type == 'others') echo 'Others'; ?></a></td>
                            <?php
                            $dbDate = $credit->applied;
                            $convertDate = new DateTime($dbDate);
                            $standard_date = $convertDate->format('m/d/y');
                            ?>
                            <td><a href="#" data-pk="<?php echo $credit->id ?>" id="applied"
                                   data-type="date"><?php echo $standard_date; ?></a></td>
                            <td><a href="#" id="amount"
                                   data-value="<?php echo '$' . $credit->amount ?>"
                                   data-pk=<?php echo $credit->id; ?><?php echo '$' . $credit->amount ?></a>
                            </td>
                            <td><a href="#" id="status" data-type="select"
                                   data-value="<?php echo $credit->status ?>"
                                   data-pk=<?php echo $credit->id; ?>
                                   data-source="<?php echo '[{value:0,text:\'Rejected\'},{value:1,text:\'Approved\'}]' ?>"
                                   data-emptytext="Select Status"><?php echo $credit->status == '0' ? 'Rejected' : 'Approved' ?>
                            </td>

                                <td><a href="#" data-pk="<?php echo $credit->id ?>" id="due"
                                       data-type="text">
                                        <?php if ($credit->status == '1') {
                                       echo $credit->due; }
                                        else {echo '' ; } ?></a></td>

                            <td><a href="#" data-pk="<?php echo $credit->id ?>" id="comment_application"
                                   data-type="text"><?php echo $credit->comment_application; ?></a></td>
                            <td>
                                <a href="#"
                                   onclick="return confirm('Are you sure you want to delete?')? deleteCredit(<?php echo $credit->id . ',' . $credit->user_id ?>): '';"><span
                                        class="glyphicon glyphicon-trash"></span></i></a>
                            </td>

                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
<div class="modal fade" id="credit" tabindex="-1" role="dialog"
     aria-labelledby="credit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'administrator/application/addCreditApplication'; ?>"
                  method="post"
                  id="credite">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="credit1">Add A New Credit Application</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body">
                                <div class="form-group col-md-8">
                                    <label class="left">Creditor:</label>
                                    <input type='text' class="form-control" id="creditor1" name="creditor1"/>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="left">Type:</label>
                                    <?php
                                    $type = array(
                                        'credit_card' => 'Credit Card',
                                        'auto' => 'Auto',
                                        'mortgage' => 'Mortgage',
                                        'furniture' => 'Furniture',
                                        'others' => 'Others'
                                    );
                                    echo form_dropdown('type1', $type, '', array('class' => 'form-control', 'name' => 'type1')) ?>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="join">Application Date:</label>

                                    <div class='input-group date'>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-type="text" class="form-control date-picker " id="applied1"
                                               name="applied1" data-mask="00/00/0000" placeholder="MM/DD/YYYY"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="control-label" for="sal">Line Of Credit:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-dollar"></i></div>
                                        <input type="text" class="form-control" id="amount1" name="amount1"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label class="control-label" for="sal">Status:</label>
                                    <?php
                                    $status = array(
                                        '0' => 'Rejected',
                                        '1' => 'Approved'
                                    );
                                    echo form_dropdown('status1', $status, '1', array('class' => 'form-control', 'id' => 'status1')) ?>
                                </div>
                                <div class="form-group col-md-8" id="due_day">
                                    <label for="join">Due Day:</label>

                                    <div class='input-group date'>
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input data-type="text" class="form-control" id="due1"
                                               name="due1" data-mask="00" placeholder="DD"/>
                                    </div>
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="comment4">Comment:</label>
                                    <input data-type="text" class="form-control" id="comment4"
                                           name="comment4"/>
                                </div>
                                <input type="hidden" class="form-control" id="user_id" name="user_id"
                                       value="<?php echo $userId; ?>"/>
                                <input type="hidden" class="form-control" id="type" name="protype"
                                       value="<?php echo $protype; ?>"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Credit Application</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<script>
    jQuery('#status1').change(function () {
        if ($(this).val() == 0) {
            $('#due_day').hide();
        }
        else {
            $('#due_day').show();

        }
    });

    $(document).on("focus", "#amount1", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });

    $(document).on("focus", ".amountmask", function () {
        $(this).mask("000,000,000,000,000", {reverse: true});
    });


    $("#applied1").datepicker({maxDate: 0});

    $(document).on("focus", ".day", function () {
        $(this).mask("00");
    });

    function deleteCredit(id, userid) {
        $.post("<?php echo base_url() . 'administrator/application/deleteCreditApplication'; ?>", {
            id: id,
            user_id: userid
        })
            .success(function (data) {
                try {
                    var data1 = $.parseJSON(data);
                    if (data1.message) {
                        $("#baseModal2").modal().find('.modal-body').text(data1.message).show();
                    } else {
                        location.reload();
                    }
                } catch (e) {
                    location.reload();
                }
            });
    }

    $('#creditor,#applied,#application_type,#status,#comment_application').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });


    $('#due*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="day" placeholder="DD">',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }
    });

    $('#amount*').editable({
        placement: 'right',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<input type="text" class="amountmask" >',
        params: function (params) {
            params.table = 'application';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
            location.reload();
        }

    });

    $("#addcredit").click(function () {
        $("#credit").modal();
        return false;
    });


    $("#credite").bootstrapValidator({
        message: 'This value is not valid',
        fields: {
            creditor1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, applied1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, due1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    between: {
                        min: 1,
                        max: 31,
                        message: 'Not Valid'
                    },
                    blank: {}
                }
            }, amount1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    regexp: {
                        regexp: /^\s*(\d+(\s*,\s*\d+)*)?\s*$/
                    },
                    blank: {}
                }
            }, type1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, status1: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }

    });

    $(".date-picker").on('changeDate', function (e) {
        $('#credite').formValidation('revalidateField', 'applied1');
    });


</script>

