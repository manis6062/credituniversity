<style xmlns="http://www.w3.org/1999/html">
    .small-box > .small-box-footer {
        text-align: left;
    }
</style>

<div class="content-wrapper bg-main">
    <section class="content-header">
        <h1>
            <span id="credit_status" onclick="document.location = currentUrl() + '?option=descript'"
                  style="cursor: pointer;"><?php echo "Credit Status" ?> </span>

            <?php if (role() == ADMIN): ?>
                <a href="<?php echo base_url(ADMIN_PATH . 'creditstatus/monitoringService/' . $userId) ?>"
                   class="btn btn-link">Credit Monitoring Services</a>
            <?php endif ?>
        </h1>

        <ol class="breadcrumb">
            <li><a href="<?php echo base_url(ADMIN_PATH); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Credit Status</li>
        </ol>
    </section>
    <section class="content">

        <div class="col-lg-3 col-xs-6" onclick="document.location = currentUrl() + '?option=monitoring'" id="c_m"
             style="cursor:pointer ; ">
            <div class="small-box">
                <div class="cm1 inner bg-credit_monitor">
                    <h3>&nbsp;</h3>

                    <p>&nbsp;</p>
                </div>
                <p class="cm1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Credit
                        Monitoring</strong></p>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="credit_repair_process">
            <div class="small-box">
                <div class="crp1 inner bg-credit_repair_process">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="crp1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Credit
                        Repair Process</strong></p>
            </div>
        </div>

        <div class="col-lg-3 col-xs-6" style="cursor:pointer" id="id_theft_process">
            <div class="small-box">
                <div class="itp1 inner bg-id_theft">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="itp1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;ID
                        Theft
                        Process
                    </strong></p>
            </div>
        </div>
        <div class="col-lg-3 col-xs-6" id="profit_number_processing" onclick="document.location='<?php echo base_url() . 'administrator/creditStatus/profileProcess/' . $this->session->userdata(USER_ID) ; ?>'"
             style="cursor:pointer">
            <div class="small-box">
                <div class="pnp1 inner bg-profile_numbers">
                    <div class="bg-soon">
                        <h3>&nbsp;</h3>

                        <p>&nbsp;</p>
                    </div>
                </div>
                <p class="pnp1 small-box-footer" style="color: black; background: rgb(207, 133, 15)"><strong>&nbsp;Profile
                        Number
                        Processing</strong></p>
            </div>
        </div>

        <div class="row">
            <?php if (($member_module->description != '') || (in_array($role_name, array(ADMIN)))) : ?>
                <div class="col-md-6 col-md-offset-3 boxes transbox" id="descript">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="col-md-12">
                                <?php if (in_array($role_name, array(ADMIN))) { ?>
                                    <a href="#" id="description" data-type="textarea"
                                       data-emptytext="enter description"
                                       data-value="<?php
                                       echo($member_module->description);
                                       ?>"><?php echo $member_module->description; ?></a>
                                <?php } else {
                                    echo $member_module->description;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <section class="col-lg-12 connectedSortable ui-sortable boxes" id="monitoring">

                <div class="col-md-6">
                    <div class="box transbox">
                        <div class="box-body">
                            <div class="box-content col-md-4 pull-left info">
                                <a href="<?php echo base_url(ADMIN_PATH . 'creditstatus/creditStatusForm/' . $userId) ?>"
                                   class="btn btn-link">Add FICO Scores</a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-content col-md-4 pull-left info">
                                <label>Pull Credit From Monitoring Service</label>
                                <?php echo form_dropdown("monitoringServices", array('' => 'Pull Credit') + $monitoringServices, '', array('class' => 'form-control monitoringServices service_control'));
                                $role = $this->session->userdata(ROLE_NAME);
                                ?>
                            </div>
                            <div class="box-content col-md-4 pull-left info">
                                <div id="link"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box transbox">
                        <div class="box-header">
                            <div class="box-content col-md-4 pull-left info">
                                <label>View Most Recent Scores</label>
                                <?php echo form_dropdown("monitoringServicesClient", array('' => 'Select Monitoring Service') + $monitoringServicesClient, '', array('class' => 'form-control monitoringServicesClient service_control', 'id' => 'm_service'));
                                $role = $this->session->userdata(ROLE_NAME);
                                ?>
                            </div>
                        </div>
                        <div class="box-body">
                            <div class="box-content col-md-8">
                                <h5><b>Monitoring Service : </b><span id="ms"></span></h5>
                                <h5><b>Experian : </b><span id="experian"></span></h5>
                                <h5><b>Equifax : </b><span id="equifax"></span></h5>
                                <h5><b>TransUnion : </b><span id="transunion"></span></h5>
                                <h5><b>Report Date : </b><span id="report_date"></span></h5>
<!--                                <h5><b>PDF : </b><span id="pdf"></span></h5>-->
<!--                                <h5><b>ID : </b><span id="id"></span></h5>-->
                            </div>
                            <div class="col-md-3">
                                <span id="pdf_link"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="box transbox" style="width: 100%">
                        <div class="box-body" style="width: 100%">
                            <table class="table table-bordered table-striped" id="scores" style="width: 100%">
                                <thead>
                                <tr>
                                    <th>Company</th>
                                    <th>Experian</th>
                                    <th>Equifax</th>
                                    <th>Transunion</th>
                                    <th>File</th>
                                    <th>Report Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody id="third_table">
                                <?php foreach ($creditStatus as $key => $credit) { 
                                    $credit_date = date('Y-m-d', strtotime($credit->date));
                                    ?>
                                    <tr class="item">
                                        <td>
                                            <div class="form-group">
                                                <a href="<?php echo $credit->url ?>" id="monitoring_service_id"
                                                   target="_blank"><?php echo $credit->name ?></a>
                                            </div>
                                        </td>
                                        <td><a href="#" data-pk="<?php echo $credit->id ?>" id="experian"
                                               data-type="text"><?php echo $credit->experian; ?></a></td>
                                        <td><a href="#" data-pk="<?php echo $credit->id ?>" id="equifax"
                                               data-type="text"><?php echo($credit->equifax) ?></a></td>
                                        <td><a href="#" data-pk="<?php echo $credit->id ?>" id="transunion"
                                               data-type="text"><?php echo $credit->transunion; ?></a></td>
                                        <td>
                                            <?php if ($credit->file!="") {?>
                                              
                                                <a href="<?php echo base_url() . 'uploads/creditStatus/' . $credit->file ?>"
                                                   target="_blank" id="file"><i
                                                        class="fa fa-file-pdf-o fa-lg"></i>
                                                </a>
                                            <?php } ?></td>
                                        <td><a href="#" data-pk="<?php echo $credit->id ?>" id="date"
                                               data-type="combodate"><?php echo $credit_date; ?></a></td>
                                        <td>
                                            <a href="#"
                                               onclick="return confirm('Are you sure you want to delete?')? deleteCreditStatus(<?php echo $credit->id . ',' . $credit->user_id ?>): '';"><span
                                                    class="glyphicon glyphicon-trash"></span></i></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

            <div class="col-md-8 boxes" id="crp">
                <div class="box box-solid">
                    <div class="box-body">
                        <div class="col-md-6">
                            "Credit Repair Process"
                            </a>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-md-8 boxes" id="itp">

                <div class="box box-solid">
                    <div class="box-body">
                        <div class="col-md-6">
                            "ID Theft Process"
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8 boxes" id="pnp">

                <div class="box box-solid">
                    <div class="box-body">
                        <div class="col-md-6">
                            " Profile Number Processing"
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script>
    var table = $('#scores').dataTable({
        iDisplayLength: 100,
        "sScrollX": "100%"
    });

    table.fnAdjustColumnSizing();

    function deleteCreditStatus(id, userid) {
        $.post("<?php echo base_url() . 'administrator/creditstatus/deleteCreditStatus'; ?>", {
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

    $('#equifax*, #transunion*,#experian*,#updated_date').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        placement: 'bottom',
        params: function (params) {
            params.table = 'credit_status';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $('#company_id*').editable({
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        params: function (params, newValue) {
            params.table = 'credit_status';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') {
                return response.msg;
            }
        }
    });

    function getServicesResult() {
        var selectedOption = $(".monitoringServicesClient").find("option:selected");
        $.ajax({
            url: "<?php echo base_url().'/administrator/creditstatus/getCreditStatus/'.$userId?>",
            method: "POST",
            data: {service: selectedOption.val()}
        }).done(function (data) {
            if (!selectedOption.val()) {
                $('#ms').empty();
                $('#experian').empty();
                $('#equifax').empty();
                $('#transunion').empty();
                $('#report_date').empty();

            }
            else {
                var result = $.parseJSON(data)[0];
                $('#ms').empty().append(result.name);
                $('#experian').empty().append(result.experian);
                $('#equifax').empty().append(result.equifax);
                $('#transunion').empty().append(result.transunion);
                var new_date = result.date;
                $('#report_date').empty().append(new_date);
                
                  if (result.file!=null) {
                    var lnk = '<?php echo base_url(); ?>'+ 'uploads/creditStatus/' + result.file; console.log(lnk);
                   var data_val =   '<a href="'+lnk+'" target="_blank" id="file"><i class="fa fa-file-pdf-o fa-5x"></a>';

                     $('#pdf_link').empty().append(data_val);
                     $('#pdf_link').show();
                    }else{
                        $('#pdf_link').hide();
                    }
//                $('#pdf').empty().append(result.file);
//                $('#id').empty().append(result.id);
            }

        });
    }

    $(".monitoringServicesClient").change(function () {
        getServicesResult();
    });


    $(".monitoringServices").change(function () {
        var value = $(this).find("option:selected").val();
        $.get("<?php echo base_url() . 'administrator/creditstatus/site/'; ?>" + value, function (data) {
            $('#link').html("<a href='" + data + "' target='_blank'>" + data + "</a>");
        });

    });

    $(document).ready(function () {
        getServicesResult();
    });

    function deleteNote(id, userid) {
        $.post("<?php echo base_url() . 'administrator/creditstatus/deleteNote'; ?>", {id: id, userId: userid})
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

    $("#addcredit").formValidation({
        message: 'This value is not valid',
        fields: {
            note_validate: {
                validators: {
                    notEmpty: {
                        message: 'Required'
                    },
                    blank: {}
                }
            }
        }
    });

    $.fn.editable.defaults.mode = 'inline';
    $('#description').editable({
        pk: '<?php echo $member_module->id;?>',
        url: '<?php echo base_url() . 'administrator/post'; ?>',
        tpl: '<textarea class="wy"></textarea>',
        params: function (params) {
            params.table = 'member_module';
            return params;
        },
        success: function (response, newValue) {
            if (response.status == 'error') return response.msg;
        }
    });

    $(document).on("click", ".wy", function () {
        $(this).wysihtml5({
            toolbar: {
                "font-styles": true,
                "emphasis": true,
                "lists": true,
                "html": true,
                "link": true,
                "image": true,
                "color": true,
                "blockquote": false,
                "outdent": true,
                "indent": true,
                "size": 'sm',
                "fa": true
            }
        });
    });

    $(document).ready(function () {
        $(".service_control").change(function (e) {
            var org_value = ($(this).val());
            $.ajax({
                type: "POST",
                url: "<?php echo base_url() ; ?>administrator/creditStatus/loadCreditStatus/<?php echo  $this->uri->segment(4) ; ?>/"+org_value,
                data: {num: org_value},
                success: function (data) {

                  //  third_table
                   // console.log(data);
                    $('#third_table').empty().append(data);
                }
            });


        });

    });


</script>