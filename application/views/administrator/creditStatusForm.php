<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            Credit Status
            <a id="addCompany" href="#"
               class="btn btn-link">Add Monitoring Service Information</a>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/creditstatus/view/' . $userId; ?>">credit status</a></li>
            <li class="active">add</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <section class="col-lg-4 ">
                <form enctype="multipart/form-data" action="<?php echo base_url() . 'administrator/creditstatus/addCreditStatus'; ?>" method="post"
                      id="fico">

                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Add Credit Status</h3>

                            </div>
                            <div class="box-body">

                                <div class="row">
                                    <div class="form-group col-md-10">
                                        <?php echo form_label('Company Name:'); ?>

                                        <?php echo form_dropdown('monitoringServiceId', $company, '', array('class' => 'form-control company_id', 'id' => 'monitoringServiceId')) ?>

                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="experian">Experian:</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" data-mask="000" placeholder="000" id="experian" name="experian"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="equifax">Equifax:</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" data-mask="000" placeholder="000" id="equifax" name="equifax"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="transUnion">TransUnion:</label>

                                        <div class="input-group">
                                            <input type="text" class="form-control" data-mask="000" placeholder="000" id="transUnion" name="transUnion"/>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="date">Report Date</label>

                                        <div class="input-group">
                                            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                            <input type="text" placeholder="MM/DD/YYYY" class="form-control input-append date-picker" id="date" name="date"/>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <?php echo form_label('Upload:'); ?>
                                        <input type="file" name="file" id="file">
                                    </div>

                                </div>



                            </div>
                            <div class="box-footer">
                                <div class="input-group">
                                                  <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-flat">Add Credit Scores</button>
                                                  </span>
                                </div>
                            </div>

                    </div>
                </form>
                </section>

            </section>
        </div>
</div>

<div class="modal fade" id="addCompanyModel" tabindex="-1" role="dialog" aria-labelledby="addCompanyModel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo base_url() . 'administrator/creditstatus/addMonitoringServiceClient'; ?>" method="post"
                  id="creditstatus">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span
                            aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="addLineTypeModalLabel">Add Monitoring Service</h4>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="box box-danger">
                            <div class="box-body">

                                <div class="form-group">
                                    <label for="type" class="control-label">Monitoring Service Name:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-university"></i></div>
                                        <?php echo form_dropdown('monitoring_service_id', $company, '', array('class' => 'form-control company_id', 'id' => 'monitoring_service_id'))?>
                                    </div>

                                </div>

                                <div class="form-group">
                                    <label for="userId" class="control-label">Username:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                        <input type="text" class="form-control" value="" placeholder="Enter user id for this site"
                                               id="userId" name="userId"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="control-label">Password:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-key"></i></div>
                                        <input type="password" class="form-control" value="" placeholder="Enter password"
                                               id="pass" name="pass"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="answer" class="control-label">Security Challenge Answer:</label>

                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                        <input type="text" class="form-control" value="" placeholder="Enter security challenge answer"
                                               id="answer" name="answer"/>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Company</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $( "#date" ).datepicker({  maxDate: 0 });

    $(".select2").select2();

    $("#addCompany").click(function () {
        $("#addCompanyModel").modal();
        return false;
    });
    $('#username*, #password*,#security_answer*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params) {
            params.table = 'client_monitoring_service';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $("#company_id").change(function () {
        var typeSelection = $("#company_id").find("option:selected");
        getSite(typeSelection);
        $.get("<?php echo base_url() . 'administrator/user/getCompanyName'; ?>", {
            type: typeSelection.text()
        }).done(function (data) {
            var data1 = $.parseJSON(data);
            var names = "";
            $("#company").html(names);
            $.each(data1, function (id, name) {
                names += "<option value='" + id + "'>" + name + "</option>";
            });
        })
    });

    $("#fico").formValidation({
        message: 'This value is not valid',
        fields: {
            company_id: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, experian: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, equifax: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, transUnion: {
                message: 'Not Valid',
                validators: {
                    notEmpty: {
                        message: 'Required'
                    }
                }
            }, date: {
                validators: {
                    date: {
                        message: 'The value is not a valid date'
                    }, notEmpty: {
                        message: 'Required'
                    }
                }
            }
        }
    });

    $(".date-picker").on('changeDate', function (e) {
        $('#fico').formValidation('revalidateField', 'date');
    });

    $("#creditstatus").formValidation({
        message: 'This value is not valid',
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, site: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    uri: {
                        message: 'Invalid'
                    },
                    blank: {}
                }
            }, userId: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }, pass: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    securePassword: {
                        message: 'The password is not valid'
                    }
                }
            }, answer: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    }).on('success.form.fv', function (e) {
        e.preventDefault();
        $.post($(this).attr('action'), $(this).serialize())
            .done(function (data) {
                serverValidation($("#creditstatus"), data, '<?php echo base_url() . 'administrator/creditstatus/creditStatusForm'?>');
                $.get("<?php echo base_url() . 'administrator/creditstatus/getCompany'; ?>").done(function (data) {
                    var data1 = $.parseJSON(data);
                    var names = "";
                    $.each(data1, function (id, name) {
                        names += "<option value='" + id + "'>" + name + "</option>";
                    });
                    $("#company_id").html(names);
                    var typeSelection = $("#company_id").find("option:selected");
                    getSite(typeSelection);
                    $(".select2").select2();
                })
            });
    });



    function deleteMonitoringServiceClient(id) {
        $.post("<?php echo base_url() . 'administrator/creditstatus/deleteMonitoringServiceClient'; ?>", {
            id: id

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


</script>


