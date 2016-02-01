<style>
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>
<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <?php echo $title ?>

            <a id="addCompany" href="#"
               class="btn btn-link">Add Monitoring Service Client</a>

        </h1>

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url() . 'administrator'; ?>"><i class="fa fa-dashboard"></i>Home</a></li>
            <li><a href="<?php echo base_url() . 'administrator/creditstatus/view/' . $userId; ?>">credit status</a></li>
            <li class="active">Monitoring Services</li>
        </ol>
    </section>
    <section class="content">



        <div class="row">


            <section class="col-lg-12 connectedSortable ui-sortable">
                <div class="box">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <table class="table table-bordered table-striped" id="monitoring">
                            <thead>
                            <tr>
                                <th>Company</th>
                                <th>Username</th>
                                <th>Password</th>
                              
                        <th>Security Challenge Answer</th>
                               <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php  foreach ($companyClient as $key => $val) {
                                ?>
                                <tr class="item">

                                    <td><a href="#" data-pk="<?php echo $val->id ?>" id="name"
                                           data-type="text"><?php echo $val->name; ?></a></td>
                                    <td><a href="#" data-pk="<?php echo $val->id ?>" id="username"
                                           data-type="text"><?php echo($val->username) ?></a></td>
                                     <td><a href="#" data-pk="<?php echo $val->id ?>" id="password"
                                           data-type="text"><?php echo($val->password) ?></a></td>
                                     <td><a href="#" data-pk="<?php echo $val->id ?>" id="security_answer"
                                           data-type="text"><?php echo($val->security_answer) ?></a></td>
                               
                                     <td align="center">   <a href="#"
                                           onclick="return confirm('Are you sure you want to delete?')? deleteMonitoringServiceClient(<?php echo $val->id ?>): '';"><span
                                                class="glyphicon glyphicon-trash"></span></i></a>
                                    </td>


                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </section>


</div>
<div class="modal fade" id="addCompanyModel" tabindex="-1" role="dialog" aria-labelledby="addCompanyModel" aria-hidden="true">
    <div class="modal-dialog" style="display:list-item">
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
                serverValidation($("#creditstatus"), data, '<?php echo base_url() . 'administrator/creditstatus/monitoringServiceClient'?>');
               /* $.get("<?php echo base_url() . 'administrator/creditstatus/getCompany'; ?>").done(function (data) {
                    var data1 = $.parseJSON(data);
                    var names = "";
                    $.each(data1, function (id, name) {
                        names += "<option value='" + id + "'>" + name + "</option>";
                    });
                    $("#company_id").html(names);
                    var typeSelection = $("#company_id").find("option:selected");
                    getSite(typeSelection);
                    $(".select2").select2();
                })*/
            });
    });

    $(".tiptext").mouseover(function () {
        $(this).find('a').children(".description").show();
    }).mouseout(function () {
            $(this).find('a').children(".description").hide();
        });
</script>

